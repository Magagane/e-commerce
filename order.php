<?php
include 'connect.php';





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
        <title>Orders</title>

</head>
<body>


<header class="header">
      <div class="header_body">
        <a href="index.php" class="logo">OnlineStore</a>
        <nav class="navbar">
        <!--<a href="index.php">Add Products</a>-->
        <!--<a href="view_product.php">View Products</a>-->
        <a href="shop_prod.php">SHOPPING</a>
        <a href="order.php">ORDERS</a>
        <a href="logout.php">LOGOUT</a>
        <a href="home.php">HOME</a>


        
    
  
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

    <h1 class="heading">Order Details</h1>

    

<?php
 if(isset($_GET['action'])&& $_GET['action']=='orders' && $_GET['id']) {


?>


<div class="container mt-5">
    <h6><?php    ?></h6>
    <div class="row">
        <a href="order.php" class="badge bg-primary text-white
         m1-auto p-2 mr-5">Back</a>
        
         <table class="table text-center mt-1 table-bordered">
            <thead>
                <tr>
                
                    <th>Id</th>
                    <th>Payment Method</th>
                    <th>Product Total</th>
                    <th>Total Price</th>
                    <th class="text-center">Status</th>

                </tr>

                
            </thead>

            <?php

            $query="SELECT * FROM orders WHERE id = ".$_GET['id']."";
            $result=$db->query( $query );
            if( $result->num_rows > 0) {
                while( $row = $result->fetch_assoc() ) {
                    $id=$row['id'];
                    $total_producta=$row['total_products'];
                    $pmode=$row['pmode'];
                    $total_price=$row['total_price'];

                    ?>

                    

    <tbody>
        <tr>
            <form action="" Method="post" enctype="multipart/form-data">
                <td><?php echo $id; ?></td>
                <td><?php echo $total_products; ?></td>
                <td><?php echo $pmode; ?></td>
                <td><?php echo $total_price; ?></td>
                <td class="text-danger"><?php echo $status; ?></td>
            </form>
        </tr>

    </tbody>

    <?php }}?>


         </table>
    </div>
</div>

<?php } else {?>

    <div class="container mt-5">
        <h6><?php   ?></h6>
        <div class="row">
            <a href="index.php" class="badge bg-primary
            text-white ml-auto p-2 mr-5">Add Item</a>
            <table class="table text-center mt-1 table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Payment Method</th>
                        <th>Total Products</th>
                        <th>Total Price</th>
                        <th class="text-center">Status</th>
                        <th>Action</th>
                      
                    </tr>
                </thead>
                <?php
                $query=mysqli_query($conn,"SELECT * FROM orders");
                if( $query->num_rows > 0) {
                    while( $row = $query->fetch_assoc() ) {
                        $id=$row['id'];
                        $pmode=$row['pmode'];
                        $total_products=$row['total_products'];
                        $total_price=$row['total_price'];
                        $status='pending';

                        ?>

                        <tbody>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $pmode; ?></td>
                                <td><?php echo $total_products; ?></td>
                                <td><?php echo $total_price; ?></td>
                                <td><?php echo $status; ?></td>
                                
                                <td><a href="?action=orders$id=<?php echo $id ?>"
                                class="btn btn-sm btn-info" style="width: 120px,">View Order</a>
                            </td>
                            </tr>
                        </tbody> 
                    <?php }}?>


                
             

            </table>

        </div>
    </div>

    <?php }?>


 
    
</body>
</html>