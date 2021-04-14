<?php
session_start();
$message = "";
if (isset($_POST['submit'])) {
    if ($_POST['email'] != '' && $_POST['password'] != '') {
        include_once 'beans/Users.php';
        include_once 'services/UsersServices.php';
        // creating a new user servcie
        $us = new UsersServices();
        // retrieving id of the email if exists
        $id = $us->findByEmail($_POST['email']);
        // retrieving an object Users
        $u = $us->findById($id);
        // getting the password retrieved from  the database
        $password = $u->getPassword();
        // checking the password
        if (password_verify($_POST['password'], $password)) {
            // the password is correct
            $_SESSION['users'] = $u->getid();
            $_SESSION['nom'] = $u->getNom();
            $_SESSION['prenom'] = $u->getPrenom();
            $_SESSION['email'] = $u->getEmail();
            header('Location: ./index.php');
        }
        else{
            // the password is not correct
          header('Location:./login.php?error=invalid');
        }
    } else {
        // the input error !!
        header('Location:./login.php?error=vide');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="vendor/css/css.css"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="style/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="" class="user" method="POST">
                                    <?php
                                        if(isset($_GET['error'])){
                                                    if($_GET['error']=="invalid")
                                                        echo '<div class="alert alert-danger" role="alert">Mote de passe ou Email incorrect!</div>';
                                                    if($_GET['error']=="vide")
                                                        echo '<div class="alert alert-danger" role="alert">Quelque champ est vide</div>';
                                                }if(isset($_GET['success'])){
                                                    if($_GET['success']=="verifyok")
                                                        echo '<div class="alert alert-success" role="alert">Votre mot de passe est changé avec succés</div>';
                                                }
                                        ?>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block btn-user" type="submit" name="submit" >Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
     <?php require 'inc/script.inc.php' ?>
    </body>
</html>