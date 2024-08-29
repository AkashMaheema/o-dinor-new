<?php
include './configdb.php';
session_start();
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username='$name' AND password='$password'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['name'] = $name;
            header("Location: dashbroad.php");
            exit();
        } else {
            echo "<div class='error-message'>Invalid username or password</div>";
        }

        $conn->close();
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./css/loginstyle.css">
    <script src="script.js"></script>
    <script src=".js/jquery-3.6.3.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <header>
        <h2 class="logo">O-Dinor</h2>
    </header>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <input type="text" id="name" name="name" required>
                    <label>User Name</label>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="register.php" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
