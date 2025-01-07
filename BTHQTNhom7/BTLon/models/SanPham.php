<?php
class SanPham {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect(); // Kết nối cơ sở dữ liệu
    }

    // Lấy tất cả sản phẩm
    public function getAllProducts()
    {
        $stmt = $this->pdo->query(
            "SELECT sp.MaSanPham, sp.TenSanPham, sp.DonGia, sp.KichThuoc, sp.MauSac, sp.MuiHuong, sp.SoLuong, 
                    sp.HinhAnh, dm.TenDanhMuc AS DanhMuc, ncc.TenCongTy AS NhaCungCap 
             FROM SanPham sp
             INNER JOIN DanhMucSanPham dm ON sp.MaDanhMuc = dm.MaDanhMuc
             INNER JOIN NhaCungCap ncc ON sp.MaNhaCungCap = ncc.MaNhaCungCap"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm sản phẩm theo từ khóa
    public function searchProducts($keyword)
    {
        $stmt = $this->pdo->prepare(
            "SELECT sp.MaSanPham, sp.TenSanPham, sp.DonGia, sp.KichThuoc, sp.MauSac, sp.MuiHuong, sp.SoLuong, 
                    sp.HinhAnh, dm.TenDanhMuc AS DanhMuc, ncc.TenCongTy AS NhaCungCap 
             FROM SanPham sp
             INNER JOIN DanhMucSanPham dm ON sp.MaDanhMuc = dm.MaDanhMuc
             INNER JOIN NhaCungCap ncc ON sp.MaNhaCungCap = ncc.MaNhaCungCap
             WHERE sp.TenSanPham LIKE :keyword"
        );
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm theo ID
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM SanPham WHERE MaSanPham = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm mới
    public function addProduct($data)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO SanPham (MaDanhMuc, MaNhaCungCap, TenSanPham, DonGia, KichThuoc, MauSac, MuiHuong, SoLuong, HinhAnh) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['MaDanhMuc'], $data['MaNhaCungCap'], $data['TenSanPham'], $data['DonGia'],
            $data['KichThuoc'], $data['MauSac'], $data['MuiHuong'], $data['SoLuong'], $data['HinhAnh']
        ]);
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $data)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE SanPham 
             SET MaDanhMuc = ?, MaNhaCungCap = ?, TenSanPham = ?, DonGia = ?, KichThuoc = ?, MauSac = ?, MuiHuong = ?, SoLuong = ?, HinhAnh = ?
             WHERE MaSanPham = ?"
        );
        $stmt->execute([
            $data['MaDanhMuc'], $data['MaNhaCungCap'], $data['TenSanPham'], $data['DonGia'],
            $data['KichThuoc'], $data['MauSac'], $data['MuiHuong'], $data['SoLuong'], $data['HinhAnh'], $id
        ]);
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        try {
            // Kiểm tra xem sản phẩm có tồn tại không
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM SanPham WHERE MaSanPham = ?");
            $stmt->execute([$id]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                // Xóa các chi tiết liên quan nếu có
                $stmt = $this->pdo->prepare("DELETE FROM ChiTietDonHang WHERE MaSanPham = ?");
                $stmt->execute([$id]);

                // Xóa sản phẩm
                $stmt = $this->pdo->prepare("DELETE FROM SanPham WHERE MaSanPham = ?");
                $stmt->execute([$id]);

                echo "Sản phẩm đã được xóa thành công.";
            } else {
                echo "Sản phẩm không tồn tại.";
            }
        } catch (PDOException $e) {
            // Bắt lỗi và xử lý
            echo "Có lỗi xảy ra: " . $e->getMessage();
        }
    }


    // Lấy sản phẩm theo phân trang và danh mục (nếu có)
    public function getProductsByPage($category = null, $offset = 0, $perPage = 5)
    {
        $query = "SELECT sp.MaSanPham, sp.TenSanPham, sp.DonGia, sp.KichThuoc, sp.MauSac, sp.MuiHuong, sp.SoLuong, 
                         sp.HinhAnh, dm.TenDanhMuc AS DanhMuc, ncc.TenCongTy AS NhaCungCap 
                  FROM SanPham sp
                  INNER JOIN DanhMucSanPham dm ON sp.MaDanhMuc = dm.MaDanhMuc
                  INNER JOIN NhaCungCap ncc ON sp.MaNhaCungCap = ncc.MaNhaCungCap";

        if ($category != null) {
            $query .= " WHERE sp.MaDanhMuc = :category";
        }

        $query .= " LIMIT :offset, :perPage";

        $stmt = $this->pdo->prepare($query);

        if ($category != null) {
            $stmt->bindValue(':category', $category, PDO::PARAM_INT);
        }

        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tổng số sản phẩm
    public function getTotalProducts($category = null)
    {
        $query = "SELECT COUNT(*) AS total FROM SanPham sp
                  INNER JOIN DanhMucSanPham dm ON sp.MaDanhMuc = dm.MaDanhMuc";

        if ($category != null) {
            $query .= " WHERE sp.MaDanhMuc = :category";
        }

        $stmt = $this->pdo->prepare($query);

        if ($category != null) {
            $stmt->bindValue(':category', $category, PDO::PARAM_INT);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>
