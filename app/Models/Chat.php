<?php
require_once __DIR__ . "/../Core/Database.php";

class Chat {
    private $db;
    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getConversation(int $userId1, int $userId2) {
        $sql = "SELECT * FROM chat 
                WHERE (sender_id = :u1 AND receiver_id = :u2)
                   OR (sender_id = :u2 AND receiver_id = :u1)
                ORDER BY created_at ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['u1' => $userId1, 'u2' => $userId2]);
        return $stmt->fetchAll();
    }

    public function sendMessage(int $senderId, int $receiverId, string $message) {
        $stmt = $this->db->prepare("INSERT INTO chat (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$senderId, $receiverId, $message]);
    }
}
