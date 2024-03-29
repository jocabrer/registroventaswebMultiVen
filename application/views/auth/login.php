<!DOCTYPE html>
<html>
  <head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Select2 -->
    <link href="<?php echo base_url('Template/plugins/select2/select2.min.css"'); ?> rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('Template/bootstrap/css/bootstrap.min.css"') ?>" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('Template/dist/css/AdminLTE.css"'); ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins   folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('Template/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('Template/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url('Template/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('Template/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('Template/plugins/datepicker/datepicker3.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('Template/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('Template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet" type="text/css" />

    


	<!--  Editable -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css" rel="stylesheet"/>
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

	
	<!-- bootstrap-table Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
	



	<!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('Template/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('Template/plugins/jQueryUI/jquery-ui.js')?>" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('Template/plugins/select2/select2.full.min.js')?>" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('Template/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('Template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>" type="text/javascript"></script>
	<!-- bootstrap-table Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url('Template/plugins/bootstrap-table/dist/bootstrap-table.min.js')?>"></script>
	<script src="<?php echo base_url('Template/plugins/bootstrap-table/dist/extensions/editable/bootstrap-table-editable.js')?>" ></script>
	<script src="<?php echo base_url('Template/plugins/x-editable/dist/jqueryui-editable/js/jqueryui-editable.min.js')?>"></script>
    <!-- Slimscroll -->
	
    <script src="<?php echo base_url('Template/plugins/slimScroll/jquery.slimscroll.min.js')?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('Template/plugins/fastclick/fastclick.min.js')?>" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('Template/dist/js/app.min.js')?>" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('Template/plugins/timepicker/bootstrap-timepicker.min.js')?>" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('Template/plugins/daterangepicker/daterangepicker.js')?>" type="text/javascript"></script>
  
  
    <script src="<?php echo base_url('Template/plugins/jquery-validation/dist/jquery.validate.js')?>" type="text/javascript"></script> 
  
	

	  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
	
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>"><b>RV Web.</b>1.0</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?php echo lang('login_heading');?></p>
        
          <div class="form-group has-feedback">
         <?php echo form_open("auth/login");?>   
            <input type="email" class="form-control" placeholder="Email" id="identity" name="identity"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="password" name="password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
				  <input type="checkbox" name="remember" id="remember"> <?php echo lang('login_remember_label', 'remember');?>
				<?php echo $message;?>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
               <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('login_submit_btn'); ?></button>
               
            </div><!-- /.col -->
          </div>
        <?php echo form_close();?>

      
       <div style="text-align:center;"><a href="<?php echo base_url(); ?>auth/forgot_password"><?php echo lang('login_forgot_password');?></a></div>
       <br/>
       
        <!--  <a href="register.html" class="text-center">Register a new membership</a>

		
		
		
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

 
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('Template/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- iCheck -->
   <script src="<?php echo base_url('Template/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
	
	

  </body>
</html>