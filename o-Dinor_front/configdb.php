<?php
$servername = "localhost";
$username = "root";
$password = "Plus888@";
$port = 3306;
$dbname = "o_dinor";


// Create connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
