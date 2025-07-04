<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        
        <section class="content-header">
          <h1>
           Comprobante
            <small>
			Generaci&oacute;n de comprobante para el pedido  <?php echo $pedEdit['id'];?>
			</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"></li>
          </ol>
        </section>
        
        <!-- Main content -->
                
        <section class="invoice" id="seccion">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Taller "Latas y Moldes"
                <small class="pull-right"><?php echo $pedEdit['est_fec_ing'];?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              De
              <address>
                <strong>Jos&eacute; Cabrera Gatica</strong><br>
                Ingeniero Lloyd #01660<br>
                Quinta Normal, Santiago<br>
                Fono: (+569) 2054 7036<br/>
                Email: ventas@latasymoldes.com
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Para
              <address>
                <strong><?php echo $pedEdit['cli_nom'];?></strong>
                <br/><?php echo isset($cliEdit->domicilio)?         $cliEdit->domicilio:"<i>Direccion no especificada</i>";?>
                <br/><?php echo isset($cliEdit->comuna)?            $cliEdit->comuna:"<i>Comuna no especificada</i>";?>
                <br/>Fono: <?php echo isset ($cliEdit->fono1)?       $cliEdit->fono1:"<i>sin fono</i>";?><br/>
                
                Email: <?php  echo isset ($cliEdit->correo1)?$cliEdit->correo1:"<i>sin correo</i>";?><br/>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col" >
              <b>Nro. Pedido <?php echo $pedEdit['id'];?></b><br/>
              <b>Nro. Cliente <?php echo $pedEdit['cli_id'];?></b><br/>
              <a href="<?php echo base_url('seguimiento/ver/'.$pedEdit['id'].'/'.$pedEdit['cli_id']); ?>"><i class="fa fa-fw fa-tasks"></i>Seguimiento de Fabricaci&oacute;n</a>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Producto</th>
                    <th style="text-align:right;">Valor unitario</th>
                    <th style="text-align:right;">Valor Neto</th>
                  </tr>
                </thead>
                <tbody> 
               <?php 
               
               $subtotal=0;
               
               foreach($detEdit  as $det) { 
               
               	?>
					<tr>
                    	<td><?php echo $det->cantidad;?></td>
                    	<td><?php echo $det->nom_prod;?></td>
                    	<td style="text-align:right;"><script> document.write(PriceFormatter(<?php echo $det->venta_un;?>));</script></td>
                    	<td style="text-align:right;"><script> document.write(PriceFormatter(<?php echo $det->det_venta;?>));</script></td>
                  	</tr>						
			   <?php } ?>  	
                </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
          	<p class="lead">Observaciones<p>
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
               <?php echo nl2br($cliEdit->observaciones); ?>
              </p>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Cobros y Pagos</p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td style="text-align:right;"><script> document.write(PriceFormatter( <?php echo $indicadores->Subtotal;?>));</script></td>
                  </tr>
                  <tr>
                    <th>I.V.A</th>
                    <td style="text-align:right;"><script> document.write(PriceFormatter( <?php echo $indicadores->iva;?>));</script></td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td style="text-align:right;"><script> document.write(PriceFormatter(<?php echo $indicadores->totalAPagar;?>));</script></td>
                  </tr>
                  <tr>
                    <th>Abonado</th>
                    <td style="text-align:right;">-<script> document.write(PriceFormatter(<?php echo $indicadores->PagadoCliente;?>));</script></td>
                  </tr>
                   <tr>
                    <th>Saldo</th>
                    <td style="text-align:right;"><script> document.write(PriceFormatter(<?php echo $indicadores->SaldoCliente;?>));</script></td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
		
          
        </section><!-- /.content -->
        <section class="invoice">
        <div class="row">
            <div class="col-xs-12r" style="text-align:center;">
               <!--  <button class="btn btn-default" id="btnback"><i class="fa  fa-backward"></i> Volver</button>-->
            
              <a href="<?php echo base_url('Comprobante/imprimirComprobante').'/'.$pedEdit['id'];?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>
              
              
              <!--  <button class="btn btn-primary pull-right" style="margin-right: 5px;" id="btnexportopdf"><i class="fa fa-download"></i> Genera PDF</button>-->
              
              
              
            </div>

        </div>
        </section>
</div><!-- /.content-wrapper -->

<div id="versionimprimible" style="display:none;">

</div>
<script type="text/javascript">
$(document).ready(function() {



	


	
	var $table = $('#tabladetallemovimientos'),
    $ok = $('#ok');  
	$ok.click(function () {$table.bootstrapTable('refresh');});





	
	$('#btnback').click(function () {
		window.history.back();
	});
	
	$('#btnexportopdf').click(function () {   
		 html2canvas(document.getElementById('seccion'),{
			   onrendered:function(canvas){
			   var img=canvas.toDataURL("image/png");
			   var doc = new jsPDF("l", "mm", "A4");
			   doc.addImage(img,'JPEG',5,5);
			   doc.save('test.pdf');
			   }
		   });
	});
});	

function eliminaTransaccion(id)
{
	jQuery.ajax({
				method: "POST",
				url: "<?php echo base_url(); ?>Cuenta/eliminaTransaccion/",
				data:{id},
				dataType: 'json'});		
}
function i_prod(data)
{
	return[
			'<a href="<?php echo base_url(); ?>Productos/agregar/',
			data,
			'">',
			data,
			'</a>'
		   	].join('');
}

/**
 * Procesa la respuesta del metodo que carga v�a ajax los datos a la tabla.
 */
function responseHandler(res){
//	calculaTotalesListado(res);
	return res;
}
function f_idpedido(data)
{
	return[
			'<a href="<?php echo base_url(); ?>Pedido/editarPedido/',
			data,
			'">',
			data,
			'</a>'
		   	].join('');

}
/**
 * Funcion que setea los parametros.
 */
function queryParams(params) {
	
    $('#toolbar').find('input[name]').each(function () {
        params[$(this).attr('name')] = $(this).val();
    });
    
    return params;
}		
</script>