<?php
require_once __DIR__ . "/../Core/Database.php";

class Kamar {
    private $db;
    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM kamar ORDER BY id");
        return $stmt->fetchAll();
    }

    public function getAvailable() {
        $stmt = $this->db->query("SELECT * FROM kamar WHERE status = 'tersedia' ORDER BY id");
        return $stmt->fetchAll();
    }

    public function countAll() {
        return (int)$this->db->query("SELECT COUNT(*) FROM kamar")->fetchColumn();
    }

    public function create($nama, $harga, $status) {
    $stmt = $this->db->prepare("
        INSERT INTO kamar (nama, harga, status) 
        VALUES (?, ?, ?)
    ");
    return $stmt->execute([$nama, $harga, $status]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kamar WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $nama, $harga, $status) {
        $stmt = $this->db->prepare("
            UPDATE kamar 
            SET nama = ?, harga = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([$nama, $harga, $status, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kamar WHERE id = ?");
        return $stmt->execute([$id]);
    }


}
