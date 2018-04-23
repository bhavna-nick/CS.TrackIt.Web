<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>TrackIt | Dashboard</title>

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
              <div class="title_left">
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                    
                <h3>Create New Employee</h3>
                  </div>
                  <div class="x_content">
                    
                    <div style="color:red;text-align:center"><?PHP echo $msg;?></div>
                    <form id="demo-form2" method="post" action="{{ url('/create-user') }}" data-parsley-validate class="form-horizontal form-label-left">

                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" type="email" name="Email">
                        </div>
                      </div>
                      
                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">User Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
                            <select id="heard" class="form-control" name="Status" required="">
                            <option value="">--Choose Status--</option>
                            <option value="employee">Employee</option>
                            <option value="hr">HR</option>
                            <option value="manager">Manager</option>
                          </select>
                       </div>
                      </div>
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <!--  <button class="btn btn-primary" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>-->
                          <button type="submit" class="btn btn-success">Submit</button>
<a class="btn btn-primary" href="{{ url('users') }}">Cancel</a>
                        </div>
                      </div>

                    </form>
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
            TrackIt
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
    <!-- bootstrap-progressbar -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/moment/min/moment.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="{{ url('/') }}/bootstrap/theme/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="{{ url('/') }}/bootstrap/theme/vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ url('/') }}/bootstrap/theme/build/js/custom.min.js"></script>
	
  </body>
</html>
