<?php
$servername = "localhost";
$username = "root";
$password = "";
$port = 4306;
$dbname = "o_dinor";


// Create connection

$conn = new mysqli($servername, $username, $password, $dbname,$port);




// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
