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
$name = "";
$email ="";
$username ="";
$password ="";
$errorMessage ="";
$successMessage ="";

$servername = "localhost";
$Username = "root";
$password = "";
$database = "reden";


$conn = new mysqli($servername, $Username, $password, $database);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'functions.inc.php';

do{
    if(empty($name)||empty($email)||empty($username)||empty($password)){
        $errorMessage = "All the fields are required";
        break;
    }

    else if(invalidUid($username) !== false){
        $errorMessage ="Username should be at least 3 words and not more than 20 words";
        break;
    }
    
    else if(invalidEmail($email) !== false){
        $errorMessage ="Choose a proper email!";
        break;
    }
    
    else if(invalidPwd($password) !== false){
        $errorMessage ="Password should be at least one lowercase letter,at least one uppercase letter at least one number, and there have to be 8-12 characters";
        break;
    }
    
    else if(uidExists($conn, $username, $email) !== false){
        $errorMessage ="Username or Email already taken!";
        break;
    }

    $sql = "INSERT INTO users(usersName, usersEmail, usersUid, usersPwd) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: create_customer.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $successMessage = "Client added correctly";

    header("location: customer_edit.php");
    exit;


    $name = "";
    $email ="";
    $username ="";
    $password ="";

   
   } while (false);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>REDEN</title>
    <link rel="stylesheet" href="style3.0.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>New Client</h2>

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
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"><i class="mdi mdi-email-alert:">Email</i></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
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
