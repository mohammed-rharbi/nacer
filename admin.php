<?php require('./header.php') ?>
<?php require('./connection.php') ?>

<?php

if (isset($_POST['delete'])) {
  $id = $_POST['delete'];
  $stmtd = $conn->prepare("DELETE FROM users WHERE user_id = '$id'");
  $stmtd->execute();
}
if (isset($_POST['valid'])) {
  $id = $_POST['valid'];
  $stmtd = $conn->prepare("UPDATE users SET role = 'user' WHERE user_id = '$id'");
  $stmtd->execute();
}
if (isset($_POST['toAdmin'])) {
  $id = $_POST['toAdmin'];
  $stmtd = $conn->prepare("UPDATE users SET role = 'admin' WHERE user_id = '$id'");
  $stmtd->execute();
}

if (isset($_POST['hide'])) {
  $id = $_POST['hide'];
  $stmtd = $conn->prepare("UPDATE products SET hide = 0 WHERE id = '$id'");
  $stmtd->execute();
}

if (isset($_POST['edit'])) {
  setcookie("productId", $_POST['edit']);
  header("Location: editProducts.php");
  exit;
}

if(isset($_POST['hideCatg'])) {
  $name = $_POST['hideCatg'];
  $stmtd = $conn->prepare("UPDATE category SET hide = 0 WHERE cat_name = '$name'");
  $stmtd->execute();
}

if(isset($_POST['editCatg'])) {
  setcookie("catgName", $_POST['editCatg']);
  header("Location: editCatg.php");
  exit;

}
?>


<div class="d-flex justify-content-center gap-5 pt-5">
  <button type="button" class="btn btn-warning" onclick="showUsers()">users</button>
  <button type="button" class="btn btn-warning" onclick="showProducts()">products</button>
  <button type="button" class="btn btn-warning" onclick="showCategory()">category</button>
</div>






<div class="container mt-4" id="usersTable" style="display:block;">
  <h2>users Table</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Fetch users
      $stmt = $conn->prepare("SELECT * FROM users");
      $stmt->execute();
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($users as $user) :
      ?>
        <tr>
          <td><?php echo $user['user_id']; ?></td>
          <td><?php echo $user['userName']; ?></td>
          <td><?php echo $user['user_email']; ?></td>
          <td><?php echo $user['user_password']; ?></td>
          <td><?php echo $user['role']; ?></td>
          <td>
            <form method="POST">
              <?php if ($user["role"] === "unverified") { ?>
                <button type="submit" name="delete" value=<?php echo $user['user_id'] ?> class="btn btn-danger">delete</button>
                <button type="submit" name="valid" value=<?php echo $user['user_id'] ?> class="btn btn-info">Valid</button>
              <?php } ?>

              <?php if ($user['role'] === "user") { ?>
                <button type="submit" name="toAdmin" value=<?php echo $user['user_id'] ?> class="btn btn-success">To admin</button>
              <?php } ?>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="container mt-4" id="productsTable" style="display: none;">
  <h2>products Table</h2>
  <table class="table">
    <thead>
      <tr>
        <th>img</th>
        <th>ID</th>
        <th>reference</th>
        <th>barcode</th>
        <th>title</th>
        <th>purchase price</th>
        <th>final price</th>
        <th>price offer</th>
        <th>description</th>
        <th>min quantity</th>
        <th>stock quantity</th>
        <th>category</th>
        <th>edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Fetch users
      $stmt = $conn->prepare("SELECT * FROM products WHERE hide = 1");
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($products as $product) :
      ?>
        <tr>
          <td><img style="height: 100px;" src="<?php echo $product['img']; ?>" alt="product img"></td>
          <td><?php echo $product['id']; ?></td>
          <td><?php echo $product['prod_reference']; ?></td>
          <td><?php echo $product['barcode']; ?></td>
          <td><?php echo $product['prod_name']; ?></td>
          <td><?php echo $product['purchasePrice']; ?></td>
          <td><?php echo $product['finalPrice']; ?></td>
          <td><?php echo $product['priceOffer']; ?></td>
          <td><?php echo $product['description']; ?></td>
          <td><?php echo $product['minQuantity']; ?></td>
          <td><?php echo $product['stockQuantity']; ?></td>
          <td><?php echo $product['catg']; ?></td>
          <td>
            <form method="POST">
              <button type="submit" name="hide" value=<?php echo $product['id'] ?> class="btn btn-danger">hide</button>
              <button type="submit" name="edit" value=<?php echo $product['id'] ?> class="btn btn-info mb-1">edit</button>
            </form>
          </td>
        <?php endforeach; ?>
    </tbody>
  </table>

  <a class="btn btn-primary" href="addproduct.php" role="button">add product</a>

</div>

<div class="container mt-4" id="categoryTable" style="display: none;">
  <h2>category Table</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>desription</th>
        <th>img</th>
        <th>edit</th>
      </tr>
    </thead>
    <?php
    // Fetch users
    $stmt = $conn->prepare("SELECT * FROM category WHERE hide = 1");
    $stmt->execute();
    $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($category as $categ) :
    ?>
      <tbody>
        <tr>
          <td><?php echo $categ['cat_name']; ?></td>
          <td><?php echo $categ['cat_description']; ?></td>
          <td><img src="<?php echo $categ['cat_img']; ?>" alt="" style="height: 120px;"></td>
          <td>
            <form method="POST">
            <button type="submit" name="hideCatg" value="<?php echo $categ['cat_name'] ?>"  class="btn btn-danger">hide</button>
            <button type="submit" name="editCatg" value="<?php echo $categ['cat_name'] ?>" class="btn btn-info">edit</button>
            </form>
          </td>
        </tr>
      </tbody>
    <?php endforeach; ?>
  </table>

  <a class="btn btn-primary" href="addCategory.php" role="button">add category</a>

</div>

<script>
  function showUsers() {
    document.getElementById('usersTable').style.display = 'block';
    document.getElementById('productsTable').style.display = 'none';
    document.getElementById('categoryTable').style.display = 'none';
  }

  function showProducts() {
    document.getElementById('productsTable').style.display = 'block';
    document.getElementById('usersTable').style.display = 'none';
    document.getElementById('categoryTable').style.display = 'none';
  }

  function showCategory() {
    document.getElementById('categoryTable').style.display = 'block';
    document.getElementById('usersTable').style.display = 'none';
    document.getElementById('productsTable').style.display = 'none';
  }
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>