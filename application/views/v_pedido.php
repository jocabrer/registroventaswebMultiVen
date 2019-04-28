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
 	<div class="box" id="bx_cliente">
		<form role="form" data-toggle="validator" id="frm_pedido">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $descHeader; ?><label id="lbl_id_pedido"></label></h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-default" id="btn_agregar_nota" title="Agregar nota pedido">
								
								<?php if($pedEdit['nota']=="")
								  echo '<i class="fa fa-fw  fa-file-o"></i>';
								 else
								 echo '<i class="fa fa-fw  fa-file-text-o"></i>';
							     ?>	
						</a>
						<a class="btn btn-default"  title="Ver comprobante" href="<?php echo base_url(); ?>Comprobante/verComprobante/<?php echo $pedEdit['id'];?> " target="blank"><i class="fa fa-fw fa-print"></i> </a>
						<a class="btn btn-default" title="Ver seguimiento de pedido" href="<?php echo base_url('seguimiento/ver/'.$pedEdit['id'].'/'.$pedEdit['cli_id']); ?>" target="blank"><i class="fa fa-fw fa-tasks"></i>Ver Seguimiento</a>
						
					</div>
				</div>
		<div class="box-body">

		<div class="row">
			<div class="col-lg-4 col-md-12 col-xs-12">
   					<div class="form-group">
								 <?php  echo "<a href='".base_url('Cliente/edicion/'.$cliente['id'])."'>"; 
								        echo $cliente['nombre'];
								        echo "</a>";
                                 ?>
                                 <br/>
								 <?php 
								 echo $cliente['correo1'];
								 ?>
								  <br/>
								 <?php 
								 echo $cliente['fono1'];
								 ?>											        
								 <br>
								 Fecha Ingreso : <?php echo $pedEdit['est_fec_ing']; ?>
								 <br>
								 (<?php echo $pedEdit['diastranscurridos']; ;?>) d&iacute;as h&aacute;biles transcurridos.
					</div>
			</div><!-- col1 -->
			<div class="col-lg-4 col-md-12  col-xs-12">
			   <div class="form-group">
					 <label>Estado: Desde hace <?php echo $pedEdit['diasCambioEstado']; ?> d&iacute;as.</label>
					 
					 <select style="width:100%;"  id="sl_estado"  class="form-control">
									<?php
										  foreach($vEstados  as $est) {
											$sltd = "";
											if ($pedEdit['estado_sec'] == $est['secuencia'])
												$sltd = " selected "					  		
										  ?>
										  <option value="<?php echo $est['secuencia'];?>" <?php echo $sltd; ?>><?php echo $est['descripcion']; ?></option>
									<?php } ?>  	
								  </select>
			   </div><!--form-group  -->
			 </div><!-- Col3 -->
			 
			 <div class="col-lg-4 col-md-12  col-xs-12">
			   <div class="box-body no-padding">
			 
			 
				                    <label id="lbl_comision">Comisi&oacute;n</label>
				                    <a href="#" id="btn_agregar_comision"title="[+]" >[+]</a>
				                    <br/>
									<!--  <input type="checkbox" id="chk_comision">-->
									<table id="table_comision" class="table"></table>	                    
			
			  </div><!--form-group  -->
			 </div><!-- Col4 -->
			 	                    
		</div><!-- Row1 --> 
		
		</div><!-- /.box-body -->
		
		<div class="box-footer" style="text-align:left;">
    			<a id="btnback" class="btn btn-default"><li class="fa fa-rotate-left"></li> Volver</a>
    	</div>
    		
		
	</form>	
	</div><!-- BOX 1 bx_cliente  -->
	
	<form role="form" data-toggle="validator" id="frm_det_pedido">
	<div class="box" id="bx_agregardetalle"><!-- BOX 2 -->
		<div class="box-header with-border" >
	 			<h3 class="box-title">Detalle Pedido</h3>
	 			<div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-2 col-md-2  col-xs-12">
					<div class="form-group">
						<input type="text" class="form-control" id="txt_cantidad" placeholder="Cantidad" required>
					</div>
				</div>
				<div class="col-lg-4 col-md-4  col-xs-12">
					<div class="form-group">												
					<select id="cntrl_id_producto"  class="form-control" name="cntrl_id_producto" data-error="Seleccione un Producto" required></select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3  col-xs-12"><!--  col 3 -->
					<div class="form-group has-feedback">												
						<input type="text" class="form-control" id="txt_costoventa" placeholder="Costo venta" required>
						<span class="glyphicon glyphicon-chevron-down form-control-feedback"></span>
					</div>
					</div>
				<div class="col-lg-3 col-md-3  col-xs-12"><!--  col 3 -->
					<div class="form-group has-feedback">																				
						<input type="text" class="form-control" id="txt_precioventa"  placeholder="Precio venta" required>
						<span class="glyphicon glyphicon-chevron-up form-control-feedback"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10  col-md-10 col-xs-4"><!--  col 1 -->
					<a href="<?php echo base_url(); ?>Productos/agregar" target="blank">Agregar Producto</a>
				</div>
				<div class="col-lg-2  col-md-2 col-xs-8 text-right" ><!--  col 2 -->
					<button  id="btn_guardar_det" type="submit" class="btn btn-default" title="Guardar" ><i class="fa fa-save"></i> Guardar Detalle</button>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12  col-md-12 col-xs-12"><!--  col 1 -->
				<div class="pad box-pane-right" style="min-height: 100px">
					<table id="tabla_detalle">
					</table> 
				</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-8 col-md-7 col-xs-12">
					&nbsp;
				</div>
				<div class="col-lg-4 col-md-5 col-xs-12">
						<div class="table-responsive">
						<table class="table no-margin">
				                  <tbody><tr>
				                    <th style="width:50%">Subtotal:</th>
				                    <td><label id="lbl_subtotal"></label></td>
				                  </tr>
				                  <tr>
				                    <th>
									<input type="checkbox" id="chk_iva">I.V.A</th>
				                    <td><label id="lbl_iva"></label></td>
				                  </tr>
				                  <tr>
				                    <th>TOTAL A PAGAR:</th>
				                    <td><label id="lbl_totalapagar"></label></td>
				                  </tr>
								  
								  <tr>
				                    <th>Abonado:</th>
				                    <td><label id="lbl_totalabonocliente"></label></td>
				                  </tr>
								  
								  
								  <tr>
				                    <th>SALDO A PAGAR:</th>
				                    <td><label id="lbl_totalsaldocliente"></label></td>
				                  </tr>
								  
								 
				        </tbody>
				        </table>
				        </div><!-- Div class table -->     
				</div>
	</div><!-- row -->
		</div> <!-- Box Body -->
	</div><!-- bx_detalle -->
	</form><!-- frm_detalle -->
	
	
	<div class="box" id="bx_caja">
	<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12">
						
					
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="box-title">Movimiento Cuentas</h3>
								<a href="<?php echo base_url(); ?>Cuenta/verdetallemovimientos/<?php echo $pedEdit['id'];?>">Detalles</a>
								<div class="box-tools pull-right"><button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								 <a href="#" id="btn_agregar_caja"title="[+]" ><i class="fa fa-fw fa-plus"></i></a>
								</div>
							</div>
							<div class="box-body">
								
						
						
						
								<div class="row">
									
									 
									<div class="col-lg-12 col-md-12  col-xs-12">
										<div class="pad box-pane-right" style="min-height: 100px">
										
										<table class="table" id="tb_resumen_cta"></table>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-12  col-xs-12">
									<div class="table-responsive">
										<table class="table">
										<tbody>
												  <tr>
													<th style="width:50%">Costo Total:</th>
													<td><label id="lbl_totalCosto"></label></td>
												  </tr>
												   <tr>
													<th style="width:50%">Ganancia Total:</th>
													<td><label id="lbl_totalganancia"></label></td>
												  </tr>
										</tbody>
										</table>
									</div><!-- Div class table -->
									</div><!-- Col  -->													
									<div class="col-lg-6 col-md-12  col-xs-12">
									<div class="table-responsive">
										<table class="table" id="tbl_vendedores">
										<tr>
                                                    <th colspan="2" style="text-align:center;">Comisiones</th>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="2">
                                                    	<p id="p_comisiones"></p>
                                                    </td>
                                                  </tr>
										</table>
									</div><!-- Div class table -->
									</div><!-- Col  -->
								</div><!-- row -->
							</div><!-- box-body -->
						</div><!--  box danger -->
					
						
				</div><!-- COlumna  -->
	</div><!-- row -->
	</div><!-- bx_caja -->

