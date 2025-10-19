<?php
class UserController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function login($username, $password) {
        $stmt = $this->koneksi->prepare("SELECT id, username, password FROM users WHERE username = ? AND deleted_at IS NULL");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if(password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }
        return false;
    }

    public function register($username, $password) {
        // Check if username exists
        $stmt = $this->koneksi->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if($stmt->get_result()->num_rows > 0) {
            return false;
        }

        // Hash password and insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->koneksi->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        return $stmt->execute();
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}