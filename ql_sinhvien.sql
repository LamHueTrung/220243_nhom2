-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_sinhvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `lophoc`
--

CREATE TABLE `lophoc` (
  `maLop` varchar(12) NOT NULL,
  `tenLop` varchar(100) NOT NULL,
  `ghiChu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lophoc`
--

INSERT INTO `lophoc` (`maLop`, `tenLop`, `ghiChu`) VALUES
('DA22TTD', 'Đại học công nghệ thông tin D khóa 22', 'Liên thông'),
('DF23TT', 'Liên thông - Công nghệ thông tin khóa 21', 'Liên thông');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `maSV` varchar(9) NOT NULL COMMENT 'Mã sinh viên',
  `hoLot` varchar(20) NOT NULL COMMENT 'Họ lót',
  `tenSV` varchar(10) NOT NULL COMMENT 'Tên sinh viên',
  `ngaySinh` date NOT NULL COMMENT 'Ngày sinh',
  `gioiTinh` varchar(6) NOT NULL COMMENT 'Giới tính',
  `maLop` varchar(20) NOT NULL COMMENT 'Mã Lớp',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `soDT` int(11) NOT NULL COMMENT 'Số điện thoại',
  `diaChi` text NOT NULL COMMENT 'Địa chỉ',
  `hinhAnh` varchar(255) NOT NULL COMMENT 'Hình ảnh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`maSV`, `hoLot`, `tenSV`, `ngaySinh`, `gioiTinh`, `maLop`, `email`, `soDT`, `diaChi`, `hinhAnh`) VALUES
('110121206', 'Nguyễn Mai', 'Đức Anh', '0004-12-09', 'Nam', 'DA22TTD', 'kira96.shippo@gmail.com', 98327123, 'Trà Vinhh', ''),
('110121208', 'Nguyễn', 'Hoàng', '2003-11-11', 'Nam', 'DA22TTD', 'kira963.shippo@gmail.com', 325163782, 'Trà Vinh', ''),
('110121209', 'Lâm', 'Tấn', '2002-02-22', 'Nam', 'DA22TTD', 'kira9637.shippo@gmail.com', 325163783, 'Trà Vinh', 'RedHD.jpg'),
('110121210', 'Gia', 'Kỳ', '2006-10-10', 'Nam', 'DA22TTD', 'kira9637.shippo2@gmail.com', 325163784, 'Trà Vinh', 'PurpleCoalJG.jpg'),
('123', '4444', 'nmmn', '0012-09-05', 'Nam', 'DA22TTD', '123456789', 2321323, 'hoa', 'BlackJG.jpg'),
('222', 'Lâm', 'Hưởng', '2001-01-01', 'Nam', 'DA22TTD', 'kira963.shippo1@gmail.com', 123091237, 'Trà Vinh', 'BlueSea.jpg'),
('333', 'Nguyễn ', 'Trí Việt', '2003-03-31', 'Nam', 'DA22TTD', 'kira963.shippoaa@gmail.com', 912371236, 'hoa', 'PurpleCoal.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lophoc`
--
ALTER TABLE `lophoc`
  ADD PRIMARY KEY (`maLop`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`maSV`),
  ADD KEY `maLop` (`maLop`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`maLop`) REFERENCES `lophoc` (`maLop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
