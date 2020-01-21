<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');
require_once('lib/order_class.php');

// Remove warning msg “set SameSite cookie to none” from Chrome Extension  https://github.com/GoogleChromeLabs/samesite-examples/blob/master/php.md
setcookie('same-site-cookie', 'foo', ['samesite' => 'Lax']);
setcookie('cross-site-cookie', 'bar', ['samesite' => 'None', 'secure' => true]);

?>

<!-- Cookies  -->
<?php
    if (isset($_COOKIE['cart'])) {
        $cart_array = json_decode(stripslashes($_COOKIE['cart']),true);
    }
?>

<?php include "templates/header.php"; ?>

<?php include "checkout.php"; ?>
<?php include "page.php"; ?>



<?php include "templates/footer.php"; ?>