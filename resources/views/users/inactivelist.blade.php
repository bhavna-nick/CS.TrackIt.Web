  
  @extends('layouts.table')

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
                    		
                      <table id="datatable-buttons" class="table table-striped table-bordered">
                  
                      <thead>
                        <tr>
                            
                          <th>Action</th>
                          <th>Full name</th>
                             <th>Email</th>
                          <th>Phone Number</th>                        
                          <th>Status</th>
                          <th>Personal Email</th>
                          <th>Reference Phone Number	</th>
                          <th>Birth Date</th>  
                        </tr>
                      </thead>
                      <tbody>
                          
                      @foreach($users as $user)
                      <?php
                      $uss = DB::select('select * from hruserlogins where UserId = ?',[$user->Id]); 
                       foreach($uss as $sd){ 
                           if($sd->Status=='2'){
                           ?>
                        <tr>
                            <td><a href="{{ url('view-user/'.$user->Id) }}"><span class="badge bg-green"><i class="fa fa-eye"></i></span> </a>
                           <a href="{{ url('history-log/'.$user->Id) }}"><span class="badge bg-pink"><i class="fa fa-lock"></i></span> </a>
                           
                               </td>
                          
                            <td>{{ $user->FirstName }} {{ $user->LastName }}</td>         
                           <td>{{ $user->Email }}</td>                           
                           <td>{{ $user->PhoneNumber }}</td>                           
                           <td>{{ $user->UserStatus }}</td>
                           <td>{{ $user->PersonalEmail }}</td>
                           <td>{{ $user->ReferencePhoneNumber }}</td>
                           <td>{{ $user->BirthDate }}</td>
                           
                        </tr>
                           <?php } } ?>
                        @endforeach
                       
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
	
  @endsection
