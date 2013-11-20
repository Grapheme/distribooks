ALTER TABLE `formats` CHANGE `description` `ru_description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `formats` ADD `en_description` TEXT NOT NULL AFTER `ru_description` ;
