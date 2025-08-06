<?php
include 'connect.php';

if(isset($_POST['order_btn'])){

    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $pmode=$_POST['pmode'];

    $cart_query=mysqli_query($conn,"SELECT * FROM cart");
    $product_total=0;
    $price_total=0;
    if(mysqli_num_rows($cart_query)> 0){
        while($product_item=mysqli_fetch_assoc($cart_query)){
            $products_name[]= $product_item['name'].'('.$product_item['quantity'].')';
            //$product_price=number_format( $product_item['price']*$product_item['quantity']);
            $product_price=($product_item['price']*$product_item['quantity']);
          $price_total+=$product_price;
        };
    };

    $product_total=implode(',',$products_name);
    $detail_query=mysqli_query( $conn,"INSERT INTO orders (name,phone,email,address,
    pmode,total_products,total_price) VALUES ('$name','$phone','$email','$address','$pmode','$product_total','$product_price')") or die('query failed');

    if($cart_query && $detail_query){
        echo "
        <div class='order-message-container'>
        <div class='message-container'>
            <h3>Thank you for shopping</h3>
            <div class='order-details'>
                <span>".$product_total."</span>
                <span class='total'>total : ".$price_total." </span>
    
            </div>
            <div class='customer-details'>
                <p>your name :  <span> ".$name." </span></p>
                <p>your number :  <span>".$phone."</span></p>
                <p>your email :  <span>".$email."</span></p>
                <p>your address :  <span>".$address."</span></p>
                <p>your payment mode : <span>".$pmode."</span></p>
                <p>(*pay when products arrive*)</p>
    
            </div>
            <a href='order.php' class='button_btn'>continue shopping</a>
        </div>
    </div>
             ";
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
    <title>checkout</title>
</head>
<body>
    <?php include 'header.php';?>

    <div class="container">
        <section class="checkout-form">
            <h1 class="heading">Compete your order</h1>


            <form action="" method="post">
            <div class="display-order">
                <?php
                $select_cart = mysqli_query($conn,"SELECT * FROM cart");
                $total=0;
                $grand_total=0;
                if(mysqli_num_rows($select_cart)> 0){
                    while($fetch_cart_products=mysqli_fetch_assoc($select_cart)){
                        $total_price=($fetch_cart_products['price']*$fetch_cart_products['quantity']);
                        $grand_total+=$total_price;

                

            

                ?>
                <span><?=$fetch_cart_products['name'];?>(<?=$fetch_cart_products['quantity'];?>)</span>

                <?php
                    }

            }else{
                echo "<div class='display-order'><span>your cart is empty</span></div>";
            }

        


                ?>
                <span class="grand-total">Total price: R<?=$grand_total;?></span>
            </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>your name</span>
                        <input type="text" placeholder="Enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>your number</span>
                        <input type="number" placeholder="Enter your number" name="phone" required>
                    </div>
                    <div class="inputBox">
                        <span>your email</span>
                        <input type="email" placeholder="Enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>Address</span>
                        <input type="text" placeholder="Enter your Address" name="address" required>
                    </div>
                    <div class="inputBox">
                        <span>Payment method</span>
                     <select name="pmode">
                        <option value="cash on delivery" selected>cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>


                     </select>
                    </div>

                </div>
                <input type="submit" value="place order" name="order_btn" class="btn">
            </form>

        </section>
    </div>

    
</body>
</html>