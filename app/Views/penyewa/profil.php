<?php
$pageTitle = "Penyewa";
$active = "profil";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_penyewa.php";
?>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Profil Penyewa</h5>

                <form method="post" action="/?r=penyewa/profil_update" enctype="multipart/form-data">
                    <div class="text-center mb-3">
                        <div class="rounded-circle bg-secondary mx-auto mb-2" style="width:96px;height:96px;
                            background-image:url('/<?php echo htmlspecialchars($penyewa['photo'] ?? ''); ?>');
                            background-size:cover;background-position:center;"></div>
                        <input type="file" name="photo" class="form-control form-control-sm mt-2">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control"
                               value="<?php echo htmlspecialchars($penyewa['name'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control"
                               value="<?php echo htmlspecialchars($penyewa['nik'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control"
                               value="<?php echo htmlspecialchars($penyewa['phone'] ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kamar</label>
                        <input type="text" class="form-control" disabled
                               value="<?php
                                    $namaKamar = '-';
                                    foreach ($kamar as $k) {
                                        if (($k['id'] ?? null) == ($penyewa['kamar_id'] ?? null)) {
                                            $namaKamar = $k['nama'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($namaKamar);
                               ?>">
                        <small class="text-muted">Kamar hanya dapat diubah oleh admin.</small>
                    </div>

                    <button class="btn btn-primary">Simpan Profil</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>