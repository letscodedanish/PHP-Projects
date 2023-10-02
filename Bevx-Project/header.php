<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bev X</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <header>
        <nav>
            <div class="up">
                <div class="menu">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="why.php">Why Bev X</a>
                        </li>
                        <li>
                            <a href="store.php">Store</a>
                        </li>
                        <?php if (isset($_SESSION["u_id"])) { ?>
                            <?php if ($_SESSION["is_admin"] == "1") { ?>
                                <li>
                                    <a href="admin">Admin Panel</a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="my-account.php">My Account</a>
                            </li>
                            <li>
                                <a href="logout.php">Logout</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="login.php">Login</a>
                            </li>
                            <li>
                                <a href="signup.php">Signup</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="down bg-dark">
                <div class="logo">
                    <h2><a href="index.php">Bev X</a></h2>
                </div>
                <div class="cart-icon">
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
        </nav>
    </header>