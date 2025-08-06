
    <?php include 'connect.php';
   
    
    //update query

    if(isset($_POST['update_product_quantity'])){
        $update_value=$_POST['update_quantity'];
        //echo $update_value;
        $update_id=$_POST['update_quantity_id'];
       // echo $update_id;

       //query

       $update_quantity_query=mysqli_query($conn,"UPDATE cart SET quantity=$update_value WHERE
        id=$update_id");

        if($update_quantity_query){
            header('Location:cart.php');
        }

   

    }

    if(isset($_GET['remove'])){   //TO CHECK HOW REMOVE IS DONE AND ALSO THE USE OF POST AND GET METHODE & TO CREATE A TABLES

        $remove_id=$_GET['remove'];
       // echo $remove_id;

       mysqli_query($conn,"DELETE FROM cart WHERE id=$remove_id");
       header('Location:cart.php');

    }
    if(isset($_GET['delete_all'])){
        mysqli_query( $conn,"DELETE FROM cart ");
        header('Location:cart.php');
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
    <title>Cart Page-Project</title>
</head>
<body>
    <!--HEADER-->

    <header class="header">
      <div class="header_body">
        <a href="index.php" class="logo">OnlineStore</a>
        <nav class="navbar">
        <!--<a href="index.php">Add Products</a>-->
        <!--<a href="view_product.php">View Products</a>-->
        <!--<a href="shop_prod.php">Shoping</a>-->
        <a href="shop_prod.php">BACK</a>
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


    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">Shopping Cart</h1>
            <table>

            <?php
            $select_cart_product=mysqli_query($conn,"SELECT * FROM cart");
            $num=1;
            $grand_total= 0;

            if(mysqli_num_rows($select_cart_product)> 0){

                echo "       <thead>
                <th>Sr No</th>
                <th>Product Name</th>
                <th>Image </th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            <tbody>";

            while($fetch_cart_products=mysqli_fetch_assoc($select_cart_product)){
                ?>
                                    <tr>
            
                        <td><?php echo $num?></td>
                        <td><?php echo $fetch_cart_products['name']?></td>
                        <td>
                            <img src="images/<?php echo $fetch_cart_products['image']?>" alt="Laptop">
                        </td>
                        <td><?php echo $fetch_cart_products['price']?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" value="<?php echo $fetch_cart_products['id']?>" name="update_quantity_id">
                            <div class="quantity_box">
                                <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity']?>" name="update_quantity">
                                <input type="submit" class="update_quantity" value="update" name="update_product_quantity">

                            </div>
                            </form>
                        </td>
                        <td>R<?php echo $subtotal=number_format($fetch_cart_products['price']*$fetch_cart_products['quantity'])?></td>

                                                                                                        <!--Confirm message-->
                        <td>
                            <a href="cart.php?remove=<?php echo $fetch_cart_products['id']?>" onClick="return confirm('Are you sure you want to delete a product?')">
                                <i class="fas fa-trash"></i>Remove <!--to add remove button-->
                            </a>
                        </td>
                    </tr>
                    
                <?php
                $grand_total+=($fetch_cart_products['price']*$fetch_cart_products['quantity']);
                $num++;
            }

            }else{
                echo "<div class='empty_text'>Cart is empty</div>";
            }



?>
         
                

                </tbody>
            </table>

            <!--php code-->
             <!--bottom area-->
            <?php

            if($grand_total>0){

                echo "
                <div class='table_bottom'>
                    <a href='shop_prod.php' class='bottom_btn'>Continue to purchase</a>
                    <h3 class='bottom_btn'>Total Price: R<span>$grand_total</span></h3>
                    <a href='checkout.php?i=$grand_total' class='bottom_btn'>Proceed Checkout</a>
                </div>";

           

            ?>

           

            <a href="cart.php?delete_all" class="delete_all_btn" onClick="return confirm('Are you sure you want to delete a product?')">
                <i class="fas fa-trash"></i>Delete All</a>
            </a>

            <!--TO FIX DELETE ALL ISSUE-->

            <?php



}else{
    echo"";
}

?>

        </section>
    </div>

</body>
</html>
        
