<!DOCTYPE html>
<html>
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <title>Comprobante de compra Latasymoldes.cl</title>
    <!-- Bootstrap 3.3.4 -->
   <link href="<?php echo base_url('Template/bootstrap/css/bootstrap.min.css"') ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('Template/dist/css/AdminLTE.css"'); ?>" rel="stylesheet" type="text/css" />
    
      	<script type="text/javascript" src="<?php echo base_url('Template/plugins/jquery.priceformat.js');?>"></script>
  	<script type="text/javascript" src="<?php echo base_url('Template/plugins/comun.js');?>"></script>
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
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
                Fono: (+569) 2054-7036<br/>
                Email: ventas@latasymoldes.com
              </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
             Para
              <address>
              	
                <strong><?php echo $pedEdit['cli_nom'];?></strong>
                <br/>
                <?php echo isset($cliEdit->domicilio)?         $cliEdit->domicilio:"<i>Direccion no especificada</i>";?>
                <br/>
                <?php echo isset($cliEdit->comuna)?            $cliEdit->comuna:"<i>Comuna no especificada</i>";?>
                <br/>Fono: <?php echo isset ($cliEdit->fono1)?       $cliEdit->fono1:"<i>sin fono</i>";?><br/>
                
                Email: <?php  echo isset ($cliEdit->correo1)?$cliEdit->correo1:"<i>sin correo</i>";?><br/>
              </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Nro. Pedido <?php echo $pedEdit['id'];?></b><br/>
            <b>Nro. Cliente <?php echo $pedEdit['cli_id'];?></b><br/>
            
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
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    
  </body>
</html>
