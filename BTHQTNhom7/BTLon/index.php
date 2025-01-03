<?php
session_start();
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
require_once './controllers/HomeController.php';
require_once './controllers/AdminController.php';
require_once './controllers/SanPhamController.php';
require_once './controllers/CategoryController.php';

try {
    if ($keyword) {
        // Nếu có keyword, gọi action 'search'
        $action = 'search';
    }
    switch ($action) {
        case 'home':
            $controller = new HomeController();
            $controller->index();
            break;
        case 'login':
            $controller = new AdminController();
            $controller->login();
            break;
        case 'log-out':
            $controller = new AdminController();
            $controller->logout();
            break;
        case 'dashboard':
            if (!isset($_SESSION['user'])) {
                header('Location: ?action=login');
                exit();
            }
            $controller = new AdminController();
            $controller->dashboard();
            break;
        case 'detail':
            if (!isset($_GET['id'])) {
                echo "ID không hợp lệ";
                exit();
            }
            $controller = new SanPhamController();
            $controller->detail($_GET['id']);
            break;

        case 'category':
            // Hiển thị danh sách thể loại
            $controller = new CategoryController(); // Sử dụng controller mới để xử lý
            $controller->listCategories();
            break;

        case 'search':
            // Kiểm tra nếu có keyword và người dùng đã đăng nhập
            if (!isset($_SESSION['user'])) {
                header('Location: login.php');
                exit();
            }

            if ($keyword) {
                // Chuyển tới hàm tìm kiếm của controller
                $controller = new SanPhamController();
                $controller->search($keyword);
            } else {
                echo "Vui lòng nhập từ khóa tìm kiếm!";
            }
            break;
        case 'add_news':
            if ($_SESSION['user']['role'] === 1) {
                if (!isset($_SESSION['user'])) {
                    header('Location: views/admin/login.php');
                    exit();
                }
                $controller = new SanPhamController();
                $controller->create();
            } else {
                echo 'Bạn không phải ADMIN';
            }
            break;
        case 'edit_news':
            if ($_SESSION['user']['role'] === 1) {
                if (isset($_GET['id'])) {
                    $controller = new SanPhamController();
                    $controller->update($_GET['id']);
                } else {
                    echo "ID không hợp lệ";
                }
            } else {
                echo 'Bạn không phải ADMIN';
            }
            break;
        case 'delete_news':
            if ($_SESSION['user']['role'] === 1) {
                if (isset($_GET['id'])) {
                    $controller = new SanPhamController();
                    $controller->delete($_GET['id']);
                } else {
                    echo "ID không hợp lệ";
                }
            } else {
                echo 'Bạn không phải ADMIN';
            }
            break;
        default:
            $controller = new HomeController();
            $controller->index();
    }
} catch (Exception $e) {
    echo "Đã có lỗi xảy ra: " . $e->getMessage();
}
