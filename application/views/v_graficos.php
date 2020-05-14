
<div class="content-wrapper">

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

			<div class="box">
			<div class="box box-info">
			<div class="box-header with-border">
						<h3 class="box-title"><?php echo $subtitulo; ?></h5>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
			  </div>
			 <div class="box-body">
						<div class="row">
							<div class="col-md-12">
												<!-- --------------------------------------------- PRIMERA columna ----------------------------------------------->
												<div class="box box-info box-solid">
													<div class="box-header">
														<h3 class="box-title" id="titulografico">Gráfico</h3>
													</div>
													<div class="box-body">
														<div class="chart"  id="graficoVentas"></div>
													</div>
													<!-- /.box-body -->
													<!-- Loading (remove the following to stop the loading)-->
													<div class="overlay" id="divloading">
														<i class="fa fa-refresh fa-spin"></i>
													</div>
												<!-- end loading -->
												</div>
												<!-- --------------------------------------------- FIN PRIMERA columna ----------------------------------------------->
							</div>
						</div><!-- FILA -->
			</div>
			<div class="box-footer text-center" id="filtrofecha">
					<div class="form-group" id="reportrange">
							<button class="btn btn-default pull-left" id="daterange-btn">
									<i class="fa fa-calendar"></i> <span>Seleccionar rango</span>
									<i class="fa fa-caret-down"></i>
								</button>
					</div>
					<div class="form-group">
							<button  id="actualizaIngTotales" type="button" class="btn btn-info input-sm right">Actualizar</button>
					</div>	
			</div>

			<div class="box-footer text-left" id="filtroproducto">
					<div class="form-group" >
						Selecciones Producto 
						<select id="cntrl_id_producto"  class="form-control" name="cntrl_id_producto" data-error="Seleccione un Producto""></select>
						
					</div>	
			</div>


			<table id="tbl_masvendidos" class="table"></table>	   



			</div><!--box box-info-->
			</div><!-- /.box-body -->




