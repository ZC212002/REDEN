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
          <a href="product_edit">Product Edit and Update</a>
        </li>
       </ol>
        <?php

$servername = "localhost";
$Username = "root";
$password = "";
$database = "redentableproduct";


$conn = new mysqli($servername, $Username, $password, $database);

$name = "";
$description ="";
$price ="";
$rrp ="";
$quantity ="";
$img ="";

$errorMessage ="";
$successMessage ="";

if( $_SERVER['REQUEST_METHOD'] == 'GET'){

    if(! isset($_GET["id"])){
        header("location: product_edit.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM redenproduct WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: customer_edit.php");
        exit;
    }
    
    $name = $row["name"];
    $description = $row["description"]; 
    $price = $row["price"]; 
    $rrp = $row["rrp"]; 
    $quantity = $row["quantity"]; 
    $img = $row["img"]; 

}
else{
    
    $id = $_POST["id"];
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
    


do{
    if(empty($name)||empty($description)||empty($price)||empty($rrp)||empty($quantity)){
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
    }elseif(!empty($fileTmpName)){

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

    }

        $sql = "UPDATE redenproduct " .
        "SET name = '$name', description = '$description', price = '$price', rrp = '$rrp', quantity = '$quantity'" .
        "WHERE id = $id";
    
    if(!empty($fileTmpName)){
        $sql = "UPDATE redenproduct " .
        "SET name = '$name', description = '$description', price = '$price', rrp = '$rrp', quantity = '$quantity', img = '$imgname'" .
        "WHERE id = $id";
    }
        

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: ". $conn->error;
            break;
        }

        
        $successMessage = "Product updated correctly";
        header("location: product_edit.php");
        exit;

    } while(true);

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
            <h2>Update Product</h2>

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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                include_once "dbcontroller.php";
                $pdo = pdo_connect_mysql();
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM redenproduct WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Product does not exist!');
    }
} else {
    exit('Product does not exist!');
}
?>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Old Image</label>
                    <div class="col-sm-6">
                    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
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