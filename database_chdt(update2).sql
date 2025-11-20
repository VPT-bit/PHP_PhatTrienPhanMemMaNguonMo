-- ===============================
-- Database: CuaHangDienTu
-- ===============================
-- TK: admin
-- MK: 1
-- TK: nv
-- MK: 1
-- TK: kh
-- MK: 1
DROP DATABASE IF EXISTS CuaHangDienTu;
CREATE DATABASE CuaHangDienTu;
USE CuaHangDienTu;

-- ===============================
-- Bảng nhà cung cấp
-- ===============================
CREATE TABLE nha_cung_cap (
    Ma_nha_cung_cap VARCHAR(10) PRIMARY KEY,
    Ten_nha_cung_cap VARCHAR(100) NOT NULL,
    Dia_chi VARCHAR(200),
    Dien_thoai VARCHAR(20),
    Email VARCHAR(100)
);

INSERT INTO nha_cung_cap VALUES
('NCC1', 'Samsung VN', 'Hà Nội', '0241234567', 'contact@samsung.vn'),
('NCC2', 'Apple VN', 'TP HCM', '0287654321', 'contact@apple.vn'),
('NCC3', 'Sony VN', 'Đà Nẵng', '0236123456', 'contact@sony.vn'),
('NCC4', 'Xiaomi VN', 'Hà Nội', '0249876543', 'contact@xiaomi.vn'),
('NCC5', 'Oppo VN', 'TP HCM', '0282233445', 'contact@oppo.vn'),
('NCC6', 'LG VN', 'Hải Phòng', '0225666777', 'contact@lg.vn'),
('NCC7', 'Asus VN', 'Đà Nẵng', '0236789123', 'contact@asus.vn'),
('NCC8', 'Acer VN', 'Cần Thơ', '0292388888', 'contact@acer.vn'),
('NCC9', 'Dell VN', 'TP HCM', '0285554444', 'contact@dell.vn'),
('NCC10', 'HP VN', 'Hà Nội', '0249988776', 'contact@hp.vn');

-- ===============================
-- Bảng loại sản phẩm
-- ===============================
CREATE TABLE loai_san_pham (
    Ma_loai VARCHAR(10) PRIMARY KEY,
    Ten_loai VARCHAR(100) NOT NULL
);

INSERT INTO loai_san_pham VALUES
('L1', 'Điện thoại'),
('L2', 'Laptop'),
('L3', 'Tai nghe'),
('L4', 'Tivi'),
('L5', 'Máy tính bảng'),
('L6', 'Đồng hồ thông minh'),
('L7', 'Loa Bluetooth'),
('L8', 'Chuột máy tính'),
('L9', 'Bàn phím'),
('L10', 'Phụ kiện');

-- ===============================
-- Bảng sản phẩm
-- ===============================
CREATE TABLE san_pham (
    Ma_san_pham VARCHAR(10) PRIMARY KEY,
    Ten_san_pham VARCHAR(100) NOT NULL,
    Ma_loai VARCHAR(10),
    So_luong INT DEFAULT 0,
    Don_gia DECIMAL(10,2) NOT NULL,
    Ma_nha_cung_cap VARCHAR(10),
    Mo_ta TEXT,
    Hinh_anh VARCHAR(255),
    Ngay_tao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Ma_loai) REFERENCES loai_san_pham(Ma_loai)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Ma_nha_cung_cap) REFERENCES nha_cung_cap(Ma_nha_cung_cap)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO san_pham VALUES
