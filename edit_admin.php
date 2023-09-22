<?php
	session_start();
    include_once "session_time_out_admin.php"; 
	require_once('layouts/header.php'); 
	require_once('layouts/left_sidebar.php'); 
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admins_edit.php">Admin Edit and Update</a>
        </li>
        
      </ol>
      <?php

$servername = "localhost";
$Username = "root";
$password = "";
$database = "reden";


$conn = new mysqli($servername, $Username, $password, $database);

$id = "";
$name = "";
$email = "";
$username = "";
$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET'){

    if(! isset($_GET["id"])){
        header("location: admins_edit.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM admins WHERE adminsId=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: admins_edit.php");
        exit;
    }
    
    $name = $row["adminsName"];
    $phone = $row["adminsPhone"]; 

}
else{

    $id = $_POST["id"];
    $name = $_POST["name"];
    $phone = $_POST["phone"]; 
   
  
    do{
        if(empty($id)||empty($name)||empty($phone)){
            $errorMessage = "All the fields are required";
            break;
        }
        else if(!preg_match("/^[0-9]{10,11}$/", $phone)){
            $errorMessage = "Malaysia Phone Number should be made up of 10 or 11 digits";
            break;
        }
    
    
       
        $sql = "UPDATE admins " .
        "SET adminsName = '$name', adminsPhone = '$phone'" .
        "WHERE adminsId = $id";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: ". $conn->error;
            break;
        }

        
        $successMessage = "Admin updated correctly";
        header("location: admins_edit.php");
        exit;

    } while(true);

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>REDEN</title>
    <link rel="stylesheet" href="style3.0.css">
    <script src="https://kit.fontawesome.com/da8fe98f42.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">     

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>Update Admin</h2>

            <?php
            if(!empty($errorMessage)){
                echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                     <strong>$errorMessage</strong>
                     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>
                <?php
                if(!empty($successMessage)){
                    echo"
                    <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label></button>
                    </div>
                    </div>
                    </div>
                    ";
                }
                ?>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary" style = "padding: 5px 100px 5px 100px;">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="admins_edit.php" role="button" style = "padding: 5px 100px 5px 100px;">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </body>
</html>
<div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->
	
<?php require_once('layouts/footer.php'); ?>	