<?php
require 'conexao.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AST Solutions | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" 
      style=" height: 0%;
              background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5)), url('dist/img/fundo_login.jpg');
              background-position: top;">
<?php
  if (isset($_POST['usuario']) && !empty($_POST['usuario']) ) {
    $usuario = addslashes($_POST['usuario']);
    $senha = md5(addslashes($_POST['senha']));

    $sql = "SELECT id, nome, senha FROM users WHERE nome = '".$usuario."'";
    $sql = $pdo->query($sql);

    // Definindo msg de possivéis erros
    $message_error_login = "Usuario ou senha inválido!";
    define("ERRO_LOGIN", $message_error_login);

      if($sql->rowCount() > 0){        
        $ln = $sql->fetch();
        $id_user_db = $ln['id'];
        echo "ID: ".$id_user_db;
        $user_db = $ln['nome'];
        $pass_db = $ln['senha'];
        if(isset($_POST['usuario']) && isset($_POST['senha'])){
          
          if(($usuario == $user_db) && ($senha == $pass_db)){
            $_SESSION['id_user'] = $id_user_db;
            header("Location: painel.php");
            exit;
          }else{
            ERRO_LOGIN; 
          }
        }else{
          ERRO_LOGIN;           
        }
      }else{
         ERRO_LOGIN;
      }
  }
?>


<div class="login-box">
  <div class="login-logo">
    <a><b>AST </b>Solutions</a>
  </div>
  <?php
    if(isset($message_error_login)){
      echo '
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        '.ERRO_LOGIN.'</div>';
      } 
  ?>
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Logar para inicar sessão</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario" required="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="senha" placeholder="Senha" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-sm-12 col-xs-12">
          <button type="submit" class="btn btn-warning btn-block btn-flat">Logar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

  <!--   <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
 -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
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
