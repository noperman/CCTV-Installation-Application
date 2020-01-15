<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vision Star | <?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?php
  if (!empty($css)) {
    foreach ($css as $item):
  ?>
  <link rel="stylesheet" href="<?=$item['src']?>">
  <?php
    endforeach;
  }
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <!-- <a href="<?=base_url()?>" class="brand-link">
        <img src="<?=base_url()?>assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">VisionStar</span>
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?=base_url()?>assets/images/default_avatar.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?=$this->session->userdata('username')?></a>
          </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

            <?php foreach($menu as $menus) : ?>
            <li class="<?=$menus['li_class']?>">
              <a href="<?=base_url($menus['a_href'])?>" class="<?=$menus['a_class']?> <?=($menus['menu'] == $title)?'active':'';?>">
                <i class="<?=$menus['a_icon']?>"></i>
                <p><?=$menus['menu']?><i class="<?=$menus['p_icon']?>"></i></p>
              </a>
              <?php if($menus[0][0]['sub_menu']):?>
                <ul class="nav nav-treeview">
                  <?php foreach($menus[0] as $submenu):?>
                  <li class="<?=$submenu['li_class']?>">
                    <a href="<?=base_url($submenu['a_href'])?>" class="<?=$submenu['a_class']?> <?=($submenu['sub_menu'] == $title)?'active':'';?>">
                      <i class="<?=$submenu['a_icon']?>"></i>
                      <p><?=$submenu['sub_menu']?></p>
                    </a>
                  </li>
                  <?php endforeach?>
                </ul>
              <?php endif?>
            </li>
            <?php endforeach?>

            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Sign Out
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?=$title?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <?php
                foreach ($breadcrumb as $item):
                ?>
                <li class="breadcrumb-item <?=($item['active']) ? 'active' : ''?>">
                  <?=($item['active']) ? ''.$item['text'].'' :
                  '<a href="'.$item['link'].'">'.$item['text'].'</a>' ?>
                </li>
                <?php
                endforeach;
                ?>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <?=$contents?>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Sign Out" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <a class="btn btn-primary" href="<?=base_url()?>signout">Sign Out</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="<?=base_url()?>">VisionStar</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.0.1
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  
  <!-- jQuery -->
  <script src="<?=base_url()?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url()?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    const baseurl = '<?=base_url()?>';
  </script>
  
  <?php
  if (!empty($js)) {
    foreach ($js as $item):
  ?>
  <script src="<?=$item['src']?>"></script>
  <?php
    endforeach;
  }
  ?>
  <!-- AdminLTE App -->
  <script src="<?=base_url()?>assets/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>