<?php
require "../utils/utils.php";
session_start();
if (!isset($_SESSION["is_login"])) {
  goToRoute("login");
  exit();
}
require "../utils/db_helper.php";
$db = new DBHelper();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ThirdFace</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <style>
    .mySlides {
      display: none;
      transition: .5s
    }

    .subtitle {
      font-size: 25px;
    }

    h1 {
      font-family: "Montserrat";
      font-weight: bold;
    }
  </style>
  </style>
</head>

<body style="padding: 0px; margin: 0px; width: 100%; height: 100vh; overflow:hidden; font-family: Montserrat !important;">

  <div class="slides">

    <div class="mySlides">
      <img src="https://paultan.org/image/2021/08/Porsche-911-GT2-RS-Clubsport-25-1.jpg" style="object-fit: cover; width: 100%; height: 100vh;" alt="">
      <div class="bg" style="position: fixed; width: 100%; height: 100vh; top: 0px; left: 0px; right: 0px; bottom: 0px; background: linear-gradient(0deg, #154565 0%, rgba(0,212,255,0) 100%);"></div>
      <div class="content" style="position: fixed; top: 55%; left: 0px; right: 0px; padding: 24px; color:#ffffff;">
        <h1>Porsche 911 GT2RS</h1>
        <p class="subtitle">
          The 911 GT2 RS Clubsport is powered by a 515kW (700hp) 3.8-litre six-cylinder aluminium twin-turbo horizontally opposed engine, and can deliver maximum performance precisely where required, thanks to its optimised intercooler with redesigned supply and return air feed, as well as its race-optimised water spray system.
        </p>
      </div>
    </div>


    <div class="mySlides">
      <img src="https://newsroom.porsche.com/.imaging/mte/porsche-templating-theme/image_1290x726/dam/US-local/Press-Releases/2023/new_911_st/0276_010400_london_AKOS0460_V01_A3_RGB.jpg/jcr:content/0276_010400_london_AKOS0460_V01_A3_RGB.jpg" style="object-fit: cover; position: fixefixed; width: 100%; height: 100vh;" alt="">
      <div class="bg" style="position: fixed; width: 100%; height: 100vh; top: 0px; left: 0px; right: 0px; bottom: 0px; background: linear-gradient(0deg, #154565 0%, rgba(0,212,255,0) 100%);"></div>
      <div class="content" style="position: absolute; top: 55%; left: 0px; right: 0px; padding: 24px; color:#ffffff;">
        <h1>Porsche 911 Sports Classic</h1>
        <p class="subtitle">
          The 911 Sport Classic is the most powerful manual 911 available today. The gearbox has an auto-blip function that compensates for speed differences between the gears with a brief burst of revs when shifting down.
        </p>
      </div>
    </div>

    <!-- <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button> -->
    <button class="w3-button w3-black w3-display-right" style="top: 19px;" onclick="fullScrean()">&#x26F6;</button>
  </div>
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://abduvoitov.uz/projects/third-face/monitors/" style="width: 100px; height: 100px; position: absolute; top: 0px; left: 0px;">

  <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    setInterval(() => {
      plusDivs(1);
    }, 5000);

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = x.length
      }
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex - 1].style.display = "block";
    }

    function fullScrean() {
      document.body.requestFullscreen()
        .catch(err => {
          alert("Failed to enter fullscreen mode:" + err);
          console.error('Failed to enter fullscreen mode:', err);
        });
    }
  </script>
</body>

</html>