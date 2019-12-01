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
		<!-- --------------------------------------------- primera columna ----------------------------------------------->
		<div class="col-md-3">
			<!-- Resumen Pedidos ---------------------------------------------------------------------------------->
			<?php $totalactual=$ind_ingresado+$ind_enfabricacion+$ind_esperando+$ind_conproblema+$ind_calculando;?>
			
			<div class="box box-primary">
										<div class="box-header with-border">
										<h3 class="box-title"><a href="javascript:seleccionaEstadosActuales()">Pedidos totales <?php echo $totalactual;?></a></h3>

										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											
										</div>
										</div>
									
										<!-- /.box-header --> 
										<div class="box-body">
												<a href="javascript:seleccionaEstados(0)">Ingresados</a>
												<div class="progress">
													<div class="progress-bar progress-bar-silver" role="progressbar" aria-valuenow="<?php echo $ind_ingresado;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_ingresado*100)/$totalactual;?>%">
													<span style="color:#000000;"><b><?php echo $ind_ingresado;?></b></span>
													</div>
												</div>
												<a href="javascript:seleccionaEstados(1)">En fabricación</a>
												<div class="progress">
													<div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="<?php echo $ind_enfabricacion;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_enfabricacion*100)/$totalactual;?>%">
													<span><?php echo $ind_enfabricacion;?></span>
													</div>
												</div>
												<a href="javascript:seleccionaEstados(2)">Esperando Entrega</a>
												<div class="progress">
													<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $ind_esperando;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_esperando*100)/$totalactual;?>%">
													<span><?php echo $ind_esperando;?></span>
													</div>
												</div>
												
												<a href="javascript:seleccionaEstados(5)">Calculando</a>
												<div class="progress">
													<div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="<?php echo $ind_calculando;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalactual;?>" style="width: <?php echo ($ind_calculando*100)/$totalactual;?>%">
													<span><?php echo $ind_calculando;?></span>
													</div>
												</div>
												<a href="javascript:seleccionaEstados(4)">Con Problema</a>
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
										
									</div><!-- box primary -->
									<!-- Fin Resumen Pedidos----------------------------------------------------------------------------------> 						
						
	</div><!-- --------------------------------------------- FIN primera columna ----------------------------------------------->
	<div class="col-md-3"><!-- --------------------------------------------- SEGUNDA columna ----------------------------------------------->
		   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Indicadores dinámicos</h3>
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
								<td class="text-right"><label id="lbl_totalSaldoVen1"></label></td>
							</tr>
					<?php }?>
					
							<?php if($this->ion_auth->in_group(2) || $this->ion_auth->is_admin()) {?>
							<tr>
								<th>Total Vendedor</th>
								<td class="text-right"><label id="lbl_totalSaldoVen2"></label></td>
							</tr>
							<?php } 
							if($this->ion_auth->is_admin())
							{
							?>
							<tr>
								<th>Total Fabrica</th>
								<td class="text-right"><label id="lbl_totalSaldoFab"></label></td>
							</tr>
							<?php }?>
					</tbody>
					</table>
			</div>
            <!-- /.box-body -->
            <div class="box-footer text-left">
			
				
				<!--<a href="<?php echo base_url(); ?>Pedido/nuevoPedido/" class="btn btn-default"><i class="fa fa-edit"></i> Nuevo Pedido</a>-->
            </div>
            <!-- /.box-footer -->
		  </div>
								
		 <!-- consulta rapida -->
		 <div class="box box-primary">
					<div class="box-header">
					<h3 class="box-title">Consulta rapida</h3>
						<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<input id="buscarpedido" class="form-control input-sm" type="text" placeholder="Ingrese pedido">
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
								<button  id="verPedido" type="button" class="btn btn-info input-sm">Ver Pedido</button>
								</div>
								</div>
							</div>
					</div>
					<!-- /.box-body -->

				</div><!-- fin consulta rapida -->

	</div><!-- --------------------------------------------- SEGUNDA columna ----------------------------------------------->
	<div class="col-md-3"><!-- --------------------------------------------- TERCERA columna ----------------------------------------------->
			<!-- Ultimos adjuntos -->
			<div class="box box-primary collapsed-box">
					<div class="box-header with-border">
							<h3 class="box-title">Archivos Adjuntos</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
							</div>
					</div> <!-- /.box-header -->
					<div class="box-body">	
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<input name="txt_criterio_adj" class="form-control input-sm" type="text" placeholder="Buscar adjunto" id="txt_criterio_adj">
											
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<button  id="btn_buscar_adj" type="button" class="btn btn-info">Buscar</button>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
									<table id="tbl_ultimosadjuntos" class="table"></table>	   
									</div>
								</div><!-- row -->
					</div><!-- box body -->
				</div><!-- box primary -->
			<!-- / fin Ultimos adjuntos -->
			<?php if($this->ion_auth->is_admin())
							{
			?>
			<!-- LINE CHART -->
			<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Ingresos mensuales totales</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" height="250"></canvas>
                  </div>
                </div><!-- /.box-body -->
			  </div><!-- /.box -->
			  
							<?php } ?>
	</div>
	<div class="col-md-3"><!-- --------------------------------------------- CUARTA columna ----------------------------------------------->
			<?php if($this->ion_auth->is_admin()){ ?>
			<!-- hojas recientes -->
			<div class="box box-primary box">
				<div class="box-header with-border">
						<h3 class="box-title"><a href="<?php echo base_url('Reporte/Hojas/-1'); ?>">Últimas hojas</a></h3>
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



			
			
	</div>

</div><!-- row -->

<!-- consulta filtros principales -->
<div class="box box-default" >
									<div class="box-header with-border">
									<h3 class="box-title">Panel de pedidos</h3>

									</div>
									<!-- /.box-header -->
									<div class="box-body">

		<div class="row">
			<div class="col-md-6">

								<!-- Filtros -->
								<div class="box box-primary collapsed-box">
								<div class="box-header">
								<h3 class="box-title">Filtros</h3>
									<div class="box-tools">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">Estados</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
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
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">Comisión</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<select id="sl_comision" class="form-control input-sm">
																<?php if($this->ion_auth->is_admin()){ ?>
																<option value="-1">Comisi&oacute;n</option>
															<option value="0">No</option>
															<?php }?>
															<option value="1">Si</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">Buscar por criterio</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
												<input name="search_txt" class="form-control input-sm" type="text" placeholder="#pedido, cliente, etc" id="search_txt">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">Producto</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<select id="cntrl_id_producto"  class="form-control" name="cntrl_id_producto" data-error="Seleccione un Producto" style="width:100%;"></select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">Fecha</div>
											</div>
											<div class="col-md-7">
												<div class="form-group" id="reportrange">
													<button class="btn btn-default pull-left" id="daterange-btn">
														
														<i class="fa fa-calendar"></i> <span>Seleccionar fecha</span>
														<i class="fa fa-caret-down"></i>
													</button>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
													<button  id="ok" type="button" class="btn btn-info input-sm right">Actualizar</button>
											</div>
										</div>
								</div>
								<!-- /.box-body -->

							</div><!-- fin filtros -->

				
			</div><!-- col -->
			<div class="col-md-6">
			
			</div>
												
	</div><!-- row -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12">	
		
		<table id="tabla_resultado" data-method="post" data-show-footer="true" data-show-columns="true"
               data-show-refresh="true" data-show-export="true" data-side-pagination="server" data-sort-Order="desc"
			   data-toggle="table" data-query-params="queryParams" data-response-handler="responseHandler"
			   data-url="<?php echo base_url('Pedido/listadoPedidos/'); ?>">
	     <thead>
         <tr >
         		 <th data-field="numeroPedido"  data-sortable="true" data-align="center" data-formatter="formatoVerDetalle" data-events="eventosTabla"></th>
                 <th data-field="numeroPedido"  data-sortable="true" data-formatter="f_idpedido">Nro.</th>
                 <th data-field="cli_id" data-visible="false">id cliente</th>
                 <th data-field="cli_nom" data-filterby="true"  data-formatter="f_cliente">Cliente</th>
                 <th data-field="estado_sec"  data-sortable="true" data-align="left" data-formatter="FormatoEstado">Estado</th>
				 <th data-field="comision"  data-sortable="true" data-align="left"    <?php if($this->ion_auth->is_admin()){ echo "data-visible=\"true\""; }?>   data-formatter="FormatoComision">Comisi&oacute;n</th>
				 <th data-field="confactura"  data-sortable="true" data-align="center" data-visible="false" data-formatter="FormatoComision">Factura</th>
				 <th data-field="est_fec_ing" data-sortable="true" data-visible="true" data-footer-formatter="totalTextFormatter">Ingresado</th>
				 <th data-field="est_fec_estactual" data-sortable="true" data-visible="false" >Fecha Act</th>
				 <th data-field="diastranscurridos" data-sortable="true"  data-visible="true" data-formatter="diasTranscurridosFormater" data-footer-formatter="cantidadRegistros">D&iacute;as T.</th>
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


<script type="text/javascript">
	var startDate="";
		var endDate="";
	//http://davidstutz.github.io/bootstrap-multiselect/
	//https://github.com/wenzhixin/bootstrap-table/blob/master/src/extensions/export/README.md
	$(document).ready(function(){


	
		

		//Widgets 
		ultimasHojasProcesadas();
		ultimosAdjuntos();
		inicializaGraficoVentas();

		//manejador evento que elimina pedido.
		window.eventosTabla = {'click .remove': function (e, value, row, index) {eliminaPedido(row);},
				               'click .ver': function (e, value, row, index) {muestraPedidoVistaPreviaModalRow(row);}
							  };
		
		
		$table = $('#tabla_resultado');
		

		$sl_comision = $('#sl_comision');
		$sl_comision.change(function(){ $table.bootstrapTable('refresh'); });
		
		$('#cntrl_id_producto').change(function(){buscaProducto();});
		
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

		//Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Semana Pasada': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  },
                  startDate: moment().subtract(29, 'days'),
                  endDate: moment()
                },
        function (start, end) {
		  $('#reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
		  startDate = start.format('YYYY-MM-DD');
          endDate = end.format('YYYY-MM-DD');
        }
        );
		
		
		$('#btn_buscar_adj').click(function(){ultimosAdjuntos();});
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
	

	/*
	* Control busqueda de producto 
	*/ 
	function buscaProducto(){
		
		var idprod = $( "#cntrl_id_producto" ).val();
		jQuery.ajax({
				method: "GET",
					url: base_url+"Productos/ObtieneProductoPorId/"+idprod,
					dataType: 'json',
					success: function(res) {
						buscaResultados($('#tbl_detallepedido'));
						}
		}); //jqueryajax
	}
	$("#cntrl_id_producto").select2({
				ajax: {
				        url: base_url+"Productos/listadoControlProductos/",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
						
							var mi=0;
							res[mi] = {id:'-1',text:'-'};
							mi++;
					    	for(var i = 0; i < data.length; i++){
								res[mi] = {id:data[i].id,text:data[i].nombre};
								mi++;
							}
						

					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
	});



/*	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  */
/*	W I D G E T S
/*	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  */

	/*
	*	Muestra las ultimas hojas que se han creado
	*/
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
    });}
	/*
	*	MUestra los ultimos archivos adjuntos.
	*/
	function ultimosAdjuntos(){
	var criterio = $('#txt_criterio_adj').val();		
	$('#tbl_ultimosadjuntos').bootstrapTable('destroy').bootstrapTable
	(	{
		   url: base_url+'Pedido/Adj_buscar/'+criterio,
		   method:"GET",
		   dataType: 'json',
		   columns:[  /* {field: 'fecha_subida',title: 'Fec. Subida'},*/
					   {field: 'id_cabecera',title: 'Pedido',formatter:'f_idpedido'}, 
					   {field: 'cli_nombre',title: 'Cliente',formatter:'i_cliente'},
					   {field: 'filenameid',title: 'filename',formatter:'f_archivoadjunto'}
		   		   ]
   		}
	);}


	

