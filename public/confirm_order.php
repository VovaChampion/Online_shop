<?php
require_once('lib/product_class.php');
require_once('lib/order_class.php');
require_once('lib/config.php');
require_once('lib/common.php');

$id = new Order();
$order_id = $id->getLastOrderId();

?>

<?php include "templates/header.php"; ?>

<div class="container">
    <h1> Thank you for your order number: <?php echo $order_id; ?></h1><br>

    <a href="index.php" class="btn btn-primary" onclick="deleteCookie();" role="button">Go shopping</a><br>
</div>

<?php include "templates/footer.php"; ?>