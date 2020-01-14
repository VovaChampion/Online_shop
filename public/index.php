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

<!-- Create an order -->
<?php
// if(isset($_POST['create_order'])) 
// {
//     $user_first_name = filter_input(INPUT_POST, 'user_first_name', FILTER_SANITIZE_MAGIC_QUOTES);
//     $user_last_name = filter_input(INPUT_POST, 'user_last_name', FILTER_SANITIZE_MAGIC_QUOTES);
//     $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
//     $user_address = filter_input(INPUT_POST, 'user_address', FILTER_SANITIZE_MAGIC_QUOTES);
    
//     foreach($cart_array as $key => $value) 
//     {
//         $product_id = (int)$value['id'];
//         $my_array [] = $product_id;
//     }
//     var_dump($my_array);

//     $stmt = new Order();
//     $result = $stmt->createOrder($user_first_name,$user_last_name,$user_email,$user_address,$my_array);
// }   

?>


<?php include "templates/header.php"; ?>

<!-- MARK shopping cart on the top -->
<?php include "checkout.php"; ?>

<!-- Products -->
<?php include "page.php"; ?>
    <!-- <p>* - The product is valid in any direction on the selected line 1 month from the date of purchase.</p> -->
</div>



<?php include "templates/footer.php"; ?>