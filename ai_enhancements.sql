-- Mygate PMS AI Enhancements - Database Migration

-- 1. Unified Activity Log for AI Auditing
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `details` JSON DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 2. Flexible Metadata for Properties and Units
-- Allows AI to store and query unstructured attributes (e.g. "Pet Friendly", "Solar Power")
ALTER TABLE `property` ADD COLUMN `metadata` JSON DEFAULT NULL;
ALTER TABLE `unit` ADD COLUMN `metadata` JSON DEFAULT NULL;

-- 3. Full-Text Search Optimization
-- Significantly speeds up semantic and keyword search for the RAG system
ALTER TABLE `p_maintenance_log` ADD FULLTEXT INDEX `idx_maintenance_desc` (`Description`);
ALTER TABLE `p_maintenance_log` ADD FULLTEXT INDEX `idx_maintenance_notes` (`Notes`);
ALTER TABLE `p_marketing` ADD FULLTEXT INDEX `idx_marketing_desc` (`description`, `shortDescription`);
ALTER TABLE `noticeboard` ADD FULLTEXT INDEX `idx_notice_content` (`notice_title`, `notice`);

-- 4. Audit Trail for Financial Records
ALTER TABLE `journal` ADD COLUMN `metadata` JSON DEFAULT NULL;
ALTER TABLE `receipt` ADD COLUMN `metadata` JSON DEFAULT NULL;
