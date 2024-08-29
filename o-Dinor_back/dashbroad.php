<?php 
    include 'configdb.php'; 
    session_start();
    $name = $_SESSION['name'];
    if(empty($_SESSION['name'])){
        header("Location: /o-dinor_back/login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <div class="container">
        <h2>Welcome to the O-Dinor Admin Panel</h2>
        <p>Use the navigation to manage products.</p>
    </div>
</body>

</html>