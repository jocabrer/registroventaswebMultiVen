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
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"></li>
          </ol>
        </section>
      
        <!-- Main content -->
        <section class="content">
                    
		<div class="box">
		<div class="box-body">	
  						
                    <div class="form-inline" role="form" id="toolbar">
                                        
                        
                       <div class="input-group input-group-sm">
                       		<span class="input-group-btn">
                        	<input name="search" class="form-control input-sm" type="text" id="search" placeholder="Buscar">
                        	</span>
                        	<span class="input-group-btn">
                      			<select class="form-control input-sm" id="limit" name="limit">
                      				<option>5</option>
                      				<option>10</option>
                      				<option>20</option>
                      				<option>30</option>
                      				<option>50</option>
                      				<option>100</option>
                      				<option>1000</option>
                      				<option>10000</option>
                      			</select>  	
                        	</span>
                            <span class="input-group-btn">
                              <button  id="ok" type="button" class="btn btn-info">Ir!</button>
                            </span>
                       
                      </div>
                      
                      
                      
                      
                       <div class="input-group input-group-sm">
                       	      <span class="input-group-btn">
                             <button id="btn_eliminar" class="btn btn-danger">Eliminar Seleccionados</button>
                             </span>
                       
                       </div>
                        
                        
                        
                    </div>
                        
        	
        
        <div class="row">		
  			<div class="col-lg-12 col-md-12 col-xs-12">		
  		
  		        
                    <table id="tabladetallemovimientos"
                    
                    
                    	
                           data-show-columns="true"
                           data-show-refresh="true"
            			   data-show-export="true"
            			   
            			   
            			   data-pagination = "true"
            			   data-side-pagination="server"
            			   
            			   data-click-to-select="true"
            			
                           data-toggle="table"
            			
            			   data-query-params="queryParams"
            			
            			   data-toolbar="#toolbar"
            			
            			   data-method="post"
            			
            			   data-response-handler="responseHandler"
            					   data-url="<?php echo base_url(); ?>Cuenta/obtenerdetallemovimientos">
            					<thead>
            					<tr>
            						 <th data-checkbox="true">-</th>
            						 <th data-field="id_transaccion"  data-sortable="true" >Id.</th>
            						 <th data-field="id_cuenta" data-filterby="true">Nro. Cuenta</th>
            						 <th data-field="nombre_cuenta"  data-sortable="true" data-align="left">Nombre Cta.</th>
            						 <th data-field="nro_pedido"  data-sortable="true" data-align="left"  data-formatter="f_idpedido">Pedido</th>
            						 <th data-field="glosa"  data-sortable="true" data-align="left">Obs.</th>
            						 <th data-field="fecha_ingreso" data-sortable="true" >Fecha</th>
            						 <th data-field="debe" data-sortable="true" data-formatter="PriceFormatter"  data-align="right" >Monto Abono.</th>
            						 <th data-field="haber" data-sortable="true" data-formatter="PriceFormatter" data-align="right" >Monto Cargo</th>
            					</tr>
            					</thead>
            					</table>
            					
            					
            			</div>
            			
            								
                    </section><!-- /.content -->
            </div><!-- row -->
            
            </div><!-- box body -->
            </div><!-- box -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">


$(document).ready(function() {
	var $idpedido = <?php echo $idpedido; ?> ;
	var $table = $('#tabladetallemovimientos');
    var $ok = $('#ok');  
    var $search = $('#search');

	if($idpedido!=-1){
		$search.val($idpedido);
		$table.bootstrapTable('refresh');
	}
	
	$ok.click(function() {$table.bootstrapTable('refresh');});
	
	$('#btn_eliminar').click(function () {

		if ($('#tabladetallemovimientos').bootstrapTable('getSelections')==""){
			alert("Ninguna linea seleccionada.");
		}
		else
		{
    		if(confirm('¿ Seguro desea eliminar la transacción ? ')){
        		
    			var ids = $('#tabladetallemovimientos').bootstrapTable('getSelections');
    			console.log(ids.length); 
    			eliminaTransacciones(ids);
    			//console.log(data);
				//console.log(data.length); 
				//for (x=0;x<data.length;x++){
				//var ids = $.map(data[x], function (item) {
					//alert(data[x]['id_transaccion']);
					//console.log(item);
				//	$i = data[x]['id_transaccion'];
	    			//eliminaTransaccion($i);
	    		//});
				//}
	    		
    		}
		}
	});
});	

function eliminaTransacciones(ids){
		jQuery.ajax({
					method: "POST",
					url: "<?php echo base_url(); ?>Cuenta/eliminaTransacciones/",
					data:{ids},
					dataType: 'json',
					success: function(data){callback_elimina(data)}
		});		
}


function callback_elimina(data){

		if(!data)
			alert("Hubo un error al tratar de eliminar la línea :(, favor actualizar la página y reintentar...");
		
		alert('Línea(s) borrada(s)');

		var $table = $('#tabladetallemovimientos');
		$table.bootstrapTable('refresh');
}


/**
 * Procesa la respuesta del metodo que carga v�a ajax los datos a la tabla.
 */
function responseHandler(res){

	return res;
}

/**
 * Funcion que setea los parametros.
 */
/*function queryParams(params) {
	
    $('#toolbar').find('input[name]').each(function () {
        params[$(this).attr('name')] = $(this).val();
    });
    
    return params;
}*/

function queryParams(params) {
	
    $('#toolbar').find('input[name]').each(function () {
        params[$(this).attr('name')] = $(this).val();
    });


    params['limit'] = $('#limit').val();
    
    return params;
}



</script>