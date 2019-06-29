<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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

		<section class="content">
			<div class="box">
				<div class="box-header with-border" style="min-height:100px;">
					<h3>Listado Productos</h3>
					<div class="bg-teal color-palette" id="modalDinamicoIL" stuyle="display:block">
                           Cuerpo  
                     </div>
					<div class="box-tools pull-right">
					       <!-- Modal inline -->
                          
						<a class="btn btn-app" id="btn_listar" href="#"><i class="fa fa-repeat"></i> Listar</a>
						<a class="btn btn-app" href="<?php echo base_url(); ?>Productos/agregar/"><i class="fa fa-edit"></i> Nuevo Producto</a>
					</div><!-- .Box Tools -->
				</div><!-- box header -->
				<div class="box-body">
							  <div class="form-inline" role="form" id="toolbar">
									 <div class="form-group">
									 		<span>Categoria</span>
        									<select id="cntrl_categoria_prod"  
        								    class="form-control" 
        								    name="cntrl_categoria_prod" 
        								    data-error="Seleccione una categoria!" required>
        								    <option value="0">Todas</option>
        								    
        								   
            								    <?php 
            								    foreach($categorias as $cat){
            								       
            								        echo "<option value='".$cat["id"]."' >".$cat["nom_categoria"]."</option>";
            								    }
            								    ?>
            								    
            								    
            								    </select>
									</div>
									
									<div class="form-group">
										<span>Limite: </span>
										<input name="limit" class="form-control w70" type="number" value="50">
									</div>
									<div class="form-group">
										<input name="search" class="form-control" type="text" id="search" placeholder="Buscar">
									</div>
									<button id="ok" type="submit" class="btn btn-default">OK</button>
										<div class="form-group"><button id="btn_eliminar" class="btn btn-default">Eliminar</button></div>
								
							</div>
							
							
							 <table id="listado_prod"
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
									   data-url="<?php echo base_url(); ?>Productos/ajax_getProductos/">
									<thead>
									<tr>
										 <th data-checkbox="true">-</th>
										 <th data-field="id"  data-sortable="true" data-formatter="i_prod" data-align="center">Id.</th>
										 <th data-field="nom_categoria"  data-sortable="true" data-align="left">Categoria</th>
										 <th data-field="Codigo" data-sortable="true" data-align="center" data-editable="true">C&oacute;digo</th>
										 <th data-field="Nombre"  data-sortable="true" data-align="left" data-editable="true">Nombre</th>
										 <th data-field="valor_venta"  data-sortable="true" data-align="right"  data-editable="true">Valor venta</th>
										 <th data-field="costo"  data-sortable="true" data-align="right"    data-editable="true" >valor costo</th>
										 <th data-field="ganancia" data-sortable="true"  data-align="right" data-formatter="PriceFormatter" >Ganancia</th>
									</tr>
									</thead>
							</table>
				</div> <!-- box body -->
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
    params["categoria"] =$("#cntrl_categoria_prod").val()
    return params;
}	
function eliminaTransaccion(id)
{
		jQuery.ajax({
				method: "POST",
					url: "<?php echo base_url(); ?>Productos/eliminaProducto/",
					data:{id},
					dataType: 'json'
		});		
}

function actualizarProducto(editable, field, row, oldValue, $el){

	var id 				= row.id;
	var Nombre 			= row.Nombre;
	var valor_venta		= row.valor_venta;
	var costo			= row.costo;
	var codigo			= row.Codigo
	
	jQuery.ajax({
		method: "POST",
			url: "<?php echo base_url(); ?>Productos/actualizaProducto",
			dataType: 'json',
			data: {id,Nombre,valor_venta,costo,codigo},
			success: productoActualizado
			});

}

function productoActualizado(res)
{
	MuestraMensajeIL("M�dulo Pedidos",res.mensaje); 
}

function MuestraMensajeIL(titulo,msje)
{
    var modal = $('#modalDinamicoIL');
    modal.html(msje)
    modal.show();
    modal.hide(5000);

}


$(document).ready(function() {

	$.fn.editable.defaults.mode = 'inline';

	$('#modalDinamicoIL').hide()

	
	var $table = $('#listado_prod');
	var $ok = $('#ok');  


	$table.on('editable-save.bs.table', actualizarProducto);
	
	$ok.click(function () {$table.bootstrapTable('refresh');});


	$('#btn_eliminar').click(function () {

		if(confirm('¿ Seguro desea eliminar el producto ? '))
		{
		var data = $('#listado_prod').bootstrapTable('getSelections');
		var ids = $.map(data, function (item) {
			eliminaTransaccion(item['id']);
		});
		$table.bootstrapTable('refresh');
		}
	});


	
});		
</script>
 


	

