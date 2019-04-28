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
  		<h3>Listado Clientes con ordenes de pedido vía Web</h3>
  		<div class="box-tools pull-right">
  			<a href="#" class="btn btn-default" id="btnback"><i class="fa  fa-backward"></i> Volver</a>
  		</div><!-- .Box Tools -->
  	</div><!-- Box Header -->
  	<div class="box-body">		
		<div class="row">
		<div id="toolbar">
            <div class="form-inline" role="form">
                <div class="form-group" >
                    <input name="search" class="form-control input-sm" type="text" placeholder="Buscar">
                </div>
                
                <button  id="ok" type="button" class="btn btn-info input-sm">Ir!</button>
            </div>
        </div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">	
			<table id="listado_clientes_woo"
			
							   data-toolbar="#toolbar"
			   				   data-method="post"
			   				   data-show-refresh="true"
			   				      data-toggle="table"
			   				   data-query-params="queryParams"
			   				   data-response-handler="responseHandler"
			
							   data-url="<?php echo base_url('Woo/listadoClientesWoo/'); ?>">
							   <thead>
									<tr>
										 <th data-field="id"  data-sortable="true" data-align="center" data-formatter="formatoVerDetalle" data-events="eventosTabla">-</th>
										 <th data-field="pedido_fecha"  data-sortable="true" data-align="center">Fecha</th>
										 <th data-field="id_woo"  data-sortable="true" data-align="center">Id Pedido Woo</th>
										 
										 
										 <th data-field="pedido_sistema"  data-sortable="true" data-align="center" data-formatter="f_idpedido">Pedido Interno</th>
										 
										 <th data-field="idcliente" data-sortable="true" data-align="left" data-formatter="i_cliente">Cliente Interno</th>
										 <th data-field="cliente_correo" data-sortable="true" data-align="left">Correo</th>
										 <th data-field="cliente_primer_nombre" data-sortable="true" data-align="left">Nombre</th>
										 <th data-field="cliente_apellido" data-sortable="true" data-align="left">Apellidos</th>
										 <th data-field="cliente_empresa" data-sortable="true" data-align="left">Empresa</th>
										 <th data-field="cliente_direccion" data-sortable="true" data-align="left">Dirección</th>
										 
									</tr>
								</thead>
			</table>
		</div><!--  col -->
	</div>
	
	</div><!-- Div class box body -->
 </div><!-- .div box -->
</section><!-- /.content -->

</div><!-- /.content-wrapper -->



<div class="modal fade" tabindex="-1" role="dialog" id="divpedidowoo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cliente <label id="idclientewoo"></label>, Pedido <label id="iddetallepedidowoo"></label> :</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
          		<div class="col-lg-6 col-md-12 col-xs-12">
          			Id Sistema
          		</div>
          		<div class="col-lg-6 col-md-12 col-xs-12">
          			<p id="p_importarcliente"></p>
          		</div>
          </div>
          <div class="row">
          		<div class="col-lg-6 col-md-12 col-xs-12">
          			Cliente
          		</div>
          		<div class="col-lg-6 col-md-12 col-xs-12">
          			<label id="cliente_primer_nombre"></label>
          		</div>
          </div>
          <div class="row">
          		<div class="col-lg-6 col-md-12 col-xs-12">
          			Correo
          		</div>
          		<div class="col-lg-6 col-md-12 col-xs-12">
          			<label id="cliente_correo"></label>
          		</div>
          </div>
          
          <div class="row">
          	<div class="col-lg-12 col-md-12 col-xs-12">
           				<table id="listado_detallepedido_woo"
    			   				   data-method="post"
    			   				   
    			   				   data-toggle="table"
    			   				   data-query-params="queryParamsDetalle"
    			   				   data-response-handler="responseHandler"
    			
    							   data-url="<?php echo base_url('Woo/detallePedidoWoo/'); ?>">
    							   <thead>
    									<tr>
    										 <th data-field="id_producto_interno"  data-sortable="true" data-align="center">Id interno.</th>
    										 <th data-field="cantidad"  data-sortable="true" data-align="center">cantidad</th>
    										 <th data-field="producto_woo"  data-sortable="true" data-align="center">Producto</th>
    										 <th data-field="precio_costo"  data-sortable="true" data-align="center" data-formatter="PriceFormatter">Costo c/u</th>
    										 <th data-field="precio_venta"  data-sortable="true" data-align="center" data-formatter="PriceFormatter">Neto</th>
    									</tr>
    								</thead>
    					</table>
    		</div>
    	  </div>
      </div><!--  modal body  -->
      <div class="modal-footer">
       	    <button type="button" class="btn btn-default pull-left" id="btn_importar">Importar Pedido</button>
       	    
      	 	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

          
