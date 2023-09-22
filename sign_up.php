<?php
   include_once 'header.php';
?>

<section class="signup-form">
    <div class="signup-container">
    <div class = "login-logo">
        <img src = "kisspng-computer-icons-login-person-user-avatar-log-5b14db41cdf9b8.4558004515280935058437.png" height = "50px" width = "50px">
    </div>
    <h2>Sign Up</h2>
    <div class = "error_message">
    <?php
if(isset($_GET["error"])){
    if($_GET["error"] == "emptyinput"){
        echo"<p>Fill in all fields!</p>";
    }
    else if($_GET["error"] == "invalidemail"){
        echo"<p>Choose a proper email!</p>";
    }
    else if($_GET["error"] == "invaliduid"){
        echo"<p>Username should be at least 3 words and not more than 20 words</p>";
    }
    else if($_GET["error"] == "invalidpwd"){
        echo"<p>Password should be at least one lowercase letter,at least one uppercase letter at least one number, and there have to be 8-20 characters</p>";
    }
    else if($_GET["error"] == "passworddontmatch"){
        echo"<p>Password doesn't match!</p>";
    }
    else if($_GET["error"] == "stmtfailed"){
        echo"<p>Something went wrong, try again!</p>";
    }
    else if($_GET["error"] == "usernametaken"){
        echo"<p>Username or Email already taken!</p>";
    }
    else if($_GET["error"] == "none"){
        echo '<script type="text/JavaScript">alert("You have sucessfully signed up! You can now sign in at the login page."); window.location.href="sign_in.php"</script>';
    }
}
?>
    </div>
    <form class ="form" action="signup.inc.php" method="post">
    <div class="field">
    <label><i class="fa fa-user"></i> Full Name</label>
        <input type="text" name="name" placeholder="">
    </div> 
    <div class="field">
    <label><i class="fa fa-envelope"></i> Email</label>
        <input type="text" name="email" placeholder="">
    </div>
    <div class="field">
    <label><i class="fa fa-user"></i> Username</label>
        <input type="text" name="uid" placeholder="">
    </div>
    <div class="field">
    <label><i class="fa fa-key" aria-hidden="true"></i> Password</label>
        <input type="password" id="pwd" name="pwd" placeholder="">
    <div id="psw_re">
                  <h3>Password must contain the following:</h3>
                  <p id="letter" class="invalid">At least one <b>lowercase</b> letter</p>
                  <p id="capital" class="invalid">At least one <b>capital (uppercase)</b> letter</p>
                  <p id="number" class="invalid">At least one <b>number</b></p>
                  <p id="length" class="invalid">At least <b>8 characters</b></p>
    </div>
    </div>
    <div class="field">
    <label><i class="fa fa-key" aria-hidden="true"></i> Repeat Password</label>
        <input type="password" name="pwdrepeat" placeholder="">
    </div>
    <div class="field">
        <button type="submit" name="submit">Sign Up</button>
    </div>
    </form>

    </div>

 

</section>
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



<script>
var password = document.getElementById("pwd");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


password.onfocus = function() {
    document.getElementById("psw_re").style.display = "block";
}

password.onblur = function() {
    document.getElementById("psw_re").style.display = "none";
}

password.onkeyup = function() {
    
    var lowerCaseLetters = /[a-z]/g;
    if(password.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }
    
  
    var upperCaseLetters = /[A-Z]/g;
    if(password.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }
  
    var numbers = /[0-9]/g;
    if(password.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
    

    if(password.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }


</script> 







