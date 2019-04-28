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
 <form role="form">
 <div class="box">
 	<div class="box-header with-border">
  		
  	</div><!-- Box Header -->
  	<div class="box-body">		
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
			
    			<div class="box box-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Consulta seguimiento de pedido.</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                     
                        <!-- text input -->
                        <div class="form-group">
                          <label>Número de pedido</label>
                          <input type="text" class="form-control" id="txt_numeropedido" placeholder="Ingrese el numero de pedido...">
                        </div>
                       <div class="form-group">
                          <label>Número de Cliente</label>
                          <input type="text" class="form-control" id="txt_numerocliente" placeholder="Ingrese el numero de cliente...">
                        </div>
                    </div>
                    <div class="box-footer">
                                <button type="submit" class="btn btn-default">Cancelar</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="btn_buscar" class="btn btn-info pull-right">Buscar</button>
                    </div>
                    <!-- /.box-body -->
                </div>
			</div>
		</div>
	</div><!-- Div class box body -->
	
	
</div><!-- .div box -->
</form>     

</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<script type="text/javascript">






//http://davidstutz.github.io/bootstrap-multiselect/
//https://github.com/wenzhixin/bootstrap-table/blob/master/src/extensions/export/README.md
$(document).ready(function() {

	$("#btn_buscar").click(function() {
		 procesar();
	});
	
	
});


function procesar(){
	
	var idpedido =  $("#txt_numeropedido").val();
	var idcliente =  $("#txt_numerocliente").val();
	$(location).attr('href',  "<?php echo base_url(); ?>seguimiento/ver/"+idpedido+"/"+idcliente)
		//window.location.href = "<?php echo base_url(); ?>seguimiento/ver/";
	
	}


</script>

		  
			
			


	

