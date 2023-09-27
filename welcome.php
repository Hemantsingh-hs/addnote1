<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location:index.php");
    exit;
  } else {
 
  $user=false;


    // Get the username from the PHP session
    $username = $_SESSION['username'];
    $aboutus=true;
    


    
  
  }
  
 
  
    


?>


<?php
$insert = false;
$update = false;
$delete = false;



$servername = "localhost";
$username = "root";
$password = "";
$database = "note";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("sorry we faild to connect :" . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
  
  $sno = $_GET['delete'];
  $delete = true;
  $sql = " DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    //update the record

    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];
    $sql = " UPDATE `notes` SET `title` = '$title'  , `description`='$description' 
          WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    // exit();
    if ($result) {
      // echo "Recored inserted  has been  successfully <br>";
      $update = true;
    } else {
      echo "recored was  not update beacause this error --->" . mysqli_error($conn);
    }
  } else {
    $title = $_POST["title"];
    $insert = true;
    $description = $_POST["description"];
    $sql = " INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) 
          VALUES (NULL,'$title', '$description', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // echo "Recored inserted  has been  successfully <br>";
      $insert = true;
    } else {
      echo "recored was  not inserted  beacause this error --->" . mysqli_error($conn);
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>welcome -<?php echo $_SESSION['username'] ?></title>
    <!-- <title>Notes-Making </title> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
 
 <style>
        /* Add your custom styles here */
        /* Responsive styles */
       
    </style>
  </head>
  <body>
<?php
require 'partials/_nav.php';
?>


<div id="alertContainer" class="container my-2"></div>



<?php

if (!$insert && !$delete && !$update) {
   $user=true;
  $username = $_SESSION['username'];
    echo "<script>
      var username = '$username';

      function showAlert(message, alertType) {
        const alertContainer = document.getElementById('alertContainer');
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-success alert-dismissible fade show`;
        alertDiv.innerHTML = `
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          Welcome-${username}!<br>THANKS FOR LOGIN.<br>WELCOME TO NOTE MAKING WEBSITE.
        `;
        alertContainer.appendChild(alertDiv);
        setTimeout(() => {
          alertDiv.remove();
        }, 3000); // Remove the alert after 3 seconds (3000 milliseconds)
      }

      showAlert('', 'success'); // Display the alert with the stored username
    </script>";
}
?>

    

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- modal body start  -->
          <form action="/loginpage/welcome.php" method="POST">
            <input type="hidden" name="snoEdit" id="snoEdit" />
            <div class="mb-3">
              <label for="tile" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" placeholder="Enter Your Title">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>

        </div>
        </form>
        <!-- model body end  -->
      </div>
      
    </div>
  </div>
  </div>

  
  <?php
  if ($insert) {
    // echo "add note ".var_dump($user);


 
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note is Added Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div> ";
  
}

  ?>
  <?php
  if ($update) {
   
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note has been update Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div> ";
  
  }
  ?>
  <?php
  if ($delete) {
   
    // $user=false;
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note has been delete Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div> ";
  }

  ?>
  <!-- nav bar above code  -->
  <div class="container my-4">
<div class="row">

  <h3 class="col-md-3">Add Your Notes-</h3> 
  <h4  class="col-md-3" style="color: rgb(34,139,34) ; "><?php  $username = $_SESSION['username'];
  echo strtoupper($username)?></h4>
</div>
     
    
    <form action="/loginpage/welcome.php" method="POST">
      <div class="mb-3">
        <label for="tile" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Your Title">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>

  </div>
  </form>
  <div class="container ">

    <!-- table  -->
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.NO</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);

        //find the number of records returned

        // echo "The number of rows are =" . mysqli_num_rows($result);

        $sno = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<br>";
          // echo var_dump($row);
          // <th scope='row'>" . $row['sno'] . "</th>
          echo "<tr>
          <th scope='row'>" . $sno . "</th>
          <td>" . $row['title'] . "</td>
          <td>" . $row['description'] . "</td>
          <td><button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button>
          <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button></td>
      </tr>";
          $sno += 1;
          // echo $row['sno'] . ". Your title is " . $row['title'] . " desc is " . $row['description'];
        }


        ?>
      </tbody>
    </table>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {

      element.addEventListener("click", (e) => {
        console.log('edit', );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;

        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        descriptionEdit.value = description;
        titleEdit.value = title;
        snoEdit.value = e.target.id;
        $('#editModal').modal('toggle');

      });

    });

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {

      element.addEventListener("click", (e) => {
        console.log('delete', );
        sno = e.target.id.substr(1, );
        if (confirm("Do you want to delete this Record")) {
          console.log("Yes");
          window.location = `/loginpage/welcome.php?delete=${sno}`;
        } else {
          console.log("No")

        }
      });

    });
  </script>


<footer class="bg-light text-center text-lg-start "  style="margin-top:30px">
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




  