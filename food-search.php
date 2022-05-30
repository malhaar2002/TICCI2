<?php include("partials/header.php"); ?>

<div style = "height: 30vh; width = 100vw;"></div>

<section class="menu section-bg">
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

      <div class="d-flex justify-content-center login-parent" data-aos="fade-up" data-aos-delay="100">
        <form action="food-search.php" method="POST">
          <input type="text" name="full_name" placeholder="Search" class="login-inputs searchBar" style="border-radius:0; margin:0;">
          <button type="submit" name = "search-menu">Search</button>
        </form>
      </div> 

      <script src="./js/freebie.js"></script>
<?php 
    if(isset($_POST['search-menu'])){
        $search = mysqli_real_escape_string($conn,$_POST['full_name']);
        $sql = "SELECT *  FROM tbl_food WHERE title LIKE '%$search%' OR price LIKE '%$search%' ";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0) {
           while ($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];

                ?>

                <div class= 'row menu-container'>
                    <div class="col-lg-6 menu-item filter-starters">
                    <img src="assets/img/menu/<?php echo $image_name ?>" class="menu-img" alt="">
                    <div class="menu-content">
                        <?php echo "<span class='food-item'>$title</span>"; ?><span>&#8377;<?php echo $price; ?></span>
                        <span>
                        <a onclick="add_order('<?php echo $title; ?>');" id='<?php echo(str_replace(" ","",$title."-cart")); ?>' class='book-a-table-btn scrollto d-lg-flex food-item'>Add to Cart</a>
                        </span>
                    </div>
                   
                    </div>
              </div>

        <?php
           }
        } else{
            echo "No result";
        }
    }
?>
<form id="f-order-form" method="POST" action="add-cart.php" style="display: none;">
        <input id="f-order-form-items" type="hidden" name="f-order-items" value="">
      </form>
      <button id="proceedCart" onclick="submit_orders();">Proceed to Cart (<b id="order_num">0</b>)</button>
</div>
</section>
<?php include("partials/footer.php"); ?>