<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Santiago');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
  	<link rel="icon" type="image/png"   href="<?php echo base_url('favicon.ico'); ?>">
    <title><?php echo $titulo; ?></title>
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
    <link href="<?php echo base_url('Template/plugins/iCheck/flat/blue.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url('Template/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('Template/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('Template/plugins/datepicker/datepicker3.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('Template/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('Template/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css" rel="stylesheet"/>
	<!-- bootstrap-table Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
	
	
	<!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>-->
    <script
			  src="https://code.jquery.com/jquery-2.2.4.js"
			  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
			  crossorigin="anonymous"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <!-- js del template -->
    <script src="<?php echo base_url('Template/dist/js/app.min.js')?>" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('Template/plugins/select2/select2.full.min.js')?>" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('Template/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('Template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>" type="text/javascript"></script>
	<!-- bootstrap-table Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url('Template/plugins/bootstrap-table/dist/bootstrap-table.js')?>"></script>
	<!-- Script para exportar tablas -->
	<script src="http://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
	<script src="<?php echo base_url('Template/plugins/bootstrap-table/dist/extensions/export/bootstrap-table-export.js')?>"></script>
	<!-- Script para exportar a pdf -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
	<!-- daterangepicker -->
    <script src="<?php echo base_url('Template/plugins/timepicker/bootstrap-timepicker.min.js')?>" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('Template/plugins/daterangepicker/daterangepicker.js')?>" type="text/javascript"></script>
  

  
    <script src="<?php echo base_url('Template/plugins/jquery-validation/dist/jquery.validate.js')?>" type="text/javascript"></script> 
  	
  	
  	<script type="text/javascript" src="<?php echo base_url('Template/plugins/jquery.priceformat.js');?>"></script>
  	
  	<script type="text/javascript" src="<?php echo base_url('Template/plugins/comun.js');?>"></script>
  	
  	
	<script src="<?php echo base_url('Template/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js')?>" type="text/javascript"></script>
	
	

    <!--  Se agrega bootstrap table  editable 03112017-->
	
	<script src="<?php echo base_url('Template/plugins/bootstrap-table/dist/extensions/editable/bootstrap-table-editable.js')?>" ></script>
	<script src="<?php echo base_url('Template/plugins/x-editable/dist/jqueryui-editable/js/jqueryui-editable.min.js')?>"></script>
	
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
    
    <script>var base_url = '<?php echo base_url() ?>';</script>
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-red  sidebar-mini ">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="http://www.latasymoldes.cl"  class="logo">
          <span class="logo-mini">Latasymoldes.cl</span>
          <span class="logo-lg">Latasymoldes.cl</span>
        </a>

        
      </header>
      
      <?php if($this->ion_auth->is_admin()){ ?>
				<?php include 'menu.php';
				       	?>
	  <?php }else{?>
	  		<?php include 'menupublic.php';
        }?>
				       	
       

