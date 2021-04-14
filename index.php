<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SESSION["users"]) {
    ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="vendor/css/css.css"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="style/sb-admin-2.css" rel="stylesheet">
    <link href="style/main.css" rel="stylesheet">
    <link href="style/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="style/jquery.dataTables.min.css" rel="stylesheet">
    <script src="vendor/chartjs/chart.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <li class="nav-item pt-2">
                <div class="text-center">
                   <span id="userheader"> <?php echo $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></span>
                </div>

            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestion
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="./index.php?page=classe">
                    <i class="fas fa-school"></i>
                    <span>Classe</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="./index.php?page=classeparfiliere">
                    <i class="fas fa-school"></i>
                    <span>Classe par filiere</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="./index.php?page=filiere">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Filiere</span></a>
            </li>

            <hr class="sidebar-divider my-0">

            <li class="nav-item logout">
                <a class="nav-link" href="./logout.php">
                <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    

                
                <?php  
                    
                    if(isset($_GET['page'])){
                        extract($_GET);
                        if($page == "classe"){
                            include_once 'pages/classe.php';

                        } elseif ($page == "filiere") {
                            include_once 'pages/filiere.php';
                        } elseif ($page == "classeparfiliere"){
                            include_once 'pages/classeparfiliere.php';
                        }
                    } else {
                        include_once 'pages/master.php';
                    }

                                
                ?>
            
                    

                

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ibrahim Chahboune 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery-3.6.0.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/bootstrap.bundle.js"></script>
    <script src="vendor/dataTables.bootstrap4.js"></script>
    <script src="vendor/jquery.dataTables.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.js"></script>
    <?php 
        if(isset($_GET['page'])){
                        extract($_GET);
                        if($page == "classe"){
                            include_once 'inc/script.classe.php';

                        } elseif ($page == "filiere") {
                            include_once 'inc/script.filiere.php';
                        } elseif ($page == "classeparfiliere"){
                            include_once 'inc/script.clparfiliere.php';
                        }
        } else {
            include_once 'inc/script.main.php';
        }
        ?>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    


</body>

</html>
    <?php
} else {
    header("Location: login.php");
}