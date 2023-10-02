<?php include 'functions.php' ?>
<?php include 'header.php' ?>

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

<main>
  <div class="internal-header">
    <h1>Login</h1>
  </div>

  <div class="login">
    <div class="container">
      <div class="form">
        <?php if (isset($response)) { ?>
          <div class="message-box <?= $response['type'] ?>">
            <p><?= $response['message'] ?></p>
          </div>
        <?php } ?>
        <form action="?" method="POST">
          <div>
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="Enter Email Address" required />
          </div>
          <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" required />
          </div>
          <button type="submit" name="login" class="btn">Login</button>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include 'footer.php' ?>