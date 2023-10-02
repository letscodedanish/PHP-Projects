<?php include 'functions.php' ?>


<?php

$drinks = get_drinks();

?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Title of the home page -->
        <title>DrinCup:One stop to order alcohol or non-alcohol drinks</title>
        <!-- Favicon-->
        <link rel="icon" href="icons/micon.ico" type="image/x-icon">
        <!-- CSS -->
        <link rel="stylesheet" href="style.css">
        <!-- JavaScript -->
        <script src="script.js"></script>
        <!-- Meta display-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Meta description -->
        <meta name="description" content="Drinkup is a website where you can order desired drink.">
    </head>

    <body>
        <!-- div for navbar with logo, search bar and links-->
        <div class="navbar">
            <img src="images/mlogo.png" alt="logo" class="logo">
                    <?php 
						if(isset($_SESSION['u_id'])){?>
								<a href="logout.php">Logout </a>
							<?php }else{ ?>
								<a href="login.php">Login </a>
					<?php } ?>
            <a href="cart.php">Cart</a>
            <a href="menu.php">Menu</a>
            <a href="index.php">Home</a>
        <!--contains search bar in navbar-->
 	    
        </div>

	        <!--div that contains an image and some text with a button-->
        <div class="content">
            <img src="images/banner.png" class="banner">
           <div class="centered">
            <h2>One stop to order alcohol or non-alcohol drinks</h2>
            <button class="button"><a href="menu.php">Order Now</a></button>
           </div>
            
        </div>

<!-- div for a bar to display exclusive offers-->
        

        <!-- a div that contains the images of muliple drinks in tiles-->
        <?php if (mysqli_num_rows($drinks)) { ?>
        <div class="menu">
        <?php foreach ($drinks as $drink) { ?>
            <div class="tile">
                <img src="images/<?= $drink['image'] ?>" class="banner">
                <h2><?= $drink['name'] ?></h2>
                <p class="price">£<?= $drink['price'] ?></p>
                <p>About drink.</p>
                <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="d_id" value="<?= $drink['d_id'] ?>">
                    <input type="hidden" id="item-<?= $drink['d_id'] ?>" name="quantity" value="1">
                    <button type="submit" name="add-to-cart" class="btn">Add To Basket</button>
                </form>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
	<div class="loadmore">
            <button class="button"><a href="menu.html">Load more ...</a></button>
           </div>

        <!--footer-->
        <div class="footer"> 	
            <p>© 2022 Drinkup. All rights reserved.</p>
        </div>
    </body>

</html>