<div class="box box-warning direct-chat direct-chat-warning box-default " id="bx_seguimiento">
<div class="box-header with-border">
	<h3 class="box-title">Seguimiento</h3>
    <div class="box-tools pull-right">
         <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div><!-- tools -->
</div><!-- /.box-header -->
<div class="box-body" id="bx_bd_seguimiento">
<div class="direct-chat-messages">
<?php 
    foreach($comm  as $c) {
	   if ($c['id_user']==1){
?>
<!-- A la izquierda -->
	<div class="direct-chat-msg">
			<div class="direct-chat-info clearfix">	
				<span class="direct-chat-name pull-left"><?php echo $c['nombre'];?></span>									
			 	<span class="direct-chat-timestamp pull-right"><?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime("%A, %d de %B de %Y a las %H:%M:%S",strtotime($c['fecha_mod']));?></span>
			</div><!-- /.direct-chat-info -->
			<img class="direct-chat-img" src="<?php echo base_url('Template/dist/img/user/'.$c['id_user'].'.jpg'); ?>" 
				alt="message user image"><!-- /.direct-chat-img -->
			 <div class="direct-chat-text"><?php echo $c['comentario'];?></div><!-- /.direct-chat-text -->
	</div><!-- /.direct-chat-msg -->
	<?php  
		}else{
	?>		

<!-- A la derecha -->
     <div class="direct-chat-msg right">
			  <div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-right"><?php echo $c['nombre'];?></span>
				<span class="direct-chat-timestamp pull-left"><?php setlocale(LC_TIME, 'es_ES.UTF-8'); echo strftime("%A, %d de %B de %Y a las %H:%M:%S",strtotime($c['fecha_mod']));?></span>
			  </div><!-- /.direct-chat-info -->
			  <img class="direct-chat-img" src="<?php echo base_url('Template/dist/img/user/'.$c['id_user'].'.jpg'); ?>" alt="message user image"><!-- /.direct-chat-img -->
			  <div class="direct-chat-text">
				<?php echo $c['comentario'];?>
			  </div><!-- /.direct-chat-text -->
			</div><!-- /.direct-chat-msg -->

	<?php	}//fin else	?>	
	<?php } //fin loop foreach ?>
	
		 </div><!--/.direct-chat-messages-->
		 	               
