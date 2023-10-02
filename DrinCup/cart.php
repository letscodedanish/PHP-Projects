<?php include 'functions.php' ?>


<?php

$cart = get_cart();
if (isset($cart)) {
  $drinks = get_drinks_by_ids($cart);
}

?>

<!DOCTYPE html>
<html>
    
    <head>
        <!-- Title of the home page -->
        <title>DrinCup: One stop to order any drink</title>
        <!-- Favicon-->
        <link rel="icon" href="icons/micon.ico" type="image/x-icon">
        <!-- CSS -->
        <link rel="stylesheet" href="style.css">
	<!-- icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- JavaScript -->
        <script src="script.js"></script>
        <!-- Meta display-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Meta description -->
        <meta name="description" content="Drinkup is a website where you can order desired drink.">
    </head>
    <body>
        <!-- div for navbar with logo and links-->
        <div class="navbar">
            <img src="images/mlogo.png" class="logo">
            <?php 
						if(isset($_SESSION['u_id'])){?>
								<a href="logout.php">Logout </a>
							<?php }else{ ?>
								<a href="login.php">Login </a>
					  <?php } ?>
            <a href="cart.php">Cart</a>
            <a href="menu.php">Menu</a>
            <a href="index.php">Home</a>
 	    
        </div>

<main>
  <div class="internal-header">
    <h1>Basket</h1>
    <?php if (!mysqli_num_rows($drinks)) { ?>
      <p>Cart is empty</p>
    <?php } ?>
  </div>

  <div class="basket">
    <div class="container">
      <?php if (mysqli_num_rows($drinks)) { ?>
        <div class="basket-items">
          <?php foreach ($drinks as $drink) { ?>
            <div class="basket-item">
              <div class="image">
                
              </div>
              <div class="content">
                <h3><?= $drink['name'] ?></h3>
                <p class="price">£<?= $drink['price'] ?></p>
                
                
                  <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="d_id" value="<?= $drink['d_id'] ?>">
                    <input type="hidden" id="item-<?= $drink['d_id'] ?>" name="quantity" value="<?= $cart[$drink['d_id']] ?>">
                    <button class="btn" type="submit" name="update-to-cart">Update</button>
                    <button class="btn btn-danger" name="remove-from-cart">Remove</button>
                  </form>
                
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