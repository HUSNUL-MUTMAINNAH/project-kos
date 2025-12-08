<?php
$pageTitle = "Dashboard";
$active = "dashboard";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="fw-semibold mb-1">Total Kamar</div>
                <div class="display-6"><?php echo (int)$totalKamar; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-success-subtle">
            <div class="card-body text-center">
                <div class="fw-semibold mb-1">Total Penyewa</div>
                <div class="display-6"><?php echo (int)$totalPenyewa; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-primary-subtle">
            <div class="card-body text-center">
                <div class="fw-semibold mb-1">Pembayaran Lunas</div>
                <div class="display-6"><?php echo (int)$pembayaranLunas; ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-danger-subtle">
            <div class="card-body text-center">
                <div class="fw-semibold mb-1">Pembayaran Tertunggak</div>
                <div class="display-6"><?php echo (int)$pembayaranTunggakan; ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="mb-3">Daftar Kamar</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($daftarKamar as $k): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($k['nama']); ?></td>
                        <td>Rp <?php echo number_format($k['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <?php if ($k['status'] === 'tersedia'): ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Tidak Tersedia</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
