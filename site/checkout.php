<?php include 'functions.php' ?>
<?php include 'header.php' ?>

<?php
if (!isset($_SESSION['u_id'])) {
    header('Location: ./index.php');
}
if (isset($_POST['checkout'])) {
    $checkout = $_POST;
    $cart = get_cart();
    if (!empty($cart)) {
        $checkout['u_id'] = $_SESSION["u_id"];
        $checkout["total"] = get_total();
        $checkout["drinks"] = json_encode($cart, true);
        $checkout = checkout($checkout);
        if (!$checkout) {
            $response = [
                'type' => 'error',
                'message' => 'Checkout Failed!'
            ];
        } else {
            $response = [
                'type' => 'success',
                'message' => 'Checkout Successful',
            ];
            empty_cart();
        }
    } else {
        header('Location: ./index.php');
    }
}

?>

<main>
    <div class="internal-header">
        <h1>Checkout</h1>
    </div>

    <div class="checkout">
        <div class="container">
            <div class="form">
                <?php if (isset($response)) { ?>
                    <div class="message-box <?= $response['type'] ?>">
                        <p><?= $response['message'] ?></p>
                    </div>
                <?php } ?>
                <form action="?" method="POST">
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" placeholder="Enter First Name" required value="<?= $_SESSION['fname'] ?>" />
                    </div>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" placeholder="Enter Last Name" required value="<?= $_SESSION['lname'] ?>" />
                    </div>
                    <div>
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email Address" required value="<?= $_SESSION['email'] ?>" />
                    </div>
                    <div>
                        <label for="card">Card Number</label>
                        <input type="number" id="card" placeholder="Enter Card Number" required />
                    </div>
                    <div>
                        <label for="cvv">CVV</label>
                        <input type="number" id="cvv" placeholder="Enter CVV" required />
                    </div>
                    <div>
                        <label for="expiry">Exipry</label>
                        <input type="month" id="expiry" required />
                    </div>
                    <button type="submit" name="checkout" class="btn">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>