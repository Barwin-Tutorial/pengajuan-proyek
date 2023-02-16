DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    TRIGGER `inventaris`.`update_pengembalian_alat` BEFORE UPDATE
    ON `inventaris`.`pengembalian`
    FOR EACH ROW BEGIN
	UPDATE alat SET stok=stok-old.stok_in+new.stok_in WHERE id_alat=old.id_alat;
    END$$

DELIMITER ;