    <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/dashboard/') }}" class="site_title"><i class="fa fa-paw"></i> <span>TrackIt</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
<?php $lid=Session::get('LoginId');
 $users = DB::select('select * from hrusers where UserId= ?',[$lid]);
  $profimg=$users[0]->ProfileImage; 
$Uname=$users[0]->FirstName.' '.$users[0]->LastName;
   if($profimg!=''){
     $img=$profimg;
     }else{
     $img='dummy.jpg';
   }

$uloguser = DB::select('select * from hruserlogins where UserId= ?',[$lid]);
 $statruslog=$uloguser[0]->Status;
   ?>

<?php $img=$users[0]->ProfileImage; 
    
if($img!=''){ if (file_exists( public_path() . '/images/' . $img)){
                   $i=$img;
}else{ $i='dummy.jpg';}
               }else{$i='dummy.jpg';}
?>

<img src="{{ url('/public/images/')}}<?php echo '/'.$i;?>" alt="..." class="img-circle profile_img">
               <!-- <img src="../../bootstrap/theme/production/images/img.jpg" alt="..." class="img-circle profile_img">
              --></div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php $a=Session::get('loginname');if($a!=''){ echo $Uname; } ?></h2>
                <?php $status = Session::get('Status');?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>

                <ul class="nav side-menu">

                  
<?php if($statruslog=='1'){ ?>
<li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard </a>
                   
                  </li>

 <li><a href="{{ url('/users') }}"><i class="fa fa-users"></i> Member</a>
                   
                  </li>
<?php } ?>
                  
                 
                </ul>
              </div>
              
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