</div><!-- /.box-body -->
<div class="box-footer">
  <form role="form" data-toggle="validator" id="frm_shout">
  <div class="input-group">
     <input type="text" id="txt_comentario" placeholder="Escribe un mensaje ..." class="form-control">
     <span class="input-group-btn">
         <button  type="submit" class="btn btn-warning btn-flat">Enviar</button>
     </span>
  </div> <!-- Input group -->
  </form>
</div><!-- /.box-footer-->
</div>


</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!--  Fila comision -->
<div class="modal fade" tabindex="-1" role="dialog" id="div_comision">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form role="form" data-toggle="validator" id="frm_comision">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Comisi&oacute;n</h4>
      </div>
      <div class="modal-body">
      
      		<div class="row">
					<div class="col-lg-3 col-md-3  col-xs-12">
						<label>Cuenta Comisi&oacute;n</label>
					</div>
					<div class="col-lg-3 col-md-3  col-xs-12">
						<select class="form-control" id="cntrl_id_cta_comision_ingcomi"></select>
					</div>
					<div class="col-lg-3 col-md-3  col-xs-12 right">
						<label>Porcentaje</label>
					</div>
					<div class="col-lg-3 col-md-3  col-xs-12">
						<input type="text"  class="form-control"   id="txt_porcentaje"> 
						
					</div>
			</div><!-- row -->
      
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" type="submit">Grabar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal caja -->
<div class="modal fade" tabindex="1" role="dialog" id="div_agregarcaja">
<form role="form" data-toggle="validator" id="frm_caja">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form role="form" data-toggle="validator" id="frm_caja">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Movimiento</h4>
      </div>
      <div class="modal-body">
	       
			
				
				<div class="table">
				<div class="row">
							<div class="col-lg-3 col-md-3 col-xs-3">
								<div class="form-group">
									<label>Glosa</label>
								</div>		
							</div>
							
							<div class="col-lg-9 col-md-9 col-xs-9">
								<!--  <input type="text" class="form-control" id="txt_glosa" placeholder="Glosa" required>-->
								<select class="form-control" id="txt_glosa" style="width:100%">
									<option>Ingreso Transferencia</option>
									<option>Ingreso Presencial</option>
									<option>Reembolso</option>
									<option>Movimiento Interno</option>
									<option>Otro</option>
								</select>										
							</div>
				</div>
				<div class="row">							
							<div class="col-lg-3 col-md-3 col-xs-3">
								<div class="form-group">
									<label>Monto</label>
								
								</div>		
							</div>
							<div class="col-lg-9 col-md-9 col-xs-9">
									<input type="text" class="form-control" id="txt_monto" placeholder="monto" required>
							</div>
				</div>
				<div class="row">							
							<div class="col-lg-3 col-md-3 col-xs-3">
									<label>Cta origen.</label>
							</div>
							<div class="col-lg-9 col-md-9 col-xs-9">
								<select class="form-control" id="cntrl_id_cta" style="width:100%"></select>	
							</div>
				</div>
				<div class="row">							
							<div class="col-lg-3 col-md-3 col-xs-3">
									<label>Cta Destino.</label>
							</div>
							<div class="col-lg-9 col-md-9 col-xs-9">
									<select class="form-control" id="cntrl_id_cta_destino" style="width:100%"></select>	
																	
							</div>
						</div>
						
				</div>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
       <button  id="btn_guardar_caja" type="submit" class="btn btn-default" title="Guardar" ><i class="fa fa-save"></i> Grabar Movimiento</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </form><!-- frm caja -->
