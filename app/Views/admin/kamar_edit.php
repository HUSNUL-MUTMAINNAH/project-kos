<?php
$pageTitle = "Edit Kamar";
$active = "kamar";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>

<div class="card shadow-sm border-0">
<div class="card-body">
<h5>Edit Kamar</h5>

<form method="post" action="/?r=admin/kamar_update">
<input type="hidden" name="id" value="<?= $kamar['id'] ?>">

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?= $kamar['nama'] ?>" required>
</div>

<div class="mb-3">
<label>Harga</label>
<input type="number" name="harga" class="form-control" value="<?= $kamar['harga'] ?>" required>
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-select">
    <option value="tersedia" <?= $kamar['status']=='tersedia'?'selected':'' ?>>Tersedia</option>
    <option value="tidak_tersedia" <?= $kamar['status']=='tidak_tersedia'?'selected':'' ?>>Tidak Tersedia</option>
</select>
</div>

<button class="btn btn-primary">Update</button>
<a href="/?r=admin/kamar" class="btn btn-secondary">Batal</a>
</form>

</div>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
