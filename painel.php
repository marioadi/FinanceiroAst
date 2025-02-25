<?php 
require 'conexao.php';
session_start();

if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user']) ) {
    $id_user_logado = $_SESSION['id_user'];

    $dados_user = $pdo->query("SELECT nome FROM users WHERE id = '".$id_user_logado."'");
    if($dados_user->rowCount() > 0){
      $ln_user = $dados_user->fetch();
      $nome_user = $ln_user['nome'];
    }
}else{
  header("Location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AST Solutions | Dashboard</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
   <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>ST</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>AST </b>Solutions</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/ast.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $nome_user; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/ast.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php echo $nome_user; ?> - Financeiro
                  <small>Membro</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
               /.row -->
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="sair.php" class="btn btn-default btn-flat">Deslogar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/ast.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $nome_user; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Morris</a></li>
          </ul>
        </li>
        
        <li><a><i class="fa fa-book"></i> <span>Doc</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">

          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php

                $STH_SELECT = $pdo->query("SELECT sum(Valor) FROM boletos WHERE Status IN ('Vencido','Pago','No Prazo') ");
                $totalSoma = $STH_SELECT->fetchColumn();
  			        $value_formated = number_format($totalSoma, 2, ',', '.');
              
              ?>
              <h3>$ <?php echo $value_formated; ?></h3>
              <p>Valor Total</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Grafic</a>
          </div>
        </div>
        <!-- ./col -->


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
              <?php
                $pagos = $pdo->query("SELECT * FROM boletos WHERE Status = 'Pago'");
                $resultVal = $pagos->rowCount();
               ?>
              <h3><?php echo $resultVal; ?></h3>

              <p>Boletos Pagos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Grafic</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $venci = $pdo->query("SELECT * FROM boletos WHERE Status = 'Vencido'");
                $resultVen = $venci->rowCount();
               ?>
              <h3><?php echo $resultVen; ?></h3>
              <p>Boletos Vencidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Grafic</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $quant_boletos = $pdo->query("SELECT * FROM boletos WHERE Status IN ('Vencido','Pago','No Prazo')");
                $total_bol = $quant_boletos->rowCount();
              ?>
              <h3><?php echo $total_bol; ?></h3>

              <p>Quantidade de Boletos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Grafic</a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


      <!-- Main row -->
      <div class="row">
        <section class="col-sm-12 connectedSortable">
        <!-- Inicio Conteudo -->



<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!--<th>ID boleto</th>-->
                  <th>Valor</th>
                  <th>Cliente</th>
                  <th>Nosso Numero</th>
                  <th>Data Envio</th>
                  <th>Vencimento</th>
                  <th>Status</th>
                  <th>Observação</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $sql = $pdo->query("SELECT * FROM boletos WHERE Status IN ('Vencido','Pago','No Prazo') ORDER BY Status DESC, Vencimento ASC, Cliente ASC");
                  if($sql->rowCount() > 0){
                    foreach ($sql->fetchAll() as $ln) {
                      //$ID = $ln['ID_boleto'];
                      $valor = $ln['Valor'];
                      $cliente = $ln['Cliente'];
                      $nosso_num = $ln['Nosso_num'];
                      $data_en = $ln['Data_envio'];
                      $vencimento = $ln['Vencimento'];
                      $status = $ln['Status'];
                      $obs = $ln['Obs'];    
                ?>
                    <tr>
                      <!--<td><?php //echo $ID; ?></td>-->
					  <td>R$ <?php echo $valor; ?></td>
                      <td><?php echo $cliente; ?></td>
                      <td><?php echo $nosso_num; ?></td>
                      <td><?php echo date("d-m-Y", strtotime($data_en)); ?></td>
                      <td><?php echo date("d-m-Y", strtotime($vencimento)); ?></td>
                      <td>
                        <?php if($status == "Pago"): ?>
                          <font color="green"><?php echo $status; ?></font>
                        <?php elseif($status == "Vencido"): ?> 
                          <font color="red"><?php echo $status; ?></font>
                        <?php else: ?>
                          <?php echo $status; ?>
                        <?php endif; ?>  
                      </td>
                      <td><?php echo $obs; ?></td>
                    </tr>
                <?php
                    }
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <!--<th>ID boleto</th>-->
                  <th>Valor</th>
                  <th>Cliente</th>
                  <th>Nosso Numero</th>
                  <th>Data Envio</th>
                  <th>Vencimento</th>
                  <th>Status</th>
                  <th>Observação</th>
                </tr>
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
        <!-- Fim Conteudo -->
        </section>
      </div>

    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b> 1.0 By <b> Mario_Dev</b>
    </div>
    <strong>Copyright &copy; 2019 <a href="https://astsolutions.com.br">AST Solutions</a>.</strong> Todos os direitos reservados.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Table -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
		$('#example1').DataTable( {
		  'paging'    : true,
		  'lengthChange': true,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : false,
		} );		
	} );
	
</script>

</body>
</html>
