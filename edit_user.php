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
          <a href="customer_edit.php">Customer Edit and Update</a>
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
$fname = "";
$phone ="";
$address ="";
$city = "";
$state ="";
$zip = "";
$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET'){

    if(! isset($_GET["id"])){
        header("location: customer_edit.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM users WHERE usersId=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: customer_edit.php");
        exit;
    }
    
    $name = $row["usersName"];
    $fname = $row["billingName"];
    $phone = $row["usersPhone"]; 
    $address = $row["usersAddress"]; 
    $city = $row["usersCity"]; 
    $state = $row["usersState"]; 
    $zip = $row["usersZip"]; 
   

}
else{

    $id = $_POST["id"];
    $name = $_POST["name"];
    $fname = $_POST["fname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $malaysia_state = array('johor', 'kedah','kelantan','malacca','negeri sembilan','pahang','penang','perak','perlis','sabah','sarawak','selangor','terrenganu');
   
   require_once 'functions.inc.php';
    do{
        if(empty($id)||empty($name)||empty($fname)||empty($phone)||empty($address)||empty($city)||empty($state)||empty($zip)){
            $errorMessage = "All the fields are required";
            break;
        }else if(!preg_match("/^[0-9]{10,11}$/", $phone)){
            $errorMessage = "Malaysia Phone Number should be made up of 10 or 11 digits";
            break;
        }else if(!in_array(strtolower($state),$malaysia_state)){
            $errorMessage = "Not a valid State";
            break;
        }else if(!preg_match("/^[0-9]{5}$/", $zip)){
            $errorMessage = "Zip code should be 5 digits";
            break;
        }
    

        $sql = "UPDATE users " .
        "SET usersName = '$name', billingName = '$fname', usersPhone = '$phone', usersAddress = '$address', usersCity = '$city', usersState = '$state', usersZip = '$zip'" .
        "WHERE usersId = $id";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: ". $conn->error;
            break;
        }

        
        $successMessage = "Client updated correctly";
        header("location: customer_edit.php");
        exit;

    } while(true);

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>Update User</title>
    <link rel="stylesheet" href="style3.0.css">
    <script src="https://kit.fontawesome.com/da8fe98f42.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>Update Client Details</h2>

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
                    <label class="col-sm-3 col-form-label">Billing Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">State</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="state" value="<?php echo $state; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Zip</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>">
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
                        <button type="submit" class="btn btn-primary" style = "padding: 5px 100px 5px 100px;">Update</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="customer_edit.php" role="button" style = "padding: 5px 100px 5px 100px;">Cancel</a>
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