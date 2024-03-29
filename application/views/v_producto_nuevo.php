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
	<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
	<li><a href="<?php echo base_url($currentClass); ?>"><?php echo $currentClass ?></a></li>
	<li class="active"><?php echo $currentAction ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box" style="width:80%;">
  <!-- Your Page Content Here -->
	<div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  		<h3 class="box-title"><?php echo $descHeader; ?></h3>
				    	<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse" 
								data-toggle="tooltip" title="" data-original-title="Collapse">
									<i class="fa fa-plus"></i></button>
				    	</div>
               </div><!-- /.box-header -->
                <div class="box-body">
                 		<form role="form" data-toggle="validator" id="frm_pedido">
                 		<div class="row">
                 			
                 			<div class="col-lg-9 col-md-9 col-xs-12">
 								<div class="form-group">
		                 		  <label for="cntrl_codigo" 
		                 		  	class="control-label">Cod.:
		                 		  </label>
								  <input type="text" class="form-control" id="txt_codProd" placeholder="" value="<?php echo $proEdit['Codigo']; ?>" readonly>
								  
								</div>
								
							</div>
							
                 			<div class="col-lg-9 col-md-9  col-xs-12">
                 			
								<div class="form-group">
								  <label for="cntrl_categoria_prod" 
		                 		  	class="control-label">Categoria:
		                 		  </label>
		                 		  
		                 		  	<select id="cntrl_categoria_prod"  
								    class="form-control" 
								    name="cntrl_categoria_prod" 
								    style="width:100%;" data-error="Seleccione una categoria!" required>
								    
								    <?php 
								    foreach($categorias as $cat){
								        $esselected = ($proEdit['id_categoria']==$cat["id"])?"selected":"";
								        echo "<option value='".$cat["id"]."'".$esselected." >".$cat["nom_categoria"]."</option>";
								    }
								    ?>
								    
								    
								    </select>
		                 		  
								 </div>
							</div>
							
 							
							<div class="col-lg-9 col-md-9 col-xs-12">
								<div class="form-group">
								  <label for="cntrl_codigo" 
		                 		  	class="control-label">Nombre:
		                 		  </label>
		                 		  <input type="text" class="form-control" 
								  id="txt_nomProd" placeholder="- bandeja enlozada-"  value="<?php echo $proEdit['Nombre']; ?>" required>
								 </div>
							</div>
						</div><!-- Row -->
						<div class="row">
							<div class="col-lg-10 col-md-10  col-xs-10">
								<label for="cntrl_codigo">	
									Descripción:
								</label>
								 <textarea id="txt_descProd" class="form-control" rows="3" placeholder="Datos extra."><?php echo $proEdit['Descripcion']; ?></textarea>
							</div>
						</div><!-- Row -->		
						<div class="row">
							<div class="col-lg-3 col-md-6  col-xs-6">
							   <div class="form-group">
							    <label for="txt_costoventa" 
		                 		  	class="control-label">Valor costo:
		                 		  </label>
								<input type="text" class="form-control" id="txt_costoventa" 
								placeholder="Costo venta" value="<?php echo $proEdit['costo']; ?>" required>
							   </div>
							</div>
							<div class="col-lg-3 col-md-6  col-xs-6">
								<div class="form-group">
								 <label for="txt_precioventa" 
		                 		  	class="control-label">Valor venta:
		                 		  </label>
								<input type="text" class="form-control" id="txt_precioventa"  
								placeholder="Precio venta" value="<?php echo $proEdit['valor_venta']; ?>" required>
								</div>
							</div>
						</div>
						
                 		
                </div><!-- /.box-body -->
  				<div class="box-footer">
  					<input type="hidden" id="idproducto" value="<?php echo $proEdit['id'];?>">
  					<div class="row">
  						<div class="col-lg-4 col-md-4  col-xs-12 text-left">
  							<a id="btnback" class="btn btn-default"><li class="fa fa-rotate-left"></li> Volver</a>	
  						</div>
  						<div class="col-lg-2 col-md-2  col-xs-12 text-right">
  							<a id="btnback" class="btn btn-default"  href="<?php echo base_url('Productos/agregar'); ?>">
  								<li class="fa fa-plus"></li> Nuevo
  							</a>
  						</div>
  						<div class="col-lg-4 col-md-4  col-xs-12 text-right">
  							<button  id="btn_guardar_det" type="submit"	class="btn btn-default"	title="Guardar" ><i class="fa fa-save"></i> Grabar</button>	
  						</div>
  					</div>
    			</div>
               </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
			
			
    </div><!-- /.Row -->
