<?php
require_once __DIR__ . "/../Core/Database.php";

class User {
    private $db;
    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findByEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findById(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllPenyewa() {
        $stmt = $this->db->query("SELECT u.*, k.nama AS nama_kamar FROM users u
                                  LEFT JOIN kamar k ON u.kamar_id = k.id
                                  WHERE role = 'penyewa'");
        return $stmt->fetchAll();
    }

    public function updateProfilPenyewa(int $id, string $name, string $nik, string $phone, ?string $photoPath) {
        if ($photoPath) {
            $stmt = $this->db->prepare("UPDATE users SET name=?, nik=?, phone=?, photo=? WHERE id=? AND role='penyewa'");
            return $stmt->execute([$name, $nik, $phone, $photoPath, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET name=?, nik=?, phone=? WHERE id=? AND role='penyewa'");
            return $stmt->execute([$name, $nik, $phone, $id]);
        }
    }

    public function updateKamarPenyewa(int $id, ?int $kamarId) {
        $stmt = $this->db->prepare("UPDATE users SET kamar_id=? WHERE id=? AND role='penyewa'");
        return $stmt->execute([$kamarId, $id]);
    }


    public function createPenyewa($name, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password, role) 
            VALUES (?, ?, ?, 'penyewa')
        ");

        return $stmt->execute([$name, $email, $hash]);
    }
}