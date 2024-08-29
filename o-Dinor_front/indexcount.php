<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/indexcount.css" />
  </head>
  <body>
    <section class="deal-count" id="deal-count">
      <h1 class="heading">special<span>deal</span></h1>

      <div class="row">
        <div class="content-count">
          <span class="discount">up to 50% off</span>
          <h3 class="text">deal of the day</h3>
          <div class="count-down">
            <div class="box-count">
              <h3 id="days">00</h3>
              <span>days</span>
            </div>
            <div class="box-count">
              <h3 id="hours">00</h3>
              <span>hours</span>
            </div>
            <div class="box-count">
              <h3 id="minutes">00</h3>
              <span>minutes</span>
            </div>
            <div class="box-count">
              <h3 id="seconds">00</h3>
              <span>seconds</span>
            </div>

          </div>
             <div class="btn"  > <u>SHOP NOW </u></div>

        </div>
        <div class="image-count">
          <!-- <img src="img/home-img.png" /> -->
        </div>
        
      </div>
    </section>

    <script>
      let countDate = new Date("aug 30, 2024 00:00:00").getTime();

      function countDown() {
        let now = new Date().getTime();
        gap = countDate - now;

        let seconds = 1000;
        let minutes = seconds * 60;
        let hours = minutes * 60;
        let days = hours * 24;

        let d = Math.floor(gap / days);
        let h = Math.floor((gap % days) / hours);
        let m = Math.floor((gap % hours) / minutes);
        let s = Math.floor((gap % minutes) / seconds);

        document.getElementById("days").innerText = d;
        document.getElementById("hours").innerText = h;
        document.getElementById("minutes").innerText = m;
        document.getElementById("seconds").innerText = s;
      }

      setInterval(function () {
        countDown();
      }, 4);
    </script>
  </body>
</html>
