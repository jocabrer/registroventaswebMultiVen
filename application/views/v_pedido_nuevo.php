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
 <form role="form">
 <div class="box">
 	<div class="box-header with-border">
  		
  	</div><!-- Box Header -->
  	<div class="box-body">		
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
			
    			<div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Seleccione un cliente</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                     
                        <!-- text input -->
                        <div class="form-group">
                          <label>Clientes ingresados</label>
                           <select id="cntrl_id_cliente"  
								    class="form-control" 
								    name="cntrl_id_cliente" 
								    style="width:100%;" data-error="Buscar cliente" required>
								    
								    </select>
							 
						</div>

						<div id="agregarpedido">
							<div class="form-group">
									<label>Comisión</label>
									<select id="sl_comision" name="sl_comision"  class="form-control" >
											<option value="1">No</option>
											<option value="0">Si</option>
											
									</select>
							</div> 
							<div class="form-group">
								<button  id="btn_agregar_pedido" type="button" class="btn bg-olive" title="Agregar nuevo pedido" ><i class="fa fa-edit"></i> Nuevo Pedido Cliente</button></span>
							</div>
						</div>
                    </div>
                    <div class="box-footer" style="display:inline;">
                    			<div class="row">
                    				<div class="col-md-6 col-sm-6 col-xs-12 text-left">
                                			
                                				<a id="btnback" class="btn btn-default"><li class="fa fa-rotate-left"></li> Volver</a>
                                			
                                	</div>
                                	<div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                			
                                                <a class="btn btn-default" href="<?php echo base_url('Cliente/edicion'); ?>">
                                					<span class="badge bg-purple">+</span>
                                					<i class="fa fa-users"></i> Nuevo Cliente
                              					</a>
                          					
                          			</div>
              					</div>
                    </div>
                    <!-- /.box-body -->
                </div>
			</div>
		</div>
	</div><!-- Div class box body -->
	
	
</div><!-- .div box -->
</form>     

</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<script type="text/javascript">






//http://davidstutz.github.io/bootstrap-multiselect/
//https://github.com/wenzhixin/bootstrap-table/blob/master/src/extensions/export/README.md
$(document).ready(function() {

	
	$("#agregarpedido").hide();
	//********** Control Cliente **************************************		
	var $select = $("#cntrl_id_cliente");
	$select.select2({
		ajax: {
		        url: "<?php echo base_url(); ?>Cliente/listadoClientes/",
		        dataType: 'json',
		        method:'get',
		        quietMillis: 250,
		        processResults: function (data, page) {
		        	var res = [];
			    	for(var i = 0; i < data.length; i++){
			    	    res[i] = {id:data[i].id,text:data[i].nombre};
			    	}
			    	 return {results: res};
			         var more = (page * 30) < res.total_count; // whether or not there are more results available


			         // Here we should have the data object
			        	$option.text(data.text).val(data.id); // update the text that is displayed (and maybe even the value)
			        	$option.removeData(); // remove any caching data that might be associated
			        	$select.trigger('change'); // notify JavaScript components of possible changes
			 			
		            // notice we return the value of more so Select2 knows if more results can be loaded
		            return { results: res, more: more };
		        }
		    },
		    escapeMarkup: function (m) { return m; }, // we do not want to escape markup since we are displaying html in results
		    placeholder: "Seleccione un cliente"
	});



	$('#cntrl_id_cliente').change(function(){

		if($('#cntrl_id_cliente').val()!=null){
			$("#btn_agregar_pedido").text("Crear pedido para cliente " + $('#cntrl_id_cliente').val());
			$("#agregarpedido").show();
		}else{
			$("#agregarpedido").hide();
		}
	});

	$("#btn_agregar_pedido").click(function(){

		var idcliente = $('#cntrl_id_cliente').val();
		var comision = $('#sl_comision').val();

		if(idcliente!=null){
        		//$('#btn_agregar_pedido').prop("disabled",true);1
        		$.ajax({
        			  type: "POST",
        			  url: "<?php echo base_url(); ?>Pedido/grabaCabecera/",
        			  data: {idpedido:-1,idcliente,comision},
        			  success: pedidoGrabadoCall,
        			  dataType: 'json'
        			});
		}
	});
		
	
});


function procesar(){
	
	var idpedido =  $("#txt_numeropedido").val();
	var idcliente =  $("#txt_numerocliente").val();
	$(location).attr('href',  "<?php echo base_url(); ?>seguimiento/ver/"+idpedido+"/"+idcliente)
		//window.location.href = "<?php echo base_url(); ?>seguimiento/ver/";
	
	}
$('#btnback').click(function () {
	window.history.back();
});


function pedidoGrabadoCall(res)
{
	if (res.estado!=-1)
	{
		alert ('Pedido grabado correctamente ' + res.id );
		window.location.href = "<?php  echo base_url(); ?>Pedido/editarPedido/"+res.id;
	}else
	{
		$('#btn_agregar_pedido').prop("disabled",false);
		alert(res.mensaje);
	}
}


</script>

		  
			
			


	

