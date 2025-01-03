<?php
// Lấy ID từ URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    require_once './tlunews/models/SanPham.php';
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
    <meta name="description" content="Chi tiết tin tức - <?= htmlspecialchars($news['title']) ?>">
    <title>Chi tiết tin tức - <?= htmlspecialchars($news['title']) ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJHo8E4B2v5zaZ2JG4fuqz4Q6+O8B1s92Yl9XcEv/Ck5wGS+jVj/eE0yNod0" crossorigin="anonymous">
</head>

<body>

    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="display-4">Chi tiết Tin tức</h1>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-5">
        <article>
            <h2 class="mt-4"><?= htmlspecialchars($news['title']) ?></h2>
            <p class="text-muted">Ngày đăng: <?= date('d/m/Y', strtotime($news['created_at'])) ?></p>
            <img src="assets/image/<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" class="img-fluid mt-3">
            <p class="mt-3"><?= nl2br(htmlspecialchars($news['content'])) ?></p>
            <a href="index.php?action=home" class="btn btn-secondary mt-4">Quay lại</a>
        </article>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Tin tức</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0XjtMIfR9hzA5c3Gkp88d4B5Q4sH7wzR5f0X7htzJ6z5PZxj" crossorigin="anonymous"></script>

</body>

</html>