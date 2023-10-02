
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet"  href="styles/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css" />
	<style>
		.logotext{
			color: black;
		}
		a{
			color: black;
		}
		#email{
			height: 30px;
			position: relative;
			top: 0px;
			left: 0px;
			

		}
	</style>
</head>
<body>

	

		<div class="container">
			<div class="logotext">
				<h1>CUPPERS</h1>
				
			</div>

			<div class="navbar">
				<nav>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="cart.php">Cart</a></li>
						<li><a href="Alcoholic.php">Alcoholic</a></li>
						<?php 
						if(isset($_SESSION['u_id'])){?>
								<li><a href="logout.php">Logout </a></li>
							<?php }else{ ?>
								<li><a href="login.php">Login </a></li>
								<li><a href="register.php">Register </a></li>
					<?php } ?>

						
					</ul>
					
				</nav>	
			</div>

			
			

			 
		</div>
		
	</div>

