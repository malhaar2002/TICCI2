<?php

    // Include constants.php file here
    include("../config/constants.php");

    // 1. Get the ID of the Admin to be deleted
    $id = $_GET['id'];

    // 2. Get SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql) or die (mysqli_error());

    // Check whether the query executed successfully
    if ($res == TRUE) {

        // Create session variable to display message
        $_SESSION['delete'] = "<div class = 'success'>Admin Deleted Successfully</div>";

        // Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    } else {
        
        // Create session variable to display message
        $_SESSION['delete'] = "<div class = 'error'>Failed to Delete Admin </div>";

        // Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');  
    }

    // 3. Redirect to Manage Admin Page with message (success/error)

?>