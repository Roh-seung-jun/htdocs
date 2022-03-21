-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-03-21 16:27
-- 서버 버전: 10.4.14-MariaDB
-- PHP 버전: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `test`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `most` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `areas`
--

INSERT INTO `areas` (`id`, `area`, `most`) VALUES
(1, '창원시', '풋고추'),
(2, '진주시', '고추'),
(3, '통영시', '굴'),
(4, '사천시', '멸치'),
(5, '김해시', '단감'),
(6, '밀양시', '대추'),
(7, '거제시', '유자'),
(8, '양산시', '매실'),
(9, '의령군', '수박'),
(10, '함안군', '곶감'),
(11, '창녕군', '양파'),
(12, '고성군', '방울토마토'),
(13, '남해군', '마늘'),
(14, '하동군', '녹차'),
(15, '산청군', '약초'),
(16, '함양군', '밤'),
(17, '거창군', '사과'),
(18, '합천군', '돼지고기');

-- --------------------------------------------------------

--
-- 테이블 구조 `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `cnt` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `events`
--

INSERT INTO `events` (`id`, `name`, `score`, `date`, `cnt`, `phone`) VALUES
(10, '승준', '3', '2022-03-21', 3, '010-3280-1651');

-- --------------------------------------------------------

--
-- 테이블 구조 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `review_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `areas_id` int(11) NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `items`
--

INSERT INTO `items` (`id`, `areas_id`, `item`, `img`) VALUES
(79, 1, '풋고', './public/data/img/1647851869download.jpg'),
(80, 1, '단경', ''),
(81, 1, '수박', ''),
(82, 1, '홍합', ''),
(83, 2, '고추', ''),
(84, 2, '마', ''),
(85, 2, '실크', ''),
(86, 2, '배', ''),
(87, 3, '굴', ''),
(88, 3, '진주', ''),
(89, 3, '나전칠기', ''),
(90, 4, '멸치', ''),
(91, 4, '단감', ''),
(92, 4, '쥐치포', ''),
(93, 4, '옹기', ''),
(94, 5, '단감', ''),
(95, 5, '화훼', ''),
(96, 5, '참외', ''),
(97, 5, '도자기', ''),
(98, 6, '대추', ''),
(99, 6, '깻잎', ''),
(100, 6, '사과', ''),
(101, 6, '풋고추', ''),
(102, 6, '도자기', ''),
(103, 7, '유자', ''),
(104, 7, '죽순', ''),
(105, 7, '알로에', ''),
(106, 7, '한라봉', ''),
(107, 7, '천혜향', ''),
(108, 8, '매실', ''),
(109, 8, '버섯', ''),
(110, 8, '딸기', ''),
(111, 8, '달걀', ''),
(112, 8, '당근', ''),
(113, 9, '수박', ''),
(114, 9, '호박', ''),
(115, 9, '한지', ''),
(116, 9, '버섯', ''),
(117, 10, '곶감', ''),
(118, 10, '수박', ''),
(119, 10, '파프리카', ''),
(120, 10, '연근', ''),
(121, 11, '양파', ''),
(122, 11, '마늘', ''),
(123, 11, '고추', ''),
(124, 11, '단감', ''),
(125, 12, '방울토마토', ''),
(126, 12, '멸치젓', ''),
(127, 12, '대하', ''),
(128, 13, '마늘', ''),
(129, 13, '고사리', ''),
(130, 13, '멸치', ''),
(131, 14, '녹차', ''),
(132, 14, '인삼', ''),
(133, 14, '배', ''),
(134, 14, '작설차', ''),
(135, 15, '약초', ''),
(136, 15, '곶감', ''),
(137, 15, '동충하초', ''),
(138, 15, '누에가루', ''),
(139, 15, '황화씨', ''),
(140, 16, '밤', ''),
(141, 16, '흑돼지', ''),
(142, 16, '포도', ''),
(143, 16, '명주', ''),
(144, 16, '산채', ''),
(145, 16, '농악기', ''),
(146, 17, '사과', ''),
(147, 17, '덩굴차', ''),
(148, 17, '딸기', ''),
(149, 17, '포도', ''),
(150, 18, '돼지', ''),
(151, 18, '작약', ''),
(152, 18, '양파', ''),
(153, 18, '돗자리', ''),
(154, 18, '왕골', ''),
(155, 18, '도자기', ''),
(156, 18, '한과', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2022_03_21_014343_create_events_table', 1),
(4, '2022_03_21_050919_create_items_table', 2),
(5, '2022_03_21_055118_create_areas_table', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase-date` date NOT NULL,
  `contents` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `product`, `shop`, `purchase-date`, `contents`, `score`) VALUES
(1, '1', '1', '1', '2022-03-01', '1', '1'),
(2, '1', '1', '1', '2022-03-01', '1', '1'),
(3, '1', '1', '1', '2022-03-01', '1', '10');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `password`) VALUES
('admin', '1234');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 테이블의 AUTO_INCREMENT `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- 테이블의 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
