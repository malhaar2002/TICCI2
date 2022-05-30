<?php include("partials/header.php"); ?>

<main id="main">
    <br><br>
  <section class="breadcrumbs">
    <form method="POST" action="edit-user-details.php" onsubmit="if(!confirm('Edit Details?')){return false;}">
    <div class="container">

        <?php
          if (isset($_SESSION['student-user'])) {          
            $bande_ka_username = $_SESSION['student-user'];
            $sql = "SELECT * FROM tbl_user WHERE username = '$bande_ka_username'";
            $res = mysqli_query($conn, $sql);

            if ($res==TRUE) {

              $count = mysqli_num_rows($res);

              if ($count>0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                  $full_name = $rows['full_name'];
                  $contact_number = $rows['contact_number'];
                  $email = $rows['email'];
                  $username = $rows['username'];
                }
              }
            }
          }
        ?>

        <div class="table-responsive">
          <table class = "table table-borderless text-white">
            <tr>
              <td><span class="help-text">Full Name</span></td>
              <td><input type="text" name="name" value="<?php echo $full_name ?>"></td>
            </tr>
            <tr>
              <td><span class="help-text">Contact Number</span></td>
              <td><input type="number" minlength="10" maxlength="10" name="number" value="<?php echo $contact_number ?>"></td>
            </tr>
            <tr>
              <td><span class="help-text">Email</span></td>
              <td><input type="text" name="mail" value="<?php echo $email ?>"></td>
            </tr>
            <tr>
              <td><span class="help-text">Delivery Location</span></td>
              <td>
              <input type="radio" name="location" value="Flavors of the North" required>Flavors of the North<br>
              <input type="radio" name="location" value="Hostel Stilt Area" required>Hostel Stilt Area<br>
              <input type="radio" name="location" value="Banana Leaf" required>Banana Leaf<br>
              <input type="radio" name="location" value="Dining Hall" required>Dining Hall<br><br>
              </td>
            </tr>
            <!--<tr>
              <td><span class="help-text">Username</span></td>
              <td><input type="text" name="user" value="<?php //echo $username ?>"></td>
            </tr>-->
          </table>

        <!-- Button to update user details -->
        <div class="btns">
          <br>
          <a onclick="document.getElementById('update_details').click();" class="book-a-table-btn submit-button">Submit</a>
          <input type="submit" id="update_details" style="display: none;">
          <input type="hidden" name="edit-sent" value="<?php echo $username ?>">
          <br><br>
        </div>

        </div>
    </div>
    </form>
  </section>

  <section class="inner-page">
    <div class="container">
      <br><br><br><br>    
    </div>
  </section>

</main>
<!-- End #main -->

<?php include("partials/footer.php"); ?>