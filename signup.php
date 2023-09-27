<?php
$showAlert = false;
$showError=false;
$showErrorPass=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'partials/_dbconnect.php';

  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];


  //check whether the username is exist  or not;

  $existSql="SELECT * FROM  `user` WHERE `username`='$username'";
  $result=mysqli_query($conn,$existSql);
  $numRowExist=mysqli_num_rows($result);
  if($numRowExist>0){
    // $exist=true;
    $showError=true;
  }else{
  // $exist = false;
  if (($password == $cpassword) ) {
    $hash=password_hash($password,PASSWORD_ARGON2I);
    $sql = "INSERT INTO `user` ( `username`, `password`, `dt`)
   VALUES ( '$username', '$hash', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showAlert = true;
    }
  }
  else{
  $showErrorPass=true;
  }
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>sign up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  </style>

</head>

<body>

  <?php
  require 'partials/_nav.php';
  ?>
  <!-- alert  -->

  <?php
  if ($showAlert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>success!</strong> Your account has been created successfully click to login button.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }

  if ($showError) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>error!</strong> username already exist Please take unique username.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  if ($showErrorPass) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>error!</strong> password do not match.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>
  
  <!-- /alert -->

  <div class="container">
    <h2 class="text-center">Sign up to website</h2>

    <form action="/loginpage/signup.php" method="post">

      <div class="mb-3 ">
        <label for="username" class="form-label">UserName</label>
        <input type="text" maxlength="17" name="username" class="form-control" id="username" aria-describedby="emailHelp">
      </div>
      <div class="mb-3 ">
        <label for="password" class="form-label">Password</label>
        <input type="password"   maxlength="22" name="password" class="form-control" id="password">
      </div>
      <div class="mb-3  ">
        <label for="cpassword" class="form-label">Confirm Password</label>
        <input type="password" name="cpassword" class="form-control" id="cpassword">
      </div>
      <!-- <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div> -->
      <!-- <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" name="pass" class="form-control" id="pass">
    </div> -->

      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
  </div>
  <div style="margin: 8%;">

</div>
  <footer class="bg-light text-center text-lg-start" style="margin-top:30px">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
     All Rights Reserved By Hemant Singh © 2023 Copyright:
    <a class="text-dark" href="#">AddNote.com</a>
  </div>
  <!-- Copyright -->
</footer>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>