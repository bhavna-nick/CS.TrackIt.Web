 
  @extends('layouts.loginout')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  
   <div>
       
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <a class="hiddenanchor" id="forgotpassword"></a>

      <div class="login_wrapper">
        <div class="animate form login_form" id="loginfrm">
          <section class="login_content">
            <form action="{{ url('login/') }}" method="post" >
                
              <h1>Login Form</h1>
              
              <div>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                  <input type="submit" class="btn btn-default submit" name="submit" value="Sign in">
                  <!-----------------login with google plus------------------------------------------------------------>
                  
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
echo '<div style="margin:31px 4px 11px 4px">';
if (isset($authUrl)){ 
	//show login url
	echo '<a href="' . $authUrl . '"><img src="public/images/google-login-button.png" width="50%"></a>';
	
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
        //echo 'Welcome back '.$user->name.'! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
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
                         
			}else{
			    //insert
			     $iid = DB::table('hruserlogins')->insertGetId(
                   array('LoginProvider' => $user->email,
                         'gploginkey' => $user->id,
                         'ProviderDisplayName' => $user->email,
                         'Status' => '0',
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
                         'ProfileImage'=>$user->picture,
                         ));
			}
		
		
    }
	
	//print user details
	//echo '<pre>';
	//print_r($user);
	//echo '</pre>';
}
echo '</div>';
?>
                  <!---------------------------------------------------------------------------->
                <a class="to_register1"  onclick="forgotpwd()">Lost your password?</a>
              </div>
              <div>
                  
              <div class="clearfix"></div>
<div style="color:red" id="er1"><?php echo $msg;?></div>

<script>
$(document).ready(function(){    
        $("#er1").fadeOut(2500)
});
</script>

</div>
              <div class="separator">
               <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>-->

                <div class="clearfix"></div>
                <br />

               <!-- <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>-->
              </div>
            </form>
          </section>
        </div>

       
<!--
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

               
              </div>
            </form>
          </section>
        </div>-->

        <script>
          function forgotpwd(){
            $("#forgotpasswod").show();
            $("#loginfrm").hide();
          }
        </script>

         
     <div id="forgotpasswod" class="animate form" style="display:none">
          <section class="login_content">
              <div id="successmsg" style="color:green"></div>
              <div id="error" style="color:red"></div>
               <div id="error1" style="color:red"></div>
            <form method="post" >
              <h1>Forgot Password</h1>
           
              <div>
                <input type="email" class="form-control" placeholder="Email" name="emailid" id="emailid" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" onclick="forgotpassword()">Submit<a>
              </div>
              
              <div class="clearfix"></div>
               <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register" onclick="demo()"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />


               
              </div>
            </form>
          </section>
        </div>
        <script> 
        function demo(){  
          $("#forgotpasswod").hide();
          $("#loginfrm").show();
        }
         function forgotpassword(){
          var email = $("#emailid").val();
          $.ajax({
                    type: 'post',
                    dataType : 'json',
                    url: 'forgot-password',
                    data: "emailid=" + email,
                    success: function (data) {
                        if(data.success == '1'){ 
                            $("#successmsg").html('<div class="successcls">Send email successfully. please check your mail</div>');
                        }else{
                            if(data=='1'){
                               $("#error").html('<div class="errormsg" id="errid">Invalid Email Formate</div>')
                                //invalid email foramate
                            }if(data=='2'){
                                $("#error1").html('<div class="errormsg" id="errid1"> Email does not Exist</div>')
                               
                                //imalnot exsit
                            }
                        }
                    }
                });
        }
        </script>


      </div>
    </div>
<style>  a.login {
    background: red;
    border: 1px solid red;
    border-radius: 3px;
    padding: 6px;
    color: #fff;
}
img.imh {
    width: 184px;
    height: 47px;
} 
input.btn.btn-default.submit {
    height: 43px;
    margin-top: 2px;
}</style>
  
@endsection
