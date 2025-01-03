<?php
require_once 'models/Category.php';

class CategoryController
{

    // Hiển thị danh sách thể loại
    public function listCategories()
    {
        // Tạo đối tượng Category và gọi phương thức lấy danh sách thể loại
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories(); // Lấy tất cả thể loại từ cơ sở dữ liệu

        // Hiển thị danh sách thể loại
        include 'views/category/category_list.php'; // Chuyển đến view để hiển thị danh sách thể loại
    }
}
