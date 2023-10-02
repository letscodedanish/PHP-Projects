<?php include 'functions.php' ?>


<?php

if (isset($_POST['login'])) {
  $data = $_POST;
  $user = login($data);
  if (!$user) {
    $response = [
      'type' => 'error',
      'message' => 'Login Failed!'
    ];
  } else {
    header("Location: index.php");
  }
}

?>

<!--Login Page with a form to enter username and password-->
<html>
     <head>
        <!-- Title of the home page -->
        <title>DrinCup: Login</title>
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
        <!-- div for navbar with logo and links-->
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
        </div>       
       
        <!--div that contains a form to enter username and password-->
        <div class="login">
        <?php if (isset($response)) { ?>
          <div class="message-box <?= $response['type'] ?>">
            <p><?= $response['message'] ?></p>
          </div>
        <?php } ?>
            <form action="?" method="post">
                <h1>Log In</h1>
                <input type="text" name="email" placeholder="Enter Email">
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" name="login" value="Log In">
                <a href="signup.php">Don't have an account? signup</a>
            </form>
        </div>

        <!--footer-->
        <div class="footer">
 	<marquee behavior="scroll" direction="left" scrollamount="10">
            <p>Exclusive offers: 25% off on first order, 10% off on all drinks             
                <!--space between these two lines-->
                &emsp; &emsp;                                
                Terms and conditions apply**
            </p>
        </marquee>
            <p>© 2022 Drinkup. All rights reserved.</p>
        </div>
</html>