<?php
require "../utils/utils.php";
require "../utils/db_helper.php";
$db = new DBHelper();
$subject_id = $_GET["id"];
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

    <?php foreach ($db->getTpicsBysubject($subject_id) as $item) : ?>
      <div class="mySlides">
        <img src="<?php echo $item["wallpaper"] ?>" style="object-fit: cover; width: 100%; height: 100vh;" alt="">
        <div class="bg" style="position: fixed; width: 100%; height: 100vh; top: 0px; left: 0px; right: 0px; bottom: 0px; background: linear-gradient(0deg, #154565 0%, rgba(0,212,255,0) 100%);"></div>
        <div class="content" style="position: fixed; top: 55%; left: 0px; right: 0px; padding: 24px; color:#ffffff;">
          <h1><?php echo $item["title"] ?></h1>
          <p class="subtitle">
            <?php echo $item["description"] ?>
          </p>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button> -->
    <button class="w3-button w3-black w3-display-right" style="top: 19px;" onclick="fullScrean()">&#x26F6;</button>
  </div>
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://abduvoitov.uz/projects/third-face/monitors/?id=<?php echo $_GET["id"] ?>" style="width: 100px; height: 100px; position: absolute; top: 0px; left: 0px;">

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