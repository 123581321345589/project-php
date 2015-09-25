<?php

// Объявить константы с директориями
define('DIR_ROOT',      $_SERVER['DOCUMENT_ROOT']);
define('DIR_CONFIG',    DIR_ROOT . '/config');
define('DIR_CORE',      DIR_ROOT . '/core');
define('DIR_MODULES',   DIR_ROOT . '/modules');
define('DIR_CTRL',      DIR_ROOT . '/ctrl');
define('DIR_SITE',      DIR_ROOT . '/site');
define('DIR_TAMPLATES', DIR_ROOT . '/tamplates');

// Подключить конфигурацию
require_once DIR_CONFIG . '/main.php';
