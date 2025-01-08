<?php
require_once 'models/DonHang.php';
require_once 'models/Customer.php';
require_once 'models/Employee.php';
require_once 'models/SanPham.php';

class DonHangController
{
    // Chi tiết đơn hàng
    public function detail($id)
    {
        $orderModel = new DonHang();
        $orderDetails = $orderModel->getOrderDetails($id);
//        include 'views/orders/index.php';
    }

    // Thêm đơn hàng
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderData = [
                'MaKhachHang' => $_POST['customer_id'],
                'MaNhanVien' => $_POST['employee_id'],
                'NgayDatHang' => $_POST['order_date'],
                'NgayGiaoHang' => $_POST['delivery_date'],
                'DiaChiGiaoHang' => $_POST['delivery_address'],
                'ThanhPhoGiaoHang' => $_POST['delivery_city'],
                'MaBuuDienGiaoHang' => $_POST['postal_code'],
            ];

            $orderDetails = json_decode($_POST['order_details'], true); // Chi tiết đơn hàng dưới dạng JSON

            $orderModel = new DonHang();
            $orderModel->addOrder($orderData, $orderDetails);

            header("Location: index.php?controller=order&action=index");
            exit();
        }

//        $customerModel = new Customer();
//        $customers = $customerModel->getAllCustomers();
//        $employeeModel = new Employee();
//        $employees = $employeeModel->getAllEmployees();
        $productModel = new DonHang();
        $products = $productModel->getAllProducts();

//        include 'views/admin/orders/add.php';
    }

    // Xóa đơn hàng
    public function delete($id)
    {
        $orderModel = new DonHang();
        $orderModel->deleteOrder($id);
        header("Location: index.php?controller=order&action=index");
        exit();
    }
}
