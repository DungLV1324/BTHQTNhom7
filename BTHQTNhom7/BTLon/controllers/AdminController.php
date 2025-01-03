<?php

require_once 'models/User.php';

class AdminController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = User::authenticate($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;

                if ($user['role'] == 1) {
                    header("Location: index.php?action=dashboard");
                } else {
                    header("Location: index.php?action=home");
                }
                exit();
            } else {
                header("Location: ?error=1");
                exit();
            }
        } else {
            include "views/admin/login.php";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            session_destroy();
            include "views/admin/login.php";
        }
    }

    public function dashboard()
    {
        require_once 'models/SanPham.php';
        require_once 'models/User.php';

        $newsModel = new SanPham();
        $userModel = new User();

        // Lấy tổng số tin tức và người dùng
        $totalNews = $newsModel->getTotalProducts();
        $totalUsers = $userModel->getTotalUsers();
        $news = $newsModel->getAllProducts();
        // Truyền dữ liệu vào view
        include "views/admin/dashboard.php";
    }
}
