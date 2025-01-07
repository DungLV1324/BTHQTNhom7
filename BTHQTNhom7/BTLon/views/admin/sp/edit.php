<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- edit.php -->
<?php include('partials/header.php'); ?>

<div class="container mt-5">
    <h2>Chỉnh sửa Tin tức</h2>
    <form action="index.php?action=edit_news&id=<?= $news['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-select" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $news['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" name="content" rows="5" required><?= htmlspecialchars($news['content']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" name="image">
            <img src="uploads/<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" class="mt-2" width="100">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật tin tức</button>
    </form>
</div>

<?php include('partials/footer.php'); ?>