/*	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  */
/*	 Metodos  
/*	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  */
	
	/*
	*	Funcion llamada cuando se gatilla el evento de eliminar pedido
	*/
	function eliminaPedido(row){
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
						}else{ 
							MuestraMensaje("Módulo Pedidos",res.mensaje);
							buscaResultados($('#tabla_resultado'));
						}
					}
			});			
		}
	}



	/*
	*	Refresca la tabla solicitada
	*/
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

	
/*	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  */
/*	 Metodos  de la tabla de resultados
/*	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  */	
	/*
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
		params['search'] = $('#search_txt').val();
		params['idprod'] = $('#cntrl_id_producto').val();
		

		params['fechaDesde'] = startDate;
		params['fechaHasta'] = endDate;
        /*$('#toolbar').find('input[name]').each(function () {
            params[$(this).attr('name')] = $(this).val();
        });*/
	    return params;
	}


	function inicializaGraficoVentas(){
		var areaChartOptions = {
		  //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: true,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 8,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: false,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: false,
          //Boolean - whether to make the chart responsive to window resizing
		  responsive: true,
		  
		  scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return PriceFormatter(value);
                    }
				}
				
            }]
        }
		};
		//obtenerIngresosPorPedido
		jQuery.ajax({
				method: "GET",
					url: "<?php echo base_url('Pedido/obtenerIngresosPorPedido/'); ?>",
					dataType: 'json',
					success: function(res) {
						console.log(res);
						var montos = [];
						var montosAnt = [];
						var montosGananciaAnt = [];
						var periodos = [];
						var montosGanancia = [];
						//var cantidadPedidos = [];
						
						for (var i in res.act) {
							montos.push(res.act[i].totalAPagar);
							montosGanancia.push(res.act[i].ganancia);
							periodos.push(res.act[i].mes);
							//cantidadPedidos.push(res[i].cantidadPedidos);
						}

						for (var i in res.ant) {
							montosAnt.push(res.ant[i].totalAPagar);
							montosGananciaAnt.push(res.ant[i].ganancia);
							//periodosAnt.push(res.act[i].label);
							//cantidadPedidos.push(res[i].cantidadPedidos);
						}

						var chartdata = {
                        labels: periodos,
                        datasets: [
                            {
                                label: 'Ventas anuales',
								backgroundColor: 'rgb(243, 156, 18)',
								borderColor: 'rgb(243, 156, 18)',
								fill: false,
                                data: montos
							},
							{
                                label: 'Ganancia anual',
								backgroundColor: 'rgb(47, 51, 54)',
								   borderColor: 'rgb(47, 51, 54)',
								fill: false,
                                data: montosGanancia
							},
							{
                                label: 'Año Anterior',
								backgroundColor: 'rgb(38, 154, 188)',
								borderColor: 'rgb(38, 154, 188)',
								fill: false,
                                data: montosAnt
                            }
							]
						};

						//-------------
						//- LINE CHART -
						//--------------
						
						var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
						var chart = new Chart(lineChartCanvas, {
							type: 'line',
							data: chartdata,
							options: areaChartOptions
						});
					
					}
		});			


	



		
	}

	






</script>
 


	

