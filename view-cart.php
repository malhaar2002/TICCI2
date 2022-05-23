<?php include("partials/header.php"); ?>

<?php include("partials/user-login-check.php"); ?>

<main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Your Cart</h2>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">
        <div class="table-responsive">
          <table class="table table-borderless text-white">

            <tr>
              <th>Your Order</th>
              <th>Quantity</th>
              <th>Price</th>
            </tr>

            <?php
              // Get food data from tbl_food database
              if (isset($_GET['food_title'])) {
                $food_title = $_GET['food_title'];
                $sql = "SELECT * FROM tbl_food WHERE title = '$food_title'";
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
                      $sql4 = "SELECT * FROM ".$_SESSION['student-user']."_cart WHERE title = '$food_title'";
                      $res4 = mysqli_query($conn, $sql4);
                      if ($res4==TRUE) {
                        $count = mysqli_num_rows($res4);
                        if ($count > 0) {
                          # Increase quantity
                          $sql2 = "UPDATE ".$_SESSION['student-user']."_cart SET quantity = quantity + 1 WHERE title = '$food_title'";
                          $res2 = mysqli_query($conn, $sql2);
                        } else {
                          # Add food item to cart
                          $sql2 = "INSERT INTO ".$_SESSION['student-user']."_cart VALUES ('$food_title', 1, $price)";
                          $res2 = mysqli_query($conn, $sql2);  
                        }
                        
                      }

                      // Get food data from user cart
                      $sql3 = "SELECT * FROM ".$_SESSION['student-user']."_cart";
                      $res3 = mysqli_query($conn, $sql3);
      
                      if ($res3==TRUE) {
                        $count3 = mysqli_num_rows($res3);
      
                        if ($count3 > 0) {
                          while ($rows3 = mysqli_fetch_assoc($res3)) {
      
                            $title3 = $rows3['title'];
                            $price3 = $rows3['price'];
                            $quantity3 = $rows3['quantity'];
      

                          ?>

                          <tr>
                              <td><?php echo "<span class='food-item'>$title3</span>"; ?></td>
                              <td>
                              <table class="quantity_table">
                                  <tr>
                                  <td><a href="view-cart.php?update_item=<?php echo $title3 ?>&action=decrease">-</a></td>
                                  <td><?php echo $quantity3; ?></td>
                                  <td><a href="view-cart.php?update_item=<?php echo $title3 ?>&action=increase">+</a></td>
                                  </tr>
                              </table>
                              </td>
                              <td>&#8377;<?php echo $price3; ?></td>
                          </tr>


                          <?php
                        }
                      }
                    }
                  }
                }
              }
            }
            
            // Increase or Decrease Quantity

            // TODO: Quantity decrease nahi ho rahi, sirf increase ho rahi hai
            
            elseif (isset($_GET['update_item'])) {
              $update_item = $_GET['update_item'];

              //Get original price
              $sql = "SELECT quantity, price FROM ".$_SESSION['student-user']."_cart WHERE title = '$update_item'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) {
                          $price = $rows['price'];
                          $quantity = $rows['quantity'];
                      }
                  }

              $original_price = $price / $quantity; 

              // Quantity increase
              if ($_GET['action'] = 'increase') {  
                $sql5 = "UPDATE ".$_SESSION['student-user']."_cart SET quantity = quantity + 1 WHERE title = '$update_item'";
                $res5 = mysqli_query($conn, $sql5);
                
              } elseif ($_GET['action'] = 'decrease') {
                $sql5 = "UPDATE ".$_SESSION['student-user']."_cart SET quantity = quantity - 1 WHERE title = '$update_item'";
                $res5 = mysqli_query($conn, $sql5);
              }

              // Update price
              $sql5 = "UPDATE ".$_SESSION['student-user']."_cart SET price = quantity * $original_price WHERE title = '$update_item'";
              $res5 = mysqli_query($conn, $sql5);

              if ($res5==TRUE) {

                $sql3 = "SELECT * FROM ".$_SESSION['student-user']."_cart";
                $res3 = mysqli_query($conn, $sql3);

                if ($res3==TRUE) {
                  $count3 = mysqli_num_rows($res3);

                  if ($count3 > 0) {
                    while ($rows3 = mysqli_fetch_assoc($res3)) {

                      $title3 = $rows3['title'];
                      $price3 = $rows3['price'];
                      $quantity3 = $rows3['quantity'];
                    }
                  }
                }
              }    


                    ?>

                    <tr>
                        <td><?php echo "<span class='food-item'>$title3</span>"; ?></td>
                        <td>
                        <table class="quantity_table">
                            <tr>
                            <td><a href="view-cart.php?update_item=<?php echo $title3 ?>&action=decrease">-</a></td>
                            <td><?php echo $quantity3; ?></td>
                            <td><a href="view-cart.php?update_item=<?php echo $title3 ?>&action=increase">+</a></td>
                            </tr>
                        </table>
                        </td>
                        <td>&#8377;<?php echo $price3; ?></td>
                    </tr>

                    <?php
                    }
                  }
            

            else {
              $sql6 = "SELECT * FROM ".$_SESSION['student-user']."_cart";
              $res6 = mysqli_query($conn, $sql6);

              if ($res6==TRUE) {
                $count6 = mysqli_num_rows($res6);

                if ($count6 > 0) {
                  while ($rows6 = mysqli_fetch_assoc($res6)) {

                    $title6 = $rows6['title'];
                    $price6 = $rows6['price'];
                    $quantity6 = $rows6['quantity'];


                  ?>

                  <tr>
                      <td><?php echo "<span class='food-item'>$title6</span>"; ?></td>
                      <td>
                      <table class="quantity_table">
                          <tr>
                          <td><a href="view-cart.php?update_item=<?php echo $title6 ?>&action=decrease">-</a></td>
                          <td><?php echo $quantity6; ?></td>
                          <td><a href="view-cart.php?update_item=<?php echo $title6 ?>&action=increase">+</a></td>
                          </tr>
                      </table>
                      </td>
                      <td>&#8377;<?php echo $price6; ?></td>
                  </tr>

                  <?php
                  }
                }
              }
            }

          ?>

          <tr>
            <td></td>
            <td><b>Total</b></td>
            <td></td>
          </tr>

          <tr>

            <!-- Get user email and phone number to pass to pay_now function -->
            <?php
              $sql = "SELECT contact_number, email FROM tbl_user WHERE username = '".$_SESSION['student-user']."';";
              $res = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($res);
              $email = $row['email'];
              $contact = $row['contact_number'];
            ?>

            <td>
              <input type="button" class="book-a-table-btn" id="rzp-button1" value="Proceed to Payment Gateway" onclick="pay_now('<?php echo $contact; ?>', '<?php echo $email; ?>')" style="background-color: black;">
            </td>
          </tr>
          <tr>
            <tr>
              <td></td>
            </tr>
          </tr>
          </table>
        </div>
      </div>
    </section>

</main>

<!-- Razorpay Payment Integration -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo SITEURL; ?>/assets/js/payment.js"></script>

<?php include("partials/footer.php"); ?>