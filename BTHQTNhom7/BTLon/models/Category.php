<?php

class Category
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect(); // Sử dụng kết nối PDO từ class Database
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
