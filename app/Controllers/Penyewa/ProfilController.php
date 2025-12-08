<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/User.php";
require_once __DIR__ . "/../../Models/Kamar.php";

class PenyewaProfilController extends Controller {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user']['id'];
        $userModel = new User();
        $kamarModel = new Kamar();

        $penyewa = $userModel->findById($userId);
        $kamar = $kamarModel->getAll();

        $this->view("penyewa/profil", compact('penyewa', 'kamar'));
    }

    // ✅ penyewa boleh ubah foto, nama, nik, telepon
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user']['id'];

        $name  = $_POST['name']  ?? '';
        $nik   = $_POST['nik']   ?? '';
        $phone = $_POST['phone'] ?? '';

        $photoPath = null;

        // ✅ UPLOAD FOTO (FIX STRING CONCAT)
        if (!empty($_FILES['photo']['name'])) {
            $uploadDir = __DIR__ . "/../../../public/assets/uploads/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES['photo']['name']);
            $target   = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                // ✅ PERBAIKAN UTAMA DI SINI (PAKAI TITIK)
                $photoPath = "assets/uploads/" . $fileName;
            }
        }

        $userModel = new User();
        $userModel->updateProfilPenyewa($userId, $name, $nik, $phone, $photoPath);

        header("Location: /?r=penyewa/profil");
        exit;
    }
}
