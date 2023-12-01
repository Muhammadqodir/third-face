<?php
session_start();
// if (!isset($_SESSION["is_login"])) {
//   goToRoute("admin/login");
//   exit();
// }

require "../../utils/db_helper.php";
require "../../utils/utils.php";

if (
  isset($_POST["title"])
  && isset($_POST["direction"])
) {
  if (
    $_POST["title"] != ""
    && $_POST["direction"] != ""
  ) {
    uploadCover();
    $db = new DBHelper();
    $db->addSubject($_POST["title"], getFileName(), $_POST["direction"]);
    goToRoute("subjects");
  } else {
    goBackWithMessage("Barcha malumotlarni kiriting");
  }
} else {
  goBackWithMessage("Bad request");
}


function uploadCover()
{
  $uploadPath = "../../uploads/";
  $imageUploadPath = $uploadPath . getFileName() . '_cover.png';
  $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

  // Allow certain file formats 
  $allowTypes = array('png');
  if (in_array($fileType, $allowTypes)) {
    // Image temp source and size 
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imageUploadPath)) {
      return str_replace("../../../", "", $imageUploadPath);;
    } else {
      goBackWithMessage("Sorry, there was an error uploading your file.");
      exit();
    }
  } else {
    goBackWithMessage("Только файты типа: PNG");
    exit();
  }
}


function getFileName()
{
  $cyr = [
    'Љ', 'Њ', 'Џ', 'џ', 'ш', 'ђ', 'ч', 'ћ', 'ж', 'љ', 'њ', 'Ш', 'Ђ', 'Ч', 'Ћ', 'Ж', 'Ц', 'ц', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', ' '
  ];
  $lat = [
    'Lj', 'Nj', 'Dz', 'dz', 's', 'd', 'c', 'c', 'z', 'lj', 'nj', 'S', 'D', 'C', 'C', 'Z', 'C', 'c', 'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya', '_'
  ];
  return str_replace($cyr, $lat, $_POST["title"]);
}
