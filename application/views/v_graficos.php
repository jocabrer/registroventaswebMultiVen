
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
															<h3 class="box-title" id="tituloperiodo">Periodo</h3>
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
				<div class="box-footer text-center">
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


					configuraOpcionesGrafico();
					inicializaEventos();
					
		
					/* Setea eventos de los botones que refrescan */
					function inicializaEventos(){
							$('#actualizaIngTotales').click(function(){graficoObtieneDatos();});
							$('#actualizaIngTotales').attr("disabled", true);
							$('#divloading').hide();
							inicializaControlRangoFecha();
							
					}
					/* Inicializa el control de rango de fechas */
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
									$('#reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
									startDate = start.format('YYYY-MM-DD');
									endDate = end.format('YYYY-MM-DD');

									$('#actualizaIngTotales').attr("disabled", false);
									$('#tituloperiodo').html('Desde '+startDate +', hasta '+ endDate);
							}
							);
					}

					/* configura las opciones del grรกfico */
					function configuraOpcionesGrafico(){

									/* lo destuyo */
									$('#graficoVentas').html("");
									   
							areaChartOptions = {
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

							//cubicInterpolationMode:'monotone',


							//Boolean - Whether to fill the dataset with a color
							datasetFill: false,
							//String - A legend template
							legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
							//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
							maintainAspectRatio: false,
							//Boolean - whether to make the chart responsive to window resizing
							responsive: true,
							tooltips: {
										mode: 'x'
									},
								scales: {
									yAxes: [{
										ticks: {
											// Include a dollar sign in the ticks
											callback: function(value, index, values) {
												return PriceFormatter(value);
											}
										}
										
									}
									]
								}
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
					function graficoVentasProcesaDatos(res){
						console.log(res);
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
							/*periodos.push(res.ant[i].mes);*/
						}

						chartdata = {
                        labels: periodos,
                        datasets: [
                            {
                                label: 'Ventas Periodo actual' ,
								backgroundColor: 'rgb(243, 156, 18)',
								borderColor: 'rgb(243, 156, 18)',
								fill: false,
                                data: montos
							},
							{
                                label: 'Ganancia Periodo Actual ',
								backgroundColor: 'rgb(47, 51, 54)',
								   borderColor: 'rgb(47, 51, 54)',
								fill: false,
                                data: montosGanancia,
								hidden: true
							},
							{
                                label: 'Ventas periodo anterior',
								backgroundColor: 'rgb(38, 154, 188)',
								borderColor: 'rgb(38, 154, 188)',
								fill: false,
                                data: montosAnt
                            },
							{
                                label: 'Ganancias periodo anterior',
								backgroundColor: 'rgb(245, 201, 196)',
								borderColor: 'rgb(245, 201, 196)',
								fill: false,
                                data: montosGananciaAnt,
								hidden: true
                            }
							]
						};

					
						console.log(chartdata);
					}

	
					/* Metodo ajax que busca en el servidor los datos  */
					function graficoObtieneDatos(){
							$('#graficoVentas').html("");
							$('#divloading').show();
							$('#actualizaIngTotales').attr("disabled", true);

							jQuery.ajax({
								method: "POST",
									url: base_url+'Reporte/graficoObtieneDatos/',
									dataType: 'json',
									data:{'startDate':startDate,'endDate':endDate,'cod': cod},
									success: function(res) {
										$('#actualizaIngTotales').attr("disabled", false);
										graficoVentasProcesaDatos(res);
										dibujaGrafico();

									}
						});	
					}
});
</script>
 


	

