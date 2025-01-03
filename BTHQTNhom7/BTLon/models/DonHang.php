<?php
class DonHang
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect(); // Kết nối cơ sở dữ liệu
    }

    // Lấy tất cả đơn hàng
    public function getAllOrders()
    {
        $stmt = $this->pdo->query(
            "SELECT dh.MaDonHang, kh.Ho + ' ' + kh.Ten AS KhachHang, nv.Ho + ' ' + nv.Ten AS NhanVien,
                    dh.NgayDatHang, dh.NgayGiaoHang, dh.DiaChiGiaoHang, dh.ThanhPhoGiaoHang 
             FROM DonHang dh
             INNER JOIN KhachHang kh ON dh.MaKhachHang = kh.MaKhachHang
             INNER JOIN NhanVien nv ON dh.MaNhanVien = nv.MaNhanVien"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết đơn hàng
    public function getOrderDetails($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT ctdh.MaSanPham, sp.TenSanPham, ctdh.DonGia, ctdh.SoLuong, ctdh.ChietKhau
             FROM ChiTietDonHang ctdh
             INNER JOIN SanPham sp ON ctdh.MaSanPham = sp.MaSanPham
             WHERE ctdh.MaDonHang = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm đơn hàng mới
    public function addOrder($data, $details)
    {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO DonHang (MaKhachHang, MaNhanVien, NgayDatHang, NgayGiaoHang, DiaChiGiaoHang, ThanhPhoGiaoHang, MaBuuDienGiaoHang)
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $data['MaKhachHang'], $data['MaNhanVien'], $data['NgayDatHang'], $data['NgayGiaoHang'],
                $data['DiaChiGiaoHang'], $data['ThanhPhoGiaoHang'], $data['MaBuuDienGiaoHang']
            ]);
            $orderId = $this->pdo->lastInsertId();

            foreach ($details as $item) {
                $stmt = $this->pdo->prepare(
                    "INSERT INTO ChiTietDonHang (MaDonHang, MaSanPham, DonGia, SoLuong, ChietKhau)
                     VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([$orderId, $item['MaSanPham'], $item['DonGia'], $item['SoLuong'], $item['ChietKhau']]);
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    // Xóa đơn hàng
    public function deleteOrder($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM DonHang WHERE MaDonHang = ?");
        $stmt->execute([$id]);
    }
}
?>
