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
              <th>Remove</th>
            </tr>

            <?php
            if (isset($_POST['quantity_update'])){
              
              $item = $_POST['quantity_update'];
              $val = $_POST['num'];

              $sql = "SELECT * FROM tbl_food WHERE title = '$item'";
                $res = mysqli_query($conn, $sql);

                if ($res==TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {

                      $id = $rows['id'];
                      $price = $rows['price'];

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
                  $sql2 = "UPDATE ".$_SESSION['student-user']."_cart SET quantity = '$val' WHERE title = '$item'";
                  $res2 = mysqli_query($conn, $sql2);

                  $sql5 = "UPDATE ".$_SESSION['student-user']."_cart SET price = quantity * $price WHERE title = '$item'";
                  $res5 = mysqli_query($conn, $sql5);

                } else {
                  # Add food item to cart
                  $sql2 = "INSERT INTO ".$_SESSION['student-user']."_cart VALUES ('$item', 1, $price)";
                  $res2 = mysqli_query($conn, $sql2);  
                }
              }
              }
            }
          }
        

          $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
          $res1 = mysqli_query($conn, $sql1);

          $sql6 = "SELECT * FROM ".$_SESSION['student-user']."_cart"." ORDER BY title";
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
              <form method="POST">
              <table class="quantity_table" style="border: none;">
                      <tr style="border: none;">
                      <td style="border: none;"><input class="cform_num" type="number" name="num" value=<?php echo '"'.$quantity6.'"'; ?>></td>
                      <td style="border: none;"><input type="hidden" name="quantity_update" value=<?php echo '"'.$title6.'"'; ?>><input class="cform_set" type="submit" value="Set"></td>
                      </tr>
                  </table>
              </form>
                  </td>
                  <td>&#8377;<?php echo $price6; ?></td>
                  <form method="POST" onsubmit="if(!confirm('Remove Item: \'<?php echo $title6; ?>\'?')){return false;}">
                  <td><center><input type="hidden" name="delete_item" value=<?php echo '"'.$title6.'"'; ?>><button style="border: none; background: transparent;" class="cform_del" type="submit"><i style="color: white;" class="bx bx-trash"></i></button></center></td>
              </form>
              </tr>

              <?php
              }
            }
          }



            }

            elseif(isset($_POST['delete_item'])){
            
              $item = $_POST['delete_item'];

              // Create table
              $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
              $res1 = mysqli_query($conn, $sql1);

              // check if item exists in cart
              $sql4 = "SELECT * FROM ".$_SESSION['student-user']."_cart WHERE title = '$item'";
              $res4 = mysqli_query($conn, $sql4);
              if ($res4==TRUE) {
                $count = mysqli_num_rows($res4);
                if ($count > 0) {
                  # Delete Item
                  $sql2 = "DELETE FROM ".$_SESSION['student-user']."_cart WHERE title = '$item'";
                  $res2 = mysqli_query($conn, $sql2);
                }
              }


              $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
              $res1 = mysqli_query($conn, $sql1);
    
              $sql6 = "SELECT * FROM ".$_SESSION['student-user']."_cart"." ORDER BY title";
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
              <form method="POST">
              <table class="quantity_table" style="border: none;">
                      <tr style="border: none;">
                      <td style="border: none;"><input class="cform_num" type="number" name="num" value=<?php echo '"'.$quantity6.'"'; ?>></td>
                      <td style="border: none;"><input type="hidden" name="quantity_update" value=<?php echo '"'.$title6.'"'; ?>><input class="cform_set" type="submit" value="Set"></td>
                      </tr>
                  </table>
              </form>
                  </td>
                  <td>&#8377;<?php echo $price6; ?></td>
                  <form method="POST" onsubmit="if(!confirm('Remove Item: \'<?php echo $title6; ?>\'?')){return false;}">
                  <td><center><input type="hidden" name="delete_item" value=<?php echo '"'.$title6.'"'; ?>><button style="border: none; background: transparent;" class="cform_del" type="submit"><i style="color: white;" class="bx bx-trash"></i></button></center></td>
              </form>
              </tr>

              <?php
                  }
                }
              }

            }

            elseif(isset($_POST['empty_cart']) && $_POST['empty_cart'] == EMPTY_CART){
               // Create table
               $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
               $res1 = mysqli_query($conn, $sql1);
 
               // empty cart
               $sql4 = "TRUNCATE TABLE ".$_SESSION['student-user']."_cart";
               $res4 = mysqli_query($conn, $sql4);



               $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
               $res1 = mysqli_query($conn, $sql1);
     
               $sql6 = "SELECT * FROM ".$_SESSION['student-user']."_cart"." ORDER BY title";
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
               <form method="POST">
               <table class="quantity_table" style="border: none;">
                       <tr style="border: none;">
                       <td style="border: none;"><input class="cform_num" type="number" name="num" value=<?php echo '"'.$quantity6.'"'; ?>></td>
                       <td style="border: none;"><input type="hidden" name="quantity_update" value=<?php echo '"'.$title6.'"'; ?>><input class="cform_set" type="submit" value="Set"></td>
                       </tr>
                   </table>
               </form>
                   </td>
                   <td>&#8377;<?php echo $price6; ?></td>
                   <form method="POST" onsubmit="if(!confirm('Remove Item: \'<?php echo $title6; ?>\'?')){return false;}">
                   <td><center><input type="hidden" name="delete_item" value=<?php echo '"'.$title6.'"'; ?>><button style="border: none; background: transparent;" class="cform_del" type="submit"><i style="color: white;" class="bx bx-trash"></i></button></center></td>
               </form>
               </tr>
 
               <?php
                   }
                 }
               }

            }

            else {
              $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
              $res1 = mysqli_query($conn, $sql1);

              $sql6 = "SELECT * FROM ".$_SESSION['student-user']."_cart"." ORDER BY title";
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
                  <form method="POST">
                  <table class="quantity_table" style="border: none;">
                          <tr style="border: none;">
                          <td style="border: none;"><input style = "width: 30%; margin-right: 5px;" class="cform_num" type="number" name="num" value=<?php echo '"'.$quantity6.'"'; ?>><input style = "width: 30%; margin-right: 5px;" type="hidden" name="quantity_update" value=<?php echo '"'.$title6.'"'; ?>><input class="cform_set" type="submit" value="Set"></td>
                          <td style="border: none;"</td>
                          </tr>
                      </table>
                  </form>
                      </td>
                      <td>&#8377;<?php echo $price6; ?></td>
                  <form method="POST" onsubmit="if(!confirm('Remove Item: \'<?php echo $title6; ?>\'?')){return false;}">
                  <td><center><input type="hidden" name="delete_item" value=<?php echo '"'.$title6.'"'; ?>><button style="border: none; background: transparent;" class="cform_del" type="submit"><i style="color: white;" class="bx bx-trash"></i></button></center></td>
                  </form>
                  </tr>

                  <?php
                  }
                }
              }
            }

          ?>

            <?php
                  
                         //Get total and location
                         $sql1 = "CREATE TABLE IF NOT EXISTS ".$_SESSION['student-user']."_cart (title VARCHAR(100), quantity INT, price INT)";
                         $res1 = mysqli_query($conn, $sql1);

                         $sqlt = "SELECT SUM(price) as total FROM ".$_SESSION['student-user']."_cart";
                         $rest = mysqli_query($conn, $sqlt);
                         $totalt = mysqli_fetch_assoc($rest);
                         $total_val = $totalt['total'];

                         $sqlt = "SELECT location FROM tbl_user WHERE username = '".$_SESSION['student-user']."'";
                         $rest = mysqli_query($conn, $sqlt);
                         $lot = mysqli_fetch_assoc($rest);
                         $lot_val = $lot['location'];
                         
            ?>

          <tr>
            <td><b><a href="./">Add Item</a></b></td>
            <td></td>
            <td></td>
            <td>
              <form id="f-empty-cart" method="POST" onsubmit="if(!confirm('Are you sure you want to empty your cart?')){return false;}">
                <center><b><input type="submit" value= "Empty cart" id="f-empty-cart-submit"></b></center>
                <input type="hidden" name="empty_cart" value="<?php echo(EMPTY_CART); ?>">
              </form>
            </td>
          </tr>

          <tr></tr>

          <tr>
            <td><b>Delivery Location:</b></td>
            <!-- <td><b><?php echo $lot_val; ?></b> <a href="edit-user.php?from=cart">(edit)</a></td> -->

            <td>
              <form id="location_change" class="l_hidden" method="POST">
                <!-- dummy id and class name -->
                <select name="f_location_new" id="f_location_new" style="color: white; background-color: inherit; border: none; cursor: pointer; width: fit-content;">
                  <option value="Flavors of the North" style="color: white; background-color: black; text-align: center;">Flavors of the North</option>
                  <option value="Hostel Stilt Area" style="color: white; background-color: black; text-align: center;">Hostel Stilt Area</option>
                  <option value="Banana Leaf" style="color: white; background-color: black; text-align: center;">Banana Leaf</option>
                  <option value="Dining Hall" style="color: white; background-color: black; text-align: center;">Dining Hall</option>
                </select>
                <script>
                  //Try to set default value to that in the database
                  try{
                    document.getElementById("f_location_new").value = "<?php echo $lot_val; ?>";
                  }
                  catch(err){
                    // Forget abouurritt!
                  }

                </script>
                <input type="submit" value="Submit" style = "background-color: inherit; color: white; border:none;"/>
              </form>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><b>Total</b></td>
            <td><b>&#8377;<?php if(!empty($total_val)){echo($total_val);}else{echo("0");}?></b></td>
          </tr>

          <tr>
            <td>
              <input type="button" class="book-a-table-btn" id="rzp-button1" value="Proceed to Payment Gateway" onclick="pay_now()" style="background-color: black;">
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