<?php
require_once 'models/Database.php';

class NhaCungCap
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect(); // Sử dụng kết nối PDO từ class Database
    }

    // Lấy tất cả nhà cung cấp
    public function getAllSuppliers()
    {
        $query = "SELECT * FROM NhaCungCap";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy nhà cung cấp theo mã
    public function getSupplierById($id)
    {
        $query = "SELECT * FROM NhaCungCap WHERE MaNhaCungCap = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Thêm nhà cung cấp mới
    public function addSupplier($tenCongTy, $tenNguoiLienHe, $diaChi, $thanhPho, $maBuuDien, $soDienThoai)
    {
        $query = "INSERT INTO NhaCungCap (TenCongTy, TenNguoiLienHe, DiaChi, ThanhPho, MaBuuDien, SoDienThoai)
                  VALUES (:tenCongTy, :tenNguoiLienHe, :diaChi, :thanhPho, :maBuuDien, :soDienThoai)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tenCongTy', $tenCongTy);
        $stmt->bindParam(':tenNguoiLienHe', $tenNguoiLienHe);
        $stmt->bindParam(':diaChi', $diaChi);
        $stmt->bindParam(':thanhPho', $thanhPho);
        $stmt->bindParam(':maBuuDien', $maBuuDien);
        $stmt->bindParam(':soDienThoai', $soDienThoai);
        return $stmt->execute();
    }

    // Cập nhật thông tin nhà cung cấp
    public function updateSupplier($id, $tenCongTy, $tenNguoiLienHe, $diaChi, $thanhPho, $maBuuDien, $soDienThoai)
    {
        $query = "UPDATE NhaCungCap SET 
                  TenCongTy = :tenCongTy,
                  TenNguoiLienHe = :tenNguoiLienHe,
                  DiaChi = :diaChi,
                  ThanhPho = :thanhPho,
                  MaBuuDien = :maBuuDien,
                  SoDienThoai = :soDienThoai
                  WHERE MaNhaCungCap = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tenCongTy', $tenCongTy);
        $stmt->bindParam(':tenNguoiLienHe', $tenNguoiLienHe);
        $stmt->bindParam(':diaChi', $diaChi);
        $stmt->bindParam(':thanhPho', $thanhPho);
        $stmt->bindParam(':maBuuDien', $maBuuDien);
        $stmt->bindParam(':soDienThoai', $soDienThoai);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Xóa nhà cung cấp
    public function deleteSupplier($id)
    {
        $query = "DELETE FROM NhaCungCap WHERE MaNhaCungCap = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
