
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
        <a href="login.php">
        <div class="text-center mt-5">
            <button  type="submit" class="btn btn-primary">back to login page</button>
        </div>
        </a>';
        
        
    } else {
        
        echo "Registration failed. Please try again.";
    }
}
?>
