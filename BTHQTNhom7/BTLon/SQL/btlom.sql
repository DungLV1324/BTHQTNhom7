CREATE
DATABASE IF NOT EXISTS btlon;

USE
btlon;

-- Bảng Nhà CungCap (Nhà cung cấp)
CREATE TABLE NhaCungCap
(
    MaNhaCungCap   INT PRIMARY KEY AUTO_INCREMENT,
    TenCongTy      VARCHAR(255) NOT NULL,
    TenNguoiLienHe VARCHAR(255),
    DiaChi         VARCHAR(255),
    ThanhPho       VARCHAR(100),
    MaBuuDien      VARCHAR(20),
    SoDienThoai    VARCHAR(20)
);

-- Bảng DanhMucSanPham (Danh mục sản phẩm)
CREATE TABLE DanhMucSanPham
(
    MaDanhMuc  INT PRIMARY KEY AUTO_INCREMENT,
    TenDanhMuc VARCHAR(255) NOT NULL,
    MoTa       TEXT
);

-- Bảng SanPham (Sản phẩm)
CREATE TABLE SanPham
(
    MaSanPham    INT PRIMARY KEY AUTO_INCREMENT,
    MaDanhMuc    INT          NOT NULL,
    MaNhaCungCap INT          NOT NULL,
    TenSanPham   VARCHAR(255) NOT NULL,
    DonGia       DECIMAL(18, 2),
    KichThuoc    VARCHAR(50),
    MauSac       VARCHAR(50),
    MuiHuong     VARCHAR(50),
    SoLuong      INT,
    HinhAnh      VARCHAR(255),
    TenTheLoai   NVARCHAR(255),
    FOREIGN KEY (MaDanhMuc) REFERENCES DanhMucSanPham (MaDanhMuc),
    FOREIGN KEY (MaNhaCungCap) REFERENCES NhaCungCap (MaNhaCungCap)
);

-- Bảng KhachHang (Khách hàng)
CREATE TABLE KhachHang
(
    MaKhachHang INT PRIMARY KEY AUTO_INCREMENT,
    Ho          VARCHAR(100) NOT NULL,
    Ten         VARCHAR(100) NOT NULL,
    DiaChi      VARCHAR(255),
    SoDienThoai VARCHAR(20),
    Email       VARCHAR(255),
    ThanhPho    VARCHAR(100),
    MaBuuDien   VARCHAR(20)
);

-- Bảng NhanVien (Nhân viên)
CREATE TABLE NhanVien
(
    MaNhanVien    INT PRIMARY KEY AUTO_INCREMENT,
    Ho            VARCHAR(100) NOT NULL,
    Ten           VARCHAR(100) NOT NULL,
    NgaySinh      DATE,
    DiaChi        VARCHAR(255),
    SoDienThoai   VARCHAR(20),
    Email         VARCHAR(255),
    ThanhPho      VARCHAR(100),
    MaBuuDien     VARCHAR(20),
    NgayTuyenDung DATE         NOT NULL
);

-- Bảng DonHang (Đơn hàng)
CREATE TABLE DonHang
(
    MaDonHang         INT PRIMARY KEY AUTO_INCREMENT, -- Mã đơn hàng
    MaKhachHang       INT  NOT NULL,                  -- Mã khách hàng
    MaNhanVien        INT  NOT NULL,                  -- Mã nhân viên
    NgayDatHang       DATE NOT NULL,                  -- Ngày đặt hàng
    NgayGiaoHang      DATE,                           -- Ngày giao hàng
    DiaChiGiaoHang    VARCHAR(255),                   -- Địa chỉ giao hàng
    ThanhPhoGiaoHang  VARCHAR(100),                   -- Thành phố giao hàng
    MaBuuDienGiaoHang VARCHAR(20),                    -- Mã bưu điện giao hàng
    FOREIGN KEY (MaKhachHang) REFERENCES KhachHang (MaKhachHang),
    FOREIGN KEY (MaNhanVien) REFERENCES NhanVien (MaNhanVien)
);

-- Bảng ChiTietDonHang (Chi tiết sản phẩm trong đơn hàng)
CREATE TABLE ChiTietDonHang
(
    MaDonHang INT            NOT NULL, -- Mã đơn hàng
    MaSanPham INT            NOT NULL, -- Mã sản phẩm
    DonGia    DECIMAL(18, 2) NOT NULL, -- Đơn giá
    SoLuong   INT            NOT NULL, -- Số lượng
    ChietKhau DECIMAL(5, 2) DEFAULT 0, -- Chiết khấu
    PRIMARY KEY (MaDonHang, MaSanPham),
    FOREIGN KEY (MaDonHang) REFERENCES DonHang (MaDonHang),
    FOREIGN KEY (MaSanPham) REFERENCES SanPham (MaSanPham)
);
CREATE TABLE users
(
    MaUsers  INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role     INT CHECK (role IN (0, 1)) -- 0: Người dùng, 1: Quản trị viên
);

