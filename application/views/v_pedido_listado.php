<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
  	<h1>
		<?php echo $titleHeader; ?>
		<small><?php echo $descHeader ?></small>
  	</h1>
  	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
		<li><a href="<?php echo base_url($currentClass); ?>"><?php echo $currentClass ?></a></li>
		<li class="active"><?php echo $currentAction ?></li>
  	</ol>
	</section>

	<section class="content">
	<div class="row">
		<div class="col-md-6">
		<!-- Resumen Pedidos ---------------------------------------------------------------------------------->
			<?php $totalactual=$ind_ingresado+$ind_enfabricacion+$ind_esperando+$ind_conproblema+$ind_calculando;?>
			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><a href="javascript:seleccionaEstadosActuales()">Total actual : <?php echo $totalactual;?></a></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
			</div>
		
            <!-- /.box-header -->
            <div class="box-body">
					<p><a href="javascript:seleccionaEstados(0)">Ingresados</a></p>
					<div class="progress">
						<div class="progress-bar progress-bar-silver" role="progressbar" aria-valuenow="<?php echo $ind_ingresado;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_ingresado*100)/$totalactual;?>%">
						<span><?php echo $ind_ingresado;?></span>
						</div>
					</div>
					<p><a href="javascript:seleccionaEstados(1)">En fabricación</a></p>
					<div class="progress">
						<div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="<?php echo $ind_enfabricacion;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_enfabricacion*100)/$totalactual;?>%">
						<span><?php echo $ind_enfabricacion;?></span>
						</div>
					</div>
					<p><a href="javascript:seleccionaEstados(2)">Esperando Entrega</a></p>
					<div class="progress">
						<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $ind_esperando;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_esperando*100)/$totalactual;?>%">
						<span><?php echo $ind_esperando;?></span>
						</div>
					</div>
					
					<p><a href="javascript:seleccionaEstados(5)">Calculando</a></p>
					<div class="progress">
						<div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="<?php echo $ind_calculando;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_calculando*100)/$totalactual;?>%">
						<span><?php echo $ind_calculando;?></span>
						</div>
					</div>
					<p><a href="javascript:seleccionaEstados(4)">Con Problema</a></p>
					<div class="progress">
						<div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $ind_conproblema;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_conproblema*100)/$totalactual;?>%">
						<span><?php echo $ind_conproblema;?></span>
						</div>
					</div>
			</div>
			<!-- /.box-body -->
			<?php if($this->ion_auth->is_admin()){ ?>
            <div class="box-footer text-center">
              <a href="javascript:seleccionaEstados(3)" class="uppercase">Pedidos completados : <?php echo $ind_listos; ?> </a>
			</div>
			<?php }?>
			<!-- /.box-footer -->
			
		  </div>

		  <!-- consulta rapida -->
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta rapida</h3>
	              <div class="box-tools pull-right">
                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
					
					<div class="form-group">
					<input id="buscarpedido" class="form-control input-sm" type="text" placeholder="Ingrese pedido">
					</div>
					<div class="form-group">
						<button  id="verPedido" type="button" class="btn btn-info input-sm">Ver Pedido</button>
					</div>
			</div>
            <!-- /.box-body -->

		  </div><!-- fin consulta rapida -->
	
	<!-- Fin Resumen Pedidos----------------------------------------------------------------------------------> 
	</div><!-- class col -->
	<!-- Cabecera Listado Pedidos ---------------------------------------------------------------------------------->
	<div class="col-md-6">
		   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Saldos actuales</h3>
	              <div class="box-tools pull-right">
                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
					<table class="table">
					<tbody>
					<?php if($this->ion_auth->is_admin()){ ?>
							<tr>
								<th>Total Admin</th>
								<td><label id="lbl_totalSaldoVen1"></label></td>
							</tr>
					<?php }?>
					
							<?php if($this->ion_auth->in_group(2) || $this->ion_auth->is_admin()) {?>
							<tr>
								<th>Total Vendedor</th>
								<td><label id="lbl_totalSaldoVen2"></label></td>
							</tr>
							<?php } 
							if($this->ion_auth->is_admin())
							{
							?>
							<tr>
								<th>Total Fabrica</th>
								<td><label id="lbl_totalSaldoFab"></label></td>
							</tr>
							<?php }?>
					</tbody>
					</table>
			</div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
				<a href="<?php echo base_url(); ?>Pedido/nuevoPedido/" class="btn btn-default"><i class="fa fa-edit"></i> Nuevo Pedido</a>
            </div>
            <!-- /.box-footer -->
		  </div>
		  

		  
		  
		<?php if($this->ion_auth->is_admin()){ ?>
			<!-- hojas recientes -->
			<div class="box box-primary collapsed-box">
				<div class="box-header with-border">
						<h3 class="box-title">Hojas Recientes</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div>
				</div> <!-- /.box-header -->
				<div class="box-body">			  
							<table id="tbl_ultimashojas" class="table"></table>	   
				</div><!-- box body -->
			</div><!-- box primary -->
			<!-- / fin hojas recientes -->
		 <?php }?>

		<!-- Ultimos adjuntos -->
		<div class="box box-primary collapsed-box">
				<div class="box-header with-border">
						<h3 class="box-title">Archivos subidos</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div>
				</div> <!-- /.box-header -->
				<div class="box-body">			  
							<table id="tbl_ultimosadjuntos" class="table"></table>	   
				</div><!-- box body -->
			</div><!-- box primary -->
		<!-- / fin Ultimos adjuntos -->

					

	</div><!-- Segunda columna-->
