<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'redentableproduct';
    try {
    	return new PDO('mysql:host=' . $hostname . ';dbname=' . $dbname . ';charset=utf8', $username, $password);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}

?>