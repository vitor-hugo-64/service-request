<?php if(!class_exists('Rain\Tpl')){exit;}?>  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Solicitação
        <small>Aqui fica o controle de todas as solicitações feitas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Solicitação</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="/service-request/admin/request/insert" class="btn btn-primary btn-block margin-bottom">Nova solicitação</a>

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
                <li class="active">
                  <a href="#"><i class="fa fa-inbox"></i> 
                    Todos
                    <span class="label label-primary pull-right">12</span>
                  </a>
                </li>
                <li><a href="#"><i class="fa fa-check-square"></i> Concluídos</a></li>
                <li><a href="#"><i class="fa fa-envelope-open"></i>Em aberto</a></li>
                <li><a href="#"><i class="fa fa-user-slash"></i> Sem dono <span class="label label-warning pull-right">65</span></a>
                </li>
                <li><a href="#"><i class="fa fa-user-tag"></i> Estou atendendo</a></li>
                <li><a href="#"><i class="fa fa-ban"></i> Cancelados</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <?php if( $status["message"]!=false ){ ?>
          <div class="alert alert-<?php echo htmlspecialchars( $status["type"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="alert">
            <?php if( $status["type"]==success ){ ?>
            <i class="fa fa-check-circle" style="margin-right: 15px;"></i>
            <?php } ?>
            <?php if( $status["type"]==danger ){ ?>
            <i class="fa fa-exclamation-circle" style="margin-right: 15px;"></i>
            <?php } ?>
            <?php echo htmlspecialchars( $status["message"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>

          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Lista de solicitações feitas por você</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped">
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Tipo de problema</th>
                  <th>Status</th>
                  <th>Data</th>
                  <th style="width: 95px;"></th>
                  <th style="width: 75px;"></th>
                  <th style="width: 85px;"></th>
                </tr>
                <?php $counter1=-1;  if( isset($requests) && ( is_array($requests) || $requests instanceof Traversable ) && sizeof($requests) ) foreach( $requests as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo htmlspecialchars( $value1["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["problem_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["status_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["request_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td>
                    <a href="/service-request/admin/request/view/<?php echo htmlspecialchars( $value1["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <i class="fa fa-eye"></i>
                      Visualizar
                    </a>
                  </td>
                  <td>
                    <a href="/service-request/admin/request/update/<?php echo htmlspecialchars( $value1["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <i class="fa fa-edit"></i>
                      Editar
                    </a>
                  </td>
                  <td>
                    <a class="text-danger" href="#"  data-toggle="modal" data-target="#modal-cancel-<?php echo htmlspecialchars( $value1["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <i class="fa fa-ban"></i>
                      Cancelar
                    </a>
                  </td> 
                </tr>

                <div class="modal fade" id="modal-cancel-<?php echo htmlspecialchars( $value1["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title text-danger">Excluir</h4>
                        </div>
                        <div class="modal-body">
                          <p>Tem certeza que deseja cancelar determinada solicitação?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                          <a href="/service-request/admin/request/cancel/<?php echo htmlspecialchars( $value1["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="button" class="btn btn-danger">
                            Confirmar
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>