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
    <div class="confirm-order">
        <h1> Thank you for your order number: <?php echo $order_id; ?></h1>
        <a href="home" class="btn btn-primary" onclick="deleteCookie();" role="button">Go shopping</a>
    </div>
</div>

<?php include "templates/footer.php"; ?>