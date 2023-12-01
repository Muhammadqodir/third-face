<?php
header('Content-Type: application/json; charset=utf-8');

echo file_get_contents("https://ftapi.pythonanywhere.com/translate?sl=" . $_GET["s"] . "&dl=" . $_GET["d"] . "&text=" . $_GET["q"]);
