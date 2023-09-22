<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $Username = "root";
    $password = "";
    $database = "redentableproduct";


    $conn = new mysqli($servername, $Username, $password, $database);

    $sql = "DELETE FROM redenproduct WHERE id=$id";
    $conn->query($sql);

}
header("location: product_edit.php");
exit;
?>