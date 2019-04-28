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


	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
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
                <div class="box-footer">
                  Footer
                </div>
                <!-- /.box-footer-->
           </div><!-- box -->
        </div>
        
        
        <div class="col-md-9 col-sm-6 col-xs-12">
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Procesar</h3>
        
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>
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
                 
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  
                </div>
                <!-- /.box-footer-->
           </div><!-- box -->
        </div>
   </div>
   
 <div class="box">
	<form method="post" action="/">
	<div class="box-body">
		
		  <div class="row" id="printable">
			<div class="col-md-12 col-sm-12 col-xs-12">
    			<table id="tbl_result_hoja"  
    					 data-show-columns="true"
    					 data-show-footer="false"    					 
    			 		 data-toggle="table"
			   			 data-show-export="true"
    			<thead>
				    <tr>	
    			 		<th data-field="tipo" data-visible="true"  data-align="center">Tipo</th>
    			 		<th data-field="fechaingreso" data-visible="true"  data-align="center">Ingreso Pedido</th>
    			 		<th data-field="pedido" data-visible="true"  data-align="center" data-formatter="f_idpedido">Pedido</th>
    			 		<th data-field="cantidad" data-visible="true"  data-align="center">Cantidad</th>
    			 		<th data-field="producto" data-visible="true"   data-align="left" data-footer-formatter="totalTextFormatter">Producto</th>
    			 		<th data-field="costo_cu"  data-formatter="PriceFormatter"  data-visible="true" data-footer-formatter="sumFormatter"  data-align="right" >Costo c/u</th>
    			 		<th data-field="tot_costo"  data-formatter="PriceFormatter"  data-visible="true"  data-footer-formatter="sumFormatter"  data-align="right">Total Costo</th>
    			 		<th data-field="pagado"  data-formatter="PriceFormatter"  data-visible="true"  data-footer-formatter="sumFormatter"  data-align="right" >Pagado</th>
    			 		<th data-field="iva"  data-formatter="PriceFormatter"  data-visible="true"  data-footer-formatter="sumFormatter"  data-align="right" >IVA</th>
    			 		<th data-field="saldo"  data-formatter="PriceFormatter"  data-visible="true"  data-footer-formatter="sumFormatter"  data-align="right">Saldo</th>
    			 		</tr>
  			 		</thead>
    			</table>
			</div>
		</div>
	</div><!-- Div class box body -->
	</form>
    </div><!-- .div box -->
<!-- <button class="print" id="btn_imprimir"> Print this </button> -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<<script type="text/javascript">
$(document).ready(function() {
		$('#btn_proc').click(function(){procesa()});
		$('#btn_cons').click(function(){muestraHoja()});
});
function muestraHoja(){
	var nombreHoja = $('#sl_hojas').val();	
	actualizaHoja(nombreHoja);
}
function actualizaHoja(nombreHoja){
	$('#tbl_result_hoja').bootstrapTable('destroy').bootstrapTable
	  ({
			    url: '<?php echo base_url(); ?>Reporte/muestraHoja/'+nombreHoja,
			    method:"GET",
				dataType: 'json',
				columns:[
					
					{field: 'tipo',align: 'center',title: 'Tipo'},
					{field: 'fecha_ingreso',align: 'center',title: 'Ingreso Pedido'},
					{field: 'id_cabecera',title: 'Pedido',formatter:f_idpedido}, 
					

					{field: 'cantidad',title: 'Cantidad'},
					{field: 'producto',title: 'Producto',align:'left'},

					{field: 'costo_cu',title: 'Costo c/u',align:'left',formatter:PriceFormatter},
					{field: 'tot_costo',title: 'Total Costo',align:'left',formatter:PriceFormatter},
					{field: 'pagado',title: 'Pagado',align:'left',formatter:PriceFormatter},
					{field: 'iva',title: 'Iva',align:'left',formatter:PriceFormatter},
					{field: 'saldo',title: 'Saldo/Abono',align:'left',formatter:PriceFormatter}
	  			]
    }
	);
}
function procesa() {

	
		//Si es consulta se toma el valor de la hoja solamente 
	params=[];

	
	var nrospedidos=  $("#nrospedidos").val().split(",");
	var nombrehoja=  $("#nombrehoja").val();
	var tipohoja =  $("#tipohoja").val();


    jQuery.ajax({
		method: "POST",
			url: "<?php echo base_url(); ?>Reporte/procesaHoja",
			dataType: 'json',
			data: {nrospedidos:nrospedidos,nombrehoja:nombrehoja,tipohoja:tipohoja},
			success: function(res) {
				if (res == false){
					alert("Problema al procesar");
				}
				else{ 
					alert("Proceso OK "+res);
					$('#sl_hojas').val(nombrehoja);
					actualizaHoja(nombrehoja);
				}
			},
			
	}); //jqueryajax		
}


/*function buscaComisiones($vartrue){

	$('#flag_procesa').val($vartrue);
	
	 var $table = $('#tbl_result_hoja');
		$table.bootstrapTable('refresh');
}*/
	 
   	  
/*function queryParams(params) {

	params['procesa'] = $('#flag_procesa').val();


	//Si es consulta se toma el valor de la hoja solamente 
	if(params['procesa']==false)
	{
		params['nombrehoja'] =  $("#sl_hojas").val().split(",");
	}else
	{
		params['nrospedidos']=  $("#nrospedidos").val().split(",");
		params['nombrehoja']=  $("#nombrehoja").val();
		params['tipohoja']=  $("#tipohoja").val();
	}

	
    return params;
}

function responseHandler(res){

	return alert(res);
}*/



/* 
Control busqueda de la hoja
*/ 

$("#sl_hojas").select2({
		ajax: {
		        url: "<?php echo base_url(); ?>Reporte/listadoControlHojas/",
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



	
