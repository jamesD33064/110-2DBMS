-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2022 年 05 月 10 日 02:51
-- 伺服器版本： 10.5.12-MariaDB-cll-lve
-- PHP 版本： 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `u558221944_DBMS`
--
CREATE DATABASE IF NOT EXISTS `u558221944_DBMS` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u558221944_DBMS`;

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`password`, `person_id`, `customer_id`) VALUES
('12345678', 'D111111111', 1),
('12345678', 'D222222222', 2),
('12345678', 'D333333333', 3),
('12345678', 'D444444444', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `disease_data`
--

CREATE TABLE `disease_data` (
  `disease_id` int(11) NOT NULL,
  `disease_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `disease_data`
--

INSERT INTO `disease_data` (`disease_id`, `disease_name`) VALUES
(1, 'covid-19');

-- --------------------------------------------------------

--
-- 資料表結構 `epidemicArea_data`
--

CREATE TABLE `epidemicArea_data` (
  `longitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `epidemicArea_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `epidemicArea_data`
--

INSERT INTO `epidemicArea_data` (`longitude`, `latitude`, `disease_id`, `time`, `epidemicArea_id`) VALUES
('123', '20', 1, '2022-05-09 09:43:33', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `footprint_data`
--

CREATE TABLE `footprint_data` (
  `place_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `footprint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `footprint_data`
--

INSERT INTO `footprint_data` (`place_id`, `time`, `customer_id`, `footprint_id`) VALUES
(1, '2022-05-09 09:45:00', 1, 1),
(3, '2022-05-09 12:23:06', 1, 2),
(2, '2022-05-09 15:12:53', 1, 3),
(2, '2022-05-09 15:27:52', 1, 4),
(2, '2022-05-09 15:27:59', 1, 5),
(2, '2022-05-09 15:27:59', 1, 6),
(2, '2022-05-09 15:28:00', 1, 7),
(2, '2022-05-09 15:28:01', 1, 8),
(2, '2022-05-09 15:28:01', 1, 9),
(2, '2022-05-09 15:28:02', 1, 10);

-- --------------------------------------------------------

--
-- 資料表結構 `place`
--

CREATE TABLE `place` (
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_epidemic` int(11) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `place`
--

INSERT INTO `place` (`name`, `account`, `password`, `is_epidemic`, `place_id`) VALUES
('逢甲大學', 'fcu', '12345678', 1, 1),
('阿姨咖哩', 'regali', '12345678', 0, 2),
('逢甲胖老爹', 'chicken', '12345678', 0, 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- 資料表索引 `disease_data`
--
ALTER TABLE `disease_data`
  ADD PRIMARY KEY (`disease_id`);

--
-- 資料表索引 `epidemicArea_data`
--
ALTER TABLE `epidemicArea_data`
  ADD PRIMARY KEY (`epidemicArea_id`),
  ADD KEY `disease_id` (`disease_id`);

--
-- 資料表索引 `footprint_data`
--
ALTER TABLE `footprint_data`
  ADD PRIMARY KEY (`footprint_id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- 資料表索引 `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `disease_data`
--
ALTER TABLE `disease_data`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `epidemicArea_data`
--
ALTER TABLE `epidemicArea_data`
  MODIFY `epidemicArea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `footprint_data`
--
ALTER TABLE `footprint_data`
  MODIFY `footprint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `epidemicArea_data`
--
ALTER TABLE `epidemicArea_data`
  ADD CONSTRAINT `epidemicArea_data_ibfk_1` FOREIGN KEY (`disease_id`) REFERENCES `disease_data` (`disease_id`);

--
-- 資料表的限制式 `footprint_data`
--
ALTER TABLE `footprint_data`
  ADD CONSTRAINT `footprint_data_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`),
  ADD CONSTRAINT `footprint_data_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
