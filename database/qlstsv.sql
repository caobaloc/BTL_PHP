-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2022 at 04:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlstsv`
--

-- --------------------------------------------------------

--
-- Table structure for table `chungchi`
--

CREATE TABLE `chungchi` (
  `id` int(11) NOT NULL,
  `ten_cc` varchar(255) NOT NULL,
  `thoi_gian_nop` date NOT NULL,
  `tinh_trang` varchar(255) NOT NULL,
  `sv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chungchi`
--

INSERT INTO `chungchi` (`id`, `ten_cc`, `thoi_gian_nop`, `tinh_trang`, `sv_id`) VALUES
(1, 'IELTS', '2019-10-17', 'Đã xử lý', 1),
(2, 'Google Digital Garage', '2019-11-15', 'Đã xử lý', 2);

-- --------------------------------------------------------

--
-- Table structure for table `diem`
--

CREATE TABLE `diem` (
  `id` int(11) NOT NULL,
  `mon_id` int(11) NOT NULL,
  `sv_id` int(11) NOT NULL,
  `diem_tp_1` float DEFAULT NULL,
  `diem_tp_2` float DEFAULT NULL,
  `diem_thi` float DEFAULT NULL,
  `nop_tien` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diem`
--

INSERT INTO `diem` (`id`, `mon_id`, `sv_id`, `diem_tp_1`, `diem_tp_2`, `diem_thi`, `nop_tien`) VALUES
(2, 1, 1, 5, 5, 6, 1),
(3, 8, 1, NULL, NULL, NULL, 1),
(4, 9, 1, NULL, NULL, NULL, 1),
(5, 11, 1, NULL, NULL, NULL, 1),
(14, 5, 6, NULL, NULL, NULL, NULL),
(15, 5, 7, NULL, NULL, NULL, NULL),
(16, 5, 8, NULL, NULL, NULL, NULL),
(17, 5, 9, NULL, NULL, NULL, NULL),
(18, 5, 10, NULL, NULL, NULL, NULL),
(19, 8, 6, NULL, NULL, NULL, NULL),
(20, 8, 7, NULL, NULL, NULL, NULL),
(21, 8, 8, NULL, NULL, NULL, NULL),
(22, 8, 9, NULL, NULL, NULL, NULL),
(23, 5, 10, NULL, NULL, NULL, NULL),
(24, 10, 6, NULL, NULL, NULL, NULL),
(25, 10, 7, NULL, NULL, NULL, NULL),
(26, 10, 8, NULL, NULL, NULL, NULL),
(27, 10, 9, NULL, NULL, NULL, NULL),
(28, 10, 10, NULL, NULL, NULL, NULL),
(29, 10, 11, NULL, NULL, NULL, NULL),
(30, 9, 6, NULL, NULL, NULL, NULL),
(31, 9, 7, NULL, NULL, NULL, NULL),
(32, 9, 8, NULL, NULL, NULL, NULL),
(33, 9, 9, NULL, NULL, NULL, NULL),
(34, 9, 10, NULL, NULL, NULL, NULL),
(35, 9, 11, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diemrenluyen`
--

CREATE TABLE `diemrenluyen` (
  `id` int(11) NOT NULL,
  `hoc_ky` int(11) NOT NULL,
  `diem_tu_danh_gia` int(11) DEFAULT NULL,
  `diem_gv_danh_gia` int(11) DEFAULT NULL,
  `diem_cong` int(11) DEFAULT NULL,
  `sv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diemrenluyen`
--

INSERT INTO `diemrenluyen` (`id`, `hoc_ky`, `diem_tu_danh_gia`, `diem_gv_danh_gia`, `diem_cong`, `sv_id`) VALUES
(1, 1, 60, 80, 20, 1),
(2, 1, 80, 90, 10, 2),
(3, 1, 90, 80, 13, 3),
(4, 1, 15, 90, 15, 4),
(5, 2, 85, 80, 12, 1),
(6, 3, NULL, NULL, NULL, 1),
(7, 4, NULL, NULL, NULL, 1),
(8, 5, NULL, NULL, NULL, 1),
(9, 6, NULL, NULL, NULL, 1),
(10, 7, NULL, NULL, NULL, 1),
(11, 8, NULL, NULL, NULL, 1),
(38, 1, 0, 0, 0, 6),
(39, 1, 0, 0, 0, 7),
(40, 1, 0, 0, 0, 8),
(48, 1, 0, 0, 0, 9),
(49, 1, 0, 0, 0, 10),
(50, 1, 0, 0, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `id` int(11) NOT NULL,
  `ten_gv` varchar(255) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `isGVCN` tinyint(1) NOT NULL,
  `tk_id` int(11) NOT NULL,
  `lop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`id`, `ten_gv`, `ngay_sinh`, `isGVCN`, `tk_id`, `lop_id`) VALUES
