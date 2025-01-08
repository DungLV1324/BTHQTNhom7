<!-- add.php -->


<?php include('partials/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Thêm Sản Phẩm</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="MaDanhMuc">Mã Danh Mục:</label>
        <input type="text" id="MaDanhMuc" name="MaDanhMuc" required><br><br>

        <label for="MaNhaCungCap">Mã Nhà Cung Cấp:</label>
        <input type="text" id="MaNhaCungCap" name="MaNhaCungCap" required><br><br>

        <label for="TenSanPham">Tên Sản Phẩm:</label>
        <input type="text" id="TenSanPham" name="TenSanPham" required><br><br>

        <label for="DonGia">Đơn Giá:</label>
        <input type="number" id="DonGia" name="DonGia" step="0.01" required><br><br>

        <label for="KichThuoc">Kích Thước:</label>
        <input type="text" id="KichThuoc" name="KichThuoc"><br><br>

        <label for="MauSac">Màu Sắc:</label>
        <input type="text" id="MauSac" name="MauSac"><br><br>

        <label for="MuiHuong">Mùi Hương:</label>
        <input type="text" id="MuiHuong" name="MuiHuong"><br><br>

        <label for="SoLuong">Số Lượng:</label>
        <input type="number" id="SoLuong" name="SoLuong" required><br><br>
        
        <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="HinhAnh">Hình Ảnh:</label>
    <input type="file" id="HinhAnh" name="HinhAnh"><br><br>
    <button type="submit" name="upload">Upload</button>
</form>

</body>
</html>


<?php include('partials/footer.php'); ?>