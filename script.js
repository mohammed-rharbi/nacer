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