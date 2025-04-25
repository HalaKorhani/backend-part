<!DOCTYPE html>
<?php session_start(); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h3 class="login">Login</h3>
        <form action="../DataAuth/login.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary mb-3 mt-3">Submit</button>
        </form>
    </div>
</body>
</html>
