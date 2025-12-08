<?php $active = $active ?? ""; ?>
<div class="d-flex">
    <aside class="sidebar bg-dark text-white d-flex flex-column">
        <div class="p-3">
            <h4 class="mb-4">Kos<br>Management</h4>
            <nav class="nav flex-column">
                <a href="/?r=admin/dashboard" class="nav-link px-3 py-2 text-white <?php echo $active==='dashboard'?'active':''; ?>">Dashboard</a>
                <a href="/?r=admin/kamar" class="nav-link px-3 py-2 text-white <?php echo $active==='kamar'?'active':''; ?>">Kamar</a>
                <a href="/?r=admin/penyewa" class="nav-link px-3 py-2 text-white <?php echo $active==='penyewa'?'active':''; ?>">Penyewa</a>
                <a href="/?r=admin/pembayaran" class="nav-link px-3 py-2 text-white <?php echo $active==='pembayaran'?'active':''; ?>">Pembayaran</a>
                <a href="/?r=admin/chat" class="nav-link px-3 py-2 text-white <?php echo $active==='chat'?'active':''; ?>">Chat</a>
            </nav>
        </div>
        <div class="mt-auto p-3 border-top text-center">
            <div class="rounded-circle bg-secondary mx-auto mb-2" style="width:48px;height:48px;"></div>
            <div><?php echo htmlspecialchars($userSession['name'] ?? 'Admin'); ?></div>
            <small class="text-muted">Admin</small>
        </div>
    </aside>
    <main class="flex-fill p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0"><?php echo $pageTitle ?? ''; ?></h2>
            <a href="/?r=logout" class="btn btn-success">Logout</a>
        </div>
