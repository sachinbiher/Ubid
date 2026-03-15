ALTER TABLE `users` ADD `ref_id` INT(11) NULL DEFAULT NULL AFTER `id`, ADD `user_type` VARCHAR(20) NULL DEFAULT NULL COMMENT 'staff,customer,vendor' AFTER `ref_id`;

ALTER TABLE `vendors` ADD `id_proof_front` VARCHAR(255) NULL DEFAULT NULL AFTER `id_proof`, ADD `id_proof_back` VARCHAR(255) NULL DEFAULT NULL AFTER `id_proof_front`, ADD `profile_status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '1=>completed, 0=>pending' AFTER `pincode`, ADD `otp` INT(10) NULL DEFAULT NULL AFTER `status`, ADD `otp_max_time` TIMESTAMP NULL DEFAULT NULL AFTER `otp`, ADD `password` VARCHAR(255) NULL DEFAULT NULL AFTER `email`;

ALTER TABLE `vendors` CHANGE `vendor_id` `vendor_id` VARCHAR(11) NULL DEFAULT NULL;