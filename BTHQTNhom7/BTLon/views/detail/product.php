<?php
// Lấy ID từ URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    require_once 'models/SanPham.php';
    $newsModel = new SanPham();
    $news = $newsModel->getProductById($id);

    if (!$news) {
        echo "Tin tức không tồn tại!";
        exit();
    }
} else {
    echo "ID không hợp lệ!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEJHo8E4B2v5zaZ2JG4fuqz4Q6+O8B1s92Yl9XcEv/Ck5wGS+jVj/eE0yNod0" crossorigin="anonymous">

    <style>
        .fixed-img {
            width: 70%;
            height: 70%;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="display-4">Chi tiết sản phẩm</h1>
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
        <h2 class="mt-4">Tên : <?= htmlspecialchars($news['TenSanPham']) ?></h2>
        <h2 class="mt-4">Giá :<?= htmlspecialchars($news['DonGia']) ?> VND</h2>
        <h2 class="mt-4">Mùi Hương : <?= htmlspecialchars($news['MuiHuong']) ?></h2>
        <a href="index.php?action=home" class="btn btn-success mt-4">Mua</a>
    <div>
        <img src="assets/image/<?php echo htmlspecialchars($news['HinhAnh']); ?>" class="card-img-top fixed-img" alt="Hình ảnh">
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0XjtMIfR9hzA5c3Gkp88d4B5Q4sH7wzR5f0X7htzJ6z5PZxj"
        crossorigin="anonymous"></script>
</body>
</html>
<?php include('./views/admin/sp/partials/footer.php'); ?>
