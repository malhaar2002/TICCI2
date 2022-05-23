<?php include("../config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <title>Login - Flavours of the North</title>
</head>
<body>

    <div class="login">
        <h2 class="text-center">Login</h2>

        <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }
        ?>
        <br><br>

        <!-- Login form starts here -->
        <form action="" method="POST" class="text-center">
            <div class="login-input-box">
                <input type="text" name="username" class="login-user-name">
                <label>Username</label>
            </div>
            <div class="login-input-box">
                <input type="password" name="password" class="login-user-pass">
                <label>Password</label>
            </div>
            <input type="submit" name="submit" value="Login" class="login-submit">
            <br><br>
        </form>
    </div>
        <!-- Login form ends here -->

</body>
</html>

<?php

    // Check whether submit button is clicked
    if (isset($_POST['submit'])) {
        // Process for login

        // 1. Get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // 2. Check whether username and password are correct
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $_SESSION['login'] = "<div class='success'>Logged in Successfully</div>"; //To display log in message
            $_SESSION['admin-user'] = $username; //To ensure admin is logged in at all times when using the website
            header("location:".SITEURL."admin/");
        } else {
            $_SESSION['login'] = "<div class='error'>Username and Password did not match</div>";
            header("location:".SITEURL."admin/login.php");            
        }
    }

?>