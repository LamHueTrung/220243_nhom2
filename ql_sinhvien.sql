-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 11, 2024 lúc 06:21 AM
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
('DA21TTB', 'Công Nghệ Thông Tin B', 'Lop B', 0),
('DA21TTC', 'Công Nghệ Thông Tin C', 'lop c', 1);

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
('110121255', 'Lâm Huệ', 'Trung', '2002-11-11', 'Nam', 'DA21TTB', 'lamhuetrung@gmail.com', '0312345678', 'tv', 'profile.png', 0),
('110121266', 'Mã Đại', 'Phú', '2002-11-11', 'Nam', 'DA21TTB', 'phu@gmail.com', '0967331058', 'tv', 'madaiphu.jpg', 0),
('110121269', 'Nguyễn Hoàng', 'Nhựt', '2002-10-09', 'Nam', 'DA21TTC', 'hoangnhutnguyen7@gmail.com', '0967331058', 'Trà Vinh', '427887082_1615266225898770_1382639537682669743_n.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `loaitk` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `taikhoan`, `matkhau`, `loaitk`) VALUES
(1, '110121266', '$2y$10$w3RAkdbPxgSy82QurpKThOOuJ50.5terzNkQGkgDMm4ZFkqAOAkiW', 0),
(2, 'NhutHoang', '$2y$10$Dx7FmBWY7KSFkoQhFJJQ2OLunG7W2jKF2nssjdtn002EhPzVq2bm2', 1),
(3, 'admin', '$2y$10$t87u3hr3alukKcxt8w0sG.kbIJhAgYoxvf44mmdxA166gys..F/lC', 1),
(4, 'HoangNhut', '$2y$10$lKYYBHI31WSUy3YVQhCITuor4OaTLF0vE6Se2YpUKqJbrJP/oE2MS', 1),
(5, '', '$2y$10$vEy1UWtPY.yCnh6QgYj7K.Yavfuu0q1cKnPTex7grMqCZ4IF8TFR2', 1);

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
