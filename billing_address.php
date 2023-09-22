<?php
include_once "header.php";
?>
<?php

$fname = "";
$phone ="";
$address ="";
$city = "";
$state ="";
$zip = "";
$cardname ="";
$cardnumber ="";
$expmonth ="";
$expyear ="";
$cvv ="";
$useruid = "";

$errorMessage ="";
$successMessage ="";

$servername = "localhost";
$Username = "root";
$password = "";
$database = "reden";


$conn = new mysqli($servername, $Username, $password, $database);

if (isset($_SESSION['useruid']))
{
  $useruid = htmlspecialchars($_SESSION['useruid']);
  $sql = "SELECT * FROM users WHERE usersUid='$useruid'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if(!$row){
      header("location: index.php");
      exit;
  }

    $fname = $row["billingName"];
    $phone = $row["usersPhone"]; 
    $address = $row["usersAddress"]; 
    $city = $row["usersCity"]; 
    $state = $row["usersState"]; 
    $zip = $row["usersZip"]; 
    $cardname = $row["usersNameCard"]; 
    $cardnumber = $row["usersCreditCardNumber"]; 
    $expmonth = $row["usersCreditCardExpM"]; 
    $expyear = $row["usersCreditCardExpY"]; 
    $cvv = $row["usersCreditCardCVV"]; 
}
else{

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $fname = $_POST["fname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $cardname = $_POST["cardname"];
    $cardnumber = $_POST["cardnumber"];
    $expmonth = $_POST["expmonth"];
    $expyear = $_POST["expyear"];
    $cvv = $_POST["cvv"];
    $malaysia_state = array('johor', 'kedah','kelantan','malacca','negeri sembilan','pahang','penang','perak','perlis','sabah','sarawak','selangor','terrenganu');
    $month = array(1,2,3,4,5,6,7,8,9,10,11,12);
 

do{

    if (isset($_SESSION['useruid']))
    {
      $useruid = htmlspecialchars($_SESSION['useruid']);
    }
      else{
          $errorMessage = "Please Login first";  
          break;
  
     }

    if(empty($fname)||empty($phone)||empty($address)||empty($city)||empty($state)||empty($cardname)||empty($cardnumber)||empty($expmonth)||empty($expyear)||empty($expyear)){
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
    else if(!preg_match("/^[0-9]{16}$/", $cardnumber)){
        $errorMessage = "Card number should be 16 digits";
        break;
    }else if(!in_array($expmonth,$month)){
        $errorMessage = "Not a valid month";
        break;
    }else if(!preg_match("/^[0-9]{2}$/", $expyear)){
        $errorMessage = "Year should only be 2 digits. For example: 2024 = 24";
        break;
    }else if(!preg_match("/^[0-9]{3}$/", $cvv)){
        $errorMessage = "CVV should be 3 digits";
        break;
    }


    $sql = "UPDATE users ".
    "SET billingName = '$fname', usersPhone = '$phone', usersAddress = '$address', usersCity = '$city', usersState = '$state', usersZip = '$zip', usersNameCard  = '$cardname', usersCreditCardNumber = '$cardnumber',usersCreditCardExpM = '$expmonth',usersCreditCardExpY = '$expyear', usersCreditCardCVV = '$cvv'". 
    "WHERE usersUid = '$useruid'";
    $result = $conn->query($sql);

    if(!$result){
    $errorMessage = "Invalid query" . $connection->error;
    break;
}
$fname = "";
$phone ="";
$address ="";
$city = "";
$state ="";
$zip = "";
$cardname ="";
$cardnumber ="";
$expmonth ="";
$expyear ="";
$cvv ="";
$useruid="";

unset($_SESSION['cart']);
header('Location: index.php?page=placeorder');
   
   } while (false);
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class ="web-color">
    <div class="billing-container">
      <form method="post">
      <?php
            if(!empty($errorMessage)){
                echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                     <strong>$errorMessage</strong>
                     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>❌</button>
                </div>
                ";
            }
            ?>
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
        
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" name = "fname" placeholder=""  value="<?php echo $fname; ?>">
            <label for="phone"><i class="fa fa-phone" aria-hidden="true"></i> Phone</label>
            <input type="text" name="phone" placeholder=""  value="<?php echo $phone; ?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" name="address" placeholder=""  value="<?php echo $address; ?>">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" name="city" placeholder=""  value="<?php echo $city; ?>">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" name="state" placeholder=""  value="<?php echo $state; ?>">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" name="zip" placeholder=""  value="<?php echo $zip; ?>">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" name="cardname" placeholder=""  value="<?php echo $cardname; ?>">
            <label for="ccnum">Credit card number</label>
            <input type="text" name="cardnumber" placeholder=""  value="<?php echo $cardnumber; ?>">
            <label for="expmonth">Exp Month</label>
            <input type="text" name="expmonth" placeholder=""  value="<?php echo $expmonth; ?>">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" name="expyear" placeholder=""  value="<?php echo $expyear; ?>">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" name="cvv" placeholder=""  value="<?php echo $cvv; ?>">
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="billing_btn">Continue to check out</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<footer class="footer2">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                     <h4>company</h4>
                    <ul>
                        <li><p><Strong>Address: </Strong>
2, Persiaran Jalil 8, Bukit Jalil, 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p></li>
                        <li><p><Strong>Contact: </Strong>+60 102219767</p></li>
                        <li><p><Strong>Hours: </Strong>8.00 - 18.00, Mon - Sun</p></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="About_us.php">About Us</a></li>
                        <li><a href="sign_in.php">Sign In</a></li>
                        <li><a href="billing_address.php">Payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="products.php">Products</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><img src = "Whatsapp.png"></a>
                        <a href="#"><img src = "pngegg.png"></a>
                        <a href="#"><img src = "Instagram-logo-clipart-PNG.png"></a>
                        <a href="#"><img src = "fb.png"></a>
                    </div>
                </div>
            </div>
            <hr>
            <p class = "copy">Copyright @ 2022 RE-DEN Sdn Bhd. Project by CJ & ZM Web Design</p>
        </div>
    </div>
    </footer>