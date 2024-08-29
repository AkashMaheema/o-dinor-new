<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<nav>
      <div class="wrapper">
        <div class="logo"><a href="./index.php">O-Dinor</a></div>
        <input type="radio" name="slider" id="menu-btn" />
        <input type="radio" name="slider" id="close-btn" />
        <ul class="nav-links">
          <label for="close-btn" class="btn close-btn"
            ><i class="fas fa-times"></i
          ></label>
          <li><a href="#">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li>
            <a href="#" class="desktop-item">Jewelry and Timepieces</a>
            <input type="checkbox" id="showDrop" />
            <label for="showDrop" class="mobile-item"
              >Jewelry and Timepieces</label
            >
            <ul class="drop-menu">
              <li><a href="#">Rings</a></li>
              <li><a href="#">Earrings</a></li>
              <li><a href="#">Necklaces</a></li>
              <li><a href="#">Bracelets</a></li>
            </ul>
          </li>
          <li>
            <a href="#" class="desktop-item">For You</a>
            <input type="checkbox" id="showMega" />
            <label for="showMega" class="mobile-item">Mega Menu</label>
            <div class="mega-box">
              <div class="content">
                <div class="row">
                  <img src="img/36.jpg" alt="img" />
                </div>
                <div class="row">
                  <header>MENS</header>
                  <ul class="mega-links">
                    <li><a href="#">BAGS</a></li>
                    <li><a href="#">SHOES</a></li>
                    <li><a href="#">REDY-TO-WEAR</a></li>
                    <li><a href="#">ACCESSORICE</a></li>
                    <li><a href="#">SMALL LETHER GOODS</a></li>
                  </ul>
                </div>

                <div class="row">
                  <header>WOMENS</header>
                  <ul class="mega-links">
                    <li><a href="#">BAGS</a></li>
                    <li><a href="#">SHOES</a></li>
                    <li><a href="#">REDY-TO-WEAR</a></li>
                    <li><a href="#">ACCESSORICE</a></li>
                    <li><a href="#">SMALL LETHER GOODS</a></li>
                  </ul>
                </div>
                <div class="row">
                  <header>FATION SHOWS</header>
                  <ul class="mega-links">
                    <li>
                      <a href="#">AUTUMN-WINTER 2024-2025 HAUTE COUTURE SHOW</a>
                    </li>
                    <li><a href="#">CRUISE 2025 SHOW</a></li>
                    <li><a href="#">WINTER 2024-2025 MEN’S SHOW</a></li>
                    <li><a href="#">SUMMER 2025 WOMENS SHOW</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </li>
          <li><a href="blog.html">New</a></li>
          <li><a href="blog.html">Blog</a></li>

          <div class="icons">

         <button onclick="goTocart()"   <i class="fa-solid fa-cart-shopping"></i></button>
          </div>
        </ul>
        <label for="menu-btn" class="btn menu-btn"
          ><i class="fas fa-bars"></i
        ></label>
      </div>
    </nav>
    <script>
</script>
