<?php include 'functions.php' ?>
<?php include 'header.php' ?>

<?php

if (isset($_POST['add-to-cart'])) {
    $data = $_POST;
    $id = $_POST["d_id"];
    $quantity = $_POST['quantity'];
    if (add_to_cart($id, $quantity)) {
        $response = [
            'type' => 'success',
            'message' => 'Drink is added to cart successfully!',
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
            'message' => 'Drink is added to cart successfully!',
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
<?php include 'footer.php' ?>