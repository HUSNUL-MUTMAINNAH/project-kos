<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/Chat.php";
require_once __DIR__ . "/../../Models/User.php";

class PenyewaChatController extends Controller {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user']['id'];

        // anggap admin dengan id terkecil berperan sebagai admin
        $userModel = new User();
        $dbAdmin = Database::getConnection()->query("SELECT * FROM users WHERE role='admin' ORDER BY id ASC LIMIT 1")->fetch();
        $adminId = $dbAdmin ? (int)$dbAdmin['id'] : 1;

        $chatModel = new Chat();
        $messages = $chatModel->getConversation($userId, $adminId);

        $this->view("penyewa/chat", compact('messages', 'dbAdmin'));
    }

    public function send() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user']['id'];

        $dbAdmin = Database::getConnection()->query("SELECT * FROM users WHERE role='admin' ORDER BY id ASC LIMIT 1")->fetch();
        $adminId = $dbAdmin ? (int)$dbAdmin['id'] : 1;

        $message = trim($_POST['message'] ?? '');
        if ($message !== '') {
            $chatModel = new Chat();
            $chatModel->sendMessage($userId, $adminId, $message);
        }

        header("Location: /?r=penyewa/chat");
        exit;
    }
}
