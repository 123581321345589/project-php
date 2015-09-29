<?php

// Обезвредить $_COOKIE
$_COOKIE = format::html_special_chars($_COOKIE);

// Обезвредить $_GET
$_GET = format::html_special_chars($_GET);

// Если получены данные методом POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Получить уникальный хэш
  $md5 = md5(serialize($_POST));

  // Получить хэш предыдущего запроса (если он есть)
  $previous = (isset($_SESSION['core']['previous_post_hash']))
            ? $_SESSION['core']['previous_post_hash']
            : NULL;

  // Очистить массив $_POST если текущий и предыдущий хэши не совпадают
  if ($previous === $md5) {
    unset($_POST);
  }

  // Если же текущий хэш отличается от предыдущего - обезвредить данные
  else {
    $_POST = format::html_special_chars($_POST);
  }

  // Запомнить текущий хэш
  $_SESSION['core']['previous_post_hash'] = $md5;

}
