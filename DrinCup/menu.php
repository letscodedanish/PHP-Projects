<?php include 'functions.php' ?>


<?php

$drinks = get_drinks();

?>

<!--Menu page to order multiple drinks-->
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
       
        <!-- a div that contains the images of muliple drinks in tiles-->
        <?php if (mysqli_num_rows($drinks)) { ?>
        <div class="menu">
        <?php foreach ($drinks as $drink) { ?>
            <div class="tile">
                <img src="images/<?= $drink['image'] ?>" class="banner">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
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
            <button class="button"><a href="menu.php">Load more ...</a></button>
           </div>

         <!--footer-->
        <div class="footer"> 
	<!-- div for a bar to display exclusive offers-->

	<marquee behavior="scroll" direction="left" scrollamount="10">
            <p>Exclusive offers: 25% off on first order, 10% off on all drinks             
                <!--space between these two lines-->
                &emsp; &emsp;                                
                **Terms and conditions apply**
            </p>
        </marquee>
	
            <p>© 2022 Drinkup. All rights reserved.</p>
        </div>
    </body>
</html>



