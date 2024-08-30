<?php
$servername = "localhost";
$username = "root";
$password = "Plus888@";
$dbname = "o_dinor";
$port = 4306;

// Create connection
$conn = new mysqli($servername, $username, null, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