</div>

  
</section><!-- /.content -->
</div><!-- /.content-wrapper -->



<div class="modal modal-info" id="divproductos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Productos similares :</h4>
      </div>
      <div class="modal-body">
        <p id="pProductos">
        
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="btn_cerrar">Cerrar</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
			
$(document).ready(function() {

	
	$('#txt_nomProd').change(function () {

		/*Buscar productos ya ingresados*/
		$("#txt_descProd").val($('#txt_nomProd').val());
		validarProducto($('#txt_nomProd').val());
	    
	});

	/* Valida si cliente exciste en base a criterio que puede ser*/
	function validarProducto(criterio)
	{
		obj = {search: criterio, order: "asc", limit: "20", offset: 0};

		$.ajax({
			  type: "POST",
			  url: base_url+'Productos/ajax_getProductos/',
			  data: JSON.stringify(obj),
			  success: productosSimilares,
			  dataType: 'json'
			});
	}

	function productosSimilares(res){


		var url = base_url+'Productos/agregar/';
		 
		$("#pProductos").html("");
		var jsonData = res.rows;
		
		if(jsonData.length>0){
	    	for (var i = 0; i < jsonData.length; i++) {
	    	    var id = pad(jsonData[i].id, 5, "&nbsp;");
	    	    var codigo = pad(jsonData[i].Codigo, 5, "&nbsp;");
	    	    var nombre = pad(jsonData[i].Nombre,100,"&nbsp;");
	    	    $("#pProductos").append("<a href='"+url+""+id+"'>"+id+"  -"+codigo+"       "+nombre+"</a><br>");
	    	}
		$("#divproductos").modal('show');
		}
	}

	
	$('#cntrl_categoria_prod').change(function () {

		$('#txt_nomProd').val( $("#cntrl_categoria_prod :selected").text());
		catid = $("#cntrl_categoria_prod").val();

	
		
	});

	
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

	$("#frm_pedido").validate({submitHandler: function(form)
	{


		$(':input[type="submit"]').prop('disabled', true);
				
		//TODO validacion antes de grabar
		event.preventDefault();
	
		var txt_codProd    =  $("#txt_codProd").val();
		var txt_nomProd  =  $("#txt_nomProd").val();
		var txt_descProd  =  $("#txt_descProd").val();
		
		var txt_costoventa =  $("#txt_costoventa").unmask();
		var txt_precioventa=  $("#txt_precioventa").unmask();
		

		var idproducto = $("#idproducto").val();
		var idcategoria = $("#cntrl_categoria_prod").val();

		
			
		if(parseInt(txt_precioventa)<parseInt(txt_costoventa))
		{
			MuestraMensaje("Producto NO grabado","El precio de venta no puede ser inferior al costo del producto");
			$(':input[type="submit"]').prop('disabled', false);
		}else{
        		jQuery.ajax({
        		method: "POST",
        			url: "<?php echo base_url('Productos/save');?>",
        			dataType: 'json',
        			data: {txt_codProd,txt_nomProd,txt_costoventa,txt_precioventa,idproducto,txt_descProd,idcategoria},
        			success: function(res) {
        						$(':input[type="submit"]').prop('disabled', false);
        						if (res.id != -1){
        							MuestraMensaje("Producto grabado correctamente",res.mensaje);
        							$('#modalDinamico').on('hidden.bs.modal', function () {window.location.href = "<?php echo base_url('Productos/agregar'); ?>/"+res.id;});
        							
        						}else{
        							MuestraMensaje("Producto NO grabado","El producto NO se grabó, Error "+res.mensaje);
        						}
        				}
        		}); //jqueryajax
		}
		


		}//function form	
	});
	
	
	$('#btnback').click(function () {
		window.history.back();
	});
	
}); //Function ready
</script>
 


	

