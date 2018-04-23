<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>TrackIt | Edit User </title>

    <!-- Bootstrap -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/starrr/dist/starrr.css" rel="stylesheet">
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
     <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h3>Edit Profile</h3>
                    
                  </div>
                  
                   <?php if($msg!=''){ ?>


  <div class="alert alert-danger  alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <?php  echo $msg;?>
  
</div><?php } ?>
                    @if (count($errors) > 0)
	<div class="alert alert-danger">
		
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
                  <div class="x_content">
                   <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{ url('update-user/'.$users[0]->Id) }}" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar --> <?php if($users[0]->ProfileImage!=''){
if (file_exists( public_path() . '/images/' . $users[0]->ProfileImage)){
 ?>
                          <img class="img-responsive avatar-view" src="{{ url('/') }}/public/images/<?php echo $users[0]->ProfileImage;?>" alt="Avatar" title="Change the avatar">
                       <?php } else { ?> <img class="img-responsive avatar-view" src="{{ url('/') }}/public/images/dummy.jpg" alt="Avatar" title="Change the avatar">
<?php } }else{ ?>
                         <img class="img-responsive avatar-view" src="{{ url('/') }}/public/images/dummy.jpg" alt="Avatar" title="Change the avatar">
                       
                        <?php } ?>
                        </div>
                        
							
                      </div>
                      <h3><?php echo $users[0]->FirstName; ?><?php echo $users[0]->LastName; ?></h3>

<div class="file-upload">
    <label for="upload" class="file-upload__label">Edit Profile Image</label>
    <input id="upload" class="file-upload__input" type="file" name="image" accept="image/*">
