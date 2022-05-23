<?php
    include("config/constants.php");
    date_default_timezone_set('Asia/Kolkata');

    // Get PHP variables
    $sql4 = "SELECT full_name FROM tbl_user WHERE username='".$_SESSION['student-user']."';";
    $res4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($res4);
    $name = $row4['full_name'];

    // Get Javascript variables
    if (isset($_POST['payment_id'])) {
        $amt = $_POST['amt'];
        $added_on = date('Y-m-d h:i:s');
        $delivery_time = $_POST['delivery_time'];
        $delivery_location = $_POST['delivery_location'];
        $instructions = $_POST['instructions'];
        $contact = $_POST['contact'];
        $payment_id = $_POST['payment_id'];

        // Add to database - tbl_order
        $sql = "INSERT INTO tbl_order(name, price, order_time, delivery_time, delivery_location, instructions, contact, payment_id) VALUES ('$name', $amt, '$added_on', '$delivery_time', '$delivery_location', '$instructions', '$contact', '$payment_id');";
        $res = mysqli_query($conn, $sql);

        // Get order items data from user cart
        $sql3 = "SELECT title, quantity FROM ".$_SESSION['student-user']."_cart;";
        $res3 = mysqli_query($conn, $sql3);

        if ($res3==TRUE) {
          $count3 = mysqli_num_rows($res3);

          if ($count3 > 0) {
            while ($rows3 = mysqli_fetch_assoc($res3)) {

              $item = $rows3['title'];
              $quantity = $rows3['quantity'];

              // Add to database tbl_order_items
              $sql2 = "INSERT INTO tbl_order_items(order_time, item, quantity) VALUES ('$added_on', '$item', $quantity);";
              $res2 = mysqli_query($conn, $sql2);

            }
          }
        }
    }

?>