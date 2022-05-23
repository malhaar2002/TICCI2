<?php include("partials/header.php"); ?>

<main id="main">
    <br><br>
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between login-parent">

        <div class="login-form">
            <form action="" method="POST">

              <input type="text" name="full_name" placeholder="Full Name" class="login-inputs">
              <br><br>

              <input type="text" name="contact_number" placeholder="Contact Number" class="login-inputs">
              <br><br>

              <input type="text" name="email" placeholder="Email Address" class="login-inputs">
              <br><br>

              <input type="text" name="username" placeholder="Username (Only Letters and Digits)" class="login-inputs">
              <br><br>
              
              <input type="password" name="password" placeholder="Password" class="login-inputs">
              <br><br>

              <input type="password" name="confirm_password" placeholder="Confirm Password" class="login-inputs">
              <br><br>

              <input type="submit" name = "submit" value="sign up" class="book-a-table-btn submit-button">
              <br><br><br>

              <p class="login-subtext">Already have an account? <a href="user-login.php">Log in </a>now</p>

              <?php
                  if (isset($_SESSION['invalid-ph'])) {
                      echo $_SESSION['invalid-ph'];
                      unset($_SESSION['invalid-ph']);
                  }
                  if (isset($_SESSION['invalid-email'])) {
                      echo $_SESSION['invalid-email'];
                      unset($_SESSION['invalid-email']);
                  }
                  if (isset($_SESSION['username-taken'])) {
                      echo $_SESSION['username-taken'];
                      unset($_SESSION['username-taken']);
                  }
                  if (isset($_SESSION['password-not-matching'])) {
                      echo $_SESSION['password-not-matching'];
                      unset($_SESSION['password-not-matching']);
                  }
                  if (isset($_SESSION['registration-failed'])) {
                      echo $_SESSION['registration-failed'];
                      unset($_SESSION['registration-failed']);
                  }
                  if (isset($_SESSION['username-invalid'])) {
                      echo $_SESSION['username-invalid'];
                      unset($_SESSION['username-invalid']);
                  }
              ?>


            </form>
        </div>

        <img src="assets/img/undraw_eating_together.svg" alt="" width="30%" class="login_graphic" title = "Would you look at that, two people dating! There is hope bois">

      </div>

    </div>
  </section>

  <section class="inner-page">
    <div class="container">
    </div>
  </section>

</main>
<!-- End #main -->

<?php
 if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Full name to camel case
    $full_name = ucwords($full_name);

    // Contact Number Validation
    if (preg_match('/^[0-9]{10}+$/', $contact_number) == 0) {
      $_SESSION['invalid-ph'] = "<div class = 'error'>Please Enter a Valid Contact Number</div>";
      echo "<script> location.href='sign-up.php'; </script>";
      exit();
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['invalid-email'] = "<div class = 'error'>Please Enter a Valid Email Address</div>";
      echo "<script> location.href='sign-up.php'; </script>";
      exit();
    }

    // TODO: Username validation
    if (preg_match('/'.preg_quote('^£$%^&*@#~?><,@|-=-_+-¬', '/').'/', $string)) {
      $_SESSION['username-invalid'] = "<div class='error'>Username Contained Invalid Characters. Please use only Letters and Digits";
      echo "<script> location.href='sign-up.php'; </script>";
      exit();
    }

    // Username uniqueness check
    $sql = "SELECT username FROM tbl_user";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    echo "count=".$count;

    if ($res == TRUE) {
      echo "Executing...";
      $count = mysqli_num_rows($res);
      if ($count>0) {
        while($rows = mysqli_fetch_assoc($res)) {
          $existing_usernames = $rows['username'];
          echo "Username ".$username;
          echo " Existing username ".$existing_usernames;
          echo "";

          if ($username == $existing_usernames) {
            
            $_SESSION['username-taken'] = "<div class = 'error'>This Username is Already Taken. Please try Another</div>";
            echo "<script> location.href='sign-up.php'; </script>";
            exit();

          } else {
            // Convert username to lowercase
            $username = strtolower($username);
          }
        }
      }
    } else {
      echo "Did not execute";
    }

    // Password and Confirm Password Match
    if ($password != $confirm_password) {
      $_SESSION['password-not-matching'] = "<div class = 'error'>Password and Confirm Password do not match</div>";
      echo "<script> location.href='sign-up.php'; </script>";
      exit();
    }


    // Entering information into database
    $sql2 = "INSERT INTO tbl_user VALUES ('$full_name', '$contact_number', '$email', '$username', '$password')";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
      $_SESSION['registration-success'] = "<div class='success'>Signed up Successfully</div>";
      echo "<script> location.href='user-login.php'; </script>";
      exit();

    } else {
      $_SESSION['registration-failed'] = "<div class='error'>Failed to Sign Up</div>";
      echo "<script> location.href='sign-up.php'; </script>";
      exit();

    }
  }
?>

<?php include("partials/footer.php"); ?>