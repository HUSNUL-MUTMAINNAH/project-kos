<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/Pembayaran.php";

class AdminPembayaranController extends Controller {

    public function index() {
        $pembayaranModel = new Pembayaran();
        $menunggu = $pembayaranModel->getMenunggu();
        $semua = $pembayaranModel->getAllWithUser();
        $this->view("admin/pembayaran_index", compact('menunggu', 'semua'));
    }

    // admin hanya boleh mengubah status (lunas / tidak_lunas)
    public function updateStatus() {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $status = $_POST['status'] ?? '';

        if (!in_array($status, ['lunas', 'tidak_lunas'], true)) {
            echo "Status tidak valid";
            return;
        }

        $pembayaranModel = new Pembayaran();
        $pembayaranModel->updateStatus($id, $status);

        header("Location: /?r=admin/pembayaran");
        exit;
    }
}
