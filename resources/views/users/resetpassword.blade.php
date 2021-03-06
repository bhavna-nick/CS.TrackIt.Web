 <!DOCTYPE html>
<html lang="en">
  <head>

     <title>TrackIt | Reset Password</title>

    <!-- Bootstrap -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('/') }}/bootstrap/theme/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  
   <div>
       

      <div class="login_wrapper">
        <div class="animate form login_form" id="loginfrm">
          <section class="login_content">
            <form action="{{ url('reset-password/'.$id) }}" method="post" >
                
              <h1>Reset Password Form</h1>
              
              <div>
                  <input type="password" name="newpassword" id="password" class="form-control" placeholder="New Password" required="" />
             
                </div>
              <div>
                <input type="password" name="confirmpassword" id="password" class="form-control" placeholder="Confirm Password" required="" />
              </div>
              <div>
                  <input type="submit" class="btn btn-default submit" name="submit" value="Reset">
              
              </div>
              <div>
              <div class="clearfix"></div>
              <div style="color:red"><?php echo $msg;?></div>
              
              <div style="color:green"><?php echo $succmsg;?></div>
              
              </div>
              
              <div class="separator">
               
                <div class="clearfix"></div>
                <br />

               
              </div>
            </form>
          </section>
        </div>

      


      </div>
    </div>
  
   </body>
</html>
