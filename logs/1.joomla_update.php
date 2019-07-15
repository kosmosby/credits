#
#<?php die('Forbidden.'); ?>
#Date: 2019-07-15 08:24:19 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2019-07-15T08:24:19+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.4.8.
2019-07-15T08:24:19+00:00	INFO 127.0.0.1	update	Downloading update file from https://downloads.joomla.org/cms/joomla3/3-6-5/Joomla_3.6.5-Stable-Update_Package.zip.
2019-07-15T08:25:50+00:00	INFO 127.0.0.1	update	File Joomla_3.6.5-Stable-Update_Package.zip successfully downloaded.
2019-07-15T08:25:52+00:00	INFO 127.0.0.1	update	Starting installation of new version.
2019-07-15T08:30:10+00:00	INFO 127.0.0.1	update	Finalising installation.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-07-01. Query text: ALTER TABLE `#__session` MODIFY `session_id` varchar(191) NOT NULL DEFAULT '';.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-07-01. Query text: ALTER TABLE `#__user_keys` MODIFY `series` varchar(191) NOT NULL;.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-10-13. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-10-26. Query text: ALTER TABLE `#__contentitem_tag_map` DROP INDEX `idx_tag`;.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-10-26. Query text: ALTER TABLE `#__contentitem_tag_map` DROP INDEX `idx_type`;.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-10-30. Query text: UPDATE `#__menu` SET `title` = 'com_contact_contacts' WHERE `client_id` = 1 AND .
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-11-04. Query text: DELETE FROM `#__menu` WHERE `title` = 'com_messages_read' AND `client_id` = 1;.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-11-04. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-11-05. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:30:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2015-11-05. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-02-26. Query text: CREATE TABLE IF NOT EXISTS `#__utf8_conversion` (   `converted` tinyint(4) NOT N.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-02-26. Query text: INSERT INTO `#__utf8_conversion` (`converted`) VALUES (0);.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` DROP INDEX `idx_link_old`;.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` MODIFY `old_url` VARCHAR(2048) NOT NULL;.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` MODIFY `new_url` VARCHAR(2048);.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` MODIFY `referer` VARCHAR(2048) NOT NULL;.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` ADD INDEX `idx_old_url` (`old_url`(100));.
2019-07-15T08:30:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.1-2016-03-25. Query text: ALTER TABLE `#__user_keys` MODIFY `user_id` varchar(150) NOT NULL;.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.5.1-2016-03-29. Query text: UPDATE `#__utf8_conversion` SET `converted` = 0  WHERE (SELECT COUNT(*) FROM `#_.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `name` = 'Joomla! Core' WHERE `name` = 'Joomla Core.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `name` = 'Joomla! Extension Directory' WHERE `name`.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/core/list.x.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/jed/list.xm.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/language/tr.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/core/extens.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-06. Query text: ALTER TABLE `#__redirect_links` MODIFY `new_url` VARCHAR(2048);.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-08. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-08. Query text: UPDATE `#__update_sites_extensions` SET `extension_id` = 802 WHERE `update_site_.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-04-09. Query text: ALTER TABLE `#__menu_types` ADD COLUMN `asset_id` INT(11) NOT NULL AFTER `id`;.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-05-06. Query text: DELETE FROM `#__extensions` WHERE `type` = 'library' AND `element` = 'simplepie'.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-05-06. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-06-01. Query text: UPDATE `#__extensions` SET `protected` = 1, `enabled` = 1  WHERE `name` = 'com_a.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.0-2016-06-05. Query text: ALTER TABLE `#__languages` ADD COLUMN `asset_id` INT(11) NOT NULL AFTER `lang_id.
2019-07-15T08:30:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.3-2016-08-15. Query text: ALTER TABLE `#__newsfeeds` MODIFY `link` VARCHAR(2048) NOT NULL;.
2019-07-15T08:30:14+00:00	INFO 127.0.0.1	update	Ran query from file 3.6.3-2016-08-16. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:30:14+00:00	INFO 127.0.0.1	update	Deleting removed files and folders.
2019-07-15T08:30:53+00:00	INFO 127.0.0.1	update	Finalising installation.
2019-07-15T08:30:53+00:00	INFO 127.0.0.1	update	Deleting removed files and folders.
2019-07-15T08:31:30+00:00	INFO 127.0.0.1	update	Finalising installation.
2019-07-15T08:31:31+00:00	INFO 127.0.0.1	update	Deleting removed files and folders.
2019-07-15T08:32:28+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:32:30+00:00	INFO 127.0.0.1	update	Downloading update file from https://downloads.joomla.org/cms/joomla3/3-9-10/Joomla_3.9.10-Stable-Update_Package.zip.
2019-07-15T08:34:13+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:34:14+00:00	INFO 127.0.0.1	update	Downloading update file from https://downloads.joomla.org/cms/joomla3/3-9-10/Joomla_3.9.10-Stable-Update_Package.zip.
2019-07-15T08:35:54+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:35:55+00:00	INFO 127.0.0.1	update	Downloading update file from https://downloads.joomla.org/cms/joomla3/3-9-10/Joomla_3.9.10-Stable-Update_Package.zip.
2019-07-15T08:40:02+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:40:10+00:00	INFO 127.0.0.1	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.9.10-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20190715%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20190715T084006Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=c22fe43aaf423b59ed6750049e165e15fb60bb581eb5844513fb628dad25d14d.
2019-07-15T08:42:52+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:42:58+00:00	INFO 127.0.0.1	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.9.10-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20190715%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20190715T084254Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=21023688265f175fb94dfb7e5ffaab28457d12c7a657c19b6d6b991aaefc4c2a.
2019-07-15T08:46:11+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:46:18+00:00	INFO 127.0.0.1	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.9.10-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20190715%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20190715T084613Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=7254cfdb14f1c4a9602c15cc05160fb5ce49fe7f192f6da6450cc2663b52e053.
2019-07-15T08:48:35+00:00	INFO 127.0.0.1	update	Update started by user Super User (928). Old version is 3.6.5.
2019-07-15T08:48:41+00:00	INFO 127.0.0.1	update	Downloading update file from https://s3-us-west-2.amazonaws.com/joomla-official-downloads/joomladownloads/joomla3/Joomla_3.9.10-Stable-Update_Package.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAIZ6S3Q3YQHG57ZRA%2F20190715%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20190715T084837Z&X-Amz-Expires=60&X-Amz-SignedHeaders=host&X-Amz-Signature=2f9bd2972373a7f658229a18e2155047938da6c22f608f92c59652688071f6e5.
2019-07-15T08:49:39+00:00	INFO 127.0.0.1	update	File Joomla_3.9.10-Stable-Update_Package.zip successfully downloaded.
2019-07-15T08:49:41+00:00	INFO 127.0.0.1	update	Starting installation of new version.
2019-07-15T08:55:57+00:00	INFO 127.0.0.1	update	Finalising installation.
2019-07-15T08:55:58+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-06. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:55:58+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-22. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:55:58+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields` (   `id` int(10) unsigned NOT NULL AUTO_I.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields_categories` (   `field_id` int(11) NOT NUL.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields_groups` (   `id` int(10) unsigned NOT NULL.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-29. Query text: CREATE TABLE IF NOT EXISTS `#__fields_values` (   `field_id` int(10) unsigned NO.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-29. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-08-29. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-09-29. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:55:59+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-10-01. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:56:00+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-10-02. Query text: ALTER TABLE `#__session` MODIFY `client_id` tinyint(3) unsigned DEFAULT NULL;.
2019-07-15T08:56:00+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-04. Query text: ALTER TABLE `#__extensions` CHANGE `enabled` `enabled` TINYINT(3) NOT NULL DEFAU.
2019-07-15T08:56:00+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-19. Query text: ALTER TABLE `#__menu_types` ADD COLUMN `client_id` int(11) NOT NULL DEFAULT 0;.
2019-07-15T08:56:00+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-19. Query text: UPDATE `#__menu` SET `published` = 1 WHERE `menutype` = 'main' OR `menutype` = '.
2019-07-15T08:56:01+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-21. Query text: ALTER TABLE `#__languages` DROP INDEX `idx_image`;.
2019-07-15T08:56:01+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-24. Query text: ALTER TABLE `#__extensions` ADD COLUMN `package_id` int(11) NOT NULL DEFAULT 0 C.
2019-07-15T08:56:01+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-24. Query text: UPDATE `#__extensions` AS `e1` INNER JOIN (SELECT `extension_id` FROM `#__extens.
2019-07-15T08:56:02+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2016-11-27. Query text: ALTER TABLE `#__modules` MODIFY `content` text NOT NULL DEFAULT '';.
2019-07-15T08:56:02+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_title` varchar(400) NOT NULL DEFAULT '.
2019-07-15T08:56:02+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_alias` varchar(400) CHARACTER SET utf8.
2019-07-15T08:56:03+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_body` mediumtext NOT NULL DEFAULT '';.
2019-07-15T08:56:03+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_checked_out_time` varchar(255) NOT NUL.
2019-07-15T08:56:03+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_params` text NOT NULL DEFAULT '';.
2019-07-15T08:56:04+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metadata` varchar(2048) NOT NULL DEFAU.
2019-07-15T08:56:04+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_language` char(7) NOT NULL DEFAULT '';.
2019-07-15T08:56:04+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_publish_up` datetime NOT NULL DEFAULT .
2019-07-15T08:56:04+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_publish_down` datetime NOT NULL DEFAUL.
2019-07-15T08:56:05+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_content_item_id` int(10) unsigned NOT .
2019-07-15T08:56:06+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `asset_id` int(10) unsigned NOT NULL DEFAULT.
2019-07-15T08:56:06+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_images` text NOT NULL DEFAULT '';.
2019-07-15T08:56:06+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_urls` text NOT NULL DEFAULT '';.
2019-07-15T08:56:07+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metakey` text NOT NULL DEFAULT '';.
2019-07-15T08:56:07+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metadesc` text NOT NULL DEFAULT '';.
2019-07-15T08:56:07+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_xreference` varchar(50) NOT NULL DEFAU.
2019-07-15T08:56:08+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-08. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_type_id` int(10) unsigned NOT NULL DEF.
2019-07-15T08:56:08+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `title` varchar(255) NOT NULL DEFAULT '';.
2019-07-15T08:56:08+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `description` mediumtext NOT NULL DEFAULT '';.
2019-07-15T08:56:09+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `params` text NOT NULL DEFAULT '';.
2019-07-15T08:56:09+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `metadesc` varchar(1024) NOT NULL DEFAULT '' .
2019-07-15T08:56:09+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `metakey` varchar(1024) NOT NULL DEFAULT '' C.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `metadata` varchar(2048) NOT NULL DEFAULT '' .
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-09. Query text: ALTER TABLE `#__categories` MODIFY `language` char(7) NOT NULL DEFAULT '';.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-15. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `menutype` = 'main_is_reserved_133C585'  WHERE `client_i.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__modules`    SET `params` = REPLACE(`params`,'"menutype":"main"','"men.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu_types`    SET `menutype` = 'main_is_reserved_133C585'  WHERE `cl.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `client_id` = 1  WHERE `menutype` = 'main';.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `menutype` = 'main'  WHERE `client_id` = 1     AND `menu.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: UPDATE `#__menu`    SET `menutype` = 'main',        `client_id` = 1  WHERE `menu.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-17. Query text: DELETE FROM `#__menu_types`  WHERE `client_id` = 1    AND `menutype` IN ('main',.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-01-31. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:56:10+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-02. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2019-07-15T08:56:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-15. Query text: ALTER TABLE `#__redirect_links` MODIFY `comment` varchar(255) NOT NULL DEFAULT '.
2019-07-15T08:56:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `name` varchar(255) NOT NULL;.
2019-07-15T08:56:11+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `alias` varchar(400) CHARACTER SET utf8m.
2019-07-15T08:56:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `sortname1` varchar(255) NOT NULL DEFAUL.
2019-07-15T08:56:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `sortname2` varchar(255) NOT NULL DEFAUL.
2019-07-15T08:56:12+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `sortname3` varchar(255) NOT NULL DEFAUL.
2019-07-15T08:56:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `language` varchar(7) NOT NULL;.
2019-07-15T08:56:13+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-02-17. Query text: ALTER TABLE `#__contact_details` MODIFY `xreference` varchar(50) NOT NULL DEFAUL.
2019-07-15T08:56:14+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE `#__languages` MODIFY `asset_id` int(10) unsigned NOT NULL DEFAULT 0.
2019-07-15T08:56:14+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE `#__menu_types` MODIFY `asset_id` int(10) unsigned NOT NULL DEFAULT .
2019-07-15T08:56:14+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE  `#__content` MODIFY `xreference` varchar(50) NOT NULL DEFAULT '';.
2019-07-15T08:56:14+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-03. Query text: ALTER TABLE  `#__newsfeeds` MODIFY `xreference` varchar(50) NOT NULL DEFAULT '';.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__categories` SET `published` = 1 WHERE `alias` = 'root';.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__categories` AS `c` INNER JOIN ( 	SELECT c2.id, CASE WHEN MIN(p.publis.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__menu` SET `published` = 1 WHERE `alias` = 'root';.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-09. Query text: UPDATE `#__menu` AS `c` INNER JOIN ( 	SELECT c2.id, CASE WHEN MIN(p.published) >.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-03-19. Query text: ALTER TABLE `#__finder_links` MODIFY `description` text;.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-04-10. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.0-2017-04-19. Query text: UPDATE `#__extensions` SET `params` = '{"multiple":"0","first":"1","last":"100",.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.3-2017-06-03. Query text: ALTER TABLE `#__menu` MODIFY `checked_out_time` datetime NOT NULL DEFAULT '0000-.
2019-07-15T08:56:15+00:00	INFO 127.0.0.1	update	Ran query from file 3.7.4-2017-07-05. Query text: DELETE FROM `#__postinstall_messages` WHERE `title_key` = 'COM_CPANEL_MSG_PHPVER.
2019-07-15T08:56:16+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.0-2017-07-28. Query text: ALTER TABLE `#__fields_groups` ADD COLUMN `params` TEXT  NOT NULL  AFTER `orderi.
2019-07-15T08:56:16+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.0-2017-07-31. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:16+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.2-2017-10-14. Query text: ALTER TABLE `#__content` ADD INDEX `idx_alias` (`alias`(191));.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.4-2018-01-16. Query text: ALTER TABLE `#__user_keys` DROP INDEX `series_2`;.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.4-2018-01-16. Query text: ALTER TABLE `#__user_keys` DROP INDEX `series_3`;.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.6-2018-02-14. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.6-2018-02-14. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.8-2018-05-18. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.8.9-2018-06-19. Query text: UPDATE `#__extensions` SET `enabled` = '1' WHERE `name` = 'mod_sampledata';.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-02. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-02. Query text: CREATE TABLE IF NOT EXISTS `#__privacy_requests` (   `id` int(10) unsigned NOT N.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-03. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-05. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:17+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-05. Query text: CREATE TABLE IF NOT EXISTS `#__action_logs` (   `id` int(10) unsigned NOT NULL A.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-05. Query text: CREATE TABLE IF NOT EXISTS `#__action_logs_extensions` (   `id` int(10) unsigned.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-05. Query text: INSERT INTO `#__action_logs_extensions` (`id`, `extension`) VALUES (1, 'com_bann.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-05. Query text: CREATE TABLE IF NOT EXISTS `#__action_log_config` (   `id` int(10) unsigned NOT .
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-05. Query text: INSERT INTO `#__action_log_config` (`id`, `type_title`, `type_alias`, `id_holder.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-19. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-20. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-24. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-24. Query text: CREATE TABLE IF NOT EXISTS `#__privacy_consents` (   `id` int(10) unsigned NOT N.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-05-27. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-06-02. Query text: ALTER TABLE `#__content` ADD COLUMN `note` VARCHAR(255) NOT NULL DEFAULT '';.
2019-07-15T08:56:18+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-06-02. Query text: UPDATE `#__content_types` SET `field_mappings` =  '{"common":{"core_content_item.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-06-12. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-06-13. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-06-14. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-06-17. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-07-09. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-07-10. Query text: INSERT INTO `#__action_log_config` (`id`, `type_title`, `type_alias`, `id_holder.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-07-11. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-08-12. Query text: ALTER TABLE `#__privacy_consents` ADD COLUMN `state` INT(10) NOT NULL DEFAULT 1 .
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-08-28. Query text: ALTER TABLE `#__session` MODIFY `session_id` varbinary(192) NOT NULL;.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-08-28. Query text: ALTER TABLE `#__session` MODIFY `guest` tinyint(3) unsigned DEFAULT 1;.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-08-28. Query text: ALTER TABLE `#__session` MODIFY `time` int(11) NOT NULL DEFAULT 0;.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-08-29. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:19+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-09-04. Query text: CREATE TABLE IF NOT EXISTS `#__action_logs_users` (   `user_id` int(11) UNSIGNED.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-15. Query text: ALTER TABLE `#__action_logs` ADD INDEX `idx_user_id` (`user_id`);.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-15. Query text: ALTER TABLE `#__action_logs` ADD INDEX `idx_user_id_logdate` (`user_id`, `log_da.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-15. Query text: ALTER TABLE `#__action_logs` ADD INDEX `idx_user_id_extension` (`user_id`, `exte.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-15. Query text: ALTER TABLE `#__action_logs` ADD INDEX `idx_extension_item_id` (`extension`, `it.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-20. Query text: ALTER TABLE `#__privacy_requests` DROP INDEX `idx_checkout`;.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-20. Query text: ALTER TABLE `#__privacy_requests` DROP COLUMN `checked_out`;.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-20. Query text: ALTER TABLE `#__privacy_requests` DROP COLUMN `checked_out_time`;.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.0-2018-10-21. Query text: INSERT INTO `#__extensions` (`extension_id`, `package_id`, `name`, `type`, `elem.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.3-2019-01-12. Query text: UPDATE `#__extensions`  SET `params` = REPLACE(`params`, '"com_categories",', '".
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.3-2019-01-12. Query text: INSERT INTO `#__action_logs_extensions` (`extension`) VALUES ('com_checkin');.
2019-07-15T08:56:20+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.3-2019-02-07. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.7-2019-04-23. Query text: ALTER TABLE `#__session` ADD INDEX `client_id_guest` (`client_id`, `guest`);.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.7-2019-04-26. Query text: UPDATE `#__content_types` SET `content_history_options` = REPLACE(`content_histo.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.8-2019-06-11. Query text: UPDATE #__users SET params = REPLACE(params, '",,"', '","');.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.8-2019-06-15. Query text: ALTER TABLE `#__template_styles` DROP INDEX `idx_home`;.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.8-2019-06-15. Query text: ALTER TABLE `#__template_styles` ADD INDEX `idx_client_id` (`client_id`);.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.8-2019-06-15. Query text: ALTER TABLE `#__template_styles` ADD INDEX `idx_client_id_home` (`client_id`, `h.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Ran query from file 3.9.10-2019-07-09. Query text: ALTER TABLE `#__template_styles` MODIFY `home` char(7) NOT NULL DEFAULT '0';.
2019-07-15T08:56:21+00:00	INFO 127.0.0.1	update	Deleting removed files and folders.
2019-07-15T08:57:16+00:00	INFO 127.0.0.1	update	Cleaning up after installation.
2019-07-15T08:57:16+00:00	INFO 127.0.0.1	update	Update to version 3.9.10 is complete.
