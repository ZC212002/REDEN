<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>REDEN</title>
    <link href="style3.0.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class= 'body'>
<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include 'dbcontroller.php';
$pdo = pdo_connect_mysql();
// session_unset();

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';

?>

</body>
</html>
<?php
include_once 'mainfooter.php';
?>
