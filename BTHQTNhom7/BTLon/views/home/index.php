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
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .fixed-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }
        .card-title {
            font-size: 1rem;
            line-height: 1.2;
            max-height: 2.4rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

    </style>
</head>

<body>
<!-- Header with Navbar -->
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="display-4">Home</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=category">Category</a>
                    </li>
                    <?php if ($_SESSION['user']['role'] === 1): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?action=dashboard">Dashboard</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=log-out">Log out</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=log-out">Log in</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mt-5">
    <h2>Nước Hoa</h2>
    <!-- Form Tìm Kiếm -->
    <form action="index.php?action=search" method="get" class="form-inline mb-3">
        <input type="text" name="keyword" class="form-control mr-2" placeholder="Tìm kiếm tin tức..."
               value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>" required>
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>

    <!-- Hiển thị kết quả tìm kiếm -->
    <?php if (isset($_GET['keyword'])): ?>
        <h3 class="mt-4">Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($_GET['keyword']); ?>"</h3>
    <?php endif; ?>

    <!-- Hiển thị thông báo nếu không tìm thấy kết quả -->
    <?php if (isset($noResultsMessage)): ?>
        <div class="alert alert-warning mt-4"><?php echo htmlspecialchars($noResultsMessage); ?></div>
    <?php endif; ?>

    <?php if (!empty($results)): ?>
        <div class="row mt-4">
            <?php foreach ($results as $product): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="assets/image/<?php echo htmlspecialchars($product['HinhAnh']); ?>" class="card-img-top fixed-img" alt="Sản phẩm hình ảnh">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['TenSanPham']); ?></h5>
                            <p class="card-text text-truncate" style="max-height: 50px;"><?php echo htmlspecialchars($product['DonGia']); ?></p>
                            <a href="index.php?controller=product&action=detail&id=<?php echo $product['MaSanPham']; ?>" class="btn btn-primary">Mua</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif (!isset($_GET['keyword'])): ?>
        <?php if (!empty($productList)): ?>
            <div class="row mt-4">
                <?php foreach ($productList as $product): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="card mb-4 shadow-sm">
                            <img src="assets/image/<?php echo htmlspecialchars($product['HinhAnh']); ?>" class="card-img-top fixed-img" alt="Sản phẩm hình ảnh">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['TenSanPham']); ?></h5>
                                <p class="card-text text-truncate" style="max-height: 50px;"><?php echo htmlspecialchars($product['DonGia']); ?> <a>VND</a></p>
                                <a href="index.php?controller=product&action=detail&id=<?php echo $product['MaSanPham']; ?>" class="btn btn-primary">Mua</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>


</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 Tin tức</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>