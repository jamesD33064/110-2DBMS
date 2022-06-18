-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-18 12:15:17
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `fcu`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_epidemic` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`password`, `person_id`, `is_epidemic`, `customer_id`, `email`) VALUES
('12345678', 'D111111111', 1, 1, 'rrreeere666@gmail.com'),
('12345678', 'D222222222', 0, 2, 'rrreeere666@gmail.com'),
('12345678', 'D333333333', 0, 3, 'rrreeere666@gmail.com'),
('12345678', 'D444444444', 1, 4, 'rrreeere666@gmail.com');

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
-- 資料表結構 `epidemicarea_data`
--

CREATE TABLE `epidemicarea_data` (
  `longitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `epidemicArea_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `epidemicarea_data`
--

INSERT INTO `epidemicarea_data` (`longitude`, `latitude`, `disease_id`, `time`, `epidemicArea_id`, `name`) VALUES
('120.6454327', '24.1792646', 1, '2022-05-09 09:43:33', 1, '麥當勞'),
('120.647', '24.1775', 1, '2022-05-25 02:31:50', 2, '逢甲大學'),
('120.640333', '24.167222', 1, '2022-05-25 22:31:50', 3, '秋紅谷'),
('120.66112', '24.178386', 1, '2022-05-25 20:31:50', 4, '中國醫水楠');

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
(2, '2022-05-09 15:12:53', 3, 3),
(2, '2022-05-09 15:27:52', 1, 4),
(2, '2022-05-09 15:27:59', 1, 5),
(2, '2022-05-09 15:27:59', 2, 6),
(2, '2022-05-09 15:28:00', 4, 7),
(2, '2022-05-09 15:28:01', 1, 8),
(2, '2022-05-09 15:28:01', 1, 9),
(2, '2022-05-09 15:28:02', 1, 10),
(2, '2022-05-10 13:36:55', 1, 12),
(2, '2022-05-10 13:37:03', 1, 13),
(2, '2022-06-09 13:37:11', 1, 14),
(2, '2022-05-10 13:37:30', 1, 15),
(1, '2022-05-12 18:08:55', 1, 29),
(2, '2022-05-12 18:12:10', 1, 30),
(4, '2022-05-12 20:10:24', 2, 33),
(2, '2022-05-15 12:32:19', 1, 34),
(4, '2022-05-15 12:32:54', 1, 35),
(2, '2022-05-15 23:04:28', 1, 36),
(4, '2022-06-02 20:10:24', 1, 37),
(2, '2022-06-13 19:36:04', 1, 45),
(2, '2022-06-13 19:37:20', 2, 46);

-- --------------------------------------------------------

--
-- 資料表結構 `place`
--

CREATE TABLE `place` (
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_epidemic` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `place`
--

INSERT INTO `place` (`name`, `account`, `password`, `is_epidemic`, `place_id`, `email`) VALUES
('逢甲大學', 'fcu', '12345678', 1, 1, ''),
('阿姨咖哩', 'regali', '12345678', 1, 2, ''),
('逢甲胖老爹', 'chicken', '12345678', 0, 3, ''),
('smile', 'smile', '12345678', 0, 4, '');

-- --------------------------------------------------------

--
-- 資料表結構 `taiwan_covid19`
--

