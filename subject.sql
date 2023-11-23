CREATE TABLE `subject` (
	`sb_num` INT(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`sb_name` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`sb_num`) USING BTREE,
	UNIQUE INDEX `sb_name` (`sb_name`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=500502
;
 