(3, 'gv01', '1992-06-01', 1, 1, 4),
(4, 'gv02', '1992-06-02', 1, 2, 5),
(5, 'gv03', '1992-06-03', 1, 3, 2),
(6, 'gv04', '1992-06-04', 1, 4, 3),
(7, 'gv05', '1992-06-05', 1, 5, 8),
(8, 'gv06', '1992-06-02', 1, 6, 4),
(9, 'gv07', '1992-06-02', 1, 7, 2),
(10, 'gv08', '1992-06-02', 1, 8, 8),
(11, 'gv09', '1992-06-02', 1, 9, 10),
(12, 'gv10', '1992-06-02', 1, 10, 6),
(13, 'gv100', '1990-06-06', 0, 23, 12),
(14, 'gv101', '1990-06-06', 0, 24, 12),
(15, 'gv102', '1990-06-06', 0, 25, 12),
(16, 'gv103', '1990-06-06', 0, 26, 12),
(17, 'gv104', '1990-06-06', 0, 27, 12),
(18, 'gv105', '1990-06-06', 0, 28, 12),
(19, 'gv106', '1990-06-06', 0, 29, 12),
(20, 'gv107', '1990-06-06', 0, 30, 12),
(21, 'gv108', '1990-06-06', 0, 31, 12),
(22, 'gv109', '1990-06-06', 0, 32, 12),
(23, 'gv110', '1990-06-06', 0, 33, 12);

-- --------------------------------------------------------

--
-- Table structure for table `khenthuong`
--

CREATE TABLE `khenthuong` (
  `id` int(11) NOT NULL,
  `ten_khen_thuong` varchar(255) NOT NULL,
  `ghi_chu` varchar(255) NOT NULL,
  `sv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `id` int(11) NOT NULL,
  `ten_khoa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`id`, `ten_khoa`) VALUES
(1, 'Công nghệ thông tin'),
(2, 'Cơ khí'),
(3, 'Ngoại ngữ'),
(4, 'Du lịch'),
(5, 'Kế toán'),
(6, '');

-- --------------------------------------------------------

--
-- Table structure for table `kyluat`
--

