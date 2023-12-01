<?php
require "utils/utils.php";
session_start();
unset($_SESSION["is_login"]);
goToRoute("login");
exit();
