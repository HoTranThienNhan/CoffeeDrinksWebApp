-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 04:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `id` int(10) NOT NULL,
  `ma_san_pham` char(10) NOT NULL,
  `so_luong_san_pham` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `ma_hoa_don` int(11) NOT NULL,
  `id` int(10) NOT NULL,
  `ngay_lap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ma_san_pham` char(10) NOT NULL,
  `so_luong_sp` int(11) NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `khach_hang` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `trang_thai_thanh_toan` varchar(255) NOT NULL,
  `trang_thai_giao_hang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`ma_hoa_don`, `id`, `ngay_lap`, `ma_san_pham`, `so_luong_sp`, `tong_tien`, `khach_hang`, `phone`, `dia_chi`, `trang_thai_thanh_toan`, `trang_thai_giao_hang`) VALUES
(3, 13, '2023-04-16 12:29:16', 'SP01', 1, 59000, 'Nguyễn Ngọc Trâm', '0798067056', 'Phụng Hiệp, Hậu Giang', 'Chưa thanh toán', 'Đang chuẩn bị hàng'),
(0, 14, '2023-04-14 03:10:58', 'SP01', 1, 99000, 'Admin', '0987654321', 'Ninh Kiều, Cần Thơ', 'Chưa thanh toán', 'Đang chuẩn bị hàng'),
(1, 15, '2023-04-15 11:29:29', 'SP01', 2, 54000, 'Hồ Trần Thiện Nhân', '0857585242', 'Mỹ Tú, Sóc Trăng', 'Chưa thanh toán', 'Đang chuẩn bị hàng'),
(3, 13, '2023-04-16 12:29:16', 'SP05', 1, 59000, 'Nguyễn Ngọc Trâm', '0798067056', 'Phụng Hiệp, Hậu Giang', 'Chưa thanh toán', 'Đang chuẩn bị hàng'),
(2, 13, '2023-04-15 13:41:06', 'SP09', 2, 100000, 'Nguyễn Ngọc Trâm', '0798067056', 'Phụng Hiệp, Hậu Giang', 'Chưa thanh toán', 'Đang chuẩn bị hàng');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `ma_loai_san_pham` char(8) NOT NULL,
  `ten_loai_san_pham` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`ma_loai_san_pham`, `ten_loai_san_pham`) VALUES
('C01', 'Cà Phê'),
('C02', 'Trà'),
('C03', 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_san_pham` char(10) NOT NULL,
  `ten_san_pham` varchar(40) NOT NULL,
  `gia_san_pham` int(11) NOT NULL,
  `khuyen_mai` int(8) DEFAULT NULL,
  `gia_khuyen_mai` int(12) NOT NULL,
  `mo_ta_san_pham` text NOT NULL,
  `so_luong` int(11) NOT NULL,
  `hinh_anh` varchar(128) NOT NULL,
  `ma_loai_san_pham` char(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma_san_pham`, `ten_san_pham`, `gia_san_pham`, `khuyen_mai`, `gia_khuyen_mai`, `mo_ta_san_pham`, `so_luong`, `hinh_anh`, `ma_loai_san_pham`, `created_at`) VALUES
('SP01', 'CÀ PHÊ ĐEN', 30000, 10, 27000, 'Dành cho những tín đồ cà phê đích thực! Hương vị cà phê truyền thống được phối trộn độc đáo tại Highlight.', 5, 'phinden.jpg', 'C01', '2023-04-01 01:10:36'),
('SP02', 'TRÀ HẠT SEN', 50000, 10, 45000, 'Thức uống chinh phục những thực khách khó tính! Sự kết hợp độc đáo giữa trà Ô long, hạt sen thơm bùi và củ năng giòn tan. Thêm vào chút sữa sẽ để vị thêm ngọt ngào.', 7, 'trasen.png', 'C02', '2023-04-02 03:00:21'),
('SP03', 'CAPPUCCINO ', 80000, 10, 72000, 'Cappuccino Vị Caramel là sự hòa quyện giữa hương vị cà phê đậm đà và vị caramel thơm ngon độc đáo. Đặc biệt sản phẩm được sản xuất với công nghệ độc quyền của HiCOFFEE giúp đem đến lớp bọt Cappuccino dày mịn; giúp nâng tầm ly cà phê hòa tan ngon chuẩn gu như cà phê pha tại quán.', 20, 'capuchino.png', 'C03', '2023-04-03 03:30:00'),
('SP04', 'COOKIE & CREAM', 55000, 25, 41250, 'Một thức uống ngon lạ miệng bởi sự kết hợp hoàn hảo giữa cookies sô cô la giòn xốp cùng hỗn hợp sữa tươi cùng sữa đặc đem say với đá viên, và cuối cùng không thể thiếu được chính là lớp kem whip mềm mịn cùng cookies sô cô la say nhuyễn.', 19, 'cookiecream.jpg', 'C01', '2023-04-04 11:55:33'),
('SP05', 'CÀ PHÊ SỮA', 40000, 20, 32000, 'Hương vị cà phê Việt Nam đích thực! Từng hạt cà phê hảo hạng được chọn bằng tay, phối trộn độc đáo giữa hạt Robusta từ cao nguyên Việt Nam, thêm Arabica thơm lừng. Cà phê được pha từ Phin truyền thống, hoà cùng sữa đặc sánh và thêm vào chút đá tạo nên ly Phin Sữa Đá – Đậm Đà Chất Phin.', 14, 'cafe.png', 'C01', '2023-04-05 09:31:23'),
('SP06', 'TRÀ THẠCH ĐÀO', 45000, 20, 36000, 'Vị trà đậm đà kết hợp cùng những miếng đào thơm ngon mọng nước cùng thạch đào giòn dai. Thêm vào ít sữa để gia tăng vị béo.', 10, 'tradao.png', 'C02', '2023-04-06 02:55:25'),
('SP07', 'TRÀ XANH ĐẬU ĐỎ', 55000, 0, 55000, 'Một trải nghiệm thú vị khác! Sự hài hòa giữa vị trà cao cấp, vị ngọt bùi của đậu đỏ sẽ mang đến cho bạn một thức uống tuyệt vời.', 5, 'tradaudo.jpg', 'C02', '2023-04-07 04:25:00'),
('SP08', 'MOCHA LATTE', 80000, 5, 76000, 'Với sự quyện vị hài hoà của cà phê chất lượng, sữa thơm béo và sôcôla đen đậm đà, Mocha Latte sẽ mang đến trải nghiệm cà phê thơm ngon đúng điệu.', 12, 'mocha.png', 'C03', '2023-04-08 02:55:33'),
('SP09', 'FREEZE TRÀ XANH', 50000, 0, 50000, 'Thức uống rất được ưa chuộng! Trà xanh thượng hạng từ cao nguyên Việt Nam, kết hợp cùng đá xay, thạch trà dai dai, thơm ngon và một lớp kem dày phủ lên trên vô cùng hấp dẫn. Freeze Trà Xanh thơm ngon, mát lạnh, chinh phục bất cứ ai!', 20, 'freeze.png', 'C01', '2023-04-09 02:55:38'),
('SP10', 'LATTE HẠNH NHÂN', 90000, 0, 90000, 'Latte Sữa Hạt là sự hòa quyện của cà phê Latte sành điệu và sữa hạt sánh mịn, mang đến trải nghiệm cà phê thơm ngon khó cưỡng, nâng tầm ly cà phê hòa tan ngon chuẩn như cà phê pha tại quán.', 20, 'hanhnhan.png', 'C03', '2023-04-10 02:55:42'),
('SP11', 'PHINDI CHOCO', 40000, 5, 38000, 'PhinDi Choco - Cà phê Phin thế hệ mới với chất Phin êm hơn, kết hợp cùng Choco ngọt tan mang đến hương vị mới lạ, không thể hấp dẫn hơn!', 10, 'cacao.jpg', 'C01', '2023-04-11 02:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(13, 'Nguyễn Ngọc Trâm', 'ngoctram@gmail.com', '$2y$10$85JWM9BYOei4RKa2MTfdC.DO/au4psmqytq/n39ct94B/hwBwvI1S', '0798067056', 'Phụng Hiệp, Hậu Giang', '2023-04-07 00:17:12', '2023-04-07 00:17:12'),
(14, 'Admin', 'admin@gmail.com', '$2y$10$kzrF4YKBugOTROW5guDlguYuRfYCot0Hg/3Zsy7bymVThPbFcIHHi', '0987654321', 'Ninh Kiều, Cần Thơ', '2023-04-09 01:32:01', '2023-04-09 01:32:01'),
(15, 'Hồ Trần Thiện Nhân', 'thiennhan@gmail.com', '$2y$10$amSxsVtwj.m3asPbBKB4N.5Kc4yXRvgKzAiXZO0UYBPyUSTTbSf6K', '0857585242', 'Mỹ Tú, Sóc Trăng', '2023-04-11 00:46:44', '2023-04-11 00:46:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`,`ma_san_pham`),
  ADD KEY `id_user` (`id`),
  ADD KEY `giohang_ibfk_2` (`ma_san_pham`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ma_san_pham`,`id`,`ma_hoa_don`),
  ADD KEY `hoadon_ibfk_1` (`id`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`ma_loai_san_pham`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_san_pham`),
  ADD KEY `sanpham_ibfk_1` (`ma_loai_san_pham`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`ma_loai_san_pham`) REFERENCES `loaisanpham` (`ma_loai_san_pham`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
