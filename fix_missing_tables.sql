-- Missing tables for the Property Management System

-- Language table
CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Settings table
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Admin table
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Initial data for settings
INSERT INTO `settings` (`type`, `description`) VALUES ('system_name', 'Property Management System');
INSERT INTO `settings` (`type`, `description`) VALUES ('system_title', 'PMS Admin');
INSERT INTO `settings` (`type`, `description`) VALUES ('system_email', 'admin@example.com');
INSERT INTO `settings` (`type`, `description`) VALUES ('address', '123 Main St, City, Country');
INSERT INTO `settings` (`type`, `description`) VALUES ('phone', '555-0199');
INSERT INTO `settings` (`type`, `description`) VALUES ('paypal_email', 'paypal@example.com');
INSERT INTO `settings` (`type`, `description`) VALUES ('currency', 'USD');

-- Initial data for admin
INSERT INTO `admin` (`name`, `email`, `password`, `level`) VALUES ('Admin User', 'admin@example.com', 'admin', 1);

-- Initial data for language
INSERT INTO `language` (`phrase`, `english`) VALUES ('admin_dashboard', 'Admin Dashboard');
INSERT INTO `language` (`phrase`, `english`) VALUES ('login', 'Login');
INSERT INTO `language` (`phrase`, `english`) VALUES ('settings', 'Settings');
INSERT INTO `language` (`phrase`, `english`) VALUES ('system_settings', 'System Settings');
INSERT INTO `language` (`phrase`, `english`) VALUES ('manage_language', 'Manage Language');
INSERT INTO `language` (`phrase`, `english`) VALUES ('dashboard', 'Dashboard');
INSERT INTO `language` (`phrase`, `english`) VALUES ('manage_landlord', 'Manage Landlord');
INSERT INTO `language` (`phrase`, `english`) VALUES ('manage_property', 'Manage Property');
INSERT INTO `language` (`phrase`, `english`) VALUES ('manage_unit', 'Manage Unit');
INSERT INTO `language` (`phrase`, `english`) VALUES ('rental_application', 'Rental Application');
INSERT INTO `language` (`phrase`, `english`) VALUES ('rental_application_list', 'Rental Application List');
INSERT INTO `language` (`phrase`, `english`) VALUES ('manage_lease', 'Manage Lease');
INSERT INTO `language` (`phrase`, `english`) VALUES ('tenant_list', 'Tenant List');
INSERT INTO `language` (`phrase`, `english`) VALUES ('work_order', 'Work Order');
INSERT INTO `language` (`phrase`, `english`) VALUES ('maintenance_log', 'Maintenance Log');
INSERT INTO `language` (`phrase`, `english`) VALUES ('active_lease', 'Active Lease');
INSERT INTO `language` (`phrase`, `english`) VALUES ('settings_updated', 'Settings Updated');
INSERT INTO `language` (`phrase`, `english`) VALUES ('login_failed', 'Login Failed');
INSERT INTO `language` (`phrase`, `english`) VALUES ('logged_out', 'Logged Out');
