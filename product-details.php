<?php
require_once 'init/init.php';

require "inc/header.php";

$user_data = $user->getSessionData();

if (isset($user_data)) {
    $user_data['access'] != "admin" ? Helper::redirect("index.php") : '';
} else {
    Helper::redirect("login-user.php");
}

$id = $_GET['id'];

$product = $products->fetchSingleProduct($id);
$product_stocks = $products->fetchProductStocks($product['id']);
$inventoryArr = [];

require "inc/navigation.php";

?>
<h1>Product Details</h1>
<div>
    <a href="all-products.php">Back</a>
    <a href="add-stocks.php?id=<?= $id; ?>">Add Stocks</a>
</div>
<div>
    <p><b>Name:</b>&nbsp;<?= $product['product_name']; ?></p>
    <p><b>Type:</b>&nbsp;<?= $product['product_type']; ?></p>
    <p><b>Minimum Stocks:</b>&nbsp;<?= $product['min_stock']; ?></p>

</div>


<?php if (!$product_stocks) : ?>
    <div>
        <span style="border: 1px solid black; padding:5px;">
            No Stocks Details Available
        </span>
    </div>
<?php else : ?>
    <hr>
    <h1>Product Items Details</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Base Stock Qty</th>
                <th>SRP</th>
                <th>Sales Qty</th>
                <th>Total Sales</th>
                <th>Qty Remaining</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($product_stocks)) : ?>
                <?php foreach ($product_stocks as $stock) : ?>
                    <?php
                    // Quantity remaining computation
                    $sum = $stock['quantity'] - $stock['sales_qty'];
                    $inventoryArr[] = $sum;
                    ?>
                    <tr class="<?= ($sum == 0) ? 'disabledbtn' : ''; ?>">
                        <td><?= $stock['quantity']; ?></td>
                        <td><?= sprintf('%01.2f', $stock['price']); ?></td>
                        <td><?= $stock['sales_qty']; ?></td>
                        <td><?= sprintf('%01.2f', $stock['sales_total']); ?></td>
                        <td><?= $sum; ?></td>
                        <td>
                            <?= ($sum == 0) ? 'Out of stock' : 'Available'; ?>
                        </td>
                        <td>
                            <div id="parent_<?= $stock['id']; ?>">
                                <?= $stock['vendor_name']; ?>
                                <?= $stock['quantity']; ?>
                                <input type="number" name="qty[]" min="1" max="<?= $sum; ?>" value="1">
                                <input type="hidden" name="price[]" value="<?= $stock['price']; ?>">
                                <input type="hidden" name="stocks_id[]" value="<?= $stock['id']; ?>">
                                <button type="button" class="add_cart">Add Cart</button>
                                <button type="button" class="remove_cart" id="<?= $stock['id'] ?>" disabled>Remove Cart</button>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p><b>Total Inventory:</b>&nbsp;<?= $product['quantity_total']; ?></b></p>
    <p><b>Actual Inventory:</b>&nbsp;<?= array_sum($inventoryArr); ?></b></p>
    <p><b>Status:</b>
        <?php
        if (array_sum($inventoryArr) <= $product['min_stock'] && array_sum($inventoryArr) != 0) {
            echo "Low Inventory";
        } else if (array_sum($inventoryArr) == 0) {
            echo "Out of Stock";
        } else {
            echo "Available";
        }

        ?>
    </p>
    <hr>
    <h1>Cart</h1>
    <form action="checkout.php" method="post" id="checkOutForm">
        <input type="hidden" name="customer_name" value="<?= $user_data['full_name']; ?>">
        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
        <button type="submit" id="checkOutBtn" disabled="false">Proceed To Checkout</button>
    </form>
<?php endif; ?>

<?php require "inc/footer.php"; ?>