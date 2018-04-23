<?php 
session_start(); //session start

require_once ('libraries/Google/autoload.php');

//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/
$client_id = '389653460526-f1le4gcvov18mtjvfmj5lq6kc6dmghfr.apps.googleusercontent.com'; 
$client_secret = '4Sdw8hX9o1tM8GzXrXeTjjux';
$redirect_uri = 'http://trackit.cueserve.com/trackit-web/dashboard';


//incase of logout request, just unset the session var
if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/
  
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}


//Display user info or display login url as per the info we have.
echo '<div style="margin:20px">';
if (isset($authUrl)){ 
	//show login url
	
} else {
	
	$user = $service->userinfo->get(); //get user info 
	
	// connect to database
	
	
	//check if user exist in database using COUNT
	//$result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
	//$user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
	$user_count='0';
	//show user picture
	//echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
	
	if($user_count) //if user already exist change greeting text to "Welcome Back"
    {
       // echo 'Welcome back '.$user->name.'! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
	else //else greeting text "Thanks for registering"
	{ 
       // echo 'Hi '.$user->name.', Thanks for Registering! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
		
		    $emp = DB::table('hruserlogins')->where('LoginProvider',$user->email)->where("gploginkey",'<>','')->get();
			if(!empty($emp)){
				//update
				DB::table('hruserlogins')
                  ->where('LoginProvider', $user->email)
                  ->update(array('gploginkey' => $user->id,
                         ));
                  
               DB::table('hrusers')
                  ->where('Email', $user->email)
                  ->update(array('gploginkey' => $user->id,
                         ));       
                         
                         session()->put('Loginemail', $user->email);
                   session()->put('loginname', $user->name);
                   session()->put('LoginId', $emp[0]->UserId);
                    
			}else{
			    //insert
			     $iid = DB::table('hruserlogins')->insertGetId(
                   array('LoginProvider' => $user->email,
                         'gploginkey' => $user->id,
                         'ProviderDisplayName' => $user->email,
                         'Status' => '3',
                         ));
                         
					   DB::table('hruserlogins')
					  ->where('LoginProvider', $user->email)
					  ->update(array('gploginkey' => $user->id,
									 'UserId' => $iid,
							 ));
							 
				 $usersiid = DB::table('hrusers')->insertGetId(
                   array('Email' => $user->email,
                         'gploginkey' => $user->id,
                         'FirstName' => $user->name,
                         'UserId' => $iid,
                         'Status'=>'3',
                         ));
                          session()->put('Loginemail', $user->email);
                   session()->put('loginname', $user->name);
                   session()->put('LoginId', $iid);
			}
		
		
    }
	
	//print user details
	//echo '<pre>';
	//print_r($user);
	//echo '</pre>';
}
echo '</div>';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>TrackIt </title>

    <!-- Bootstrap -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('/') }}/bootstrap/theme/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
         @include('inc.sidebar')
        </div>

        <!-- top navigation -->
        @include('inc.header') 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="onel" role="main">
          <!-- top tiles -->
          <!-- /top tiles -->

           <div class="r" role="main">

          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count"><?php echo $totaluser;?></div>
                  <h3>Total Users</h3>
                  <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count"><?php echo $totalemp;?></div>
                  <h3>Total Employee</h3>
                  
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count"><?php echo $totalhr;?></div>
                  <h3>Total HR</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count"><?php echo $totalmanager;?></div>
                  <h3>Total Manager</h3>
                </div>
              </div>
            </div>

             </div>
        </div>
       
      </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Trackit
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/Flot/jquery.flot.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/Flot/jquery.flot.time.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/moment/min/moment.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ url('/') }}/bootstrap/theme/build/js/custom.min.js"></script>
	<style>.r {
    padding: 10px 30px 10px 16px;
    margin-left: 230px;
    background: #F7F7F7;
    min-height: auto;
}.tile-stats h3 {
    color: #BAB8B8;
    font-size: 21px;
}
.row.top_tiles {
  min-height:600px;
  }.tile-stats .icon i {
    padding: 16px 7px ;
}</style>
  </body>
</html>
