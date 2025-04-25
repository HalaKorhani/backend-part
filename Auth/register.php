<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/register.css">
    <title>Registration</title>
    <title>register</title>
</head>
<body>
    <h1 class="register">Registration</h1>
    <div class="container">
        <form action="../DataAuth/register.php" method="POST">
        <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">First Name</label>
    <input name="fname" type="text" class="form-control" id="exampleInputEmail1" required>
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Last Name</label>
    <input name="lname" type="text" class="form-control" id="exampleInputEmail1" required>
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Address</label>
    <input name="address" type="text" class="form-control" id="exampleInputEmail1" required>
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" required>
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Password</label>
    <input name="password" type="text" class="form-control" id="exampleInputEmail1" required>
</div>
