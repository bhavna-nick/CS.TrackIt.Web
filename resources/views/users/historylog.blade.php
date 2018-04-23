  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DataTables | Trackit</title>

    <!-- Bootstrap -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('/') }}/bootstrap/theme/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
   

@section('content')
   
     <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
         @include('inc.sidebar')
        <!-- top navigation -->
       @include('inc.header')  <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
            
                </div>

          
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User List</h2>
                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php                              
                             $usdetail = DB::select('select * from hrusers where UserId = ?',[$uid]);
                             $uname=$usdetail[0]->Email; 
                            ?>		
                    
                     <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                            
                          <th>Email</th>
                           <th>Change Log Date</th>
                          <th>Full name</th>
                          <th>Phone Number</th>                        
                          
                          <th>Personal Email</th>
                          <th>Reference Phone Number	</th>
                          <th>Birth Date</th>  
                          <th>Anniversary Date</th>  
                          <th>Emergency Contact No.</th>  
                          <th>Blood Group</th>  
                          <th>Facebook Id</th>  
                          <th>Facebook Page Like</th>
                          <th>Linked In</th>
                          <th>Address</th>                         
                          <th>Profile Image</th>
                        </tr>
                      </thead>
                      <tbody>
                     <?php if(!empty($users)){?>
                      @foreach($users as $user) 
                      <tr>
                          <td><?php echo $uname;?></td>
                          <td>{{ $user->Created }}</td>
                          <td>{{ $user->FirstName }} {{ $user->LastName }}</td>
                          <td>{{ $user->PhoneNumber }}</td>
                          <td>{{ $user->PersonalEmail }}</td>
                          <td>{{ $user->ReferencePhoneNumber }}</td>
                          <td>{{ $user->BirthDate }}</td>
                          <td>{{ $user->AnniversaryDate }}</td>
                          <td>{{ $user->EmergencyContactNo }}</td>
                          <td>{{ $user->BloodGroup }}</td>
                          <td>{{ $user->FacebookId }}</td>
                          <td>{{ $user->FacebookPageLike }}</td>
                          <td>{{ $user->LinkedIn }}</td>
                          <td>{{ $user->Address }}</td>
                          <td><img src="{{ url('/') }}/public/images/<?php echo $user->ProfileImage ?>" width="10%"></td>
                      </tr>
                          
                      @endforeach
                       <?php } ?>
                      </tbody>
                    </table>
                    <script>
                    function deleteuser(id){
                        var r = confirm("Are You sure want to delete this user?");
                        if (r == true) {
                            $.ajax({
                            type: 'get',
                            url: 'delete-user/'+id,
                            data: "id="+id,
                            success: function () {
                              alert('Successfully Delete user');
                              location.reload();
                            }
                          });
                        }
                    }
                    </script>	
					
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
         @include('inc.footer') 
        <!-- /footer content -->
      </div>
    </div>

<style>
    tr.inactivecls {
    background: rgba(0,0,0,0.1);
}
</style>
	
   <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ url('/') }}/bootstrap/theme/build/js/custom.min.js"></script>

  </body>
</html>
