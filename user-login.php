<?php include("partials/header.php"); ?>

<main id="main">
    <br><br>
  <section class="breadcrumbs">

    <div class="container">

      <div class="d-flex justify-content-between login-parent">

        <div class="login-form">

        <?php
          if (isset($_SESSION['registration-success'])) {
            echo $_SESSION['registration-success'];
            unset($_SESSION['registration-success']);
            echo "<br>";
          }
          if (isset($_SESSION['login'])) {
              echo $_SESSION['login'];
              unset ($_SESSION['login']);
              echo "<br>";
          }
          if (isset($_SESSION['no-login-message'])) {
              echo $_SESSION['no-login-message'];
              unset ($_SESSION['no-login-message']);
              echo "<br>";
          }
        ?>

            <form action="" method="POST">

              <input type="text" name="username" placeholder="Username" class="login-inputs">
              <br><br>
              
              <input type="password" name="password" placeholder="Password" class="login-inputs">
              <br><br>

              <input type="submit" name = "submit" value="login" class="book-a-table-btn submit-button">
              <br><br><br>

              <p class="login-subtext">Don't have an account? <a href="sign-up.php">Sign Up </a>now</p>
              <p class="login-subtext"><a href="">Forgot Password?</a></p>

            </form>
        </div>

        <img src="assets/img/undraw_login.svg" alt="" width="30%" class="login_graphic">

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
  // Check whether submit button is clicked
  if (isset($_POST['submit'])) {
    // Process for login

    // 1. Get data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Convert Username to lowercase
    $username = strtolower($username);

    // 2. Check whether username and password are correct
    $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if ($count == 1) {

        // Login details were correct -> login user and store account info in session variables
        $_SESSION['student-user'] = $username; //To ensure user is logged in at all times when using the website
        echo "<script> location.href='index.php#menu'; </script>";

      } else {

        // Login details were incorrect
        $_SESSION['login'] = "<div class='error'>Username and Password did not match</div>";
        echo "<script> location.href='user-login.php'; </script>";

      }
  }

?>

<?php include("partials/footer.php"); ?>