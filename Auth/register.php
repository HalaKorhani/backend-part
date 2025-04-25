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
<label for="">Select Gender</label>
<select required name="gender" class="form-select" aria-label="Default select example">
    <option value="" disabled>Select Gender</option>
    <?php
    require_once("../connection.php");
    $sql="SELECT gender.id , gender.name FROM gender ";
    $stmt = $pdo ->prepare($sql);
    $stmt ->execute();
    $genders = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    if(!$genders){
    ?>
    <option value ="">None</option>
    <?php 
    }else{
        foreach($genders as $gender){
    ?>
    <option value="<?php echo $gender["id"] ?>"><?php echo $gender["name"]?></option>
    <?php
        }
    }
    ?> 
</select>

<label for="">Select Country</label>
<select required name="country" class="form-select" aria-label="Default select example">
    <option value="" disabled>Select Country</option>
    <?php
    require_once("../connection.php");
    $sql="SELECT nationalytie.id,nationalytie.Country FROM nationalytie";
    $stmt = $pdo ->prepare($sql);
    $stmt ->execute();
    $nationalytie = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    if(!$nationalytie){
    ?>
    <option value ="">None</option>
    <?php 
    }else{
        foreach($nationalytie as $nat){
    ?>
    <option value="<?php echo $nat["id"] ?>"><?php echo $nat["Country"]?></option>
    <?php
        }
    }
    ?> 
</select>
<button type="submit" class="btn btn-primary mb-3 mt-3">Submit</button>
</form>
