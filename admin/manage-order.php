<?php include("partials/menu.php"); ?>

<meta http-equiv="refresh" content="60">
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.No&nbsp;</th>
                <th>Name</th>
                <th>Order</th>
                <th>Price&nbsp;</th>
                <th>Order Time</th>
                <th>Delivery Time</th>
                <th>Delivery Location</th>
                <th>Special Instructions</th>
                <th>Contact Number</th>
            </tr>

            <?php
                $sql = "SELECT name, price, order_time, delivery_time, delivery_location, instructions, contact FROM tbl_order";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($res == TRUE) {
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $name = $rows['name'];
                            $price = $rows['price'];
                            $order_time = $rows['order_time'];
                            $delivery_time = $rows['delivery_time'];
                            $delivery_location = $rows['delivery_location'];
                            $instructions = $rows['instructions'];
                            $contact = $rows['contact'];

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $name; ?></td>
                                <td>
                                    <table class="tbl-full">
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                        </tr>

                                    <!-- Get Order Information from tbl_order_items -->
                                    <?php
                                        $sql2 = "SELECT item, quantity FROM tbl_order_items WHERE order_time = '$order_time'";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $count2 = mysqli_num_rows($res2);

                                        if ($res2 == TRUE) {
                                            if ($count2 > 0) {
                                                while ($rows2 = mysqli_fetch_assoc($res2)) {
                                                    $item = $rows2['item'];
                                                    $quantity = $rows2['quantity'];

                                                    ?>

                                                        <tr>
                                                            <td><?php echo $item; ?></td>
                                                            <td><?php echo $quantity; ?></td>
                                                        </tr>

                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                    </table>
                                </td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $order_time; ?></td>
                                <td><?php echo $delivery_time; ?></td>
                                <td><?php echo $delivery_location; ?></td>
                                <td><?php echo $instructions; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><input type="submit" class="btn-secondary" value="Mark as Complete" name="complete"></td>
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