<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mens section</title>
  <link rel="stylesheet" href="css/menstyle.css">
</head>

<body>
  <?php include 'navbar.php'; ?>
  <?php include 'header_bar.php' ?>
  <header>
    <div class="section__container header__container">
      <div class="header__content">
        <p>EXTRA 55% OFF IN SPRING SALE</p>
        <h1>Discover & Shop<br>The Trend Ss19</h1>
        <button class="btn">SHOP NOW</button>
      </div>
      <div class="header__image">
        <img src="img/model2.jpg" alt="header" />
      </div>
    </div>
  </header>

  <!-- <section class="section__container collection__container">
    <img src="img/model3.jpg" alt="collection">
    <div class="collection__content">
      <h2 class="section__title">New Collection</h2>
      <p>#35 ITEMS</p>
      <h4>Available on Store</h4>
      <button class="btn">SHOP NOW</button>
    </div>
  </section> -->

  <section class="section__container musthave__container">
    <h2 class="section__title">Must Have</h2>

    <section class="section1">
      <a href="shop.php?gender=M&category=T-Shirts">
        <div class="categoryCard tshirt one">
          <img src="img/cat1.jpg" alt="t-shirt" />
          <div class="text">
            <h1>T-SHIRTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=Shirts">
        <div class="categoryCard shirt">
          <img src="img/cat2.jpg" alt="shirt" />
          <div class="text">
            <h1>SHIRTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=Shorts">
        <div class="categoryCard short">
          <img src="img/cat4.jpg" alt="t-shirt" />
          <div class="text">
            <h1>SHORTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=blazers">
        <div class="categoryCard blazers">
          <img src="img/cat5.jpg" alt="Blazers" />
          <div class="text">
            <h1>BLAZERS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=accessories">
        <div class="categoryCard accessories">
          <img src="img/cat6.jpg" alt="ACCESSORIES" />
          <div class="text">
            <h1>ACCESSORIES</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=jackets">
        <div class="categoryCard jackets">
          <img src="img/cat7.jpg" alt="jackets" />
          <div class="text">
            <h1>JACKETS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=jeans">
        <div class="categoryCard jeans">
          <img src="img/cat8.jpg" alt="jeans" />
          <div class="text">
            <h1>JEANS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=shoes">
        <div class="categoryCard shoes">
          <img src="img/cat9.jpg" alt="shoes" />
          <div class="text">
            <h1>SHOES</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=polos">
        <div class="categoryCard polos">
          <img src="img/cat10.jpg" alt="polos" />
          <div class="text">
            <h1>POLOS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=trousers">
        <div class="categoryCard trousers">
          <img src="img/cat11.jpg" alt="trousers" />
          <div class="text">
            <h1>TROUSERS</h1>
          </div>
        </div>
      </a>
    </section>

  </section>

  <section class="news">
    <div class="section__container news__container">
      <h2 class="section__title">Latest News</h2>
      <div class="news__grid">
        <div class="news__card">
          <img src="img/men-2.jpg" alt="news">
          <div class="news__details">
            <p>
              FASHION <i class="ri-checkbox-blank-circle-fill"></i>
              <span>JAMES SIMSON</span>
              <i class="ri-checkbox-blank-circle-fill"></i>FEB 2, 2024
            </p>
            <h4>Season1 Trends</h4>
            <hr>
            <p>
              Discuss the latest fashion trends for the current season and offer tips and ideas on how to incorporate these trends into your wardrobe.
            </p>
            <a href="#"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="news__card">
          <img src="img/men-5.jpg" alt="news">
          <div class="news__details">
            <p>
              FASHION <i class="ri-checkbox-blank-circle-fill"></i>
              <span>JAMES SIMSON</span>
              <i class="ri-checkbox-blank-circle-fill"></i>APR 15, 2024
            </p>
            <h4>Fashion Tips and Advice</h4>
            <hr>
            <p>
              Provide your readers with practical tips and advice on how to dress for different ocasions, body types, or style preferences.
            </p>
            <a href="#"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="news__card">
          <img src="img/men-4.jpg" alt="news">
          <div class="news__details">
            <p>
              STYLE <i class="ri-checkbox-blank-circle-fill"></i>
              <span>JAMES SIMSON</span>
              <i class="ri-checkbox-blank-circle-fill"></i>JUL 22, 2024
            </p>
            <h4>Sustainable Fashion</h4>
            <hr>
            <p>
              Cover the growing trend of eco-conscious fashion and explore the various ways to be sustainable in your fashion choices.
            </p>
            <a href="#"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php include 'footer.php'; ?>
</body>

</html>