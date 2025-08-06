<!--delete logic-->


<!--php cod-->
<?php
include 'connect.php';
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    //echo $delete_id;
    $delete_query=mysqli_query($conn,"DELETE FROM myproducts WHERE id=$delete_id") or 
    die("Query failed");
    if($delete_query){
        echo "Product not deleted";
        header('Location:view_product.php');
    }else{
        echo "Product not deleted";
        header('Location:view_product.php');

    }
}

?>