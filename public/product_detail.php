<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');

if(isset($_GET['id']) && is_int($_GET['id'])) {
    header('Location:product_detail.php');
    exit;
}

$product_id = (isset($_GET['id']) ? $_GET['id'] : 0); 

$id = new Product();
$product = $id->selectProduct($product_id);

$images = $id->selectImages($product_id);

//var_dump($images);

?>

<?php include "templates/header.php"; ?>

<!-- Products -->
    <main>
        <section class="product_name">
            <h1><?php echo escape($product["product_name"]); ?></h1>
        </section>
        <section class="ImageViewer">
            <img class="big-image" id="big-display-1">
            <span><i class="material-icons" style="font-size:60px;color:rgb(185, 176, 176)">zoom_in</i></span>
            <div class="small-images" id="smalls">
                <?php foreach ($images as $row) : ?>
                <img src="images/small/<?php echo $row['image_path']?>" data-bigimgsrc="images/<?php echo $row['image_path']?>">
                <?php endforeach; ?>
            </div>
        </section>
        <section id="product_description">
            <table class="description">
                <h3>Description:</h3>
                <!-- <tr>
                    <td>Brand:</td>
                    <td>Panasonic</td>
                </tr>-->
                <tr>
                    <td>Product name:</td>
                    <td><?php echo escape($product["product_name"]); ?></td>
                </tr> 
                <tr>
                    <td>Price:</td>
                    <td><?php echo escape($product["price"]); ?> Kr</td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><?php echo escape($product["description"]); ?></td>
                </tr>
            </table>
        </section>
        <section id="overlay">
            <img class="overlay-image">
            <button id="prevImg" style="font-size:36px"><i class='fas fa-arrow-alt-circle-left'></i></button>
            <button id="nextImg" style="font-size:36px"><i class='fas fa-arrow-alt-circle-right'></i></button>
            <button id="closeImg" style='font-size:36px'><i class='fas fa-times-circle'></i></button>
        </section>
    </main>



<?php include "templates/footer.php"; ?>