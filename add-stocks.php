<?php
require_once 'init/init.php';
$user_data = $user->getSessionData();

if (isset($user_data)) {
    $user_data['access'] != "admin" ? Helper::redirect("index.php") : '';
} else {
    Helper::redirect("login-user.php");
}

$id = $_GET['id'];

$product = $products->fetchSingleProduct($id);
require "inc/header.php";

if (isset($_POST['add_stock'])) {
    $vendor_name = $_POST['vendor_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $batch_number = $_POST['batch_number'];
    $product_id = $_POST['product_id'];
    $added_by = $_POST['added_by'];

    $products->addProductStocks($product_id, $quantity, $price, $vendor_name, $batch_number, $added_by);
}
?>


<div class="container">
    <div class="form-container">
        <form action="" method="POST">
            <div class="form-input">
                <label>Vendor Name</label>
                <input type="text" name="vendor_name" id="vendor_name">
            </div>
            <div class="form-input">
                <label>Quantity</label>
                <input type="number" name="quantity" id="quantity">
            </div>
            <div class="form-input">
                <label>Price</label>
                <input type="number" name="price" id="price">
            </div>
            <div class="form-input">
                <label>Batch Number</label>
                <input type="text" name="batch_number" id="batch_number" value="<?= uniqid("BN#"); ?>">
            </div>

            <input type="hidden" name="product_id" value="<?= $id; ?>">
            <input type="hidden" name="added_by" value="<?= $user_data['full_name']; ?>">
            <button type="submit" name="add_stock">Add Stock</button>
        </form>
    </div>
</div>


<?php
require "inc/footer.php";
?>