CREATE TABLE categories
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name      VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password, role)
VALUES ('admin', 'admin123', 1),
       ('user1', 'password1', 0),
       ('user2', 'password2', 0);

INSERT INTO categories (name)
VALUES ('Nước hoa nam'),
       ('Nước hoa nữ'),
       ('Nước hoa unisex');


-- Insert into
INSERT INTO NhaCungCap (TenCongTy, TenNguoiLienHe, DiaChi, ThanhPho, MaBuuDien, SoDienThoai)
VALUES ('Perfume World', 'Nguyen Van A', '123 Đường Hoa Hồng', 'Hà Nội', '100000', '0123456789'),
       ('Luxury Scents', 'Tran Thi B', '456 Đường Hoa Sữa', 'Hồ Chí Minh', '700000', '0987654321'),
       ('Fragrance Heaven', 'Pham Van C', '789 Đường Hoa Đào', 'Đà Nẵng', '550000', '0932123456'),
       ('Scent Palace', 'Nguyen Thi D', '101 Đường Hoa Cúc', 'Hải Phòng', '180000', '0976543210'),
       ('Aroma Hub', 'Hoang Van E', '202 Đường Hoa Sen', 'Cần Thơ', '900000', '0912345678');

INSERT INTO DanhMucSanPham (TenDanhMuc, MoTa)
VALUES ('Nước hoa nam', 'Dòng nước hoa dành cho nam giới với mùi hương mạnh mẽ'),
       ('Nước hoa nữ', 'Dòng nước hoa dành cho nữ giới với mùi hương quyến rũ'),
       ('Nước hoa unisex', 'Dòng nước hoa phù hợp cho cả nam và nữ');

INSERT INTO SanPham (MaDanhMuc, MaNhaCungCap, TenSanPham, DonGia, KichThuoc, MauSac, SoLuong, MuiHuong, MaTheLoai,  HinhAnh)
VALUES (1, 1, 'Dior Sauvage Eau de Parfum', 3500000, '100ml', 'Xanh Đậm', 50, 'Cam Bergamot và tiêu', 1, 'img1.jpg'),
       (2, 2, 'Chanel No.5 Eau de Parfum', 4500000, '100ml', 'Hồng', 40, 'Hoa hồng và hoa nhài', 2, 'img2.jpg'),
       (3, 3, 'Le Labo Santal 33', 5500000, '100ml', 'Trắng', 30, 'Gỗ đàn hương và da thuộc', 1, 'img3.jpg'),
       (1, 4, 'Tom Ford Oud Wood', 6000000, '100ml', 'Nâu', 20, 'Gỗ trầm và hổ phách', 1, 'img4.jpg'),
       (2, 5, 'Jo Malone Mini Set', 2000000, '5x10ml', 'Nhiều màu', 10, 'Hoa oải hương và cam bergamot', 3, 'img5.jpg'),
       (1, 3, 'Creed Aventus', 7500000, '100ml', 'Xám', 25, 'Táo, dứa và rêu sồi', 1, 'img6.jpg'),
       (2, 4, 'YSL Black Opium', 3200000, '90ml', 'Đen', 35, 'Cà phê và vani', 2, 'img7.jpg'),
       (3, 2, 'Gucci Bloom', 3000000, '100ml', 'Đỏ', 40, 'Hoa nhài và hoa huệ', 2, 'img8.jpg'),
       (2, 1, 'Versace Eros', 2500000, '100ml', 'Xanh Ngọc', 50, 'Táo xanh và bạc hà', 1, 'img9.jpg'),
       (1, 5, 'Paco Rabanne 1 Million', 2700000, '100ml', 'Vàng', 60, 'Quế và hổ phách', 1, 'img10.jpg'),
       (1, 6, 'Montblanc Explorer', 2400000, '100ml', 'Xám Đậm', 45, 'Cam Bergamot và cỏ vetiver', 1, 'img11.jpg'),
       (2, 3, 'Prada Luna Rossa Carbon', 2800000, '100ml', 'Xám Nhạt', 30, 'Hương chanh và bạc hà', 1, 'img12.jpg'),
       (3, 4, 'Marc Jacobs Daisy', 3500000, '100ml', 'Vàng Nhạt', 50, 'Dâu tây và hoa nhài', 2, 'img13.jpg'),
       (2, 2, 'Burberry Her', 2900000, '100ml', 'Hồng Nhạt', 35, 'Dâu tây và quả mâm xôi', 2, 'img14.jpg'),
       (1, 1, 'Giorgio Armani Acqua di Gio', 2600000, '100ml', 'Xanh Biển', 40, 'Cam Bergamot và quýt xanh', 1, 'img15.jpg'),
       (1, 5, 'Dolce & Gabbana Light Blue', 2400000, '100ml', 'Xanh Nhạt', 50, 'Táo và chanh vàng', 1, 'img16.jpg'),
       (2, 6, 'Jean Paul Gaultier La Belle', 3200000, '100ml', 'Đỏ Thẫm', 25, 'Quả lê và vani', 2, 'img17.jpg'),
       (3, 4, 'Thierry Mugler Alien', 3000000, '90ml', 'Tím', 40, 'Hoa nhài và hổ phách', 2, 'img18.jpg'),
       (1, 2, 'Calvin Klein CK One', 1800000, '200ml', 'Trắng', 100, 'Cam Bergamot và xạ hương', 1, 'img19.jpg'),
       (2, 1, 'Hermes Terre d’Hermes', 3100000, '100ml', 'Cam Đậm', 20, 'Cam và gỗ tuyết tùng', 1, 'img20.jpg');

