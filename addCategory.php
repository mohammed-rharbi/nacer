<?php
$server_name = "localhost";
$username = "root";
$password = "";

require 'connection.php';

include("header.php");


$id = isset($_COOKIE['productId']) ? $_COOKIE['productId'] : 0;


$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt1 = $conn->prepare("SELECT * FROM category");
$stmt1->execute();
$catgs = $stmt1->fetchAll(PDO::FETCH_ASSOC);


// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the updated values from the form
    $name = $_POST['prodName'];
    $description = $_POST['description'];
    $img = 'img/' . $_FILES['img']['name'];
    // Update the product information in the database
    $stmt = $conn->prepare("INSERT INTO `category` (cat_name, cat_description, cat_img) VALUES ('$name', '$description', '$img')");

    move_uploaded_file($_FILES['img']['tmp_name'], 'C:\xampp\htdocs\ELECTRO_NACER_B6\img\\');

    $stmt->execute();
}

?>

<form method="post" class="container mt-5 gap-4" enctype="multipart/form-data">

    <div class="form-group">
        <label for="catname" class="text-white">Category Name</label>
        <input type="text" class="form-control" name="prodName" id="catname">
    </div>
    <div class="form-group">
        <label for="description" class="text-white">Category description</label>
        <textarea type="text" class="form-control" name="description" id="description"></textarea>
    </div>
    <div class="form-group">
        <label for="img" class="text-white">Upload Image</label>
        <input type="file" class="form-control" name="img" id="img">
    </div>

    <input type="submit" name="btn" class="btn bg-info mt-3">
</form>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>