<?php
class News
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect(); // Sử dụng kết nối PDO từ class Database
    }

    // Lấy tất cả tin tức
    public function getAllNews()
    {
        $stmt = $this->pdo->query("SELECT n.id AS news_id, n.title, c.name AS category_name, n.image, n.created_at
          FROM news n
          INNER JOIN categories c ON n.category_id = c.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchNews($keyword)
    {
        // Câu lệnh SQL cải tiến với tham số từ khóa đã được xử lý
        $stmt = $this->pdo->prepare(
            "SELECT n.id AS news_id,
            n.title,
            c.name AS category_name,
            n.image,
            n.content,
            n.created_at
        FROM news n
        INNER JOIN categories c ON n.category_id = c.id
        WHERE n.title LIKE :keyword
        OR n.content LIKE :keyword"
        );


        // Liên kết giá trị cho tham số :keyword
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR); // Đảm bảo từ khóa được xử lý đúng

        // Thực thi câu lệnh SQL
        $stmt->execute();

        // Trả về kết quả dưới dạng mảng kết hợp
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Lấy tin tức theo ID
    public function getNewsById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm tin tức mới
    public function addNews($title, $content, $image, $category_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $image, $category_id]);
    }

    // Cập nhật tin tức
    public function updateNews($id, $title, $content, $image, $categoryId)
    {
        // Cập nhật câu lệnh SQL để bao gồm trường category_id
        $stmt = $this->pdo->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");

        // Thực thi câu lệnh SQL với tất cả các tham số: title, content, image, category_id, id
        $stmt->execute([$title, $content, $image, $categoryId, $id]);
    }


    // Xóa tin tức
    public function deleteNews($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Lấy tin tức theo phân trang
    public function getNewsByPage($category = null)
    {
        if ($category != null) {
            $stmt = $this->pdo->prepare("SELECT * FROM news where category_id = " . $category);
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM news");
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tổng số tin tức
    public function getTotalNews()
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM news");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
