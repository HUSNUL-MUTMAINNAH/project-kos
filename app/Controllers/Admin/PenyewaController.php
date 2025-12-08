<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/User.php";
require_once __DIR__ . "/../../Models/Kamar.php";
require_once __DIR__ . "/../../Models/Pembayaran.php";

class AdminPenyewaController extends Controller {

    public function index() {
        $userModel = new User();
        $penyewa = $userModel->getAllPenyewa();
        $this->view("admin/penyewa_index", compact('penyewa'));
    }

    public function show() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $userModel = new User();
        $kamarModel = new Kamar();
        $pembayaranModel = new Pembayaran();

        $penyewa = $userModel->findById($id);
        if (!$penyewa || $penyewa['role'] !== 'penyewa') {
            echo "Penyewa tidak ditemukan";
            return;
        }
        $kamar = $kamarModel->getAll();
        $riwayat = $pembayaranModel->getByUser($id);

        $this->view("admin/penyewa_show", compact('penyewa', 'kamar', 'riwayat'));
    }

    // admin hanya boleh mengubah kamar
    public function updateKamar() {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $kamarId = isset($_POST['kamar_id']) && $_POST['kamar_id'] !== '' ? (int)$_POST['kamar_id'] : null;

        $userModel = new User();
        $userModel->updateKamarPenyewa($id, $kamarId);

        header("Location: /?r=admin/penyewa_show&id=" . $id);
        exit;
    }
}
