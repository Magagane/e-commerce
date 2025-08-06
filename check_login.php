<?php
if(isset( $_POST['email'] ) && isset($_POST['password']) && isset($_POST['role'])){

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email=test_input( $_POST['email'] );
    $password=test_input( $_POST['password'] );
    $role=test_input( $_POST['role'] );

    if(empty($email)){
        header("Location:mylogin.php?error=User Name is Required");
    }else if(empty($password)){
        header("Location:mylogin.php?error=Password is Required");


    }else{
        echo "cool";
    }

}else{
    header("Location:mylogin.php");
}

?>