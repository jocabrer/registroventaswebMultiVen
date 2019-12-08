<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<!-- Sidebar user panel (optional) -->
<div class="user-panel">
<div class="pull-left image">
<img src="<?php echo base_url('Template/dist/img/user/'.$user->id.'.jpg')?>" class="img-circle" alt="User Image" />
</div>
<div class="pull-left info">
<p><?php	echo  $user->first_name; ?></p>
              <!-- Status -->
              <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
			  <a href="<?php echo base_url('Inicio/salir'); ?>">Salir</a>
			  <a href="<?php echo base_url('auth/change_password'); ?>">Cambiar clave</a>
			  
            </div>
          </div>
          <!-- search form (Optional) -->
          <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo $menuheader; ?></li>
            <!-- Optionally, you can add icons to the links -->
           
            <li class="<?php echo ($currentClass == "Pedido")?'active':'treeview'; ?>"> 
	             <a href="#"><i class="fa fa-edit"></i><span>Pedidos</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              		
              		<li class="<?php echo ($currentAction == "nuevoPedido")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Pedido/nuevoPedido'); ?>">Nuevo</a>
					</li>
					<li class="<?php echo ($currentAction == "Listado")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Pedido/Listado'); ?>">Listado</a>
					</li>
					<li class="<?php echo ($currentAction == "Consulta")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('seguimiento/Consulta'); ?>">Seguimiento</a>
					</li>
              </ul>
            </li>
            
           <li class="<?php echo ($currentClass == "Woo")?'active':'treeview'; ?>"> 
            	<a href="#"><i class="fa fa-mail-forward"></i><span>WooCommerce</span><i class="fa fa-angle-left pull-right"></i></a>
            	<ul class="treeview-menu">
            		<li class="<?php echo ($currentAction == "Ver")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Woo/Ver'); ?>">Importar</a>
					</li>
            	</ul>
           </li>
           <li class="<?php echo ($currentClass == "Cliente")?'active':'treeview'; ?>">
              <a href="#">
				<i class="fa fa-users">
				</i> 
				<span>Clientes</span> 
				<i class="fa fa-angle-left pull-right"></i>
			  </a>
              <ul class="treeview-menu">
              		<li class="<?php echo ($currentAction == "edicion")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Cliente/edicion'); ?>">Nuevo</a>
					</li>
					<li class="<?php echo ($currentAction == "listado")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Cliente/listado'); ?>">Listado</a>
					</li>
              </ul>
            </li>
            
          <li class="<?php echo ($currentClass == "Productos")?'active':'treeview'; ?>">
              <a href="#">
				<i class="fa fa-tag">
				</i> 
				<span>Productos</span> 
				<i class="fa fa-angle-left pull-right"></i>
			  </a>
              <ul class="treeview-menu">
              	
              		<li class="<?php echo ($currentAction == "agregar")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Productos/agregar'); ?>">Nuevo</a>
					</li>
					<li class="<?php echo ($currentAction == "listado")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Productos/listado'); ?>">Listado</a>
					</li>
                
              </ul>
            </li>
            
            <?php if($this->ion_auth->is_admin()){ ?>
            <li class="<?php echo ($currentClass == "Reporte")?'active':'treeview'; ?>">
              <a href="#">
				<i class="fa fa-pie-chart">
				</i> 
				<span>Analisis</span> 
				<i class="fa fa-angle-left pull-right"></i>
			  </a>
              <ul class="treeview-menu">
              	
              		<li class="<?php echo ($currentAction == "hojas")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Reporte/hojas'); ?>">Hojas de trabajo</a>
					</li>

				

					<li class="<?php echo ($currentAction == "graficosCC/RPTDIARIO")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Reporte/graficosCC/RPTDIARIO'); ?>">Reporte diario</a>
					</li>
			    
					<li class="<?php echo ($currentAction == "Reporte/graficosCC/RPTMENSUAL")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Reporte/graficosCC/RPTMENSUAL'); ?>">Reporte Mensual</a>
					</li>
			    
              </ul>
            </li>
            
            
           <li class="<?php echo ($currentClass == "Cuenta")?'active':'treeview'; ?>">
              <a href="#">
				<i class="fa fa-keyboard-o">
				</i> 
				<span>Configuraci&oacute;n</span> 
				<i class="fa fa-angle-left pull-right"></i>
			  </a>
              <ul class="treeview-menu">
              	
              		<li class="<?php echo ($currentAction == "Cuenta")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Cuenta'); ?>">Cuentas</a>
					</li>

					<li class="<?php echo ($currentAction == "verdetallemovimientos")?'active':'treeview'; ?>">
						<a href="<?php echo base_url('Cuenta/verdetallemovimientos'); ?>">Movimiento cuentas</a>
					</li>
					
              </ul>
            </li>
			
			


            <?php }?>
          </ul><!-- /.sidebar-menu -->
		  
		  
        </section>
        <!-- /.sidebar -->
      </aside>