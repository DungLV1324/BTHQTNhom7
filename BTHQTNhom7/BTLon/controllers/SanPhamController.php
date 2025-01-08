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
        include 'views/detail/product.php';
    }

    // Thêm sản phẩm
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'MaDanhMuc' => $_POST['MaDanhMuc'],
                'MaNhaCungCap' => $_POST['MaNhaCungCap'],
                'TenSanPham' => $_POST['TenSanPham'],
                'DonGia' => $_POST['DonGia'],
                'KichThuoc' => $_POST['KichThuoc'],
                'MauSac' => $_POST['MauSac'],
                'MuiHuong' => $_POST['MuiHuong'],
                'SoLuong' => $_POST['SoLuong'],
                'HinhAnh'      => $_FILES['HinhAnh']
            ];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] == 0) {
                    $fileName = $_FILES['uploadedFile']['name'];
                    $fileTmpName = $_FILES['uploadedFile']['tmp_name'];
                    $fileSize = $_FILES['uploadedFile']['size'];
                    $fileType = $_FILES['uploadedFile']['type'];

                    // Đường dẫn lưu tập tin
                    $uploadDirectory = 'assets/image';
                    $uploadFilePath = $uploadDirectory . basename($fileName);

                    // Kiểm tra định dạng tập tin
                    $allowedFileTypes = ['image/jpg'];
                    if (in_array($fileType, $allowedFileTypes)) {
                        if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                            echo 'Tập tin đã được upload thành công!';
                        } else {
                            echo 'Lỗi khi upload tập tin.';
                        }
                    } else {
                        echo 'Định dạng tập tin không hợp lệ.';
                    }
                } else {
                    echo 'Lỗi khi upload tập tin.';
                }
            }

            // Ví dụ: Thêm sản phẩm và chuyển hướng
            $productModel = new SanPham();
            $productModel->addProduct($data);

            header("Location: index.php?controller=home&action=index");
            exit();
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        $supplierModel = new NhaCungCap();
        $suppliers = $supplierModel->getAllSuppliers();

        include 'views/admin/sp/add.php';
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
            header("Location: index.php?controller=detail&action=index&id=" . $id);
            exit();
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        $supplierModel = new NhaCungCap();
        $suppliers = $supplierModel->getAllSuppliers();

        include 'views/admin/sp/edit.php';
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        $productModel = new SanPham();
        $productModel->deleteProduct($id);
        header("Location: index.php?controller=admin&action=dashboard");
        exit();
    }
}
