<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');
require_once('lib/order_class.php');

if(isset($_GET['id']) && is_int($_GET['id'])) {
    header('Location:product_detail.php');
    exit;
}

$product_id = (isset($_GET['id']) ? $_GET['id'] : 0); 

$id = new Product();
$product = $id->selectProduct($product_id);

$images = $id->selectImages($product_id);
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

<!-- Products -->
    <main>
        <div class="right_column">
            <section class="product_name">
                <h1><?php echo escape($product["product_name"]); ?></h1>
            </section>

            <section id="product_description">
                <table class="description">
                    <h3>Description:</h3>

                    <tr>
                        <td>Product name:</td>
                        <td><?php echo escape($product["product_name"]); ?></td>
                        <!-- <td class="shop-item-title"><?php echo escape($product["product_name"]); ?></td> -->
                    </tr> 
                    <tr>
                        <td>Price:</td>
                        <td><?php echo escape($product["price"]); ?> Kr</td>
                        <!-- <td class="shop-item-price"><?php //echo escape($product["price"]); ?> Kr</td> -->
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><?php echo escape($product["description"]); ?></td>
                    </tr>
                </table>
                <input class="shop-item-id" type="hidden" name="id" value="<?php echo escape($row['id'])?>">
                <input class="shop-item-qty" type="hidden" name="qty" value="1">
                <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
            </section>
        </div>

        <div class="left_column">
            <section class="ImageViewer">
                <img class="big-image" id="big-display-1">
                <!-- <span><i class="material-icons" style="font-size:60px;color:rgb(185, 176, 176)">zoom_in</i></span> -->
                <div class="small-images" id="smalls">
                    <?php foreach ($images as $row) : ?>
                    <img src="images/small/<?php echo $row['image_path']?>" data-bigimgsrc="images/<?php echo $row['image_path']?>">
                    <?php endforeach; ?>
                </div>
            </section>
            
            <section id="overlay">
                <img class="overlay-image">
                <button id="prevImg" style="font-size:36px"><i class='fas fa-arrow-alt-circle-left'></i></button>
                <button id="nextImg" style="font-size:36px"><i class='fas fa-arrow-alt-circle-right'></i></button>
                <button id="closeImg" style='font-size:36px'><i class='fas fa-times-circle'></i></button>
            </section>
        </div>
    </main>
    <script src="js/product_detail.js"></script>
<?php include "templates/footer.php"; ?>