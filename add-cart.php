<?php
include("config/constants.php");
include("partials/user-login-check.php");

if (isset($_POST['f-order-items'])){
    $orders = $_POST['f-order-items'];
    $order_array = explode("<e>", $orders);
    $order_array = array_filter($order_array);

    foreach($order_array as $item){
        $sql = "SELECT * FROM tbl_food WHERE title = '$item'";
        $res = mysqli_query($conn, $sql);

        if ($res==TRUE) {
          $count = mysqli_num_rows($res);

          if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {

              $id = $rows['id'];
              $price = $rows['price'];

              // create user cart table
              
              // Create table
              $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
              $res1 = mysqli_query($conn, $sql1);

              // check if item exists in cart
              $sql4 = "SELECT * FROM ".$_SESSION['student-user']."_cart WHERE title = '$item'";
              $res4 = mysqli_query($conn, $sql4);
              if ($res4==TRUE) {
                $count = mysqli_num_rows($res4);
                if ($count > 0) {
                  # Increase quantity
                  $sql2 = "UPDATE ".$_SESSION['student-user']."_cart SET quantity = quantity + 1 WHERE title = '$item'";
                  $res2 = mysqli_query($conn, $sql2);
                  
                  $sqlp = "UPDATE ".$_SESSION['student-user']."_cart SET price = quantity * ".$price." WHERE title = '$item'";
                  $resp = mysqli_query($conn, $sqlp);
                }
                else{
                  # Add food item to cart
                  $sql2 = "INSERT INTO ".$_SESSION['student-user']."_cart VALUES ('$item', 1, $price)";
                  $res2 = mysqli_query($conn, $sql2);  
                }
               }
            }
           }
        }
    }
    header("Location: view-cart.php");
}
else{
    header("Location: ./");
}

?>