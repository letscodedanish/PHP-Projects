<?php include "functions.php"; ?>
<?php include "header.php"; ?>

<?php

if (isset($_POST["signup"])) {
  $data = $_POST;
  $user = get_user($data);
  if ($user) {
    $message = [
      'type' => 'error',
      'message' => 'Email or Username Already Taken!',
    ];
  } else {
    if ($data["password"] == $data["cpassword"]) {
      $data["is_admin"] = "0";
      $user = signup($data);
      if ($user) {
        $message = [
          'type' => 'success',
          'message' => 'User Registered Successfully!',
        ];
        login($data);
      } else {
        $message = [
          'type' => 'error',
          'message' => 'Some Error Occured!',
        ];
      }
    } else {
      $message = [
        'type' => 'error',
        'message' => 'Passwords should match!',
      ];
    }
  }
}

?>

<main>
  <div class="banner about">
    <div class="content">
      <h1>Signup</h1>
    </div>
  </div>
  <div class="bg-grad">
    <div class="form">
      <?php if (isset($message)) { ?>
        <div class="message <?= $message["type"] ?>">
          <p><?= $message["message"] ?></p>
          <?php if ($message['type'] == 'success') { ?>
            <p>Login <a href="login.php">Here</a></p>
          <?php } ?>
        </div>
      <?php } ?>
      <form action="?" method="POST">
        <div>
          <label for="first">First Name</label>
          <input name="fname" type="first" id="first" />
        </div>
        <div>
          <label for="last">Last Name</label>
          <input name="lname" type="last" id="last" />
        </div>
        <div>
          <label for="email">Email Address</label>
          <input name="email" type="email" id="email" />
        </div>
        <div>
          <label for="password">Password</label>
          <input name="password" type="password" id="password" />
        </div>
        <div>
          <label for="cpassword">Password</label>
          <input name="cpassword" type="password" id="cpassword" />
        </div>
        <button name="signup" type="submit">Signup</button>
      </form>
    </div>
  </div>
</main>
<?php include "footer.php" ?>