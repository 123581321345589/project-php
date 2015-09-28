<?php

/**
 * Подключает файлы запрашиваемых классов
 */
spl_autoload_register(function($class_name) {

  // Массив с директорией статических классов ядра
  $dir_list = [DIR_STATIC];

  // Если есть активированные модули
  if (!empty($_SESSION['modules'])) {

    // Дописать в массив возможную директорию для каждого модуля
    foreach ($_SESSION['modules'] as $module_name => $data) {
      $dir_list[] = DIR_MODULES . '/' . $module_name . DIR_STATIC;
    }

  }

  // Искать и подключить найденные классы
  foreach ($dir_list as $dir) {
    $class_file = DIR_ROOT . $dir . '/' . $class_name . '.php';
    if (file_exists($class_file)) {
      require_once $class_file;
    }
  }

});
