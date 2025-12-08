<?php
$pageTitle = "Chat Admin";
$active = "chat";
require __DIR__ . "/../layouts/header.php";
require __DIR__ . "/../layouts/sidebar_penyewa.php";
?>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="mb-3">Chat dengan Admin</h5>
        <div class="chat-box mb-3 border rounded p-3 bg-white" style="height:320px;overflow-y:auto;">
            <?php foreach ($messages as $m): ?>
                <div class="mb-2">
                    <?php if ($m['sender_id'] == $dbAdmin['id']): ?>
                        <div class="d-flex">
                            <div class="badge bg-primary me-2">Admin</div>
                            <div><?php echo nl2br(htmlspecialchars($m['message'])); ?></div>
                        </div>
                    <?php else: ?>
                        <div class="d-flex justify-content-end">
                            <div class="me-2"><?php echo nl2br(htmlspecialchars($m['message'])); ?></div>
                            <div class="badge bg-secondary">Anda</div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php if (empty($messages)): ?>
                <div class="text-muted text-center">Belum ada pesan.</div>
            <?php endif; ?>
        </div>
        <form method="post" action="/?r=penyewa/chat_send">
            <div class="input-group">
                <textarea name="message" class="form-control" rows="2" placeholder="Tulis pesan ke admin..."></textarea>
                <button class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
