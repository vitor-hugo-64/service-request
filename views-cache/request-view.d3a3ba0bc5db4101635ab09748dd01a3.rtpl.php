<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Solicitação
    </h1>
    <ol class="breadcrumb">
      <li><a href="/service-request/admin"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="/service-request/admin/requests"> Solitação</a></li>
      <li class="active">Visualização</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-exchange-alt" style="margin-right: 10px;"></i> <?php echo htmlspecialchars( $request["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
          <small class="pull-right">Data: <?php echo htmlspecialchars( $request["request_date"], ENT_COMPAT, 'UTF-8', FALSE ); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col">
        <b style="margin-right: 5px;">Solicitante: </b> <?php echo htmlspecialchars( $request["first_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $request["last_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
        <b style="margin-right: 5px;">Email: </b> <?php echo htmlspecialchars( $request["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
        <b style="margin-right: 5px;">Setor:</b> <?php echo htmlspecialchars( $request["sector_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
        <b style="margin-right: 5px;">Status da Solicitação:</b> <?php echo htmlspecialchars( $request["status_request"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
        <br><br>
      </div>
      <div class="col-sm-12 invoice-col">
        <p>
          <?php echo htmlspecialchars( $request["request_description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
        </p>
        <br>
      </div>
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="/service-request/admin/request" class="btn btn-default"> Sair</a>
        <a href="/service-request/admin/request/" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-sign-out-alt"></i> Encerrar solicitação</a>
        <a href="/service-request/admin/request/" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-sticky-note"></i> Adiocionar nota</a>
        <?php if( $request["status_request"]=='Em aberto' ){ ?>
        <a href="/service-request/admin/request/meet/<?php echo htmlspecialchars( $request["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-user-tag"></i> Atender</a>
        <?php }else{ ?>
          <?php if( $user["user_id"]==$request["adm_id"] ){ ?>
          <a href="/service-request/admin/request/stop-meet/<?php echo htmlspecialchars( $request["request_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-user-tag"></i> Parar atendimento</a>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>