CREATE TABLE `kyluat` (
  `id` int(11) NOT NULL,
  `ten_ky_luat` varchar(255) NOT NULL,
  `ghi_chu` varchar(255) NOT NULL,
  `sv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id` int(11) NOT NULL,
  `ten_lop` varchar(255) NOT NULL,
  `si_so` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id`, `ten_lop`, `si_so`, `khoa_id`) VALUES
(2, 'CNTT01', 70, 1),
(3, 'CNTT02', 70, 1),
(4, 'CK01', 60, 2),
(5, 'CK02', 60, 2),
(6, 'NN01', 50, 3),
(7, 'NN02', 50, 3),
(8, 'DL01', 65, 4),
(9, 'DL02', 65, 4),
(10, 'KT01', 70, 5),
(11, 'KT02', 70, 5),
(12, '', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `id` int(11) NOT NULL,
  `ten_mon_hoc` varchar(255) NOT NULL,
  `so_tin` int(11) NOT NULL,
  `hoc_ky` int(11) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `gv_id` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`id`, `ten_mon_hoc`, `so_tin`, `hoc_ky`, `ngay_bat_dau`, `ngay_ket_thuc`, `gv_id`, `khoa_id`) VALUES
(1, 'Kỹ thuật lập trình', 3, 1, '2019-09-01', '2020-02-01', 8, 1),
(2, 'Cơ điện tử', 3, 1, '2019-09-01', '2020-09-01', 9, 2),
(3, 'Triết học', 2, 1, '2019-09-01', '2020-09-01', 10, 4),
(4, 'Xác xuất', 3, 1, '2019-09-01', '2020-09-01', 11, 5),
(5, 'Tiếng anh 1', 5, 1, '2019-09-01', '2021-09-01', 12, 3),
(7, 'Tin học', 3, 1, '2019-09-01', '2020-02-01', 14, 1),
(8, 'Tiếng anh CNTT', 5, 1, '2019-09-01', '2020-09-01', 14, 1),
(9, 'Toán cao cấp', 3, 1, '2019-09-01', '2020-02-01', 14, 1),
(10, 'Kỹ thuật số', 3, 1, '2019-09-01', '2020-09-01', 14, 1),
(11, 'Kỹ năng giao tiếp', 3, 1, '2019-09-01', '2020-02-01', 13, 1),
(12, 'Pháp luật đại cương', 2, 1, '2019-09-01', '2020-09-01', 13, 1),
(13, 'Kinh tế chính trị', 2, 1, '2019-09-01', '2020-09-01', 13, 1),
(14, 'Kỹ thuật cưa', 2, 1, '2019-09-01', '2020-02-01', 15, 2),
(15, 'lập trình C', 3, 1, '2019-09-01', '2020-09-01', 15, 2),
(16, 'Vẽ chi tiết máy', 2, 1, '2019-09-01', '2020-09-01', 15, 2),
(17, 'Kỹ thuật hàn', 3, 1, '2019-09-01', '2020-09-01', 15, 2),
(18, 'Kinh tế chính trị', 2, 1, '2019-09-01', '2020-02-01', 16, 2),
(19, 'Pháp luật đại cương', 2, 1, '2019-09-01', '2020-09-01', 16, 2),
(20, 'Vật lý', 3, 1, '2019-09-01', '2020-09-01', 16, 2),
(21, 'Kỹ năng giao tiếp', 2, 1, '2019-09-01', '2020-09-01', 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `ma_sv` varchar(11) NOT NULL,
  `ten_sv` varchar(255) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `quoc_tich` varchar(255) DEFAULT NULL,
  `dan_toc` varchar(255) DEFAULT NULL,
  `ton_giao` varchar(255) DEFAULT NULL,
  `cccd` varchar(255) DEFAULT NULL,
  `ngay_cap` date DEFAULT NULL,
  `noi_cap` varchar(255) DEFAULT NULL,
  `anh_mat_truoc` text DEFAULT NULL,
  `anh_mat_sau` text DEFAULT NULL,
  `anh_chan_dung` text DEFAULT NULL,
  `sdt` text NOT NULL,
  `email` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tk_id` int(11) NOT NULL,
  `lop_id` int(11) NOT NULL,
  `cong_no` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `ma_sv`, `ten_sv`, `ngay_sinh`, `dia_chi`, `quoc_tich`, `dan_toc`, `ton_giao`, `cccd`, `ngay_cap`, `noi_cap`, `anh_mat_truoc`, `anh_mat_sau`, `anh_chan_dung`, `sdt`, `email`, `create_at`, `tk_id`, `lop_id`, `cong_no`) VALUES
