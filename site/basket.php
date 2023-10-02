<?php include 'functions.php' ?>
<?php include 'header.php' ?>

<?php

$cart = get_cart();
if (isset($cart)) {
  $drinks = get_drinks_by_ids($cart);
}

?>

<main>
  <div class="internal-header">
    <h1>Basket</h1>
    <?php if (!mysqli_num_rows($drinks)) { ?>
      <p>Basket is empty</p>
    <?php } ?>
  </div>

  <div class="basket">
    <div class="container">
      <?php if (mysqli_num_rows($drinks)) { ?>
        <div class="basket-items">
          <?php foreach ($drinks as $drink) { ?>
            <div class="basket-item">
              <div class="image">
                <img src="assets/images/<?= $drink['image'] ?>" alt="" />
              </div>
              <div class="content">
                <h3><?= $drink['name'] ?></h3>
                <p class="price">£<?= $drink['price'] ?></p>
                <div class="flex quantity">
                  <span class="add" data-item="<?= $drink['d_id'] ?>"> + </span>
                  <span class="number" id="number-<?= $drink['d_id'] ?>"><?= $cart[$drink['d_id']] ?></span>
                  <span class="subtract" data-item="<?= $drink['d_id'] ?>"> - </span>
                </div>
                <div class="add-to-basket">
                  <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="d_id" value="<?= $drink['d_id'] ?>">
                    <input type="hidden" id="item-<?= $drink['d_id'] ?>" name="quantity" value="<?= $cart[$drink['d_id']] ?>">
                    <button class="btn" type="submit" name="update-to-cart">Update</button>
                    <button class="btn btn-danger" name="remove-from-cart">Remove</button>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div style="margin-top: 100px;">
          <a href="checkout.php" class="btn">Total: - <?= get_total() ?>£ Checkout</a>
        </div>
      <?php } ?>
    </div>
  </div>
</main>
<?php include 'footer.php' ?>