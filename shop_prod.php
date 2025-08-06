<?php
include 'connect.php';


if(isset($_POST['add_to_cart'])){
    $products_name=$_POST['product_name'];
    $products_price=$_POST['product_price'];
    $products_image=$_POST['product_image'];
    $product_quantity=1;

    //select cart data

    $select_cart=mysqli_query($conn,"SELECT * FROM cart WHERE name='$products_name'");
    if(mysqli_num_rows($select_cart)> 0){
      $display_message[]="Product already added to cart";
    }else{
        $insert_products=mysqli_query($conn,"INSERT INTO cart (name,price,image,quantity) VALUES 
        ('$products_name','$products_price','$products_image','$product_quantity')");
      $display_message[]="Product  added to cart";
    }

    

  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script scr="js/bootstrap.min.js"></script>
        <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Shop Products-Project</title>
</head>
<body>
    <!--header-->

    <header class="header">
      <div class="header_body">
        <a href="index.php" class="logo">OnlineStore</a>
        <nav class="navbar">
        <!--<a href="index.php">Add Products</a>-->
        <!--<a href="view_product.php">View Products</a>-->
        <a href="shop_prod.php">Shoping</a>
        <a href="home.php">Home</a>
        <a href="view_product.php">Back</a>
        <a href="logout.php">Logout</a>


        
   
  
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




    <div class="container">
    <?php
    if(isset($display_message)){
        foreach($display_message as $display_message ){

        
        echo "<div class='display_message'>
        <span>$display_message</span>
        <i class='fas fa-times' onClick='this.parentElement.style.display=`none`';></i>
    </div>";

        }
    }
?>
        <section class="products">
            <h1 class="heading">Lets Shop</h1>
            <div class="product_container">
                <?php
                $select_products=mysqli_query($conn,"SELECT * FROM myproducts ");
                if(mysqli_num_rows($select_products)> 0){
                    while($fetch_product=mysqli_fetch_assoc($select_products)) {
                        //echo $fetch_product['name'];
                    ?>
                                    <form method="post" action="">
                <div class="edit_form">
                    <img src="images/<?php echo $fetch_product['image']?>" alt="">
                    <h3><?php echo $fetch_product['name']?></h3>
                    <div class="price">Price: <?php echo $fetch_product['price']?></div>
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']?>">
                    <input type="hidden"  name="product_price" value=" <?php echo $fetch_product['price']?>">
                    <input type="hidden"  name="product_image" value=" <?php echo $fetch_product['image']?>">
                    <input type="submit" class="submit_btn" value="Add to Cart" name="add_to_cart">
                </div>

                </form>
                <?php

                    }
                }else{
                    echo "<div class='empty_text'>No Available Products</div>";

                }
            

                ?>

 

            </div>
        </section>
    </div>
</body>
</html>