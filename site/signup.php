<?php include 'functions.php' ?>
<?php include 'header.php' ?>

<?php

if (isset($_POST['signup'])) {
  $data = $_POST;
  $user_exists = email_exists($data['email']);
  if ($user_exists) {
    $response = [
      'type' => 'error',
      'message' => 'Email is Already Taken!',
    ];
  } else {
    if ($data["password"] == $data["cpassword"]) {
      $data["type"] = 'user';
      $user = signup($data);
      if ($user) {
        $response = [
          'type' => 'success',
          'message' => 'User Registered Successfully!',
        ];
        login($data);
      } else {
        $response = [
          'type' => 'error',
          'message' => 'Some Error Occured!',
        ];
      }
    } else {
      $response = [
        'type' => 'error',
        'message' => 'Passwords should match!',
      ];
    }
  }
}

?>

<main>
  <div class="internal-header">
    <h1>Signup</h1>
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
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" placeholder="Enter First Name" required />
          </div>
          <div>
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" placeholder="Enter Last Name" required />
          </div>
          <div>
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="Enter Email Address" required />
          </div>
          <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" required />
          </div>
          <div>
            <label for="cpassword">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" required />
          </div>
          <button type="submit" name="signup" class="btn">Signup</button>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include 'footer.php' ?>