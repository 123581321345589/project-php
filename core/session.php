<?php

// Использовать только cookie для передачи идентификатора сессии
ini_set('session.use_trans_sid', 0);
ini_set('session.use_only_cookies', 1);

// Использовать HTTP-only cookie для хранения идентификатора сессии
ini_set('session.cookie_httponly', 1);

// Начать сессию
session_start();

// Защитить сессию от подмены (путем регенерации ее ID)
if (!isset($_SESSION['created'])) {
  session_regenerate_id(TRUE);
  $_SESSION['created'] = time();
}

//! Не забыть перегенерировать ID сессии после успешной аутентификации
