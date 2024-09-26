-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 
-- 伺服器版本： 8.0.17
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(5) NOT NULL,
  `identity` varchar(8) NOT NULL COMMENT '身分',
  `account` varchar(20) NOT NULL COMMENT '帳號',
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '密碼',
  `gender` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '顧客性別',
  `name` varchar(10) NOT NULL COMMENT '(負責人)姓名',
  `phoneNumber` varchar(10) NOT NULL COMMENT '(負責人)電話號碼',
  `E-mail` varchar(50) NOT NULL COMMENT '電子信箱',
  `storeName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '店家名稱',
  `storePhoneNumber` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '店家電話',
  `storeAddress` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '店家地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `identity`, `account`, `password`, `gender`, `name`, `phoneNumber`, `E-mail`, `storeName`, `storePhoneNumber`, `storeAddress`) VALUES
(1, 'root', 'root', '$2y$10$Ewv5tPIzc/LCyb7uXYU6puF8M61gjlVC2HjuTns4zZeGfENrVVGJ6', '男', 'root', '123', '123@123.com', NULL, NULL, NULL),
(2, 'consumer', 'a25458417584', '$2y$10$ZjMbIFe/WTennR0LvO8LAOzn17.BIyOlr0ugcoogQVEBGR4oK1elK', '男', '黃俊嘉', '0968795335', 'nht1497@gmail.com', NULL, NULL, NULL),
(3, 'store', 'a123456789', '$2y$10$D0q3DAPkCXQFhaMP488bVObkHDEIpJ6dq5qx5Bgfdp2UvZf4c3/Hy', NULL, '乾你屁事', '0912345678', 'nsfgkjndkfjgn@gmail.com', '測試', '(02)1234-5678', '乾你屁事');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
