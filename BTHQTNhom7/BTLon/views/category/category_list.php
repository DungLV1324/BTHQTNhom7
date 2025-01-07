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
    <title>List Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <!-- Header with Navbar -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="display-4">List Category</h1>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?action=category">Category</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="d-flex" style="justify-content: space-between">
            <h2>Danh sách thể loại</h2>
        </div>
        <ul class="list-group mt-2">
            <?php foreach ($categories as $category): ?>
                <a href="?action=home&category=<?php echo $category['id'] ?>">
                    <li class="list-group-item"><?php echo htmlspecialchars($category['name']); ?></li>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include('./views/admin/sp/partials//footer.php'); ?>
