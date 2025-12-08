<?php
function requireRole(string $role) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
        http_response_code(403);
        echo "Akses ditolak";
        exit;
    }
}
