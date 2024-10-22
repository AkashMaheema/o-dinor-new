<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/shop.css" />
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="">
                        <img src="images/fashions1.jpg" alt="Post Image" style="height:300px; width:300px;">

                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima odit at quasi optio quas
                            eligendi eos praesentium voluptatibus vitae hic, sit dolore exercitationem ex dolores
                            nostrum nemo ducimus cumque saepe?
                        </p>
                        <a href="adajdnadnajdajd.php">adadadasdasd</a>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <img src="images/fashions1.jpg" alt="Post Image" style="height:300px; width:300px;">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis porro impedit exercitationem
                        esse voluptatibus fugiat deleniti officia quisquam, recusandae ipsum, tenetur fugit. Rerum ipsam
                        natus maiores, laudantium possimus iste quasi?
                    </p>
                </div>
                <div class="col-lg-4">
                    <img src="images/fashions1.jpg" alt="Post Image" style="height:300px; width:300px;">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis porro impedit exercitationem
                        esse voluptatibus fugiat deleniti officia quisquam, recusandae ipsum, tenetur fugit. Rerum ipsam
                        natus maiores, laudantium possimus iste quasi?
                    </p>
                </div>
            </div>
        </div>
        <div class="filter d-md-flex">
                <div class="col-lg-8">
                        <div class="SearchbyName" >
                            <input type="text" id="search-name" class="form-control form-check-name"
                                placeholder="Search by name">
                        </div>
                </div>
                <div class="col-lg-2 order-end">
                        <div class="filterByPrice">
                            <input type="number" id="search-price-min" class="form-control min_price"
                                placeholder="Min price">
                            <input type="number" id="search-price-max" class="form-control max_price"
                                placeholder="Max price">
                    </div>
                </div>
        </div>
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>   -->
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>