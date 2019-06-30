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

	<!-- hojas recientes -->
	<div class="box box-primary">
		<div class="box-header with-border">
				<h3 class="box-title">Hojas Recientes</h3>
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

	<div class="table">
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
									
									<select class="form-control" id="sl_hojas">
										
									
									</select>			
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
												<a class="btn btn-default" id="btn_cons"><i class="fa fa-search"></i> Consultar</a>
								</div>
							</div>
						
						</div>
						<!-- /.box-body -->
					
						<!-- /.box-footer-->
				</div><!-- box -->
			</div>
			
		</div><!--row-->
	</div><!-- class = table -->
        
	
	<div class="box">
				<div class="box-header with-border">
				 <h3 class="box-title">Hoja proceso #<label id="lbl_nombrehoja"></label></h3>
				<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
							<i class="fa fa-minus"></i></button>
							
						</div>
						</div>
						<div class="box-body" style="width:100%;">
						
						<table id="tbl_result_hoja"  
    					 data-show-columns="true"
    					 data-show-footer="false"    					 
    			 		 data-toggle="table"
			   			 data-show-export="true">
    			
    			</table>
						
						</div>
						<!-- /.box-body -->
					
						<!-- /.box-footer-->
				</div><!-- box -->
			</div>
     
 
<!-- <button class="print" id="btn_imprimir"> Print this </button> -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<<script type="text/javascript">
	$(document).ready(function() {

		//Seteo eventos 
		$('#btn_proc').click(function(){procesa()});
		$('#btn_cons').click(function(){seteaHojaDesdeConsulta()});
		
		

		//Inicializo widget
		ultimasHojasProcesadas();

		//Identificamos hoja actual
		var idhoja  = <?php echo $idhoja; ?>;
		//Si existe hoja actualizamos para mostrar
		if(idhoja!=-1)
			muestraTablaHojas(idhoja);
	});

	window.eventoTablaHojas = {'click .remove': function (e, value, row, index) {eliminaHoja(row);}};
	
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
					MuestraMensaje("Módulo Hojas",res.mensaje);
					ultimasHojasProcesadas();
				}
			},
			
	}); //jqueryajax		
}

function seteaHojaDesdeConsulta(){
	var nombreHoja = $('#sl_hojas').val();	
	muestraTablaHojas(nombreHoja);
}
function muestraTablaHojas(nombreHoja){
	$('#tbl_result_hoja').bootstrapTable('destroy').bootstrapTable
	  ({
			    url: '<?php echo base_url(); ?>Reporte/muestraHoja/'+nombreHoja,
			    method:"GET",
				dataType: 'json',
				columns:[
					
					{field: 'tipo',align: 'center',title: 'Tipo'},
					
					{field: 'id_cabecera',title: 'Pedido',formatter:f_idpedido}, 
					

					{field: 'cantidad',title: 'Cantidad'},
					{field: 'producto',title: 'Producto',align:'left'},

					{field: 'costo_cu',title: 'Costo c/u',align:'left',formatter:PriceFormatter},
					{field: 'tot_costo',title: 'Total Costo',align:'left',formatter:PriceFormatter},
					{field: 'iva',title: 'Iva',align:'left',formatter:PriceFormatter},
					{field: 'pagado',title: 'Pagado',align:'left',formatter:PriceFormatter},
					{field: 'saldo',title: 'Saldo/Abono',align:'left',formatter:PriceFormatter},
					{field: 'saldovendedor2',title: 'Vendedor 2',align:'left',formatter:PriceFormatter}
	  			]
    }
	);
	//alert(nombreHoja);
	$('#lbl_nombrehoja').text(nombreHoja);
	//$('#sl_hojas').text(nombrehoja);
	$("#nombrehoja").attr('value',$('#lbl_nombrehoja').text());
}
function procesa() {

	
		//Si es consulta se toma el valor de la hoja solamente 
	params=[];

	
	var nrospedidos=  $("#nrospedidos").val().split(",");
	var nombrehoja=  $("#nombrehoja").val();
	var tipohoja =  $("#tipohoja").val();


    jQuery.ajax({
		method: "POST",
			url: "<?php echo base_url('Reporte/procesaHoja'); ?>",
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
					   {field: 'fecha_mod',title: 'Ult. Modificación'},
					   {field: 'operate',title: 'Eliminar',align: 'center',events:eventoTablaHojas,formatter:operateFormatter}
					   
		   ]
   }
	);
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



	

