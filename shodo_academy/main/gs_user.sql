-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2022 年 2 月 24 日 16:09
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_user`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_users`
--

CREATE TABLE `gs_users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `image` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_users`
--

INSERT INTO `gs_users` (`id`, `name`, `email`, `password`, `image`) VALUES
(36, 'sasisu', 'sasisu@sasisu.jp', '$2y$10$jTqZxLGSXRwmXkpAzByrQuJG/NTP7fz8/PQGs6vPcxBdSG9PQltku', 0x30),
(37, 'kakiku', 'kakiku@kakiku.jp', '$2y$10$wTwzu0mL/B.l0JzXwmGw2.05rsQlXGqBruNEsN8Jmq3KAhhKMcNva', 0x30),
(38, 'aiu', 'aiu@aiu.jp', '$2y$10$L2fsGIuIsGIFbZFb7Q9DI.1KmhtAdV4LnsgiCnrRBan0bWCye7u76', 0x3137313737323038303536323137613238313434633666332e36393234303638392e6a7067),
(39, 'tatitu', 'tatitu@tatitu.jp', '$2y$10$63Hca5txC8g9ovk.r5okj.u7w2WD6Jdv3P7D/FR6jx6QZ/gSlIvEy', 0x30),
(44, 'あ', 'aaa@aa.aa', '$2y$10$X365XiEbxuyju8xTH.6vJOT8b6HEzzIj4bD/.h45jM9wP6PfmTE0y', 0x37383836363438353236323137616232383963313362372e33383737383734312e6a7067);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_users`
--
ALTER TABLE `gs_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_users`
--
ALTER TABLE `gs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
