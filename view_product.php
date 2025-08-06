<?php include 'connect.php'?>;


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>View Products-Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script scr="js/bootstrap.min.js"></script>
        <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
   <!--header-->
   <header class="header">
      <div class="header_body">
        <a href="index.php" class="logo">OnlineStore</a>
        <nav class="navbar">
        <!--<a href="index.php">Add Products</a>-->
        <a href="index.php">BACK</a>
        <a href="view_product.php">VIEW PRODUCT</a>
        <a href="shop_prod.php">SHOP NOW</a>
        <a href="home.php">HOME</a>
        <a href="logout.php">LOGOUT</a>

        <!----CODE TO BE INSERTED-->



        
   
  
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
    <section class="display_products">


                <!--php code-->
                <?php
                $display_product=mysqli_query($conn,"SELECT * FROM myproducts");
                if(mysqli_num_rows($display_product)> 0){
                    
                    echo "<table>
                    <thead>
                        <th>Sr No</th>
                        <th>Product Image  </th> 
                        <th>Product Name  </th>
                        <th>Product Price </th>
                        <th>Action</th>
                    </thead>
                    <tbody>";



                    while($row=mysqli_fetch_assoc($display_product)){
                        //$product_name=$row['name'];
                        ?>
                        <!--displaying table-->

                       


                        <tr>
                    <td><?php echo $row['id']?></td>
                    <td><img src="images/<?php echo $row['image']?>" alt=" <?php echo $row['name']?>"></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['price']?></td>
                    <td>
                        <a href="delete.php?delete=<?php echo $row['id'] ?>" 
                        class="delete_product_btn" onclick="return confirm('Are you sure you want to remove it');">
                        <i  class="fas fa-trash"></i></a>
                        <a href="update.php?edit=<?php echo $row['id']?>" class="update_product_btn">
                        <i  class="fas fa-edit"></i></a>

                    </td>
                </tr>

                        <?php

                    }
                    
                }else{
                        echo "<div class='empty_text'>No Available Products</div>";
                }

                ?>

            </tbody>
        </table>
        
    </section>

   </div>
</body>
</html>