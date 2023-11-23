CREATE TABLE `score` (
	`ex_num` INT(11) UNSIGNED NOT NULL,
	`st_num` INT(11) UNSIGNED NOT NULL,
	`sb_num` INT(11) UNSIGNED NOT NULL,
	`sc_score` INT(10) UNSIGNED NULL DEFAULT NULL,
	INDEX `ex_num` (`ex_num`) USING BTREE,
	INDEX `st_num` (`st_num`) USING BTREE,
	INDEX `sb_num` (`sb_num`) USING BTREE,
	CONSTRAINT `ex_num` FOREIGN KEY (`ex_num`) REFERENCES `phpdb`.`exam` (`ex_num`) ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT `sb_num` FOREIGN KEY (`sb_num`) REFERENCES `phpdb`.`subject` (`sb_num`) ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT `st_num` FOREIGN KEY (`st_num`) REFERENCES `phpdb`.`students` (`st_num`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
