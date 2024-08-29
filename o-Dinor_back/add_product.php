<?php
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: /o-dinor_back/login.php");
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $category = $_POST['category'];
    $sizes = $_POST['size'];
    $colors = array_filter($_POST['color'], function ($color) {
        return $color !== '#000000';
    });
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (name, gender, category, title, description) 
            VALUES ('$name', '$gender', '$category', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        $product_id = $conn->insert_id;

        foreach ($sizes as $size) {
            $cost = $_POST['cost_' . $size];
            $rate = $_POST['rate_' . $size];
            $sql = "INSERT INTO product_sizes (product_id, size, cost, rate) 
                    VALUES ('$product_id', '$size', '$cost', '$rate')";
            $conn->query($sql);
        }

        foreach ($colors as $color) {
            $sql = "INSERT INTO product_colors (product_id, color) VALUES ('$product_id', '$color')";
            $conn->query($sql);
        }

        foreach ($_FILES['images']['name'] as $key => $file_name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['images']['tmp_name'][$key];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_dest = "../o-Dinor_back/uploads/" . uniqid() . "." . $file_ext;

                if (move_uploaded_file($file_tmp, $file_dest)) {
                    $sql = "INSERT INTO product_images (product_id, image_path) VALUES ('$product_id', '$file_dest')";
                    $conn->query($sql);
                }
            }
        }
        echo '<div class="d-flex justify-content-end"><div class="alert alert-success m-1" role="alert" style="width: 300px;text-align:center;">New product added successfully!</div></div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'navbar.php';?>
    <header>
        <h1>ADD PRODUCT</h1>
    </header>
    <div class="container">
        <form id="productForm" action="add_product.php" method="post" enctype="multipart/form-data">
            <ul type="none">
                <li>
                    <label for="name" class="col-sm-3 col-form-label">Product Name</label>
                    <input type="text" id="name" name="name" class="w-70 form-control" required>
                </li>
                <li>
                    <label for="gender" class="col-sm-3 col-form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" required>
                        <label class="form-check-label" for="genderM">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderF" value="F">
                        <label class="form-check-label" for="genderF">Female</label>
                    </div>
                </li>
                <li>
                    <label for="category" class="col-sm-3 col-form-label">Category</label>
                    <select class="w-70 form-select" name="category" required>
                        <option>Select</option>
                        <option>Shirts</option>
                        <option>T-Shirts</option>
                        <option>Polos</option>
                        <option>Shorts</option>
                        <option>Jeans</option>
                        <option>Trousers</option>
                        <option>Blazers</option>
                        <option>Jackets</option>
                        <option>Shoes</option>
                        <option>Accessories</option>
                    </select>
                </li>
                <li>
                    <label for="size" class="col-sm-3 col-form-label">Size</label><br>
                    <div id="sizeContainer">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size[]" id="sizeS" value="S">
                            <label class="form-check-label" for="sizeS">S</label>
                            <input type="number" name="cost_S" placeholder="Cost" class="form-control form-control-inline" min="0">
                            <input type="number" name="rate_S" placeholder="Rate" class="form-control form-control-inline" min="0">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size[]" id="sizeM" value="M">
                            <label class="form-check-label" for="sizeM">M</label>
                            <input type="number" name="cost_M" placeholder="Cost" class="form-control form-control-inline" min="0">
                            <input type="number" name="rate_M" placeholder="Rate" class="form-control form-control-inline" min="0">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size[]" id="sizeL" value="L">
                            <label class="form-check-label" for="sizeL">L</label>
                            <input type="number" name="cost_L" placeholder="Cost" class="form-control form-control-inline" min="0">
                            <input type="number" name="rate_L" placeholder="Rate" class="form-control form-control-inline" min="0">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size[]" id="sizeXL" value="XL">
                            <label class="form-check-label mb-2" for="sizeXL">XL</label>
                            <input type="number" name="cost_XL" placeholder="Cost" class="form-control form-control-inline" min="0">
                            <input type="number" name="rate_XL" placeholder="Rate" class="form-control form-control-inline" min="0">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size[]" id="sizeXXL" value="XXL">
                            <label class="form-check-label" for="sizeXXL">XXL</label>
                            <input type="number" name="cost_XXL" placeholder="Cost" class="form-control form-control-inline" min="0">
                            <input type="number" name="rate_XXL" placeholder="Rate" class="form-control form-control-inline" min="0">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="size[]" id="sizeXXXL" value="XXXL">
                            <label class="form-check-label" for="sizeXXXL">XXXL</label>
                            <input type="number" name="cost_XXXL" placeholder="Cost" class="form-control form-control-inline" min="0">
                            <input type="number" name="rate_XXXL" placeholder="Rate" class="form-control form-control-inline" min="0">
                        </div>
                </li>
                <li>
                    <label for="color" class="col-sm-3 col-form-label">Color</label><br>
                    <div class="form-check form-check-inline">
                        <input type="color" id="color1" name="color[]" class="form-control form-control-color">
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="color" id="color2" name="color[]" class="form-control form-control-color">
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="color" id="color3" name="color[]" class="form-control form-control-color">
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="color" id="color4" name="color[]" class="form-control form-control-color">
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="color" id="color5" name="color[]" class="form-control form-control-color">
                    </div>
                </li>
                <li>
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <input type="text" id="title" name="title" class="w-70 form-control" required>
                </li>
                <li>
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <textarea id="description" name="description" class="w-70 form-control" required></textarea>
                </li>
                <li>
                    <label for="images" class="col-sm-3 col-form-label">Product Images</label>
                    <input type="file" id="images" name="images[]" class="w-70 form-control" multiple accept="image/*" required>
                </li>
            </ul>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
        <br>
        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            const colorPickers = document.querySelectorAll('input[type="color"]');
            let validColors = 0;
            colorPickers.forEach(colorPicker => {
                if (colorPicker.value !== '#000000') {
                    validColors++;
                }
            });
            if (validColors === 0) {
                event.preventDefault();
                alert('Please pick at least one valid color.');
            }
        });
    </script>


</body>

</html>