<?php
session_start();
unset($_SESSION['useruid']);
$_SESSION = array();
session_unset();
setcookie(session_name(), '', time() - 2592000, '/');
session_destroy();
echo '<script type="text/JavaScript">alert("You have sucessfully log out! You will now be redirected back to the home page"); window.location.href="index.php"</script>';
?>