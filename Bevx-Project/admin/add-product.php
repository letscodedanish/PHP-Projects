<?php include "../functions.php"; ?>
<?php include "header.php"; ?>

<?php if (isset($_POST["add-product"])) {
    $data = $_POST;
    $image = $_FILES["image"]["name"];
    $target_dir = "../assets/images/" . basename($image);
    $data["image"] = $image;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) {
        if (add_product($data)) {
            $message = [
                'type' => 'success',
                'message' => 'Drink Uploaded Successfully!'
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
            'message' => 'Some Error Occured, Please Try Again'
        ];
    }
} ?>

<main>
    <div class="banner about">
        <div class="content">
            <h1>Add Drink</h1>
        </div>
    </div>
    <div class="bg-grad">
        <div class="form">
            <?php if (isset($message)) { ?>
                <div class="message <?= $message["type"] ?>">
                    <p><?= $message["message"] ?></p>
                </div>
            <?php } ?>
            <form action="?" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="title">Title</label>
                    <input name="title" type="text" id="title" />
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description"></textarea>
                </div>
                <div>
                    <label for="price">Price</label>
                    <input name="price" type="text" id="price" />
                </div>
                <div>
                    <label for="image">Image</label>
                    <input name="image" type="file" id="image" />
                </div>
                <button name="add-product" type="submit">Add Drink</button>
            </form>
        </div>
    </div>
</main>