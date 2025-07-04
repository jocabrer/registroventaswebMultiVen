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
  <div class="box" id="bx_cliente1">
  		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $descHeader; ?><label id="lbl_id_cliente"></label></h3>
			<div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body" >
			<form role="form" data-toggle="validator" id="frm_cliente">
			<div class="row">
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_nombre" class="control-label">Nombre</label>
					</div><!-- Form group -->
				</div><!-- col.1 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_nombre" placeholder="Ingresar nombre completo" required>
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_correo" class="control-label">Correo</label>
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_correo" placeholder="Ingresar correo electronico." required>
					</div><!-- Form group -->
				</div><!-- col.2 -->
			</div> <!-- row.1 -->
			<div class="row">
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_nombre2" class="control-label">Nombre Alternativo</label>
					</div><!-- Form group -->
				</div><!-- col.1 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_nombre2" placeholder="Nombre completo cliente">
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_correo2" class="control-label">Correo Secundario</label>
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_correo2" placeholder="Correo electr&oacute;nico." required>
					</div><!-- Form group -->
				</div><!-- col.2 -->
			</div> <!-- row.2 -->
			<div class="row">
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_fono1" class="control-label">Fono 1</label>
					</div><!-- Form group -->
				</div><!-- col.1 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_fono1" placeholder="Fono 1">
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_fono2" class="control-label">Fono 2</label>
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_fono2" placeholder="Fono 2">
					</div><!-- Form group -->
				</div><!-- col.2 -->
			</div> <!-- row.2 -->
			<div class="row">
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_rut" class="control-label">Rut Cliente</label>
					</div><!-- Form group -->
				</div><!-- col.1 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_rut" placeholder="Rut Cliente">
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_giro" class="control-label">Giro</label>
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_giro" placeholder="Giro">
					</div><!-- Form group -->
				</div><!-- col.2 -->
			</div> <!-- row.3 -->
			<div class="row">
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_domicilio" class="control-label">Direcci&oacute;n</label>
					</div><!-- Form group -->
				</div><!-- col.1 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_domicilio" placeholder="Direcci&oacute;n">
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-1 col-md-6  col-xs-12">
					<div class="form-group">
						<label for="txt_comuna" class="control-label">Comuna</label>
					</div><!-- Form group -->
				</div><!-- col.2 -->
				<div class="col-lg-5 col-md-6  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_comuna" placeholder="Comuna">
					</div><!-- Form group -->
				</div><!-- col.2 -->
			</div> <!-- row.4 -->
			<div class="row">
				<div class="col-lg-12 col-md-12  col-xs-12">
						<textarea rows="5"  class="form-control" id="txt_observaciones"><?php
						if ($cliEdit['id'] != -1)
						  echo $cliEdit['observaciones']?></textarea>
				</div>
			</div><!--  row 5 -->
			<div class="row">&nbsp;</div>
			<div class="row justify-content-end">
				<div class="col-lg-4 col-md-4 col-xs-12 text-left">
					   <span class="input-group-btn">
                       	 <button id="btn_guardar_cab" type="submit" class="btn btn-default" title="Guardar Cliente" ><i class="fa fa-save"></i> Guardar </button>
                      </span>
				</div>

				<div class="col-lg-4 col-md-4 col-xs-12 text-right">
						<span class="input-group-btn">
                      	&nbsp;
                      </span>
				</div>

				<div class="col-lg-4 col-md-4 col-xs-8 text-right" >
				
									<label>Comisión</label>
									<select id="sl_comision" name="sl_comision" style="width:60px;"> 
											<option value="1">No</option>
											<option value="0">Si</option>
											
									</select>
									<button  id="btn_agregar_pedido" type="button" class="btn bg-olive" title="Agregar nuevo pedido" ><i class="fa fa-edit"></i> Nuevo Pedido </button></span>
				
				  
				 </div>

			</div><!--  row 6 -->
		</form>
		</div><!-- body -->
  </div>




  <!--  detalle de pedidos cliente  -->

  <div class="box" id="bx_clientepedidos">
  		<div class="box-header with-border">
			<h3 class="box-title">Pedidos del cliente</h3>
			<div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body" >
			<div class="row">
				<div class="col-lg-12  col-md-12 col-xs-12"><!--  col 1 -->
				<div class="pad box-pane-right" style="min-height: 100px">
					<table id="tabla_resultado"
						   data-toolbar="#toolbar"
						   data-method="post"

			       		   data-show-footer="false"
			               data-show-columns="true"
			               data-show-refresh="true"
						   data-show-export="true"
						   data-side-pagination="server"

						   data-pagination="true"
						   data-page-list="[10, 25, 50, 100, Todos]"

						   data-toggle="table"
						   data-query-params="queryParams"


						   data-url="<?php echo base_url('Pedido/listadoPedidos/'); ?>">
				     <thead>
			         <tr>
					 		<th data-field="numeroPedido"  data-sortable="true" data-align="center" data-formatter="formatoVerDetalle" data-events="eventosTabla"></th>
							<th data-field="numeroPedido"  data-sortable="true" data-formatter="f_idpedido">Nro.</th>
			                <th data-field="numeroPedido"  data-sortable="true" data-formatter="f_comprobante">Comp.</th>
							<th data-field="cli_id" data-visible="false">id cliente</th>
							<th data-field="cli_nom"  data-visible="false" data-filterby="true"  data-formatter="f_cliente">Cliente</th>
							<th data-field="estado_sec"  data-sortable="true" data-align="left" data-formatter="FormatoEstado">Estado</th>
							<th data-field="comision"  data-sortable="true" data-align="left"  data-formatter="FormatoComision">Comisi&oacute;n</th>
							<th data-field="confactura"  data-sortable="true" data-align="center" data-visible="false">Factura</th>
							<th data-field="est_fec_ing" data-sortable="true" data-visible="true">Ingresado</th>
							<th data-field="est_fec_estactual" data-sortable="true">Fecha Act</th>
							<th data-field="diastranscurridos" data-sortable="true">D&iacute;as T.</th>
							<th data-field="totalAPagar" data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right" >Venta Total</th>
							<th data-field="SaldoCLiente" data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right" >Saldo Cliente</th>
							<th data-field="SaldoVendedor1"  data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right" >Saldo VEN1</th>
							<th data-field="SaldoVendedor2"  data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right" >Saldo VEN2</th>
							<th data-field="SaldoFabrica" data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right" >Saldo F&aacute;brica</th>
			            </tr>
			         </thead>
					</table>
				</div>
			</div>
		</div>
		</div><!-- body -->

  <div class="box-footer">
  	<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 text-left">
  					<a id="btnback" class="btn btn-default"><li class="fa fa-rotate-left"></li> Volver</a>
  				</div>
  	</div>
  </div>



  </div><!-- box 2 -->




