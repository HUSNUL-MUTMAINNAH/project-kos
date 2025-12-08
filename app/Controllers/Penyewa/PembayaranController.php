<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/Pembayaran.php";

class PenyewaPembayaranController extends Controller {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user']['id'];

        $pembayaranModel = new Pembayaran();
        $pembayaran = $pembayaranModel->getByUser($userId);

        $this->view("penyewa/pembayaran", compact('pembayaran'));
    }

    // penyewa hanya mengirim bukti, status otomatis 'menunggu'
    public function kirim() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user']['id'];

        $tanggal = $_POST['tanggal'] ?? date('Y-m-d');
        $jumlah = (int)($_POST['jumlah'] ?? 0);
        $buktiPath = null;

        if (!empty($_FILES['bukti']['name'])) {
            $uploadDir = __DIR__ . "/../../../public/assets/uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = time() . "_" . basename($_FILES['bukti']['name']);
            $target = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['bukti']['tmp_name'], $target)) {
                $buktiPath = "assets/uploads/" . $fileName;
            }
        }

        if ($jumlah > 0) {
            $pembayaranModel = new Pembayaran();
            $pembayaranModel->createMenunggu($userId, $tanggal, $jumlah, $buktiPath);
        }

        header("Location: /?r=penyewa/pembayaran");
        exit;
    }
}