</div><!-- row -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------->
 <div class="box">
 	<div class="box-header with-border">
  		<h3>Resultados</h3>
		  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
  	</div><!-- Box Header -->
  	<div class="box-body">
  	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12">	
		 <div id="toolbar">
            <div class="form-inline" role="form">
                <div class="form-group">
                    
                 	<label>Estados</label>
                    <select  id="sl_estado" class="form-control input-sm" multiple>
					<?php
					foreach($vEstados as $est) {
						  echo "<option "; 
						   
						  echo " value = \"". $est['id']."\"";
						  if ($est['id']<3)
						  	echo " selected=\"selected\"";
					 ?>
					>
					 <?php echo $est['descripcion']; ?>
						  
  					</option>
  					<?php }?>	
					</select>
                </div>
                <div class="form-group">
                   <!--   <span>Limit: </span>
                    <input name="limit" class="form-control" type="number" value="20" style="width:80px;">-->
                </div>
                 <div class="form-group">
                 	<label>Comisión</label>
                 	<select id="sl_comision" class="form-control input-sm">
                 	 		<?php if($this->ion_auth->is_admin()){ ?>
                 	 		<option value="-1">Comisi&oacute;n</option>
                 		    <option value="0">No</option>
                 		    <?php }?>
                 			<option value="1">Si</option>
                 	</select>
                 </div>
                <div class="form-group" >
                    <input name="search" class="form-control input-sm" type="text" placeholder="Buscar">
                </div>
                
                 <button  id="ok" type="button" class="btn btn-info input-sm">Ir!</button>
            </div>
        </div>
		<table id="tabla_resultado"
			   data-toolbar="#toolbar"
			   data-method="post"
			   
       		   data-show-footer="true"
               data-show-columns="true"
               data-show-refresh="true"
			   data-show-export="true"
			   data-side-pagination="server"
			   
			   data-sort-Order="desc"
			   
			   
			   data-toggle="table"
			   data-query-params="queryParams"
			   
			   data-response-handler="responseHandler"
			   data-url="<?php echo base_url(); ?>Pedido/listadoPedidos/">
	     <thead>
         <tr >
         		 <th data-field="numeroPedido"  data-sortable="true" data-align="center" data-formatter="formatoVerDetalle" data-events="eventosTabla"></th>
                 <th data-field="numeroPedido"  data-sortable="true" data-formatter="f_idpedido">Nro.</th>
                 <th data-field="cli_id" data-visible="false">id cliente</th>
                 <th data-field="cli_nom" data-filterby="true"  data-formatter="f_cliente">Cliente</th>
                 <th data-field="estado_sec"  data-sortable="true" data-align="left" data-formatter="FormatoEstado">Estado</th>
				 <th data-field="comision"  data-sortable="true" data-align="left"    <?php if($this->ion_auth->is_admin()){ echo "data-visible=\"true\""; }?>   data-formatter="FormatoComision"  data-footer-formatter="totalTextFormatter">Comisi&oacute;n</th>
				 <th data-field="confactura"  data-sortable="true" data-align="center" data-visible="false">Factura</th>
				 <th data-field="est_fec_ing" data-sortable="true" data-visible="true">Ingresado</th>
				 <th data-field="est_fec_estactual" data-sortable="true" data-visible="false">Fecha Act</th>
				 <th data-field="diastranscurridos" data-sortable="true"  data-visible="true" data-formatter="diasTranscurridosFormater">D&iacute;as T.</th>
				 <th data-field="totalAPagar" data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right" data-footer-formatter="sumFormatter" >Venta Total</th>
				 <th data-field="SaldoCliente" data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right"  data-footer-formatter="sumFormatter" >Saldo Cliente</th>
				 <th data-field="SaldoVendedor1"  data-sortable="true" data-formatter="PriceFormatter"  data-visible="<?php if($this->ion_auth->is_admin())echo "true";else echo"false";?>" data-align="right"  data-footer-formatter="sumFormatter" >Saldo VEN1</th>
				 <th data-field="SaldoVendedor2"  data-sortable="true" data-formatter="PriceFormatter"  data-visible="<?php if($this->ion_auth->is_admin())echo "false";else echo"true";?>>" data-align="right"  data-footer-formatter="sumFormatter" >Saldo VEN2</th>
				 <th data-field="SaldoFabrica" data-sortable="true" data-formatter="PriceFormatter"  data-visible="true" data-align="right"  data-footer-formatter="sumFormatter" >Saldo F&aacute;brica</th>
				 	
				 <th data-field="operate" data-events="eventosTabla" data-formatter="operateFormatter"  data-visible="false">Eliminar</th>

            </tr>
         </thead>
      
		</table>
		</div><!--  col -->
	</div><!-- ROW -->
	</div><!-- Div class box body -->
