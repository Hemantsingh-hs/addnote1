<?php
// session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
$loggedin=true;
}
else{
  $loggedin=false;
}



echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="
    https://miro.medium.com/v2/resize:fit:763/1*3kV_QmhboTgiNEFn3LsY1A.png" alt="logo" 
    style="   height:40px;  width: 40px;
    vertical-align: middle;
    border-radius: 20px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/loginpage/welcome.php">Home</a>
        </li>
        
       ';
        if (!$loggedin){ 
        echo '<li class="nav-item">
        <a class="nav-link" href="/loginpage/index.php">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/loginpage/signup.php">Sign Up</a>
        </li>
        ';
        }
        
        if($loggedin){

        echo ' <li class="nav-item">
          <a class="nav-link" href="/loginpage/logout.php">Log Out</a>
        </li> 
        <li class="nav-item">
        <a class="nav-link "   href="/loginpage/aboutus.php">About Us</a>
      </li> 
      '; 
      
        }
  

      echo '</ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>';
       
?>