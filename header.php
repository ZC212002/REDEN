<?php
session_start();
include_once 'session_time_logout.php'
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>REDEN</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/da8fe98f42.js" crossorigin="anonymous"></script>
          <!-- Bootstrap CDN -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
   
       
    </head>
</html>
<body>

<div class = new_container>
<img src = "logo.png" height = "100px" width = "100px">

<ul class = "navigation_bar">

    <li><a href="index.php">HOME</a></li>
    <li><a href="products.php">PRODUCTS</a></li>
    <li><a href="About_us.php">ABOUT</a></li>
    <?php
    if(isset($_SESSION["useruid"])){
        echo"<li><a href='logout.inc.php'>LOG OUT</a></li>";
    }
    else{
        echo"<li><a href='sign_in.php'>SIGN IN</a></li>";
        echo"<li><a href='sign_up.php'>SIGN UP</a></li>";
    }
    ?>
</ul>
<?php
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<div class="link-icons">
    <a href="index.php?page=cart">
    <i class="fas fa-shopping-cart text-dark"><span><?php echo $num_items_in_cart?></span></i>
    </a>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>
