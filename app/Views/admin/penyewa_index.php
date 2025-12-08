<?php
$pageTitle = "Penyewa";
$active = "penyewa";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="mb-3">Daftar Penyewa</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                        <th>Kamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($penyewa as $p): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($p['name']); ?></td>
                        <td><?php echo htmlspecialchars($p['email']); ?></td>
                        <td><?php echo htmlspecialchars($p['phone']); ?></td>
                        <td><?php echo htmlspecialchars($p['nama_kamar'] ?? '-'); ?></td>
                        <td>
                            <a href="/?r=admin/penyewa_show&id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
