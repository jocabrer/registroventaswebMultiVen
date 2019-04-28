<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	<?php echo $titleHeader; ?>
	<small>
	<?php echo $descHeader ?>
	</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
	<li><a href="<?php echo base_url($currentClass); ?>"><?php echo $currentClass ?></a></li>
	<li class="active"><?php echo $currentAction ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

	<table id="listado_cuentas"></table>
	

<a href="#" class="btn btn-default" id="btnback"><i class="fa  fa-backward"></i> Volver</a>


</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">

$(document).ready(function() {

$('#listado_cuentas').bootstrapTable('destroy').bootstrapTable({

	    url: '<?php echo base_url(); ?>Cuenta/ListaCuenta/',
		method: "GET",
		columns: 
		[
			{field: 'Numero',title: 'Nro.'},
			{field: 'Nombre',title: 'Desc. Cuenta'},
			{field: 'Tipo',title: 'Activo/Pasivo'}
		]
   });


$('#btnback').click(function () {
	window.history.back();
});


});

</script>
 


	