</div><!-- /.modal -->
		




<!-- Modal nota -->
<div class="modal fade" tabindex="1" role="dialog" id="div_agregarnota">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <!--  <form  data-toggle="validator" id="frm_nota" >-->
     <!--<form  enctype="multipart/form-data" accept-charset="utf-8" id="frm_nota">-->
     <form enctype="multipart/form-data" role="form" data-toggle="validator" id="frm_nota" method="post">
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar adjunto</h4>
      </div>
      <div class="modal-body">
	       
	       <div class="form-group">
	       	<input type="checkbox" id="chk_publico">Publico</th>
	       </div>
	       
	       
	       <div class="form-group">
    	       <select id="sl_tipo">
    	       		<option value="FACT">Factura</option>
    	       </select>
	       </div>
	       <br>
	       	
	       
			
			<div class="form-group">
						<input type="text" class="form-control" id="txt_nombre" placeholder="Nombre">	
			</div><!-- Form group -->
			
			
			<div class="form-group">
						<input type="text" class="form-control" id="txt_url" placeholder="url">	
			</div><!-- Form group -->
			
			<div class="form-group">
				<textarea id="txt_mensaje" name="txt_mensaje" rows="10" cols="80" placeholder="mensaje"></textarea>
			</div>
			
			<div class="form-group">
			<input type="file" name="userfile" id="userfile" size="20" />
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
       <button  id="btn_guardar_nota" type="submit" class="btn btn-default" title="Guardar Nota" ><i class="fa fa-save"></i> Grabar Nota</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->		
            
