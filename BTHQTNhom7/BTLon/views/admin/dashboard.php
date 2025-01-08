<!-- dashboard.php -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Bảng điều khiển sản phẩm</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php
if (isset($_SESSION['user']) && !isset($_SESSION['success'])) {
    $_SESSION['success'] = 1;
    ?>
    <script>
        Swal.fire({
            icon: "success",
            title: "Đăng nhập thành công",
            text: "Chào mừng bạn!",
            footer: '<a href="#">Cần trợ giúp?</a>'
        });
    </script>
    <?php
}
?>
<div class="container">
    <h2 class="mt-5">Bảng điều khiển sản phẩm</h2>
    <!-- Các nút bấm điều hướng -->
    <div class="mt-4">
        <?php
        if ($_SESSION['user']['role'] === 1) {
            ?>
            <a href="index.php?action=add_product" class="btn btn-success mb-3">Thêm sản phẩm</a>
            <?php
        }
        ?>
        <a href="index.php?controller=btlon&action=home" class="btn btn-secondary mb-3">Trang chủ</a>
        <a href="index.php?action=log-out" class="btn btn-danger mb-3">Đăng xuất</a>
    </div>

    <h3 class="mt-4">Danh sách sản phẩm</h3>
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Kích thước</th>
            <th>Màu sắc</th>
            <th>Mùi hương</th>
            <th>Số lượng</th>
            <th>Ảnh</th>
            <th>Danh mục</th>
            <th>Nhà cung cấp</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($news) && count($news) > 0): ?>
            <?php $index = 1; // Khởi tạo số thứ tự ?>
            <?php foreach ($news as $product): ?>
                <tr>
                    <td><?= $index++; ?></td> <!-- Tăng $index sau khi hiển thị -->
                    <td><?= htmlspecialchars($product['TenSanPham']) ?></td>
                    <td><?= number_format($product['DonGia'], 0, ',', '.') ?> VND</td>
                    <td><?= htmlspecialchars($product['KichThuoc']) ?></td>
                    <td><?= htmlspecialchars($product['MauSac']) ?></td>
                    <td><?= htmlspecialchars($product['MuiHuong']) ?></td>
                    <td><?= htmlspecialchars($product['SoLuong']) ?></td>
                    <td>
                    <img src="assets/image/<?php echo htmlspecialchars($product['HinhAnh']); ?>" class="card-img-top fixed-img" alt="Sản phẩm hình ảnh" style="width:100px; height:auto;">
                    </td>
                    <td><?= htmlspecialchars($product['DanhMuc']) ?></td>
                    <td><?= htmlspecialchars($product['NhaCungCap']) ?></td>
                    <td>
                        <a href="index.php?action=edit_product&id=<?= urlencode($product['MaSanPham']) ?>" class="btn btn-primary">Sửa</a>
                        <a href="index.php?action=delete_product&id=<?= urlencode($product['MaSanPham']) ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="11" class="text-center">Không có sản phẩm nào</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