</div><!-- /.box -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">

	var startDate='';
	var endDate='';
	var areaChartOptions;
	var chart;
	var chartdata;
	var cod = '<?php echo $codigoReporte; ?>';
	
	$(document).ready(function(){


			$('#divloading').hide();
			<?php IF ($cod=="RPTMENSUAL"){?>
					
					$('#filtrofecha').show();
					$('#filtroproducto').hide();
					configuraOpcionesGrafico();		
					inicializaControlRangoFecha();

					

					$('#actualizaIngTotales').click(function(){graficoObtieneDatos();});
					$('#actualizaIngTotales').attr("disabled", true);
					

			<?php }IF ($cod=="RPTPRODUCTO"){?>
					$('#filtrofecha').hide();
					$('#filtroproducto').show();
					//#region  RPTPRODUCTO
					configuraOpcionesGrafico();		
					inicializaControlProducto();
					reporteProductosMasVendidos();
					//#endregion
			<?php }?>
				
			
			
			/* RPTPRODUCTO....................................................................................................................................*/ 
			function inicializaControlProducto(){
				
				$('#cntrl_id_producto').change(function(){graficoObtieneDatos();});
				$("#cntrl_id_producto").select2({ajax: {
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
										return { results: res, more: more };
									}
								},
								escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});
			}
			
			function ConfiguraGraficoVentaproducto(res){
				var unidades = [];
				var unidadesAnt = [];
				var periodos = [];
				var sum1 = 0;
				var sum2 = 0;
				for (var i in res.prodata) {
					unidades.push(res.prodata[i].unidades);
					sum1 = sum1 + parseInt(res.prodata[i].unidades);
				}
				for (var i in res.prodataAnt) {
					unidadesAnt.push(res.prodataAnt[i].unidades);
					sum2 = sum2 + parseInt(res.prodataAnt[i].unidades);
					periodos.push(res.prodataAnt[i].mes);
				}
				chartdata = {labels: periodos,datasets:[{	
													label: 'Actual = ' + sum1,
													backgroundColor: 'rgb(243, 156, 18)',
													borderColor: 'rgb(243, 156, 18)',
													fill: false,
													data: unidades},{
													label: 'Anterior ' + sum2,
													backgroundColor: 'rgb(47, 51, 54)',
													borderColor: 'rgb(47, 51, 54)',
													fill: false,
													data: unidadesAnt,
													hidden: false
												}]};
			}

			function reporteProductosMasVendidos(){
			
				$('#tbl_masvendidos').bootstrapTable('destroy').bootstrapTable
				(	{
					url: base_url+'Reporte/obtenerReporteProductosVendido/',
					method:"GET",
					dataType: 'json',
					columns:[  
								{field: 'id',title: 'ID'}, 
								{field: 'nombre',title: 'Cliente'},
								{field: 'unidades',title: 'Unidades'}
							]
					}
				);
			}
			/* RPTMENSUAL o DIARIO....................................................................................................................................*/ 
			function inicializaControlRangoFecha(){
					//Date range as a button
					$('#daterange-btn').daterangepicker(
							{
							ranges: {
								
								'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
								'Semana Pasada': [moment().subtract(6, 'days'), moment()],
								'Este Mes': [moment().startOf('month'), moment().endOf('month')],
								'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
								'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
								'Ultimos 90 dias': [moment().subtract(90, 'days'), moment()],
								'Ultimo Año': [moment().subtract(1, 'year'), moment()]
								
							},
							startDate: moment().subtract(29, 'days'),
							endDate: moment()
							},
							function (start, end) {
							$('#reportrange span').html(" Periodo " + start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
							startDate = start.format('YYYY-MM-DD');
							endDate = end.format('YYYY-MM-DD');

							$('#actualizaIngTotales').attr("disabled", false);
							$('#titulografico').html('Periodo desde '+startDate +', hasta '+ endDate);
					}
					);
			}
			function ConfiguraGraficoVentas(res){
				
				$('#actualizaIngTotales').attr("disabled", false);

				var montos = [];
				var montosAnt = [];
				var montosGananciaAnt = [];
				var periodos = [];
				var montosGanancia = [];
				var cantidadPedidos = [];

				for (var i in res.act) {
					montos.push(res.act[i].totalAPagar);
					montosGanancia.push(res.act[i].ganancia);
					periodos.push(res.act[i].label);
					cantidadPedidos.push(res.act[i].qty);
				}

				for (var i in res.ant) {
					montosAnt.push(res.ant[i].totalAPagar);
					montosGananciaAnt.push(res.ant[i].ganancia);
					cantidadPedidos.push(res.ant[i].qty);
				}

				chartdata = {labels: periodos,datasets:[{	
													label: 'Ventas Periodo actual' ,
													backgroundColor: 'rgb(243, 156, 18)',
													borderColor: 'rgb(243, 156, 18)',
													fill: false,
													data: montos},{
													label: 'Ganancia Periodo Actual ',
													backgroundColor: 'rgb(47, 51, 54)',
													borderColor: 'rgb(47, 51, 54)',
													fill: false,
													data: montosGanancia,
													hidden: true},{
													label: 'Ventas periodo anterior',
													backgroundColor: 'rgb(38, 154, 188)',
													borderColor: 'rgb(38, 154, 188)',
													fill: false,
													data: montosAnt},{
													label: 'Ganancias periodo anterior',
													backgroundColor: 'rgb(245, 201, 196)',
													borderColor: 'rgb(245, 201, 196)',
													fill: false,
													data: montosGananciaAnt,
													hidden: true
												}]};
			}
			/* Generales o comunes ....................................................................................................................................*/
			/* configura las opciones del grรกfico */
			function configuraOpcionesGrafico(){
					$('#graficoVentas').html("");
					areaChartOptions = {
						showScale: true,scaleShowGridLines: true,scaleGridLineColor: "rgba(0,0,0,.05)",scaleGridLineWidth: 1,
						scaleShowHorizontalLines: true,scaleShowVerticalLines: true,ezierCurve: true,bezierCurveTension: 0.3,pointDot: true,ointDotRadius: 8,
						pointDotStrokeWidth: 1,pointHitDetectionRadius: 20,datasetStroke: true,datasetStrokeWidth: 2,datasetFill: false,
						//String - A legend template
						legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
						maintainAspectRatio: false,
						responsive: true,
						tooltips: {mode: 'x'},
						scales: {yAxes: [{ticks: {callback: function(value, index, values) {return PriceFormatter(value);}}}]}
					};
			}
			/* Instancia un nuevo grafico para ser mostrado */
			function dibujaGrafico(){
					$('#divloading').hide();
					$('#graficoVentas').html('<canvas id="lineChart" height="250"></canvas>');
						var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
					chart = new Chart(lineChartCanvas, {
					type: 'line',
					data: chartdata,
					options: areaChartOptions
					}).update();
			}
			/* Recibe los datos del server para prepararlos para  el grafico */
			function graficoProcesaDatos(res){
				console.log(res);
				switch (res.tipo) {
					case "productos":
						ConfiguraGraficoVentaproducto(res);
						break;
					case "pedidos":
						ConfiguraGraficoVentas(res);
						break;
				}
				console.log(chartdata);
			}
						/* Metodo ajax que busca en el servidor los datos  */
			function graficoObtieneDatos(){
					$('#graficoVentas').html("");
					$('#divloading').show();
					$('#actualizaIngTotales').attr("disabled", true);

					<?php IF ($cod=="RPTMENSUAL"){?>
						datos = {'startDate':startDate,'endDate':endDate,'cod': cod};
					<?php }?>
					<?php IF ($cod=="RPTPRODUCTO"){?>
						datos = {'cod': cod, 'prod': $( "#cntrl_id_producto" ).val()};
					<?php }?>

						
					jQuery.ajax({
						method: "POST",
							url: base_url+'Reporte/graficoObtieneDatos/',
							dataType: 'json',
							data:datos,
							success: function(res) {
								graficoProcesaDatos(res);
								dibujaGrafico();
							}
				});	
			}			
			


	

	
});
</script>





