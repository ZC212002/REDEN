<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $Username = "root";
    $password = "";
    $database = "reden";


    $conn = new mysqli($servername, $Username, $password, $database);

    $sql = "DELETE FROM users WHERE usersId=$id";
    $conn->query($sql);

}
header("location: customer_edit.php");
exit;
?>