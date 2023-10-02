<?php include "functions.php"; ?>
<?php include "header.php"; ?>

<?php if (isset($_POST["login"])) {
  $data = $_POST;
  $user = login($data);
  if (!$user) {
    $message = [
      'type' => 'error',
      'message' => 'Login Failed!'
    ];
  } else {
    header("Location: index.php");
  }
} ?>

<main>
  <div class="banner about">
    <div class="content">
      <h1>Login</h1>
    </div>
  </div>
  <div class="bg-grad">
    <div class="form">
      <form action="?" method="POST">
        <div>
          <label for="email">Email Address</label>
          <input name="email" type="email" id="email" />
        </div>
        <div>
          <label for="password">Password</label>
          <input name="password" type="password" id="password" />
        </div>
        <button name="login" type="submit">Login</button>
      </form>
    </div>
  </div>
</main>
<?php include "footer.php" ?>