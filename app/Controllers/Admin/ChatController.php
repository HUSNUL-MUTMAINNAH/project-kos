<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/User.php";
require_once __DIR__ . "/../../Models/Chat.php";

class AdminChatController extends Controller {

    public function index() {
        $userModel = new User();
        $penyewa = $userModel->getAllPenyewa();
        $this->view("admin/chat_index", compact('penyewa'));
    }

    public function show() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $adminId = $_SESSION['user']['id'];
        $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

        $chatModel = new Chat();
        $userModel = new User();

        $penyewa = $userModel->findById($userId);
        if (!$penyewa || $penyewa['role'] !== 'penyewa') {
            echo "Penyewa tidak ditemukan";
            return;
        }

        $messages = $chatModel->getConversation($adminId, $userId);
        $this->view("admin/chat_show", compact('messages', 'penyewa'));
    }

    public function send() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $adminId = $_SESSION['user']['id'];
        $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
        $message = trim($_POST['message'] ?? '');

        if ($message !== '') {
            $chatModel = new Chat();
            $chatModel->sendMessage($adminId, $userId, $message);
        }

        header("Location: /?r=admin/chat_show&user_id=" . $userId);
        exit;
    }
}
