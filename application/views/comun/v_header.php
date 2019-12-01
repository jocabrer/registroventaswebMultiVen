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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" type="text/javascript"></script>
    
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
  	<script type="text/javascript" src="<?php echo base_url('Template/plugins/jquery.rut.chileno.min.js');?>"></script>

    <!-- LIGHTBOX-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
  		
    
    
  	
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
    
    <style>
        
.whatsapp 
{
    background-color: #1EBEA4;
    color: #F4FFFF; 
    min-height: 50px;
    width:250px;
    margin-bottom:2.5em;
    margin-right:0em;
    margin-left:auto;
    padding:5px;
}

.whatsapp a
{
    
    color: #F4FFFF ;
}

.whatsapp a:visited 
{
    
    color: #F4FFFF ; 
    
}
    </style>
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
  <?php 
        if (!$this->ion_auth->is_admin())
		{
            echo "<body class=\"skin-purple  sidebar-mini \">";
		}
		else {
		    echo "<body class=\"skin-yellow  sidebar-mini \">";
		}
  
  ?>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php  echo base_url('')?>"  class="logo">
          <span class="logo-mini"><?php echo $logomini; ?></span>
          <span class="logo-lg"><?php echo $logo; ?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
       
          
          
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Esconder Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
            <!-- --------------------------------------------------------------------------------------------------------------------------------------------------- -->
       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $ultimoscomentariosNoleidos;  ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">&Uacute;ltimos 10 comentarios</li>
              <li>
                <!-- inner menu: contains the actual data -->
               
                <ul class="menu">
                <?php foreach($ultimoscomentarios as $ultCom){ ?>
                 
                  <li><!-- start message -->
                 	<a href="<?php echo base_url('Pedido/editarPedido/'.$ultCom['id_cabecera']);?>" >
                      <div class="pull-left">
                        <img src="<?php echo base_url('Template/dist/img/user/'.$ultCom['id_user'].'.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      
                        
                        <?php echo $ultCom['id_cabecera']; ?>
                        
                      
                      <p> <?php echo $ultCom['comentario'];  ?></p>
                   
					<small><i class="fa fa-clock-o"></i>  <script>tiempoTranscurrido('<?php echo $ultCom['fecha_mod'];  ?>');</script></small>                   
                  </li>
                   </a>
                  <?php }?>
                </ul>
                 
              </li>
              <li class="footer"><a href="#">Ver todos</a></li>
            </ul>
          </li>
<!-- ---------------------------------------------  ALERTAS ----------------------------------------------->
        
        
        <?php 
            if ($this->ion_auth->is_admin())
            {
					          $cantSinFac= count($ind_conivasinfactura);
                    $cantDescuadrados = count($ind_descuadrados);
                    $totnotificaciones = $cantSinFac+$cantDescuadrados;
                    if($totnotificaciones>0)
                      echo "<li class=\"dropdown notifications-menu open\">";
                    else
                      echo "<li class=\"dropdown notifications-menu\">";
          ?>
          
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $cantDescuadrados+$cantSinFac;?></span>
            </a>
            <ul class="dropdown-menu">

            
        
          <li class="header">Tienes <?php echo $cantDescuadrados+$cantSinFac;?> notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php if($cantSinFac>0) {?>
                  <li><a href="javascript:pedidosConIvaSinFactura()"><i class="fa fa-warning text-yellow"></i><?php echo $cantSinFac; ?> pedido(s) sin factura.</a></li>
                  <?php }?>
                  <?php if($cantDescuadrados>0) {?>
                  <li><a href="javascript:pedidosDescuadrados()"><i class="fa fa-warning text-yellow"></i><?php echo $cantDescuadrados; ?> pedido(s) listos y descuadrado.</a></li>
                  <?php }?>
                </ul>
              </li>
            </ul>
          </li>

          <?php 
            }
            ?>

<!-- --------------------------------------------- FIN ALERTAS ----------------------------------------------->


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('Template/dist/img/user/'.$user->id.'.jpg')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user->first_name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('Template/dist/img/user/'.$user->id.'.jpg')?>" class="img-circle" alt="User Image">

                <p>
                 <?php echo $user->first_name." ".$user->last_name. " - ". $user->company; ?>
                  <small>Registrado desde <?php 
                  
                  $date = new DateTime();
                  $date->setTimestamp($user->created_on);
                  echo $date->format('d/m/Y'); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('Inicio/salir'); ?>" class="btn btn-default btn-flat">Desconectarse</a>
                  
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
          <!-- --------------------------------------------------------------------------------------------------------------------------------------------------- -->
        </nav>
      </header>
     <?php if($this->ion_auth->logged_in()){ ?>
				       	<?php include 'menu.php';?>

	  <?php }?>

