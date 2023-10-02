<?php include "functions.php"; ?>
<?php include "header.php"; ?>

<?php

$drinks = get_drinks();

?>

<main>
  <div class="banner">
    <h1>
      Have your best <br />
      moments with Bev X
    </h1>
  </div>

  <div class="featured-products bg-light">
    <div class="heading">
      <h2>Featured Products</h2>
    </div>
    <div class="grid">
      <div class="width-1-2">
        <div class="featured">
          <figure>
            <img src="assets/images/featured-1.jpg" alt="" />
          </figure>
          <div class="content">
            <p>Non Alcoholic Drinks</p>
          </div>
        </div>
      </div>
      <div class="width-1-2">
        <div class="featured">
          <figure>
            <img src="assets/images/featured-2.jpg" alt="" />
          </figure>
          <div class="content">
            <p>Alcoholic Drinks</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="shop">
    <div class="heading">
      <h2>Top Sellers</h2>
    </div>
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