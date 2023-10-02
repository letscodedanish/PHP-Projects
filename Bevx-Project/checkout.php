<?php include "functions.php"; ?>
<?php include "header.php"; ?>
<?php

if (!isset($_SESSION["u_id"])) {
}

$cart = get_cart();
if (empty($cart)) {
  header("Location: cart.php");
}

if (isset($_POST["checkout"])) {
  $checkout = $_POST;
  if (empty($cart)) {
    return;
  }
  $checkout["total"] = get_cart_total();
  $checkout["drinks"] = json_encode($cart, true);
  $message = [];
  if (!checkout($checkout)) {
    $message = [
      'type' => 'error',
      'message' => 'Checkout Failed!'
    ];
  } else {
    $message = [
      'type' => 'success',
      'message' => 'Checkout Successful!'
    ];
    empty_cart();
  }

  unset($_POST);
}

?>
<main>
  <?php if (!isset($_POST["checkout"])) { ?>
    <div class="banner about">
      <div class="content">
        <h1>Checkout</h1>
      </div>
    </div>
    <div class="bg-grad">
      <div class="form">
        <?php if (isset($message)) { ?>
          <div class="message <?= $message["type"] ?>">
            <p><?= $message["message"] ?></p>
          </div>
        <?php } ?>
        <form action="?" method="POST">
          <div>
            <label for="email">Email Address</label>
            <input type="email" id="email" value="<?= $_SESSION["email"] ?>" />
          </div>
          <div>
            <label for="card">Credit Card</label>
            <input type="number" pattern="\d*" id="card" maxlength="16" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
          </div>
          <div>
            <label for="expiry">Expiry</label>
            <input type="date" id="expiry" />
          </div>
          <div>
            <label for="cvv">CVV</label>
            <input type="number" pattern="\d*" id="cvv" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
          </div>
          <button name="checkout" type="submit">Checkout</button>
        </form>
      </div>
    </div>
  <?php } else { ?>
    <div class="banner about">
      <div class="content">
        <h1><?= $message["message"] ?></h1>
      </div>
    </div>
  <?php } ?>
</main>
<?php include "footer.php" ?>