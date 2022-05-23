<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if (isset($_SESSION['add-food'])) {
                echo $_SESSION['add-food'];
                unset ($_SESSION['add-food']);
            }
            if (isset($_SESSION['upload-image'])) {
                echo $_SESSION['upload-image'];
                unset ($_SESSION['upload-image']);
            }
            if (isset($_SESSION['category-not-selected'])) {
                echo $_SESSION['category-not-selected'];
                unset ($_SESSION['category-not-selected']);
            }
        ?>

        <br><br>

        <!-- Add Food Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="food title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="50" rows="5"></textarea>
                    </td>
                </tr>
                <tr>

                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="food price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Select Category</td>
                <td>
                    <select name="category">
                        <?php
                            $sql = "SELECT id, title FROM tbl_category";
                            $res = mysqli_query($conn, $sql);
                            
                            if ($res == TRUE) {
                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                        
                                        $id = $rows['id'];
                                        $category_name = $rows['title'];

                                        ?>

                                        <option value="<?php echo $category_name ?>"><?php echo $category_name ?></option>

                                        <?php

                                    }
                                }
                            }
                        ?>
                    </select>
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
                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add Food Form Ends -->

        <?php
            if (isset($_POST['submit'])) {

                // 1. Get the values from food form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];

                // For radio buttons, we need to check if a value is selected or not

                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                // Check if category has been selected
                if (isset($_POST['category'])) {
                    $category = $_POST['category'];
                } else {
                    $_SESSION['category-not-selected'] = "<div class='error'>Category not Selected<?div>";
                    header("location:".SITEURL."admin/add-food.php");
                    die();
                }

                // Check whether image is uploaded and set value for image name accordingly
                // print_r($_FILES['image']);
                // die();

                if (isset($_FILES['image']['name'])) {

                    // Upload the image
                    // To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // Auto Rename the Image

                    // Get the extension of our image (jpg, png, gif, etc.)
                    $ext = end(explode('.', $image_name));

                    // Rename the image
                    date_default_timezone_set('Asia/Kolkata');
                    // echo date_default_timezone_get();
                    echo $date = date('m-d-Y-h-i-s-a', time());
                    $image_name = 'Food_Item_'.$date.'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../assets/img/menu/".$image_name;

                    // upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if ($upload==FALSE) {
                        $_SESSION['upload-image'] = "<div class = 'error'>Failed to Upload Image</div>";
                        header("location:".SITEURL."admin/add-food.php");
                        die();
                    }


                } else {
                    // Don't upload image and set the image_name value as blank
                    $image_name = "";
                }

                // 2. Create sql query to insert category into database
                $sql = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_name = '$category',
                active = '$active',
                ";

                // 3. Execute the query
                $res = mysqli_query($conn, $sql);

                // 4. Check whether query is executed
                if ($res == TRUE) {
                    $_SESSION['add-food'] = "<div class='success'>Food Item Added Successfully</div>";
                    header("location:".SITEURL."admin/manage-food.php");
                } else {
                    $_SESSION['add-food'] = "<div class='error'>Failed to Add Food Item</div>";
                }
            }   
        ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>