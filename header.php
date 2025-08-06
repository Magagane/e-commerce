<header class="header">
      <div class="header_body">
        <a href="index.php" class="logo">OnlineStore</a>
        <nav class="navbar">
        <a href="index.php">ADD PRODUCTS</a>
        <a href="view_product.php">VIEW PRODUCTS</a>
        <a href="shop_prod.php">SHOPPING</a>
        <a href="order.php">ORDERS</a>
        <a href="home.php">HOME</a>
        <a href="logout.php">LOGOUT</a>


        
   
  
        </nav>

        <!--SELECT QUERY-->

        <?php
        $select_product=mysqli_query($conn,"SELECT * FROM cart") or die('query failed');
        $row_count=mysqli_num_rows($select_product);

        echo $row_count;


?>

        <!--shopping cart icon-->

        <a href="cart.php"class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php
         echo $row_count ?></sup></span></a>
        <!--<div id="menu-btn" class="fas fa-bars"></div>-->



      </div>



    </header>
