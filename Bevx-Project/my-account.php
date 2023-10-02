<?php include "functions.php"; ?>
<?php include "header.php"; ?>
<?php

if (!isset($_SESSION["u_id"])) {
    header("Location: ./");
}

$orders = get_my_orders($_SESSION["u_id"]);

?>
<main>
    <div class="banner about">
        <div class="content">
            <h1>My Account</h1>
        </div>
    </div>
    <?php if (mysqli_num_rows($orders)) { ?>
        <div class="orders">
            <?php foreach ($orders as $order) { ?>
                <div class="order" style="margin-bottom: 50px;">
                    <p><strong>Order ID: <?= $order["o_id"] ?></strong></p>
                    <p><strong>Total: <?= $order["total"] ?></strong></p>
                    <?php $items = json_decode($order["drinks"], true); ?>
                    <?php $drinks = get_drinks_by_ids($items); ?>
                    <?php foreach ($drinks as $drink) { ?>
                        <div class="grid">
                            <div class="admin-item width-1-3">
                                <img src="<?= get_image_url($drink["image"]) ?>" alt="">
                                <div class="content">
                                    <h3><?= $drink["title"] ?></h3>
                                    <p class="price"><?= DEFAULT_CURRENCY . $drink["price"] ?></p>
                                    <p><?= $items[$drink["d_id"]] ?> Units</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="form">
            <div class="message error">
                <p>No orders made yet.</p>
            </div>
        </div>
    <?php } ?>
</main>
<?php include "footer.php" ?>