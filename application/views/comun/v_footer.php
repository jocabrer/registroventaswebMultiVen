  <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <?php echo  $user->first_name; ?>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020 <a href="#">Company</a>.</strong> All rights reserved.
        Ultima con.
          <?php 
                  $date = new DateTime();
                  $date->setTimestamp($user->last_login);
                  echo $date->format('Y-m-d H:i:s' );
                  
                  ?>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">&Uacute;ltimos 10 pedidos</h3>
            <ul>
             <?php 
             foreach($ultimospedidos as $ult){
             ?>
              <li>
                <a href="<?php echo base_url(); ?>Pedido/editarPedido/<?php echo $ult["numeroPedido"];?>">
                  <?php echo $ult["numeroPedido"]; ?>
                </a>
                De 
                <?php echo $ult["cli_nom"]; ?> 
                <i>hace 
                <?php echo date_diff(new DateTime($ult["est_fec_ing"]),new DateTime())->format('%a d&iacute;as'); ?> 
                est&aacute; 
                <?php echo $ult["est_desc"];?>
               </i>

	            
              </li>
            <?php 
             }
            ?>
            </ul><!-- /.control-sidebar-menu -->
            <h3 class="control-sidebar-heading">Ultimos productos agregados
            </h3>
            <ul>
             <?php 
             foreach($ultimosproductos as $ultp){
             ?>
              <li>
                <a href="<?php echo base_url(); ?>Productos/agregar/<?php echo $ultp["id"];?>">
                  <?php echo $ultp["id"]; ?>
                </a>
               <?php echo $ultp["Nombre"]; ?> en <?php echo $ultp["nom_categoria"];?>
              </li>
            <?php 
             }
            ?>
            </ul>

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading"><i class="fa fa-fw fa-clipboard"></i>Portapapeles</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  <textarea rows="8"  class="form-control" id="txt_portapapeles"></textarea>
                </label>
                
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    
    <!--  div modal estandar -->
    <div class="modal fade in" id="modalDinamico"  tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulomodal">Titulo</h4>
      </div>
      <div class="modal-body">
      	<div id="cuerpomodal">Cuerpo</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    

 <!--  div modal muestra pedidos -->
 <div class="modal fade in" id="modalDinamicoMuestraPedido"  tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulomodal">Titulo</h4>
      </div>
      <div class="modal-body">
      	<div id="cuerpomodal">
                <table id="tbl_listapedidos" class="table"></table>	  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" tabindex="-1" role="dialog" id="divpedidopreview">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalle pedido <label id="iddetallepedido"></label> :</h4>
      </div>
      <div class="modal-body">
      		
      		<div class="row">
      			<div class="col-md-12 col-sm-12 col-xs-12">
               		<table id="tbl_detallepedido" class="table"
        			   				   data-method="post"
        			   				   data-toggle="table"
        			   				   data-query-params="queryParamsDetalle"
        							   data-url="<?php echo base_url('Pedido/obtenerDetallePedido'); ?>">
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
        		</div><!-- col -->
			</div><!-- row -->
			<div class="row">
				 <div class="col-md-6 col-sm-6 col-xs-12" style="text-align_right;">
				
					<table class="table no-margin">
                      <tr>
                        <th style="width:50%">Costo total:</th>
                        <td><label id="lbl_totalCosto"></label></td>
                      </tr>
                      <tr>
                        <th style="width:50%">Ganancia Global:</th>
                        <td><label id="lbl_totalganancia"></label></td>
                      </tr>
                      <tr>
                        <th colspan="2" style="text-align:center;">Comisiones</th>
                      </tr>
                      <tr>
                        <td colspan="2">
                        	<p id="p_comisiones"></p>
                        </td>
                      </tr>
                      
                     </table>
                     
                     
                     
                     
                     
                   
        	
        	
        	
				 </div>
				 <div class="col-md-6 col-sm-6 col-xs-12" style="text-align_right;">
						<div class="table-responsive">
								<table class="table no-margin">
                                  <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td><label id="lbl_subtotal"></label></td>
                                  </tr>
                                  <tr>
                                    <th>I.V.A</th>
                                    <td><label id="lbl_iva"></label></td>
                                  </tr>
                                  <tr>
                                    <th>TOTAL A PAGAR:</th>
                                    <td><label id="lbl_totalapagar"></label></td>
                                  </tr>
                				  
                				  <tr>
                                    <th>Abonado:</th>
                                    <td><label id="lbl_totalabonocliente"></label></td>
                                  </tr>
                				  
                				  
                				  <tr>
                                    <th>SALDO A PAGAR:</th>
                                    <td><label id="lbl_totalsaldocliente"></label></td>
                                  </tr>
                    	        </tbody>
                    	        </table>
				        </div><!-- Div class table --> 
				      </div><!-- col -->
	        	</div><!-- row -->
	  </div><!-- modal info -->
	  <div class="modal-footer">
	  		<span id="linkfooter"></span>
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



  
   </body>
</html>




<script>


/*Funcion Cargar y Mostrar datos*/
$(document).ready(function(){    
    $('#txt_portapapeles').change(function(){                       
        /*Obtener datos almacenados*/
      localStorage.setItem("portapapeleslym",$("#txt_portapapeles").val());
    });   
    var portapapeles = localStorage.getItem("portapapeleslym");
    /*Mostrar datos almacenados*/      
    document.getElementById("txt_portapapeles").innerHTML = portapapeles;
});



</script>