<script type="text/javascript">

$(document).ready(function() {
	//manejador evento que muestra pedido
	window.eventosTabla = {'click .ver': function (e, value, row, index) {muestraPedido(row);}};
	
	$ok = $('#ok');
	$btnimportar = $('#btn_importar');
	$btnback = $('#btnback');
	//$btncliente = $('btn_importar_cliente');
	
	//$btncliente.click(function(){importarClienteWoo();});  
	$btnimportar.prop('disabled', true);
	$ok.click(function () {refrescaResultados($('#listado_clientes_woo'));});
	$btnimportar.click(function () {importarPedidoWoo();});
	$btnback.click(function (){window.history.back();});
}); //Function ready	

function importarPedidoWoo(){

	idpedidowoo = $('#iddetallepedidowoo').val();
	if(confirm('¿ Seguro desea importar desde WooComerce el pedido ' + idpedidowoo +'?' ))
	{
		obj = {idpedidowoo: idpedidowoo};
		jQuery.ajax({
				method: "POST",
					url: "<?php echo base_url(); ?>Pedido/importarPedidoWoo/",
					data: JSON.stringify(obj),
					dataType: 'json',
					success: function(res) {importarPedidoWooCallBack(res);}
		}); //jqueryajax		
	}//confirm
}//importarpedidowoo*/

function importarPedidoWooCallBack(res){

	alert(res.estado);
	if (res.estado!=-1)
	{
		MuestraMensaje("Módulo Pedidos",res.mensaje); 
    	$('#modalDinamico').on('hidden.bs.modal', function () {window.location.href = "<?php echo base_url(); ?>pedido/editarPedido/"+res.id;});
	         							  
		
	}else
	{
		$('#btn_agregar_pedido').prop("disabled",false);
		MuestraMensaje("Módulo Pedidos - ERROR -",res.mensaje); 
		//alert(res.mensaje);
	}
}


function importarClienteWoo(){

	idpedidowoo = $('#iddetallepedidowoo').val();
	if(confirm('¿ Seguro desea importar desde WooComerce el cliente del pedido ' + idpedidowoo +'?' ))
	{
		obj = {idpedidowoo: idpedidowoo};
		jQuery.ajax({
				method: "POST",
					url: "<?php echo base_url(); ?>Cliente/importarClienteWoo/",
					data: JSON.stringify(obj),
					dataType: 'json',
					success: function(res) {importarClienteWooCallBack(res);}
		}); //jqueryajax		
	}//confirm
}//importarpedidowoo

function importarClienteWooCallBack(res){

	
	alert(res.mensaje);
	$('#p_importarcliente').html('');
	var idcliente = res.id;
	if (idcliente != null){
		$('#p_importarcliente').append("<a href='"+base_url+"/cliente/edicion/"+idcliente+"'>"+idcliente+"</a>");
		$btnimportar.prop('disabled', false);
	}
	
}


function muestraPedido(row)
{
	var id = row['id_woo'];
	var nombre = row['cliente_primer_nombre'];
	var correo = row['cliente_correo'];
	var idcliente = row['idcliente'];

	$('#p_importarcliente').html('');
	
	if (idcliente != null){
		$('#p_importarcliente').append("<a href='"+base_url+"/cliente/edicion/"+idcliente+"'>"+idcliente+"</a>");
		$btnimportar.prop('disabled', false);
	}else{
		elhtml = "<button  id='btn_importar_cliente' type='button' class='btn bg-olive' title='Agregar nuevo pedido' ><i class='fa fa-edit'></i> Importar Cliente </button></span>";
		$('#p_importarcliente').append(elhtml);
		$('#btn_importar_cliente').on('click', function () {importarClienteWoo();});
	}
		

	
	$('#iddetallepedidowoo').text(id);
	$('#iddetallepedidowoo').val(id);

	$('#cliente_primer_nombre').text(nombre);
	$('#cliente_correo').text(correo);
	
	refrescaResultados($('#listado_detallepedido_woo'));
	$('#divpedidowoo').modal('show');
}

function refrescaResultados($table){
	$table.bootstrapTable('refresh');
}

/**
 * Procesa la respuesta del metodo que carga vía ajax los datos a la tabla.
 */
function responseHandler(res){
	return res;
}
/**
 * Funcion que setea los parametros.
 */
function queryParams(params) {
	$('#toolbar').find('input[name]').each(function () {
        params[$(this).attr('name')] = $(this).val();
    });
    return params;
}
/**
 * Funcion que setea los parametros de la tabla de detalle
 */
function queryParamsDetalle(params) {
		  params['idwoo'] = $('#iddetallepedidowoo').val();
    return params;
}
</script>
 


	

