<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            // 1. Get the ID of selected admin
            $id = $_GET['id'];
    
            // 2. Create sql query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            // 3. Execute the query
            $res = mysqli_query($conn, $sql);

            // 4. Check whether the query is executed
            if ($res == TRUE) {
                // Check whether data is available
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    // Redirect to manage-admin
                    header('location:'.SITEURL.'admin/manage-php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>
                
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan = 2>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" value="Update Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

    // Check whether submit button is clicked
    if (isset($_POST['submit'])) {
        // Get values from form
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // create sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check if query executed successfully
        if ($res == TRUE) {
            $_SESSION["update"] = "<div class = 'success'>Admin details updated successfullly!</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        } else {
            $_SESSION["update"] = "<div class = 'error'>Failed to update admin details</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
    } 

?>


<?php include("partials/footer.php"); ?>