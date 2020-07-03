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
<div class="callout callout-info">
        <h4>Aviso!</h4>
        El siguiente comprobante es su respaldo de fabricación, favor verificar el detalle y los datos suministrados.
        
      </div>
 <div class="box">
 	<div class="box-header with-border">
 			<div class="row">
 				<div class="col-lg-6 col-md-6 col-xs-12 text-left">
 						<?php 
                 			$url = "Comprobante/verComprobanteCliente/". (string)$id_cabecera."/".(string)$cliente['id'];
                 			?>
                  			 <h3 class="box-title"><b>Número de Pedido</b> <a href="<?php echo base_url($url); ?>"><b><?php echo $id_cabecera; ?></b></a></h3>
                  			<br>
                  			 <h3 class="box-title"><b>Cliente</b>  <?php echo $cliente['id']."-".$cliente['nombre']; ?></h3>
                  			<br>
                  			
				</div><!-- Col  -->
				<div class="col-lg-6 col-md-6 col-xs-12 text-right">
						<a class="btn btn-warning" href="<?php echo base_url('Comprobante/verComprobanteCliente/'.$id_cabecera.'/'.$cliente['id']); ?>"><i class="fa fa-fw fa-print"></i>Imprimir Comprobante</a>
  						<?php if($this->ion_auth->logged_in()){?>
  						<a class="btn btn-primary"  href="<?php echo base_url('Pedido/editarPedido/'.$id_cabecera); ?>"><i class="fa fa-fw fa-edit"></i>Editar Pedido</a><br>
  						<?php }?>	
				</div>
			</div><!-- row -->
 			
  	</div><!-- Box Header -->
  	<div class="box-body">		
		<div class="row">
			<div class="col-lg-8 col-md-10 col-xs-12 text-left">
				<div class="box">
            			<div class="box-header with-border"><h3 class="box-title">Seguimiento de Pedido</h3></div>
                        <!-- /.box-header -->
            			<div class="box-body">
                          <table class="table table-bordered">
                            <tbody><tr>
                              <th style="width:100px;">Fecha</th>
                              <th>Hora</th>
                              <th style="width:140px;">Tipo</th>
                              <th>Indicador</th>
                              <th>Mensaje</th>
                              <th style="width:100px;">Progreso</th>
                            </tr>
                            <?php foreach($datos_seguimiento as $dato) {?> 
                            <tr>
                              
                              <td><?php echo $dato["fecha_mod"];?></td>
                              <td><?php echo $dato["fecha_mod_hora"];?></td>
                              <td><?php echo $dato["tipo"]; ?></td>
                              <td><?php echo $dato["nom_indicador"];?></td>
                              <td><?php echo $dato["des_indicador"];?></td>
                              <td>
                              	<script>document.write(diasTranscurridosFormater('<?php echo $dato["cuentadias_fecha_mod"]; ?>'))</script>
                              	
                              </td>
                            </tr>
                            <?php }?>
                          </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
				</div><!-- div box -->		
			</div><!-- col -->	
<!-- ============================================================================================================================================ -->
				<div class="col-lg-4 col-md-2 col-xs-12">
					
					<div class="box">
            			<div class="box-header with-border"><h3 class="box-title">Detalle de su pedido <label id="iddetallepedido"><?php echo $id_cabecera;?></label> :</h3></div>
						<br/>
    					<table id="tbl_detallepedido" class="table"
            			   				   data-method="post"
            			   				   data-toggle="table"
            			   				   data-query-params="queryParamsDetalle"
            							   data-url="<?php echo base_url('Seguimiento/ObtieneDetallePedidoCliente'); ?>"
            							   
            							   data-response-handler="responseHandler">
            							   <thead>
            									<tr class="d-flex" >
            										 <th data-field="cantidad"  data-sortable="false" data-align="center" class="col-1">cantidad</th>
            										 <th data-field="nom_prod"  data-sortable="false" data-align="left" class="col-3">Producto</th>
            										 <th data-field="costo_un"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1" data-visible="false">Costo c/u</th>
            										 <th data-field="venta_un"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1" data-visible="true">Venta c/u</th>
            										 <th data-field="det_costo"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1"  data-visible="false">Costo tot</th>
            										 <th data-field="det_venta"  data-sortable="false" data-align="center" data-formatter="PriceFormatter" class="col-1">Venta Tot</th>
            									</tr>
            								</thead>
            			</table>
						</div>
					<p class="text-muted well well-sm no-shadow left" style="text-align:left;">
					Si su pedido no corresponde a lo que usted solicitó favor avisar.
					<br>
					<br>
					<b>I M P O R T A N T E</b>
					<br>
					<br>
					Se recuerda que en caso de retiro de sus productos, puede realizarlos de Lunes a Viernes de 08:00 a 12:00 y de 13:00 a 16hrs. 
					<br>
					<b>Dirección: Quinta Normal, Ingeniero Lloyd #01660.</b>
					</p>
				</div>         <!-- col -->         
			
		</div>
	</div><!-- Div class box body -->

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Archivos adjuntos </h3>
		</div>
		<div class="table">
		<table class="table no-margin">
		<thead>
		<tr>
			<th>Archivo</th>
			<th>Fecha Creación</th>
			<th>Tipo</th>
		</tr>
		</thead>
        <tbody>
		<?php foreach ($adjuntos as $adj){ ?>
            <tr>
                <td><a href="<?php echo base_url("./uploads/".$adj['filenameid']);?>"><?php echo $adj['filename']; ?></a></td>
				<td><?php echo $adj['fecha_subida']; ?></td>
				<td><span class="label label-success"><?php echo $adj['nombretipo']; ?></span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                    </td>
                  </tr>
	<?php
		}
	?>
		</tbody>
                </table>
		</div>
	</div>


	<div class="box-footer" style="text-align:left;">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-xs-12">
				              <a href="<?php echo base_url('seguimiento'); ?>" class="btn btn-default"><li class="fa fa-rotate-left"></li> Volver</a>
				</div>
				<div class="col-lg-8 col-md-8 col-xs-12 text-right">
							<p>Fecha Consulta:</b>  <?php echo $fecha_consulta; ?><p>
				</div>
			</div>

             
             
               	
	</div>


	
	<!--  Whatsapp Widget 
	<div class="whatsapp fixed-bottom rounded-left border-left-0 animated flash">
	<?php 
	
	   $urlmensaje = "www.latasymoldes.cl/sistema/seguimiento/".$cliente['id']."/".$id_cabecera;
		?>
		
		<a href="https://api.whatsapp.com/send?phone=56984846490&text=Quiero saber algo acerca de mi pedido <?php echo $urlmensaje; ?>">
		
			<img src="http://www.armatuweb.cl/versionestatica/img/ws.png">
				Contacto v&iacute;a Whatsapp
			</a>
	</div> -->
	


</section><!-- /.content -->

</div><!-- /.content-wrapper -->



<script type="text/javascript">
/*
	 * Funcion que setea los parametros de la tabla de detalle
	 */
	function queryParamsDetalle(params) {
		console.log(params);
			  params['idPed'] = <?php echo $id_cabecera;?>;
			  params['idcli'] = <?php echo $cliente['id']?>;
	    return params;
	}

	/**
	 * Procesa la respuesta del metodo que carga vía ajax los datos a la tabla.
	 */
	function responseHandler(res){

		//console.log(res);
		return res.rows;
	}


	$(document).ready(function(){

	$table = $('#tabla_resultado');
	$table.bootstrapTable('refresh');

	});

	

</script>