</section><!-- /.content -->
</div><!-- /.content-wrapper -->








<div class="modal modal-info" id="divclientes">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Existen los siguientes clientes que coinciden con el correo :</h4>
      </div>
      <div class="modal-body">
        <p id="pclientes">

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="btn_cerrar">Cerrar</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


            	<?php echo $cliEdit['observaciones']?>




<script type="text/javascript">

$(document).ready(function() {
  //Validadores
  $("#txt_correo").change(function() {validaCliente($("#txt_correo").val());});
	$("#txt_nombre2").change(function() {validaCliente($("#txt_nombre2").val());});
	$("#txt_nombre").change(function() {validaCliente($("#txt_nombre").val());});
	$("#txt_correo2").change(function() {validaCliente($("#txt_correo2").val());});
	$("#txt_fono1").change(function() {validaCliente($("#txt_fono1").val());});
	$("#txt_fono2").change(function() {validaCliente($("#txt_fono2").val());});
  $("#txt_rut").change(function(){$('#txt_rut').rut();});



	//manejador evento que elimina pedido.
	window.eventosTabla = {'click .ver': function (e, value, row, index) {
		muestraPedidoVistaPreviaModalRow(row);}};

  //Seteo eventos botones
  $('#btnback').click(function () {window.history.back();});
  $("#btn_cerrar").click(function(){$("#divclientes").hide()});

  //Nuevo pedido hacemos llamada ajax a controlador de Pedidos
	$("#btn_agregar_pedido").click(function(){
		$('#btn_agregar_pedido').prop("disabled",true);
		var comision = $('#sl_comision').val();
		$.ajax({
			  type: "POST",
			  url: "<?php echo base_url('Pedido/grabaCabecera/'); ?>",
			  data: {idpedido:-1,idcliente: '<?php echo $cliEdit['id']?>',comision},
			  success: pedidoGrabadoCall,
			  dataType: 'json'
			});
	});
  //Callback del grabar pedido
  function pedidoGrabadoCall(res){
  	if (res.estado!=-1){
      	MuestraMensaje("Mรณdulo Pedidos",res.mensaje);
      	$('#modalDinamico').on('hidden.bs.modal', function () {window.location.href = "<?php echo base_url(); ?>pedido/editarPedido/"+res.id;});
  	}else{
  		$('#btn_agregar_pedido').prop("disabled",false);
  		alert(res.mensaje);
  	}
  }



	 <?php
	  if ($cliEdit['id'] == -1)
	  {?>$('#btn_agregar_pedido').prop("disabled",true);<?php
	  }else{
	  ?>
	  	$('#lbl_id_cliente').text(<?php echo $cliEdit['id']?>);
	  	$('#txt_nombre').val("<?php echo $cliEdit['nombre']?>");
	  	$('#txt_correo').val("<?php echo $cliEdit['correo1']?>");
	  	$('#txt_nombre2').val("<?php echo $cliEdit['nombre2']?>");
	  	$('#txt_correo2').val("<?php echo $cliEdit['correo2']?>");
	  	$('#txt_fono1').val("<?php echo $cliEdit['fono1']?>");
	  	$('#txt_fono2').val("<?php echo $cliEdit['fono2']?>");
	  	$('#txt_rut').val("<?php echo $cliEdit['rut']?>");
	  	$('#txt_giro').val("<?php echo $cliEdit['giro']?>");
		  $('#txt_domicilio').val("<?php echo $cliEdit['domicilio']?>");
	  	$('#txt_comuna').val("<?php echo $cliEdit['comuna']?>");
 <?php }?>
		$("#frm_cliente").validate({
		    submitHandler: function(form){
    		event.preventDefault();
    		$(':input[type="submit"]').prop('disabled', true);
			    var idcliente   = $("#lbl_id_cliente").text();
        	var txt_nombre 	=  capitalizeFirstLetter($("#txt_nombre").val());
        	var txt_correo = $("#txt_correo").val();
        	var txt_nombre2 = capitalizeFirstLetter($("#txt_nombre2").val());
        	var txt_correo2 = $("#txt_correo2").val();
        	var txt_fono1 = $("#txt_fono1").val();
        	var txt_fono2 = $("#txt_fono2").val();
        	var txt_rut = $("#txt_rut").val();
        	var txt_giro = $("#txt_giro").val();
        	var txt_domicilio = $("#txt_domicilio").val();
        	var txt_comuna = $("#txt_comuna").val();
        	var txt_observaciones = $("#txt_observaciones").val();
			    //valido rut
        	if($.rut.validar(txt_rut)|| txt_rut.length==0 )
        	{
        	    jQuery.ajax({
        		  method: "POST",
        			url: "<?php echo base_url(); ?>Cliente/grabaCliente",
        			dataType: 'json',
        			data: {idcliente,txt_nombre,txt_correo,txt_nombre2,txt_correo2,txt_fono1,txt_fono2,txt_rut,txt_giro,txt_domicilio,txt_comuna,txt_observaciones},
        			success: function(res) {
        						$(':input[type="submit"]').prop('disabled', false);
        						if (res)
        						{
        							  MuestraMensaje("Mรณdulo Clientes",res.mensaje);
        							  $('#modalDinamico').on('hidden.bs.modal', function () {window.location.href = "<?php echo base_url(); ?>Cliente/edicion/"+res.id;});
        						}else
        						{
        							  MuestraMensaje("Mรณdulo Clientes","Error al grabar mensaje ".res.mensaje);
        							  $(':input[type="submit"]').prop('disabled', false);
        						}
        				}
        		}); //jqueryajax
			}//if rut
			else{
				MuestraMensaje("Corregir Rut Cliente", txt_rut);
				$(':input[type="submit"]').prop('disabled', false);
			}

		}
		});//form validate

/* Valida si cliente existe en base a criterio que puede ser*/
function validaCliente($criterio)
{
	//posible input x correo
  if($criterio.length>4){

    var criterio=$criterio;
  	obj = {search: criterio, order: "asc", limit: "20", offset: 0};
  	$.ajax({
  		  type: "POST",
  		  url: base_url+'Cliente/ajax_getClientes/',
  		  data: JSON.stringify(obj),
  		  success: clientesExistentesCall,
  		  dataType: 'json'
  		});
  }
}

function clientesExistentesCall(res){

	var url = base_url+"Cliente/edicion/";

	$("#pclientes").html("");

	var jsonData = res.rows;


	if(jsonData.length>0){
    	for (var i = 0; i < jsonData.length; i++) {
    	    var idcliente = jsonData[i].id;
    	    var nombre =  pad(jsonData[i].nom_cliente, 100, "&nbsp;");
    	    var correo = pad(jsonData[i].adr_cliente,100," ");
    	    $("#pclientes").append("<a href='"+url+""+idcliente+"'>"+idcliente+"-"+nombre+"        "+correo+"</a><br>");
    	}
	$("#divclientes").modal('show');
	}
}

}); //Function ready
/**
 * Funcion que setea los parametros.
 */
function queryParams(params) {
	var cliente = '<?php echo $cliEdit['id']?>';
	params['cliente'] = cliente;
        params['limit'] = 50;
    return params;
}

</script>
var nombre = jsonData[i].nombre;