('SP1','Samsung Galaxy S23','L1',50,25000000,'NCC1','Điện thoại cao cấp Samsung','Samsung Galaxy S23.webp',NOW()),
('SP2','iPhone 15','L1',30,30000000,'NCC2','Điện thoại Apple mới nhất','iPhone 15.jpg',NOW()),
('SP3','Sony WH-1000XM5','L3',40,7000000,'NCC3','Tai nghe chống ồn Sony','Sony WH-1000XM5.png',NOW()),
('SP4','MacBook Pro 16','L2',20,55000000,'NCC2','Laptop cao cấp Apple','MacBook Pro 16.jpg',NOW()),
('SP5','Sony Bravia 55inch','L4',10,22000000,'NCC3','Tivi 4K Sony','Sony Bravia 55inch.webp',NOW()),
('SP6','Xiaomi 13 Pro','L1',60,19000000,'NCC4','Điện thoại chụp ảnh đẹp','Xiaomi 13 Pro.jpg',NOW()),
('SP7','Oppo Find X7','L1',45,21000000,'NCC5','Flagship Oppo hiệu năng cao','Oppo Find X7.webp',NOW()),
('SP8','Dell XPS 13','L2',25,32000000,'NCC9','Laptop mỏng nhẹ, pin tốt','Dell XPS 13.jpg',NOW()),
('SP9','Asus ROG Strix','L2',15,45000000,'NCC7','Laptop gaming mạnh mẽ','Asus ROG Strix.jpg',NOW()),
('SP10','LG OLED 65inch','L4',12,37000000,'NCC6','Tivi OLED hiển thị cực nét','LG OLED 65inch.jpg',NOW());

-- ===============================
-- Bảng khách hàng
-- ===============================
CREATE TABLE khach_hang (
    Ma_khach_hang VARCHAR(10) PRIMARY KEY,
    Ten_khach_hang VARCHAR(100) NOT NULL,
    Phai TINYINT(1), -- 0 = nữ, 1 = nam
    Dia_chi VARCHAR(200),
    Dien_thoai VARCHAR(20),
    Email VARCHAR(100)
);

INSERT INTO khach_hang VALUES
('KH691b06a2', 'Phạm Bá Dương', 1, 'Đại học nha trang', '0389851543', 'duong.pb.64.cntt@ntu.edu.vn');


-- ===============================
-- Bảng nhân viên
-- ===============================
CREATE TABLE nhan_vien (
    Ma_nhan_vien VARCHAR(10) PRIMARY KEY,
    Ten_nhan_vien VARCHAR(100) NOT NULL,
    Phai TINYINT(1),
    Dia_chi VARCHAR(200),
    Dien_thoai VARCHAR(20),
    Chuc_vu VARCHAR(50)
);

INSERT INTO nhan_vien VALUES
('NV691b0e11465b5', 'Phạm Bá Dương(admin)', 1, 'Nha trang', '0911222333', 'Quản lý'),
('NV691b067a', 'Phạm Bá Dương(nhân viên)', 1, 'Nha Trang', '0911222334', 'Nhân viên');


-- ===============================
-- Bảng hóa đơn
-- ===============================
CREATE TABLE hoa_don (
    Ma_hoa_don VARCHAR(10) PRIMARY KEY,
    Ma_khach_hang VARCHAR(10),
    Ma_nhan_vien VARCHAR(10),
    Ngay_tao DATETIME DEFAULT CURRENT_TIMESTAMP,
    Tong_tien DECIMAL(12,2) NOT NULL,
	Trang_thai TINYINT(1) DEFAULT 0, -- 0 = Chờ xác nhận, 1 = đã xác nhận , 2 = đã giao cho vận chuyển , 3 = đã hoàn thành, 4 = đã huỷ
	Loai_don_hang TINYINT(1) DEFAULT 0, -- 0 = offline, 1 = online 
    FOREIGN KEY (Ma_khach_hang) REFERENCES khach_hang(Ma_khach_hang)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Ma_nhan_vien) REFERENCES nhan_vien(Ma_nhan_vien)
        ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO `hoa_don` (`Ma_hoa_don`, `Ma_khach_hang`, `Ma_nhan_vien`, `Ngay_tao`, `Tong_tien`, `Trang_thai`, `Loai_don_hang`) VALUES
('HD1', 'KH691b06a2', 'NV691b067a', '2025-11-18 04:12:02', 60000000.00, 3, 0),
('HD2', 'KH691b06a2', 'NV691b067a', '2025-11-18 04:16:03', 262000000.00, 3, 0),
('HD3', 'KH691b06a2', 'NV691b067a', '2025-11-18 04:16:56', 144000000.00, 3, 0),
('HD4', 'KH691b06a2', 'NV691b067a', '2025-11-18 04:18:14', 184000000.00, 3, 0),
('HD5', 'KH691b06a2', 'NV691b067a', '2025-11-18 04:18:49', 110000000.00, 3, 0);
-- ===============================
-- Bảng chi tiết hóa đơn
-- ===============================
CREATE TABLE chi_tiet_hoa_don (
    Ma_hoa_don VARCHAR(10),
    Ma_san_pham VARCHAR(10),
    So_luong INT NOT NULL,
    Don_gia DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (Ma_hoa_don, Ma_san_pham),
    FOREIGN KEY (Ma_hoa_don) REFERENCES hoa_don(Ma_hoa_don)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Ma_san_pham) REFERENCES san_pham(Ma_san_pham)
        ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO `chi_tiet_hoa_don` (`Ma_hoa_don`, `Ma_san_pham`, `So_luong`, `Don_gia`) VALUES
