<?php include 'connect.php';
  if(isset($_POST['add_product'])){
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
   $product_image=$_FILES['product_image']['name'];
   $product_image_temp_name=$_FILES['product_image']['tmp_name'];
   $product_image_folder='images/'.$product_image;

   $insert_query=mysqli_query($conn,"INSERT INTO myproducts (name,price,image) VALUES
   ('$product_name','$product_price','$product_image') ") or die("Insert query failed");

   if($insert_query){
    move_uploaded_file( $product_image_temp_name,$product_image_folder);
    $display_message= "Product inserted successfully";
   }else{
    $display_message= "There is some error inserting product";
   }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script scr="js/bootstrap.min.js"></script>
      <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>Shopping Cart-Project</title>
        

</head>
<body>


<div class="container my-5">
        <h1>Welcome to Dashboard</h1>
 <!--the logout button place-->

    <!--include header-->
    <?php include('header.php') ?>
    
    

    <!--form section-->

    <div class="container">
      <!--message disp-->
      <?php
        if(isset($display_message)){
          echo   " <div class='display_message'>
          <span>'$display_message'</span>
          <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
        </div>";
        }
      ?>

      <section>
        <h3 class="heading">Attach Items Here</h3>
        <form action="" class="add_product" method="post" enctype="multipart/form-data">
          <input type="text" name="product_name" placeholder="Enter product name" class="input_fields" required>
          <input type="number" name="product_price" min="0" placeholder="Enter product price" class="input_fields" required>
          <input type="file" name="product_image" class="input_fields" required accept="image/png,image/jpg,image/jpeg">
          <input type="submit" name="add_product" class="submit_btn" value="ADD PRODUCT">
        </form>
      </section>
    </div>
    <script src="js/script.js"></script>






</body>
</html>
