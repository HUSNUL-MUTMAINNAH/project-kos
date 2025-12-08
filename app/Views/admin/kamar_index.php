<?php
$pageTitle = "Kamar";
$active = "kamar";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <!-- ✅ TOMBOL TAMBAH -->
        <div class="d-flex justify-content-end mb-3">
            <a href="/?r=admin/kamar_create" class="btn btn-primary">
                + Tambah Kamar
            </a>
        </div>

        <h5 class="mb-3">Daftar Kamar</h5>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kamar</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th> <!-- ✅ KOLOM BARU -->
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($kamar as $k): ?>
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
                        <td>
                            <!-- ✅ TOMBOL EDIT -->
                            <a href="/?r=admin/kamar_edit&id=<?php echo $k['id']; ?>"
                               class="btn btn-sm btn-warning">
                               Edit
                            </a>

                            <!-- ✅ TOMBOL HAPUS + KONFIRMASI -->
                            <a href="/?r=admin/kamar_delete&id=<?php echo $k['id']; ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus kamar ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
