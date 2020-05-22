<?php
require_once 'init/init.php';
$user_data = $user->getSessionData();

if (isset($user_data)) {
    $user_data['access'] != "admin" ? Helper::redirect("index.php") : '';
} else {
    Helper::redirect("login-user.php");
}

$products = $products->fetchProducts();
require "inc/header.php";
?>

<div>

    <?php if (!$products) : ?>
        <?= "<p style='text-align:center'>No Products Available</p>"; ?>

    <?php else : ?>
        <table border="1" style="text-align:center;margin:auto">
            <tr>
                <thead>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Minimum Stock</th>
                    <th>View Product</th>
                </thead>
            </tr>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product['product_name']; ?></td>
                    <td><?= $product['product_type']; ?></td>
                    <td><?= $product['min_stock']; ?></td>
                    <td>
                        <a href="http://localhost/StoreMgmt/product-details.php?id=<?= $product['id']; ?>">
                            View
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </table>
</div>


<?php
require "inc/footer.php";
