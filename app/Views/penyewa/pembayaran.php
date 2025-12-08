<?php
$pageTitle = "Pembayaran";
$active = "pembayaran";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_penyewa.php";
?>
<div class="row g-4">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Kirim Bukti Pembayaran</h5>
                <form method="post" action="/?r=penyewa/pembayaran_kirim" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Bukti</label>
                        <input type="file" name="bukti" class="form-control">
                    </div>
                    <button class="btn btn-primary w-100">Kirim ke Admin</button>
                    <small class="text-muted d-block mt-2">
                        Status awal akan menjadi <strong>Menunggu</strong> sampai admin menyetujui.
                    </small>
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
                        <?php foreach ($pembayaran as $p): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($p['tanggal']); ?></td>
                                <td>Rp <?php echo number_format($p['jumlah'],0,',','.'); ?></td>
                                <td>
                                    <?php if ($p['status']==='lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php elseif ($p['status']==='tidak_lunas'): ?>
                                        <span class="badge bg-danger">Tidak Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($pembayaran)): ?>
                            <tr><td colspan="3" class="text-center text-muted">Belum ada pembayaran.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
