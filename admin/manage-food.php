<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>

        <?php
            if (isset($_SESSION['add-food'])) {
                echo $_SESSION['add-food'];
                unset ($_SESSION['add-food']);
            }
        ?>
        <br><br>

        <!-- Button to add food -->
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Active</th>
                <th colspan=2>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count>0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            

                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $category_name = $rows['category_name'];
                            $active = $rows['active'];

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        // Check whether image name is available or not
                                        if ($image_name != "") {
                                            # Display the image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>/assets/img/menu/<?php echo $image_name; ?>" alt="" width=100px>
                                            <?php
                                        } else {
                                            // Display the message
                                            echo "<div class='error'>No Image Added</div>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $category_name; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update Food Item</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php" class="btn-danger">Delete Food Item</a>
                                </td>
                            </tr>

                            <?php

                        }
                    }
                }
            ?> 

        </table>

    </div>
</div>

<?php include("partials/footer.php"); ?>