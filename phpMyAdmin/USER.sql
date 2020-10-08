-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql
-- 生成日時: 2020 年 10 月 08 日 17:06
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `login`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `USER`
--

CREATE TABLE `USER` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'AI',
  `user_name` varchar(64) COLLATE utf8mb4_bin NOT NULL DEFAULT '''''' COMMENT '氏名',
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '''''' COMMENT 'メールアドレス',
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '''''' COMMENT 'パスワード'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `USER`
--

INSERT INTO `USER` (`id`, `user_name`, `email`, `password`) VALUES
(1, 'ccc-test', 'ccc@ccc.com', '$2y$10$SI8x/NBPsHtz68khIQjJB.ivn1LnpdoTouBG2T4v9izZ8CcSmK7u2'),
(2, 'aaa', 'aaa@aaa.com', '$2y$10$E/5xfJ1V8njUVxKUG1.EtuL2TNHhlA0OvGBFIOX5jYjh.bFToIV.a'),
(3, 'XXX', 'XXX@XXX.com', '$2y$10$czWS9i7TriMp3QuBFrfQQ.QH23TvuidPxAv2xGOqyqaph3VJ6wzve');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `USER`
--
ALTER TABLE `USER`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'AI', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
