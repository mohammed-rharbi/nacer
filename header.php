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

    <?php if (!empty($_SESSION['admin'])) { ?>
        <nav id="navbar" class="navbar navbar-expand-lg text-light navbar-light px-3">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="products.php">
                    <h4>Electro Nacer</h4>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">dashbord</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                    <button name="logout">Logout</button>
                            </a>
                        </li>
                    </ul>
                </div>
                <img src="img/user-286.png" alt="Avatar Logo" style="width:40px" class="rounded-pill">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $_SESSION['admin']['user_email'] ?></a>
                </li>
            </div>
        </nav>

    <?php } ?>
    <?php if (!empty($_SESSION['user'])) { ?>
        <nav id="navbar" class="navbar navbar-expand-lg text-light navbar-light px-3">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="products.php">
                    <h4>Electro Nacer</h4>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                    <button name="logout">Logout</button>
                            </a>
                        </li>
                    </ul>
                </div>
                <img src="img/user-286.png" alt="Avatar Logo" style="width:40px" class="rounded-pill">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?= $_SESSION['user']['user_email'] ?></a>
                </li>
            </div>
        </nav>
    <?php } ?>
    <?php if (empty($_SESSION['user']) && empty($_SESSION['admin'])) { ?>
        <nav  class="navbar navbar-expand-lg navbar-light bg-light px-3">
            <a class="navbar-brand" href="#">Electro Nacer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php } ?>