<?php
require_once __DIR__ . "/../Core/Controller.php";
require_once __DIR__ . "/../Models/User.php";

class AuthController extends Controller {

    public function showLoginForm() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] === 'admin') {
                header("Location: /?r=admin/dashboard");
            } else {
                header("Location: /?r=penyewa/profil");
            }
            exit;
        }
        $this->view("auth/login");
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            if ($user['role'] === 'admin') {
                header("Location: /?r=admin/dashboard");
            } else {
                header("Location: /?r=penyewa/profil");
            }
            exit;
        } else {
            $error = "Email atau password salah";
            $this->view("auth/login", compact('error'));
        }
    }

    public function showRegisterForm() {
    $this->view("auth/register");
}

public function register() {
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        $error = "Semua field wajib diisi!";
        $this->view("auth/register", compact('error'));
        return;
    }

    $userModel = new User();
    $existing  = $userModel->findByEmail($email);

    if ($existing) {
        $error = "Email sudah terdaftar!";
        $this->view("auth/register", compact('error'));
        return;
    }

    $userModel->createPenyewa($name, $email, $password);
    header("Location: /?r=login");
    exit;
}

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /?r=login");
        exit;
    }
}
