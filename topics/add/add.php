<?php
require "../../utils/utils.php";
session_start();
if (!isset($_SESSION["is_login"])) {
  goToRoute("login");
  exit();
}

require "../../utils/db_helper.php";

if (
  isset($_POST["title"])
  && isset($_POST["name"])
  && isset($_POST["password"])
) {
  if (
    $_POST["title"] != ""
    && $_POST["name"] != ""
    && $_POST["password"] != ""
  ) {
    $db = new DBHelper();
    $db->addDirection($_POST["title"], $_POST["name"], $_POST["password"]);
    goToRoute("topics");
  } else {
    goBackWithMessage("Barcha malumotlarni kiriting");
  }
} else {
  goBackWithMessage("Bad request");
}
