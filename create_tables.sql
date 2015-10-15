-- Пользователи
CREATE TABLE `core_users` (
  `id`        int(11)     NOT NULL AUTO_INCREMENT,
  `email`     varchar(64) NOT NULL,
  `password`  varchar(64) NOT NULL,
  `autologin` tinyint(1)  NOT NULL,
  `confirm`   tinyint(1)  NOT NULL,
  `date`      datetime    NOT NULL,
  `wrongs`    int(11)     NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
