<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; //Displaying session message (failed to add admin)
                unset ($_SESSION['add']); //Removing session message
            }
        ?>
        <br><br><br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan=2><input type="submit" value="Add Admin" name="submit" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>

<?php
    // Process the value form and save it in database

    // Check whether the button is clicked or not
    if (isset($_POST['submit'])) {
        //button clicked
        
        //1. get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password encryption with md5

        //2. SQL query to save data into database
        $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

        //3. Executing the query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error()); //$conn is created in constants.php

        //4. Check whether the data is inserted or not and display appropriate message
        if ($res == TRUE) {
            //Data Inserted

            // Create a session variable to display message
            $_SESSION['add'] = "<div class = 'success'> Added Admin Successfully </div>";

            // Redirect page to manage-admin/
            header("location:".SITEURL.'admin/manage-admin.php'); //SITEURL is imported from constants.php while importing header.php

        } else {
            //Failed to insert data

            // Create a session variable to display message
            $_SESSION['add'] = "<div class = 'error'> Failed to Add Admin </div>";

            // Redirect page to manage-admin
            header("location:".SITEURL.'admin/add-admin.php'); //SITEURL is imported from constants.php while importing header.php

        }
    }
?>