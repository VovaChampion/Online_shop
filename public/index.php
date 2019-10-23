<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');

$product = new Product();
$rows = $product->getProducts();

// Remove warning msg “set SameSite cookie to none” from Chrome Extension  https://github.com/GoogleChromeLabs/samesite-examples/blob/master/php.md
setcookie('same-site-cookie', 'foo', ['samesite' => 'Lax']);
setcookie('cross-site-cookie', 'bar', ['samesite' => 'None', 'secure' => true]);

?>


<?php include "templates/header.php"; ?>

<!-- Products -->
<section class="container content-section">
        <h2 class="section-header">Products</h2>
        <div class="shop-items">
        <?php foreach ($rows as $row) : ?>
            <div class="shop-item">
                <span class="shop-item-title"><?php echo escape($row["product_name"]); ?></span>
                <span class="shop-item-description"><?php echo escape($row["description"]); ?></span>
                <a href="product_detail.php?id=<?php echo escape($row['id'])?>"> <img class="shop-item-image" style="width:14em; height:15em;" src="<?php echo escape($row["image_path"]); ?>"></a>
                <!-- <a href="product_detail.php?id=1"> <img class="shop-item-image" src="<?php //echo escape($row["image_path"]); ?>"></a> -->
                <div class="shop-item-details">
                    <span class="shop-item-price"><?php echo "SEK " . escape($row["price"]); ?></span>
                    <input class="shop-item-id" type="hidden" name="id" value="<?php echo escape($row['id'])?>">
                    <input class="shop-item-qty" type="hidden" name="qty" value="1">
                    <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
                </div>
            </div>
            <?php endforeach; ?>
    </section>
    <p>* - The product is valid in any direction on the selected line 1 month from the date of purchase.</p>
</div>



<?php include "templates/footer.php"; ?>