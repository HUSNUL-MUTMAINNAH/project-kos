<?php
require_once __DIR__ . "/../Core/Database.php";

class Pembayaran {
    private $db;
    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function countByStatus(string $status) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM pembayaran WHERE status = ?");
        $stmt->execute([$status]);
        return (int)$stmt->fetchColumn();
    }

    public function getAllWithUser() {
        $sql = "SELECT p.*, u.name AS nama_penyewa
                FROM pembayaran p
                JOIN users u ON p.user_id = u.id
                ORDER BY p.tanggal DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getMenunggu() {
        $sql = "SELECT p.*, u.name AS nama_penyewa
                FROM pembayaran p
                JOIN users u ON p.user_id = u.id
                WHERE p.status = 'menunggu'
                ORDER BY p.tanggal DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status) {
        $stmt = $this->db->prepare("UPDATE pembayaran SET status=? WHERE id=?");
        return $stmt->execute([$status, $id]);
    }

    public function getByUser(int $userId) {
        $stmt = $this->db->prepare("SELECT * FROM pembayaran WHERE user_id=? ORDER BY tanggal DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function createMenunggu(int $userId, string $tanggal, int $jumlah, ?string $bukti) {
        $stmt = $this->db->prepare("INSERT INTO pembayaran (user_id, tanggal, jumlah, status, bukti)
                                    VALUES (?, ?, ?, 'menunggu', ?)");
        return $stmt->execute([$userId, $tanggal, $jumlah, $bukti]);
    }
}
