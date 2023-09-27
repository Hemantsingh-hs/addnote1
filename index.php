<!-- // require 'partials/_nav.php' -->
<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'partials/_dbconnect.php';

  $username = $_POST["username"];
  $password = $_POST["password"];

  //   $sql = "INSERT INTO `user` ( `username`, `password`, `dt`)
  //  VALUES ( '$username', '$password', current_timestamp())";
  //  $sql="SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'";
  $sql = "SELECT * FROM `user` WHERE `username`='$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  // echo $num ;
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location:welcome.php");
      }
      else{
        $showError = true;
      }
    }
    // $login = true;

  } else {
    $showError = true;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
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
  if ($login) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>success!</strong> Your account login successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }

  if ($showError) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>error!</strong>    incorrect username or password ..please  enter valid username or password .
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>
  <!-- /alert -->

  <div class="container">
    <h2 class="text-center">Login</h2>

    <form action="/loginpage/index.php" method="post">

      <div class="mb-3 ">
        <label for="username" class="form-label">UserName</label>
        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
      </div>
      <div class="mb-3 ">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>

   

      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
<div style="margin: 15%;">

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