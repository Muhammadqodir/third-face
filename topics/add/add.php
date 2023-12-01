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
  && isset($_POST["direction"])
  && isset($_POST["subject"])
  && isset($_POST["description"])
  && isset($_POST["image"])
) {
  if (
    $_POST["title"] != ""
    && $_POST["direction"] != ""
    && $_POST["subject"] != ""
    && $_POST["description"] != ""
    && $_POST["image"] != ""
  ) {
    $db = new DBHelper();
    $db->addTopic($_POST["title"], str_replace("'", "''", $_POST["description"]), $_POST["image"], $_POST["direction"], $_POST["subject"]);
    goToRoute("topics");
  } else {
    goBackWithMessage("Barcha malumotlarni kiriting");
  }
} else {
  goBackWithMessage("Bad request");
}
