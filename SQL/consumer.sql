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
-- 資料表結構 `consumer`
--

CREATE TABLE `consumer` (
  `會員編號` int(4) NOT NULL,
  `姓名` varchar(10) NOT NULL,
  `性別` varchar(1) NOT NULL DEFAULT '男',
  `E-mail` varchar(50) NOT NULL,
  `電話號碼` varchar(10) NOT NULL,
  `密碼` varchar(50) NOT NULL,
  `未取餐次數` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `consumer`
--

INSERT INTO `consumer` (`會員編號`, `姓名`, `性別`, `E-mail`, `電話號碼`, `密碼`, `未取餐次數`) VALUES
(2, '測試', '男', 'test@gmail.com', '0912345678', 'asdasdasd', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `consumer`
--
ALTER TABLE `consumer`
  ADD PRIMARY KEY (`會員編號`),
  ADD UNIQUE KEY `E-mail` (`E-mail`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `consumer`
--
ALTER TABLE `consumer`
  MODIFY `會員編號` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
