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
          <a href="product_edit.php">Product Edit and Update</a>
        </li>
        
      </ol>
      <?php
error_reporting(0);
$name = "";
$description ="";
$price ="";
$rrp ="";
$quantity ="";
$img ="";

$errorMessage ="";
$successMessage ="";

$servername = "localhost";
$Username = "root";
$password = "";
$database = "redentableproduct";


$conn = new mysqli($servername, $Username, $password, $database);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $rrp = $_POST["rrp"];
    $quantity = $_POST["quantity"];
    $img= $_FILES["img"];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];


    $fileExt = explode('.', $fileName);
    $imgname = $fileExt[0].".".$fileExt[1];
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg','png');
    function ProductNameExists($conn, $name){
        $sql = "SELECT * FROM redenproduct WHERE name = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: create_product.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
    
        mysqli_stmt_close($stmt);
    
    }
    


do{
    if(empty($name)||empty($description)||empty($price)||empty($rrp)||empty($quantity)||empty($img)){
        $errorMessage = "All the fields are required";
        break;
    }
    elseif(!preg_match("#[0-9]+#",$price)) {
        $errorMessage = "Price must be a number";
        break;
    }
    elseif(!preg_match("#[0-9]+#",$rrp)) {
        $errorMessage = "RRP must be a number";
        break;
    }
    elseif(!preg_match("#[0-9]+#",$quantity)) {
        $errorMessage = "Quantity must be a number";
        break;
    }
    else if(ProductNameExists($conn, $name) !== false){
        $errorMessage ="Product Name already existed!";
        break;
    }


    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 10000000){


            }else{
                $errorMessage = "Your files is too big";
                break;
            }

        }else{
            $errorMessage = "There was an error uploading your file!";
            break;

        }
    }else{
        $errorMessage = "You cannot upload files of this type!";
        break;
    }

   

    $sql = "INSERT INTO redenproduct (name, description, price, rrp, quantity, img)". 
           "VALUES ('$name', '$description', '$price', '$rrp', '$quantity', '$imgname')";
    $result = $conn->query($sql);

    if(!$result){
        $errorMessage = "Invalid query" . $connection->error;
        break;
    }
    


    $name = "";
    $description ="";
    $price ="";
    $rrp ="";
    $quantity ="";
    $img ="";

    $succssMessage = "Product added correctly";

    header("location: product_edit.php");
    exit;

   
   } while (false);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>Create Product</title>
    <link rel="stylesheet" href="style3.0.css">
    <script src="https://kit.fontawesome.com/da8fe98f42.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>New Product</h2>

            <?php
            if(!empty($errorMessage)){
                echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                     <strong>$errorMessage</strong>
                     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-6">
                        <input type="int" class="form-control" name="price" value="<?php echo $price; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">RRP</label>
                    <div class="col-sm-6">
                        <input type="int" class="form-control" name="rrp" value="<?php echo $rrp; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-6">
                        <input type="int" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="img" value="<?php echo $img; ?>">
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
                        <a class="btn btn-outline-primary" href="product_edit.php" role="button" style = "padding: 5px 100px 5px 100px;">Cancel</a>
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
