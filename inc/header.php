<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Helper::getTitle() ?></title>
    <link href="http://localhost/StoreMgmt/assets/css/main.css" rel="stylesheet">
</head>

<body>

    <nav style="margin-bottom:20px">
        <a href="index.php">Home</a>
        <?php if ($user_data['access'] == 'admin') : ?>
            <a href="add-user.php">Add User</a>
            <a href="add-product.php">Add New Product</a>
            <a href="all-products.php">All Products</a>
        <?php endif; ?>
        <a href="logout-user.php" style="float:right">Logout</a>

    </nav>