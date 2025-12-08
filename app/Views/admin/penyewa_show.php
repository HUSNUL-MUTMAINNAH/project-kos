<?php
$pageTitle = "Detail Penyewa";
$active = "penyewa";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex">
                <div class="me-3">
                    <div class="rounded-circle bg-secondary" style="width:80px;height:80px;
                        background-image:url('/<?php echo htmlspecialchars($penyewa['photo'] ?? ''); ?>');
                        background-size:cover;background-position:center;"></div>
                </div>
                <div>
                    <h5 class="mb-2">Profil Penyewa</h5>
                    <p class="mb-1"><strong>Nama:</strong> <?php echo htmlspecialchars($penyewa['name']); ?></p>
                    <p class="mb-1"><strong>NIK:</strong> <?php echo htmlspecialchars($penyewa['nik']); ?></p>
                    <p class="mb-1"><strong>No Telepon:</strong> <?php echo htmlspecialchars($penyewa['phone']); ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($penyewa['email']); ?></p>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <h6 class="mb-3">Ubah Kamar</h6>
                <form method="post" action="/?r=admin/penyewa_update_kamar">
                    <input type="hidden" name="id" value="<?php echo $penyewa['id']; ?>">
                    <div class="mb-3">
                        <select name="kamar_id" class="form-select">
                            <option value="">- Tidak ada kamar -</option>
                            <?php foreach ($kamar as $k): ?>
                                <option value="<?php echo $k['id']; ?>" <?php echo $penyewa['kamar_id']==$k['id']?'selected':''; ?>>
                                    <?php echo htmlspecialchars($k['nama']); ?> (Rp <?php echo number_format($k['harga'],0,',','.'); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Riwayat Pembayaran</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($riwayat as $r): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($r['tanggal']); ?></td>
                                <td>Rp <?php echo number_format($r['jumlah'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($r['status']==='lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php elseif ($r['status']==='tidak_lunas'): ?>
                                        <span class="badge bg-danger">Tidak Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
