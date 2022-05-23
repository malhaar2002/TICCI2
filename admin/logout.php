<?php

    // Include constants for SITEURL
    include("../config/constants.php");

    // 1. Destroy the session $_SESSION['user']
    session_destroy();

    // 2. Redirect to login page
    header("location:".SITEURL."admin/login.php");

?>