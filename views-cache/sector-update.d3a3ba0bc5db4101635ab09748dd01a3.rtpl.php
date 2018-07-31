<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Cadastro de Setores
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
			<li><a href="/service-request/admin/sector"> Setor</a></li>
			<li class="active">Editar</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Informe os dados abaixo</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" method="post" action="/service-request/admin/sector/update" data-js="form">
						<input type="hidden" name="sector_id" id="sector_id" value="<?php echo htmlspecialchars( $sector["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
						<div class="box-body">
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Descrição do setor: </label>

								<div class="col-sm-10">
									<input type="text" class="form-control" name="description" id="description" value="<?php echo htmlspecialchars( $sector["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Descrição do setor" data-js="input" data-information="Descrição">
								</div>
							</div>
							<div class="form-group">
								<label for="direction_id" class="col-sm-2 control-label">Direção: </label>

								<div class="col-sm-10">
									<select class="form-control" name="direction_id" id="direction_id" data-js="input" data-information="Direção">
										<option value="">Default</option>
										<?php $counter1=-1;  if( isset($directions) && ( is_array($directions) || $directions instanceof Traversable ) && sizeof($directions) ) foreach( $directions as $key1 => $value1 ){ $counter1++; ?>
										<?php if( $value1["direction_id"]!=$sector["direction_id"] ){ ?>
										<option value="<?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
										<?php }else{ ?>
										<option value="<?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected="selected"><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>						
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<a href="/service-request/admin/sector" class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right">Salvar Alterações</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/service-request/res/scripts/form.js"></script>