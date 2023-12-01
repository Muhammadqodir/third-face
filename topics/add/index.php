<?php
require "../../utils/utils.php";
session_start();
if (!isset($_SESSION["is_login"])) {
  goToRoute("login");
  exit();
}
require "../../utils/db_helper.php";
$db = new DBHelper();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Third Face - Mavzu qo'chish</title>
  <style>
    .loader {
      border: 4px solid #fff;
      border-top: 4px solid #444;
      border-radius: 50%;
      margin: auto;
      display: none;
      width: 20px;
      height: 20px;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../../css/dashboard.css"> -->
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="mr-auto p-2">
      <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-book-bookmark"></i> Qoshish</span>
    </div>
    <div class="p-2"><a class="btn btn-danger" href="<?php echo getRoute("topics") ?>" role="button"><i class="fa-solid fa-xmark"></i></a></div>
  </nav>
  <div class="container" style="margin-top: 24px;">
    <form method="post" enctype="multipart/form-data" action="add.php">
      <?php if (isset($_SESSION["message"])) : ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_SESSION["message"];
          unset($_SESSION['message']); ?>
        </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="title">Mavzu nomi</label>
        <input class="form-control" id="title" name="title" placeholder="">
      </div>
      <div class="form-group">
        <label for="direction">Yo'nalish</label>
        <select class="form-control" id="direction" onchange="selectDirection($('#direction').val())" name="direction" placeholder="">
          <?php foreach ($db->getDirections() as $item) : ?>
            <option value="<?php echo $item["id"] ?>"><?php echo $item["title"] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="subject">Fan</label>
        <select class="form-control" id="subject" name="subject" placeholder="">
          <?php foreach ($db->getSubjects() as $item) : ?>
            <option value="<?php echo $item["id"] ?>"><?php echo $item["title"] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="image">Mavzu matni</label>
        <textarea class="form-control" id="description" name="description"></textarea>
        <div class="btn btn-warning" style="width: 100%;" onclick="generateText();">
          <i class="fa-brands fa-slack"></i> Suniy intellect yordamida yozish
          <div class="loader" id="text_loder"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="image">Fon rasimi</label>
        <input type="text" hidden value="" class="form-control" id="image" name="image">
        <img src="" id="image_preview" width="100%">
        <div style="display: none;">

        </div>
        <div class="btn btn-warning" onclick="getImages()" style="width: 100%;">
          <i class="fa-brands fa-slack"></i> Suniy intellect yordamida chizish
          <div class="loader" id="image_loder"></div>
        </div>
      </div>
      <div style="text-align: end;">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Добавить</button>
      </div>
    </form>
  </div>

  <div style="height: 100px;">
  </div>

  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <!-- Import the component -->
  <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.1.1/model-viewer.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script>
    function selectDirection(id) {
      var res = $.parseJSON(httpGet("<?php route("topics/add/get_subjects.php") ?>?id=" + id));
      var html = "";
      res.forEach(element => {
        console.log(element["title"]);
        html += "<option value=\"" + element["id"] + "\">" + element["title"] + "</option>";
      });
      $("#subject").html(html);
    }

    function httpGet(theUrl) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open("GET", theUrl, false); // false for synchronous request
      xmlHttp.send(null);
      return xmlHttp.responseText;
    }

    function generateText() {
      $("#text_loder").css("display", "block");
      var topic = $("#title").val() + " mavzusiga matn yoz";

      const data = JSON.stringify({
        query: topic
      });

      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener('readystatechange', function() {
        if (this.readyState === this.DONE) {
          console.log($.parseJSON(this.responseText)["response"]);
          $("#text_loder").css("display", "none");
          $("#description").val($.parseJSON(this.responseText)["response"]);
        }
      });

      xhr.open('POST', 'https://chatgpt-api7.p.rapidapi.com/ask');
      xhr.setRequestHeader('content-type', 'application/json');
      xhr.setRequestHeader('X-RapidAPI-Key', '875e4a4205msh311fb129ade35e7p152a49jsnd4854c5ceb37');
      xhr.setRequestHeader('X-RapidAPI-Host', 'chatgpt-api7.p.rapidapi.com');

      xhr.send(data);
    }

    var images = [];

    async function translateEnUz(q) {
      const response = await fetch(encodeURI("https://abduvoitov.uz/projects/third-face/topics/add/translate.php?s=uz&d=en&q=" + q));
      return (await response.json())["destination-text"];
    }

    async function getImages() {
      images = [];
      $("#image_loder").css("display", "block");
      var topic = $("#title").val();
      const apiKey = 'AIzaSyBgyxuAucWzsJHWlEOtd-7LMjGt6GTTjVE';
      const cx = 'b028a709e8ac74857';
      const query = await translateEnUz(topic);

      const apiUrl = encodeURI(`https://www.googleapis.com/customsearch/v1?q=${query}&cx=${cx}&key=${apiKey}&searchType=image`);

      console.log(apiUrl);

      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          data.items.forEach(element => {
            try {
              images.push(element.link);
              return;
            } catch (e) {}
          });
          $("#image_loder").css("display", "none");
          console.log(images);
          $("#image").val(images[0]);
          $("#image_preview").attr('src', images[0]);
        })
        .catch(error => console.error('Error fetching data:', error));
    }
  </script>
</body>

</html>