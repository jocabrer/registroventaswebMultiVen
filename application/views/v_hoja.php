<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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
		<!-- hojas recientes -->
		<div class="box box-primary">
			<div class="box-header with-border">
					<h3 class="box-title">Últimas hojas</h3>
					<div class="box-tools pull-right">
				
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
					</button>
				
					
					</div>
			</div>	  <!-- /.box-header -->
			<div class="box-body">			  
						<table id="tbl_ultimashojas" class="table"></table>	   
			</div><!-- box body -->
		</div><!-- box primary -->
		<!-- / fin hojas recientes -->
	</div>
	

	
		<div class="row">
		<div class="col-md-8 col-sm-6 col-xs-12">
			<div class="box" id="cajaUltimasHojas">
						<div class="box-header with-border">
						<h3 class="box-title">Procesar</h3>
							
						</div>
						<div class="box-body" style="width:100%;">
						
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<label>Pedidos</label>
									<input type="text" class="form-control pull-right"	id="nrospedidos" />
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label>Nombre Hoja</label>
									<input type="text" class="form-control pull-right"	id="nombrehoja" />
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label>Tipo</label>
									<!-- <input type="text" class="form-control pull-right"	id="tipohoja" /> -->
									<select class="form-control" id="tipohoja">
										<option>-</option>
										<option>Saldo</option>
										<option>Abono</option>
										<option>Reembolso</option>
										<option>Otro</option>
									</select>			
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<label>Procesar</label><br/>
									<a class="btn btn-default" id="btn_proc"><i class="fa fa-gear"></i> Procesar </a>
									<input type="hidden" id="flag_procesa" value="false">
								</div>
							
							</div><!-- Row -->
						
						</div><!-- /.box-body -->

						
						<div class="box-footer">
						
						</div>
						<!-- /.box-footer-->
				</div><!-- box -->
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box">
						<div class="box-header with-border">
								<h3 class="box-title">Consultar</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
									<i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
									<i class="fa fa-times"></i></button>
								</div>
						</div>
						<div class="box-body" style="width:100%;">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control" id="sl_hojas"></select>			
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<a class="btn btn-default" id="btn_cons"><i class="fa fa-search"></i> Consultar hoja</a>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					
						<!-- /.box-footer-->
				</div><!-- box -->
			</div>
			
		</div><!--row-->
	
		<div class="box box-success">
				<div class="box-header with-border">
						<h3 class="box-title">Hoja proceso #<label id="lbl_nombrehoja"></label></h3>
				</div><!-- .header -->
				<div class="box-body">
						<table id="tbl_result_hoja"  
						data-show-columns="true" 
						data-show-footer="true"    					 
						data-toggle="table" 
						data-show-export="true"  data-side-pagination="server"
						data-url="<?php echo base_url('Reporte/muestraHoja/'); ?>"
						data-query-params="parametrosHoja"
						data-response-handler="respuestaListadoHoja"
						data-method="post"
						>

						<thead>
							<tr>
									<th data-field="tipo"  data-sortable="false" data-align="center" >Tipo</th>
									<th data-field="id_cabecera"  data-sortable="false" data-align="" data-formatter="f_idpedido">Pedido</th>
									<th data-field="cantidad"  data-sortable="false" data-align="center" data-formatter="">Cantidad</th>
									<th data-field="producto"  data-sortable="false" data-align="left" data-formatter="" data-footer-formatter="totalTextFormatter">Producto</th>
									<th data-field="costo_cu"  data-sortable="false" data-align="right"  data-formatter="PriceFormatter" data-footer-formatter="sumFormatter">Costo c/u</th>
									<th data-field="tot_costo"  data-sortable="false" data-align="right" data-formatter="PriceFormatter" data-footer-formatter="sumFormatter">Total Costo</th>
									<th data-field="iva"  data-sortable="false" data-align="right"  data-formatter="PriceFormatter" data-footer-formatter="sumFormatter">Iva</th>
									<th data-field="pagado"  data-sortable="false" data-align="right"  data-formatter="PriceFormatter" data-footer-formatter="sumFormatter">Pagado</th>
									<th data-field="saldo"  data-sortable="false"data-align="right"  data-formatter="PriceFormatter" data-footer-formatter="sumFormatter">Saldo/Abono</th>
									<th data-field="saldovendedor2"  data-sortable="false" data-align="right"  data-formatter="PriceFormatter" data-footer-formatter="sumFormatter">Comisión</th>

									
					
					
					
					
					
					
					
				
							</tr>
						</thead>
													
						</table>
				</div><!-- /.box-body -->
		</div><!-- box -->

	<div class="box box-warning">
		<div class="box-header with-border"><h3 class="box-title"> Alertas </h3></div>
		<div class="box-body">
			<?php 
			if(isset($alertas))
			{
				if(count($alertas)==0)
					echo "sin alertas";
				foreach($alertas as $alerta) { 
					echo $alerta->texto."<br>";  
				}

			}
			?>
		</div>
	</div>
 
