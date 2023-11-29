<?php require('./header.php') ?>
<?php require('./connection.php') ?>
<?php

if (isset($_GET['category_name'])) {
  $id = $_GET['category_name'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1 AND catg = '$id'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $products = $stmt->fetchAll();
} else if(isset($_GET['out_of_stock'])) {
  $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1 AND minQuantity >= stockQuantity");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $products = $stmt->fetchAll();
} else {
  $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $products = $stmt->fetchAll();
}
$stmt1 = $conn->prepare("SELECT * FROM category WHERE hide = 1");
$stmt1->execute();
$stmt1->setFetchMode(PDO::FETCH_ASSOC);
$categories = $stmt1->fetchAll();



?>


<div class="d-flex justify-content-center m-5 gap-5">

  <a href="products.php">
    <button type="button" id="btn" class="btn btn-secondary">All products</button>
  </a>

  <a href="products.php?out_of_stock=">
    <button type="button" id="btn" class="btn btn-secondary">low Stock</button>
  </a>

  <div class="dropdown text-center">
    <a class="btn btn-secondary dropdown-toggle" id="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      category
    </a>
    <ul class="dropdown-menu">
      <?php foreach ($categories as $category) { ?>
        <li><a class="dropdown-item" href="products.php?category_name=<?php echo $category['cat_name']; ?>"><?php echo $category['cat_name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>




<div class="container me-5">
  <div class="row">

    <?php foreach ($products as $product) { ?>
      <div class="col-md-4 mb-5">
        <div id="cardi" class="cols-sm-4 card rounded-3" style="width: 18rem;">
          <h5 class="card-title text-black text-center mb-4 p-2"><?php echo $product['prod_name']; ?></h5>
          <img src="<?php echo $product['img']; ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h2 class="card-text text-danger fw-bold" id="price"><?php echo $product['finalPrice']; ?></h2>
          </div>
        </div>
      </div>






    <?php } ?>
  </div>
</div>


<?php require('./footer.php') ?>