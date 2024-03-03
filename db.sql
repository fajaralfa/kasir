CREATE TABLE petugas (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    level ENUM('admin', 'petugas')
);

CREATE TABLE produk (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    harga INTEGER NOT NULL,
    stok INTEGER NOT NULL
);

CREATE TABLE penjualan (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tanggal_penjualan DATE NOT NULL,
    total_harga INTEGER NOT NULL,
    uang_masuk INTEGER NOT NULL
);

CREATE TABLE detail_penjualan (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    penjualan_id INTEGER NOT NULL,
    produk_id INTEGER NOT NULL,
    jumlah_produk INTEGER NOT NULL,
    subtotal INTEGER NOT NULL,
    FOREIGN KEY (penjualan_id) REFERENCES penjualan(id),
    FOREIGN KEY (produk_id) REFERENCES produk(id)
);

-- Trigger stok akan berkurang secara otomatis sesuai dengan jumlah_produk yang diisi
-- di subtotal tabel detail_penjualan
DELIMITER $$
CREATE TRIGGER after_insert_detail_penjualan
AFTER INSERT ON detail_penjualan FOR EACH ROW
BEGIN
    UPDATE produk SET stok = stok - NEW.jumlah_produk
    WHERE id = NEW.produk_id;
END$$
DELIMITER ;

INSERT INTO petugas (nama, username, password, level) VALUES
('Administrator', 'admin', 'admin', 'admin');