<script type="text/javascript">
$(document).ready(function() {

	$.fn.editable.defaults.mode = 'inline';
	$("#btn_agregar_comision").click(function(){
	    $("#div_comision").modal('show');
	});
	
	$("#btn_agregar_caja").click(function(){
	    $("#div_agregarcaja").modal('show');
	});

	$("#btn_agregar_nota").click(function(){
		$(':input[type="submit"]').prop('disabled', false);
	    $("#div_agregarnota").modal('show');
	});

	$("#sl_estado").change(function () {

		var estado = $('#sl_estado').val();
		var idpedido 	=   <?php echo $pedEdit['id'];?>;
		jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Pedido/cambiadEstadoPedidoPost",
						dataType: 'json',
						data: {idpedido,estado},
						success: function(){
							MuestraMensaje("Módulo Pedidos","Estado cambiado correctamente "); 
						}
			}); //jqueryajax				
	 });

	
	$('#lbl_id_pedido').text(<?php echo $pedEdit['id']?>);

	<?php if ($pedEdit['ConFactura']==1){ ?>
	  		$('#chk_iva').prop('checked', true);
    <?php } //else confactura ?>

	<?php if ($pedEdit['comision']==1){ ?>
  		$('#chk_comision').prop('checked', true);
   	<?php } ?>

	$('#bx_infooter').show();
		
	$('#lbl_id_pedido').show();
	$('#bx_detalle').show();
	$('#bx_agregardetalle').show();
	$('#bx_seguimiento').show();
	$('#bx_caja').show();
		
	buscaLineaDetalle ();
	buscaComisiones();
		
	//Foprmateop de divisas para inputs
	$('#txt_costoventa').priceFormat({
	    prefix: '$ ',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
	    centsLimit: 0
	});
	$('#txt_precioventa').priceFormat({
	    prefix: '$ ',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
	    centsLimit: 0
	});

	$('#txt_monto').priceFormat({
	    prefix: '$ ',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
	    centsLimit: 0
	});

    function serverContaCall()
    {
        var idpedido = <?php echo $pedEdit['id'];?> ;
    	jQuery.ajax({
			method: "POST",
				url: "<?php echo base_url(); ?>Pedido/obtieneIndicadoresExtendidos",
				dataType: 'json',
				data: {idpedido},
				success: function(res){serverContaBack(res);}
		}); //jqueryajax				
    } 

    function serverContaBack(res)
    {
$("#p_comisiones").html('');
		
		if(res!=null)
        {

			for (var i = 0; i < res.length; i++){
				
			    var r = res[i];

			    if(i==0){
			    	$('#lbl_subtotal').text(PriceFormatter(r.Subtotal));
		        	$('#lbl_iva').text(PriceFormatter(r.iva));
		        	$('#lbl_totalapagar').text(PriceFormatter(r.totalAPagar));
		        	$('#lbl_totalabonocliente').text(PriceFormatter(r.PagadoCliente));
		        	$('#lbl_totalsaldocliente').text(PriceFormatter(r.SaldoCliente));
		    
		        	$('#lbl_totalCosto').text(PriceFormatter(r.CostoTotal));
		        	
		        	$('#lbl_totalganancia').text(PriceFormatter(r.Ganancia100));
		        	
			    }

			    	$("#p_comisiones").append("<b>"+r.NombreVendedor+"</b>&nbsp;<i>Quedan </i>"+PriceFormatter(r.SaldoVendedor)+"<i> de</i> " +PriceFormatter(r.TotalVendedor)+" <br>");
			    
			}
	        
        	
        }
        /*if(res[0]!=null)
        {
        	$('#lbl_subtotal').text(PriceFormatter(res[0].Subtotal));
        	$('#lbl_iva').text(PriceFormatter(res[0].iva));
        	$('#lbl_totalapagar').text(PriceFormatter(res[0].totalAPagar));
        	$('#lbl_totalabonocliente').text(PriceFormatter(res[0].PagadoCliente));
        	$('#lbl_totalsaldocliente').text(PriceFormatter(res[0].SaldoCliente));
    
    
        	$('#lbl_totalCosto').text(PriceFormatter(res[0].CostoTotal));
        	
        	$('#lbl_totalganancia').text(PriceFormatter(res[0].Ganancia100));
        }*/
    }

	/*
	* Evento que controla la opcion de pedido con factura.
	*/
	$('#chk_iva').change(function () {
		
		var idpedido 	=   <?php echo $pedEdit['id'];?> //$("#numeroPedido").val();
		var chk_iva_val 	=  $("#chk_iva").is(':checked');
		
		jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Pedido/ActualizaCF",
						dataType: 'json',
						data: {idpedido,chk_iva_val},
						success: function(res){buscaLineaDetalle ();}
			}); //jqueryajax				
	 });
	/* Control busqueda de producto */ 
	$( "#cntrl_id_producto" ).change(function() {
		
		var idprod = $( "#cntrl_id_producto" ).val();
		
		jQuery.ajax({
					method: "GET",
						url: "<?php echo base_url(); ?>Productos/ObtieneProductoPorId/"+idprod,
						dataType: 'json',
						
						success: function(res) {
									
									$('#txt_precioventa').val(PriceFormatter(res[0].valor_venta));
									$('#txt_costoventa').val(PriceFormatter(res[0].costo));
									
									
									
							}
			}); //jqueryajax		  
	});
	// FIN inicio-----------------------------------------------------------------
	
	function eliminaComision(row)
	{
		var id = row['id'];
		jQuery.ajax({
			method: "POST",
				url: "<?php echo base_url(); ?>Cuenta/eliminaComision/",
				data:{id},
				dataType: 'json',
				success: function(res) {buscaComisiones ();buscaLineaDetalle();}
	}); //jqueryajax	
	}
	
	/*Funcion elimina linea de detalle de un pedido.*/
	function eliminaDetallePedido(row)
	{
		var id_detalle = row['id'];
		
		var cantidad = row['cantidad'];
		var desc_prod = row['desc_prod'];
		
		if(confirm('¿ Seguro desea eliminar la linea de detalle ' + cantidad +  ' de ' + desc_prod +'?' ))
		{
			jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Pedido/EliminaLineaDetalle/",
						data:{id_detalle},
						dataType: 'json',
						success: function(res) {buscaLineaDetalle ();}
			}); //jqueryajax		
		}
	}


	
 

	
	function buscaLineaDetalle ()
	{
		
		$("#div_agregarcaja").modal('hide');
		
		window.eventosTablaDetalle = {
		        'click .remove': function (e, value, row, index) {
						eliminaDetallePedido(row);
		        }	
				};
	   /*window.eventosTablaCaja = {
	    'click .remove': function (e, value, row, index) {
		        eliminaMovCaja(row);
        }
		};*/
	  var idpedido 	=  <?php echo $pedEdit['id'];?> //$("#numeroPedido").val();
   	  $('#tabla_detalle').bootstrapTable('destroy').bootstrapTable
   	  ({
			    url: '<?php echo base_url(); ?>Pedido/ajax_getLinesPedido/' + idpedido,
			    onLoadSuccess: function (res) {serverContaCall();},
			    data:{idpedido:idpedido},
				method: "GET",
				columns:[
							{field: 'id',title: 'ID'},
							{field: 'cantidad',title: 'Qty'},
							{field: 'nom_prod',title: 'Desc.'}, 
							{field: 'venta_un',title: 'Venta',align: 'right',formatter: PriceFormatter},
							{field: 'costo_un',title: 'Costo',align: 'right',formatter: PriceFormatter},
							{field: 'det_venta',title: 'Total Venta',align: 'right',formatter: PriceFormatter},
							{field: 'det_costo',title: 'Total Costo',align: 'right',formatter: PriceFormatter},
							{field: 'det_ganancia',title: 'Ganancia',align: 'right',formatter: PriceFormatter},
							{field: 'operate',title: 'Acción',align: 'center',events: eventosTablaDetalle,formatter:operateFormatter}
                    
							
				]
        });
		
	
   	  $('#tb_resumen_cta').bootstrapTable('destroy').bootstrapTable
 	  ({
			    url: '<?php echo base_url(); ?>Cuenta/ResumenCuentaPedido/' + idpedido,
				onLoadSuccess: function (res) {serverContaCall();},
			    data:{idpedido:idpedido},
				method: "GET",
				columns:[
							{field: 'nombre_cta',title: 'Cta.'},
							{field: 'debe',title: 'Debe',formatter: PriceFormatter},
							{field: 'haber',title: 'Haber',formatter: PriceFormatter},
							{field: 'saldo',title: 'Saldo',formatter: PriceFormatter}
				]
       });
   	
	}

	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	$('#table_comision').on('editable-save.bs.table', actualizarComision);
	
	function buscaComisiones(){
		window.eventosTablaComision = {
		        'click .remove': function (e, value, row, index) {
						eliminaComision(row);
		        }	
				};
		
		 $("#div_comision").modal('hide');
		 var idpedido 	=  <?php echo $pedEdit['id'];?> //$("#numeroPedido").val();
	   	  $('#table_comision').bootstrapTable('destroy').bootstrapTable
	   	  ({
				    url: '<?php echo base_url(); ?>Cuenta/MuestraComision/'+idpedido,
				    method:"GET",
					dataType: 'json',
					columns:[
								{field: 'id',title: 'id.', visible:false},
								{field: 'nom_cta',title: 'Cuenta.'}, 
								{field: 'porcentaje',title: 'Porcentaje',align: 'right',editable:true},
								{field: 'operate',title: 'Acción',align: 'center',events: eventosTablaComision,formatter:operateFormatter}
					]
	        }
        	);
	}
	
	$("#frm_comision").validate({
		submitHandler: function(form){
			//TODO validacion antes de grabar
			$(':input[type="submit"]').prop('disabled', true);
			var porcentaje 	=  $("#txt_porcentaje").val();
			var cta = $("#cntrl_id_cta_comision_ingcomi").val();
			
			//alert(cta_des);
			var idcabecera =   <?php echo $pedEdit['id'];?>//$("#numeroPedido").val();
			
			jQuery.ajax({
				method: "POST",
					url: "<?php echo base_url(); ?>Cuenta/insertaComision",
					dataType: 'json',
					data: {cta,porcentaje,idcabecera},
					success:comisionActualizada
				}); //jqueryajax
			
			}//function				
	});//frm_comision	


	//Evento editable de la comision
	function actualizarComision(editable, field, row, oldValue, $el){

		/*console.log(row);
		console.log(field);
		console.log(oldValue);
		console.log($el);*/

		var idcomision 	=   row.id;
		var nuevoPorcentaje	= row.porcentaje;
		var idcabecera =   <?php echo $pedEdit['id'];?>//$("#numeroPedido").val();

		if(nuevoPorcentaje > 100)	
			//alert("El porcentaje ingresado es mayor a 100!, favor corregir.");
		    MuestraMensaje("Error en la comisión","El porcentaje ingresado es mayor a 100!, favor corregir."); 
		else{
				jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Cuenta/ActualizaPorcentaje",
						dataType: 'json',
						data: {idcomision,nuevoPorcentaje,idcabecera,oldValue},
						success: comisionActualizada
						});
		}
	};


	function comisionActualizada(res)
	{
		$(':input[type="submit"]').prop('disabled', false);
		//alert(res);
		if (res.estado!=-1)
		{
			//alert("Comision Ingresado.");
			MuestraMensaje("Módulo Comisión","Comisión ingresada correctamente."); 
		}else
		{
			MuestraMensaje("Módulo Comisión",res.mensaje); 
		}
		buscaComisiones();
		buscaLineaDetalle();
	}
	
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/	
	// formulario caja , movimieno
	$("#frm_caja").validate({
  				submitHandler: function(form){
				//TODO validacion antes de grabar
				$(':input[type="submit"]').prop('disabled', true);
				var txt_monto 	=  $("#txt_monto").unmask();
				var cta = $("#cntrl_id_cta").val();
				var cta_des = $("#cntrl_id_cta_destino").val();
				var glosa = $("#txt_glosa").val();
				//alert(cta_des);
				if (cta_des == null)
					cta_des = -1;
				var idcabecera =   <?php echo $pedEdit['id'];?>//$("#numeroPedido").val();
				if (txt_monto!="")
				{
				jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Cuenta/insertaTransaccion",
						data: {txt_monto,cta,cta_des,idcabecera,glosa},
						success: function(res) {
									$(':input[type="submit"]').prop('disabled', false);
									if (res)
									{
										MuestraMensaje("Módulo Caja","Ingreso realizado"); 
									}else
									{
										MuestraMensaje("Módulo Caja","Error: "+ res); 
									}
									buscaLineaDetalle ();
							}
					}); //jqueryajax
  				}
				}				
	});	
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/
	/*==============================================================================================================================================================================*/	
	// formulario nota
	$("#frm_nota").validate({
  				submitHandler: function(form){
				//TODO validacion antes de grabar
				event.preventDefault();
			
				var txt_mensaje = $("#txt_mensaje").val();
				var txt_nombre = $("#txt_nombre").val();
				//var txt_url = $("#txt_url").val();
				var sl_tipo = $("#sl_tipo").val();
				var chk_publico = $("#chk_publico").is(':checked');
				var userfile =$("#userfile").val();

				
				var idcabecera =   <?php echo $pedEdit['id'];?>;


				 var form_data = new FormData();                  
				form_data.append('txt_mensaje', txt_mensaje);
				form_data.append('txt_nombre', txt_nombre);
				//form_data.append('txt_url', txt_url);
				form_data.append('sl_tipo', sl_tipo);
				form_data.append('idcabecera', idcabecera);
				form_data.append('chk_publico', chk_publico);
				form_data.append('userfile', userfile);

				    
				$(':input[type="submit"]').prop('disabled', true);
				



				 $.ajax({
		                url: "<?php echo base_url(); ?>Pedido/grabaAdjunto",
		                type: "post",
		                dataType: "html",
		                data: form_data,
		                cache: false,
		                contentType: false,
			     processData: false
		            })
		                .done(function(res){
		                   alert(res);
		                });


	                
  				}
						
	});	
	
	//formulario seguimiento, comentarios
	$("#frm_shout").validate({
  				submitHandler: function(form){

				$(':input[type="submit"]').prop('disabled', true);	
				//TODO validacion antes de grabar
				event.preventDefault();
				var idpedido 	=  <?php echo $pedEdit['id'];?>//$("#numeroPedido").val();
				var comm           =  $("#txt_comentario").val();
				var estado = $("#sl_estado").val();
				
				if (comm.length>0)
				{
				jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Comentario/grabaComentario",
						dataType: 'json',
						data: {idpedido,estado,comm},
						success: function(res) {
									$(':input[type="submit"]').prop('disabled', false);
									if (res)
									{
										//alert("Comentario "+res.id+" insertado correctamente.");
										MuestraMensaje("Módulo Comentarios","Comentario ingresado correctamente.");
										$('#modalDinamico').on('hidden.bs.modal', function () {window.location.href = "<?php echo base_url(); ?>pedido/editarPedido/"+res.idpedido;});
									}else
									{
										//alert("ERROR al insertar Comentario");
										MuestraMensaje("Módulo Comentarios","Error: ".res );
									}
							}
					}); //jqueryajax
  				}
				}				
	});	
	
	//Submit formulario detalle		
	$("#frm_det_pedido").validate({
  				submitHandler: function(form){
				//TODO validacion antes de grabar
				$(':input[type="submit"]').prop('disabled', true);
				event.preventDefault();
				// Linea detalle
				var cantidad    =  $("#txt_cantidad").val();
				var costoventa  =  $("#txt_costoventa").unmask();
				var precioventa =  $("#txt_precioventa").unmask();
				var idproducto   =  $("#cntrl_id_producto").val();
				var idpedido 	=  <?php echo $pedEdit['id'];?>//$("#numeroPedido").val();
				
				jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Pedido/grabaDetalle",
						dataType: 'json',
						data: {cantidad,idproducto,costoventa,precioventa,idpedido},
						success: function(res) {
									$(':input[type="submit"]').prop('disabled', false);
									if (res)
									{
										//Detalle grabado, se agreg� una nueva linea al pedido
										 $("#txt_cantidad").val('');
										 $("#txt_costoventa").val('');
										 $("#txt_precioventa").val('');
										 $("#cntrl_id_producto").val('');
										
									}else
									{
										alert("ERROR al actualizar los detalles del pedido");
									}
									buscaLineaDetalle();
							}
					}); //jqueryajax
  				}	
	});
			//********** Control Producto **************************************			
			$("#cntrl_id_producto").select2({
				ajax: {
				        url: "<?php echo base_url(); ?>Productos/listadoControlProductos/",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
					    	
					    	for(var i = 0; i < data.length; i++){
					    	    res[i] = {id:data[i].id,text:data[i].nombre};
					    	}
					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});


			$("#cntrl_id_cta_comision_ingcomi").select2({
				ajax: {
				        url: "<?php echo base_url(); ?>Cuenta/listadoControlCuenta/1",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
					    	
					    	for(var i = 0; i < data.length; i++){
					    	    res[i] = {id:data[i].id,text:data[i].Nombre};
					    	}
					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});
			

			
			//********** Control cta comisi�n **************************************			
			$("#cntrl_id_cta_comision").select2({
				ajax: {
				        url: "<?php echo base_url(); ?>Cuenta/listadoControlCuenta/",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
					    	
					    	for(var i = 0; i < data.length; i++){
					    	    res[i] = {id:data[i].id,text:data[i].Nombre};
					    	}
					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});

			
			//********** Control cta1 **************************************			
			$("#cntrl_id_cta").select2({
				ajax: {
				        url: "<?php echo base_url(); ?>Cuenta/listadoControlCuenta/",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
					    	
					    	for(var i = 0; i < data.length; i++){
					    	    res[i] = {id:data[i].id,text:data[i].Nombre};
					    	}
					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});	
			//********** Control cta2 **************************************			
			$("#cntrl_id_cta_destino").select2({
				ajax: {
				        url: "<?php echo base_url(); ?>Cuenta/listadoControlCuenta/",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
					    	
					    	for(var i = 0; i < data.length; i++){
					    	    res[i] = {id:data[i].id,text:data[i].Nombre};
					    	}
					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});

			$('#btnback').click(function () {
				window.history.back();
			});
				
}); //Function ready
</script>
 