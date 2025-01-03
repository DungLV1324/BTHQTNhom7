<?php
require_once 'models/SanPham.php';
require_once 'models/Category.php';
require_once 'models/NhaCungCap.php';

class SanPhamController
{
    // Chi tiết sản phẩm
    public function detail($id)
    {
        $productModel = new SanPham();
        $product = $productModel->getProductById($id);
        include 'views/news/detail.php';
    }

    // Thêm sản phẩm
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'MaDanhMuc' => $_POST['category_id'],
                'MaNhaCungCap' => $_POST['supplier_id'],
                'TenSanPham' => $_POST['name'],
                'DonGia' => $_POST['price'],
                'KichThuoc' => $_POST['size'],
                'MauSac' => $_POST['color'],
                'MuiHuong' => $_POST['scent'],
                'SoLuong' => $_POST['quantity'],
            ];

            $productModel = new SanPham();
            $productModel->addProduct($data);

            header("Location: index.php?controller=product&action=index");
            exit();
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        $supplierModel = new NhaCungCap();
        $suppliers = $supplierModel->getAllSuppliers();

        include 'views/admin/news/add.php';
    }

    // Tìm kiếm sản phẩm
    public function search($keyword = null)
    {
        $productModel = new SanPham();

        if ($keyword) {
            $results = $productModel->searchProducts($keyword);
            if (empty($results)) {
                $noResultsMessage = 'Không có kết quả nào phù hợp với từ khóa.';
            }
        } else {
            $results = $productModel->getAllProducts();
        }

        include 'views/home/index.php';
    }

    // Cập nhật sản phẩm
    public function update($id)
    {
        $productModel = new SanPham();
        $product = $productModel->getProductById($id);

        if (!$product) {
            header("Location: index.php?controller=home&action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'MaDanhMuc' => $_POST['category_id'],
                'MaNhaCungCap' => $_POST['supplier_id'],
                'TenSanPham' => $_POST['name'],
                'DonGia' => $_POST['price'],
                'KichThuoc' => $_POST['size'],
                'MauSac' => $_POST['color'],
                'MuiHuong' => $_POST['scent'],
                'SoLuong' => $_POST['quantity'],
            ];

            $productModel->updateProduct($id, $data);

            header("Location: index.php?controller=product&action=detail&id=$id");
            exit();
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        $supplierModel = new NhaCungCap();
        $suppliers = $supplierModel->getAllSuppliers();

        include 'views/admin/news/edit.php';
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        $productModel = new SanPham();
        $productModel->deleteProduct($id);
        header("Location: index.php?controller=product&action=index");
        exit();
    }
}
