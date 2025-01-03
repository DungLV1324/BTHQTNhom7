<?php
require_once 'models/NhaCungCap.php';

class NhaCungCapController
{
    // Lấy danh sách nhà cung cấp
    public function index()
    {
        $supplierModel = new NhaCungCap();
        $suppliers = $supplierModel->getAllSuppliers();
        include 'views/nhaCungCap/index.php';
    }

    // Chi tiết nhà cung cấp
    public function detail($id)
    {
        $supplierModel = new NhaCungCap();
        $supplier = $supplierModel->getSupplierById($id);
        include 'views/nhaCungCap/detail.php';
    }

    // Thêm nhà cung cấp
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenCongTy = $_POST['tenCongTy'];
            $tenNguoiLienHe = $_POST['tenNguoiLienHe'];
            $diaChi = $_POST['diaChi'];
            $thanhPho = $_POST['thanhPho'];
            $maBuuDien = $_POST['maBuuDien'];
            $soDienThoai = $_POST['soDienThoai'];

            $supplierModel = new NhaCungCap();
            $supplierModel->addSupplier($tenCongTy, $tenNguoiLienHe, $diaChi, $thanhPho, $maBuuDien, $soDienThoai);
            header("Location: index.php?controller=nhaCungCap&action=index");
            exit();
        }
        include 'views/nhaCungCap/create.php';
    }

    // Cập nhật nhà cung cấp
    public function update($id)
    {
        $supplierModel = new NhaCungCap();
        $supplier = $supplierModel->getSupplierById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenCongTy = $_POST['tenCongTy'];
            $tenNguoiLienHe = $_POST['tenNguoiLienHe'];
            $diaChi = $_POST['diaChi'];
            $thanhPho = $_POST['thanhPho'];
            $maBuuDien = $_POST['maBuuDien'];
            $soDienThoai = $_POST['soDienThoai'];

            $supplierModel->updateSupplier($id, $tenCongTy, $tenNguoiLienHe, $diaChi, $thanhPho, $maBuuDien, $soDienThoai);
            header("Location: index.php?controller=nhaCungCap&action=detail&id=" . $id);
            exit();
        }

        include 'views/nhaCungCap/edit.php';
    }

    // Xóa nhà cung cấp
    public function delete($id)
    {
        $supplierModel = new NhaCungCap();
        $supplierModel->deleteSupplier($id);
        header("Location: index.php?controller=nhaCungCap&action=index");
        exit();
    }
}
?>
