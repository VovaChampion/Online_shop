<?php
require_once('lib/config.php');
require_once('lib/common.php');

?>

<?php include "templates/header.php"; ?>

<!-- Products -->
    <main>
        <section class="product_name">
            <h1>Panasonic Lumix DC-GH5</h1>
        </section>
        <section class="ImageViewer">
            <img class="big-image" id="big-display-1">
            <span><i class="material-icons" style="font-size:60px;color:rgb(185, 176, 176)">zoom_in</i></span>
            <div class="small-images" id="smalls">
                <img src="images/imgs/photo_1_small.jpg" data-bigimgsrc="images/imgs/photo_1.jpg">
                <img src="images/imgs/photo_2_small.jpg" data-bigimgsrc="images/imgs/photo_2.jpg">
                <img src="images/imgs/photo_3_small.jpg" data-bigimgsrc="images/imgs/photo_3.jpg">
                <img src="images/imgs/photo_4_small.jpg" data-bigimgsrc="images/imgs/photo_4.jpg">
                <img src="images/imgs/photo_6_small.jpg" data-bigimgsrc="images/imgs/photo_6.jpg">
                <img src="images/imgs/photo_7_small.jpg" data-bigimgsrc="images/imgs/photo_7.jpg">
            </div>
        </section>
        <section id="product_description">
            <table class="description">
                <h3>Description:</h3>
                <tr>
                    <td>Brand:</td>
                    <td>Panasonic</td>
                </tr>
                <tr>
                    <td>Groups:</td>
                    <td>Systemkamera</td>
                </tr>
                <tr>
                    <td>Article:</td>
                    <td>12345678</td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>$2500</td>
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