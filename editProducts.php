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
$id = isset($_COOKIE['productId']) ? $_COOKIE['productId'] : 0;

// Fetch the product details based on the ID
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the updated values from the form
    $name = $_POST['editName'];
    $purchasePrice = $_POST['purchasePrice'];
    $priceOffer = $_POST['priceOffer'];
    $finalPrice = $_POST['finalPrice'];
    $minQuantity = $_POST['minQuantity'];
    $stockQuantity = $_POST['stockQuantity'];
    $description = $_POST['description'];
    $img = 'img/' . $_FILES['img']['name'];
    // Update the product information in the database
    $stmt = $conn->prepare("UPDATE `products` SET `prod_name` = :name, `purchasePrice` = :purchasePrice, `priceOffer` = :priceOffer, `finalPrice` = :finalPrice, `minQuantity` = :minQuantity, `stockQuantity` = :stockQuantity, img = :imag , `description` = :description WHERE `id` = :id");

    move_uploaded_file ($_FILES['img']['tmp_name'], 'C:\xampp\htdocs\ELECTRO_NACER_B6\nacer\img\\' . $_FILES['img']['name'] );


 
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':purchasePrice', $purchasePrice);
    $stmt->bindParam(':priceOffer', $priceOffer);
    $stmt->bindParam(':finalPrice', $finalPrice);
    $stmt->bindParam(':minQuantity', $minQuantity);
    $stmt->bindParam(':stockQuantity', $stockQuantity);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam('imag', $img);
    $stmt->execute();
}

?>

<form method="post" class="container" enctype="multipart/form-data">
    <div class="form-group">
        <img src="<?php echo $result['img'] ?>" alt="" width="150px">
    </div>
    <div class="form-group">
        <label for="productname" class="text-white">Product Name</label>
        <input type="text" class="form-control" name="editName" id="exampleFormControlInput1" value="<?php echo $result['prod_name'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="purchasePrice" class="text-white">purchase Price</label>
        <input type="number" class="form-control" name="purchasePrice" id="purchasePrice" value="<?php echo $result['purchasePrice'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="priceOffer" class="text-white">price offer</label>
        <input type="number" class="form-control" name="priceOffer" id="priceOffer" value="<?php echo $result['priceOffer'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="finalPrice" class="text-white">final price</label>
        <input type="number" class="form-control" name="finalPrice" id="finalPrice" value="<?php echo $result['finalPrice'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="minQuantity" class="text-white">min quantity</label>
        <input type="number" class="form-control" name="minQuantity" id="minQuantity" value="<?php echo $result['minQuantity'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="stockQuantity" class="text-white">stock quantity</label>
        <input type="number" class="form-control" name="stockQuantity" id="stockQuantity" value="<?php echo $result['stockQuantity'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="description" class="text-white">Product description</label>
        <input type="text" class="form-control" name="description" id="description" value="<?php echo $result['description'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="img" class="text-white">Product img</label>
        <input type="file" class="form-control" name="img" id="img">
    </div>


    <input type="submit" name="btn" class="btn bg-info mt-3 mb-5">
</form>

<!-- Rest of your HTML content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>