<?php

require "../../utils/utils.php";
session_start();
if (!isset($_SESSION["is_login"])) {
  goToRoute("login");
  exit();
}

require "../../utils/db_helper.php";

$db = new DBHelper();

echo json_encode($db->getSubjectsByDirection($_GET["id"]));
