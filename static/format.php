<?php

/**
 * Набор методов, преобразующих данные
 */
class format
{

  /**
   * Преобразовывает символы в HTML-сущности
   * @param  array|string
   * @return array|string|false
   */
  static function html_special_chars($source = NULL) {

    if ($source === NULL) return FALSE;

    if (is_array($source)) {

      if (empty($source)) return [];

      foreach ($source as $key => $val) {
        $clear[htmlspecialchars($key)] = (is_array($val))
                                       ? self::html_special_chars($val)
                                       : htmlspecialchars($val);
      }

    }

    else {
      return htmlspecialchars($source);
    }

    return $clear;

  }

}
