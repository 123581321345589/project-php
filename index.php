<?php

// Объявить константы с директориями
define('DIR_ROOT',      $_SERVER['DOCUMENT_ROOT']);
define('DIR_CONFIG',    '/config');
define('DIR_CORE',      '/core');
define('DIR_STATIC',    '/static');
define('DIR_MODULES',   '/modules');
define('DIR_CTRL',      '/ctrl');
define('DIR_SITE',      '/site');
define('DIR_TAMPLATES', '/tamplates');

// Подключить конфигурацию
require_once DIR_ROOT . DIR_CONFIG . '/main.php';

// Подготовить сессию
require_once DIR_ROOT . DIR_CORE . '/session.php';

// Настроить авто подключение статических классов
require_once DIR_ROOT . DIR_CORE . '/autoload.php';

// Подготовить глобальные массивы
require_once DIR_ROOT . DIR_CORE . '/global_arrays.php';
