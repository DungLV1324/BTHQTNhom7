<?php



class User
{
    // Phương thức xác thực người dùng
    public static function authenticate($username, $password)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin người dùng nếu xác thực thành công
    }

    // Lấy tổng số người dùng
    public static function getTotalUsers()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT COUNT(*) AS total FROM users");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
