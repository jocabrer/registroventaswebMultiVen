<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<ul class="sidebar-menu">
         <li class="header"><?php echo $menuheader; ?> Cliente</li>
          <!-- Optionally, you can add icons to the links -->
           
            <li class="<?php echo ($currentClass == "Pedido")?'active':'treeview'; ?>"> 
            
	             <a href="#">
	             
				<i class="fa fa-edit">
				</i> 
				<span>Pedidos</span> 
				<i class="fa fa-angle-left pull-right"></i>
			  </a>
              <ul class="treeview-menu">
              		
              		<li class="<?php echo ($currentAction == "Comprobante")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('comprobante'); ?>">Comprobante</a>
					</li>
					<li class="<?php echo ($currentAction == "Seguimiento")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('seguimiento'); ?>">Seguimiento</a>
					</li>
              </ul>
            </li>
</ul>

            
        </section>
        <!-- /.sidebar -->
      </aside>