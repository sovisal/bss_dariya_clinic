-- 2022-03-11
ALTER TABLE patients ADD COLUMN age INT(10) AFTER date_of_birth;

-- 2022-05-06
ALTER TABLE `consultations` CHANGE `evaluation_at` `evaluated_at` DATETIME NOT NULL;
ALTER TABLE `consultations` DROP `past_medical_record`, DROP `examination`, DROP `evaluation`;
ALTER TABLE `consultations` CHANGE `vital_sign` `json_data` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
ALTER TABLE `consultations` ADD `status` VARCHAR(255) NOT NULL DEFAULT 'save' AFTER `evaluated_at`;