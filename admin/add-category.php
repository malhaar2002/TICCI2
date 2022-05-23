<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
        ?>

        <br><br>

        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan=2>
                        <input type="submit" value="Add Category" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php
            if (isset($_POST['submit'])) {

                // 1. Get the values from category form
                $title = $_POST['title'];

                // For radio buttons, we need to check if a value is selected or not

                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No";
                }

                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                // 2. Create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET 
                title = '$title',
                active = '$active',
                featured = '$featured'
                ";

                // 3. Execute the query
                $res = mysqli_query($conn, $sql);

                // 4. Check whether query is executed
                if ($res == TRUE) {
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";
                }
            }   
        ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>