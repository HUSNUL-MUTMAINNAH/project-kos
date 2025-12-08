<?php
$pageTitle = "Chat dengan " . ($penyewa['name'] ?? '');
$active = "chat";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_admin.php";
?>
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <h5 class="mb-3">Chat dengan <?php echo htmlspecialchars($penyewa['name']); ?></h5>
        <div class="chat-box mb-3 border rounded p-3 bg-white" style="height:320px;overflow-y:auto;">
            <?php foreach ($messages as $m): ?>
                <div class="mb-2">
                    <?php if ($m['sender_id'] == $penyewa['id']): ?>
                        <div class="d-flex">
                            <div class="badge bg-secondary me-2">Penyewa</div>
                            <div><?php echo nl2br(htmlspecialchars($m['message'])); ?></div>
                        </div>
                    <?php else: ?>
                        <div class="d-flex justify-content-end">
                            <div class="me-2"><?php echo nl2br(htmlspecialchars($m['message'])); ?></div>
                            <div class="badge bg-primary">Admin</div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php if (empty($messages)): ?>
                <div class="text-muted text-center">Belum ada pesan.</div>
            <?php endif; ?>
        </div>
        <form method="post" action="/?r=admin/chat_send">
            <input type="hidden" name="user_id" value="<?php echo $penyewa['id']; ?>">
            <div class="input-group">
                <textarea name="message" class="form-control" rows="2" placeholder="Tulis pesan..."></textarea>
                <button class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>
<a href="/?r=admin/chat" class="btn btn-outline-secondary btn-sm">Kembali ke daftar penyewa</a>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
