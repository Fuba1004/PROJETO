<?php
$menu = MenuLateralAreas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/painel/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/painel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/painel/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/painel/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/painel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/painel/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="/painel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/painel/plugins/toastr/toastr.min.css">
</head>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/painel/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["administrador"]["administradorNome"]; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               <?php
               if(count($menu)>0){
                for ($i=0; $i < count($menu); $i++) { 
                  echo '<li class="nav-item '.(isset($menu[$i]["ativo"])?"menu-open":"").'">';
                  echo '    <a '.($menu[$i]["painelAreasPermalink"] != ""?"href='".$BASEURL.$menu[$i]["painelAreasPermalink"]."'":"").' class="nav-link '.(isset($menu[$i]["ativo"])?"active":"").'">';
                  echo '      <i class="far fa-circle nav-icon"></i>';
                  echo '      <p>'.$menu[$i]["painelAreasNome"].(count($menu[$i]["subMenus"])>0?'<i class="right fas fa-angle-left"></i>':"").'</p>';
                  echo '    </a>';
                  if(count($menu[$i]["subMenus"])>0){
                    echo '<ul class="nav nav-treeview">';
                    for ($i2=0; $i2 < count($menu[$i]["subMenus"]); $i2++) { 
                      echo '<li class="nav-item">';
                      echo '  <a href="'.$BASEURL.$menu[$i]["painelAreasPermalink"]."/".$menu[$i]["subMenus"][$i2]["painelAreasPermalink"].'" class="nav-link '.(isset($menu[$i]["subMenus"][$i2]["ativo"])?"active":"").'">';
                      echo '    <i class="far fa-circle nav-icon"></i>';
                      echo '    <p>'.$menu[$i]["subMenus"][$i2]["painelAreasNome"].'</p>';
                      echo '  </a>';
                      echo '</li>';
                    }
                    echo '</ul>';
                  }
                  echo '</li>';
                }
               }
               ?>
            <li class="nav-item">
                <a style="background-color: red;" href="/painel/logout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sair</p>
                </a>
            </li>
              
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>








