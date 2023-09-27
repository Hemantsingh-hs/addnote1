<?php 
$server="localhost";
$username="root";
$password="";
$database="user29";

$conn=mysqli_connect($server,$username,$password,$database);

if(!$conn){
  die("error".mysqli_connect_error());
}
//  


?>