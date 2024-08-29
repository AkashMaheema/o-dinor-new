<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>O-Dinor Official Website</title>
    <link rel="icon" type="image/x-icon" href="img/ODior-logo.png" />

    <link rel="stylesheet" href="css/indexstyle.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container1">
      <video autoplay loop muted plays-inline class="back-video">
        <source src="video/shoeclip.mp4" type="video/mp4" />
      </video>
      <section class="home" id="home">
        <div class="containt">
          <h1 class="anim">
            <pre>  <span>O</span>  <span>DINOR</span>        </pre>
          </h1>
          <h3><pre></pre></h3>
        </div>
      </section>
    </div>

    <section class="about" id="about">
      <div class="heading"><h1></h1></div>
      <div class="tbl">
        <table>
          <tr>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td>
              <div class="card">
                <a href="women.php?gender=F">
                <img src="img/blog-01.jpg" alt="women new red dress" />
                <h4>Women</h4>
                </a>
                <h6></h6>
              </div>
            </td>
            <td>
              <div class="card">
                <img src="img/32.jpg" alt="#" />
                <h4>Men</h4>
                <h6></h6>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="card">
                <img src="img/33.jpg" alt="#" />
                <h4>Watches</h4>
              </div>
            </td>
            <td>
              <div class="card">
                <img src="img/35.jpg" alt="#" />
                <h4>Bags</h4>
                <h6></h6>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </section>

    

    <!-------focuse section start here -->
    <section class="focus" id="focus">
      <div class="heading">
        <h1>in Focus</h1>
      </div>
      <div class="tbl-3">
        <table>
          <tr>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <td>
              <img src="img/model12.jpg" alt="#" />
            </td>
            <td>
              <h3><u>WINTER 2024 COLLECTION</u></h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius
                autem expedita iusto excepturi <br />at! Id laboriosam libero
                totam! Quos fugiat dolorum rerum unde. Numquam, officia?
              </p>
              <button class="focuse-btn"><u>Discover</u></button>
            </td>
          </tr>
          <tr>
            <td>
              <h3><u>WINTER 2024 COLLECTION</u></h3>

              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam,
                officia obcaecati. Ipsa sequi doloremque repellendus explicabo a
                expedita, error, velit accusamus harum libero quaerat nesciunt?
              </p>
              <button class="focuse-btn"><u>Discover</u></button>
            </td>
            <td>
              <img src="img/model11.jpg" alt="#" />
            </td>
          </tr>
          <tr>
            <td>
              <img src="img/model14.jpg" alt="#" />
            </td>
            <td>
              <h3><u>WINTER 2024 COLLECTION</u></h3>

              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora
                vel magni, recusandae veniam nulla rem repellat quaerat quod
                saepe temporibus.
              </p>
              <button class="focuse-btn"><u>Discover</u></button>
            </td>
          </tr>
          <tr>
            <td>
              <h3><u>WINTER 2024 COLLECTION</u></h3>

              <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit.<br />
                Adipisci id quidem deleniti amet hic similique vitae dicta at
                ipsam iure. Quis commodi <br />reiciendis debitis eveniet rerum
                voluptates id. Corporis nesciunt autem pariatur facilis
                architecto, modi beatae quidem non magnam cum.
              </p>
              <button class="focuse-btn"><u>Discover</u></button>
            </td>
            <td>
              <img src="img/model13.jpg" alt="#" />
            </td>
          </tr>
        </table>
      </div>
    </section>

    <?php include 'indexcount.php'; ?>
    <!---focuse section ends here-->

    <script>
      const scrollRevealOption = {
        distance: "50px",
        origin: "bottom",
        duration: 1000,
      };

      ScrollReveal().reveal(".content", {
        ...scrollRevealOption,
      });

      ScrollReveal().reveal(".tbl .card", {
        ...scrollRevealOption,
        delay: 500,
      });

      ScrollReveal().reveal(".tbl-3 p", {
        ...scrollRevealOption,
        delay: 1000,
      });

      ScrollReveal().reveal(".header_btns", {
        ...scrollRevealOption,
        delay: 1500,
      });

      ScrollReveal().reveal(".card", {
        ...scrollRevealOption,
        interval: 500,
      });

      ScrollReveal().reveal(".card", {
        duration: 1000,
        interval: 500,
      });

      ScrollReveal().reveal(".job_card", {
        ...scrollRevealOption,
        interval: 500,
      });

      ScrollReveal().reveal(".offer_card", {
        ...scrollRevealOption,
        interval: 500,
      });

      const swiper = new Swiper(".swiper", {
        loop: true,
      });
    </script>

    <?php include 'footer.php'; ?>
  </body>
</html>
