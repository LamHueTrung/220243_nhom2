-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2024 lúc 08:12 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

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
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ho` varchar(255) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `ho`, `ten`, `username`, `password`) VALUES
(1, 'Hoang', 'Nhut', 'admin', '21232f297a57a5a743894a0e4a801fc3');

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
('DA21TTA', 'Công Nghệ thông tin A', 'khoá 21 2021-2025', 0),
('DA21TTC', 'Công Nghệ Thông Tin C', 'lop c', 1),
('DA21TTg', 'ttG', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `province`
--

CREATE TABLE `province` (
  `id` varchar(255) NOT NULL,
  `id_province` varchar(255) NOT NULL,
  `id_district` varchar(255) NOT NULL,
  `id_ward` varchar(255) NOT NULL,
  `diachicuthe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `province`
--

INSERT INTO `province` (`id`, `id_province`, `id_district`, `id_ward`, `diachicuthe`) VALUES
('110121244', '92', '925', '31273', 'Sóc Tre');

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
('110121244', 'Lam', 'Nam Phong', '2003-01-08', 'Nam', 'DA21TTC', 'lamhuetrung@gmail.com', '0763849007', '110121244', 'z5923648550304_249b7d24a609ad3c2dec4a7920148729.jpg', 0),
('110121255', 'Lâm Huệ', 'Trung', '2003-01-08', 'Nam', 'DA21TTC', 'lamhuetrung@gmail.com', '0763849007', 'Sóc Tre - Tỉnh Trà Vinh - Huyện Tiểu Cần - Xã Phú Cần', 'z5923648550304_249b7d24a609ad3c2dec4a7920148729.jpg', 1),
('110121269', 'Nguyễn Hoàng', 'Nhựt', '2003-02-02', 'Nam', 'DA21TTC', 'lamhuetrung@gmail.com', '0763849007', 'cà phê Nhựt Hoàng - Xã Phước Hảo - Huyện Châu Thành - Tỉnh Trà Vinh', 'avt.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `loaitk` tinyint(1) DEFAULT 0,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `taikhoan`, `matkhau`, `loaitk`, `isDeleted`) VALUES
(8, '110121266', '0485e78bc1b4aaaeca24c907a6b75d31', 0, 0),
(10, 'NguyenNgocDanThanh', 'e10adc3949ba59abbe56e057f20f883e', 1, 0),
(11, '110121255', '1f78154ce747a8d0fbb2a323b04416ec', 0, 0),
(12, '110121299', '729a630f558cba5ef5fa9842a76745e1', 0, 0),
(13, '110121206', '$2y$10$h0fcAfl6vwvEfsJxXjHZUuqL7SQvTQkLow.22jQjc88ztnQu4bl/y', 0, 0),
(14, '110121255', '$2y$10$HrrJirhf3/yc.6v.HKc/U.l9w13HAqorwFUzq3kvp5tUr1jgSGoKm', 0, 0),
(15, '110121269', '$2y$10$aFzyLFGT8.fQL/pBOrw7vuJBtk0V5FfFGmO3V.cgGsA53ovnhe.ni', 0, 0),
(17, '110121244', '$2y$10$Fnxpj.7Ul0qqEOVY2o5tVOha5SJESkBi/FYKfWTcQipC/8fhHwzmq', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lophoc`
--
ALTER TABLE `lophoc`
  ADD PRIMARY KEY (`maLop`);

--
-- Chỉ mục cho bảng `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`maSV`),
  ADD KEY `maLop` (`maLop`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
