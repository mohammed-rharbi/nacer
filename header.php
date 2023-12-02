<?php session_start(); ?>

<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
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

<?php if (isset($_SESSION['admin'])) { ?>
        <nav id="navbar" class="navbar navbar-expand-lg text-light navbar-light px-3">
            <a class="navbar-brand text-light" href="products.php">
                <h4>Electro Nacer</h4>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="post" action="">
                            <button type="submit" name="logout" class="nav-link btn btn-link text-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <img src="img/user-286.png" alt="Avatar Logo" style="width:40px" class="rounded-pill">
            <li class="nav-item">
                <a class="nav-link" href="#"><?= $_SESSION['admin']['user_email'] ?></a>
            </li>
        </nav>
    <?php } ?>

    <?php if (isset($_SESSION['user'])) { ?>
        <nav id="navbar" class="navbar navbar-expand-lg text-light navbar-light px-3">
            <a class="navbar-brand text-light" href="products.php">
                <h4>Electro Nacer</h4>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <form method="post" action="">
                            <button type="submit" name="logout" class="nav-link btn btn-link text-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <img src="img/user-286.png" alt="Avatar Logo" style="width:40px" class="rounded-pill">
            <li class="nav-item">
                <a class="nav-link" href="#"><?= $_SESSION['user']['user_email'] ?></a>
            </li>
        </nav>
    <?php } ?>
    