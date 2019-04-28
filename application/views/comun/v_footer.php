  <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <?php echo  $user->first_name; ?>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
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
               De <?php echo $ult["cli_nom"]; ?> <i>hace <?php echo date_diff(new DateTime($ult["est_fec_ing"]),new DateTime())->format('%a d&iacute;as'); ?> est&aacute; <?php echo $ult["est_desc"];?> </i>
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
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
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
    
  
   </body>
</html>