CREATE TABLE `taiwan_covid19` (
  `time` datetime NOT NULL,
  `diagnosenumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `taiwan_covid19`
--

INSERT INTO `taiwan_covid19` (`time`, `diagnosenumber`) VALUES
('2022-01-01 00:00:00', 21),
('2022-01-02 00:00:00', 20),
('2022-01-03 00:00:00', 25),
('2022-01-04 00:00:00', 34),
('2022-01-05 00:00:00', 26),
('2022-01-06 00:00:00', 43),
('2022-01-07 00:00:00', 62),
('2022-01-08 00:00:00', 44),
('2022-01-09 00:00:00', 60),
('2022-01-10 00:00:00', 32),
('2022-01-11 00:00:00', 70),
('2022-01-12 00:00:00', 96),
('2022-01-13 00:00:00', 65),
('2022-01-14 00:00:00', 68),
('2022-01-15 00:00:00', 78),
('2022-01-16 00:00:00', 51),
('2022-01-17 00:00:00', 65),
('2022-01-18 00:00:00', 66),
('2022-01-19 00:00:00', 54),
('2022-01-20 00:00:00', 37),
('2022-01-21 00:00:00', 68),
('2022-01-22 00:00:00', 130),
('2022-01-23 00:00:00', 89),
('2022-01-24 00:00:00', 51),
('2022-01-25 00:00:00', 38),
('2022-01-26 00:00:00', 92),
('2022-01-27 00:00:00', 64),
('2022-01-28 00:00:00', 71),
('2022-01-29 00:00:00', 48),
('2022-01-30 00:00:00', 54),
('2022-01-31 00:00:00', 55),
('2022-02-01 00:00:00', 60),
('2022-02-02 00:00:00', 53),
('2022-02-03 00:00:00', 56),
('2022-02-04 00:00:00', 71),
('2022-02-05 00:00:00', 72),
('2022-02-06 00:00:00', 43),
('2022-02-07 00:00:00', 49),
('2022-02-08 00:00:00', 48),
('2022-02-09 00:00:00', 54),
('2022-02-10 00:00:00', 83),
('2022-02-11 00:00:00', 79),
('2022-02-12 00:00:00', 60),
('2022-02-13 00:00:00', 52),
('2022-02-14 00:00:00', 54),
('2022-02-15 00:00:00', 45),
('2022-02-16 00:00:00', 67),
('2022-02-17 00:00:00', 68),
('2022-02-18 00:00:00', 67),
('2022-02-19 00:00:00', 73),
('2022-02-20 00:00:00', 73),
('2022-02-21 00:00:00', 49),
('2022-02-22 00:00:00', 44),
('2022-02-23 00:00:00', 56),
('2022-02-24 00:00:00', 80),
('2022-02-25 00:00:00', 68),
('2022-02-26 00:00:00', 69),
('2022-02-27 00:00:00', 60),
('2022-02-28 00:00:00', 56),
('2022-03-01 00:00:00', 44),
('2022-03-02 00:00:00', 49),
('2022-03-03 00:00:00', 71),
('2022-03-04 00:00:00', 64),
('2022-03-05 00:00:00', 80),
('2022-03-06 00:00:00', 43),
('2022-03-07 00:00:00', 29),
('2022-03-08 00:00:00', 53),
('2022-03-09 00:00:00', 77),
('2022-03-10 00:00:00', 0),
('2022-03-11 00:00:00', 82),
('2022-03-12 00:00:00', 62),
('2022-03-13 00:00:00', 63),
('2022-03-14 00:00:00', 75),
('2022-03-15 00:00:00', 39),
('2022-03-16 00:00:00', 90),
('2022-03-17 00:00:00', 91),
('2022-03-18 00:00:00', 75),
('2022-03-19 00:00:00', 126),
('2022-03-20 00:00:00', 121),
('2022-03-21 00:00:00', 98),
('2022-03-22 00:00:00', 89),
('2022-03-23 00:00:00', 97),
('2022-03-24 00:00:00', 139),
('2022-03-25 00:00:00', 136),
('2022-03-26 00:00:00', 103),
('2022-03-27 00:00:00', 203),
('2022-03-28 00:00:00', 127),
('2022-03-29 00:00:00', 96),
('2022-03-30 00:00:00', 163),
('2022-03-31 00:00:00', 239),
('2022-04-01 00:00:00', 236),
('2022-04-02 00:00:00', 404),
('2022-04-03 00:00:00', 280),
('2022-04-04 00:00:00', 275),
('2022-04-05 00:00:00', 281),
('2022-04-06 00:00:00', 359),
('2022-04-07 00:00:00', 531),
('2022-04-08 00:00:00', 507),
('2022-04-09 00:00:00', 578),
('2022-04-10 00:00:00', 575),
('2022-04-11 00:00:00', 630),
('2022-04-12 00:00:00', 663),
('2022-04-13 00:00:00', 933),
('2022-04-14 00:00:00', 982),
('2022-04-15 00:00:00', 1284),
('2022-04-16 00:00:00', 1351),
('2022-04-17 00:00:00', 1303),
('2022-04-18 00:00:00', 1480),
('2022-04-19 00:00:00', 1727),
('2022-04-20 00:00:00', 2481),
('2022-04-21 00:00:00', 3058),
('2022-04-22 00:00:00', 3859),
('2022-04-23 00:00:00', 4204),
('2022-04-24 00:00:00', 5172),
('2022-04-25 00:00:00', 5221),
('2022-04-26 00:00:00', 6339),
('2022-04-27 00:00:00', 8923),
('2022-04-28 00:00:00', 11517),
('2022-04-29 00:00:00', 12313),
('2022-04-30 00:00:00', 15149),
('2022-05-01 00:00:00', 17085),
('2022-05-02 00:00:00', 17858),
('2022-05-03 00:00:00', 23139),
('2022-05-04 00:00:00', 28487),
('2022-05-05 00:00:00', 30106),
('2022-05-06 00:00:00', 36213),
('2022-05-07 00:00:00', 46536),
('2022-05-08 00:00:00', 44361),
('2022-05-09 00:00:00', 40304),
('2022-05-10 00:00:00', 50828),
('2022-05-11 00:00:00', 57216),
('2022-05-12 00:00:00', 65446),
('2022-05-13 00:00:00', 65011),
('2022-05-14 00:00:00', 64041),
('2022-05-15 00:00:00', 68769),
('2022-05-16 00:00:00', 61754),
('2022-05-17 00:00:00', 65833),
('2022-05-18 00:00:00', 85356),
('2022-05-19 00:00:00', 90378),
('2022-05-20 00:00:00', 85761),
('2022-05-21 00:00:00', 84639),
('2022-05-22 00:00:00', 79487),
('2022-05-23 00:00:00', 66283),
('2022-05-24 00:00:00', 82435),
('2022-05-25 00:00:00', 89389),
('2022-05-26 00:00:00', 81907),
('2022-05-27 00:00:00', 94855),
('2022-05-28 00:00:00', 80881),
('2022-05-29 00:00:00', 76605),
('2022-05-30 00:00:00', 60103),
('2022-05-31 00:00:00', 80705),
('2022-06-01 00:00:00', 88293),
('2022-06-02 00:00:00', 76986),
('2022-06-03 00:00:00', 76564),
('2022-06-04 00:00:00', 68151),
('2022-06-05 00:00:00', 62110),
('2022-06-06 00:00:00', 53023),
('2022-06-07 00:00:00', 83027),
('2022-06-08 00:00:00', 80223),
('2022-06-09 00:00:00', 72967),
('2022-06-10 00:00:00', 68347),
('2022-06-11 00:00:00', 79663),
('2022-06-12 00:00:00', 50657),
('2022-06-13 00:00:00', 45110),
('2022-06-14 00:00:00', 66189),
('2022-06-15 00:00:00', 68965),
('2022-06-16 00:00:00', 63221),
('2022-06-17 00:00:00', 55261),
('2022-06-18 00:00:00', 53707);

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
-- 資料表索引 `epidemicarea_data`
--
ALTER TABLE `epidemicarea_data`
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
-- 資料表索引 `taiwan_covid19`
--
ALTER TABLE `taiwan_covid19`
  ADD PRIMARY KEY (`time`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `disease_data`
--
ALTER TABLE `disease_data`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `epidemicarea_data`
--
ALTER TABLE `epidemicarea_data`
  MODIFY `epidemicArea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `footprint_data`
--
ALTER TABLE `footprint_data`
  MODIFY `footprint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `epidemicarea_data`
--
ALTER TABLE `epidemicarea_data`
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
