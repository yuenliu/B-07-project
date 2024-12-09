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
-- 資料表結構 `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(5) NOT NULL COMMENT '訂單編號',
  `member_id` int(5) NOT NULL COMMENT '下單使用者編號',
  `store_id` int(5) NOT NULL COMMENT '處理店家ID',
  `food_id` int(5) NOT NULL COMMENT '下單餐點編號',
  `quantity` int(2) NOT NULL COMMENT '數量',
  `remark` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '備註',
  `day` date NOT NULL COMMENT '下單日期',
  `time` time NOT NULL COMMENT '下單時間',
  `order_state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `food_order`
--

INSERT INTO `food_order` (`order_id`, `member_id`, `store_id`, `food_id`, `quantity`, `remark`, `day`, `time`, `order_state`) VALUES
(4, 2, 5, 1, 3, '', '2024-12-09', '19:28:19', 0),
(5, 2, 5, 4, 3, '', '2024-12-09', '19:28:19', 0),
(6, 2, 12, 3, 1, '', '2024-12-09', '19:35:38', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`order_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food_order`
--
ALTER TABLE `food_order`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
