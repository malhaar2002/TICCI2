<?php
    // Authorisation - Access Control (Check whether user is logged in)

    if (!isset($_SESSION['admin-user'])) { //User is not logged in
        // Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error'>Please Log In to Access Admin Panel</div>";
        header("location:".SITEURL."admin/login.php");
    }

?>