<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Cadastro de Direções
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
			<li><a href="/service-request/admin/direction"><i class="fa fa-home"></i> Direção</a></li>
			<li class="active">Editar Direção</li>
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
					<form class="form-horizontal" method="post" action="/service-request/admin/direction/update" data-js="form">
						<input type="hidden" name="direction_id" value="<?php echo htmlspecialchars( $direction["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
						<div class="box-body">
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Nome da direção: </label>

								<div class="col-sm-10">
									<input type="text" class="form-control" name="description" id="description" value="<?php echo htmlspecialchars( $direction["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Nome da direção" data-js="input" data-information="nome da direção">
								</div>
							</div>
							<div class="form-group">
								<label for="initials" class="col-sm-2 control-label">Sigla: </label>

								<div class="col-sm-10">
									<input type="text" class="form-control" name="initials" id="initials" value="<?php echo htmlspecialchars( $direction["initials"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Sigla" data-js="input" data-information="sigla">
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<a href="/service-request/admin/direction" class="btn btn-default">Cancelar</a>
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