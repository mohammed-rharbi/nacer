<?php require('./header.php') ?>
<?php require('./connection.php') ?>
<?php


$itemsPerPage = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;


if (isset($_GET['category_name'])) {
  $id = $_GET['category_name'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1 AND catg = :id LIMIT :itemsPerPage OFFSET :offset");
  $stmt->bindParam(':id', $id);
} 

else if(isset($_GET['out_of_stock'])) {
  $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1 AND minQuantity >= stockQuantity LIMIT :itemsPerPage OFFSET :offset");
}

else {
  $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1 LIMIT :itemsPerPage OFFSET :offset");
}

$stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$products = $stmt->fetchAll();

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
        <div id="cardi" class="cols-sm-4 card rounded-3" style="width: 20rem;">
        <h3 class="card-title text-white text-center mt-2 p-2"><?php echo $product['prod_name']; ?></h3>
        <img src="<?php echo $product['img']; ?>" class="mt-5 card-img-top" alt="...">
          <div class="card-body">
            <h2 class="card-text text-info fw-bold" id="price"><?php echo $product['finalPrice'].' DH'; ?></h2>
            <h5 class="card-text text-danger fw-bold" id="price"><del><?php echo $product['priceOffer'] . 'HD'; ?></del></h5>
          </div>
        </div>
      </div>

    <?php } ?>
  </div>
</div>
</div>



<div class="pagination justify-content-center mt-5 mb-3" >
  <?php
  $stmt = $conn->prepare("SELECT COUNT(*) as total FROM products WHERE hide = 1");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $totalPages = ceil($row['total'] / $itemsPerPage);

  for ($i = 1; $i <= $totalPages; $i++) {
    echo "<li class='page-item " . ($page == $i ? "active" : "") . "'><a class='page-link' href='products.php?page=$i'>$i</a></li>";
  }
  
  ?>
</div>





<?php require('./footer.php') ?>