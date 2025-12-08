<?php
$pageTitle = "Chat Penyewa";
$active = "chat";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="mb-3">Pilih Penyewa</h5>
        <div class="list-group">
            <?php foreach ($penyewa as $p): ?>
                <a href="/?r=admin/chat_show&user_id=<?php echo $p['id']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><?php echo htmlspecialchars($p['name']); ?></span>
                    <span class="small text-muted"><?php echo htmlspecialchars($p['email']); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
