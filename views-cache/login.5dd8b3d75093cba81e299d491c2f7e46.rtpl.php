<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/service-request/res/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/service-request/res/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/service-request/res/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/service-request/res/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/service-request/res/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>SOLICITAÇÃO DE SUPORTE LIBERATO</b>
    </div>

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


    <div class="login-box-body">
      <p class="login-box-msg">Informe matrícula ou email para entrar</p>
      <form action="/service-request/login" method="post" data-js="form">
        <div class="form-group has-feedback">
          <input type="text" name="login" class="form-control" placeholder="Login \ Email" data-js="input" data-information="Login">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Senha" data-js="input" data-information="Senha">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">

          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Logar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="/service-request/res/scripts/form.js"></script>
  <script src="/service-request/res/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/service-request/res/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/service-request/res/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>
</html>
