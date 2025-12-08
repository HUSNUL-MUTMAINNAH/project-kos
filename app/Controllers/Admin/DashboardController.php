<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/Kamar.php";
require_once __DIR__ . "/../../Models/User.php";
require_once __DIR__ . "/../../Models/Pembayaran.php";

class AdminDashboardController extends Controller {
    public function index() {
        $kamarModel = new Kamar();
        $userModel = new User();
        $pembayaranModel = new Pembayaran();

        $totalKamar = $kamarModel->countAll();
        $totalPenyewa = count($userModel->getAllPenyewa());
        $pembayaranLunas = $pembayaranModel->countByStatus('lunas');
        $pembayaranTunggakan = $pembayaranModel->countByStatus('tidak_lunas');

        $daftarKamar = $kamarModel->getAll();

        $this->view("admin/dashboard", compact(
            'totalKamar',
            'totalPenyewa',
            'pembayaranLunas',
            'pembayaranTunggakan',
            'daftarKamar'
        ));
    }
}
