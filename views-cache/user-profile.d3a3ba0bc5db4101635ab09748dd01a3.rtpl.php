<?php if(!class_exists('Rain\Tpl')){exit;}?>  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil do Usuário
      </h1>
      <ol class="breadcrumb">
        <li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="/service-request/admin/user">Usuário</a></li>
        <li class="active">Perfil do usuário</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

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
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo htmlspecialchars( $user["profile_picture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo htmlspecialchars( $user["first_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $user["last_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>

              <p class="text-muted text-center">Usuário <?php if( $user["is_active"]==s ){ ?>Ativado<?php }else{ ?>Desativado<?php } ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <span class="pull-right"><?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </li>
                <li class="list-group-item">
                  <b>Matrícula</b> <span class="pull-right"><?php echo htmlspecialchars( $user["registration"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </li>
                <li class="list-group-item">
                  <b>Setor</b> <span class="pull-right"><?php echo htmlspecialchars( $user["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </li>
                <li class="list-group-item">
                  <b>Administrador</b> <span class="pull-right"><?php if( $user["is_administrator"]==s ){ ?>Sim<?php }else{ ?>Não<?php } ?></span>
                </li>
              </ul>

              <div class="pull-right">
                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-alter-password"> <i class="fa fa-key" style="margin-right: 5px;"></i> <b>Trocar Senha</b></a>
                <?php if( $user["is_active"]==s ){ ?>
                <a href="/service-request/admin/user/profile/disable-enable/<?php echo htmlspecialchars( $user["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger btn-sm"> <i class="fa fa-user-slash" style="margin-right: 5px;"></i> <b>Desativar Usuário</b></a>
                <?php }else{ ?>
                <a href="/service-request/admin/user/profile/disable-enable/<?php echo htmlspecialchars( $user["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success btn-sm"> <i class="fa fa-user" style="margin-right: 5px;"></i> <b>Ativar Usuário</b></a>
                <?php } ?>
              </div>
              <!-- modal trocar senha -->
              <div class="modal fade" id="modal-alter-password">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Trocar senha</h4>
                      </div>
                      <form method="post" action="/service-request/admin/user/profile/alter-password" data-js="form">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars( $user["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Senha nova</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Senha" data-js="input" data-information="Senha">
                          </div>
                          <div class="form-group">
                            <label>Repetir senha nova</label>
                            <input type="password" name="repeat_password" id="repeat_password" class="form-control" placeholder="Senha" data-js="input" data-information="Senha">
                          </div>
                          <div class="form-group">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" id="alter_password" name="alter_password" value="s"> Trocar senha no proximo login
                              </label>
                            </div>
                          </div>                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-success">
                            Confirmar
                          </button>
                        </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /modal trocar senha -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-warning direct-chat direct-chat-warning">
              <div class="box-header with-border">
                <h3 class="box-title">Chat Direto</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="/service-request/res/img/profiles/default.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="/service-request/res/img/profiles/default.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="/service-request/res/img/profiles/default.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Working with AdminLTE on a great new app! Wanna join?
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="/service-request/res/img/profiles/default.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      I would love to.
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                </div>
                <!--/.direct-chat-messages-->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Tipo de mensagem ..." class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-warning btn-flat">Send</button>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.box-footer-->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Solicitações desse usuário</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Data</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Call of Duty IV</td>
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20">12/05/2018</div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Samsung Smart TV</td>
                        <td>
                          <div class="sparkbar" data-color="#f39c12" data-height="20">11/11/2011</div>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>iPhone 6 Plus</td>
                        <td>
                          <div class="sparkbar" data-color="#f56954" data-height="20">23/04/1998</div>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Samsung Smart TV</td>
                        <td>
                          <div class="sparkbar" data-color="#00c0ef" data-height="20">30/05/2014</div>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Samsung Smart TV</td>
                        <td>
                          <div class="sparkbar" data-color="#f39c12" data-height="20">25/10/2005</div>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>iPhone 6 Plus</td>
                        <td>
                          <div class="sparkbar" data-color="#f56954" data-height="20">23/04/2003</div>
                        </td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Call of Duty IV</td>
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20">12/12/2012</div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Ver Todas</a>
              </div>
              <!-- /.box-footer -->
            </div>
          </div>
        </div>
      </section>
    </div>
    <script src="/service-request/res/scripts/form.js"></script>