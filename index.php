<?php include("partials/header.php"); ?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
    <div class="row">
      <div class="col-lg-8">
        <h1>Flavours of the North</h1>
        <h2>Plaksha University</h2>

        <div class="btns">
          <a href="#menu" class="btn-menu animated fadeInUp scrollto">Order Now</a>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class = "hero-bottom">*Images shown are for illustration purposes only and MIGHT be SLIGHTLY different from the actual product ;&#41;</div> -->
</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="row about-parent">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
          <div class="about-img">
            <img src="assets/img/about1.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <p class="fst-italic">
            Welcome to Flavours of the North, a cosy food joint on the Plaksha University campus. Bask in the warmth of
            the sun in this open air food joint as you enjoy the mouth watering assortment of north indian delicacies
          </p>
        </div>
      </div>

    </div>
  </section>
  <!-- End About Section -->

  <!-- ======= Menu Section ======= -->
  <section id="menu" class="menu section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Menu</h2>
        <p>Check Out Our Tasty Menu</p>
      </div>

      <!-- Display Categories -->
      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="menu-flters">
            <li data-filter=".filter-starters">Starters</li>
            <li data-filter=".filter-maincourse">Main Course</li>
            <li data-filter=".filter-breads">Bread and Add-ons</li>
            <li data-filter=".filter-combos">Classic Combos</li>
            <li data-filter=".filter-parathas">Parathas</li>
            <li data-filter=".filter-dessert">Dessert</li>
            <li data-filter=".filter-salads">Salads</li>
          </ul>
        </div>
      </div>

      <!-- TODO: Search Bar -->
      <div class="d-flex justify-content-center login-parent" data-aos="fade-up" data-aos-delay="100">
        <form action="food-search.php" method="POST">
          <input type="text" name="full_name" placeholder="Search by price or name" class="login-inputs searchBar" style="border-radius:0; margin:0;">
          <!-- <a href="<?php // echo SITEURL; ?>food-search.php"><i class="fas fa-search searchIcon"></i></a> -->
          <button type="submit" style = "background-color: inherit; color: white; border:none;" name = "search-menu"><i class="fas fa-search searchIcon"></i></button>
        </form>
      </div> 

      <script src="./js/freebie.js"></script>

      <!-- Display Food Items -->
      <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

        <?php
          if (isset($_SESSION['add-to-cart'])) {
            echo $_SESSION['add-to-cart'];
            unset($_SESSION['add-to-cart']);
          }
        ?>


        <!-- Starters -->
        <?php
              $sql = " SELECT * FROM tbl_food WHERE category_name = 'Starters'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-starters">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span>
              <a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a>
            </span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
        ?>

        <!-- Main Course -->
        <?php
              $sql = "SELECT * FROM tbl_food WHERE category_name = 'Main Course'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-maincourse">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span><a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a></span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
        ?>

        <!-- Bread and Add-ons -->
        <?php
              $sql = "SELECT * FROM tbl_food WHERE category_name = 'Bread and Add-ons'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-breads">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span><a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a></span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
          ?>

        <!-- Classic Combos -->
        <?php
              $sql = "SELECT * FROM tbl_food WHERE category_name = 'Classic Combos'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-combos">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span><a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a></span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
          ?>

        <!-- Parathas -->
        <?php
              $sql = "SELECT * FROM tbl_food WHERE category_name = 'Parathas'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-parathas">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span><a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a></span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
          ?>

        <!-- Dessert -->
        <?php
              $sql = "SELECT * FROM tbl_food WHERE category_name = 'Dessert'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-dessert">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span><a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a></span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
          ?>

        <!-- Salads -->
        <?php
              $sql = "SELECT * FROM tbl_food WHERE category_name = 'Salads'";
              $res = mysqli_query($conn, $sql);

              if ($res == TRUE) {
                  $count = mysqli_num_rows($res);

                  if ($count>0) {
                      while ($rows = mysqli_fetch_assoc($res)) { 

                          $id = $rows['id'];
                          $title = $rows['title'];
                          $description = $rows['description'];
                          $price = $rows['price'];
                          $image_name = $rows['image_name'];

                          ?>

        <div class="col-lg-6 menu-item filter-salads">
          <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
          <div class="menu-content">
            <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
            <span><a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a></span>
          </div>
          <div class="menu-ingredients">
            <?php echo $description; ?>
          </div>
        </div>

        <?php
                      }
                  }

              }
          ?>

      </div>

      <form id="f-order-form" method="POST" action="add-cart.php" style="display: none;">
        <input id="f-order-form-items" type="hidden" name="f-order-items" value="">
      </form>
      <button id="proceedCart" onclick="submit_orders();">Proceed to Cart (<b id="order_num">0</b>)</button>

  </section>
  <!-- End Menu Section -->


  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div>
    </div>

    <div class="container" data-aos="fade-up">

      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>Plaksha University, Near Acad Block</p>
            </div>

            <div class="open-hours">
              <i class="bi bi-clock"></i>
              <h4>Open Hours:</h4>
              <p>
                Monday-Sunday:<br>
                10 AM - 10 PM
              </p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>parasagarwal52@yahoo.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+91 99170 77702</p>
            </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

          <form action="forms\contact.php" method="POST" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="8" placeholder="Message" required></textarea>
            </div>
            <br>
            <div class="my-3"> <div class="loading">Loading</div> <div class="error-message"></div> <div class="sent-message">Your message has been sent. Thank you!</div> </div>
            <div class="text-center"><button type="submit" name="submit">Send Message</button></div>
          </form>

        </div>

        <?php
        // Get form data
          if (isset($_POST['submit'])) {
            echo "ABBE SAALE";
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['messsage'];
            $body = "Name: ".$name."\nEmail: ".$email."\nMessage: ".$message;
            
            // TODO: Send email
            mail("aroramalhaar@gmail.com", "Hello", "Hello again");
          }
        ?>

      </div>

    </div>
  </section>
  <!-- End Contact Section -->

</main>
<!-- End #main -->

<?php include("partials/footer.php"); ?>