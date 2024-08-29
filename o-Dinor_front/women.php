<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/womenstyle.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <title>ODIOR</title>
</head>

<body>
  <?php include 'navbar.php' ?>
  <?php include 'header_bar.php' ?>

  <header>
    <div class="section__container header__container">
      <div class="header__content">
        <p>EXTRA 55% OFF IN SPRING SALE</p>
        <h1>Discover & Shop<br />The Trend Ss19</h1>
        <button class="btn">SHOP NOW</button>
      </div>
      <div class="header__image">
        <img
          src="images/Joven ucraniana aislada sobre fondo blanco riendo _ Foto Premium.jpg"
          alt="header" />
      </div>
    </div>
  </header>

  <section class="section__container collection__container">
    <img src="images/🤍.jpg" alt="collection" />
    <div class="collection__content">
      <h2 class="section__title">New Collection</h2>
      <p>#35 ITEMS</p>
      <h4>Available on Store</h4>
      <button class="btn">SHOP NOW</button>
    </div>
  </section>
  <section class="section__container sale__container">
    <h2 class="section__title">On Sale</h2>
    <div class="sale__grid">
      <div class="sale_card">
        <img src="images/sale1.jpg" alt="sale" />
        <div class="sale__content">
          <p class="sale__subtitle">WOMEN T-SHIRT</p>
          <h4 class="sale__title">sale ,<span>40%</span> off</h4>
          <p class="sale__subtitle">- DON'T MISS -</p>
          <button class="btn sale__btn">SHOP NOW</button>
        </div>
      </div>
      <div class="sale_card">
        <img src="images/sale2.jpg" alt="sale" />
        <div class="sale__content">
          <p class="sale__subtitle">Accecerise</p>
          <h4 class="sale__title">sale ,<span>25%</span> off</h4>
          <p class="sale__subtitle">- DON'T MISS -</p>
          <button class="btn sale__btn">SHOP NOW</button>
        </div>
      </div>
      <div class="sale_card">
        <img src="images/sale3.jpg" alt="sale" />
        <div class="sale__content">
          <p class="sale__subtitle">BAGS</p>
          <h4 class="sale__title">sale ,<span>20%</span> off</h4>
          <p class="sale__subtitle">- DON'T MISS -</p>
          <button class="btn sale__btn">SHOP NOW</button>
        </div>
      </div>
    </div>
  </section>

  <section class="section_container musthave__container">
    <h2 class="section__title">Must Have</h2>

    <section class="section1">
      <a href="shop.php?gender=M&category=tshirt">
        <div class="categoryCard tshirt one">
          <img src="img/T-SHIRT.jpg" alt="t-shirt">
          <div class="text">
            <h1>T-SHIRTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=shirt">
        <div class="categoryCard shirt">
          <img src="img/SHIRT.jpg" alt="shirt">
          <div class="text">
            <h1>SHIRTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=polos">
        <div class="categoryCard polos">
          <img src="img/DRESS.jpg" alt="dress">
          <div class="text">
            <h1>DRESS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=blazers">
        <div class="categoryCard blazers">
          <img src="img/SKIRT.jpg" alt="SKIRTS">
          <div class="text">
            <h1>SKIRTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=accessories">
        <div class="categoryCard accessories">
          <img src="img/ACCESSORIES.jpg" alt="ACCESSORIES">
          <div class="text">
            <h1>ACCESSORIES</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=jackets">
        <div class="categoryCard jackets">
          <img src="img/JACKET.jpg" alt="jackets">
          <div class="text">
            <h1>JACKETS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=jeans">
        <div class="categoryCard jeans">
          <img src="img/JEANS.jpg" alt="jeans">
          <div class="text">
            <h1>JEANS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=shoes">
        <div class="categoryCard shoes">
          <img src="img/BAGS.jpg" alt="bags">
          <div class="text">
            <h1>BAGS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=short">
        <div class="categoryCard short">
          <img src="img/SHORTS.jpg" alt="t-shirt">
          <div class="text">
            <h1>SHORTS</h1>
          </div>
        </div>
      </a>

      <a href="shop.php?gender=M&category=trousers">
        <div class="categoryCard trousers">
          <img src="img/TROUSERS.jpg" alt="trousers">
          <div class="text">
            <h1>TROUSERS</h1>
          </div>
        </div>
      </a>

    </section>
  </section>

  <!-- <section class="section__container musthave__container">
        <h2 class="section__title">Must Have</h2>
        <div class="musthave__nav">
            <a href="shop.php?gender=F">ALL</a>
            <a href="#">WOMEN</a>
            <a href="#">BAGS</a>
            <a href="#">SHOES</a>
            <a href="#">Accecerise</a>
        </div>
        <div class="musthave__grid">
            <div class="musthave__card">
                <img src="images/musthave-1.png" alt="must have">
                <h4>Basic long sleeve T-shirt</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-2.png" alt="must have">
                <h4>Ribbed T-shirt with buttons</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-3.png" alt="must have">
                <h4>Jacket withside strings</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-4.png" alt="must have">
                <h4>High heel tubular sandalst</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-5.png" alt="must have">
                <h4>Coral fabric belt bag</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-6.png" alt="must have">
                <h4>Piggy skatar slogen T-shirt</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-7.png" alt="must have">
                <h4>White platform boots</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-8.png" alt="must have">
                <h4>Sweater vest with sleeves</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-9.png" alt="must have">
                <h4>Slim fit pants</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-10.png" alt="must have">
                <h4>Gray backpack</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-11.png" alt="must have">
                <h4>Neon smartwatch</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
            <div class="musthave__card">
                <img src="images/musthave-12.png" alt="must have">
                <h4>Neon sweater</h4>
                <p><del>$45.00</del>$75.00</p>
            </div>
        </div>
    </section> -->

  <section class="news">
    <div class="section__container news__container">
      <h2 class="section__title">Latest News</h2>
      <div class="news__grid">
        <div class="news__card">
          <img src="images/news-1.png" alt="news" />
          <div class="news__details">
            <p>
              FASHION <i class="ri-checkbox-blank-circle-fill"></i>
              <span>JAMES SIMSON</span>
              <i class="ri-checkbox-blank-circle-fill"></i>FEB 2, 2024
            </p>
            <h4>Season1 Trends</h4>
            <hr />
            <p>
              Discuss the latest fashion trends for the current season and
              offer tips and ideas on how to incorporate these trends into
              your wardrobe.
            </p>
            <a href="#"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="news__card">
          <img src="images/news-2.png" alt="news" />
          <div class="news__details">
            <p>
              FASHION <i class="ri-checkbox-blank-circle-fill"></i>
              <span>JAMES SIMSON</span>
              <i class="ri-checkbox-blank-circle-fill"></i>APR 15, 2024
            </p>
            <h4>Fashion Tips and Advice</h4>
            <hr />
            <p>
              Provide your readers with practical tips and advice on how to
              dress for different ocasions, body types, or style preferences.
            </p>
            <a href="#"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
        <div class="news__card">
          <img src="images/news-3.png" alt="news" />
          <div class="news__details">
            <p>
              STYLE <i class="ri-checkbox-blank-circle-fill"></i>
              <span>JAMES SIMSON</span>
              <i class="ri-checkbox-blank-circle-fill"></i>JUL 22, 2024
            </p>
            <h4>Sustainable Fashion</h4>
            <hr />
            <p>
              Cover the growing trend of eco-conscious fashion and explore the
              various ways to be sustainable in your fashion choices.
            </p>
            <a href="#"><i class="ri-arrow-right-line"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="section__container brands__container">
        <div class="brand__image">
            <img src="images/brand-1.png" alt="brand" />
        </div>
        <div class="brand__image">
            <img src="images/brand-2.png" alt="brand" />
        </div>
        <div class="brand__image">
            <img src="images/brand-3.png" alt="brand" />
        </div>
        <div class="brand__image">
            <img src="images/brand-4.png" alt="brand" />
        </div>
        <div class="brand__image">
            <img src="images/brand-5.png" alt="brand" />
        </div>
        <div class="brand__image">
            <img src="images/brand-6.png" alt="brand" />
        </div>
    </section> -->

  <?php include 'footer.php'; ?>
</body>

</html>