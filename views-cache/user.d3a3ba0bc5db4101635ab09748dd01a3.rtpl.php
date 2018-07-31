<?php if(!class_exists('Rain\Tpl')){exit;}?>  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuário
        <small>Lista de usuários cadastrados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
        <li>Usuário</li>
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
                <a class="btn btn-success btn-sm" href="/service-request/admin/user/insert">
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
                  <th style="width: 35px;">ST</th>
                  <th>Nome</th>
                  <th>Setor</th>
                  <th>Email</th>
                  <th style="width: 65px;"></th>
                </tr>
                <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <?php if( $value1["is_active"] == s ){ ?>
                  <td><i class="fa fa-user text-success" title="Usuário Ativado" data-toggle="tooltip" data-placement="right"></i></td>
                  <?php }else{ ?>
                  <td><i class="fa fa-user-slash text-danger" title="Usuário Desativado" data-toggle="tooltip" data-placement="right"></i></td>
                  <?php } ?>
                  <td><?php echo htmlspecialchars( $value1["first_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["last_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td>
                    <span>
                      <a href="/service-request/admin/user/profile/<?php echo htmlspecialchars( $value1["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <i class="fa fa-user-circle"></i>
                        Perfil
                      </a>
                    </span>
                  </td>
                </tr>
                <?php } ?>
              </table>
            </div>
            <!-- /.box-body -->
<!--             <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div> -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <script src="/service-request/res/scripts/user.js"></script>