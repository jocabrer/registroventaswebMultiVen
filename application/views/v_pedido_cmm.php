<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
 <h1>Seguimiento Pedido<small>Comentarios</small></h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
	
	<li><a href="<?php echo base_url($currentClass); ?>"><?php echo $currentClass ?></a></li>
	
	<li class="active"><?php echo $currentAction ?></li>
  </ol>
</section>	  

<!-- Main content -->
<section class="content">
<form role="form" data-toggle="validator" id="frm_pedido">

<div class="box" id="bx_cliente">
	<div class="box-header with-border">
			<h3 class="box-title">Seguimiento pedido #<label id="lbl_id_pedido"><?php echo $id_pedido;?></label></h3>
	</div>
			<div class="box-body">
				&nbsp;
			</div><!-- /.box-body -->
</div><!-- BOX 1  -->
	
</form>




<div class="box" id="bx_infooter">
	&nbsp;	
</div>
</section>



</div>



<script type="text/javascript">
			
$(document).ready(function() {

	//inicio-----------------------------------------------------------------
	//Show hide blocks
	editagrega($("#numeroPedido").val());
	//Foprmateop de divisas para inputs
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

	//Calendario fecha
	$("#fecha_ingreso").daterangepicker({
		format: 'YYYY-MM-DD h:mm:s',	
		singleDatePicker: true,
	});	
	// Control estado
	$("#sl_estado").select2();
	
	// FIN inicio-----------------------------------------------------------------
		
	

	function editagrega(idpedido)
	{
		if (idpedido!=-1)
		{
			//pedido existe
			$('#div_cliente').hide();
			$('#div_clientexiste').show();
			$('#bx_infooter').show();
			//Muestro el label del numero de pedido
			$('#lbl_id_pedido').text(idpedido);
			$('#lbl_id_pedido').show();
			buscaLineaDetalle ();
		}else
		{
			//pedido nuevo
			$('#div_cliente').show();
			$('#div_clientexiste').hide();
			//Ultima actualizacion
			$('#bx_infooter').hide();
			//Id pedido
			$('#lbl_id_pedido').hide();
		}
	}


	/*
	* Recorre la tabla de detalle del pedido totalizando columnas
	*/
	function contarGanancia()
	{
		$("#tabla_detalle tbody").each(function (index) 
    	{
            
			var sumCampo7 = 0;  
			var sumCampo5 = 0 ; //costo id 4         
            $(this).children("tr").each(function (index2) 
            {
	            $(this).children("td").each(function (index3) 
	            {
	            	//alert($(this).text());
	            	
	            	if(index3== 5 )
	            	{
		            	//total venta :: NETO 
	            		sumCampo5 = sumCampo5 + Number($(this).text().replace(/[^0-9\,-]+/g,""));
	            	}
	            	if(index3== 7 )
	            	{
		            	//total venta :: NETO 
	            		sumCampo7 = sumCampo7 + Number($(this).text().replace(/[^0-9\,-]+/g,""));
	            	}
	            })
            })
            $('#lbl_totalganancia').text(PriceFormatter(sumCampo7));
            $('#lbl_subtotal').text(PriceFormatter(sumCampo5));
            $('#lbl_iva').text(PriceFormatter(sumCampo5*0.19));
            $('#lbl_totalapagar').text(PriceFormatter((sumCampo5*0.19)+sumCampo5));
        })
	}
	/*Fin contarGanancia*/
	
	/*
	* ACtualiza desde la BD los detalles del pedido, ontiene el pedido desde el hidden #numeroPedido
	*/
	function buscaLineaDetalle ()
	{
	  var idpedido 	=  $("#numeroPedido").val();
   	  $('#tabla_detalle').bootstrapTable('destroy').bootstrapTable
   	  ({
			    url: '<?php echo base_url(); ?>Pedido/ajax_getLinesPedido/' + idpedido,
			    onLoadSuccess: function (res) {contarGanancia();},
			    data:{idpedido:idpedido},
				method: "GET",
				columns:[
							{field: 'id_detalle',title: 'ID'},
							{field: 'cantidad',title: 'Qty',editable: true},
							{field: 'desc_prod',title: 'Desc.'}, 
							{field: 'Precio_vta',title: 'Venta',formatter: PriceFormatter,
									editable: {type: 'text',title: 'Item Price'},},
							{field: 'costo',title: 'Costo',editable: true,formatter: PriceFormatter},
							{field: 'total_vta',title: 'Total Venta',editable: true,formatter: PriceFormatter},
							{field: 'total_cos',title: 'Total Costo',editable: true,formatter: PriceFormatter},
							{field: 'ganancia',title: 'Ganancia',editable: true,formatter: PriceFormatter}
				]
        });
	}
	
	//Submit formulario detalle		
	$("#frm_det_pedido").validate({
  				submitHandler: function(form){
				//TODO validacion antes de grabar
				event.preventDefault();
				// Linea detalle
				var cantidad    =  $("#txt_cantidad").val();
				var costoventa  =  $("#txt_costoventa").unmask();
				var precioventa =  $("#txt_precioventa").unmask();
				var idproducto=  $("#cntrl_id_producto").val();
				var idpedido 	=  $("#numeroPedido").val();
				//Cabecera 
				var idcliente      =  $("#cntrl_id_cliente").val();
				
				var fecha_ingreso  =  $("#fecha_ingreso").val();
				var comm           =  $("#txt_comments").val();
				var idestado       =  $("#sl_estado").val();
				
				jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Pedido/grabaDetalle",
						dataType: 'json',
						data: {cantidad,idproducto,costoventa,precioventa,idpedido},
						success: function(res) {
									if (res)
									{
										//Pedido guardado correctamente, muestro ID del pedido y se debería acá habilitar el comnnzar con el detalle del pedido.
										$("#numeroPedido").val(res.id);
										var idpedido 	=  $("#numeroPedido").val();		
									}else
									{
										alert("ERROR al actualizar los detalles del pedido");
									}
									buscaLineaDetalle();
							}
					}); //jqueryajax
  				}	
	});

	//Submit formulario cabecera
	$("#frm_pedido").validate({
  				submitHandler: function(form){
				//TODO validacion antes de grabar
				event.preventDefault();
				var idpedido 	=  $("#numeroPedido").val();
				//Cabecera 
				var idcliente      =  $("#cntrl_id_cliente").val();

				if (idcliente == null)
						idcliente =  $("#cntrl_id_cliente_hdn").val();
				var fecha_ingreso  =  $("#fecha_ingreso").val();
				var comm           =  $("#txt_comments").val();
				var idestado       =  $("#sl_estado").val();
				
				jQuery.ajax({
					method: "POST",
						url: "<?php echo base_url(); ?>Pedido/grabaCabecera",
						dataType: 'json',
						data: {idpedido,idcliente,fecha_ingreso,comm,idestado,comm},
						success: function(res) {
									if (res)
									{
										alert("Pedido "+res.id+" actualizado correctamente.");
										window.location.href = "<?php echo base_url(); ?>Pedido/nuevoPedido/"+res.id;
									}else
									{
										alert("ERROR al actualizar cabecera pedido");
									}
							}
					}); //jqueryajax
  				}	
	});			
	
			
			
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

			//********** Control Producto **************************************			
			$("#cntrl_id_producto").select2({
				ajax: {
				        url: "<?php echo base_url(); ?>Productos/listadoControlProductos/",
				        dataType: 'json',
				        method:'get',
				        quietMillis: 250,
				        maximumSelectionSize: 0,
				        processResults: function (data, page) {
				        	var res = [];
					    	
					    	for(var i = 0; i < data.length; i++){
					    	    res[i] = {id:data[i].id,text:data[i].nombre};
					    	}
					    	 return {results: res};

					            var more = (page * 30) < res.total_count; // whether or not there are more results available
				 			
				            // notice we return the value of more so Select2 knows if more results can be loaded
				            return { results: res, more: more };
				        }
				    },
				    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});
}); //Function ready
</script>
 
