<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><?php echo $titleHeader; ?><small><?php echo $descHeader ?></small></h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
	<li><a href="<?php echo base_url($currentClass); ?>"><?php echo $currentClass ?></a></li>
	<li class="active"><?php echo $currentAction ?></li>
  </ol>
</section>

<section class="content">
 <div class="box">
 	<div class="box-header with-border">
  		<h3>Listado Clientes</h3>
  		<div class="box-tools pull-right">
  			<a href="#" class="btn btn-default" id="btnback"><i class="fa  fa-backward"></i> Volver</a>
  			<a class="btn btn-default" id="btn_listar" href="#"><i class="fa fa-repeat"></i> Listar</a>
  			<a class="btn btn-default" href="<?php echo base_url(); ?>Cliente/edicion/"><i class="fa fa-edit"></i> Nuevo Cliente</a>
  		</div><!-- .Box Tools -->
  	</div><!-- Box Header -->
  	<div class="box-body">		
		<div class="row">&nbsp;</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12">	
			 <div id="toolbar">
								<div class="form-inline" role="form">
									<div class="form-group"><button id="btn_eliminar" class="btn btn-default">Eliminar</button></div>
									<div class="form-group">
										<span>Limit: </span>
										<input name="limit" class="form-control w70" type="number" value="20">
									</div>
									<div class="form-group">
										<input name="search" class="form-control" type="text" id="search" placeholder="Buscar">
									</div>
									<button id="ok" type="submit" class="btn btn-default">OK</button>
								</div>
			</div>
			<table id="listado_clientes"
							    data-show-columns="true"
							   data-show-refresh="true"
							   data-show-export="true"
							   data-show-pagination-switch="false"	 			   
							   data-onlyInfoPagination="true"
							   data-page-list="[20, 50, 100, 200]" 
							   data-pagination="true"
							   data-side-pagination="server"
							   data-toggle="table"
							   data-query-params="queryParams"
							   data-toolbar="#toolbar"
							   data-method="post"
							   data-response-handler="responseHandler"
							   data-url="<?php echo base_url(); ?>Cliente/ajax_getClientes/">
							   <thead>
									<tr>
										 <th data-checkbox="true">-</th>
										 <th data-field="id"  data-sortable="true" data-formatter="i_cliente" data-align="center">Id.</th>
										 <th data-field="nom_cliente" data-sortable="true" data-align="left">Nombre</th>
										 <th data-field="nom_empresa" data-sortable="true" data-align="left">Empresa</th>
										 <th data-field="rut" data-sortable="true" data-align="left">Rut</th>
										 <th data-field="adr_cliente" data-sortable="true" data-align="left">Correo</th>
										 <th data-field="adr_cliente2" data-sortable="true" data-align="left">Correo 2</th>
										 <th data-field="cant_pedidos" data-sortable="true" data-align="center">Pedidos</th>
									</tr>
								</thead>
			</table>
		</div><!--  col -->
	</div>
	
	</div><!-- Div class box body -->
 </div><!-- .div box -->
</section><!-- /.content -->

</div><!-- /.content-wrapper -->

<script type="text/javascript">

/**
 * Procesa la respuesta del metodo que carga v�a ajax los datos a la tabla.
 */
function responseHandler(res){
	return res;
}
function queryParams(params){
    $('#toolbar').find('input[name]').each(function () {
        params[$(this).attr('name')] = $(this).val();
    });
    return params;
}	
function eliminaTransaccion(id)
{
		/*jQuery.ajax({
				method: "POST",
					url: "<?php echo base_url(); ?>Productos/eliminaProducto/",
					data:{id},
					dataType: 'json'
		});*/		
}


$(document).ready(function() {
	var $table = $('#listado_clientes');
	var $ok = $('#ok');  
	$ok.click(function () {$table.bootstrapTable('refresh');});
	$('#btn_eliminar').click(function () {

		if(confirm('¿ Seguro desea eliminar el cliente ? '))
		{
		var data = $('#listado_clientes').bootstrapTable('getSelections');
		var ids = $.map(data, function (item) {eliminaTransaccion(item['id']);});
		$table.bootstrapTable('refresh');
		}
	});

	$('#btnback').click(function () {
		window.history.back();
	});
}); //Function ready		
</script>
 


	

