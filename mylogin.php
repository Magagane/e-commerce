<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script scr="js/bootstrap.min.js"></script>
        <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center"
    style="min-height: 100vh">
    <form class="border shadow p-3 rounded" style="width:450px">
    <h1 class="text-center p-3">LOGIN</h1>
        <div class="mb-3">
            <label for="email" class="form-label">User name</label>
            <input type="text"  class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text"  class="form-control" name="password">
        </div>
        <div class="mb-1">
            <label class="form-label">Select User Type:</label>
        </div>
        <select class="form-select" aria-label="Default select example">
            <option selected value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>

    </div>
    
</body>
</html>