<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');
require_once('lib/order_class.php');

// $product = new Product();
// $rows = $product->getProducts();

// Remove warning msg “set SameSite cookie to none” from Chrome Extension  https://github.com/GoogleChromeLabs/samesite-examples/blob/master/php.md
setcookie('same-site-cookie', 'foo', ['samesite' => 'Lax']);
setcookie('cross-site-cookie', 'bar', ['samesite' => 'None', 'secure' => true]);

?>

<!-- Cookies  -->
<?php
    if (isset($_COOKIE['cart'])) {
        $cart_array = json_decode(stripslashes($_COOKIE['cart']),true);
        // echo '<h4>Cart</h4>';
        var_dump($cart_array);
    }
?>

<?php include "templates/header.php"; ?>

<?php include "checkout.php"; ?>
<?php include "page.php"; ?>
    <!-- <p>* - The product is valid in any direction on the selected line 1 month from the date of purchase.</p> -->
</div>



<?php include "templates/footer.php"; ?>