(1, '2019600001', 'Nguyên Văn A', '2001-01-01', 'Hà Nội', 'Việt Nam', 'Kinh', 'Không', '033201004831', '2022-06-16', 'CSS Huyện Khoái Châu', '34_ducanh.png', 'avt.png', '', '012345', 'NguyenA@gmail.com', '2022-06-30 12:12:45', 11, 2, 0),
(2, '2019600002', 'Nguyễn Văn B', '2001-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012345', 'NguyenA@gmail.com', '2022-06-30 10:40:59', 12, 2, 0),
(3, '2019600003', 'Nguyễn Văn C', '2001-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012435', 'NguyenA@gmail.com', '2022-06-30 10:40:59', 13, 4, 0),
(4, '2019600004', 'Nguyễn Thị D', '2001-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012383', 'NguyenA@gmail.com', '2022-06-30 10:40:59', 14, 4, 0),
(5, '2022600005', 'Nguyễn Thị Test', '2001-07-11', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0123456789', 'test@gmail.com', '2022-06-30 03:34:48', 1, 8, 0),
(6, '2019600005', 'Nguyen Duc A', '2001-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01234', 'cdb@gmail.com', '2022-06-30 10:40:59', 15, 2, NULL),
(7, '2019600006', 'Lương Thị Sao M', '2001-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '2022-06-30 10:40:59', 16, 2, NULL),
(8, '2019600007', 'Lê Việt H', '2001-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012378141', 'asfv@gmail.com', '2022-06-30 10:40:59', 17, 2, NULL),
(9, '2019600008', 'Nguyễn Đăng K', '2001-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012341724', 'adbca@gmail.com', '2022-06-30 10:40:59', 18, 2, NULL),
(10, '2019600009', 'Đào Trọng T', '2001-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0124814', 'fgdf@gmail.com', '2022-06-30 10:40:59', 19, 2, NULL),
(11, '2019600010', 'Lê Bình N', '2001-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '02345273', 'fgkd@gmail.com', '2022-06-30 10:39:56', 20, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `tai_khoan` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `tai_khoan`, `mat_khau`, `role`) VALUES
(1, 'gv01', 'admin', 1),
(2, 'gv02', 'admin', 1),
(3, 'gv03', 'admin', 1),
(4, 'gv04', 'admin', 1),
(5, 'gv05', 'admin', 1),
(6, 'gv06', 'admin', 1),
(7, 'gv07', 'admin', 1),
(8, 'gv08', 'admin', 1),
(9, 'gv09', 'admin', 1),
(10, 'gv10', 'admin', 1),
(11, '2019600001', 'admin', 2),
(12, '2019600002', 'admin', 2),
(13, '2019600003', 'admin', 2),
(14, '2019600004', 'admin', 2),
(15, '2019600005', 'admin', 2),
(16, '2019600006', 'admin', 2),
(17, '2019600007', 'admin', 2),
(18, '2019600008', 'admin', 2),
(19, '2019600009', 'admin', 2),
(20, '2019600010', 'admin', 2),
(21, 'admin', 'admin', 0),
(22, '2022600005', '123456', 2),
(23, 'gv100', 'admin', 1),
(24, 'gv101', 'admin', 1),
(25, 'gv102', 'admin', 1),
(26, 'gv103', 'admin', 1),
(27, 'gv104', 'admin', 1),
(28, 'gv105', 'admin', 1),
(29, 'gv106', 'admin', 1),
(30, 'gv107', 'admin', 1),
(31, 'gv108', 'admin', 1),
(32, 'gv109', 'admin', 1),
(33, 'gv110', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chungchi`
--
ALTER TABLE `chungchi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sv_id` (`sv_id`);

--
-- Indexes for table `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_1` (`sv_id`),
  ADD KEY `fk_2` (`mon_id`);

--
-- Indexes for table `diemrenluyen`
--
ALTER TABLE `diemrenluyen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sv_id` (`sv_id`);

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tk_id` (`tk_id`),
  ADD KEY `lop_id` (`lop_id`);

--
-- Indexes for table `khenthuong`
--
ALTER TABLE `khenthuong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sv_id` (`sv_id`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyluat`
--
ALTER TABLE `kyluat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sv_id` (`sv_id`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoa_id` (`khoa_id`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`gv_id`),
  ADD KEY `fk2` (`khoa_id`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tk_id` (`tk_id`),
  ADD KEY `lop_id` (`lop_id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chungchi`
--
ALTER TABLE `chungchi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diem`
--
ALTER TABLE `diem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `diemrenluyen`
--
ALTER TABLE `diemrenluyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `khenthuong`
--
ALTER TABLE `khenthuong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kyluat`
--
ALTER TABLE `kyluat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chungchi`
--
ALTER TABLE `chungchi`
  ADD CONSTRAINT `chungchi_ibfk_1` FOREIGN KEY (`sv_id`) REFERENCES `sinhvien` (`id`);

--
-- Constraints for table `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `f2_2` FOREIGN KEY (`mon_id`) REFERENCES `monhoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`sv_id`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diemrenluyen`
--
ALTER TABLE `diemrenluyen`
  ADD CONSTRAINT `diemrenluyen_ibfk_1` FOREIGN KEY (`sv_id`) REFERENCES `sinhvien` (`id`);

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`tk_id`) REFERENCES `taikhoan` (`id`),
  ADD CONSTRAINT `giaovien_ibfk_2` FOREIGN KEY (`lop_id`) REFERENCES `lop` (`id`);

--
-- Constraints for table `khenthuong`
--
ALTER TABLE `khenthuong`
  ADD CONSTRAINT `khenthuong_ibfk_1` FOREIGN KEY (`sv_id`) REFERENCES `sinhvien` (`id`);

--
-- Constraints for table `kyluat`
--
ALTER TABLE `kyluat`
  ADD CONSTRAINT `kyluat_ibfk_1` FOREIGN KEY (`sv_id`) REFERENCES `sinhvien` (`id`);

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`khoa_id`) REFERENCES `khoa` (`id`);

--
-- Constraints for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`gv_id`) REFERENCES `giaovien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`khoa_id`) REFERENCES `khoa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`tk_id`) REFERENCES `taikhoan` (`id`),
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`lop_id`) REFERENCES `lop` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
