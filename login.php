<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
    <div class="container">
        <?php
        if(isset($_POST["login"])){
            $email=$_POST["email"];
            $password=$_POST["password"];
            require_once "database.php";
            $sql="SELECT *FROM users WHERE email='$email'";
            $result=mysqli_query($conn,$sql);
            $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($user){
                if(password_verify($password,$user["password"])){
                    session_start();
                    $_SESSION["user"]="yes";
                    header("Location: home.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }

            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }

        ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">

    <form action="login.php" method="post" class="border shadow p-3 rounded" style="width: 450px;">
        
        <div class="mb-5">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
        </div>

        <div class="mb-5">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>

        <div class="mb-0">
            <label class="form-label">Select User Type:</label>
        </div>

        <div class="mb-5">
            <!--try putting option here-->
            <select class="form-select mb-5" aria-label="Default select example">
                <option selected value="user">User</option>
                <option value="admin">Admin</option>


            </select>
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
        <div><p>Not 'registered' yet <a href="registration.php">Register Here</a></p></div>

    </form>
    </div>
    </div>

</body>
</html>