('HD1', 'SP2', 2, 30000000.00),
('HD2', 'SP1', 2, 25000000.00),
('HD2', 'SP3', 2, 7000000.00),
('HD2', 'SP5', 2, 22000000.00),
('HD2', 'SP8', 2, 32000000.00),
('HD2', 'SP9', 2, 45000000.00),
('HD3', 'SP6', 2, 19000000.00),
('HD3', 'SP7', 2, 21000000.00),
('HD3', 'SP8', 2, 32000000.00),
('HD4', 'SP1', 2, 25000000.00),
('HD4', 'SP10', 2, 37000000.00),
('HD4', 'SP2', 2, 30000000.00),
('HD5', 'SP4', 2, 55000000.00);
CREATE TABLE quyen (
    Ma_quyen VARCHAR(10) PRIMARY KEY,
    Ten_quyen VARCHAR(50) NOT NULL,
    Mo_ta VARCHAR(200)
);

INSERT INTO quyen VALUES
('Q1', 'Admin', 'Quản trị hệ thống, có toàn quyền'),
('Q2', 'NhanVien', 'Nhân viên bán hàng, quản lý hóa đơn, sản phẩm'),
('Q3', 'KhachHang', 'Khách hàng, có thể xem và mua hàng');


CREATE TABLE tai_khoan (
    Ten_dang_nhap VARCHAR(50) PRIMARY KEY,
    Mat_khau VARCHAR(255) NOT NULL,  -- lưu password đã mã hóa (bcrypt, sha256, ...)
    Ma_quyen VARCHAR(10),             -- liên kết tới bảng quyền
    Ma_nhan_vien VARCHAR(10),         -- nếu tài khoản thuộc về nhân viên
    Ma_khach_hang VARCHAR(10),        -- nếu tài khoản thuộc về khách hàng
    Trang_thai TINYINT(1) DEFAULT 1,  -- 1: hoạt động, 0: bị khóa
    Ngay_tao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Ma_quyen) REFERENCES quyen(Ma_quyen)
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (Ma_nhan_vien) REFERENCES nhan_vien(Ma_nhan_vien)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Ma_khach_hang) REFERENCES khach_hang(Ma_khach_hang)
        ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO tai_khoan VALUES
('admin', '$2y$10$ap.471E4KMWgqLhyQc/o1OV0vgjP.u7zisKhyQae5M8DGHXK4fYZy', 'Q1', 'NV691b0e11465b5', NULL, 1, NOW()),
('kh', '$2y$10$CorM3VxE6wGssOdNoHfPjOWbbhDbo79/ttSLYzyDD0wLdugf8.ms6', 'Q3', NULL, 'KH691b06a2', 1, NOW()),
('nv', '$2y$10$r5ioJ6pQfOFkTMys3a3TaudE4cx06SMa0GUbrmqhbs/PnP.dt.2OS', 'Q2', 'NV691b067a', NULL, 1, NOW());



CREATE TABLE `gio_hang` (
  `id` int(11) NOT NULL,
  `ma_khach_hang` varchar(50) NOT NULL,
  `ma_san_pham` varchar(50) NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DELIMITER //

CREATE TRIGGER trg_after_insert_cthd
AFTER INSERT ON chi_tiet_hoa_don
FOR EACH ROW
BEGIN
    UPDATE hoa_don
    SET Tong_tien = (
        SELECT SUM(So_luong * Don_gia)
        FROM chi_tiet_hoa_don
        WHERE Ma_hoa_don = NEW.Ma_hoa_don
    )
    WHERE Ma_hoa_don = NEW.Ma_hoa_don;
END;
//

DELIMITER ;
