DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    TRIGGER `inventaris`.`del_peminjaman_alat` BEFORE DELETE
    ON `inventaris`.`peminjaman`
    FOR EACH ROW BEGIN
	UPDATE alat SET stok=stok + old.stok_out WHERE id_alat=old.id_alat;
    END$$

DELIMITER ;