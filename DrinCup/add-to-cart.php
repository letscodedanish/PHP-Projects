<?php include 'functions.php' ?>

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

        <style>
           .navbar{
            background-color: white;
           }
           .navbar a{
            color: black
           }
        </style>
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


<?php

if (isset($_POST['add-to-cart'])) {
    $data = $_POST;
    $id = $_POST["d_id"];
    $quantity = $_POST['quantity'];
    if (add_to_cart($id, $quantity)) {
        $response = [
            'type' => 'success',
            'message' => 'Drink is added successfully!',
        ];
    } else {
        $response = [
            'type' => 'success',
            'message' => 'Some Error Occured, Please try again!',
        ];
    }
} else if (isset($_POST['update-to-cart'])) {
    $data = $_POST;
    $id = $_POST["d_id"];
    $quantity = $_POST['quantity'];
    if (update_to_cart($id, $quantity)) {
        $response = [
            'type' => 'success',
            'message' => 'Drink is added successfully!',
        ];
    } else {
        $response = [
            'type' => 'success',
            'message' => 'Some Error Occured, Please try again!',
        ];
    }
} else if (isset($_POST['remove-from-cart'])) {
    $id = $_POST["d_id"];
    if (remove_from_cart($id)) {
        $response = [
          'type' => 'success',
          'message' => 'Drink is removed from cart',
        ];
      } else {
        $response = [
          'type' => 'error',
          'message' => 'Some Error Occured, Please try again!',
        ];
      }
}

?>

<main>
    <div class="internal-header">
        <h1><?= $response['message'] ?></h1>
    </div>
</main>