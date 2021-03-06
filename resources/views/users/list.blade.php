  
  @extends('layouts.table')

@section('content')
 <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
           @include('inc.sidebar')
        <!-- top navigation -->
       @include('inc.header')  <!-- /top navigation -->
  <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Members </h3>
              </div>

              <div class="title_right">

                <a onclick="inactiveuser()" class="btn btn-danger " id="inactive" style="float:right">
                                <i class="fa fa-user"> </i> Inactive Users
                              </a>
				<a onclick="activeuser()" class="btn btn-primary" id="active" style="display:none;float:right">
                                <i class="fa fa-user"> </i> Active Users
                              </a><a  class="btn btn-info"  style="float:right" href="{{ url('create-user') }}">
                                <i class="fa fa-user"> </i> Add User
                              </a>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                  

 <div class="row mycls"  id="activeusersdiv">
                      
<div style=""><!--display: inline-flex;-->
 <?php $status = Session::get('Status');
                             $LoginId = Session::get('LoginId');?>
                      @foreach($users as $user)
                      <?php
                      $uss = DB::select('select * from hruserlogins where UserId = ?',[$user->Id]); 
                       foreach($uss as $sd){ 
                           if($sd->Status=='0'){
                           ?>
                     <div class="col-md-4 col-sm-4 col-xs-12 profile_details"> <a href="{{ url('view-user/'.$user->Id) }}">
                        <div class="well profile_view" style=" ">
                          <div class="col-sm-12">
                            <h4 class="brief"><i></i></h4>
                            <div class="col-xs-7" style="padding:0px">
<?php $img=$user->ProfileImage;  
    
if($img!=''){ if (file_exists( public_path() . '/images/' . $img)){
                   $i=$img;
}else{ $i='dummy.jpg';}
               }else{$i='dummy.jpg';}
?>


                              <h2 style="font-size:14px">{{ $user->FirstName }} {{ $user->LastName }}</h2>
                              <ul class="list-unstyled">
                                <li style="display: inline-flex;margin-top: 50px;"> <i class="fa fa-envelope"></i> <span style="padding-left:2px"> {{ $user->Email }}</span> </li>
                                <li><i class="fa fa-phone"></i> {{ $user->PhoneNumber }} </li>
                              </ul>
                            </div>
                            <div class="col-xs-5 text-center"><img src="{{ url('/') }}/public/images/<?php echo $i;?>" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                        </div>
                     </a> </div>
 <?php } } ?>
                        @endforeach
                        
                  </div>      
                       </div>
  
                   
             
              <div class="row mycls"  id="inactiveusersdiv" style="display:none">
                      
<div style="">
 <?php $status = Session::get('Status');
                             $LoginId = Session::get('LoginId');?>
                      @foreach($users as $user)
                      <?php
                      $uss = DB::select('select * from hruserlogins where UserId = ?',[$user->Id]); 
                       foreach($uss as $sd){ 
                           if($sd->Status=='2'){
                           ?>
                     <div class="col-md-4 col-sm-4 col-xs-12 profile_details"> <a href="{{ url('view-user/'.$user->Id) }}">
                        <div class="well profile_view" style=" ">
                          <div class="col-sm-12">
                            <h4 class="brief"><i></i></h4>
                            <div class="col-xs-7" style="padding:0px">

<?php $img=$user->ProfileImage;  
    
if($img!=''){ if (file_exists( public_path() . '/images/' . $img)){
                   $i=$img;
}else{ $i='dummy.jpg';}
               }else{$i='dummy.jpg';}
?>



                              <h2 style="font-size:14px">{{ $user->FirstName }} {{ $user->LastName }}</h2>
                              <ul class="list-unstyled">
                                <li style="display: inline-flex;margin-top: 50px;"> <i class="fa fa-envelope"></i> <span style="padding-left:2px"> {{ $user->Email }}</span> </li>
                                <li><i class="fa fa-phone"></i> {{ $user->PhoneNumber }} </li>
                              </ul>
                            </div>
                            <div class="col-xs-5 text-center"><img src="{{ url('/') }}/public/images/<?php echo $i;?>" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                        </div>
                     </a> </div>
 <?php } } ?>
                        @endforeach
                        
                  </div>      
                       </div>
  
           
               
               
                  </div>
                  </div>
                </div>
              </div>
            </div>
          
          
          
          
          
          
          </div>
        </div>
        
      </div>
    </div>
    
    </div>
    <script>
                  function inactiveuser(){
					  $("#inactive").hide();
					$("#active").show();
					
					$("#activeusersdiv").hide();
					$("#inactiveusersdiv").show();
				 }
				 function activeuser(){
					$("#inactive").show();
					$("#active").hide();
					
					$("#activeusersdiv").show();
					$("#inactiveusersdiv").hide();
				}
                  </script> 
<style>.well.profile_view {
    width: 100%;
    height: 90%;
}
.profile_details:nth-child(3n) {
    clear: unset !important;
}</style>

	
  @endsection