<?php
session_start();
// if (!isset($_SESSION["is_login"])) {
//   goToRoute("admin/login");
//   exit();
// }

require "../utils/db_helper.php";
require "../utils/utils.php";

$db = new DBHelper();

$db->removeDirection($_GET["id"]);

goBack();