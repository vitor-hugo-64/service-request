<?php if(!class_exists('Rain\Tpl')){exit;}?>  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setor
        <small>Lista de setores cadastrados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="/service-request/admin/sector">Setor</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

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
              <div style="margin-top: 0px;">
                <a class="btn btn-success btn-sm" href="/service-request/admin/sector/insert">
                  <i class="fa fa-plus" style="margin-right: 4px;"></i>
                  Adicionar
                </a>
              </div>

              <div class="box-tools" style="margin-top: 6px;">

                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Procurar" data-js='search'>

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" data-js='btn'><i class="fa fa-search" style="width: 20px;" data-js="icon-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped" data-js="table">
                <tr>
                  <th>ID</th>
                  <th>Descrição</th>
                  <th>Direção</th>
                  <th style="width: 75px;"></th>
                  <th style="width: 75px;"></th>
                </tr>
                <?php $counter1=-1;  if( isset($sectors) && ( is_array($sectors) || $sectors instanceof Traversable ) && sizeof($sectors) ) foreach( $sectors as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <td><?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["description_direction"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td>
                    <a href="/service-request/admin/sector/update/<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <i class="fa fa-edit"></i>
                      Editar
                    </a>
                  </td>
                  <td>
                    <a class="text-danger" href="#" data-toggle="modal" data-target="#modal-delete-<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                      <i class="fa fa-trash"></i>
                      Excluir
                    </a>
                  </td>  
                  <!-- modal-content -->
                  <div class="modal fade" id="modal-delete-<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-danger">Excluir</h4>
                          </div>
                          <div class="modal-body">
                            <p>Tem certeza que deseja excluir determinado setor?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <a href="/service-request/admin/sector/delete/<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="button" class="btn btn-danger">
                              Confirmar
                            </a>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </tr>

                  <?php } ?>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>

    <script src="/service-request/res/scripts/sector.js"></script>