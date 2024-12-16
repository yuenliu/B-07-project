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
-- 資料表結構 `food`
--

CREATE TABLE `food` (
  `foodid` int(6) NOT NULL COMMENT '餐點編號',
  `storeid` int(5) NOT NULL COMMENT '店家編號',
  `foodname` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '餐點名稱',
  `foodimage` varchar(100) NOT NULL COMMENT '餐點照片',
  `foodprice` int(4) NOT NULL COMMENT '價格',
  `fooddetail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '餐點介紹',
  `foodprotein` int(5) NOT NULL COMMENT '餐點蛋白質',
  `foodfat` int(5) NOT NULL COMMENT '餐點脂肪',
  `foodcarbs` int(5) NOT NULL COMMENT '餐點碳水化合物',
  `foodcalorie` int(4) NOT NULL COMMENT '卡路里'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `food`
--

INSERT INTO `food` (`foodid`, `storeid`, `foodname`, `foodimage`, `foodprice`, `fooddetail`, `foodprotein`, `foodfat`, `foodcarbs`, `foodcalorie`) VALUES
(1, 13, '滷肉飯', '滷肉飯.jpg', 50, '鮮嫩多汁的滷肉', 50, 40, 45, 740),
(8, 13, '水餃', '水餃.jpg', 90, '使用新鮮的豬肉，現包現吃', 90, 95, 85, 1555),
(10, 12, '大麥克', '大麥克.jpg', 150, ' 紐澳100%雙層純牛肉， 淋上大麥克招牌醬料， 加上生菜、吉事、洋蔥、酸黃瓜， 美味層層堆疊，口感樂趣無窮。', 28, 32, 51, 604),
(11, 12, '麥脆雞', '麥脆雞.jpg', 180, '麥當勞炸雞使用嚴選帶骨雞腿，堅持三道裹粉五道翻滾，表皮酥脆有層次！ 首創先烤後炸工法，高溫鎖住肉汁，給你嫩、脆、爽的好滋味！', 43, 46, 28, 698);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodid`),
  ADD KEY `store.``id``` (`storeid`) USING BTREE;

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food`
--
ALTER TABLE `food`
  MODIFY `foodid` int(6) NOT NULL AUTO_INCREMENT COMMENT '餐點編號', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
