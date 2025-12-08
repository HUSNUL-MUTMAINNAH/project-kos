<?php
require_once __DIR__ . "/../../Core/Controller.php";
require_once __DIR__ . "/../../Models/Kamar.php";

class AdminKamarController extends Controller {

    public function index() {
        $kamarModel = new Kamar();
        $kamar = $kamarModel->getAll();
        $this->view("admin/kamar_index", compact('kamar'));
    }

    public function create() {
        $this->view("admin/kamar_create");
    }

    public function store() {
        $nama   = $_POST['nama'] ?? '';
        $harga  = $_POST['harga'] ?? 0;
        $status = $_POST['status'] ?? 'tersedia';

        $kamarModel = new Kamar();
        $kamarModel->create($nama, $harga, $status);

        header("Location: /?r=admin/kamar");
        exit;
    }

    public function edit() {
        $id = $_GET['id'];
        $kamarModel = new Kamar();
        $kamar = $kamarModel->findById($id);

        $this->view("admin/kamar_edit", compact('kamar'));
    }

    public function update() {
        $id     = $_POST['id'];
        $nama   = $_POST['nama'];
        $harga  = $_POST['harga'];
        $status = $_POST['status'];

        $kamarModel = new Kamar();
        $kamarModel->update($id, $nama, $harga, $status);

        header("Location: /?r=admin/kamar");
        exit;
    }

    public function delete() {
        $id = $_GET['id'];

        $kamarModel = new Kamar();
        $kamarModel->delete($id);

        header("Location: /?r=admin/kamar");
        exit;
    }
}
