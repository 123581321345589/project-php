<?php

class database
{

  protected static $_instance;
  protected static $_database;

  /**
   * Устанавливает соединение с БД
   */
  private function __construct() {
    try {
      self::$_database = new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
      self::$_database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$_database->exec('SET names ' . DATABASE_CHARSET);
      self::$_database->exec('SET time_zone = "' . DATABASE_TIMEZONE . '"');
    }
    catch (PDOException $error) {
      return self::error($error);
    }
  }

  /**
   * Парсит и оформляет ошибки SQL-запроса
   */
  private function error($error) {

    $getCode  = $error->getCode();
    $getMess  = $error->getMessage();
    $getFile  = $error->getFile();
    $getLine  = $error->getLine();
    $getTrace = $error->getTrace();

    if (error_reporting() == E_ALL) {
      echo '
        <b>[PHP PDO Error ' . $getCode . ']</b><br><br>
        <table border="0">
          <tr><td align="right"><b>Mess:</b></td><td><i>' . $getMess . '</i></td></tr>
          <tr><td align="right"><b>Code:</b></td><td><i>' . $getCode . '</i></td></tr>
          <tr><td align="right"><b>File:</b></td><td><i>' . $getFile . '</i></td></tr>
          <tr><td align="right"><b>Line:</b></td><td><i>' . $getLine . '</i></td></tr>
        </table>
      ';
      echo '<br><b>Trace:</b><table border="0">';
      foreach ($getTrace as $a => $b) {
        foreach ($b as $c => $d) {
          if ($c == 'args') {
            foreach ($d as $e => $f) {
              echo '<tr><td><b>' . $a . '#</b></td><td align="right">args:</td> <td>' . $e . ':</td><td><i>' . $f . '</i></td></tr>';
            }
          }
          else {
            echo '<tr><td><b>' . $a . '#</b></td><td align="right">' . $c . ':</td><td></td><td><i>' . $d . '</i></td></tr>';
          }
        }
      }
      echo '</table>';
      exit;
    }

  }

  /**
   * Устанавливает соединение с БД (или получает существующее)
   */
  static function connect() {
    if (self::$_instance === NULL) {
      self::$_instance = new self;
    }
    return self::$_instance;
  }

  /**
   * Подготавливает SQL запрос
   */
  function prepare($sql) {
    return self::$_database->prepare($sql);
  }

  /**
   * Выполняет SQL-запрос, перехватывая ошибки
   * @param  object  $pre  Подготовленный SQL-запрос
   */
  function execute($pre) {
    try {
      $res = $pre->execute();
    }
    catch (PDOException $error) {
      self::error($error);
    }
    return $res;
  }

  /**
   * Разберает следующую строку разультата запроса в массив
   * @param  object  $pre   Подготовленный SQL-запрос
   * @param  string  $type  Тип массива который нужно получить (assoc|num)
   */
  function fetch($pre, $type = 'assoc') {
    switch ($type) {
      case 'assoc': return $pre->fetch(PDO::FETCH_ASSOC);
      case 'num'  : return $pre->fetch(PDO::FETCH_NUM);
    }
  }

  /**
   * Разберает весь разультат запроса в массив
   * @param  object  $pre   Подготовленный SQL-запрос
   * @param  string  $type  Тип массива который нужно получить (assoc|num)
   */
  function fetchAll($pre, $type = 'assoc') {
    switch ($type) {
      case 'assoc': return $pre->fetchAll(PDO::FETCH_ASSOC);
      case 'num'  : return $pre->fetchAll(PDO::FETCH_NUM);
    }
  }

  /**
   * Определяет ID последней вставки в БД
   */
  function last_insert_id() {
    return (isset(self::$_database)) ? (int)self::$_database->lastInsertId() : FALSE;
  }

}
