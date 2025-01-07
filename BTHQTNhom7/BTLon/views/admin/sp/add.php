<!-- add.php -->
<?php include('partials/header.php'); ?>

<div class="container mt-5">
    <h2>Thêm Tin tức Mới</h2>
    <form action="?action=add_news" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-select" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm tin tức</button>
    </form>
</div>

<?php include('partials/footer.php'); ?>