<?php include "functions.php"; ?>
<?php include "header.php"; ?>

<?php

$drinks = get_drinks();

?>
<main>
  <div class="banner about">
    <div class="content">
      <h1>Store</h1>
    </div>
  </div>

  <div class="shop">
    <?php if (mysqli_num_rows($drinks)) { ?>
      <div class="grid">
        <?php foreach ($drinks as $drink) { ?>
          <div class="width-1-3">
            <div class="shop-item">
              <figure>
                <img src="<?= get_image_url($drink["image"]) ?>" />
              </figure>
              <div class="content">
                <h3><?= $drink["title"] ?></h3>
                <p><?= DEFAULT_CURRENCY . $drink["price"] ?></p>
                <p>
                <form action="cart.php" method="GET">
                  <input type="hidden" name="id" value="<?= $drink["d_id"] ?>">
                  <input type="hidden" name="action" value="add">
                  <input type="number" name="quantity" value="1" required>
                  <button type="submit" class="add-to-cart">Add to cart</button>
                </form>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</main>
<?php include "footer.php" ?>