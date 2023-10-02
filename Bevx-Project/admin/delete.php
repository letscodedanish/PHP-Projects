<?php include "../functions.php"; ?>
<?php include "header.php"; ?>

<?php 

$id = $_GET["d_id"];
$delete = delete_product($id);

if ($delete) {
    $message = [
        'type' => 'success',
        'message' => 'Drink Deleted Successfully!'
    ];
} else {
    $message = [
        'type' => 'error',
        'message' => 'Could not delete drink!'
    ];
}

?>

<main>
    <div class="banner about">
        <div class="content">
            <h1><?= $message["message"] ?></h1>
        </div>
    </div>
</main>