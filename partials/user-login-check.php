<?php
    // Authorisation - Access Control (Check whether user is logged in)

    if (!isset($_SESSION['student-user'])) { //User is not logged in
        // Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error'>Please Log In to Add Items to Cart</div>";
        header("location:".SITEURL."user-login.php");
    }

?>