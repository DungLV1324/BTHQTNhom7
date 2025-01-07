<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'models/SanPham.php';
require_once 'models/Category.php';

class HomeController
{
    public function index()
    {
        $productsModel = new SanPham();
        $categoryModel = new Category();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 25; // Số lượng sản phẩm mỗi trang

        $totalProducts = $productsModel->getTotalProducts();
        $totalPages = ceil($totalProducts / $perPage); // Tính tổng số trang

        $offset = ($page - 1) * $perPage;

        $productList = isset($_GET['category']) ? $productsModel->getProductsByPage($_GET['category'], $offset, $perPage) : $productsModel->getProductsByPage(null, $offset, $perPage);

        $categories = $categoryModel->getAllCategories();

        // Truyền dữ liệu vào view
        require_once('views/home/index.php');
    }

}
