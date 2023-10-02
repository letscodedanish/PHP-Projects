<?php include "../functions.php"; ?>
<?php include "header.php"; ?>

<?php if (isset($_POST["edit-product"])) {
    $data = $_POST;
    $image = $_FILES["image"]["name"];
    $target_dir = "../assets/images/" . basename($image);
    $data["image"] = $image;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) {
        if (edit_product($data)) {
            $message = [
                'type' => 'success',
                'message' => 'Drink Updated Successfully!'
            ];
        } else {
            $message = [
                'type' => 'error',
                'message' => 'Some Error Occured'
            ];
        }
    } else {
        $message = [
            'type' => 'error',
            'message' => "Some Error Occured, Please Try Again"
        ];
    }
} ?>

<?php

$id = $_GET["d_id"];
$drink = get_drink($id);

?>

<main>
    <div class="banner about">
        <div class="content">
            <h1>Edit Drink</h1>
        </div>
    </div>
    <div class="bg-grad">
        <div class="form">
            <?php if (isset($message)) { ?>
                <div class="message <?= $message["type"] ?>">
                    <p><?= $message["message"] ?></p>
                </div>
            <?php } ?>
            <?php if (mysqli_num_rows($drink)) { ?>
                <?php foreach ($drink as $item) { ?>
                    <form action="?d_id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="d_id" value="<?= $id ?>">
                        <div>
                            <label for="title">Title</label>
                            <input name="title" type="text" id="title" value="<?= $item["title"] ?>" />
                        </div>
                        <div>
                            <label for="description">Description</label>
                            <textarea name="description" id="description"><?= $item["description"] ?></textarea>
                        </div>
                        <div>
                            <label for="price">Price</label>
                            <input name="price" type="text" id="price" value="<?= $item["price"] ?>" />
                        </div>
                        <div>
                            <label for="image">Image</label>
                            <input name="image" type="file" id="image" required />
                        </div>
                        <button name="edit-product" type="submit">Edit Drink</button>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</main>