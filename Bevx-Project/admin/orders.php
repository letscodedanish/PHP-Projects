<?php include "../functions.php"; ?>
<?php include "header.php"; ?>
<?php

$orders = get_orders();

?>
<main>
    <div class="banner about">
        <div class="content">
            <h1>Admin Panel</h1>
        </div>
    </div>
    <div class="admin">
        <?php if (mysqli_num_rows($orders)) { ?>
            <div class="admin-row">
                <?php foreach ($orders as $order) { ?>
                    <div style="margin-bottom: 50px;">
                        <p><strong>Order ID: <?= $order["o_id"] ?></strong></p>
                        <p><strong>Total: <?= $order["total"] ?></strong></p>
                        <p><strong>First Name: <?= $order["first_name"] ?></strong></p>
                        <p><strong>Last Name: <?= $order["last_name"] ?></strong></p>
                        <p><strong>Email: <?= $order["email"] ?></strong></p>
                        <p><strong>Products: </strong></p>
                        <?php $drinks = get_drinks_by_ids(json_decode($order["drinks"], true)); ?>
                        <?php foreach ($drinks as $drink) { ?>
                            <div class="grid">
                                <div class="admin-item width-1-3">
                                    <img src="<?= get_image_url($drink["image"]) ?>" alt="">
                                    <div class="content">
                                        <h3><?= $drink["title"] ?></h3>
                                        <p class="price"><?= DEFAULT_CURRENCY . $drink["price"] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</main>