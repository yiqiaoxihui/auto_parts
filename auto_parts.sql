-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 年 07 月 21 日 05:24
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `auto_parts`
--

-- --------------------------------------------------------

--
-- 表的结构 `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `institute` int(2) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `firm` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1298 ;

--
-- 转存表中的数据 `items`
--

INSERT INTO `items` (`id`, `name`, `type`, `institute`, `price`, `place`, `firm`, `create_time`, `remarks`) VALUES
(1285, '刹车片', 'TYH666', 0, 100, '江苏', '江苏金牌汽配厂', '2019-07-19 04:59:12', '无'),
(1288, '前保险杠', 'FG00001', 0, 300, '山东', '安阳汽修厂', '2019-07-20 17:11:00', '高质量'),
(1289, '变速箱', 'KK00113', 0, 3000, '北京', '金华配件', '2019-07-20 20:39:24', '无'),
(1290, '变速箱升级版', 'KK001133', 0, 3000, '北京', '金华配件', '2019-07-20 20:40:21', '无'),
(1291, '仪表盘', 'GHJ654', 0, 300, '北京', '万达汽配', '2019-07-20 20:42:45', '无');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
