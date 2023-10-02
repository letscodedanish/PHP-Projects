<?php include "../functions.php"; ?>
<?php include "header.php"; ?>
<?php

$drinks = get_drinks();

?>
<main>
    <div class="banner about">
        <div class="content">
            <h1>Admin Panel</h1>
        </div>
    </div>
    <div class="admin">
        <?php if (mysqli_num_rows($drinks)) { ?>
            <div class="admin-row">
                <?php foreach ($drinks as $drink) { ?>
                    <div class="admin-item">
                        <img src="<?= get_image_url($drink["image"]) ?>" alt="">
                        <div class="content">
                            <h3><?= $drink["title"] ?></h3>
                            <p class="price"><?= DEFAULT_CURRENCY . $drink["price"] ?></p>
                            <p>
                                <a href="/admin/edit-product.php?d_id=<?= $drink["d_id"] ?>" class="edit">Edit</a>
                                <a href="/admin/delete.php?d_id=<?= $drink["d_id"] ?>" class="delete">Delete</a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</main>