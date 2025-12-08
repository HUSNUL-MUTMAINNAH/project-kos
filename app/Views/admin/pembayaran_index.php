<?php
$pageTitle = "Pembayaran";
$active = "pembayaran";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Menunggu Persetujuan</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Penyewa</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($menunggu as $m): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($m['nama_penyewa']); ?></td>
                                <td><?php echo htmlspecialchars($m['tanggal']); ?></td>
                                <td>Rp <?php echo number_format($m['jumlah'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($m['bukti']): ?>
                                        <a href="/<?php echo htmlspecialchars($m['bukti']); ?>" target="_blank">Lihat</a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="post" action="/?r=admin/pembayaran_update" class="d-flex gap-1">
                                        <input type="hidden" name="id" value="<?php echo $m['id']; ?>">
                                        <button name="status" value="lunas" class="btn btn-sm btn-success">Lunas</button>
                                        <button name="status" value="tidak_lunas" class="btn btn-sm btn-outline-danger">Tidak</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <small class="text-muted">Admin hanya dapat mengubah status lunas / tidak lunas.</small>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Riwayat Semua Pembayaran</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Penyewa</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($semua as $s): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($s['nama_penyewa']); ?></td>
                                <td><?php echo htmlspecialchars($s['tanggal']); ?></td>
                                <td>Rp <?php echo number_format($s['jumlah'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($s['status']==='lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php elseif ($s['status']==='tidak_lunas'): ?>
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
