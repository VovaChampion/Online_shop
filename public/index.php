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
    <!-- <a href="#top">
        <div class="cart-red" onclick="showCart('shopping_cart');">
            <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
            <span id="itemCount">0</span>
        </div>  
    </a> -->

    <!-- Shopping cart -->
    <!-- <div id="shopping_cart">
        <section class="container content-section">
            <h2 class="section-header">Shopping cart</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">Title</span>
                <span class="cart-price cart-header cart-column">Price</span>
                <span class="cart-quantity cart-header cart-column">Quantity</span>
            </div>
            <div class="cart-items">
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">SEK 0</span>
            </div>
            <button class="btn btn-primary btn-purchase" type="button" onclick="formToggle('my_form');">CheckOut</button>   
        </section>  -->

<!-- Check out -->
        <!-- <form id="my_form" method="post"><br>
            <div class="input-group mb-3">
                <input type="text" name="user_first_name" placeholder="Your First Name" required><br>
                <div class="input-group-prepend">
                    <span class="input-group-text">John</span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" name="user_last_name" placeholder="Your Last Name" required><br>
                <div class="input-group-prepend">
                    <span class="input-group-text">Doe</span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" name="user_email" placeholder="Your Email" required>
                <div class="input-group-append">
                    <span class="input-group-text">doe@gmail.com</span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" name="user_address" placeholder="Your Address" required>
                <div class="input-group-append">
                    <span class="input-group-text">Street 1</span>
                </div>
            </div>
            <button class="btn btn-success" name="create_order" value="Submit">Submit</button>
        </form>
    </div>  -->

<!-- Products -->
<?php include "page.php"; ?>
    <!-- <p>* - The product is valid in any direction on the selected line 1 month from the date of purchase.</p> -->
</div>



<?php include "templates/footer.php"; ?>