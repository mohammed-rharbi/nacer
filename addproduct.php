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
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt1 = $conn->prepare("SELECT * FROM category");
$stmt1->execute();
$catgs = $stmt1->fetchAll(PDO::FETCH_ASSOC);


// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the updated values from the form
    $name = $_POST['prodName'];
    $refe = $_POST['ref'];
    $barcode = $_POST['barcode'];
    $purchasePrice = $_POST['purchasePrice'];
    $priceOffer = $_POST['priceOffer'];
    $finalPrice = $_POST['finalPrice'];
    $minQuantity = $_POST['minQuantity'];
    $stockQuantity = $_POST['stockQuantity'];
    $description = $_POST['description'];
    $catg = $_POST['cat'];
    $img = 'img/' . $_FILES['img']['name'];
    // Update the product information in the database
    $stmt = $conn->prepare("INSERT INTO `products` (prod_name, prod_reference, barcode, purchasePrice, priceOffer, finalPrice, description, minQuantity, stockQuantity, img ,catg) VALUES (:name, :ref, :barcode, :purchasePrice, :priceOffer, :finalPrice, :description, :minQuantity, :stockQuantity, :imag , :category)");



    move_uploaded_file ($_FILES['img']['tmp_name'], 'C:\xampp\htdocs\ELECTRO_NACER_B6\nacer\img\\' . $_FILES['img']['name'] );


    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':ref', $refe);
    $stmt->bindParam(':barcode', $barcode);
    $stmt->bindParam(':purchasePrice', $purchasePrice);
    $stmt->bindParam(':priceOffer', $priceOffer);
    $stmt->bindParam(':finalPrice', $finalPrice);
    $stmt->bindParam(':minQuantity', $minQuantity);
    $stmt->bindParam(':stockQuantity', $stockQuantity);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':imag', $img);
    $stmt->bindParam(':category',$catg);
    $stmt->execute();
}

?>

<form method="post" class="container mt-5 gap-4" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="productname" class="text-white">Product Name</label>
        <input type="text" class="form-control" name="prodName" id="exampleFormControlInput1">
    </div>
    <div class="form-group">
        <label for="purchasePrice" class="text-white">product reference</label>
        <input type="number" class="form-control" name="ref" id="purchasePrice" min="0">
    </div>
    <div class="form-group">
        <label for="purchasePrice" class="text-white">barcode</label>
        <input type="number" class="form-control" name="barcode" id="purchasePrice" min="0">
    </div>
    <div class="form-group">
        <label for="purchasePrice" class="text-white">purchase Price</label>
        <input type="number" class="form-control" name="purchasePrice" id="purchasePrice" min="0">
    </div>
    <div class="form-group">
        <label for="priceOffer" class="text-white">price offer</label>
        <input type="number" class="form-control" name="priceOffer" id="priceOffer" min="0">
    </div>
    <div class="form-group">
        <label for="finalPrice" class="text-white">final price</label>
        <input type="number" class="form-control" name="finalPrice" id="finalPrice" min="0">
    </div>
    <div class="form-group">
        <label for="minQuantity" class="text-white">min quantity</label>
        <input type="number" class="form-control" name="minQuantity" id="minQuantity" min="0">
    </div>
    <div class="form-group">
        <label for="stockQuantity" class="text-white">stock quantity</label>
        <input type="number" class="form-control" name="stockQuantity" id="stockQuantity" min="0">
    </div>
    <div class="form-group">
        <label for="description" class="text-white">Product description</label>
        <input type="text" class="form-control" name="description" id="description">
    </div>
    <div class="form-group">
        <label for="cat" class="text-white">category</label>
        <select  class="form-control" name="cat" id="cat">
            <?php foreach($catgs as $item): ?>
                <option><?php echo $item['cat_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <input type="file" class="form-control" name="img" id="img">
    </div>

    <input type="submit" name="btn" class="btn bg-info mt-3 mb-5">
</form>

<!-- Rest of your HTML content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>