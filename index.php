
<?php require('./connection.php') ?>
<?php session_start() ?>
<?php

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
}

?>
<?php


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = :email AND user_password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user > 0) {
        if ($user['role'] == 'admin') {
            $_SESSION['admin'] = $user;
            header("Location: admin.php");
            exit();
        } elseif ($user['role'] == 'user'){
            $_SESSION['user'] = $user;
            header("Location: products.php");
            exit();
        }else{
            $_SESSION['unverified'] = $user;
            header("Location: unverified.php");
            exit();
        }
        
    } else {
        echo "<script>alert('Email or Password incorrect!')</script>";
    }
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
        <form method="post" id="forma" class="w-50 rounded-3 p-5">
            <div class="container-fluid">
                <h2 class="text-center text-light mb5">LOGIN</h2>
                <div class="mb-3">
                    <label for="Email" class="form-label text-light">Email address</label>
                    <input type="email" name="email" class="form-control" id="Email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label text-light">Password</label>
                    <input type="password" name="password" class="form-control" id="Password">
                </div>
                <div class="text-center mt-5">
                    <button type="submit" name="login" class="btn btn-primary">login</button>
                </div>
                <p class="text-center text-light mt-4">you dont have account? <a class="nav-link text-info" href="signup.php">
                        SIGN UP
                    </a></p>
            </div>
        </form>
    </div>
</section>
<?php require('./footer.php') ?>