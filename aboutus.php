
<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:index.php");
    exit;
  } else {
 
//   $user=false;


    // Get the username from the PHP session
    // $username = $_SESSION['username'];
    $aboutus=true;
    


    
  
  }
  
 
  

// session_start();
if(header($aboutus)){
$loggedin=true;
}
else{
  $loggedin=false;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About-Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <style>



 
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

.about-us{
  height: 100vh;
  width: 100%;
  padding: 90px 0;
  background: #ddd;
}
.pic{
  height: auto;
  width:  302px;
}
.about{
  width: 1130px;
  max-width: 85%;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
}
.text{
  width: 540px;
}
.text h2{
  font-size: 90px;
  font-weight: 600;
  margin-bottom: 10px;

}
.text h5{
  font-size: 22px;
  font-weight: 500;
  margin-bottom: 20px;
}
span{
  color: #4070f4;
}
.text p{
  font-size: 18px;
  line-height: 25px;
  letter-spacing: 1px;
}
.data{
  margin-top: 30px;
}
.hire{
  font-size: 18px;
  background: #4070f4;
  color: #fff;
  text-decoration: none;
  border: none;
  padding: 8px 25px;
  border-radius: 6px;
  transition: 0.5s;
}
.hire:hover{
  background: #000;
  border: 1px solid #4070f4;
}
.about img{
    border-radius: 80px;
    width: 300px;
}
.about-us h2{
    font-size: 50px;
    
}
.text p{
    font-size: 15px;
}
@media (max-width: 768px) {
        /* Adjust the section for smaller screens */
        .about-us {
            padding: 30px 0;
        }
        .about {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .pic {
            width: 100%;
            max-width: 300px;
            margin-top: 20px;
        }
        .text {
            width: 90%; /* Adjust the text width for better readability on small screens */
        }
        .text h2 {
            font-size: 40px; /* Reduce the font size for smaller screens */
        }
        .text h5 {
            font-size: 18px; /* Reduce the font size for smaller screens */
        }
        .text p {
            font-size: 14px; /* Reduce the font size for smaller screens */
        }
    }
 </style>
 <body>
    <?php
  require 'partials/_nav.php';
  ?>

  <section class="about-us">
  <div class="about">
    <img  src="partials/hemant.jpeg" class="pic">
    <div class="text">
      <h2>About Us</h2>
      <h5>Front-end Developer </h5>
        <p>Welcome to My Website Add Note .My name is Hemant Singh Graduate  in Bachelor of Science in Mathematics (Honours) from Delhi University and has a strong educational foundation that brings a unique perspective to our work.
             my academic journey began at Banasthali Board,As Front-end developers are the coders of all the user-facing elements of websites, web applications, and mobile applications. They interpret the needs of the company and its customers and create easy-to-use, interactive web apps. 
            Front-end developers must be adept at both programming languages and design techniques.</p>
      <div class="data">
      <a href="#" class="hire">Contact Me</a>
      </div>
    </div>
  </div>
</section> 

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
  
 




 
  
