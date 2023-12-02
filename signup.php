<?php require('./connection.php') ?>
<?php session_start() ?>
<?php

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <section id="log">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form id="forma" class="w-50 rounded-3 p-5" method="POST" action="signup_procces.php">
                <div class="container-fluid">
                    <h2 class="text-center text-light mb5">SIGN UP</h2>
                    <div class="mb-3">
                        <label for="name" class="form-label text-light">Enetr your name</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="name-lHelp">
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label text-light">Email address</label>
                        <input type="email" name="email" class="form-control" id="Email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label text-light">Password</label>
                        <input type="password" name="password" class="form-control" id="Password">
                    </div>
                    <div class="text-center mt-5"> 
                        <button type="submit" class="btn btn-primary">SIGN UP</button>
                    </div>
                    <a class="nav-link text-info text-center mt-4" href="index.php">
                        LOGIN
                    </a> 
                </div>
            </form>
        </div>
    </section>

 
    
    <?php require('./footer.php') ?>