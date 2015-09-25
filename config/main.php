<?php

// Протоколировать все ошибки
error_reporting(E_ALL);

// Определить окружение
switch (DIR_ROOT) {

  // Тестовый сервер
  case '/var/www/xxx/data/www/site.dev':
    define('ENVIRONMENT', 'dev');
    ini_set('display_errors', 1);
    break;

  // По умолчанию
  default:
    define('ENVIRONMENT', '');
    ini_set('display_errors', 0);
    break;

}

// Сформировать путь к нужной папке
define('ENVIRONMENT_CONFIG', DIR_CONFIG . '/' . ENVIRONMENT);

// Просканировать директорию
if (is_dir(DIR_CONFIG)) {
  foreach (scandir(DIR_CONFIG) as $item) {

    $config_file = DIR_CONFIG . '/' . $item;

    if (is_file($config_file) and $config_file != __FILE__) {

      $config_file_environment = ENVIRONMENT_CONFIG . '/' . $item;

      // Определить файл нужного окружения
      if (is_file($config_file_environment)) {
        $config_file = $config_file_environment;
      }

      require_once $config_file;

    }

  }
}
