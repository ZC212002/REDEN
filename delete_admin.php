<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $Username = "root";
    $password = "";
    $database = "reden";


    $conn = new mysqli($servername, $Username, $password, $database);

    $sql = "DELETE FROM admins WHERE adminsId=$id";
    $conn->query($sql);

}
header("location: admins_edit.php");
exit;
?>