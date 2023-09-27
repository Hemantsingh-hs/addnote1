<!-- //first connect with your database  -->
<?php
$insert = false;
$update = false;
$delete = false;
//  INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) 
//  VALUES (NULL, 'Delhi Visit places', 'There is so many places in delhi which is historical for example lotus temple,shiv park etc', current_timestamp());
$servername = "localhost";
$username = "root";
$password = "";
$database = "note";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("sorry we faild to connect :" . mysqli_connect_error());
}
//  else {

//   echo "connection is successfully ";
// }
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
  <title>Notes-Making </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</head>

<body>

  <!-- edit modal in delete and edit button  -->
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- modal body start  -->
          <form action="/crud/index.php" method="POST">
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
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
  </div>

  <!-- this whole code of modal  -->
  <nav class="navbar navbar-dark bg-primary navbar-expand-lg  ">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="crud.svg.png" alt="logo" style="    width: 50px;
    vertical-align: middle;
    border-radius: 10px;" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if ($insert) {
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
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note has been delete Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div> ";
  }
  ?>
  <!-- nav bar above code  -->
  <div class="container my-4">

    <h3>Add Your Notes</h3>
    <form action="/crud/index.php" method="POST">
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
          window.location = `/crud/index.php?delete=${sno}`;
        } else {
          console.log("No")

        }
      });

    });
  </script>
</body>

</html>