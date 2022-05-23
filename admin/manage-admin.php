<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <H1>Manage Admin</H1>
        <br><br>

        <?php
            if (isset($_SESSION['add'])) { //Add admin
                echo $_SESSION['add']; //Display session message (added admin successfully)
                unset ($_SESSION['add']); //Removing session message
            }

            if (isset($_SESSION['delete'])) { //Delete admin
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }

            if (isset($_SESSION['update'])) { //Update admin details (full name and username)
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }
            if (isset($_SESSION['user-not-found'])) { //User check while updating password
                echo $_SESSION['user-not-found'];
                unset ($_SESSION['user-not-found']);
            }
            if (isset($_SESSION['password-not-match'])) { //Update admin password - new pass != confirm pass
                echo $_SESSION['password-not-match'];
                unset ($_SESSION['password-not-match']);
            }
            if (isset($_SESSION['change-pwd'])) { //Update admin password - new pass != confirm pass
                echo $_SESSION['change-pwd'];
                unset ($_SESSION['change-pwd']);
            }
        ?>
        <br><br><br>

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php

                //Query to get all Admin
                $sql = "SELECT * FROM tbl_admin";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Check whether the query has been executed or not
                if ($res==TRUE) {
                    // Count rows to check whether there is any data in the database
                    $count = mysqli_num_rows($res);

                    $sn = 1; //Create serial number variable

                    if ($count>0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // Using while loop to get all the data from database

                            // Get individual data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            // Display the values in our table
                            ?>

                            <tr>
                                <td><?php echo $sn++ ?></td> <!--Using $sn instead of id because if you remove one admin from the middle, the SNos are gonna get messed up-->
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $username ?></td>
                                <td>
                                    <a href="<?php echo SITEURL."admin/update-password.php?id=".$id;?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL."admin/update-admin.php?id=".$id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL."admin/delete-admin.php?id=".$id;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            
                            <?php
                        }
                    } else {
                        # code...
                    }
                }
            ?>

        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include("partials/footer.php"); ?>