INSERT INTO KhachHang (Ho, Ten, DiaChi, SoDienThoai, Email, ThanhPho, MaBuuDien)
VALUES ('Nguyen', 'Minh Anh', '789 Đường Trần Hưng Đạo', '0901234567', 'minhanh@gmail.com', 'Hà Nội', '100000'),
       ('Tran', 'Tuan Kiet', '456 Đường Lý Thường Kiệt', '0912345678', 'tuan.kiet@gmail.com', 'Hồ Chí Minh', '700000'),
       ('Hoang', 'Bao Ngoc', '123 Đường Phạm Văn Đồng', '0932123456', 'bao.ngoc@gmail.com', 'Đà Nẵng', '550000'),
       ('Pham', 'Hong Nhung', '789 Đường Lê Lợi', '0976543210', 'hong.nhung@gmail.com', 'Hải Phòng', '180000'),
       ('Le', 'Quoc Bao', '202 Đường Cách Mạng Tháng 8', '0945123456', 'quoc.bao@gmail.com', 'Cần Thơ', '900000');

INSERT INTO NhanVien (Ho, Ten, NgaySinh, DiaChi, SoDienThoai, Email, ThanhPho, MaBuuDien, NgayTuyenDung)
VALUES ('Nguyen', 'Van An', '1990-01-15', '123 Đường Hoa Hồng', '0912345678', 'vanan@gmail.com', 'Hà Nội', '100000',
        '2015-05-01'),
       ('Tran', 'Thi Bich', '1988-03-22', '456 Đường Hoa Sữa', '0923456789', 'thibich@gmail.com', 'Hồ Chí Minh',
        '700000', '2016-07-15'),
       ('Le', 'Quoc Cuong', '1985-11-10', '789 Đường Hoa Đào', '0934567890', 'quoccuong@gmail.com', 'Đà Nẵng', '550000',
        '2014-10-20'),
       ('Pham', 'Hong Dao', '1992-06-05', '101 Đường Hoa Cúc', '0945678901', 'hongdao@gmail.com', 'Hải Phòng', '180000',
        '2018-03-30'),
       ('Hoang', 'Minh Tam', '1995-09-25', '202 Đường Hoa Sen', '0956789012', 'minhtam@gmail.com', 'Cần Thơ', '900000',
        '2020-01-10');

INSERT INTO DonHang (MaKhachHang, MaNhanVien, NgayDatHang, NgayGiaoHang, DiaChiGiaoHang, ThanhPhoGiaoHang,
                     MaBuuDienGiaoHang)
VALUES (1, 1, '2024-12-22', '2024-12-25', '789 Đường Trần Hưng Đạo', 'Hà Nội', '100000'),
       (2, 2, '2024-12-21', '2024-12-24', '456 Đường Lý Thường Kiệt', 'Hồ Chí Minh', '700000'),
       (3, 3, '2024-12-20', '2024-12-23', '123 Đường Phạm Văn Đồng', 'Đà Nẵng', '550000'),
       (4, 4, '2024-12-19', '2024-12-22', '789 Đường Lê Lợi', 'Hải Phòng', '180000'),
       (5, 5, '2024-12-18', '2024-12-21', '202 Đường Cách Mạng Tháng 8', 'Cần Thơ', '900000');

INSERT INTO ChiTietDonHang (MaDonHang, MaSanPham, DonGia, SoLuong, ChietKhau)
VALUES (1, 1, 3500000, 2, 0.1),
       (2, 2, 4500000, 1, 0.05),
       (3, 3, 5500000, 3, 0.15),
       (4, 4, 6000000, 1, 0),
       (5, 5, 2000000, 2, 0.1);

