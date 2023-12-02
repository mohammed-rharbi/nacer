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
<?php
require('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

// Prepare the SQL statement
$query = "INSERT INTO users (userName, user_email, user_password , role) VALUES (:username, :email, :password , 'unverified')";
// Prepare the SQL statement
$stmt = $conn->prepare($query);

// Bind parameters if needed
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);



$result = $stmt->execute();
    if ($result) {
      
        echo "Registration successful! please wait for admin verification";
        echo'<h1 class="text-center mt-5">please wait for admin verification</h1>
        <a href="index.php">
        <div class="text-center mt-5">
            <button  type="submit" class="btn btn-primary">back to login page</button>
        </div>
        </a>';
        
        
    } else {
        
        echo "Registration failed. Please try again.";
    }
}
?>
