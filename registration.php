<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
   <!----> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!----><link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script scr="js/bootstrap.min.js"></script>
        <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


 
</head>
<body>
    <div class="registration-container">
        <?php
       // print_r($_POST);

       if(isset($_POST["submit"])){
        $fullName=$_POST["fullname"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $passwordRepeat=$_POST["repeat_password"];
        
        $passwordHash=password_hash($password,PASSWORD_DEFAULT);
        $errors=array();

        if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){

            array_push($errors,"All fiels are required");

        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors,"Email is not valid");
        }if(strlen($password) < 8){
            array_push($errors,"Password must be at least 8 characters long");
        }
        if($password!==$passwordRepeat){
            array_push($errors,"Password does not match"); 
        }
        require_once "database.php";
        $sql="SELECT* FROM users WHERE email='$email'";
        //$result=mysqli_query($sql);
        $result=mysqli_query($conn, $sql);
        $rowCount=mysqli_num_rows($result);
        if($rowCount>0){
            array_push($errors,"Email already exists!");
        }

        if(count($errors)>0){
            foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{
           
            $sql="INSERT INTO users(full_name,email,password) VALUES ( ?, ?, ?)";
            $stmt=mysqli_stmt_init($conn);
            $prepareStmt=mysqli_stmt_prepare( $stmt,$sql);
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt,"sss", $fullName,$email,$passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully</div>";   
            } else{
                die("Something went wrong");
            }

        }

    }

        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">

        <form action="registration.php" method="post" class="border shadow p-3 rounded" style="width: 450px;">
            <div class="mb-5">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
                        <div class="mb-5">
                <input type="email" class="form-control"  name="email" placeholder="Email:">
            </div>
                        <div class="mb-5">
                <input type="password" class="form-control"  name="password" placeholder="Password:">
            </div>
                        <div class="mb-5">
                <input type="password" class="form-control"  name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="mb-5">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
            <div><p>Already registered?<a href="login.php">Login Here</a></p></div>
        </form>
        

    </div>
    </div> 
</body>
</html>