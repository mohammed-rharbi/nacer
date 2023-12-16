<?php
$server_name = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$server_name;dbname=myspace", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

include("header.php");

// Retrieve the product ID from the cookie
$nameCat = isset($_COOKIE['catgName']) ? $_COOKIE['catgName'] : 0;

// Fetch the product details based on the ID
$stmt = $conn->prepare("SELECT * FROM category WHERE cat_name = :nm");
$stmt->bindParam(':nm', $nameCat);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the updated values from the form
    $name = $_POST['editName'];
    $description = $_POST['description'];
    $img = 'img/' . $_FILES['img']['name'];
    // Update the product information in the database
    $stmt = $conn->prepare("UPDATE `category` SET `cat_name` = '$name', cat_img = '$img' , `cat_description` = '$description' WHERE `cat_name` = '$nameCat'");

    move_uploaded_file ($_FILES['img']['tmp_name'], 'C:\xampp\htdocs\ELECTRO_NACER_B6\nacer\img\\' . $_FILES['img']['name'] );


  
    
    // $stmt->bindParam(':name', $name);
    // $stmt->bindParam(':description', $description);
    // $stmt->bindParam(':imag', $img);
    // $stmt->bindParam(':nm', $nameCat);
    $stmt->execute();
}

?>

<form method="post" class="container" enctype="multipart/form-data">
    <div class="form-group">
        <img src="<?php echo $result['cat_img'] ?>" alt="" width="150px">
    </div>
    <div class="form-group">
        <label for="catname" class="text-white">Category Name</label>
        <input type="text" class="form-control" name="editName" id="catname" value="<?php echo $result['cat_name'] ?? ''; ?>">
    </div>
   
    <div class="form-group">
        <label for="description" class="text-white">Product description</label>
        <textarea type="text" class="form-control" name="description" id="description"><?php echo $result['cat_description'] ?? ''; ?></textarea>
    </div>
    <div class="form-group">
        <label for="img" class="text-white">Product img</label>
        <input type="file" class="form-control" name="img" id="img">
    </div>


    <input type="submit" name="btn" class="btn bg-info mt-3">
</form>

<!-- Rest of your HTML content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>