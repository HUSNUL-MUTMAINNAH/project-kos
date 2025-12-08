<?php
$pageTitle = "Tambah Kamar";
$active = "kamar";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="mb-3">Tambah Kamar</h5>

        <form method="post" action="/?r=admin/kamar_store">
            <div class="mb-3">
                <label class="form-label">Nama Kamar</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak_tersedia">Tidak Tersedia</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Simpan</button>
                <a href="/?r=admin/kamar" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
