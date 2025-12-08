<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../Middlewares/AuthMiddleware.php";
require_once __DIR__ . "/../Middlewares/RoleMiddleware.php";

class Router {
    public static function dispatch(string $route) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once __DIR__ . "/../Controllers/AuthController.php";

        if ($route === "login") {
            (new AuthController())->showLoginForm();
            return;
        }
        if ($route === "login_post") {
            (new AuthController())->login();
            return;
        }
        if ($route === "logout") {
            requireAuth();
            (new AuthController())->logout();
            return;
        }

        if ($route === "register") {
            (new AuthController())->showRegisterForm();
            return;
        }

        if ($route === "register_post") {
            (new AuthController())->register();
            return;
        }

        // All other routes require login
        requireAuth();

        if (strpos($route, "admin/") === 0) {
            requireRole("admin");
            $sub = substr($route, strlen("admin/"));
            switch ($sub) {
                case "dashboard":
                    require_once __DIR__ . "/../Controllers/Admin/DashboardController.php";
                    (new AdminDashboardController())->index();
                    return;
                case "kamar":
                    require_once __DIR__ . "/../Controllers/Admin/KamarController.php";
                    (new AdminKamarController())->index();
                    return;
                case "kamar_create":
                    require_once __DIR__ . "/../Controllers/Admin/KamarController.php";
                    (new AdminKamarController())->create();
                    return;
                case "kamar_edit":
                    require_once __DIR__ . "/../Controllers/Admin/KamarController.php";
                    (new AdminKamarController())->edit();
                    return;

                case "kamar_update":
                    require_once __DIR__ . "/../Controllers/Admin/KamarController.php";
                    (new AdminKamarController())->update();
                    return;

                case "kamar_delete":
                    require_once __DIR__ . "/../Controllers/Admin/KamarController.php";
                    (new AdminKamarController())->delete();
                    return;

                case "kamar_store":
                    require_once __DIR__ . "/../Controllers/Admin/KamarController.php";
                    (new AdminKamarController())->store();
                    return;
                case "penyewa":
                    require_once __DIR__ . "/../Controllers/Admin/PenyewaController.php";
                    (new AdminPenyewaController())->index();
                    return;
                case "penyewa_show":
                    require_once __DIR__ . "/../Controllers/Admin/PenyewaController.php";
                    (new AdminPenyewaController())->show();
                    return;
                case "penyewa_update_kamar":
                    require_once __DIR__ . "/../Controllers/Admin/PenyewaController.php";
                    (new AdminPenyewaController())->updateKamar();
                    return;
                case "pembayaran":
                    require_once __DIR__ . "/../Controllers/Admin/PembayaranController.php";
                    (new AdminPembayaranController())->index();
                    return;
                case "pembayaran_update":
                    require_once __DIR__ . "/../Controllers/Admin/PembayaranController.php";
                    (new AdminPembayaranController())->updateStatus();
                    return;
                case "chat":
                    require_once __DIR__ . "/../Controllers/Admin/ChatController.php";
                    (new AdminChatController())->index();
                    return;
                case "chat_show":
                    require_once __DIR__ . "/../Controllers/Admin/ChatController.php";
                    (new AdminChatController())->show();
                    return;
                case "chat_send":
                    require_once __DIR__ . "/../Controllers/Admin/ChatController.php";
                    (new AdminChatController())->send();
                    return;
                default:
                    http_response_code(404);
                    echo "Route admin tidak ditemukan";
                    return;
            }
        }

        if (strpos($route, "penyewa/") === 0) {
            requireRole("penyewa");
            $sub = substr($route, strlen("penyewa/"));
            switch ($sub) {
                case "profil":
                    require_once __DIR__ . "/../Controllers/Penyewa/ProfilController.php";
                    (new PenyewaProfilController())->index();
                    return;
                case "profil_update":
                    require_once __DIR__ . "/../Controllers/Penyewa/ProfilController.php";
                    (new PenyewaProfilController())->update();
                    return;
                case "pembayaran":
                    require_once __DIR__ . "/../Controllers/Penyewa/PembayaranController.php";
                    (new PenyewaPembayaranController())->index();
                    return;
                case "pembayaran_kirim":
                    require_once __DIR__ . "/../Controllers/Penyewa/PembayaranController.php";
                    (new PenyewaPembayaranController())->kirim();
                    return;
                case "chat":
                    require_once __DIR__ . "/../Controllers/Penyewa/ChatController.php";
                    (new PenyewaChatController())->index();
                    return;
                case "chat_send":
                    require_once __DIR__ . "/../Controllers/Penyewa/ChatController.php";
                    (new PenyewaChatController())->send();
                    return;
                default:
                    http_response_code(404);
                    echo "Route penyewa tidak ditemukan";
                    return;
            }
        }

        http_response_code(404);
        echo "Route tidak ditemukan";
    }
}
