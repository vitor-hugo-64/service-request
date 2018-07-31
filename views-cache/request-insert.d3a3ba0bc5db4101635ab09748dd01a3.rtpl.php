<?php if(!class_exists('Rain\Tpl')){exit;}?>  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nova solicitação
      </h1>
      <ol class="breadcrumb">
        <li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="/service-request/admin/request">Solicitação</a></li>
        <li>Nova solicitação</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="/service-request/admin/request" class="btn btn-danger btn-block margin-bottom">Cancelar</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Filtro</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Todos
                  <span class="label label-primary pull-right">12</span></a></li>
                  <li><a href="#"><i class="fa fa-check-square"></i> Concluídos</a></li>
                  <li><a href="#"><i class="fa fa-envelope-open"></i>Em aberto</a></li>
                  <li><a href="#"><i class="fa fa-user-slash"></i> Sem dono <span class="label label-warning pull-right">65</span></a>
                  </li>
                  <li><a href="#"><i class="fa fa-ban"></i> Cancelados</a></li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Informe os dados da nova solicitação</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="POST" action="/service-request/admin/request/insert" data-js="form">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars( $user["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                <input type="hidden" name="">
                <div class="box-body">
                  <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Título" data-js="input">
                  </div>
                  <div class="form-group">
                    <label for="problem_type_id">Tipo de problema</label>
                    <select class="form-control" name="problem_type_id" id="problem_type_id" data-js="input">
                      <?php $counter1=-1;  if( isset($problems) && ( is_array($problems) || $problems instanceof Traversable ) && sizeof($problems) ) foreach( $problems as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1["problem_type_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Descrição" rows="5" data-js="input"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Anexar arquivo</label>
                    <input type="file" name="" id="">
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-send" style="margin-right: 8px;"></i> 
                    Enviar solicitação
                  </button>
                </div>
              </form>
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>

    <script src="/service-request/res/scripts/form.js"></script>