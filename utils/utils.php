<?php

define('BASE_URL', 'https://abduvoitov.uz/projects/third-face/');

function goToRoute($route)
{
  header('Location: ' . BASE_URL . $route);
}

function getRoute($url)
{
  return BASE_URL . $url;
}

function route($url)
{
  echo BASE_URL . $url;
}

function getCurrentRoute()
{
  return str_replace(BASE_URL, "", "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
}

function goBackWithMessage($message)
{
  $_SESSION["message"] = $message;
  header('Location: ' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
}

function goBack()
{
  header('Location: ' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
}