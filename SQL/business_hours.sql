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
-- 資料表結構 `business_hours`
--

CREATE TABLE `business_hours` (
  `store_id` int(5) NOT NULL,
  `weekdays_open` varchar(6) DEFAULT NULL,
  `weekdays_close` varchar(6) DEFAULT NULL,
  `weekdays` tinyint(1) NOT NULL DEFAULT '0',
  `holiday_open` varchar(6) DEFAULT NULL,
  `holiday_close` varchar(6) DEFAULT NULL,
  `holidays` tinyint(1) NOT NULL DEFAULT '0',
  `vacation_open` tinyint(1) DEFAULT NULL,
  `special_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `business_hours`
--

INSERT INTO `business_hours` (`store_id`, `weekdays_open`, `weekdays_close`, `weekdays`, `holiday_open`, `holiday_close`, `holidays`, `vacation_open`, `special_time`) VALUES
(3, '17:00', '02:00', 1, '00:00', '23:59', 0, 1, ''),
(5, '05:00', '14:00', 0, '00:00', '23:59', 0, 1, '週五只營業到12點');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `business_hours`
--
ALTER TABLE `business_hours`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `store_id` (`store_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
