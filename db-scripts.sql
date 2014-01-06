CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ru_content` text NOT NULL,
  `en_content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

UPDATE `distribbooks`.`meta_titles` SET `group` = 'page' WHERE `meta_titles`.`id` =10;