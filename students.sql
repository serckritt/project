CREATE TABLE `students` (
	`st_num` INT(11) UNSIGNED NOT NULL,
	`st_name` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`st_num`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
