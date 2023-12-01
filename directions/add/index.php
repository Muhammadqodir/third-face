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
  <title>Third Face - Yonalish qo'chish</title>
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/dashboard.css">
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="mr-auto p-2">
      <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-building-columns"></i> Qoshish</span>
    </div>
    <div class="p-2"><a class="btn btn-danger" href="<?php echo getRoute("directions") ?>" role="button"><i class="fa-solid fa-xmark"></i></a></div>
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
        <label for="title">Yonalish nomi</label>
        <input class="form-control" id="title" name="title" placeholder="">
      </div>
      <div class="form-group">
        <label for="name">Foydalanuvchi nomi</label>
        <input class="form-control" id="name" name="name" placeholder="">
      </div>
      <div class="form-group">
        <label for="password">Foydalanuvchi paroli</label>
        <input class="form-control" id="password" name="password" placeholder="">
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
  <script src="scripts.js"></script>
</body>

</html>