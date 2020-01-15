<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');
require_once('lib/order_class.php');

?>

<?php

$products = new Product();
$rows = $products->getProducts();

// $msg = NULL;

// Create an order
if(isset($_POST['stripeToken'])) 
{
    $user_first_name = filter_input(INPUT_POST, 'user_first_name', FILTER_SANITIZE_MAGIC_QUOTES);
    $user_last_name = filter_input(INPUT_POST, 'user_last_name', FILTER_SANITIZE_MAGIC_QUOTES);
    $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
    $user_address = filter_input(INPUT_POST, 'user_address', FILTER_SANITIZE_MAGIC_QUOTES);
    $total_amount = filter_input(INPUT_POST, 'total_amount', FILTER_SANITIZE_NUMBER_INT);
    
    foreach($cart_array as $key => $value) 
    {
        $product_id = (int)$value['id'];
        $my_array [] = $product_id;
    }
    // var_dump($my_array);
    // var_dump($total_amount);
    // die;

    $stmt = new Order();
    $result = $stmt->sendStripe($user_first_name,$user_last_name,$user_email,$user_address,$my_array,$total_amount);
}   

?>

<!-- Shopping cart -->
<div id="shopping_cart">
    <section class="container content-section">
        <h2 class="section-header">Shopping cart</h2>
        <div class="cart-row">
            <span class="cart-item cart-header cart-column">Title</span>
            <span class="cart-price cart-header cart-column">Price</span>
            <span class="cart-quantity cart-header cart-column">Quantity</span>
        </div>

        <div class="cart-items"></div>

        <div class="cart-total">
            <strong class="cart-total-title">Total</strong>
            <span class="cart-total-price">SEK 0</span>
        </div>
        <button class="btn btn-primary btn-purchase" type="button" onclick="formToggle('payment-form');">CheckOut</button>   
    

    <!-- Check out -->
        <form id="payment-form" method="post"><br>
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

            <!-- Total amount  -->

            <div class="input-group mb-3">
                <input type="number" name="total_amount" value="100" required>
            </div>

            <!-- <div id="totalPrice">
                <input type="number" name="total_amount"> -->
            <!-- <div hidden class="cart-total"> -->
                <!-- <strong class="cart-total-title">Total</strong> -->
                <!-- <span class="cart-total-price">SEK 0</span> -->
            <!-- </div> -->

            <label for="card-element">Credit or debit card</label>
                <div id="card-element">
                <!-- a Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors -->
                <div id="card-errors"></div>
            <button class="btn btn-success" name="create_order" value="Submit">Submit</button>
            
        </form>
    </section> 
</div> 

<script src="https://js.stripe.com/v3/"></script>
<script src="js/charge.js"></script>