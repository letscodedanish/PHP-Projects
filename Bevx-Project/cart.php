<?php include "functions.php"; ?>
<?php include "header.php"; ?>

<?php

if (isset($_GET["action"])) {
  $id = $_GET["id"];
  $action = $_GET["action"];
  $quantity = $_GET["quantity"] ?? false;
  if ($action == "add") {
    if (add_to_cart($id, $quantity)) {
      $message = [
        'type' => 'success',
        'message' => 'Drink is added to cart successfully!',
      ];
    } else {
      $message = [
        'type' => 'success',
        'message' => 'Some Error Occured, Please try again!',
      ];
    }
  } else if ($action == "remove") {
    if (remove_from_cart($id)) {
      $message = [
        'type' => 'success',
        'message' => 'Drink is removed from cart',
      ];
    } else {
      $message = [
        'type' => 'error',
        'message' => 'Some Error Occured, Please try again!',
      ];
    }
  }
  header("Location: " . remove_query_params());
}

$cart = get_cart();
if (isset($cart)) {
  $drinks = get_drinks_by_ids($cart);
}
?>

<main>
  <?php if (mysqli_num_rows($drinks)) { ?>
    <div class="banner about">
      <div class="content">
        <h1>Cart</h1>
      </div>
    </div>
    <div class="cart">
      <?php if (isset($message)) { ?>
        <div class="message <?= $message["type"] ?>">
          <p><?= $message["message"] ?></p>
        </div>
      <?php } ?>
      <?php foreach ($drinks as $drink) { ?>
        <div class="cart-item">
          <img src="<?= get_image_url($drink["image"]) ?>" alt="" />
          <div class="content">
            <div class="title">
              <h3><?= $drink["title"] ?></h3>
              <p class="desc">
                <?= $drink["description"] ?>
              </p>
            </div>
            <p class="price"><?= DEFAULT_CURRENCY . $drink["price"] ?></p>
            <p class="quantity"><?= $cart[$drink["d_id"]] ?> Units</p>
            <p class="close"><a href="cart.php?id=<?= $drink["d_id"] ?>&action=remove">&times;</a></p>
          </div>
        </div>
      <?php } ?>
      <div class="buttons">
        <a href="checkout.php">Checkout: <?= DEFAULT_CURRENCY . get_cart_total() ?></a>
      </div>
    <?php } else { ?>
      <div class="banner about">
        <div class="content">
          <h1>No drinks in your cart</h1>
        </div>
      </div>
    <?php } ?>
    </div>
</main>
<?php include "footer.php" ?>