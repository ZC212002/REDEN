<?php
   include_once 'header.php';
?>


<section class="signup-form">
    <div class="signup-container">
    <div class = "login-logo">
        <img src = "kisspng-computer-icons-login-person-user-avatar-log-5b14db41cdf9b8.4558004515280935058437.png" height = "50px" width = "50px">
    </div>
    <h2>Log in</h2>
    <div class = "error_message">
<?php
if(isset($_GET["error"])){
    if($_GET["error"] == "emptyinput"){
        echo"<p>Fill in all fields!</p>";
    }
    else if($_GET["error"] == "wronglogin"){
        echo"<p>Incorrect login information</p>";
    }

}

?>
</div>
    <form class ="form" action="login.inc.php" method="post">
    <div class="field">
    <label><i class="fa fa-user"></i> Username/Email</label>
        <input type="text" name="uid" placeholder=""><br>
    </div> 
    <div class="field">
    <label><i class="fa fa-key" aria-hidden="true"></i> Password</label>
        <input type="password" name="pwd" placeholder=""><br>
    </div>
    <div class="field">
    <label>Role</label>
    <select name="role">
        <option>User</option>
        <option>Admin</option>
    </select>
    </div>
    <div class="field">
        <button type="submit" name="submit">Log in</button>
    </div>
    <div class = "signup_link">
            Not a member? <a href = "sign_up.php">Sign Up Now!</a>
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


