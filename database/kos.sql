CREATE DATABASE IF NOT EXISTS kos;
USE kos;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','penyewa') NOT NULL,
    nik VARCHAR(50) NULL,
    phone VARCHAR(20) NULL,
    photo VARCHAR(255) NULL,
    kamar_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS kamar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    status ENUM('tersedia','tidak_tersedia') DEFAULT 'tersedia'
);

CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tanggal DATE NOT NULL,
    jumlah INT NOT NULL,
    status ENUM('menunggu','lunas','tidak_lunas') DEFAULT 'menunggu',
    bukti VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pembayaran_user FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_chat_sender FOREIGN KEY (sender_id) REFERENCES users(id),
    CONSTRAINT fk_chat_receiver FOREIGN KEY (receiver_id) REFERENCES users(id)
);

-- Password hash default: "password"
INSERT INTO users (name, email, password, role) VALUES
('Admin Kos', 'admin@kos.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')
ON DUPLICATE KEY UPDATE email=email;

INSERT INTO users (name, email, password, role) VALUES
('Bayu', 'bayu@kos.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'penyewa')
ON DUPLICATE KEY UPDATE email=email;

INSERT INTO kamar (nama, harga, status) VALUES
('Kamar A', 1500000, 'tersedia'),
('Kamar B', 1200000, 'tidak_tersedia'),
('Kamar C', 1000000, 'tersedia'),
('Kamar D', 1300000, 'tersedia');

-- Contoh pembayaran
INSERT INTO pembayaran (user_id, tanggal, jumlah, status) VALUES
(2, '2024-04-15', 1500000, 'lunas'),
(2, '2024-03-15', 1500000, 'lunas'),
(2, '2024-02-15', 1500000, 'tidak_lunas');
