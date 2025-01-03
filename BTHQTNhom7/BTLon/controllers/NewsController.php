<?php
require_once 'models/News.php';

class NewsController
{
    // Chi tiết tin tức
    public function detail($id)
    {
        $newsModel = new News();
        $news = $newsModel->getNewsById($id);

        include 'views/news/detail.php';
    }

    // Thêm tin tức
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category = $_POST['category_id'];
            $image = $_FILES['image'];

            // Upload ảnh
            $imagePath = $this->uploadImage($image);

            // Thêm tin tức vào cơ sở dữ liệu
            $newsModel = new News();
            $newsModel->addNews($title, $content, $imagePath, $category);

            header("Location: index.php?controller=home&action=index");
            exit();
        }
        $a = new Category();

        $categories = $a->getAllCategories();
        include 'views/admin/news/add.php';
    }

    public function search($keyword = null)
    {
        $newsModel = new News();

        if ($keyword) {
            $results = $newsModel->searchNews($keyword);
            if (empty($results)) {
                $noResultsMessage = 'Không có kết quả nào phù hợp với từ khóa.';
            }
        } else {
            $results = $newsModel->getAllNews();
        }

        include 'views/home/index.php';
    }

    // Cập nhật tin tức
    public function update($id)
    {
        // Lấy dữ liệu tin tức theo id
        $newsModel = new News();
        $news = $newsModel->getNewsById($id);

        if (!$news) {
            // Nếu không có tin tức, chuyển hướng về trang chủ
            header("Location: index.php?controller=home&action=index");
            exit();
        }

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
        ) {
            // Lấy dữ liệu từ form
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $categoryId = $_POST['category_id'];  // Lấy category_id từ form
            $image = $_FILES['image'];

            // Nếu có ảnh mới, xử lý ảnh
            if (!empty($image['name'])) {
                $imagePath = $this->uploadImage($image);
            } else {
                // Nếu không có ảnh mới, giữ lại ảnh cũ
                $imagePath = $news['image'];
            }

            // Cập nhật tin tức vào cơ sở dữ liệu
            $newsModel->updateNews($id, $title, $content, $imagePath, $categoryId);

            // Chuyển hướng về trang chi tiết tin tức hoặc danh sách tin tức
            header("Location: index.php?controller=news&action=detail&id=" . $id);
            exit();
        }

        // Lấy danh sách danh mục
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();

        include 'views/admin/news/edit.php';  // Truyền các dữ liệu cần thiết vào view
    }



    // Xóa tin tức
    public function delete($id)
    {
        $newsModel = new News();
        $newsModel->deleteNews($id);
        header("Location: index.php?controller=home&action=index");
        exit();
    }

    private function uploadImage($image)
    {
        $targetDir = "assets/image/";
        $tmp = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        move_uploaded_file($tmp, $targetDir . $name);
        return $image["name"];
    }
}
