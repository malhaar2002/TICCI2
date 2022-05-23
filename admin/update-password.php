<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="current password"></td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="new password"></td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="confirm password"></td>
                </tr>

                <tr>
                    <td colspan=2>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Change Password" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    // Check whether submit button is clicked
    if (isset($_POST['submit'])) {
        // 1. Get the data from the form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. Check whether the user with current id and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            if ($count==1) {
                // User exists and password can be changed

                // Check whether new_password = confirm_password
                if ($new_password == $confirm_password) {
                    
                    $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id = $id";
                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == TRUE) {

                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully!</div>";
                        header("location:".SITEURL."admin/manage-admin.php"); 

                    } else {

                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Update Password</div>";
                        header("location:".SITEURL."admin/manage-admin.php");

                    }

                } else {
                    $_SESSION['password-not-match'] = "<div class='error'>New Password and Confirm Password do not match</div>";
                    header("location:".SITEURL."admin/manage-admin.php"); 
                }

            } else {
                // User does not exist
                $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }

    }
?>

<?php include("partials/footer.php") ?>