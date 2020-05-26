<?php
require_once 'init/init.php';

require "inc/header.php";

$user_data = $user->getSessionData();

if (isset($user_data)) {
    $user_data['access'] != "admin" ? Helper::redirect("index.php") : '';
} else {
    Helper::redirect("login-user.php");
}

require "inc/navigation.php";

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $min_stock = $_POST['min_stock'];

    if (empty($product_name) && empty($product_type)) {
        echo "<p>Fields should not be empty</p>";
    } else if (empty($product_name)) {
        echo "<p>Product Name Should not be empty</p>";
    } else if (empty($product_type)) {
        echo "<p>Product Type Should not be empty</p>";
    } else if (strlen($min_stock) == 0) {
        echo "<p>Minimum stock should not be equals to zero</p>";
    } else {
        if ($products->checkProductExists($product_name)) {
            echo "<p>Product is already existed</p>";
        } else {
            $products->addProduct($product_name, $product_type, $min_stock);
            Helper::redirect("add-product.php");
        }
    }
}

?>

<div class="container">
    <div class="form-container">
        <form action="" method="POST">
            <div class="form-input">
                <label>Product Name</label>
                <input type="text" name="product_name" id="product_name" value="<?= isset($product_name) ? $product_name : '' ?>">
            </div>
            <div class="form-input">
                <label>Product Type</label>
                <select name="product_type" id="product_type">
                    <option value="">---</option>
                    <option value="Food">Food</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Tools">Tools</option>
                </select>
            </div>
            <div class="form-input">
                <label>Minimum Stocks</label>
                <input type="number" name="min_stock" id="min-stock" min="1" value="1">
            </div>
            <div class="form-input">
                <button type="submit" name="add_product">Add Product</button>
            </div>
        </form>
    </div>
</div>


<?php
require "inc/footer.php";
?>