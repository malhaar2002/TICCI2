<?php include("partials/header.php"); ?>

<main id="main">
    <br><br>
  <section class="breadcrumbs">
        
    <?php

        // Get user details based on username
        $username = $_GET['username'];
        $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);

                $full_name = $rows['full_name'];
                $contact_number = $rows['contact_number'];
                $email = $rows['email'];
            }
        }

    ?>
    <div class="d-flex justify-content-between login-parent">

        <div class = "login-form table-responsive">

            <form action="" method="POST">

                <table class = "update-user-table">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name ?>" class = 'login-inputs'></td>
                    </tr>
                    
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>" class = 'login-inputs'></td>
                    </tr>

                    <tr>
                        <td>Contact Number: </td>
                        <td><input type="text" name="contact_number" value="<?php echo $contact_number; ?>" class = 'login-inputs'></td>
                    </tr>

                    <tr>
                        <td>Email: </td>
                        <td><input type="text" name="email" value="<?php echo $email; ?>" class = 'login-inputs'></td>
                    </tr>

                </table>

                <input type="submit" value="Update Profile" name="submit" class="book-a-table-btn submit-button">

            </form>

        </div>

        <div>
            <img src="assets/img/update_profile.svg" alt="" width="40%" class="login_graphic">
        </div>

    </div>


    <div class="container">
        <br><br>
    </div>
  </section>

</main>
<!-- End #main -->

<?php

    // Check whether submit button is clicked
    if (isset($_POST['submit'])) {
        
        // Get values from form
        $old_username = $username;
        $username = $_POST['username'];
        $full_name = $_POST['full_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];

        // Update details
        $sql = "UPDATE tbl_user SET full_name = '$full_name', contact_number = '$contact_number', email = '$email', username = '$username' WHERE username = '$old_username'";
        $res = mysqli_query($conn, $sql);

        // Check if query executed successfully
        if ($res == TRUE) {
            $_SESSION["student-user"] = $username;
            $_SESSION["update"] = "<div class = 'success'>User details updated successfullly!</div>";
            echo "<script> location.href = 'view-user.php'; </script>";
        } else {
            $_SESSION["update"] = "<div class = 'error'>Failed to update user details</div>";
            echo "<script> location.href = 'view-user.php'; </script>";
        }

    }

?>

<?php include("partials/footer.php"); ?>