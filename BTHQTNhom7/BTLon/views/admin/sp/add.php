<!-- add.php -->
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="display-4">Thêm Sản Phẩm</h2>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=dashboard">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=log-out">Log out</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
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
        <div class="mb-3">
            <label for="image" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
            <div class="mt-2">
                <img id="imagePreview" src="#" alt="Preview hình ảnh" class="img-fluid d-none" style="max-width: 300px;">
            </div>
        </div>
        <button type="submit" name="upload">Upload</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview hình ảnh
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>


<?php include('partials/footer.php'); ?>