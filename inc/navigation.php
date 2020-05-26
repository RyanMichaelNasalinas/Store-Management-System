  <nav style="margin-bottom:20px">
      <a href="index.php">Home</a>
      <?php if ($user_data['access'] == 'admin') : ?>
          <a href="add-user.php">Add User</a>
          <a href="add-product.php">Add New Product</a>
          <a href="all-products.php">All Products</a>
      <?php endif; ?>
      <a href="logout-user.php" style="float:right">Logout</a>

  </nav>