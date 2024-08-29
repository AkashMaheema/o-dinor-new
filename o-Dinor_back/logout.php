<?php
    session_start();
    unset($_SESSION['name']);
    header("Location: /o-dinor_back/login.php");

?>