<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');

    try {
    
    $db = new Db();
    $con=$db->connect();
    
    // Find out how many items are in the table
    $total = $con->query('SELECT COUNT(*) FROM products')->fetchColumn();

    // How many items to list per page
    $limit = 3;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // // Display the paging information
    // echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    // Prepare the paged query
    $stmt = $con->prepare('SELECT * FROM products ORDER BY product_name LIMIT :limit OFFSET :offset');

    // Bind the query params
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

        // Do we have any results?
        if ($stmt->rowCount() > 0) {
        // Define how we want to fetch the results
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);

        $product = new Product();
        $rows = $product->getProducts();
?>
    <!-- Products -->
    <section class="container content-section">
        <h2 class="section-header">Products</h2>
        <div class="shop-items">
        <? foreach ($iterator as $row) { ?>
            <div class="shop-item">
                <span class="shop-item-title"><?php echo escape($row["product_name"]); ?></span>
                <!-- <span class="shop-item-description"><?php //echo escape($row["description"]); ?></span> -->
                <a href="product_detail.php?id=<?php echo escape($row['id'])?>"> <img class="shop-item-image" style="width:14em; height:15em;" src="<?php echo escape($row["image_path"]); ?>"></a>
                <div class="shop-item-details">
                    <span class="shop-item-price"><?php echo "SEK " . escape($row["price"]); ?></span>
                    <input class="shop-item-id" type="hidden" name="id" value="<?php echo escape($row['id'])?>">
                    <input class="shop-item-qty" type="hidden" name="qty" value="1">
                    <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
                </div>
            </div> <?php
        }
        ?>
        <?php
            } else {
                echo '<p>No results could be displayed.</p>';
            }
            } catch (Exception $e) {
                echo '<p>', $e->getMessage(), '</p>';
            }
        ?>
    </section>

    <div class="num_pages">
        <?php 
        // Display the paging information
        echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';?>
    </div>