</div>
                    
                         <input type="hidden" name="oldimg" value="<?php echo $users[0]->ProfileImage; ?>">
                      <br />
                     
                      <!-- start skills -->
                      
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
						<div class="row">
						  <div class="col-md-6  col-sm-6 col-xs-12 ">
						  <div class="boxxls">
						  <h4 class="titcls">Persional Information</h4>
					<!----------------------------------------------------->	
                      <label for="fullname">First Name * :</label>
                      <input type="text" id="fullname" class="form-control" name="FirstName" value="<?php echo $users[0]->FirstName; ?>" required="required">
                      
                      <label for="fullname">Last Name * :</label>
                      <input type="text" id="fullname" class="form-control" name="LastName" value="<?php echo $users[0]->LastName; ?>" required="required">

                      <label for="email">Company Email * :</label>
                      <input type="email" id="email" class="form-control" readonly value="<?php echo $users[0]->Email; ?>" >
					  <script>
	function ValidatePhoneNo() {
			if ((event.keyCode > 47 && event.keyCode < 58) || event.keyCode == 43 || event.keyCode == 32)
				return event.returnValue;
			return event.returnValue = '';
		}
	</script>
						 <label for="fullname">Phone No. * :</label>
                      <input type="text" id="fullname" class="form-control" required="required" name="PhoneNumber" onkeypress="return ValidatePhoneNo()" onkeyup="return ValidatePhoneNo()" onkeydown="return ValidatePhoneNo()" value="<?php echo $users[0]->PhoneNumber; ?>" maxlength='10'>
                      
                      <label for="fullname">Birth Date * :</label>
                      <input  class="form-control" required="required" id="myDatepicker2"  value="<?php echo $users[0]->BirthDate; ?>" type="text" name="BirthDate">

                      <label>Gender *:</label>
                      <p>
                        Male:
                        <input type="radio" class="flat" name="gender"  value="male"  required="required" <?php if($users[0]->Gender=='male'){ echo 'checked';}?> > Female:
                       <input type="radio" class="flat" name="gender"  value="female" required="required" <?php if($users[0]->Gender=='female'){ echo 'checked';}?> >
                      </p>

                     
					 <label for="fullname">Address * :</label>
                      <textarea id="message" required="required" class="form-control"  name="Address" ><?php echo $users[0]->Address; ?></textarea>
                     
					
					
					  
                      </div>
                  <!------------------------------------------------------------->    
						  </div>
						   <div class="col-md-6  col-sm-6 col-xs-12 "><div class="boxxls">
						  <h4 class="titcls">Additional Information</h4>
						  <!----------------------------------------------------------->
						  <label for="fullname">Personal Email * :</label>
                      <input id="fullname" class="form-control" required="required" value="<?php echo $users[0]->PersonalEmail; ?>" type="email" name="PersonalEmail">
                      
                      <label for="fullname">Nick Name :</label>
                      <input id="fullname" class="form-control" value="<?php echo $users[0]->NormalizedUserName; ?>" type="text" name="NormalizedUserName">

						<label>Married Status *:</label>
                      <p>
                        Married:
                        <input type="radio" class="flat" name="marriedstatus" id="married" value="1"  onclick="statuscheck()" <?php if($users[0]->MaritalStatus=='1'){ echo 'checked';}?> > Single:
                       <input type="radio" class="flat" name="marriedstatus" id="single" value="0" onclick="statuscheck()" <?php if($users[0]->MaritalStatus=='0'){ echo 'checked';}?>>
                      </p>

						<div id="marieddiv"  <?php if($users[0]->MaritalStatus=='1'){ echo 'style="display:block"';}else { echo 'style="display:none"';}?> >
						 <label for="fullname">Anniversary Date  :</label>
                      <input type="text" id="myDatepicker1" class="form-control" value="<?php echo $users[0]->AnniversaryDate; ?>" name="AnniversaryDate">
                      <label for="email">Spouse Name :</label>
                    <input id="fullname" class="form-control"  value="<?php echo $users[0]->SpouseName; ?>" type="text" name="SpouseName">
                    
                        <label for="email">Spouse Contact No. :</label>
                    <input id="fullname" class="form-control"  value="<?php echo $users[0]->SpouseContact; ?>" type="text" name="SpouseContact" maxlength='10' onkeyup="return ValidatePhoneNo()">                    
                     
						
                      </div>
                      <script>
                      function statuscheck(){
						 var u= $('input[name=marriedstatus]:checked').val();
						   if(u=='1'){
							$("#marieddiv").show();   
							}else{
								$("#marieddiv").hide();  
								}
						}
                      
                      </script>
                      <p>Emergency Contact Detail</p>
                      <label for="fullname">Person Name </label>
                      <input type="text" id="fullname" class="form-control" value="<?php echo $users[0]->EmergencyContactPerson; ?>" type="text" name="EmergencyContactPerson">                      
                     
					 <label for="fullname"> Phone No. </label>
                      <input type="text" id="fullname" class="form-control" maxlength="10" value="<?php echo $users[0]->ReferencePhoneNumber; ?>" type="text" name="ReferencePhoneNumber" onkeyup="return ValidatePhoneNo()" onkeypress="return ValidatePhoneNo()" onkeydown="return ValidatePhoneNo()" maxlength='10'>

 <label for="fullname">Relation </label>
                      <input type="text" id="fullname" class="form-control" value="<?php echo $users[0]->ContactRelation; ?>" type="text" name="Relation">   
                      
                      <label for="fullname">Blood Group :</label>
                      <input type="text" id="fullname" class="form-control" value="<?php echo $users[0]->BloodGroup; ?>"  name="BloodGroup">

					 <label for="fullname">Facebook Id :</label>
                      <input type="text" id="fullname" class="form-control" value="<?php echo $users[0]->FacebookId; ?>"  name="FacebookId">
                      
                      <label for="fullname">Facebook Page Like :</label>
                      <input type="text" id="fullname" class="form-control" value="<?php echo $users[0]->FacebookPageLike; ?>" name="FacebookPageLike">

					   <label for="fullname">Linked In:</label>
                      <input type="text" id="fullname" class="form-control" value="<?php echo $users[0]->LinkedIn; ?>"  name="LinkedIn">

					</div>
						  <!------------------------------------------------------------>
						  </div>
						</div>
						
                      <button type="submit" class="btn btn-success">Submit</button>
                      <a href="{{ url('view-user/') }}<?php echo '/'.$users[0]->UserId; ?>"  class="btn btn-primary">Cancel</a>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
          <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            TrackIt
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/moment/min/moment.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Ion.RangeSlider -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- jquery.inputmask -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- jQuery Knob -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- Cropper -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/cropper/dist/cropper.min.js"></script>

    <script src="{{ url('/') }}/bootstrap/theme/build/js/custom.min.js"></script>
    <!-- Custom Theme Scripts -->
	
<script>

var date = new Date();
date.setDate(date.getDate()-6090);
    $('#myDatepicker').datetimepicker();
    
    $('#myDatepicker2').datetimepicker({
        maxDate:date,
        format: 'YYYY-MM-DD'
    });
$('#myDatepicker1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
</script>
 <style>
 .boxxls {
    border: 1px inset;
    padding: 15px;
}
h4.titcls {
    color: #2A3F54;
    font-size: 23px;
    border-bottom: 1px solid;
}


                      .file-upload {
	position: relative;
	display: inline-block;
}

.file-upload__label {
  display: block;
  padding: 1em 1em;
  color: #fff;
  background: #222;
  border-radius: .4em;
  transition: background .3s;
  
  &:hover {
     cursor: pointer;
     background: #000;
  }
}
    
.file-upload__input {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    font-size: 1;
    width:0;
    height: 100%;
    opacity: 0;
}        </style>

  </body>
</html>
