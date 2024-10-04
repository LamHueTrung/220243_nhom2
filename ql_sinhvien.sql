-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 04, 2024 lúc 08:56 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_sinhvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophoc`
--

CREATE TABLE `lophoc` (
  `maLop` varchar(12) NOT NULL,
  `tenLop` varchar(100) NOT NULL,
  `ghiChu` varchar(100) NOT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lophoc`
--

INSERT INTO `lophoc` (`maLop`, `tenLop`, `ghiChu`, `isDeleted`) VALUES
('DA21TTC', 'Công Nghệ Thông Tin C', 'Khóa 21 - năm học 2021-2025', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `maSV` varchar(9) NOT NULL COMMENT 'Mã sinh viên',
  `hoLot` varchar(20) NOT NULL COMMENT 'Họ lót',
  `tenSV` varchar(10) NOT NULL COMMENT 'Tên sinh viên',
  `ngaySinh` date NOT NULL COMMENT 'Ngày sinh',
  `gioiTinh` varchar(6) NOT NULL COMMENT 'Giới tính',
  `maLop` varchar(20) NOT NULL COMMENT 'Mã Lớp',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `soDT` varchar(11) NOT NULL COMMENT 'Số điện thoại',
  `diaChi` text NOT NULL COMMENT 'Địa chỉ',
  `hinhAnh` varchar(255) NOT NULL COMMENT 'Hình ảnh',
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`maSV`, `hoLot`, `tenSV`, `ngaySinh`, `gioiTinh`, `maLop`, `email`, `soDT`, `diaChi`, `hinhAnh`, `isDeleted`) VALUES
('110121206', 'La Tấn', 'Đạt', '2003-02-02', 'Nam', 'DA21TTC', 'latandat@gmail.com', '0912345678', 'Trà Vinh', 'latandat.jpg', 1),
('110121255', 'Lâm Huệ', 'Trung', '2003-02-08', 'Nam', 'DA21TTC', 'lamhuetrung@gmail.com', '0763849007', 'Tiểu Cần, Trà Vinh', 'lamhuetrung.jpg', 1),
('110121266', 'Mã Đại', 'Phú', '2003-11-16', 'Nữ', 'DA21TTC', 'daiphu1611@gmail.com', '0868453011', 'Phước Hưng, Tiểu Cần, Trà Vinh', 'madaiphu.jpg', 1),
('110121269', 'Nguyễn Hoàng', 'Nhựt ', '2002-10-09', 'Nam', 'DA21TTC', 'hoangnhutnguyen7@gmail.com', '0967331058', 'Đại Thôn, Phước Hảo, Châu Thành, Trà Vinh', '427887082_1615266225898770_1382639537682669743_n.jpg', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `lophoc`
--
ALTER TABLE `lophoc`
  ADD PRIMARY KEY (`maLop`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`maSV`),
  ADD KEY `maLop` (`maLop`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`maLop`) REFERENCES `lophoc` (`maLop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
