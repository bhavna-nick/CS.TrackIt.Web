<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>TrackIt | View User </title>

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
<?php $uloguser = DB::select('select * from hruserlogins where UserId= ?',[$users[0]->Id]);
 $statruslog=$uloguser[0]->Status;  if($statruslog=='0' || $statruslog=='1'){?>
             <a  class="btn btn-info"  style="float:right" onclick='deleteuser(<?php echo $users[0]->Id;?>)'>
                                <i class="fa fa-user"> </i> Delete Member
                              </a> <a  class="btn btn-primary"  style="float:right" href="{{ url('get-user/'.$users[0]->Id) }}">
                                <i class="fa fa-user"> </i> Edit Details
                              </a>
<?php } if($statruslog=='2'){ ?>
<a  class="btn btn-primary"  style="float:right" onclick='activeuser(<?php echo $users[0]->Id;?>)'>
                                <i class="fa fa-user"> </i> Approve Member
                              </a>
<?php } ?>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h3>View Profile</h3>
                    
                  </div>
                   <script>
                    function deleteuser(id){
                        var r = confirm("Are You sure want to delete this member?");
                        var url= "{{ url('delete-user/'.$users[0]->Id) }}";
                        var rurl="{{ url('users') }}";
                        if (r == true) {
                            $.ajax({
                            type: 'get',
                            url: url,
                            data: "id="+id,
                            success: function () {
                              alert('Successfully Delete user');
                              window.location.href=rurl;
                            }
                          });
                        }
                    }

                    function activeuser(id){
						 var r = confirm("Are You sure want to Activate this member?");
                        var url= "{{ url('activate-user/'.$users[0]->Id) }}";
                        var rurl="{{ url('users') }}";
                        if (r == true) {
                            $.ajax({
                            type: 'get',
                            url: url,
                            data: "id="+id,
                            success: function () {
                              window.location.href=rurl;
                            }
                          });
                        }
					}
                    </script>	
                   
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
 <br />
                     
                      <!-- start skills -->
                      
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
						<div class="row">
						  <div class="col-md-6  col-sm-6 col-xs-12 ">
						  <div class="boxxls">
						  <h4 class="titcls">Persional Information</h4>
					<!----------------------------------------------------->	
                      <label for="email">Company Email : <span><?php echo $users[0]->Email; ?></span></label>
                      
						 <label for="fullname">Phone No. : <span> <?php echo $users[0]->PhoneNumber; ?></span></label>
                       <label for="fullname">Birth Date : <span><?php echo $users[0]->BirthDate; ?></span></label>
                     
                      <label>Gender : <span><?php echo $users[0]->Gender; ?></span></label>
                   

                     
					 <label for="fullname">Address : <span><?php echo $users[0]->Address; ?></span></label>
					
					
					  
                      </div>
                  <!------------------------------------------------------------->    
						  </div>
						   <div class="col-md-6  col-sm-6 col-xs-12 "><div class="boxxls">
						  <h4 class="titcls">Additional Information</h4>
						  <!----------------------------------------------------------->
						  <label for="fullname">Personal Email :<span> <?php echo $users[0]->PersonalEmail; ?></span></label>
                        
                      <label for="fullname">Nick Name : <span><?php echo $users[0]->NormalizedUserName; ?></span></label>
                     
						<label>Married Status : <span><?php if($users[0]->MaritalStatus=='1'){ echo 'Married';} else { echo 'Simgle';}?></span></label>
                    <label>Anniversary Date : <span><?php echo $users[0]->AnniversaryDate; ?></label>

					 
                      <label for="email">Spouse Name : <span><?php echo $users[0]->SpouseName; ?></span></label>
                   
                        <label for="email">Spouse Contact No. : <span><?php echo $users[0]->SpouseContact; ?></span></label>
                   	  <p>Emergency Contact Detail</p>
                      <label for="fullname">Person Name :<span> <?php echo $users[0]->EmergencyContactPerson; ?></span></label>
                     
					 <label for="fullname"> Phone No. :<span> <?php echo $users[0]->ReferencePhoneNumber; ?></span></label>
                     
 <label for="fullname">Relation : <span><?php echo $users[0]->ContactRelation; ?></span></label>
                       
                      <label for="fullname">Blood Group : <span><?php echo $users[0]->BloodGroup; ?></span></label>
                     
					 <label for="fullname">Facebook Id : <span><?php echo $users[0]->FacebookId; ?></span></label>
                     
                      <label for="fullname">Facebook Page Like : <span><?php echo $users[0]->FacebookPageLike; ?></span></label>
                    
					   <label for="fullname">Linked In : <span><?php echo $users[0]->LinkedIn; ?></span></label>
                     
                      </div>
                     
                    
					</div>
						  <!------------------------------------------------------------>
						  </div>
						</div>
						
                    
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div><style>.boxxls span {
    font-size: 12px;
    color: #000;
    font-weight: 300;
    text-transform: capitalize;
}</style>
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
