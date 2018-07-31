<?php if(!class_exists('Rain\Tpl')){exit;}?>  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
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


      <!--------------------------
        | Your Page Content Here |
        -------------------------->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->