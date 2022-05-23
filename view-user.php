<?php include("partials/header.php"); ?>

<main id="main">
    <br><br>
  <section class="breadcrumbs">

    <div class="container">

        <?php

          // Display user updated message
          if (isset($_SESSION['update'])) { //Add admin
            echo $_SESSION['update']; //Display session message (added admin successfully)
            unset ($_SESSION['update']); //Removing session message
            echo "<br>";
          }

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
              <td><?php echo $full_name ?></td>
            </tr>
            <tr>
              <td><span class="help-text">Contact Number</span></td>
              <td><?php echo $contact_number ?></td>
            </tr>
            <tr>
              <td><span class="help-text">Email</span></td>
              <td><?php echo $email ?></td>
            </tr>
            <tr>
              <td><span class="help-text">Username</span></td>
              <td><?php echo $username ?></td>
            </tr>
          </table>

        <!-- Button to update user details -->
        <div class="btns">
          <br>
          <a href="update-user.php?username=<?php echo $username ?>" class="book-a-table-btn submit-button">Update User Details</a>
          <br><br>
        </div>

        </div>
    </div>
  </section>

  <section class="inner-page">
    <div class="container">
      <br><br><br><br>    
    </div>
  </section>

</main>
<!-- End #main -->

<?php include("partials/footer.php"); ?>