</section><!-- /.content -->

	</div><!-- /.content-wrapper -->

<script type="text/javascript">

	$(document).ready(function() {

		//Seteo eventos 
		$('#btn_proc').click(function(){procesa()});
		$('#btn_cons').click(function(){seteaHojaDesdeConsulta()});
		window.eventoTablaHojas = {'click .remove': function (e, value, row, index) {eliminaHoja(row);}};
		
		//Inicializo widget
		ultimasHojasProcesadas();

		//Identificamos hoja actual
		var idhoja  = "<?php echo $idhoja; ?>";
		//Si existe hoja actualizamos para mostrar
		if(idhoja!=-1)
			muestraTablaHojas(idhoja);
	});

	
	
function eliminaHoja(row){
	jQuery.ajax({
		method: "POST",
			url: base_url+"Reporte/eliminaHoja",
			dataType: 'json',
			data: {nombre_hoja:row.nombre_hoja},
			success: function(res) {
				if (res == false){
					alert("Problema al procesar");
				}
				else{ 
					MuestraMensaje("Mรณdulo Hojas",res.mensaje);
					ultimasHojasProcesadas();
				}
			},
			
	}); //jqueryajax		
}

function seteaHojaDesdeConsulta(){
	var nombreHoja = $('#sl_hojas').val();	
	muestraTablaHojas(nombreHoja);
}

function parametrosHoja(params){
		params['hoja'] =$('#lbl_nombrehoja').text();
		return params;
}

function respuestaListadoHoja(res){
	return res;
}

function muestraTablaHojas(nombreHoja){
	

	$('#lbl_nombrehoja').text(nombreHoja);
	$("#nombrehoja").attr('value',$('#lbl_nombrehoja').text());
	$('#tbl_result_hoja').bootstrapTable('refresh');
}

function procesa() {
		//Si es consulta se toma el valor de la hoja solamente 
	params=[];
	var nrospedidos=  $("#nrospedidos").val().split(",");
	var nombrehoja=  $("#nombrehoja").val();
	var tipohoja =  $("#tipohoja").val();

    jQuery.ajax({
		method: "POST",
			url: base_url+'Reporte/procesaHoja',
			dataType: 'json',
			data: {nrospedidos:nrospedidos,nombrehoja:nombrehoja,tipohoja:tipohoja},
			success: function(res) {
				if (res == false){
					alert("Problema al procesar");
				}
				else{ 
					MuestraMensaje("Modulo Hojas",res.mensaje);
					$('#sl_hojas').val(nombrehoja);
					muestraTablaHojas(nombrehoja);
				}
			},
	}); //jqueryajax		
}


function ultimasHojasProcesadas(){
	$('#tbl_ultimashojas').bootstrapTable('destroy').bootstrapTable
	({
		   url: base_url+'Reporte/ultimasHojasProcesadas/',
		   method:"GET",
		   dataType: 'json',
		   columns:[
					   {field: 'nombre_hoja',title: 'Hoja',formatter:'f_nombrehojalink'}, 
					   {field: 'fecha_proceso',title: 'Fecha proceso'},
					   {field: 'fecha_mod',title: 'Ult. Modificaciรณn'},
					   {field: 'operate',title: 'Eliminar',align: 'center',events:eventoTablaHojas,formatter:operateFormatter}
		   ]});
}

/* 
Control busqueda de la hoja
*/ 
$("#sl_hojas").select2({
		ajax: {
		        url: base_url+"Reporte/listadoControlHojas/",
		        dataType: 'json',
		        method:'get',
		        quietMillis: 250,
		        maximumSelectionSize: 0,
		        processResults: function (data, page) {
		        	var res = [];
			    	
			    	for(var i = 0; i < data.length; i++){
			    	    res[i] = {id:data[i].nombre_hoja,text:data[i].nombre_hoja};
			    	}
			    	 return {results: res};

			            var more = (page * 30) < res.total_count; // whether or not there are more results available
		 			
		            // notice we return the value of more so Select2 knows if more results can be loaded
		            return { results: res, more: more };
		        }
		    },
		    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
		});


</script>



	

