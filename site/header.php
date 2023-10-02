

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&amp;family=Montserrat:wght@300;400;500;600;700&amp;family=Playfair+Display:ital@0;1&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <header>
        <nav class="container-large">
            <div class="logo">
                <a href="index.php">
                    <span>Choirs Vineyards</span>
                </a>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="store.php">Store</a>
                    </li>
                    <li>
                        <a href="basket.php">Basket</a>
                    </li>
                    <?php if (isset($_SESSION['u_id'])) { ?>
                        <?php if ($_SESSION['type'] == 'admin') { ?>
                            <li>
                                <a href="admin/index.php">Admin Panel</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="account.php">My Account</a>
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
        </nav>
    </header>