</div><!-- .div box -->


</section><!-- /.content -->

	</div><!-- /.content-wrapper -->


<div class="modal fade" tabindex="-1" role="dialog" id="divpedidopreview">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalle pedido <label id="iddetallepedido"></label> :</h4>
      </div>
      <div class="modal-body">
      		
      		<div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12">
               		<table id="tbl_detallepedido" class="table"
        			   				   data-method="post"
        			   				   data-toggle="table"
        			   				   data-query-params="queryParamsDetalle"
        							   data-url="<?php echo base_url('Pedido/obtenerDetallePedido'); ?>">
        							   <thead>
        									<tr class="d-flex" >
        										 <th data-field="cantidad"  data-sortable="false" data-align="center" class="col-1">cantidad</th>
        										 <th data-field="nom_prod"  data-sortable="false" data-align="left" class="col-3">Producto</th>
        										 <th data-field="costo_un"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1" data-visible="false">Costo c/u</th>
        										 <th data-field="venta_un"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1" data-visible="true">Venta c/u</th>
        										 <th data-field="det_costo"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1"  data-visible="false">Costo tot</th>
        										 <th data-field="det_venta"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1">Venta Tot</th>
        									</tr>
        								</thead>
        			</table>
        		</div><!-- col -->
			</div><!-- row -->
			<div class="row">
				 <div class="col-md-6 col-sm-6 col-xs-12" style="text-align_right;">
				
					<table class="table no-margin">
                      <tr>
                        <th style="width:50%">Costo total:</th>
                        <td><label id="lbl_totalCosto"></label></td>
                      </tr>
                      <tr>
                        <th style="width:50%">Ganancia Global:</th>
                        <td><label id="lbl_totalganancia"></label></td>
                      </tr>
                      <tr>
                        <th colspan="2" style="text-align:center;">Comisiones</th>
                      </tr>
                      <tr>
                        <td colspan="2">
                        	<p id="p_comisiones"></p>
                        </td>
                      </tr>
                      
                     </table>
                     
                     
                     
                     
                     
                   
        	
        	
        	
				 </div>
				 <div class="col-md-6 col-sm-6 col-xs-12" style="text-align_right;">
						<div class="table-responsive">
								<table class="table no-margin">
                                  <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td><label id="lbl_subtotal"></label></td>
                                  </tr>
                                  <tr>
                                    <th>I.V.A</th>
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
				      </div><!-- col -->
	        	</div><!-- row -->
	  </div><!-- modal info -->
	  <div class="modal-footer">
	  		<span id="linkfooter"></span>
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">

	//http://davidstutz.github.io/bootstrap-multiselect/
	//https://github.com/wenzhixin/bootstrap-table/blob/master/src/extensions/export/README.md
	$(document).ready(function(){


		//Widgets 
		ultimasHojasProcesadas();
		ultimosAdjuntos();

		//manejador evento que elimina pedido.
		window.eventosTabla = {'click .remove': function (e, value, row, index) {eliminaPedido(row);},
				               'click .ver': function (e, value, row, index) {muestraPedidoVistaPreviaModalRow(row);}
							  };
		
		
		$sl_comision = $('#sl_comision');
		$sl_comision.change(function(){ $table.bootstrapTable('refresh'); });
		
	    $("#sl_estado").multiselect({ 
	        nonSelectedText: 'Filtrar los estados!',    
	        maxHeight: 200,
	        buttonWidth: '250px',
	        dropRight: true,
	        enableClickableOptGroups: true
	    });


	  


	    <?php if(!$this->ion_auth->is_admin()){ ?>
	    	var element = document.getElementById('sl_comision');
	    	element.value = '1';
	    <?php }?>

	    
	    /*SETEO EVENTOS*/
	    
	    $ok = $('#ok');  
	    $btnVerPedido = $('#verPedido');
		$ok.click(function () {buscaResultados($('#tabla_resultado'));});
		$btnVerPedido.click(function () {
			muestraPedidoVistaPreviaModal($('#buscarpedido').val());
		});

		
		
		
		
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
	

	function ultimasHojasProcesadas(){
	$('#tbl_ultimashojas').bootstrapTable('destroy').bootstrapTable
	({
		   url: base_url+'Reporte/ultimasHojasProcesadas/',
		   method:"GET",
		   dataType: 'json',
		   columns:[
					   {field: 'nombre_hoja',title: 'Hoja',formatter:'f_nombrehojalink'}, 
					   {field: 'fecha_proceso',title: 'Fecha proceso'},
					   {field: 'fecha_mod',title: 'Ult. Modificación'}
					   
		   ]
   }
	);
	}

	function ultimosAdjuntos(){
	$('#tbl_ultimosadjuntos').bootstrapTable('destroy').bootstrapTable
	({
		   url: base_url+'Pedido/muestraUltimosAdjuntos/',
		   method:"GET",
		   dataType: 'json',
		   columns:[
					   {field: 'fecha_subida',title: 'Fec. Subida'},
					   {field: 'id_cabecera',title: 'Pedido',formatter:'f_idpedido'}, 
					   {field: 'id_tipo',title: 'Tipo'},
					   {field: 'filename',title: 'filename'}
					   
		   ]
   }
	);
	}

	/*
	*  Usado para sacar el id del arreglo cuando es llamado desde una fila de la tabla de resultados,  para llamar a muestraPedidoVistaPreviaModal 
	*/
	function muestraPedidoVistaPreviaModalRow(row)
	{
		muestraPedidoVistaPreviaModal(row['numeroPedido']);
	}
	/*
	*	Muestra el modal con la vista previa del detalle del pedido
	*	Se gatilla cada vez que se presiona la lupa en algun pedido del listado
	*   row : Es la fila desde donde se hizo clic 
	*/	
	function muestraPedidoVistaPreviaModal(id)
	{
    	//Seteo en un label del modal el pedido que cargaremos
    	$('#iddetallepedido').val(id);
    	$('#iddetallepedido').text(id);
    	//Llamo a la funcion que actualiza la tabla con los valores de este pedido
    	buscaResultados($('#tbl_detallepedido'));
    	//LLamo a la funcion que actualiza los totales del detalle 
    	actualizaIndicadoresDetalleVistaPrevia(id);
    	//Agrego un link para editar el pedido
    	var link = "<a class='btn btn-default'  href='<?php echo base_url('Pedido/editarPedido'); ?>/"+id+"'><i class='fa fa-edit'></i> Ver Más</a>";
    	
    	$('#linkfooter').html(link);
    	//Muestro el modal
    	$('#divpedidopreview').modal('show');
	}
	
	
	

	
	/*Funcion llamada cuando se gatilla el evento de eliminar pedido*/
	function eliminaPedido(row)
	{
		var id = row['numeroPedido'];

		if(confirm('¿ Seguro desea eliminar el pedido  ' + id +' ? ' ))
		{
			jQuery.ajax({
				method: "POST",
					url: "<?php echo base_url(); ?>Pedido/eliminaPedido/",
					data:{id},
					dataType: 'json',
					success: function(res) {
						if (res.estado == false){
							//alert("Problema al eliminar el pedido")
							MuestraMensaje("Módulo Pedidos","Error : "+ res.mensaje); 
						}
						else{ 
							MuestraMensaje("Módulo Pedidos",res.mensaje);
							buscaResultados($('#tabla_resultado'));
						}
					}
			});			
		}
	}

	function actualizaIndicadoresDetalleVistaPrevia(id){
		jQuery.ajax({
			method: "POST",
				url: "<?php echo base_url(); ?>Pedido/obtieneIndicadoresExtendidos",
				dataType: 'json',
				data: {idpedido:id},
				success: function(res){actualizaIndicadoresDetalleVistaPreviaCallBack(res);}
		}); //jqueryajax	
	}

	
    function buscaResultados($table){
    	$table.bootstrapTable('refresh');
    }
    	
    
    function seleccionaEstados(estado)
    {
		 $('#sl_estado').multiselect('deselect', ['0','1','2','3','4','5']);
    	 $('#sl_estado').multiselect('select', [estado]);
    	 buscaResultados($('#tabla_resultado'));
    }
		
	function seleccionaEstadosActuales(){
		$('#sl_estado').multiselect('deselect', ['0','1','2','3','4','5']);
		 $('#sl_estado').multiselect('select',['0','1','2']);
		 buscaResultados($('#tabla_resultado'));
	}
	/*
	*Totaliza la respuesta.-
	*/
	function calculaTotalesListado(res){
		var totalSaldo1=0;
		var totalSaldo2=0;
		var totalSaldoFab=0;
		for (var i in res) {
		  for (var j in res[i]) {
			  totalSaldo1 += parseInt(res[i][j].SaldoVendedor1);
			  totalSaldo2 += parseInt(res[i][j].SaldoVendedor2);
			  totalSaldoFab += parseInt(res[i][j].SaldoFabrica);
		  }
		}
		$('#lbl_totalSaldoVen1').text(PriceFormatter(totalSaldo1));
		$('#lbl_totalSaldoVen2').text(PriceFormatter(totalSaldo2));
		$('#lbl_totalSaldoFab').text(PriceFormatter(totalSaldoFab));
	}

	/*
	*Totaliza la respuesta para mostrar el detalle
	*/
	function actualizaIndicadoresDetalleVistaPreviaCallBack(res){

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

			    	$("#p_comisiones").append("<b>"+r.NombreVendedor+"</b>&nbsp;<br/><i>Quedan </i>"+PriceFormatter(r.SaldoVendedor)+"<i> de</i> " +PriceFormatter(r.TotalVendedor)+" <br>");
			    
			}
	        
        	
        }
    	
	}
	
	/**
	 * Procesa la respuesta del metodo que carga v�a ajax los datos a la tabla.
	 */
	function responseHandler(res){
		calculaTotalesListado(res);
		return res;
	}

	function responseHandlerDetalle(res){
		calculaTotalesDetalle(res);
		return res;
	}

	
	/*
	 * Funcion que setea los parametros.
	 */
	function queryParams(params) {
		var slestado = $('#sl_estado');
		params['slestado'] = slestado.val();

		var slcomision = $('#sl_comision');
		params['slcomision'] = slcomision.val();

		
        $('#toolbar').find('input[name]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });
	    return params;
	}
	
	
	
	/*
	 * Funcion que setea los parametros de la tabla de detalle
	 */
	function queryParamsDetalle(params) {
			  params['numeroPedido'] = $('#iddetallepedido').val();
	    return params;
	}
	

</script>
 


	

