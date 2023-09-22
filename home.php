<?php
$stmt = $pdo->prepare('SELECT * FROM redenproduct ORDER BY dateadded DESC LIMIT 3');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="style3.0.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

<?php
include_once "header.php"
?>

<div class = "About-container">
    <div class =  "prod-row">
        <div class = "pro-col">
            <img src = "homebags.png" width = "70%" id = "product-img">      
        </div>
        <div class = "about-col">
            <h3>Make your personal denim bag</h3>
            <p style="font-size:25px">Just choose the design that you are interested in and send your unwanted denim pants to us!</p>
            <a href = "products.php" class = "About-button">Buy now</a>
        </div>
    </div>
</div>

<div class="how">
  <h3>How does it works?</h3>
</div>

<div class= "arrow">
  <div class="arrowinner">
  <img src="first-steps.png" alt="step1" style="width:30%">
  <p>Navigate to the products page to choose the design you are interested in!</p>
  </div>
  <div class="arrowway">
  <img src="right-arrow.png" alt="arrow" style="width:15%">
  </div>
  <div class="arrowinner">
  <img src="step-2.png" alt="step1" style="width:30%">
  <p>Once you are confirmed with the interested design, add it into the cart!</p>
  </div>
  <div class="arrowway">
  <img src="right-arrow.png" alt="arrow" style="width:15%">
  </div>
  <div class="arrowinner">
  <img src="infographics.png" alt="step1" style="width:25%">
  <p>At the cart page, click on the "place order" button to make an order!</p>
  </div>
  <div class="arrowway">
  <img src="right-arrow.png" alt="arrow" style="width:15%">
  </div>
  <div class="arrowinner">
  <img src="four.png" alt="step1" style="width:15%">
  <p>Remember to register as a member before checking out! Once your order is made, please send your denim old pants to the address we pin-point!</p>
  </div>
</div>

<style>
.mySlides {display:none;}
</style>
</head>

<body>

<div class="w3-content w3-section" style="max-width:100%, height:50%">
  <img class="mySlides" src="Denim handbag.jpg" style="width:100%">
  <img class="mySlides" src="Denim handbag0.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
</body>
</html>

<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                RM<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">RM<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

