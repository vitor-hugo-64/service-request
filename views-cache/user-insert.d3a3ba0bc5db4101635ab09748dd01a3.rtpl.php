<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Cadastro de Usuários
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
			<li><a href="/service-request/admin/user"><i class="fa fa-home"></i> Usuário</a></li>
			<li class="active">Adicionar</li>
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
					<form class="form-horizontal" method="post" action="/service-request/admin/user/insert" data-js="form">
						<div class="box-body">
							<div class="form-group">
								<label for="first_name" class="col-sm-2 control-label">Primeiro nome: </label>

								<div class="col-sm-10">
									<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Primeiro nome" data-js="input" data-information="Primeiro nome">
								</div>
							</div>
							<div class="form-group">
								<label for="last_name" class="col-sm-2 control-label">Sobrenome: </label>

								<div class="col-sm-10">
									<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Sobrenome" data-js="input" data-information="Sobrenome">
								</div>
							</div>
							<div class="form-group">
								<label for="registration" class="col-sm-2 control-label">Matrícula: </label>

								<div class="col-sm-10">
									<input type="text" class="form-control" name="registration" id="registration" placeholder="Matrícula" data-js="input" data-information="Matrícula">
								</div>
							</div>
							<div class="form-group">
								<label for="sector_id" class="col-sm-2 control-label">Setor: </label>

								<div class="col-sm-10">
									<select class="form-control" name="sector_id" id="sector_id" data-js="input" data-information="Setor">
										<option value="">Default</option>
										<?php $counter1=-1;  if( isset($sectors) && ( is_array($sectors) || $sectors instanceof Traversable ) && sizeof($sectors) ) foreach( $sectors as $key1 => $value1 ){ $counter1++; ?>
										<option value="<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>							
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>

								<div class="col-sm-10">
									<input type="email" class="form-control" name="email" id="email" placeholder="Email" data-js="input" data-information="Email">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">Senha</label>

								<div class="col-sm-10">
									<input type="password" class="form-control" name="password" id="password" placeholder="Senha" data-js="input" data-information="Senha">
								</div>
							</div>								
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" id="alter_password" name="alter_password" value="s"> Trocar senha no proximo login
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" id="is_administrator" name="is_administrator" value="s"> Acesso de administrador
										</label>
									</div>
								</div>
							</div>							
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<a href="/service-request/admin/user" class="btn btn-default">Cancelar</a>
							<button type="submit" class="btn btn-info pull-right">Criar usuário</button>
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