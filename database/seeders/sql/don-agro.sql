-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2024 at 11:58 AM
-- Server version: 10.3.29-MariaDB-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `don_agro`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `AKT`
--

CREATE TABLE `AKT` (
  `id` int(11) NOT NULL,
  `test_program_id` int(11) NOT NULL,
  `akt_date` date DEFAULT NULL,
  `out_check` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_goal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `simple_size` int(11) DEFAULT NULL,
  `lab_size` int(11) DEFAULT NULL,
  `measure_type` int(11) DEFAULT NULL,
  `party_number` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `AKT`
--

INSERT INTO `AKT` (`id`, `test_program_id`, `akt_date`, `out_check`, `marker`, `use_goal`, `customer`, `employee`, `make_date`, `expiry_date`, `simple_size`, `lab_size`, `measure_type`, `party_number`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-01-05', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2021 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Пулатов Ш.', 'Egamqulov M.', '2021-06-01', NULL, 24, NULL, 2, 12, NULL, 25, '2024-01-30 13:07:49', '2024-01-30 13:07:49'),
(2, 2, '2024-01-05', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi nav omborda 25,50 kg lik qoplarda qadoqlangan', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev T.', 'Alimov A.', '2024-01-05', '2027-01-06', 2, NULL, 2, 1, NULL, 25, '2024-01-30 15:58:06', '2024-01-30 15:58:06'),
(3, 4, '2024-01-05', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2023 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Mamadaliev A.', 'Soatov S.', '2023-06-01', NULL, 28, NULL, 2, 14, NULL, 1, '2024-01-30 16:46:29', '2024-01-30 16:46:29'),
(4, 5, '2024-01-05', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B.', '2022-06-01', NULL, 70, NULL, 2, 35, NULL, 1, '2024-01-30 17:02:39', '2024-01-30 17:02:39'),
(5, 6, '2024-01-08', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2021 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Akbarov K.', 'Avilov B.', '2021-06-01', NULL, 88, NULL, 2, 44, NULL, 25, '2024-01-30 17:19:29', '2024-01-30 17:19:29'),
(6, 7, '2024-01-08', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Akbarov K.', 'Avilov B.', '2022-06-01', NULL, 120, NULL, 2, 60, NULL, 25, '2024-01-30 17:29:41', '2024-01-30 17:29:41'),
(7, 8, '2024-01-09', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Aparnikova T.', '2023-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-01-30 17:54:57', '2024-01-30 17:54:57'),
(8, 9, '2024-01-11', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Aparnikova T.', '2023-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-01-30 18:06:45', '2024-01-30 18:06:45'),
(9, 10, '2024-01-11', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Karimov X.', 'Avilov B.', '2022-06-01', NULL, 34, NULL, 2, 17, NULL, 25, '2024-01-31 09:57:44', '2024-01-31 09:57:44'),
(10, 11, '2024-01-11', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Ergashev E.', 'Avilov B.', '2022-06-01', NULL, 32, NULL, 2, 16, NULL, 25, '2024-01-31 10:25:40', '2024-01-31 10:25:40'),
(11, 12, '2024-01-11', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2022-06-01', NULL, 100, NULL, 2, 50, NULL, 25, '2024-01-31 10:50:10', '2024-01-31 10:50:10'),
(12, 13, '2024-01-11', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2022-06-01', NULL, 14, NULL, 2, 7, NULL, 25, '2024-01-31 11:08:50', '2024-01-31 11:08:50'),
(13, 14, '2024-01-22', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2022 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Ruziboyev U.', 'Jomurodov S.', '2022-06-01', NULL, 182, NULL, 2, 91, NULL, 25, '2024-01-31 11:20:06', '2024-01-31 11:20:06'),
(14, 15, '2024-01-24', 'Buzilish topilmadi. Bug\'doy uni vitamin va mineral aralashmasi bilan boyitilgan birinchi nav omborda 25,50 kg qadoqlangan qoplarda saqlanmoqda', NULL, 'Oziq-ovqat maqsadlarida', 'Ruziev N.', 'Aparnikova T.', '2024-01-24', '2027-01-25', 2, NULL, 2, 1, NULL, 25, '2024-01-31 11:52:33', '2024-01-31 11:52:33'),
(15, 16, '2023-01-05', 'Нарушение не обнаружено. Пшеница поступила насыпью', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Aparnikova T.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 11:26:55', '2024-02-07 11:26:55'),
(16, 17, '2023-01-05', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Sunnatov M.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 11:42:29', '2024-02-07 11:42:29'),
(17, 18, '2023-01-05', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Sunnatov M.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 11:50:07', '2024-02-07 11:50:07'),
(18, 19, '2023-01-09', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Muminov Sh.', 'Sunnatov M.', '2023-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 12:09:14', '2024-02-07 12:09:14'),
(19, 20, '2023-01-10', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Muminov Sh.', 'Sunnatov M.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 12:19:06', '2024-02-07 12:19:06'),
(20, 21, '2023-01-11', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Sunnatov M.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 12:24:49', '2024-02-07 12:24:49'),
(21, 22, '2023-01-11', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Sunnatov M.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 12:29:47', '2024-02-07 12:29:47'),
(22, 23, '2023-01-17', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ruzmetov A.', 'Kalmuratov T.', '2022-11-01', NULL, 34, NULL, 2, 17, NULL, 25, '2024-02-07 12:50:04', '2024-02-07 13:01:42'),
(23, 24, '2023-01-17', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Praliev K.', 'Kalmuratov T.', '2022-11-01', NULL, 156, NULL, 2, 78, NULL, 25, '2024-02-07 13:54:02', '2024-02-07 13:54:02'),
(24, 25, '2023-01-17', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Kadirov K.', 'Kalmuratov T.', '2022-11-01', NULL, 56, NULL, 2, 28, NULL, 25, '2024-02-07 14:07:07', '2024-02-07 14:07:07'),
(25, 26, '2023-01-17', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Sunnatov M.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 14:14:02', '2024-02-07 14:14:02'),
(26, 27, '2023-01-20', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ruzmetov A.', 'Kalmuratov T.', '2022-12-08', '2024-01-23', 21, NULL, 2, 14, NULL, 25, '2024-02-07 14:42:03', '2024-02-07 14:42:03'),
(27, 28, '2023-01-20', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Sunnbatov M.', '2022-11-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-07 14:48:20', '2024-02-07 14:48:20'),
(28, 29, '2023-01-23', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Esemuratov B.', 'Mambetniyazov T.', '2022-11-01', NULL, 42, NULL, 2, 21, NULL, 25, '2024-02-07 14:57:39', '2024-02-07 14:57:39'),
(29, 30, '2023-01-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Yuldashev R.', 'Kalmuratov T.', '2022-11-01', NULL, 66, NULL, 2, 33, NULL, 25, '2024-02-07 15:07:15', '2024-02-07 15:07:15'),
(30, 31, '2023-01-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Yuldashev R.', 'Kalmuratov T.', '2022-12-29', '2023-12-29', 36, NULL, 2, 18, NULL, 25, '2024-02-07 15:14:18', '2024-02-07 15:14:18'),
(31, 32, '2023-01-25', 'Buzilish topilmadi. Bug\'doy uni-eng oliyi nav, vitamin va mineral aralashmasi bilan boyitilgan 50 kg omborda qoplarda saqlanmoqda', NULL, 'Oziq-ovqat maqsadlarida', 'Axmedov B.', 'Alimov A.', '2023-01-25', '2026-01-25', 2, NULL, 2, 1, NULL, 25, '2024-02-07 15:40:27', '2024-02-07 15:40:27'),
(32, 33, '2023-01-25', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi nav omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Hasanov X.', 'Alimov A.', '2023-01-25', '2026-01-25', 2, NULL, 2, 1, NULL, 25, '2024-02-08 11:17:04', '2024-02-08 11:17:04'),
(33, 34, '2023-01-30', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Sapaev S.', 'Taxirov S.', '2022-11-01', NULL, 40, NULL, 2, 20, NULL, 25, '2024-02-08 11:27:15', '2024-02-08 11:27:15'),
(34, 35, '2023-02-08', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi navli omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Shomurodov Q.', 'Sunnatov M.', '2023-02-08', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-08 13:24:27', '2024-02-08 13:24:27'),
(35, 36, '2023-02-10', 'Buzilish topilmadi.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Sapaev S.', 'Taxirov S.', '2023-02-05', '2024-02-09', 27, NULL, 2, 18, NULL, 25, '2024-02-08 13:32:35', '2024-02-08 13:32:35'),
(36, 37, '2023-02-17', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi navli omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Yuldashev M.', 'Sunnatov S.', '2023-02-17', '2026-03-06', 2, NULL, 2, 1, NULL, 25, '2024-02-08 13:42:06', '2024-02-08 13:42:06'),
(37, 38, '2023-02-21', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi navli omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Ruziboyev U.', 'Sunnatov M.', '2023-02-21', '2026-02-22', 2, NULL, 2, 1, NULL, 25, '2024-02-08 13:47:23', '2024-02-08 13:47:23'),
(38, 39, '2023-02-22', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi navli omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Murodullaev F.', 'Sunnatov M.', '2023-02-22', '2026-02-23', 2, NULL, 2, 1, NULL, 25, '2024-02-08 13:56:10', '2024-02-08 13:56:10'),
(39, 40, '2023-02-28', 'Buzilish topilmadi. Bug\'doy_ yumshoq, oziq-ovqat uchun mo\'ljallangan, 2021 yil hosili omborda to\'plangan', NULL, 'Oziq-ovqat maqsadlarida', 'Ruzmatov A.', 'Ganiev A.', '2021-06-01', NULL, 92, NULL, 2, 46, NULL, 25, '2024-02-08 14:04:41', '2024-02-08 14:04:41'),
(40, 41, '2023-03-25', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi navli omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Mamayusupov M.', 'Alimov A.', '2023-03-26', '2026-04-03', 2, NULL, 2, 1, NULL, 25, '2024-02-08 14:50:51', '2024-02-08 14:50:51'),
(41, 42, '2023-05-04', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi navli omborda 25,50 kg qoplarda saqlanmoqda.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Sapaev M.', 'Alimov A.', '2023-05-02', '2026-05-10', 2, NULL, 2, 1, NULL, 25, '2024-02-08 15:10:18', '2024-02-08 15:10:18'),
(42, 43, '2023-05-26', 'Buzilish topilmadi.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Narimonov N.', 'Alimov A.', '2022-12-22', '2024-03-22', 2, NULL, 2, 1, NULL, 25, '2024-02-08 15:35:54', '2024-02-08 15:35:54'),
(43, 44, '2023-05-29', 'Buzilish topilmadi.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Narimonov N.', 'Alimov A.', '2022-11-02', '2024-02-22', 2, NULL, 2, 1, NULL, 25, '2024-02-08 15:51:13', '2024-02-08 15:51:13'),
(44, 45, '2023-06-01', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Turdialiev A.', 'Mamayusupov A.', '2023-06-01', NULL, 20, NULL, 2, 10, NULL, 25, '2024-02-08 15:59:37', '2024-02-08 15:59:37'),
(45, 46, '2023-06-14', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Muminov Sh.', 'Alimov A.', '2022-11-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-09 10:50:38', '2024-02-09 10:50:38'),
(46, 47, '2023-06-14', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xusanov A.', 'Mamayusupov A.', '2023-06-01', NULL, 48, NULL, 2, 24, NULL, 25, '2024-02-09 11:03:30', '2024-02-09 11:03:30'),
(47, 48, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2023-06-01', NULL, 6, NULL, 2, 3, NULL, 25, '2024-02-09 12:03:42', '2024-02-09 12:03:42'),
(48, 49, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2023-06-01', NULL, 38, NULL, 2, 19, NULL, 25, '2024-02-09 12:12:47', '2024-02-09 12:12:47'),
(49, 50, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2023-06-01', NULL, 20, NULL, 2, 10, NULL, 25, '2024-02-09 12:16:58', '2024-02-09 12:16:58'),
(50, 51, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2023-06-01', NULL, 48, NULL, 2, 24, NULL, 25, '2024-02-09 12:21:38', '2024-02-09 12:21:38'),
(51, 52, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2023-06-01', NULL, 32, NULL, 2, 16, NULL, 25, '2024-02-09 12:25:28', '2024-02-09 12:25:28'),
(52, 53, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B.', '2023-06-01', NULL, 40, NULL, 2, 20, NULL, 25, '2024-02-09 12:29:10', '2024-02-09 12:29:10'),
(53, 54, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ergashev E.', 'Avilov B.', '2023-06-01', NULL, 40, NULL, 2, 20, NULL, 25, '2024-02-09 14:35:37', '2024-02-09 14:35:37'),
(54, 55, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ergashev E.', 'Avilov B.', '2023-06-01', NULL, 60, NULL, 2, 30, NULL, 25, '2024-02-09 15:27:41', '2024-02-09 15:27:41'),
(55, 56, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B.', '2023-06-01', NULL, 30, NULL, 2, 15, NULL, 25, '2024-02-09 16:23:27', '2024-02-09 16:23:27'),
(56, 57, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B.', '2023-06-01', NULL, 26, NULL, 2, 13, NULL, 25, '2024-02-09 16:30:16', '2024-02-09 16:30:16'),
(57, 58, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B', '2023-06-01', NULL, 16, NULL, 2, 8, NULL, 25, '2024-02-09 16:36:21', '2024-02-09 16:36:21'),
(58, 59, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B', '2023-06-01', NULL, 10, NULL, 2, 5, NULL, 25, '2024-02-09 16:46:10', '2024-02-09 16:46:10'),
(59, 60, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Karimov X.', 'Avilov B.', '2023-06-01', NULL, 86, NULL, 1, 43, NULL, 25, '2024-02-09 16:53:40', '2024-02-09 16:53:40'),
(60, 61, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Akbarov K.', 'Avilov B.', '2023-06-01', NULL, 216, NULL, 2, 108, NULL, 25, '2024-02-09 23:33:12', '2024-02-10 15:18:17'),
(61, 62, '2023-06-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мухамадов Ж.', 'XONIMQULOV Z.', '2023-06-01', NULL, 160, NULL, 2, 80, NULL, 25, '2024-02-10 15:33:04', '2024-02-10 15:33:04'),
(62, 63, '2023-07-03', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Иброхимов И.', 'Odilova U.', '2023-06-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-10 15:40:20', '2024-02-10 15:40:20'),
(63, 64, '2023-07-03', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ravshanov U.', 'Avilov B', '2023-06-01', NULL, 76, NULL, 2, 38, NULL, 25, '2024-02-10 15:46:26', '2024-02-10 15:47:39'),
(64, 65, '2023-07-03', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Жавлиев У.', 'Avilov B.', '2023-06-01', NULL, 68, NULL, 2, 34, NULL, 25, '2024-02-10 15:57:49', '2024-02-10 15:57:49'),
(65, 66, '2023-07-03', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Akbarov K.', 'Avilov B', '2023-06-01', NULL, 132, NULL, 2, 66, NULL, 25, '2024-02-10 16:05:00', '2024-02-10 16:05:00'),
(66, 67, '2023-07-03', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Эргашев А.', 'Avilov B.', '2023-06-01', NULL, 44, NULL, 2, 22, NULL, 25, '2024-02-10 16:12:12', '2024-02-10 16:12:12'),
(67, 68, '2023-07-04', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B.', '2023-06-01', NULL, 18, NULL, 2, 9, NULL, 25, '2024-02-10 16:17:54', '2024-02-10 16:17:54'),
(68, 69, '2023-07-04', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Усмонов А.', 'Ganiev A.', '2023-06-01', NULL, 436, NULL, 2, 218, NULL, 25, '2024-02-10 16:32:42', '2024-02-10 16:32:42'),
(69, 70, '2023-07-04', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Абдуллаев М.', 'Avilov B', '2023-06-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-10 16:38:13', '2024-02-10 16:38:13'),
(70, 71, '2023-07-06', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Turdialiev A.', 'Mamayusupov A.', '2023-06-01', NULL, 114, NULL, 2, 57, NULL, 25, '2024-02-10 16:44:06', '2024-02-10 16:44:06'),
(71, 72, '2023-07-06', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ештаев Т.', 'Umirzoqov Sh.', '2023-06-01', NULL, 6, NULL, 2, 3, NULL, 25, '2024-02-10 16:50:16', '2024-02-10 16:50:16'),
(72, 73, '2023-07-06', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ходжаев А.', 'Ganiev A.', '2023-06-01', NULL, 108, NULL, 2, 54, NULL, 25, '2024-02-10 16:59:05', '2024-02-10 16:59:05'),
(73, 74, '2023-07-07', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Турдалиев А.', 'Mamayusupov A.', '2023-06-01', NULL, 56, NULL, 2, 28, NULL, 25, '2024-02-10 17:19:26', '2024-02-10 17:19:26'),
(74, 75, '2023-07-07', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Астанакулов С.', 'Mamayusupov A', '2023-06-01', NULL, 190, NULL, 2, 95, NULL, 25, '2024-02-10 17:28:15', '2024-02-10 17:28:15'),
(75, 76, '2023-07-07', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi nav omborda 25,50 kg qoplarda saqlanmoqda', NULL, 'Oziq-ovqat maqsadlarida', 'Олимов Д.', 'Alimov A.', '2023-07-10', '2026-07-11', 2, NULL, 2, 1, NULL, 25, '2024-02-10 17:35:16', '2024-02-10 17:35:16'),
(76, 77, '2023-07-10', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Хайдаров Н.', 'Umirzoqov Sh.', '2023-06-01', NULL, 30, NULL, 2, 15, NULL, 25, '2024-02-10 17:41:08', '2024-02-10 17:41:08'),
(77, 78, '2023-07-10', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Кодиров А.', 'Sunnatov M.', '2023-06-01', NULL, 176, NULL, 2, 88, NULL, 25, '2024-02-12 09:35:46', '2024-02-12 09:35:46'),
(78, 79, '2023-07-10', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Рейна Д.', 'Avilov B', '2023-06-01', NULL, 58, NULL, 2, 29, NULL, 25, '2024-02-12 09:44:12', '2024-02-12 09:44:12'),
(79, 80, '2023-07-10', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Рейна Д.', 'Umirzoqov Sh.', '2023-06-01', NULL, 120, NULL, 2, 60, NULL, 25, '2024-02-12 10:14:09', '2024-02-12 10:14:09'),
(80, 81, '2023-07-10', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Рейна Д.', 'Batalova Z', '2023-06-01', NULL, 54, NULL, 2, 27, NULL, 25, '2024-02-12 10:28:29', '2024-02-12 10:28:29'),
(81, 82, '2023-07-11', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мухамадов Ж.', 'Xonimqulov Z.', '2023-06-01', NULL, 74, NULL, 2, 37, NULL, 25, '2024-02-12 10:50:00', '2024-02-12 10:50:00'),
(82, 83, '2023-07-11', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Косимов Б.', 'Sunnatov M.', '2023-06-01', NULL, 484, NULL, 2, 242, NULL, 25, '2024-02-12 11:03:45', '2024-02-12 11:03:45'),
(83, 84, '2023-07-12', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Абдурахмонов Д.', 'Umirzoqov Sh', '2023-06-01', NULL, 16, NULL, 2, 8, NULL, 25, '2024-02-12 11:12:03', '2024-02-12 11:12:03'),
(84, 85, '2023-07-12', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Рашидов А.', 'Juraev F.', '2023-06-01', NULL, 30, NULL, 2, 15, NULL, 25, '2024-02-12 11:24:28', '2024-02-12 11:24:28'),
(85, 86, '2023-07-13', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мирзаев Ш.', 'Jomurodov S.', '2023-06-01', NULL, 62, NULL, 2, 31, NULL, 25, '2024-02-12 11:46:27', '2024-02-12 11:46:27'),
(86, 87, '2023-07-13', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ходжаев Э.', 'Mamayusupov A.', '2023-06-01', NULL, 186, NULL, 2, 93, NULL, 25, '2024-02-12 11:58:47', '2024-02-12 11:58:47'),
(87, 88, '2023-07-14', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Эшонхонов К.', 'Batalova Z.', '2023-06-01', NULL, 16, NULL, 2, 8, NULL, 25, '2024-02-12 12:06:31', '2024-02-12 12:06:31'),
(88, 89, '2023-07-18', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev T.', 'Jomurodov S.', '2023-06-01', NULL, 64, NULL, 2, 32, NULL, 25, '2024-02-12 12:19:12', '2024-02-12 12:19:12'),
(89, 90, '2023-07-18', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Раззаков Х.', 'Jomurodov S.', '2023-06-01', NULL, 82, NULL, 2, 41, NULL, 25, '2024-02-12 12:47:18', '2024-02-12 12:47:18'),
(90, 91, '2023-07-18', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мирзаев Ш.', 'Jomurodov S.', '2023-06-01', NULL, 4, NULL, 2, 2, NULL, 25, '2024-02-12 12:55:26', '2024-02-12 12:55:26'),
(91, 92, '2023-07-18', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Косимов Б.', 'Sunnatov M.', '2023-06-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-12 13:02:01', '2024-02-12 13:02:01'),
(92, 93, '2023-07-19', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Давлетов Д.', 'Taxirov S.', '2023-06-01', NULL, 92, NULL, 2, 46, NULL, 25, '2024-02-12 13:10:03', '2024-02-12 13:10:03'),
(93, 94, '2023-07-19', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Юсупов М.', 'Umirzoqov Sh.', '2023-07-19', '2023-07-20', 14, NULL, 2, 7, NULL, 25, '2024-02-12 13:16:19', '2024-02-12 13:16:19'),
(94, 95, '2023-07-20', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Пулатов Ш.', 'Jomurodov S.', '2023-06-01', NULL, 164, NULL, 2, 82, NULL, 25, '2024-02-12 13:22:34', '2024-02-12 13:22:34'),
(95, 96, '2023-07-20', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Эргашев К.', 'Batalova Z.', '2023-06-01', NULL, 4, NULL, 2, 2, NULL, 25, '2024-02-12 13:27:14', '2024-02-12 13:27:14'),
(96, 97, '2023-07-21', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Касимов Б.', 'Sunnatov M.', '2023-06-01', NULL, 202, NULL, 2, 101, NULL, 25, '2024-02-12 13:37:58', '2024-02-12 13:37:58'),
(97, 98, '2023-07-21', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Касимов Б.', 'Sunnatov M.', '2023-06-01', NULL, 196, NULL, 2, 98, NULL, 25, '2024-02-12 13:48:51', '2024-02-12 13:48:51'),
(98, 99, '2023-07-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Солиев Ш.', 'Xonimqulov Z.', '2023-06-01', NULL, 128, NULL, 2, 64, NULL, 25, '2024-02-12 14:20:12', '2024-02-12 14:20:12'),
(99, 100, '2023-07-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Солиев Ш.', 'Xonimqulov Z.', '2023-06-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-12 14:24:23', '2024-02-12 14:24:23'),
(100, 101, '2023-07-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мирзаев С.', 'Xonimqulov Z.', '2023-06-01', NULL, 98, NULL, 2, 49, NULL, 25, '2024-02-12 14:31:07', '2024-02-12 14:31:07'),
(101, 102, '2023-07-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мирзаев С.', 'Xonimqulov Z.', '2023-06-01', NULL, 2, NULL, 1, 1, NULL, 25, '2024-02-12 14:35:22', '2024-02-12 14:35:22'),
(102, 103, '2023-07-24', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Гаффаров Х.', 'Taxirov S.', '2023-06-01', NULL, 80, NULL, 2, 40, NULL, 25, '2024-02-12 14:57:00', '2024-02-12 14:57:00'),
(103, 104, '2023-07-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Shomurodov Q.', 'Jomurodov S.', '2023-06-01', NULL, 40, NULL, 2, 20, NULL, 25, '2024-02-12 15:01:07', '2024-02-12 15:01:07'),
(104, 105, '2023-07-27', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Султонов Ф.', 'Batalova Z.', '2023-06-01', NULL, 334, NULL, 2, 167, NULL, 25, '2024-02-12 15:12:32', '2024-02-12 15:12:32'),
(105, 106, '2023-07-27', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ruziboyev U.', 'Jomurodov S.', '2023-06-01', NULL, 218, NULL, 2, 109, NULL, 25, '2024-02-13 13:29:31', '2024-02-13 13:29:31'),
(106, 107, '2023-08-01', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Хужаев И.К.', 'Axmedov U.', '2023-06-01', NULL, 76, NULL, 2, 38, NULL, 25, '2024-02-13 13:41:03', '2024-02-13 13:41:03'),
(107, 108, '2023-08-01', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Хужаев И.К.', 'Axmedov U.', '2023-06-01', NULL, 20, NULL, 2, 10, NULL, 25, '2024-02-13 13:47:37', '2024-02-13 13:47:37'),
(108, 109, '2023-08-01', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Shomurodov Q.', 'Jomurodov S.', '2023-06-01', NULL, 136, NULL, 2, 68, NULL, 25, '2024-02-13 14:00:59', '2024-02-13 14:00:59'),
(109, 110, '2023-08-01', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Кодиров Ж.', 'Batalova Z.', '2023-08-01', NULL, 122, NULL, 2, 61, NULL, 25, '2024-02-13 14:23:24', '2024-02-13 14:23:24'),
(110, 111, '2023-08-04', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Абдуллаев Р.', 'Taxirov S.', '2023-06-01', NULL, 80, NULL, 2, 40, NULL, 25, '2024-02-13 15:09:31', '2024-02-13 15:09:31'),
(111, 112, '2023-08-04', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ходжаев А.', 'Ganiev A.', '2023-06-01', NULL, 96, NULL, 2, 48, NULL, 25, '2024-02-13 15:17:42', '2024-02-13 15:17:42'),
(112, 113, '2023-08-07', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Axmedov B.', 'Tojimamatov A.', '2023-06-01', NULL, 302, NULL, 2, 151, NULL, 25, '2024-02-13 15:25:17', '2024-02-13 15:25:17'),
(113, 114, '2023-08-08', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Бойкузиев Д.', 'Umirzoqov Sh.', '2023-06-01', NULL, 6, NULL, 2, 3, NULL, 25, '2024-02-13 17:27:01', '2024-02-13 17:27:01'),
(114, 115, '2023-08-08', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Урокова М.', 'Jomurodov S', '2023-06-01', NULL, 8, NULL, 2, 4, NULL, 25, '2024-02-13 17:39:21', '2024-02-13 17:39:21'),
(115, 116, '2023-08-08', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Турахонов Ж.', 'Mamayusupov A.', '2023-06-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-13 17:47:52', '2024-02-13 17:47:52'),
(116, 117, '2023-08-08', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Турахонов Ж.', 'Mamayusupov A.', '2023-06-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-13 18:03:03', '2024-02-13 18:03:03'),
(117, 118, '2023-08-09', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Рейна Д.', 'Avilov B.', '2023-06-01', NULL, 22, NULL, 2, 11, NULL, 25, '2024-02-15 13:33:11', '2024-02-15 13:33:11'),
(118, 119, '2024-02-09', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Alimov A.', '2023-11-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-15 16:49:19', '2024-02-15 16:49:19'),
(119, 120, '2024-02-09', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Alimov A.', '2023-11-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-15 16:56:24', '2024-02-15 16:56:24'),
(120, 121, '2024-02-15', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Alimov A.', '2023-11-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-16 11:25:45', '2024-02-16 11:25:45'),
(121, 122, '2023-08-09', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Мамажалилов Ш.', 'Tojimamatov A.', '2023-06-01', NULL, 212, NULL, 2, 106, NULL, 25, '2024-02-19 13:19:43', '2024-02-19 13:19:43'),
(122, 123, '2023-08-11', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Комилов Ш.', 'Umirzoqov Sh.', '2023-06-01', NULL, 20, NULL, 2, 10, NULL, 25, '2024-02-19 13:29:03', '2024-02-19 13:29:03'),
(123, 124, '2023-08-11', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi nav omborda 25,50 kg qoplarda saqlanmoqda', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Кодиров А.', 'Alimov A.', '2023-08-11', '2026-08-16', 2, NULL, 2, 1, NULL, 25, '2024-02-19 13:38:47', '2024-02-19 13:38:47'),
(124, 125, '2023-08-15', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ruzmatov A.', 'Ganiev A.', '2023-06-01', NULL, 258, NULL, 2, 129, NULL, 25, '2024-02-19 13:48:52', '2024-02-19 13:48:52'),
(125, 126, '2023-08-16', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Одилов О.И.', 'Samieva S.', '2023-06-01', NULL, 20, NULL, 2, 10, NULL, 25, '2024-02-19 13:57:09', '2024-02-19 13:57:09'),
(126, 127, '2023-08-22', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Ruzmetov A.', 'Kemalov B.', '2023-06-01', NULL, 52, NULL, 2, 26, NULL, 25, '2024-02-21 11:25:33', '2024-02-21 11:25:33'),
(127, 128, '2023-08-22', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Kadirov K.', 'Kalmuratov T.', '2023-06-01', NULL, 58, NULL, 2, 29, NULL, 25, '2024-02-21 11:30:47', '2024-02-21 11:30:47'),
(128, 129, '2023-08-25', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'ХАДЖИ ХАЙРУДДИН БАШИР АХМАД АХМАДИ', 'Aparnikova T.', '2022-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-21 11:40:06', '2024-02-21 11:40:06'),
(129, 130, '2023-09-05', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Praliev K.', 'Kemalov B.', '2023-06-01', NULL, 84, NULL, 2, 42, NULL, 25, '2024-02-21 11:54:18', '2024-02-21 11:54:18'),
(130, 131, '2023-09-08', 'Buzilish topilmadi. Bug\'doy uni-vitamin va mineral aralashmasi bilan boyitilgan birinchi nav omborda 25,50 kg qoplarda saqlanmoqda', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Гадоев Ж.', 'Alimov A.', '2023-09-06', '2026-09-11', 2, NULL, 2, 1, NULL, 25, '2024-02-23 15:09:10', '2024-02-23 15:09:10'),
(132, 133, '2024-02-23', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Alimov A.', '2023-10-01', NULL, 2, NULL, 2, 1, NULL, 25, '2024-02-26 12:44:06', '2024-02-26 12:44:06'),
(133, 134, '2024-02-26', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'NIYOZOV SAYDALI', 'Alimov A.', '2023-11-01', NULL, 4, NULL, 2, 2, NULL, 25, '2024-02-27 17:11:39', '2024-02-27 17:11:39'),
(134, 135, '2024-02-26', 'Buzilish topilmadi.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Раззаков Х.', 'Alimov A.', '2024-02-26', '2027-02-28', 2, NULL, 2, 1, NULL, 25, '2024-02-28 16:28:01', '2024-02-28 16:28:01'),
(135, 136, '2024-01-05', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Пулатов Ш.', 'Egamqulov M.', '2023-06-01', NULL, 24, NULL, 2, 12, NULL, 25, '2024-02-29 10:09:35', '2024-02-29 10:09:35'),
(136, 137, '2024-01-05', 'Buzilish topilmadi.', 'ГОСТ 26791-2018', 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev T.', 'Alimov A.', '2024-01-05', '2027-01-06', 2, NULL, 2, 1, NULL, 25, '2024-02-29 10:16:32', '2024-02-29 10:16:32'),
(137, 138, '2024-01-05', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Mamadaliev A.', 'Odilova U.', '2024-06-01', NULL, 28, NULL, 2, 14, NULL, 25, '2024-02-29 10:22:14', '2024-02-29 10:22:14'),
(138, 139, '2024-01-05', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Xudoyberdiev A.', 'Avilov B.', '2023-06-01', NULL, 70, NULL, 2, 35, NULL, 25, '2024-02-29 10:26:54', '2024-02-29 10:26:54'),
(139, 140, '2024-01-08', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Akbarov K.', 'Avilov B.', '2023-06-01', NULL, 88, NULL, 2, 44, NULL, 25, '2024-02-29 10:31:42', '2024-02-29 10:31:42'),
(140, 141, '2024-01-08', 'Buzilish topilmadi.', NULL, 'Oziq-ovqat maqsadlarida', 'Akbarov K.', 'Avilov B.', '2024-06-01', NULL, 120, NULL, 2, 60, NULL, 25, '2024-02-29 10:36:00', '2024-02-29 10:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `app_number` int(11) NOT NULL,
  `crop_data_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `prepared_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `accepted_date` date DEFAULT NULL,
  `accepted_id` int(11) DEFAULT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 3,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `app_number`, `crop_data_id`, `organization_id`, `prepared_id`, `type`, `date`, `accepted_date`, `accepted_id`, `data`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 3, '2024-01-05', '2024-01-05', 24, NULL, 4, 24, '2024-01-30 12:29:31', '2024-01-30 12:29:31'),
(2, 2, 2, 2, 2, 1, '2024-01-05', '2024-01-05', 25, NULL, 4, 25, '2024-01-30 15:45:10', '2024-01-30 15:45:10'),
(4, 3, 4, 3, 3, 3, '2024-01-05', '2024-01-05', 1, NULL, 4, 1, '2024-01-30 16:40:50', '2024-01-30 16:40:50'),
(5, 4, 5, 4, 4, 3, '2024-01-05', '2024-01-05', 1, NULL, 4, 1, '2024-01-30 16:58:29', '2024-01-30 16:58:29'),
(6, 5, 6, 5, 5, 3, '2024-01-08', '2024-01-08', 25, NULL, 4, 25, '2024-01-30 17:16:10', '2024-01-30 17:16:10'),
(7, 6, 7, 5, 5, 3, '2024-01-08', '2024-01-08', 25, NULL, 4, 25, '2024-01-30 17:25:18', '2024-01-30 17:25:18'),
(8, 7, 8, 6, 6, 2, '2024-01-09', '2024-01-09', 25, NULL, 4, 25, '2024-01-30 17:52:31', '2024-01-30 17:52:31'),
(9, 8, 9, 6, 6, 2, '2024-01-11', '2024-01-11', 25, NULL, 4, 25, '2024-01-30 18:04:05', '2024-01-30 18:04:05'),
(10, 9, 10, 7, 7, 3, '2024-01-11', '2024-01-11', 25, NULL, 4, 25, '2024-01-31 09:54:19', '2024-01-31 09:54:19'),
(11, 10, 11, 8, 8, 3, '2024-01-11', '2024-01-11', 25, NULL, 4, 25, '2024-01-31 10:23:29', '2024-01-31 10:23:29'),
(12, 11, 12, 9, 9, 3, '2024-01-11', '2024-01-11', 25, NULL, 4, 25, '2024-01-31 10:36:26', '2024-01-31 10:36:26'),
(13, 12, 13, 9, 9, 3, '2024-01-11', '2024-01-11', 25, NULL, 4, 25, '2024-01-31 11:01:41', '2024-01-31 11:01:41'),
(14, 13, 14, 10, 10, 3, '2024-01-22', '2024-01-22', 25, NULL, 4, 25, '2024-01-31 11:17:00', '2024-01-31 11:17:00'),
(15, 14, 15, 11, 11, 1, '2024-01-24', '2024-01-24', 25, NULL, 4, 25, '2024-01-31 11:47:56', '2024-01-31 11:47:56'),
(16, 1, 16, 6, 12, 2, '2023-01-05', '2023-01-05', 25, NULL, 4, 25, '2024-02-07 11:16:11', '2024-02-07 11:16:11'),
(17, 2, 17, 6, 13, 2, '2023-01-05', '2023-01-05', 25, NULL, 4, 25, '2024-02-07 11:38:07', '2024-02-07 11:38:07'),
(18, 3, 18, 6, 14, 2, '2023-01-05', '2023-01-05', 25, NULL, 4, 25, '2024-02-07 11:47:27', '2024-02-07 11:47:27'),
(19, 4, 19, 12, 15, 2, '2023-01-09', '2023-01-09', 25, NULL, 4, 25, '2024-02-07 12:05:41', '2024-02-07 12:05:41'),
(20, 5, 20, 12, 15, 2, '2023-01-10', '2023-01-10', 25, NULL, 4, 25, '2024-02-07 12:12:26', '2024-02-07 12:12:26'),
(21, 6, 21, 6, 16, 2, '2023-01-11', '2023-01-11', 25, NULL, 4, 25, '2024-02-07 12:23:06', '2024-02-07 12:23:06'),
(22, 7, 22, 6, 17, 2, '2023-01-11', '2023-01-11', 25, NULL, 4, 25, '2024-02-07 12:28:12', '2024-02-07 12:28:12'),
(23, 8, 23, 13, 18, 1, '2023-01-16', '2023-01-16', 25, NULL, 4, 25, '2024-02-07 12:45:23', '2024-02-07 12:45:23'),
(24, 9, 24, 14, 19, 1, '2023-01-16', '2023-01-16', 25, NULL, 4, 25, '2024-02-07 13:50:10', '2024-02-07 13:50:10'),
(25, 10, 25, 15, 20, 1, '2023-01-16', '2023-01-16', 25, NULL, 4, 25, '2024-02-07 14:03:31', '2024-02-07 14:03:31'),
(26, 11, 26, 6, 16, 2, '2023-01-16', '2023-01-16', 25, NULL, 4, 25, '2024-02-07 14:12:01', '2024-02-07 14:12:01'),
(27, 12, 27, 13, 18, 1, '2023-01-20', '2023-01-20', 25, NULL, 4, 25, '2024-02-07 14:35:58', '2024-02-07 14:35:58'),
(28, 13, 28, 6, 17, 2, '2023-01-20', '2023-01-20', 25, NULL, 4, 25, '2024-02-07 14:45:02', '2024-02-07 14:45:02'),
(29, 14, 29, 16, 21, 1, '2023-01-23', '2023-01-23', 25, NULL, 4, 25, '2024-02-07 14:55:19', '2024-02-09 09:15:43'),
(30, 15, 30, 17, 22, 1, '2023-01-24', '2023-01-24', 25, NULL, 4, 25, '2024-02-07 15:04:27', '2024-02-07 15:04:27'),
(31, 16, 31, 17, 22, 1, '2023-01-24', '2023-01-24', 25, NULL, 4, 25, '2024-02-07 15:10:52', '2024-02-07 15:10:52'),
(32, 17, 32, 18, 23, 1, '2023-01-24', '2023-01-24', 25, NULL, 4, 25, '2024-02-07 15:37:02', '2024-02-07 15:37:02'),
(33, 18, 33, 19, 24, 1, '2023-01-24', '2023-01-24', 25, NULL, 4, 25, '2024-02-08 11:12:50', '2024-02-08 11:12:50'),
(34, 19, 34, 20, 25, 1, '2023-01-30', '2023-01-30', 25, NULL, 4, 25, '2024-02-08 11:23:03', '2024-02-08 11:23:03'),
(35, 20, 35, 21, 26, 1, '2023-02-08', '2023-02-08', 25, NULL, 4, 25, '2024-02-08 13:20:54', '2024-02-08 13:20:54'),
(36, 21, 36, 20, 25, 1, '2023-02-10', '2023-02-10', 25, NULL, 4, 25, '2024-02-08 13:28:19', '2024-02-08 13:28:19'),
(37, 22, 37, 22, 27, 1, '2023-02-17', '2023-02-17', 25, NULL, 4, 25, '2024-02-08 13:38:28', '2024-02-08 13:38:28'),
(38, 23, 38, 10, 10, 1, '2023-02-20', '2023-02-20', 25, NULL, 4, 25, '2024-02-08 13:44:51', '2024-02-08 13:44:51'),
(39, 24, 39, 23, 28, 1, '2023-02-21', '2023-02-21', 25, NULL, 4, 25, '2024-02-08 13:53:01', '2024-02-08 13:53:01'),
(40, 25, 40, 24, 29, 3, '2023-02-28', '2023-02-28', 25, NULL, 4, 25, '2024-02-08 14:01:49', '2024-02-08 14:01:49'),
(41, 26, 41, 25, 30, 1, '2023-03-25', '2023-03-25', 25, NULL, 4, 25, '2024-02-08 14:46:17', '2024-02-08 14:46:17'),
(42, 27, 42, 26, 31, 1, '2023-05-02', '2023-05-02', 25, NULL, 4, 25, '2024-02-08 15:06:54', '2024-02-08 15:06:54'),
(43, 28, 43, 27, 32, 2, '2023-05-26', '2023-05-26', 25, NULL, 4, 25, '2024-02-08 15:29:45', '2024-02-08 15:29:45'),
(44, 29, 44, 27, 33, 2, '2023-05-29', '2023-05-29', 25, NULL, 4, 25, '2024-02-08 15:47:34', '2024-02-09 09:15:51'),
(45, 30, 45, 28, 34, 1, '2023-06-01', '2023-06-01', 25, NULL, 4, 25, '2024-02-08 15:57:14', '2024-02-08 15:57:14'),
(46, 31, 46, 12, 35, 2, '2023-06-14', '2023-06-14', 25, NULL, 4, 25, '2024-02-09 10:46:39', '2024-02-09 10:46:39'),
(47, 32, 47, 29, 36, 1, '2023-06-14', '2023-06-14', 25, NULL, 4, 25, '2024-02-09 11:00:54', '2024-02-09 11:00:54'),
(48, 33, 48, 9, 9, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 12:01:25', '2024-02-09 12:01:25'),
(49, 33, 49, 9, 37, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 12:10:43', '2024-02-09 12:10:43'),
(50, 33, 50, 9, 38, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 12:15:29', '2024-02-09 12:17:36'),
(51, 33, 51, 9, 39, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 12:20:04', '2024-02-09 12:20:04'),
(52, 33, 52, 9, 40, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 12:23:54', '2024-02-09 12:23:54'),
(53, 33, 53, 9, 41, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 12:27:50', '2024-02-09 12:27:50'),
(54, 34, 54, 8, 43, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 14:20:27', '2024-02-09 14:20:27'),
(55, 34, 55, 8, 42, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 15:26:10', '2024-02-09 15:26:10'),
(56, 35, 56, 4, 4, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 15:53:28', '2024-02-09 15:53:28'),
(57, 35, 57, 4, 44, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 16:27:42', '2024-02-09 16:27:42'),
(58, 35, 58, 4, 45, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 16:34:13', '2024-02-09 16:34:13'),
(59, 35, 59, 4, 46, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 16:43:10', '2024-02-09 16:43:10'),
(60, 36, 60, 7, 47, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 16:52:01', '2024-02-09 16:52:01'),
(61, 37, 61, 5, 5, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-09 23:15:25', '2024-02-09 23:15:25'),
(62, 38, 62, 30, 48, 1, '2023-06-26', '2023-06-26', 25, NULL, 4, 25, '2024-02-10 15:31:11', '2024-02-10 15:31:11'),
(63, 39, 63, 31, 49, 1, '2023-07-03', '2023-07-03', 25, NULL, 4, 25, '2024-02-10 15:38:37', '2024-02-10 15:38:37'),
(64, 40, 64, 9, 9, 1, '2023-07-03', '2023-07-03', 25, NULL, 4, 25, '2024-02-10 15:43:22', '2024-02-10 15:43:22'),
(65, 41, 65, 32, 50, 1, '2023-07-03', '2023-07-03', 25, NULL, 4, 25, '2024-02-10 15:55:49', '2024-02-10 15:55:49'),
(66, 42, 66, 5, 5, 1, '2023-07-03', '2023-07-03', 25, NULL, 4, 25, '2024-02-10 16:03:08', '2024-02-10 16:03:08'),
(67, 43, 67, 33, 51, 1, '2023-07-03', '2023-07-03', 25, NULL, 4, 25, '2024-02-10 16:10:41', '2024-02-10 16:10:41'),
(68, 44, 68, 4, 45, 1, '2023-07-04', '2023-07-04', 25, NULL, 4, 25, '2024-02-10 16:15:42', '2024-02-10 16:15:42'),
(69, 45, 69, 34, 52, 1, '2023-07-04', '2023-07-04', 25, NULL, 4, 25, '2024-02-10 16:30:45', '2024-02-10 16:30:45'),
(70, 46, 70, 35, 7, 1, '2023-07-04', '2023-07-04', 25, NULL, 4, 25, '2024-02-10 16:36:41', '2024-02-10 16:36:41'),
(71, 47, 71, 28, 34, 1, '2023-07-06', '2023-07-06', 25, NULL, 4, 25, '2024-02-10 16:42:13', '2024-02-10 16:42:13'),
(72, 48, 72, 36, 53, 1, '2023-07-06', '2023-07-06', 25, NULL, 4, 25, '2024-02-10 16:48:02', '2024-02-10 16:48:02'),
(73, 49, 73, 37, 54, 1, '2023-07-06', '2023-07-06', 25, NULL, 4, 25, '2024-02-10 16:57:02', '2024-02-10 16:57:02'),
(74, 50, 74, 38, 55, 1, '2023-07-07', '2023-07-07', 25, NULL, 4, 25, '2024-02-10 17:17:50', '2024-02-10 17:17:50'),
(75, 51, 75, 39, 56, 1, '2023-07-07', '2023-07-07', 25, NULL, 4, 25, '2024-02-10 17:26:33', '2024-02-10 17:26:33'),
(76, 52, 76, 40, 57, 1, '2023-07-10', '2023-07-10', 25, NULL, 4, 25, '2024-02-10 17:32:00', '2024-02-10 17:32:00'),
(77, 53, 77, 41, 58, 1, '2023-07-10', '2023-07-10', 25, NULL, 4, 25, '2024-02-10 17:39:17', '2024-02-10 17:39:17'),
(78, 54, 78, 42, 59, 1, '2023-07-10', '2023-07-10', 25, NULL, 4, 25, '2024-02-12 09:33:22', '2024-02-12 09:33:22'),
(79, 55, 79, 43, 60, 1, '2023-07-10', '2023-07-10', 25, NULL, 4, 25, '2024-02-12 09:41:55', '2024-02-12 09:41:55'),
(80, 56, 80, 43, 61, 1, '2023-07-10', '2023-07-10', 25, NULL, 4, 25, '2024-02-12 10:11:01', '2024-02-12 10:11:01'),
(81, 56, 81, 43, 61, 1, '2023-07-10', '2023-07-10', 25, NULL, 4, 25, '2024-02-12 10:23:54', '2024-02-12 10:23:54'),
(82, 57, 82, 30, 62, 1, '2023-07-11', '2023-07-11', 25, NULL, 4, 25, '2024-02-12 10:48:13', '2024-02-12 10:48:13'),
(83, 58, 83, 44, 63, 1, '2023-07-11', '2023-07-11', 25, NULL, 4, 25, '2024-02-12 11:01:33', '2024-02-12 11:01:33'),
(84, 59, 84, 45, 64, 1, '2023-07-12', '2023-07-12', 25, NULL, 4, 25, '2024-02-12 11:10:19', '2024-02-12 11:10:19'),
(85, 60, 85, 46, 65, 1, '2023-07-12', '2023-07-12', 25, NULL, 4, 25, '2024-02-12 11:20:30', '2024-02-12 11:20:30'),
(86, 61, 86, 47, 66, 1, '2023-07-13', '2023-07-13', 25, NULL, 4, 25, '2024-02-12 11:44:45', '2024-02-12 11:44:45'),
(87, 62, 87, 48, 67, 1, '2023-07-13', '2023-07-13', 25, NULL, 4, 25, '2024-02-12 11:56:20', '2024-02-12 11:56:20'),
(88, 63, 88, 49, 68, 1, '2023-07-14', '2023-07-14', 25, NULL, 4, 25, '2024-02-12 12:04:04', '2024-02-12 12:04:04'),
(89, 64, 89, 2, 2, 1, '2023-07-18', '2023-07-18', 25, NULL, 4, 25, '2024-02-12 12:15:20', '2024-02-12 12:15:20'),
(90, 65, 90, 50, 69, 1, '2023-07-18', '2023-07-18', 25, NULL, 4, 25, '2024-02-12 12:45:39', '2024-02-12 12:45:39'),
(91, 66, 91, 47, 66, 1, '2023-07-18', '2023-07-18', 25, NULL, 4, 25, '2024-02-12 12:52:34', '2024-02-12 12:52:34'),
(92, 67, 92, 44, 63, 1, '2023-07-18', '2023-07-18', 25, NULL, 4, 25, '2024-02-12 13:00:13', '2024-02-12 13:00:13'),
(93, 68, 93, 51, 70, 1, '2023-07-19', '2023-07-19', 25, NULL, 4, 25, '2024-02-12 13:06:22', '2024-02-12 13:06:22'),
(94, 69, 94, 52, 71, 1, '2023-07-19', '2023-07-19', 25, NULL, 4, 25, '2024-02-12 13:14:40', '2024-02-12 13:14:40'),
(95, 70, 95, 1, 1, 1, '2023-07-20', '2023-07-20', 25, NULL, 4, 25, '2024-02-12 13:20:53', '2024-02-12 13:20:53'),
(96, 71, 96, 53, 72, 1, '2023-07-20', '2023-07-20', 25, NULL, 4, 25, '2024-02-12 13:25:50', '2024-02-12 13:25:50'),
(97, 72, 97, 54, 73, 1, '2023-07-21', '2023-07-21', 25, NULL, 4, 25, '2024-02-12 13:36:16', '2024-02-12 13:36:16'),
(98, 73, 98, 54, 73, 1, '2023-07-21', '2023-07-21', 25, NULL, 4, 25, '2024-02-12 13:47:02', '2024-02-12 13:47:02'),
(99, 74, 99, 55, 74, 1, '2023-07-24', '2023-07-24', 25, NULL, 4, 25, '2024-02-12 14:17:26', '2024-02-12 14:17:26'),
(100, 74, 100, 55, 74, 1, '2023-07-24', '2023-07-24', 25, NULL, 4, 25, '2024-02-12 14:22:53', '2024-02-12 14:22:53'),
(101, 75, 101, 56, 75, 1, '2023-07-24', '2023-07-24', 25, NULL, 4, 25, '2024-02-12 14:29:19', '2024-02-12 14:29:19'),
(102, 75, 102, 56, 75, 1, '2023-07-24', '2023-07-24', 25, NULL, 4, 25, '2024-02-12 14:33:44', '2024-02-12 14:33:44'),
(103, 76, 103, 57, 76, 1, '2023-07-24', '2023-07-24', 25, NULL, 4, 25, '2024-02-12 14:48:09', '2024-02-12 14:48:09'),
(104, 77, 104, 21, 26, 1, '2023-07-26', '2023-07-26', 25, NULL, 4, 25, '2024-02-12 14:59:40', '2024-02-12 14:59:40'),
(105, 78, 105, 58, 77, 1, '2023-07-27', '2023-07-27', 25, NULL, 4, 25, '2024-02-12 15:10:40', '2024-02-12 15:10:40'),
(106, 79, 106, 10, 10, 1, '2023-07-27', '2023-07-27', 25, NULL, 4, 25, '2024-02-13 13:26:34', '2024-02-13 13:26:34'),
(107, 80, 107, 59, 78, 1, '2023-08-01', '2023-08-01', 25, NULL, 4, 25, '2024-02-13 13:38:59', '2024-02-13 13:38:59'),
(108, 81, 108, 60, 78, 1, '2023-08-01', '2023-08-01', 25, NULL, 4, 25, '2024-02-13 13:45:42', '2024-02-13 13:45:42'),
(109, 82, 109, 21, 26, 1, '2023-08-01', '2023-08-01', 25, NULL, 4, 25, '2024-02-13 13:59:07', '2024-02-13 13:59:07'),
(110, 83, 110, 61, 79, 1, '2023-08-01', '2023-08-01', 25, NULL, 4, 25, '2024-02-13 14:20:41', '2024-02-13 14:20:41'),
(111, 84, 111, 62, 80, 1, '2023-08-04', '2023-08-04', 25, NULL, 4, 25, '2024-02-13 15:06:42', '2024-02-13 15:06:42'),
(112, 85, 112, 37, 54, 1, '2023-08-04', '2023-08-04', 25, NULL, 4, 25, '2024-02-13 15:15:57', '2024-02-13 15:15:57'),
(113, 86, 113, 18, 23, 1, '2023-08-07', '2023-08-07', 25, NULL, 4, 25, '2024-02-13 15:23:22', '2024-02-13 15:23:22'),
(114, 87, 114, 63, 81, 1, '2023-08-08', '2023-08-08', 25, NULL, 4, 25, '2024-02-13 17:25:24', '2024-02-13 17:25:24'),
(115, 88, 115, 64, 82, 1, '2023-08-08', '2023-08-08', 25, NULL, 4, 25, '2024-02-13 17:37:13', '2024-02-13 17:37:13'),
(116, 89, 116, 65, 83, 1, '2023-08-08', '2023-08-08', 25, NULL, 4, 25, '2024-02-13 17:45:30', '2024-02-13 17:45:30'),
(117, 90, 117, 65, 83, 1, '2023-08-08', '2023-08-08', 25, NULL, 4, 25, '2024-02-13 18:00:56', '2024-02-13 18:00:56'),
(118, 91, 118, 43, 61, 1, '2023-08-09', '2023-08-09', 25, NULL, 4, 25, '2024-02-15 10:11:34', '2024-02-15 10:11:34'),
(119, 15, 119, 6, 6, 2, '2024-02-09', '2024-02-09', 25, NULL, 4, 25, '2024-02-15 16:47:21', '2024-02-15 16:47:21'),
(120, 15, 120, 6, 84, 2, '2024-02-09', '2024-02-09', 25, NULL, 4, 25, '2024-02-15 16:54:49', '2024-02-15 16:54:49'),
(121, 16, 121, 6, 86, 2, '2024-02-15', '2024-02-15', 25, NULL, 4, 25, '2024-02-16 11:24:00', '2024-02-16 11:24:00'),
(122, 92, 122, 66, 87, 1, '2023-08-09', '2023-08-09', 25, NULL, 4, 25, '2024-02-19 13:16:31', '2024-02-19 13:16:31'),
(123, 93, 123, 67, 88, 1, '2023-08-11', '2023-08-11', 25, NULL, 4, 25, '2024-02-19 13:25:14', '2024-02-19 13:25:14'),
(124, 94, 124, 42, 59, 1, '2023-08-11', '2023-08-11', 25, NULL, 4, 25, '2024-02-19 13:33:41', '2024-02-19 13:33:41'),
(125, 95, 125, 24, 29, 1, '2023-08-15', '2023-08-15', 25, NULL, 4, 25, '2024-02-19 13:45:42', '2024-02-19 13:45:42'),
(126, 96, 126, 68, 89, 1, '2023-08-16', '2023-08-16', 25, NULL, 4, 25, '2024-02-19 13:54:16', '2024-02-19 13:54:16'),
(127, 97, 127, 13, 18, 1, '2023-08-22', '2023-08-22', 25, NULL, 4, 25, '2024-02-21 11:20:22', '2024-02-21 11:20:22'),
(128, 98, 128, 15, 20, 1, '2023-08-22', '2023-08-22', 25, NULL, 4, 25, '2024-02-21 11:28:51', '2024-02-21 11:28:51'),
(129, 99, 129, 69, 90, 2, '2023-08-25', '2023-08-25', 25, NULL, 4, 25, '2024-02-21 11:38:09', '2024-02-21 11:38:09'),
(130, 100, 130, 14, 19, 1, '2023-09-05', '2023-09-05', 25, NULL, 4, 25, '2024-02-21 11:51:09', '2024-02-21 11:51:09'),
(131, 101, 131, 70, 78, 1, '2023-09-08', '2023-09-08', 25, NULL, 4, 25, '2024-02-23 15:05:55', '2024-02-23 15:05:55'),
(132, 17, 132, 6, 92, 2, '2023-02-23', '2023-02-23', 25, NULL, 4, 25, '2024-02-26 12:28:47', '2024-02-26 12:28:47'),
(133, 17, 133, 6, 92, 2, '2023-02-23', '2023-02-23', 25, NULL, 4, 25, '2024-02-26 12:29:23', '2024-02-26 12:29:23'),
(134, 17, 134, 6, 92, 2, '2023-02-23', '2023-02-23', 25, NULL, 4, 25, '2024-02-26 12:30:54', '2024-02-26 12:30:54'),
(135, 17, 135, 6, 92, 2, '2023-02-23', '2023-02-23', 25, NULL, 4, 25, '2024-02-26 12:31:15', '2024-02-26 12:31:15'),
(136, 17, 136, 6, 92, 2, '2023-02-23', '2023-02-23', 25, NULL, 4, 25, '2024-02-26 12:35:08', '2024-02-26 12:35:08'),
(138, 17, 138, 6, 92, 2, '2023-02-23', '2023-02-23', 25, NULL, 4, 25, '2024-02-26 12:37:39', '2024-02-26 12:37:39'),
(139, 17, 139, 6, 92, 2, '2024-02-23', '2024-02-23', 25, NULL, 4, 25, '2024-02-26 12:38:47', '2024-02-26 12:38:47'),
(140, 18, 140, 6, 93, 2, '2024-02-26', '2024-02-26', 25, NULL, 4, 25, '2024-02-27 17:07:51', '2024-02-27 17:07:51'),
(141, 19, 141, 50, 69, 1, '2024-02-26', '2024-02-26', 25, NULL, 4, 25, '2024-02-28 16:17:04', '2024-02-28 16:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `app_file_foreign`
--

CREATE TABLE `app_file_foreign` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `sess_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `app_file_local`
--

CREATE TABLE `app_file_local` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `a_dalolatnoma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_xulosa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_xulosa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `markirovka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_requirements`
--

CREATE TABLE `app_requirements` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `requirement_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_requirements`
--

INSERT INTO `app_requirements` (`id`, `app_id`, `requirement_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-01-30 12:29:32', '2024-01-30 12:29:32'),
(2, 2, 1, '2024-01-30 15:45:10', '2024-01-30 15:45:10'),
(3, 3, 1, '2024-01-30 16:22:11', '2024-01-30 16:22:11'),
(4, 4, 1, '2024-01-30 16:40:51', '2024-01-30 16:40:51'),
(5, 5, 1, '2024-01-30 16:58:29', '2024-01-30 16:58:29'),
(6, 6, 1, '2024-01-30 17:16:11', '2024-01-30 17:16:11'),
(7, 7, 1, '2024-01-30 17:25:18', '2024-01-30 17:25:18'),
(8, 8, 1, '2024-01-30 17:52:31', '2024-01-30 17:52:31'),
(9, 9, 1, '2024-01-30 18:04:06', '2024-01-30 18:04:06'),
(10, 10, 1, '2024-01-31 09:54:20', '2024-01-31 09:54:20'),
(11, 11, 1, '2024-01-31 10:23:29', '2024-01-31 10:23:29'),
(12, 12, 1, '2024-01-31 10:36:26', '2024-01-31 10:36:26'),
(13, 13, 1, '2024-01-31 11:01:41', '2024-01-31 11:01:41'),
(14, 14, 1, '2024-01-31 11:17:00', '2024-01-31 11:17:00'),
(15, 15, 1, '2024-01-31 11:47:56', '2024-01-31 11:47:56'),
(17, 17, 1, '2024-02-07 11:38:07', '2024-02-07 11:38:07'),
(18, 16, 1, '2024-02-07 11:39:45', '2024-02-07 11:39:45'),
(19, 18, 1, '2024-02-07 11:47:27', '2024-02-07 11:47:27'),
(20, 19, 1, '2024-02-07 12:05:42', '2024-02-07 12:05:42'),
(21, 20, 1, '2024-02-07 12:12:27', '2024-02-07 12:12:27'),
(22, 21, 1, '2024-02-07 12:23:06', '2024-02-07 12:23:06'),
(23, 22, 1, '2024-02-07 12:28:12', '2024-02-07 12:28:12'),
(24, 23, 1, '2024-02-07 12:45:23', '2024-02-07 12:45:23'),
(25, 24, 1, '2024-02-07 13:50:10', '2024-02-07 13:50:10'),
(26, 25, 1, '2024-02-07 14:03:31', '2024-02-07 14:03:31'),
(27, 26, 1, '2024-02-07 14:12:01', '2024-02-07 14:12:01'),
(28, 27, 1, '2024-02-07 14:35:59', '2024-02-07 14:35:59'),
(29, 28, 1, '2024-02-07 14:45:02', '2024-02-07 14:45:02'),
(30, 29, 1, '2024-02-07 14:55:19', '2024-02-07 14:55:19'),
(31, 30, 1, '2024-02-07 15:04:27', '2024-02-07 15:04:27'),
(32, 31, 1, '2024-02-07 15:10:52', '2024-02-07 15:10:52'),
(33, 32, 1, '2024-02-07 15:37:02', '2024-02-07 15:37:02'),
(34, 33, 1, '2024-02-08 11:12:50', '2024-02-08 11:12:50'),
(35, 34, 1, '2024-02-08 11:23:03', '2024-02-08 11:23:03'),
(36, 35, 1, '2024-02-08 13:20:54', '2024-02-08 13:20:54'),
(37, 36, 1, '2024-02-08 13:28:19', '2024-02-08 13:28:19'),
(38, 37, 1, '2024-02-08 13:38:28', '2024-02-08 13:38:28'),
(39, 38, 1, '2024-02-08 13:44:52', '2024-02-08 13:44:52'),
(40, 39, 1, '2024-02-08 13:53:01', '2024-02-08 13:53:01'),
(41, 40, 1, '2024-02-08 14:01:50', '2024-02-08 14:01:50'),
(42, 41, 1, '2024-02-08 14:46:17', '2024-02-08 14:46:17'),
(43, 42, 1, '2024-02-08 15:06:54', '2024-02-08 15:06:54'),
(44, 43, 1, '2024-02-08 15:29:45', '2024-02-08 15:29:45'),
(45, 44, 1, '2024-02-08 15:47:35', '2024-02-08 15:47:35'),
(46, 45, 1, '2024-02-08 15:57:14', '2024-02-08 15:57:14'),
(47, 46, 1, '2024-02-09 10:46:39', '2024-02-09 10:46:39'),
(48, 47, 1, '2024-02-09 11:00:55', '2024-02-09 11:00:55'),
(49, 48, 1, '2024-02-09 12:01:25', '2024-02-09 12:01:25'),
(50, 49, 1, '2024-02-09 12:10:44', '2024-02-09 12:10:44'),
(54, 52, 1, '2024-02-09 12:23:54', '2024-02-09 12:23:54'),
(55, 53, 1, '2024-02-09 12:27:51', '2024-02-09 12:27:51'),
(56, 54, 1, '2024-02-09 14:20:27', '2024-02-09 14:20:27'),
(57, 55, 1, '2024-02-09 15:26:10', '2024-02-09 15:26:10'),
(58, 50, 1, '2024-02-09 15:30:35', '2024-02-09 15:30:35'),
(59, 51, 1, '2024-02-09 15:30:55', '2024-02-09 15:30:55'),
(60, 56, 1, '2024-02-09 15:53:28', '2024-02-09 15:53:28'),
(61, 57, 1, '2024-02-09 16:27:42', '2024-02-09 16:27:42'),
(62, 58, 1, '2024-02-09 16:34:13', '2024-02-09 16:34:13'),
(63, 59, 1, '2024-02-09 16:43:11', '2024-02-09 16:43:11'),
(64, 60, 1, '2024-02-09 16:52:01', '2024-02-09 16:52:01'),
(65, 61, 1, '2024-02-09 23:15:25', '2024-02-09 23:15:25'),
(66, 62, 1, '2024-02-10 15:31:11', '2024-02-10 15:31:11'),
(67, 63, 1, '2024-02-10 15:38:37', '2024-02-10 15:38:37'),
(68, 64, 1, '2024-02-10 15:43:22', '2024-02-10 15:43:22'),
(69, 65, 1, '2024-02-10 15:55:49', '2024-02-10 15:55:49'),
(70, 66, 1, '2024-02-10 16:03:09', '2024-02-10 16:03:09'),
(71, 67, 1, '2024-02-10 16:10:41', '2024-02-10 16:10:41'),
(72, 68, 1, '2024-02-10 16:15:42', '2024-02-10 16:15:42'),
(73, 69, 1, '2024-02-10 16:30:46', '2024-02-10 16:30:46'),
(74, 70, 1, '2024-02-10 16:36:42', '2024-02-10 16:36:42'),
(75, 71, 1, '2024-02-10 16:42:13', '2024-02-10 16:42:13'),
(76, 72, 1, '2024-02-10 16:48:03', '2024-02-10 16:48:03'),
(77, 73, 1, '2024-02-10 16:57:03', '2024-02-10 16:57:03'),
(78, 74, 1, '2024-02-10 17:17:50', '2024-02-10 17:17:50'),
(79, 75, 1, '2024-02-10 17:26:33', '2024-02-10 17:26:33'),
(80, 76, 1, '2024-02-10 17:32:00', '2024-02-10 17:32:00'),
(81, 77, 1, '2024-02-10 17:39:17', '2024-02-10 17:39:17'),
(82, 78, 1, '2024-02-12 09:33:22', '2024-02-12 09:33:22'),
(83, 79, 1, '2024-02-12 09:41:55', '2024-02-12 09:41:55'),
(84, 80, 1, '2024-02-12 10:11:01', '2024-02-12 10:11:01'),
(85, 81, 1, '2024-02-12 10:23:54', '2024-02-12 10:23:54'),
(86, 82, 1, '2024-02-12 10:48:14', '2024-02-12 10:48:14'),
(87, 83, 1, '2024-02-12 11:01:33', '2024-02-12 11:01:33'),
(89, 84, 1, '2024-02-12 11:14:12', '2024-02-12 11:14:12'),
(90, 85, 1, '2024-02-12 11:20:30', '2024-02-12 11:20:30'),
(91, 86, 1, '2024-02-12 11:44:45', '2024-02-12 11:44:45'),
(92, 87, 1, '2024-02-12 11:56:20', '2024-02-12 11:56:20'),
(93, 88, 1, '2024-02-12 12:04:04', '2024-02-12 12:04:04'),
(94, 89, 1, '2024-02-12 12:15:20', '2024-02-12 12:15:20'),
(95, 90, 1, '2024-02-12 12:45:39', '2024-02-12 12:45:39'),
(96, 91, 1, '2024-02-12 12:52:34', '2024-02-12 12:52:34'),
(97, 92, 1, '2024-02-12 13:00:13', '2024-02-12 13:00:13'),
(98, 93, 1, '2024-02-12 13:06:22', '2024-02-12 13:06:22'),
(99, 94, 1, '2024-02-12 13:14:40', '2024-02-12 13:14:40'),
(100, 95, 1, '2024-02-12 13:20:53', '2024-02-12 13:20:53'),
(101, 96, 1, '2024-02-12 13:25:50', '2024-02-12 13:25:50'),
(102, 97, 1, '2024-02-12 13:36:16', '2024-02-12 13:36:16'),
(103, 98, 1, '2024-02-12 13:47:03', '2024-02-12 13:47:03'),
(104, 99, 1, '2024-02-12 14:17:27', '2024-02-12 14:17:27'),
(105, 100, 1, '2024-02-12 14:22:54', '2024-02-12 14:22:54'),
(106, 101, 1, '2024-02-12 14:29:19', '2024-02-12 14:29:19'),
(107, 102, 1, '2024-02-12 14:33:44', '2024-02-12 14:33:44'),
(108, 103, 1, '2024-02-12 14:48:09', '2024-02-12 14:48:09'),
(109, 104, 1, '2024-02-12 14:59:41', '2024-02-12 14:59:41'),
(110, 105, 1, '2024-02-12 15:10:40', '2024-02-12 15:10:40'),
(111, 106, 1, '2024-02-13 13:26:34', '2024-02-13 13:26:34'),
(112, 107, 1, '2024-02-13 13:38:59', '2024-02-13 13:38:59'),
(113, 108, 1, '2024-02-13 13:45:42', '2024-02-13 13:45:42'),
(114, 109, 1, '2024-02-13 13:59:07', '2024-02-13 13:59:07'),
(115, 110, 1, '2024-02-13 14:20:41', '2024-02-13 14:20:41'),
(116, 111, 1, '2024-02-13 15:06:42', '2024-02-13 15:06:42'),
(117, 112, 1, '2024-02-13 15:15:57', '2024-02-13 15:15:57'),
(118, 113, 1, '2024-02-13 15:23:22', '2024-02-13 15:23:22'),
(119, 114, 1, '2024-02-13 17:25:24', '2024-02-13 17:25:24'),
(120, 115, 1, '2024-02-13 17:37:13', '2024-02-13 17:37:13'),
(121, 116, 1, '2024-02-13 17:45:30', '2024-02-13 17:45:30'),
(122, 117, 1, '2024-02-13 18:00:56', '2024-02-13 18:00:56'),
(123, 118, 1, '2024-02-15 10:11:34', '2024-02-15 10:11:34'),
(124, 119, 1, '2024-02-15 16:47:21', '2024-02-15 16:47:21'),
(125, 120, 1, '2024-02-15 16:54:49', '2024-02-15 16:54:49'),
(127, 122, 1, '2024-02-19 13:16:31', '2024-02-19 13:16:31'),
(128, 123, 1, '2024-02-19 13:25:14', '2024-02-19 13:25:14'),
(131, 124, 1, '2024-02-19 13:35:38', '2024-02-19 13:35:38'),
(132, 125, 1, '2024-02-19 13:45:42', '2024-02-19 13:45:42'),
(133, 126, 1, '2024-02-19 13:54:16', '2024-02-19 13:54:16'),
(134, 127, 1, '2024-02-21 11:20:22', '2024-02-21 11:20:22'),
(135, 128, 1, '2024-02-21 11:28:51', '2024-02-21 11:28:51'),
(136, 129, 1, '2024-02-21 11:38:09', '2024-02-21 11:38:09'),
(137, 130, 1, '2024-02-21 11:51:09', '2024-02-21 11:51:09'),
(138, 131, 1, '2024-02-23 15:05:55', '2024-02-23 15:05:55'),
(139, 132, 1, '2024-02-26 12:28:47', '2024-02-26 12:28:47'),
(140, 133, 1, '2024-02-26 12:29:23', '2024-02-26 12:29:23'),
(141, 134, 1, '2024-02-26 12:30:54', '2024-02-26 12:30:54'),
(142, 135, 1, '2024-02-26 12:31:15', '2024-02-26 12:31:15'),
(143, 136, 1, '2024-02-26 12:35:08', '2024-02-26 12:35:08'),
(144, 137, 1, '2024-02-26 12:36:50', '2024-02-26 12:36:50'),
(145, 138, 1, '2024-02-26 12:37:39', '2024-02-26 12:37:39'),
(146, 139, 1, '2024-02-26 12:38:47', '2024-02-26 12:38:47'),
(147, 121, 1, '2024-02-26 12:47:25', '2024-02-26 12:47:25'),
(148, 140, 1, '2024-02-27 17:07:51', '2024-02-27 17:07:51'),
(149, 141, 1, '2024-02-28 16:17:04', '2024-02-28 16:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `app_status_changes`
--

CREATE TABLE `app_status_changes` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_id` bigint(20) UNSIGNED NOT NULL,
  `attachable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `created_at`, `updated_at`, `url`, `attachable_id`, `attachable_type`) VALUES
(1, '2024-01-30 13:21:08', '2024-01-30 13:21:08', 'reason-files/2024-01-30/0f204576d40819446db098fcbffc300ae1320682b9688ae120d1c4454a910f7b.pdf', 1, 'App\\Models\\FinalResult'),
(2, '2024-01-30 16:00:25', '2024-01-30 16:00:25', 'reason-files/2024-01-30/8668231f4fa64e60678e31d7a5c750b5ab5a9b689eec298cc50c260528b0135a.pdf', 2, 'App\\Models\\FinalResult'),
(3, '2024-01-30 16:49:08', '2024-01-30 16:49:08', 'reason-files/2024-01-30/2de2305215ea68ffa025a16e6446e1983f026e7349b63bb164324b643765ad43.pdf', 3, 'App\\Models\\FinalResult'),
(4, '2024-01-30 17:05:50', '2024-01-30 17:05:50', 'reason-files/2024-01-30/c882e16bf22ed1bd34578dfe9bb3813dfaffe72168b7279b845763c932dcf306.pdf', 4, 'App\\Models\\FinalResult'),
(5, '2024-01-30 17:23:18', '2024-01-30 17:23:18', 'reason-files/2024-01-30/64d357bbfb6d8648218161a1afb7b10be9c009638a15415c019545f8c377c61f.pdf', 5, 'App\\Models\\FinalResult'),
(6, '2024-01-30 17:31:27', '2024-01-30 17:31:27', 'reason-files/2024-01-30/1665c4baa879fd40abefec19f479ef8ef2580e4b6452cc6effeb5cbf0491d2e7.pdf', 6, 'App\\Models\\FinalResult'),
(7, '2024-01-30 17:59:45', '2024-01-30 17:59:45', 'reason-files/2024-01-30/72ada0ff886cb842dd8bfb64a52b599ceefd4d0b1773315d1bfc8960b984507a.pdf', 7, 'App\\Models\\FinalResult'),
(8, '2024-01-30 18:08:31', '2024-01-30 18:08:31', 'reason-files/2024-01-30/c5e1b6d989d75b34ca9b25b1ec3975ebe614fdd7ee213b6a653db9557f7443ef.pdf', 8, 'App\\Models\\FinalResult'),
(9, '2024-01-31 09:59:53', '2024-01-31 09:59:53', 'reason-files/2024-01-31/03d036bf0b215055e1483a177fae147997c7b797f80acc051928f5a2af8167f4.pdf', 9, 'App\\Models\\FinalResult'),
(10, '2024-01-31 10:27:21', '2024-01-31 10:27:21', 'reason-files/2024-01-31/914da022e9b57fe06a23678e08953c31d4c2ab36ea12315caef23993a25541c0.pdf', 10, 'App\\Models\\FinalResult'),
(11, '2024-01-31 10:52:48', '2024-01-31 10:52:48', 'reason-files/2024-01-31/46e4ec26da8f2d847518b2a31fb3dea35f2cdf6116bc83bcfde30d26723e3fa4.pdf', 11, 'App\\Models\\FinalResult'),
(12, '2024-01-31 11:10:48', '2024-01-31 11:10:48', 'reason-files/2024-01-31/5766a2973dd57c2a2021924d9ec1093a7a4ca842e486f8ca9ce136a47bdcc9a3.pdf', 12, 'App\\Models\\FinalResult'),
(13, '2024-01-31 11:40:48', '2024-01-31 11:40:48', 'reason-files/2024-01-31/cce7b98a57d2e003945f5ae0800ac34b87f2ad7f1742025184adf645f7ea1b54.pdf', 13, 'App\\Models\\FinalResult'),
(14, '2024-01-31 12:00:36', '2024-01-31 12:00:36', 'reason-files/2024-01-31/a4ec8911c634fe92b6f3e3d2105b313c67ccfac0cb60febd28a1019b2bd835a3.PDF', 14, 'App\\Models\\FinalResult'),
(15, '2024-02-07 11:34:54', '2024-02-07 11:34:54', 'reason-files/2024-02-07/3954ff9e2cd5263992e6b349b152f9c8d120efc32b0a950632725cdf161740ec.pdf', 15, 'App\\Models\\FinalResult'),
(16, '2024-02-07 11:45:29', '2024-02-07 11:45:29', 'reason-files/2024-02-07/68e98d15313c9d45c35e05ae3dc14f50aa32e799f6b582997a40bdeaa1f3ae6a.pdf', 16, 'App\\Models\\FinalResult'),
(17, '2024-02-07 11:53:16', '2024-02-07 11:53:16', 'reason-files/2024-02-07/8a1f146817abe9b0a5a0a78b54ffdeb9eb63b93b22782beb99fa0a9233bc5683.pdf', 17, 'App\\Models\\FinalResult'),
(18, '2024-02-07 12:11:04', '2024-02-07 12:11:04', 'reason-files/2024-02-07/754b4035403054e84e4403823e904e8db77b3ae9112be4414912fb6a9f120a12.pdf', 18, 'App\\Models\\FinalResult'),
(19, '2024-02-07 12:21:08', '2024-02-07 12:21:08', 'reason-files/2024-02-07/3557713ceab54bc3714677485fed7605699b0ce715aed5d5929dd6b09c293f71.pdf', 19, 'App\\Models\\FinalResult'),
(20, '2024-02-07 12:26:27', '2024-02-07 12:26:27', 'reason-files/2024-02-07/b7501d5816fb0ebdd6a67bd901184abef7f0385129a3675a3d2acf3e893abad9.pdf', 20, 'App\\Models\\FinalResult'),
(21, '2024-02-07 12:31:42', '2024-02-07 12:31:42', 'reason-files/2024-02-07/05424aa27fd548313d77c3df4b952cb6f702f27f0f429fc00a29babc1d625693.pdf', 21, 'App\\Models\\FinalResult'),
(22, '2024-02-07 13:03:48', '2024-02-07 13:03:48', 'reason-files/2024-02-07/1544f117d957b0d793b5b3613a753a343bccf236d95ce71f04fba6f6f4fa5793.pdf', 22, 'App\\Models\\FinalResult'),
(23, '2024-02-07 13:57:09', '2024-02-07 13:57:09', 'reason-files/2024-02-07/c36b852922c3654d8ce8db0012cc8d6faea136adaa6257eb9e08caf22663a812.pdf', 23, 'App\\Models\\FinalResult'),
(24, '2024-02-07 14:08:39', '2024-02-07 14:08:39', 'reason-files/2024-02-07/86e345184d4375a9e01778401fd53df3615dad39d5acd1e839340bc81ba8947e.pdf', 24, 'App\\Models\\FinalResult'),
(25, '2024-02-07 14:15:50', '2024-02-07 14:15:50', 'reason-files/2024-02-07/b2f86f1fede800bcc70ebe878abcf2984b069dbaa7527bf531df964937b32c90.pdf', 25, 'App\\Models\\FinalResult'),
(26, '2024-02-07 14:43:20', '2024-02-07 14:43:20', 'reason-files/2024-02-07/3d7816311abcadc8924aaf65f78ec18b4fc3cde3c1017a42464feb735a9a80a8.pdf', 26, 'App\\Models\\FinalResult'),
(27, '2024-02-07 14:50:10', '2024-02-07 14:50:10', 'reason-files/2024-02-07/cdc295b896f468c7fa17e31354a71cc6d3bad4ad64b884577708ef41a0c5a895.pdf', 27, 'App\\Models\\FinalResult'),
(28, '2024-02-07 14:59:34', '2024-02-07 14:59:34', 'reason-files/2024-02-07/ad2ea9d08754a424bf365e5b56de448aa6969e9d6f54e111cd294a2c12cd1b53.pdf', 28, 'App\\Models\\FinalResult'),
(29, '2024-02-07 15:08:45', '2024-02-07 15:08:45', 'reason-files/2024-02-07/b13f5a8a0904f0d6671f0a261e564eb0bf3690e3f85e64ac72f2b9f3a4033783.pdf', 29, 'App\\Models\\FinalResult'),
(30, '2024-02-07 15:15:56', '2024-02-07 15:15:56', 'reason-files/2024-02-07/df94a4df3a94c2fcf078d975c39ab61a7a2d6f9a45b12eaf543ea2fef38d3729.pdf', 30, 'App\\Models\\FinalResult'),
(31, '2024-02-07 15:42:32', '2024-02-07 15:42:32', 'reason-files/2024-02-07/b45cdca766c7848182b98cbc7f5260f9560cbfb51dd4810634bb15faf2fcbda4.pdf', 31, 'App\\Models\\FinalResult'),
(32, '2024-02-08 11:18:47', '2024-02-08 11:18:47', 'reason-files/2024-02-08/c41c57a41dec7aa60bc85af22720d84b79a4d3439863b85568d90f7d3bd6a08c.pdf', 32, 'App\\Models\\FinalResult'),
(33, '2024-02-08 11:30:45', '2024-02-08 11:30:45', 'reason-files/2024-02-08/8ccfef480aedfc5f3b926ed5ae07491de745164d04db0e6650f25a0c23207623.pdf', 33, 'App\\Models\\FinalResult'),
(34, '2024-02-08 13:26:32', '2024-02-08 13:26:32', 'reason-files/2024-02-08/ef849fe87127bed3d20e99096df8410f6dd879e52a51f6d40771ec675702f8ee.pdf', 34, 'App\\Models\\FinalResult'),
(35, '2024-02-08 13:34:17', '2024-02-08 13:34:17', 'reason-files/2024-02-08/0907f55217cef153b00ea57759365e8f8de5e6108f4792e68548589c1430678e.pdf', 35, 'App\\Models\\FinalResult'),
(36, '2024-02-08 13:43:24', '2024-02-08 13:43:24', 'reason-files/2024-02-08/4f3eb8293ade2f9a5287d13a0eafb1a82b4bc0841ff990310a73b77dd43e0886.pdf', 36, 'App\\Models\\FinalResult'),
(37, '2024-02-08 13:48:42', '2024-02-08 13:48:42', 'reason-files/2024-02-08/df94ea1ef56a135729dca0a51847368c6e84ea477e2e4fbe3aeae1a9e40e432a.pdf', 37, 'App\\Models\\FinalResult'),
(38, '2024-02-08 13:57:54', '2024-02-08 13:57:54', 'reason-files/2024-02-08/4766189fba9cef39a611216113625bd223735dd8e34042ef3c226c7669275b54.pdf', 38, 'App\\Models\\FinalResult'),
(39, '2024-02-08 14:06:05', '2024-02-08 14:06:05', 'reason-files/2024-02-08/d236f4aa01d88f14d7dca6235db5a412aa86b2a248d4871b859ec534cb3dba7c.pdf', 39, 'App\\Models\\FinalResult'),
(40, '2024-02-08 14:52:41', '2024-02-08 14:52:41', 'reason-files/2024-02-08/7492a7689d142e1e0bf534586da7d33dfba416bff55eba9fe25c1fba9b1f81f8.pdf', 40, 'App\\Models\\FinalResult'),
(41, '2024-02-08 15:11:28', '2024-02-08 15:11:28', 'reason-files/2024-02-08/4ad6c3409c87bf937f710af9737d16a420e857398931ba3bbccd6cb260c3fe16.pdf', 41, 'App\\Models\\FinalResult'),
(42, '2024-02-08 15:37:34', '2024-02-08 15:37:34', 'reason-files/2024-02-08/1c9939453bbaa5b704d49b7efef76c3bf75a82b4a8a5c4d786242d242fec09ea.pdf', 42, 'App\\Models\\FinalResult'),
(43, '2024-02-08 15:52:37', '2024-02-08 15:52:37', 'reason-files/2024-02-08/d2bcdcbefa966b06aa6ab591c7f77e05af6379a8c011fff31fef07181432dc9c.pdf', 43, 'App\\Models\\FinalResult'),
(44, '2024-02-08 16:01:12', '2024-02-08 16:01:12', 'reason-files/2024-02-08/386eea0770572401425760640e03c7ac78f9a8cbf2f4809c276ac69bca30069b.pdf', 44, 'App\\Models\\FinalResult'),
(45, '2024-02-09 10:52:08', '2024-02-09 10:52:08', 'reason-files/2024-02-09/28d5ef83d3d784de9a5218d9877b4d9eb4f1a119d4b2dfd6f971a9007a0186e9.pdf', 45, 'App\\Models\\FinalResult'),
(46, '2024-02-09 11:05:47', '2024-02-09 11:05:47', 'reason-files/2024-02-09/9b5240eb22b1e5edd091e88496e1a8763e0c8813b9f1c20c1d51123871ae1954.pdf', 46, 'App\\Models\\FinalResult'),
(47, '2024-02-09 12:06:03', '2024-02-09 12:06:03', 'reason-files/2024-02-09/1a70f73dc9de9780eae11d4bc5e0faf11cf42bfd9d8c87a6fd1d43fa5ebd7df1.pdf', 47, 'App\\Models\\FinalResult'),
(48, '2024-02-09 12:13:59', '2024-02-09 12:13:59', 'reason-files/2024-02-09/bad930d6ac3788a4df36acf2968ddfd14281de902f1dd38b31895cbfbaf884d6.pdf', 48, 'App\\Models\\FinalResult'),
(49, '2024-02-09 12:19:07', '2024-02-09 12:19:07', 'reason-files/2024-02-09/6805ea0e579e7d782ed3f9ea566fe7ba4a53eb8a531b16e1115867c572684c4d.pdf', 49, 'App\\Models\\FinalResult'),
(50, '2024-02-09 12:22:52', '2024-02-09 12:22:52', 'reason-files/2024-02-09/be430763849c38178d9b2d6aecc9a6c6ddde9a539644405eca75c70532abe98a.pdf', 50, 'App\\Models\\FinalResult'),
(51, '2024-02-09 12:26:48', '2024-02-09 12:26:48', 'reason-files/2024-02-09/4fee06d6efb46fb5064268767ce4c47059c0ddaf6845c9e7d6d6592e7c7499e2.pdf', 51, 'App\\Models\\FinalResult'),
(52, '2024-02-09 12:30:18', '2024-02-09 12:30:18', 'reason-files/2024-02-09/152765c6ef2a42c0702604d2f6f3180adde347a08a67071652d3cfe17013e405.pdf', 52, 'App\\Models\\FinalResult'),
(53, '2024-02-09 15:25:02', '2024-02-09 15:25:02', 'reason-files/2024-02-09/0381ce1af098dd61b4132bce938ff90ef384491aa979fc3734e5dda2a1908d35.pdf', 53, 'App\\Models\\FinalResult'),
(54, '2024-02-09 15:29:02', '2024-02-09 15:29:02', 'reason-files/2024-02-09/bbfe91a5186362ac523d407195579ee585a28a6bf9795e8367080691860fafa3.pdf', 54, 'App\\Models\\FinalResult'),
(55, '2024-02-09 16:25:00', '2024-02-09 16:25:00', 'reason-files/2024-02-09/ef90e33eda3859a134e83d4923d9f84d19546194bc1891511bd2b75f352b1aac.pdf', 55, 'App\\Models\\FinalResult'),
(56, '2024-02-09 16:31:54', '2024-02-09 16:31:54', 'reason-files/2024-02-09/eca89227b8ddbfd39ed09f4def8bf8e84a2c6e5748d219d2507e575b920531e0.pdf', 56, 'App\\Models\\FinalResult'),
(57, '2024-02-09 16:37:41', '2024-02-09 16:37:41', 'reason-files/2024-02-09/9645780b208ca9cb907f514514d5979d372e60d9b32de7f07ca823aed35659e7.pdf', 57, 'App\\Models\\FinalResult'),
(58, '2024-02-09 16:47:21', '2024-02-09 16:47:21', 'reason-files/2024-02-09/25c9634d55135a986aab426ec6e1bc4d8e843fd345134d25ff2c99ba8eb47115.pdf', 58, 'App\\Models\\FinalResult'),
(59, '2024-02-09 17:01:55', '2024-02-09 17:01:55', 'reason-files/2024-02-09/a814a891e5450b2793565c4ffece0002ec2fc592b643fe79300ccba35f5f6672.PDF', 59, 'App\\Models\\FinalResult'),
(60, '2024-02-10 15:24:15', '2024-02-10 15:24:15', 'reason-files/2024-02-10/927ec34fc63eb21df9af271e353cb080f969adecd097b303f4db8ea6fbdb65f7.PDF', 60, 'App\\Models\\FinalResult'),
(61, '2024-02-10 15:24:57', '2024-02-10 15:24:57', 'reason-files/2024-02-10/12cc0ae60519271ecd4f9c7b71f9808605c63927f363022f56405d7a25046ebb.PDF', 61, 'App\\Models\\FinalResult'),
(62, '2024-02-10 15:26:04', '2024-02-10 15:26:04', 'reason-files/2024-02-10/49d856370db87082c443b4748d525d23624f2ff09add99856cc867ad422b6741.PDF', 62, 'App\\Models\\FinalResult'),
(63, '2024-02-10 15:34:33', '2024-02-10 15:34:33', 'reason-files/2024-02-10/e40c01abe70396f964301f2642f6c2d0282e0efcfffc6cd27b23f1442c00be24.pdf', 63, 'App\\Models\\FinalResult'),
(64, '2024-02-10 15:41:33', '2024-02-10 15:41:33', 'reason-files/2024-02-10/c2feda2f43b1a0856d2ff4da36b2e6d45c19dc68fbc3aebb2df567872e665413.pdf', 64, 'App\\Models\\FinalResult'),
(65, '2024-02-10 15:52:08', '2024-02-10 15:52:08', 'reason-files/2024-02-10/b52522510fe3a3db90e3b3901fa3a70b8e88cafbc3912ea3650f77c1dc728c20.PDF', 65, 'App\\Models\\FinalResult'),
(66, '2024-02-10 15:52:40', '2024-02-10 15:52:40', 'reason-files/2024-02-10/f9a6e6a0af45e9da592086364e42c5a4b6ad38b9b255b50cd18b691a0447051b.PDF', 66, 'App\\Models\\FinalResult'),
(67, '2024-02-10 15:59:10', '2024-02-10 15:59:10', 'reason-files/2024-02-10/b2494c473550208624c9d11f627590c3ebce767c269b69b80af75632ac5bd468.pdf', 67, 'App\\Models\\FinalResult'),
(68, '2024-02-10 16:06:37', '2024-02-10 16:06:37', 'reason-files/2024-02-10/3ab6d1446993ebe05714b0e682d867ea247f0e481423e2c4c619159a3f2b7c73.PDF', 68, 'App\\Models\\FinalResult'),
(69, '2024-02-10 16:13:21', '2024-02-10 16:13:21', 'reason-files/2024-02-10/92a65a8859ad9e28b98299b552fd1eacd687d784d5ed5e6d43c74e2a00e0f959.pdf', 69, 'App\\Models\\FinalResult'),
(70, '2024-02-10 16:20:15', '2024-02-10 16:20:15', 'reason-files/2024-02-10/26f3c36fe8dd415b28604f4368a94257693ca0281f9496d5a4b3ca0ffaf33851.pdf', 70, 'App\\Models\\FinalResult'),
(71, '2024-02-10 16:34:06', '2024-02-10 16:34:06', 'reason-files/2024-02-10/4a31853ad960508d021d4001ce1cc71478a86bf02cff87891e71cea16933d0f3.PDF', 71, 'App\\Models\\FinalResult'),
(72, '2024-02-10 16:39:15', '2024-02-10 16:39:15', 'reason-files/2024-02-10/49908737597884661a0166f573fe24b73eee76c062984d0d5bd8015c72931774.pdf', 72, 'App\\Models\\FinalResult'),
(73, '2024-02-10 16:45:20', '2024-02-10 16:45:20', 'reason-files/2024-02-10/a0d134c1eaf23e2ee2c008da5ff254a790f3978eb7c1e6d9c5dd9ad26c9f8d51.pdf', 73, 'App\\Models\\FinalResult'),
(74, '2024-02-10 16:51:33', '2024-02-10 16:51:33', 'reason-files/2024-02-10/5ad7ce078ae717a7d0a698f8caf9cc540d8ea99543c500b1beb14dff451ffe93.pdf', 74, 'App\\Models\\FinalResult'),
(75, '2024-02-10 17:00:45', '2024-02-10 17:00:45', 'reason-files/2024-02-10/41d5ec5b65d1bf17615c79807e309fc6966c5299ba0a4fdf4ef23b571921e04e.PDF', 75, 'App\\Models\\FinalResult'),
(76, '2024-02-10 17:20:35', '2024-02-10 17:20:35', 'reason-files/2024-02-10/9cafcc649c1ad64c01b551cdbc70c2d4daf2d76aecbde1e8b4f3eef4ee1d5bd8.pdf', 76, 'App\\Models\\FinalResult'),
(77, '2024-02-10 17:29:31', '2024-02-10 17:29:31', 'reason-files/2024-02-10/1a40cc9d968482d206bf5dd68ae2200744461de3293135a7ca13d0272b81d5f6.PDF', 77, 'App\\Models\\FinalResult'),
(78, '2024-02-10 17:36:31', '2024-02-10 17:36:31', 'reason-files/2024-02-10/0d6da669c3ed56be24980e7de1541d28a27b8aff52b7106e14a6d07e5a747b67.pdf', 78, 'App\\Models\\FinalResult'),
(79, '2024-02-10 17:42:48', '2024-02-10 17:42:48', 'reason-files/2024-02-10/4f9ea915d62eaa9a1c3a79d54f8b61d7092f85ee14b1804ade6f0d19ed6be950.pdf', 79, 'App\\Models\\FinalResult'),
(80, '2024-02-12 09:37:24', '2024-02-12 09:37:24', 'reason-files/2024-02-12/ab66c9e4e42ddbcce277d0312f01a071cab4bb065da2f0038495f7db67fdf14e.PDF', 80, 'App\\Models\\FinalResult'),
(81, '2024-02-12 09:46:02', '2024-02-12 09:46:02', 'reason-files/2024-02-12/37ff02938b2af36e585e21ea18f50e754d5867f6c904055cfe6683e11be35df3.pdf', 81, 'App\\Models\\FinalResult'),
(82, '2024-02-12 10:20:58', '2024-02-12 10:20:58', 'reason-files/2024-02-12/6fbe7066273300947b11cca5d6093748358e192ae34b13b91793355e400fc84e.PDF', 82, 'App\\Models\\FinalResult'),
(83, '2024-02-12 10:32:34', '2024-02-12 10:32:34', 'reason-files/2024-02-12/435d6e02913b77c788236d09359dc288ff491f27a93af59bd68b9193c03dab80.PDF', 83, 'App\\Models\\FinalResult'),
(84, '2024-02-12 10:51:38', '2024-02-12 10:51:38', 'reason-files/2024-02-12/e1a204fff3d4b9f9e7536215d6fec501586f62d5d2a2c8abe44b279ccb8359ae.pdf', 84, 'App\\Models\\FinalResult'),
(85, '2024-02-12 11:04:59', '2024-02-12 11:04:59', 'reason-files/2024-02-12/6ef5b9ecbce4963d2427c9771efabc22dee61ee7ee02d3ca0e2f2ccefab96ce5.PDF', 85, 'App\\Models\\FinalResult'),
(86, '2024-02-12 11:15:19', '2024-02-12 11:15:19', 'reason-files/2024-02-12/db0378ca7d0f86b0703aa198c2ae4f5e9c7dbf3de066e798fcb7c044093df414.pdf', 86, 'App\\Models\\FinalResult'),
(87, '2024-02-12 11:25:51', '2024-02-12 11:25:51', 'reason-files/2024-02-12/e107f4602499d618c0898e29ef5a52e337e4e39d8ecec82fd8c4d6a7528fd36e.pdf', 87, 'App\\Models\\FinalResult'),
(88, '2024-02-12 11:47:51', '2024-02-12 11:47:51', 'reason-files/2024-02-12/89b8bcc87d7a09532c1ce82ef6e80b32ac159cf1c7edff3f3585c8580d835d06.pdf', 88, 'App\\Models\\FinalResult'),
(89, '2024-02-12 12:00:14', '2024-02-12 12:00:14', 'reason-files/2024-02-12/e4f35a5f76177f076e459071f7664a931bfa5fd34c7e7a14c5bb3bfa686f566a.PDF', 89, 'App\\Models\\FinalResult'),
(90, '2024-02-12 12:07:39', '2024-02-12 12:07:39', 'reason-files/2024-02-12/9b699bc6b4116e5829fd00d6a6382c8cb66337c31945d7a4775699053e3c48ba.pdf', 90, 'App\\Models\\FinalResult'),
(91, '2024-02-12 12:21:10', '2024-02-12 12:21:10', 'reason-files/2024-02-12/177f02aec282e3747414070ef7157685dd252a58a8064fb881bc73c6218fed18.PDF', 91, 'App\\Models\\FinalResult'),
(92, '2024-02-12 12:49:43', '2024-02-12 12:49:43', 'reason-files/2024-02-12/7ddca60d6a832d356227d55fe8c8481b9c5d7cde54cffc559af4066e667fe005.PDF', 92, 'App\\Models\\FinalResult'),
(93, '2024-02-12 12:57:01', '2024-02-12 12:57:01', 'reason-files/2024-02-12/806c3e162320f8454813ade05990a0ac8a930e0dae70df282f1bd808e5660637.pdf', 93, 'App\\Models\\FinalResult'),
(94, '2024-02-12 13:03:14', '2024-02-12 13:03:14', 'reason-files/2024-02-12/fc1b26736a8ae0173ccc7f7877f793fe34790ebc040a58f3d208f69298b0703b.pdf', 94, 'App\\Models\\FinalResult'),
(95, '2024-02-12 13:11:07', '2024-02-12 13:11:07', 'reason-files/2024-02-12/139ab381caa418bc7e2d10a672b762515a2eaa0ff2e289f654736f52fa1f231c.PDF', 95, 'App\\Models\\FinalResult'),
(96, '2024-02-12 13:17:19', '2024-02-12 13:17:19', 'reason-files/2024-02-12/d67cbc67f0146d7ce149c5d68c7ad0855458551d2728f1a88bbcc376498180d0.pdf', 96, 'App\\Models\\FinalResult'),
(97, '2024-02-12 13:23:34', '2024-02-12 13:23:34', 'reason-files/2024-02-12/57efc4e2bf16bcadcd585f729d653d397e9206ffab414508178f09f0a36adc72.PDF', 97, 'App\\Models\\FinalResult'),
(98, '2024-02-12 13:28:44', '2024-02-12 13:28:44', 'reason-files/2024-02-12/756a86149cdfc98d1974e25ec525f4982d3f890ca78528b2f0743758cee66fd7.pdf', 98, 'App\\Models\\FinalResult'),
(99, '2024-02-12 13:39:16', '2024-02-12 13:39:16', 'reason-files/2024-02-12/42e1d87628006c418e1c1055b6cca191ecde9c232959d5c988f9ed357e93c4d4.PDF', 99, 'App\\Models\\FinalResult'),
(100, '2024-02-12 13:50:02', '2024-02-12 13:50:02', 'reason-files/2024-02-12/175eac0a9431ce9e63fc6ab9d02c80203f46e9ec7695ab4593172298002f891f.PDF', 100, 'App\\Models\\FinalResult'),
(101, '2024-02-12 14:21:49', '2024-02-12 14:21:49', 'reason-files/2024-02-12/d9c19f820488255ee7cf0fdc5a7ccf54a19cb17c8313d3d6c91ce6a064bbf0e6.pdf', 101, 'App\\Models\\FinalResult'),
(102, '2024-02-12 14:25:34', '2024-02-12 14:25:34', 'reason-files/2024-02-12/0aa9e5332ebf463a259d289f5a5f5ae6e9039bf0156898cde9847460937185ab.pdf', 102, 'App\\Models\\FinalResult'),
(103, '2024-02-12 14:32:44', '2024-02-12 14:32:44', 'reason-files/2024-02-12/b1d093862a68618e46ddb1431f12d80c6a5dd7ce2a8fd4059547bffd1a9d00f0.pdf', 103, 'App\\Models\\FinalResult'),
(104, '2024-02-12 14:36:54', '2024-02-12 14:36:54', 'reason-files/2024-02-12/4f5b791248f5d0467c63195864bcb9fcbe0ade372666c6a64315f4a923b63a99.pdf', 104, 'App\\Models\\FinalResult'),
(105, '2024-02-12 14:58:14', '2024-02-12 14:58:14', 'reason-files/2024-02-12/f4506d990bc6dd08b07751d24c5ecc3c676da55928065cce849de55f0947fd3b.pdf', 105, 'App\\Models\\FinalResult'),
(106, '2024-02-12 15:02:20', '2024-02-12 15:02:20', 'reason-files/2024-02-12/b9773c7be4209db88ac8987bc679691a392c87fac82749aae93c79e2ef1bc30f.pdf', 106, 'App\\Models\\FinalResult'),
(107, '2024-02-12 15:13:46', '2024-02-12 15:13:46', 'reason-files/2024-02-12/9b028b50e6f9fcf79dbaf2f92ef27530fee4f3915b8cf9c9471500b709827a9d.PDF', 107, 'App\\Models\\FinalResult'),
(108, '2024-02-13 13:32:25', '2024-02-13 13:32:25', 'reason-files/2024-02-13/a3c11bf08bfcab6435ab8b224fbbc044b16758e32c34d2c67229d3e976dbb6b5.PDF', 108, 'App\\Models\\FinalResult'),
(109, '2024-02-13 13:42:21', '2024-02-13 13:42:21', 'reason-files/2024-02-13/f7e6d18babd8fe611f8125d990d1e1ba70c0b27d44ce06a1c2f8583eb51dee75.PDF', 109, 'App\\Models\\FinalResult'),
(110, '2024-02-13 13:48:53', '2024-02-13 13:48:53', 'reason-files/2024-02-13/7976f85ede97335a8847958a6358eff7b62329a838092c81f5fa32f2da3ac75b.pdf', 110, 'App\\Models\\FinalResult'),
(111, '2024-02-13 14:03:04', '2024-02-13 14:03:04', 'reason-files/2024-02-13/9280ac3154a6affb9af2e1746ef85022e9ea9a7fe0c2e84e26043912d43ad0d0.PDF', 111, 'App\\Models\\FinalResult'),
(112, '2024-02-13 14:24:47', '2024-02-13 14:24:47', 'reason-files/2024-02-13/03b056a4ddc06a8b399510de2fa91f34e3b59d5436632bdd13f1bab6a315d24c.PDF', 112, 'App\\Models\\FinalResult'),
(113, '2024-02-13 15:10:48', '2024-02-13 15:10:48', 'reason-files/2024-02-13/5df5b786fcd68af49d2bc9a30570aff24052e914f767c4cebcb5b785d6ce1f1b.PDF', 113, 'App\\Models\\FinalResult'),
(114, '2024-02-13 15:19:33', '2024-02-13 15:19:33', 'reason-files/2024-02-13/73cb172869ff260aec26b3a56f63e1d1dccdd7d8610daef5360ce2b3a679cf5e.PDF', 114, 'App\\Models\\FinalResult'),
(115, '2024-02-13 15:28:02', '2024-02-13 15:28:02', 'reason-files/2024-02-13/6a0260ec6a8bb58517158f3d60ef645610e7ccfacb112582b2eb12ca6633e6f4.PDF', 115, 'App\\Models\\FinalResult'),
(116, '2024-02-13 17:28:11', '2024-02-13 17:28:11', 'reason-files/2024-02-13/15518b3989766e16e44001cd935c25b3323c5184ffcbed6c957bd18e4877500b.pdf', 116, 'App\\Models\\FinalResult'),
(117, '2024-02-13 17:41:33', '2024-02-13 17:41:33', 'reason-files/2024-02-13/e76ea1e8f408c7671a4d7e73b7e3bbda5fe01e5f98a72b5f770d076f6a0a4f9e.pdf', 117, 'App\\Models\\FinalResult'),
(118, '2024-02-13 17:50:53', '2024-02-13 17:50:53', 'reason-files/2024-02-13/200d3f97adceb7e63da3f8cf710ef94f63bfea8cf6d0f7b26ff34c863d65c62b.pdf', 118, 'App\\Models\\FinalResult'),
(119, '2024-02-13 18:06:14', '2024-02-13 18:06:14', 'reason-files/2024-02-13/1978411aa590bbf9231e1e0edfbdac8f473702ff86ade132bf5996c7c7fe8893.PDF', 119, 'App\\Models\\FinalResult'),
(120, '2024-02-15 14:08:22', '2024-02-15 14:08:22', 'reason-files/2024-02-15/cd921f8312e95a5103b905bc81b83f995463b57b67779a1d314220bc70aa22a0.PDF', 120, 'App\\Models\\FinalResult'),
(121, '2024-02-15 16:51:56', '2024-02-15 16:51:56', 'reason-files/2024-02-15/cb1798d455f4485a42c35855193d521869b159413ac2d6589895380b98a479d5.pdf', 121, 'App\\Models\\FinalResult'),
(122, '2024-02-15 16:58:19', '2024-02-15 16:58:19', 'reason-files/2024-02-15/d448c9a7ca7d94f8c942fb2b76144063d83db9d5874e07121dc7a9c22a3870bd.pdf', 122, 'App\\Models\\FinalResult'),
(123, '2024-02-16 11:26:53', '2024-02-16 11:26:53', 'reason-files/2024-02-16/63551846f111e9cdf3a889d765f22ff6c714d5d548dc8e1d115756724c655bcb.pdf', 123, 'App\\Models\\FinalResult'),
(124, '2024-02-19 13:21:30', '2024-02-19 13:21:30', 'reason-files/2024-02-19/82ddd99d553114c286a5b1c9aaab667671bf5f7e1e2d3a52313fc700f3ca1e1a.PDF', 124, 'App\\Models\\FinalResult'),
(125, '2024-02-19 13:31:05', '2024-02-19 13:31:05', 'reason-files/2024-02-19/b611bba7de9f0cef8f1f69bd90249cb5d9f0dbe93e95cca153001f4ad83b99b8.pdf', 125, 'App\\Models\\FinalResult'),
(126, '2024-02-19 13:40:00', '2024-02-19 13:40:00', 'reason-files/2024-02-19/26759474486db8d100e4d08fbdfd2c354353e78e9a2f7eeeca298784f05ab103.pdf', 126, 'App\\Models\\FinalResult'),
(127, '2024-02-19 13:50:14', '2024-02-19 13:50:14', 'reason-files/2024-02-19/3c0d5b3a630adc3b3c5f7dd248a32648921451ce1652194820a40ec42fca3ac6.PDF', 127, 'App\\Models\\FinalResult'),
(128, '2024-02-19 13:58:39', '2024-02-19 13:58:39', 'reason-files/2024-02-19/4d22b39b4aec586e8d98bf0cc5168485a5706f8af0be7707029069353b85c690.pdf', 128, 'App\\Models\\FinalResult'),
(129, '2024-02-21 11:26:57', '2024-02-21 11:26:57', 'reason-files/2024-02-21/6752096e6810faf63a42aea994ff689027f88782c901135c570438ec682c1f64.pdf', 129, 'App\\Models\\FinalResult'),
(130, '2024-02-21 11:31:55', '2024-02-21 11:31:55', 'reason-files/2024-02-21/ce1aebd4151df2b82182dadf345dfeb21c3b4b481456130b7c3d4331c8c793c2.pdf', 130, 'App\\Models\\FinalResult'),
(131, '2024-02-21 11:44:15', '2024-02-21 11:44:15', 'reason-files/2024-02-21/79979951259629d15011dec4a3f199bafd910f7426f0e636c246897dc8874bea.pdf', 131, 'App\\Models\\FinalResult'),
(132, '2024-02-21 11:55:41', '2024-02-21 11:55:41', 'reason-files/2024-02-21/914303693fc6dc70513aecb121591746e0cb00f592c91b48270bc9d25f63e414.pdf', 132, 'App\\Models\\FinalResult'),
(133, '2024-02-23 15:11:04', '2024-02-23 15:11:04', 'reason-files/2024-02-23/4108ddb5e586a6775fb8e04398115b97d81586a6f3584f60f67a660b231f3c44.pdf', 133, 'App\\Models\\FinalResult'),
(134, '2024-02-26 12:45:56', '2024-02-26 12:45:56', 'reason-files/2024-02-26/23959f2d6329c6f6b9dd1367af1b776a0725a0e2551222a844653df68efaf297.pdf', 134, 'App\\Models\\FinalResult'),
(135, '2024-02-27 17:12:59', '2024-02-27 17:12:59', 'reason-files/2024-02-27/a83cd4a712ef9c54888a68eccfa150f4f8fb6a0afa6e3be0a35ed26f1d0d86ac.pdf', 135, 'App\\Models\\FinalResult'),
(136, '2024-02-28 16:30:45', '2024-02-28 16:30:45', 'reason-files/2024-02-28/392377b90e89ead8bd077ab118e030e2300433cfecb809befdd79822b3e19710.pdf', 136, 'App\\Models\\FinalResult'),
(137, '2024-02-29 10:12:28', '2024-02-29 10:12:28', 'reason-files/2024-02-29/90749cb015a3f86db8b6c8236c4cd29d4568a760ccffd8c13081ebe9afb2019c.pdf', 137, 'App\\Models\\FinalResult'),
(138, '2024-02-29 10:17:43', '2024-02-29 10:17:43', 'reason-files/2024-02-29/9459c109afd3c18b2374db0f3ac1ab608acfd8cbf2f118c25853738b2c369637.pdf', 138, 'App\\Models\\FinalResult'),
(139, '2024-02-29 10:24:52', '2024-02-29 10:24:52', 'reason-files/2024-02-29/f021cf7a1f184d74b59b8d77d4b8072c6100e55da36d220d658893c6ade62030.pdf', 139, 'App\\Models\\FinalResult'),
(140, '2024-02-29 10:29:08', '2024-02-29 10:29:08', 'reason-files/2024-02-29/47985fb45932dd66f4ad4e117a1ac7799bb52cd67a5223bbf2842b59e4148721.pdf', 140, 'App\\Models\\FinalResult'),
(141, '2024-02-29 10:32:54', '2024-02-29 10:32:54', 'reason-files/2024-02-29/6054b2aa8a7c756b604b6f9c2c493ee6f6e0250b40b834fcba5d816882f7d38c.pdf', 141, 'App\\Models\\FinalResult'),
(142, '2024-02-29 10:42:30', '2024-02-29 10:42:30', 'reason-files/2024-02-29/5f27353b2b8843725eed3a9b35024ebbb43d653e0afaaaf8b53766942c5de0d5.pdf', 142, 'App\\Models\\FinalResult');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_dev`
--

CREATE TABLE `certificate_dev` (
  `id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crops_name`
--

CREATE TABLE `crops_name` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodtnved` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` INT NULL,
  `measure_type` int(2) DEFAULT 1,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops_name`
--

INSERT INTO `crops_name` (`id`, `name`, `kodtnved`, `measure_type`, `img`, `created_at`, `updated_at`) VALUES
(25, 'Yumshoq Bug\'doy', '1001990000', 1, 'default.png', '2024-01-30 12:03:55', '2024-01-30 16:41:31'),
(26, 'Bug\'doy uni', '1101001509', 1, 'default.png', '2024-01-30 14:19:13', '2024-02-12 09:20:56'),
(28, 'Sholi doni', '1006102300', 1, 'default.png', '2024-02-07 12:35:23', '2024-02-07 12:35:23'),
(29, 'Guruch yormasi', '1103195000', 1, 'default.png', '2024-02-07 14:18:19', '2024-02-07 14:18:19'),
(30, 'No\'xot yormasi', '0713109009', 1, 'default.png', '2024-02-08 15:16:38', '2024-02-08 15:16:38'),
(31, 'Grechka yormasi', '1103199009', 1, 'default.png', '2024-02-08 15:39:05', '2024-02-08 15:39:05'),
(32, 'Arpa; pivo uchun arpa.', '1003900000', 1, 'default.png', '2024-02-12 09:54:10', '2024-02-27 11:37:06'),
(33, 'Javdar', '1002900000', 1, 'default.png', '2024-02-27 11:07:56', '2024-02-27 11:38:23'),
(34, 'Suli', '1004900000', 1, 'default.png', '2024-02-27 11:15:05', '2024-02-27 11:38:32'),
(35, 'Makkajo\'xori', '1005900000', 1, 'default.png', '2024-02-27 11:16:40', '2024-02-27 11:16:40'),
(36, 'Guruch (guruch: tozalanmagan guruch (xom guruch))', '1006102100', 1, 'default.png', '2024-02-27 11:18:20', '2024-02-27 11:35:52'),
(37, 'Qattiq bug\'doy', '1001190000', 1, 'default.png', '2024-02-27 11:25:15', '2024-02-27 11:25:15'),
(38, 'Sorgo', '1007900000', 1, 'default.png', '2024-02-27 11:29:04', '2024-02-27 11:29:04'),
(39, 'No\'xat (maydalangan yoki maydalangan emas)', '0713109009', 1, 'default.png', '2024-02-27 11:30:36', '2024-02-27 11:30:36'),
(40, 'Нут  (maydalangan yoki maydalangan emas)', '0713200000', 1, 'default.png', '2024-02-27 11:41:26', '2024-02-27 11:41:44'),
(41, 'Oziq-ovqat uchun loviya. (Maydalangan yoki maydalanmagan: loviya: mayda qizil, mung loviya, oddiy, mayda urug\'li oq, bambar yong\'og\'i va sigir no\'xati)', '0713310001', 1, 'default.png', '2024-02-27 11:43:51', '2024-02-27 11:43:51'),
(42, 'Soya. (Soya, maydalangan yoki maydalanmagan)', '1201900000', 1, 'default.png', '2024-02-27 11:44:51', '2024-02-27 11:44:51'),
(43, 'Kunjut qayta ishlash uchun. (Yog\'li ekinlar. Kunjut urug\'lari)', '1207409000', 1, 'default.png', '2024-02-27 11:48:01', '2024-02-27 11:48:01'),
(44, 'Yong\'oq. (Yong\'oq, qovurilmagan maydalangan yoki maydalanmagan: tozalanmagan, tozalangan)', '1202410000', 1, 'default.png', '2024-02-27 11:49:35', '2024-02-27 11:49:35'),
(45, 'Raps urug\'lari. (Raps urug\'lari yoki raps, maydalangan yoki maydalanmagan)', '1205900009', 1, 'default.png', '2024-02-27 11:52:18', '2024-02-27 11:52:18'),
(46, 'Kungaboqar. (Kungaboqar urug\'lari, maydalangan yoki maydalanmagan)', '1206009100', 1, 'default.png', '2024-02-27 11:53:06', '2024-02-27 11:53:06'),
(47, 'Xantal urug\'lari. (Maydalangan yoki maydalanmagan: xantal urug\'lari)', '1207509000', 1, 'default.png', '2024-02-27 11:54:02', '2024-02-27 11:54:02'),
(48, 'Saflor qayta ishlash uchun. (Ezilgan yoki maydalanmagan: saflor urug\'lari (Carthamus tinctorius))', '1207600000', 1, 'default.png', '2024-02-27 11:57:42', '2024-02-27 11:57:42'),
(49, 'Grechixa. Tariq. (Grechixa, tariq va kanareyka urug\'lari; boshqa donlar: tariq: boshqalar;', '1008290000', 1, 'default.png', '2024-02-27 12:00:57', '2024-02-27 12:00:57'),
(50, 'Javdar uni. (Bug\'doy yoki bug\'doy javdaridan tashqari boshqa donli donlardan un: javdar uni)', '1102907000', 1, 'default.png', '2024-02-27 12:04:04', '2024-02-27 12:04:04'),
(51, 'Makkajo\'xori uni. (Bug\'doy yoki bug\'doy javdaridan tashqari boshqa donlardan tayyorlangan un: makkajo\'xori uni:)', '1102209000', 1, 'default.png', '2024-02-27 12:17:35', '2024-02-27 12:17:35'),
(52, 'Bug\'doy yormasi (Poltava, \"Artek\").; Maydalangan tariq; ovsyanka yormasi; grechixa yormasi; Arpa yormasi; Makkajo\'xori yormasi; Guruch yormasi.; Maydalangan bug\'doy yormasi; Manka yormasi; Yumshoq bug\'doydan tayyorlangan bug\'doy yormasi.', '1103111000', 1, 'default.png', '2024-02-27 12:24:28', '2024-02-27 12:24:28'),
(53, 'Ovsyanka tolokno; Xlopya ovsyanka. (Donli don, boshqa usullar bilan qayta ishlangan (masalan, po\'stloq, pechak, yormaga qayta ishlangan, kesilgan yoki maydalangan)', '1104121000', 1, 'default.png', '2024-02-27 12:29:34', '2024-02-27 12:29:34'),
(54, 'Tozalangan no\'xat. (Sabzavotlar dukkaklilar quritilgan, tozalangan, urug \' po\'stidan tozalangan yoki tozalanmagan, maydalangan yoki maydalangan emas: no\'xat (Pisum sativum))', '0713109009', 1, 'default.png', '2024-02-27 12:31:27', '2024-02-27 12:31:27'),
(55, 'Qayta ishlash uchun moyli Mak. (Boshqa moyli o\'simliklarning urug\'lari va mevalari, maydalangan yoki maydalanmagan, mak urug\'lari)', '1207919000', 1, 'default.png', '2024-02-27 12:33:09', '2024-02-27 12:33:09'),
(56, 'Bug\'doy kepagi; Javdar kepagi. (Kepak, ekish, don yoki dukkakli ekinlar donini elakdan o\'tkazish, maydalash yoki qayta ishlashning boshqa usullaridan qolgan boshqa qoldiqlar, granulyatsiya qilinmagan yoki donador: bug\'doy)', '2302409000', 1, 'default.png', '2024-02-27 12:34:48', '2024-02-27 12:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `crops_type`
--

CREATE TABLE `crops_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops_type`
--

INSERT INTO `crops_type` (`id`, `name`, `crop_id`, `created_at`, `updated_at`) VALUES
(187, 'Birinchi nav', 26, '2024-01-30 14:19:55', '2024-01-30 14:19:55'),
(188, '3 sinf', 25, '2024-01-31 12:59:51', '2024-01-31 12:59:51'),
(189, '4 sinf', 25, '2024-01-31 13:08:52', '2024-01-31 13:08:52'),
(190, '5 sinf', 25, '2024-01-31 13:09:01', '2024-01-31 13:09:01'),
(191, 'Oliy nav', 26, '2024-01-31 13:09:27', '2024-01-31 13:09:27'),
(192, 'Ikkinchi nav', 26, '2024-01-31 13:09:45', '2024-01-31 13:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `crop_data`
--

CREATE TABLE `crop_data` (
  `id` int(11) NOT NULL,
  `name_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `kodtnved` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure_type` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `sxeme_number` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crop_data`
--

INSERT INTO `crop_data` (`id`, `name_id`, `type_id`, `kodtnved`, `measure_type`, `amount`, `sxeme_number`, `year`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 25, NULL, '1001990000', 2, 5725000, 7, 2021, 234, '2024-01-30 12:29:31', '2024-01-30 12:29:31'),
(2, 26, 187, '1101001509', 2, NULL, 3, NULL, 234, '2024-01-30 15:45:10', '2024-01-30 15:45:10'),
(4, 25, NULL, '1001990000', 2, 7000000, 7, 2023, 234, '2024-01-30 16:40:50', '2024-01-30 16:40:50'),
(5, 25, NULL, '1001990000', 2, 17200000, 7, 2022, 234, '2024-01-30 16:58:29', '2024-01-30 16:58:29'),
(6, 25, NULL, '1001990000', 2, 43797000, 7, 2021, 234, '2024-01-30 17:16:10', '2024-01-30 17:16:10'),
(7, 25, NULL, '1001990000', 2, 60053000, 7, 2022, 234, '2024-01-30 17:25:18', '2024-01-30 17:25:18'),
(8, 25, NULL, '1001990000', 2, 830950, 7, 2023, 112, '2024-01-30 17:52:31', '2024-01-30 17:52:31'),
(9, 25, NULL, '1001990000', 2, 560000, 7, 2023, 112, '2024-01-30 18:04:05', '2024-01-30 18:04:05'),
(10, 25, NULL, '1001990000', 2, 6785350, 7, 2022, 234, '2024-01-31 09:54:19', '2024-01-31 09:54:19'),
(11, 25, NULL, '1001990000', 2, 7641140, 7, 2022, 234, '2024-01-31 10:23:29', '2024-01-31 10:23:29'),
(12, 25, NULL, '1001990000', 2, 19284180, 7, 2022, 234, '2024-01-31 10:36:26', '2024-01-31 10:36:26'),
(13, 25, NULL, '1001990000', 2, 2696460, 7, 2022, 234, '2024-01-31 11:01:40', '2024-01-31 11:01:40'),
(14, 25, NULL, '1001990000', 2, 18135910, 7, 2022, 234, '2024-01-31 11:17:00', '2024-01-31 11:17:00'),
(15, 26, 187, '1101001509', 2, NULL, 3, 2024, 234, '2024-01-31 11:47:55', '2024-01-31 11:47:55'),
(16, 25, 188, '1001990000', 1, 490, 7, 2022, 112, '2024-02-07 11:16:11', '2024-02-07 11:39:45'),
(17, 25, 188, '1001990000', 1, 65, 7, 2022, 112, '2024-02-07 11:38:07', '2024-02-07 11:38:07'),
(18, 25, 188, '1001990000', 1, 140, 7, 2022, 112, '2024-02-07 11:47:27', '2024-02-07 11:47:27'),
(19, 25, 188, '1001990000', 1, 2660, 7, 2022, 112, '2024-02-07 12:05:41', '2024-02-07 12:05:41'),
(20, 25, 188, '1001990000', 1, 695, 7, 2022, 112, '2024-02-07 12:12:26', '2024-02-07 12:12:26'),
(21, 25, 188, '1001990000', 1, 490, 7, 2022, 112, '2024-02-07 12:23:06', '2024-02-07 12:23:06'),
(22, 25, 188, '1001990000', 1, 350, 7, 2022, 112, '2024-02-07 12:28:12', '2024-02-07 12:28:12'),
(23, 28, NULL, '1006102300', 1, 1791.46, 7, 2022, 234, '2024-02-07 12:45:23', '2024-02-07 12:45:23'),
(24, 28, NULL, '1006102300', 1, 7811.3, 7, 2022, 234, '2024-02-07 13:50:10', '2024-02-07 13:50:10'),
(25, 28, NULL, '1006102300', 1, 2728, 7, 2022, 234, '2024-02-07 14:03:31', '2024-02-07 14:03:31'),
(26, 25, 188, '1001990000', 1, 70, 7, 2022, 112, '2024-02-07 14:12:01', '2024-02-07 14:12:01'),
(27, 29, NULL, '1103195000', 1, 700, 7, 2022, 234, '2024-02-07 14:35:58', '2024-02-07 14:35:58'),
(28, 25, 188, '1001990000', 1, 140, 7, 2022, 112, '2024-02-07 14:45:01', '2024-02-07 14:45:01'),
(29, 28, NULL, '1006102300', 1, 2071.33, 7, 2022, 234, '2024-02-07 14:55:18', '2024-02-07 14:55:18'),
(30, 28, NULL, '1006102300', 1, 3300, 7, 2022, 234, '2024-02-07 15:04:27', '2024-02-07 15:04:27'),
(31, 29, NULL, '1103195000', 1, 1350, 7, 2022, 234, '2024-02-07 15:10:52', '2024-02-07 15:10:52'),
(32, 26, 191, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-07 15:37:01', '2024-02-07 15:37:01'),
(33, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-08 11:12:50', '2024-02-08 11:12:50'),
(34, 28, NULL, '1006102300', 1, 795, 7, 2022, 234, '2024-02-08 11:23:03', '2024-02-08 11:23:03'),
(35, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-08 13:20:53', '2024-02-08 13:20:53'),
(36, 29, NULL, '1103195000', 1, 346, 7, 2023, 234, '2024-02-08 13:28:19', '2024-02-08 13:28:19'),
(37, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-08 13:38:28', '2024-02-08 13:38:28'),
(38, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-08 13:44:51', '2024-02-08 13:44:51'),
(39, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-08 13:53:01', '2024-02-08 13:53:01'),
(40, 25, 188, '1001990000', 1, 23000, 7, 2021, 234, '2024-02-08 14:01:49', '2024-02-08 14:01:49'),
(41, 26, 187, '1101001509', NULL, NULL, 3, NULL, 234, '2024-02-08 14:46:17', '2024-02-08 14:46:17'),
(42, 26, 187, '1101001509', NULL, NULL, 3, NULL, 234, '2024-02-08 15:06:54', '2024-02-08 15:06:54'),
(43, 30, NULL, '0713109009', 1, 81.7, 7, NULL, 181, '2024-02-08 15:29:45', '2024-02-08 15:29:45'),
(44, 31, NULL, '1103199009', 1, 16.2, 7, NULL, 112, '2024-02-08 15:47:34', '2024-02-08 15:47:34'),
(45, 25, 188, '1001990000', 1, 5000, 7, 2023, 234, '2024-02-08 15:57:14', '2024-02-08 15:57:14'),
(46, 25, 188, '1001990000', 1, 3205, 7, 2022, 112, '2024-02-09 10:46:39', '2024-02-09 10:46:39'),
(47, 25, 188, '1001990000', 1, 12000, 7, 2023, 234, '2024-02-09 11:00:54', '2024-02-09 11:00:54'),
(48, 25, 188, '1001990000', 1, 1315.8, 7, 2023, 234, '2024-02-09 12:01:25', '2024-02-09 12:01:25'),
(49, 25, 188, '1001990000', 1, 9388.5, 7, 2023, 234, '2024-02-09 12:10:43', '2024-02-09 12:10:43'),
(50, 25, 188, '1001990000', 1, 5066.8, 7, 2023, 234, '2024-02-09 12:15:29', '2024-02-09 15:30:34'),
(51, 25, 188, '1001990000', 1, 11782.2, 7, 2023, 234, '2024-02-09 12:20:03', '2024-02-09 15:30:55'),
(52, 25, 188, '1001990000', 1, 7625.8, 7, 2023, 234, '2024-02-09 12:23:53', '2024-02-09 12:23:53'),
(53, 25, 188, '1001990000', 1, 9571.5, 7, 2023, 234, '2024-02-09 12:27:50', '2024-02-09 12:27:50'),
(54, 25, 188, '1001990000', 1, 10002, 7, 2023, 234, '2024-02-09 14:20:27', '2024-02-09 14:20:27'),
(55, 25, 188, '1001990000', 1, 15058, 7, 2023, 234, '2024-02-09 15:26:10', '2024-02-09 15:26:10'),
(56, 25, 188, '1001990000', 1, 7540, 7, 2023, 234, '2024-02-09 15:53:28', '2024-02-09 15:53:28'),
(57, 25, 188, '1001990000', 1, 6299.9, 7, 2023, 234, '2024-02-09 16:27:42', '2024-02-09 16:27:42'),
(58, 25, 188, '1001990000', 1, 3900, 7, 2023, 234, '2024-02-09 16:34:13', '2024-02-09 16:34:13'),
(59, 25, 188, '1001990000', 1, 2501.1, 7, 2023, 234, '2024-02-09 16:43:10', '2024-02-09 16:43:10'),
(60, 25, NULL, '1001990000', 1, 21077, 7, 2023, 234, '2024-02-09 16:52:01', '2024-02-09 16:52:01'),
(61, 25, NULL, '1001990000', 1, 54305, 7, 2023, 234, '2024-02-09 23:15:24', '2024-02-09 23:15:24'),
(62, 25, NULL, '1001990000', 1, 40000, 7, 2023, 234, '2024-02-10 15:31:11', '2024-02-10 15:31:11'),
(63, 25, NULL, '1001990000', 1, 688, 7, 2023, 234, '2024-02-10 15:38:37', '2024-02-10 15:38:37'),
(64, 25, NULL, '1001990000', 1, 18981.99, 7, 2023, 234, '2024-02-10 15:43:22', '2024-02-10 15:43:22'),
(65, 25, NULL, '1001990000', 1, 17155.74, 7, 2023, 234, '2024-02-10 15:55:49', '2024-02-10 15:55:49'),
(66, 25, NULL, '1001990000', 1, 32906.5, 7, 2023, 234, '2024-02-10 16:03:08', '2024-02-10 16:03:08'),
(67, 25, NULL, '1001990000', 1, 10831.16, 7, 2023, 234, '2024-02-10 16:10:41', '2024-02-10 16:10:41'),
(68, 25, NULL, '1001990000', 1, 4604, 7, 2023, 234, '2024-02-10 16:15:42', '2024-02-10 16:15:42'),
(69, 25, NULL, '1001990000', 1, 108700, 7, 2023, 234, '2024-02-10 16:30:45', '2024-02-10 16:30:45'),
(70, 25, NULL, '1001990000', 1, 508.26, 7, 2023, 234, '2024-02-10 16:36:41', '2024-02-10 16:36:41'),
(71, 25, NULL, '1001990000', 1, 28500, 7, 2023, 234, '2024-02-10 16:42:13', '2024-02-10 16:42:13'),
(72, 25, NULL, '1001990000', 1, 1700, 7, 2023, 234, '2024-02-10 16:48:02', '2024-02-10 16:48:02'),
(73, 25, NULL, '1001990000', 2, 27079.7, 7, 2023, 234, '2024-02-10 16:57:02', '2024-02-10 16:57:02'),
(74, 25, NULL, '1001990000', 1, 14000, 7, 2023, 234, '2024-02-10 17:17:50', '2024-02-10 17:17:50'),
(75, 25, NULL, '1001990000', 1, 47481, 7, 2023, 234, '2024-02-10 17:26:33', '2024-02-10 17:26:33'),
(76, 26, 187, '1101001509', NULL, NULL, 3, NULL, 234, '2024-02-10 17:32:00', '2024-02-10 17:32:00'),
(77, 25, NULL, '1001990000', 1, 7050.62, 7, 2023, 234, '2024-02-10 17:39:17', '2024-02-10 17:39:17'),
(78, 25, NULL, '1001990000', 1, 43600, 7, 2023, 234, '2024-02-12 09:33:22', '2024-02-12 09:33:22'),
(79, 25, NULL, '1001990000', 1, 14419.69, 7, 2023, 234, '2024-02-12 09:41:55', '2024-02-12 09:41:55'),
(80, 25, NULL, '1001990000', 1, 27908.82, 7, 2023, 234, '2024-02-12 10:11:01', '2024-02-12 10:11:01'),
(81, 32, NULL, '1003900000', 1, 11742.32, 7, 2023, 234, '2024-02-12 10:23:54', '2024-02-12 10:23:54'),
(82, 25, NULL, '1001990000', 1, 18685, 7, 2023, 234, '2024-02-12 10:48:13', '2024-02-12 10:48:13'),
(83, 25, NULL, '1001990000', NULL, 125547, 7, 2023, 234, '2024-02-12 11:01:33', '2024-02-12 11:01:33'),
(84, 25, NULL, '1001990000', 1, 4200, 7, 2023, 234, '2024-02-12 11:10:19', '2024-02-12 11:14:12'),
(85, 25, NULL, '1001990000', 1, 7253.74, 7, 2023, 234, '2024-02-12 11:20:30', '2024-02-12 11:20:30'),
(86, 25, NULL, '1001990000', 1, 15100, 7, 2023, 234, '2024-02-12 11:44:45', '2024-02-12 11:44:45'),
(87, 25, NULL, '1001990000', 1, 45102.2, 7, 2023, 234, '2024-02-12 11:56:20', '2024-02-12 11:56:20'),
(88, 25, NULL, '1001990000', 1, 4000, 7, 2023, 234, '2024-02-12 12:04:04', '2024-02-12 12:04:04'),
(89, 25, NULL, '1001990000', 1, 16379, 7, 2023, 234, '2024-02-12 12:15:20', '2024-02-12 12:15:20'),
(90, 25, NULL, '1001990000', 2, 20078, 7, 2023, 234, '2024-02-12 12:45:38', '2024-02-12 12:45:38'),
(91, 25, NULL, '1001990000', 1, 900, 7, 2023, 234, '2024-02-12 12:52:33', '2024-02-12 12:52:33'),
(92, 25, NULL, '1001990000', 1, 366.6, 7, 2023, 234, '2024-02-12 13:00:12', '2024-02-12 13:00:12'),
(93, 25, NULL, '1001990000', 1, 22600, 7, 2023, 234, '2024-02-12 13:06:22', '2024-02-12 13:06:22'),
(94, 25, NULL, '1001990000', 1, 3500, 7, 2023, 234, '2024-02-12 13:14:40', '2024-02-12 13:14:40'),
(95, 25, NULL, '1001990000', 1, 39074.71, 7, 2023, 234, '2024-02-12 13:20:52', '2024-02-12 13:20:52'),
(96, 25, NULL, '1001990000', 1, 1000, 7, 2023, 234, '2024-02-12 13:25:50', '2024-02-12 13:25:50'),
(97, 25, NULL, '1001990000', 1, 47220.62, 7, 2023, 234, '2024-02-12 13:36:16', '2024-02-12 13:36:16'),
(98, 25, NULL, '1001990000', 1, 47940.62, 7, 2023, 234, '2024-02-12 13:47:02', '2024-02-12 13:47:02'),
(99, 25, NULL, '1001990000', 1, 31700, 7, 2023, 234, '2024-02-12 14:17:26', '2024-02-12 14:17:26'),
(100, 32, NULL, '1003900000', 1, 460, 7, 2023, 234, '2024-02-12 14:22:53', '2024-02-12 14:22:53'),
(101, 25, NULL, '1001990000', NULL, 24192.5, 7, 2023, 234, '2024-02-12 14:29:19', '2024-02-12 14:29:19'),
(102, 32, NULL, '1003900000', 1, 576, 7, 2023, 234, '2024-02-12 14:33:44', '2024-02-12 14:33:44'),
(103, 25, NULL, '1001990000', 1, 19902, 7, 2023, 234, '2024-02-12 14:48:09', '2024-02-12 14:48:09'),
(104, 25, NULL, '1001990000', 1, 19000, 7, 2023, 234, '2024-02-12 14:59:40', '2024-02-12 14:59:40'),
(105, 25, NULL, '1001990000', 1, 76044, 7, 2023, 234, '2024-02-12 15:10:40', '2024-02-12 15:10:40'),
(106, 25, NULL, '1001990000', 1, 54015, 7, 2023, 234, '2024-02-13 13:26:34', '2024-02-13 13:26:34'),
(107, 25, NULL, '1001990000', 1, 18424.2, 7, 2023, 234, '2024-02-13 13:38:59', '2024-02-13 13:38:59'),
(108, 25, NULL, '1001990000', 1, 4859.1, 7, 2023, 234, '2024-02-13 13:45:42', '2024-02-13 13:45:42'),
(109, 25, NULL, '1001990000', 1, 34000, 7, 2023, 234, '2024-02-13 13:59:07', '2024-02-13 13:59:07'),
(110, 25, NULL, '1001990000', 1, 27230, 7, 2023, 234, '2024-02-13 14:20:41', '2024-02-13 14:20:41'),
(111, 25, NULL, '1001990000', 1, 19363.45, 7, 2023, 234, '2024-02-13 15:06:42', '2024-02-13 15:06:42'),
(112, 25, NULL, '1001990000', 1, 23835.3, 7, 2023, 234, '2024-02-13 15:15:57', '2024-02-13 15:15:57'),
(113, 25, NULL, '1001990000', 1, 75422.6, 7, 2023, 234, '2024-02-13 15:23:21', '2024-02-13 15:23:21'),
(114, 25, NULL, '1001990000', 1, 1500, 7, 2023, 234, '2024-02-13 17:25:24', '2024-02-13 17:25:24'),
(115, 25, NULL, '1001990000', 1, 1586, 7, 2023, 234, '2024-02-13 17:37:13', '2024-02-13 17:37:13'),
(116, 25, NULL, '1001990000', 1, 18, 7, 2023, 234, '2024-02-13 17:45:30', '2024-02-13 17:45:30'),
(117, 32, NULL, '1003900000', 1, 100, 7, 2023, 234, '2024-02-13 18:00:55', '2024-02-13 18:00:55'),
(118, 25, NULL, '1001990000', 1, 5170, 7, 2023, 234, '2024-02-15 10:11:33', '2024-02-15 10:11:33'),
(119, 25, 189, '1001990000', 1, 130, 7, 2023, 112, '2024-02-15 16:47:21', '2024-02-15 16:47:21'),
(120, 25, 189, '1001990000', 1, 827.6, 7, 2023, 112, '2024-02-15 16:54:49', '2024-02-15 16:54:49'),
(121, 25, 189, '1001990000', 1, 141, 7, 2023, 112, '2024-02-16 11:24:00', '2024-02-26 12:47:25'),
(122, 25, NULL, '1001990000', 1, 52861, 7, 2023, 234, '2024-02-19 13:16:30', '2024-02-19 13:16:30'),
(123, 25, NULL, '1001990000', 1, 5000, 7, 2023, 234, '2024-02-19 13:25:14', '2024-02-19 13:25:14'),
(124, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-19 13:33:41', '2024-02-19 13:34:03'),
(125, 25, NULL, '1001990000', 1, 63313.48, 7, 2023, 234, '2024-02-19 13:45:42', '2024-02-19 13:45:42'),
(126, 25, NULL, '1001990000', 1, 4710.6, 7, 2023, 234, '2024-02-19 13:54:16', '2024-02-19 13:54:16'),
(127, 25, NULL, '1001990000', NULL, 13163, 7, 2023, 234, '2024-02-21 11:20:21', '2024-02-21 11:20:21'),
(128, 25, NULL, '1001990000', 2, 13460, 7, 2023, 234, '2024-02-21 11:28:50', '2024-02-21 11:28:50'),
(129, 25, 188, '1001990000', 1, 490, 7, 2022, 234, '2024-02-21 11:38:09', '2024-02-21 11:38:09'),
(130, 25, NULL, '1001990000', 1, 20500, 7, 2023, 234, '2024-02-21 11:51:08', '2024-02-21 11:51:08'),
(131, 26, 187, '1101001509', NULL, NULL, 3, 2023, 234, '2024-02-23 15:05:55', '2024-02-23 15:05:55'),
(132, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:28:47', '2024-02-26 12:28:47'),
(133, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:29:23', '2024-02-26 12:29:23'),
(134, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:30:54', '2024-02-26 12:30:54'),
(135, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:31:15', '2024-02-26 12:31:15'),
(136, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:35:07', '2024-02-26 12:35:07'),
(138, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:37:38', '2024-02-26 12:37:38'),
(139, 25, 189, '1001990000', 1, 991.5, 7, 2023, 112, '2024-02-26 12:38:46', '2024-02-26 12:38:46'),
(140, 25, 189, '1001990000', 1, 699.65, 7, 2023, 112, '2024-02-27 17:07:51', '2024-02-27 17:07:51'),
(141, 26, 187, '1101001509', NULL, NULL, 3, 2024, 234, '2024-02-28 16:17:04', '2024-02-28 16:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `crop_production`
--

CREATE TABLE `crop_production` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `decisions`
--

CREATE TABLE `decisions` (
  `id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `laboratory_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `decisions`
--

INSERT INTO `decisions` (`id`, `director_id`, `app_id`, `laboratory_id`, `date`, `status`, `code`, `requirement`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(8, 24, 8, 4, '2024-01-09', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-30 17:52:56', '2024-01-30 17:52:56'),
(9, 24, 9, 4, '2024-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-30 18:04:44', '2024-01-30 18:04:44'),
(10, 24, 10, 4, '2024-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-31 09:54:40', '2024-01-31 09:54:40'),
(11, 24, 11, 4, '2024-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-31 10:23:50', '2024-01-31 10:23:50'),
(12, 24, 12, 4, '2024-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-31 10:41:44', '2024-01-31 10:41:44'),
(13, 24, 13, 4, '2024-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-31 11:03:14', '2024-01-31 11:03:14'),
(14, 24, 14, 4, '2024-01-22', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-31 11:17:29', '2024-01-31 11:17:29'),
(15, 24, 15, 4, '2024-01-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-01-31 11:48:15', '2024-01-31 11:48:15'),
(16, 24, 16, 4, '2023-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 11:19:11', '2024-02-07 11:19:11'),
(17, 24, 17, 4, '2023-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 11:40:12', '2024-02-07 11:40:12'),
(18, 24, 18, 4, '2023-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 11:47:47', '2024-02-07 11:47:47'),
(19, 24, 19, 4, '2023-01-09', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 12:05:58', '2024-02-07 12:05:58'),
(20, 24, 20, 4, '2023-01-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 12:12:43', '2024-02-07 12:12:43'),
(21, 24, 21, 4, '2023-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 12:23:29', '2024-02-07 12:23:29'),
(22, 24, 22, 4, '2023-01-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 12:28:31', '2024-02-07 12:28:31'),
(23, 24, 23, 4, '2023-01-17', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 12:48:20', '2024-02-07 12:48:20'),
(24, 24, 24, 4, '2023-01-17', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 13:50:34', '2024-02-07 13:50:34'),
(25, 24, 25, 4, '2023-01-17', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 14:04:30', '2024-02-07 14:04:30'),
(26, 24, 26, 4, '2023-01-17', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 14:12:32', '2024-02-07 14:12:32'),
(27, 24, 27, 4, '2023-01-20', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 14:40:15', '2024-02-07 14:40:15'),
(28, 24, 28, 4, '2023-01-20', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 14:46:01', '2024-02-07 14:46:01'),
(29, 24, 28, 4, '2023-01-20', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 14:47:04', '2024-02-07 14:47:04'),
(30, 24, 29, 4, '2023-01-23', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 14:55:41', '2024-02-07 14:55:41'),
(31, 24, 30, 4, '2023-01-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 15:04:44', '2024-02-07 15:04:44'),
(32, 24, 31, 4, '2023-01-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 15:11:36', '2024-02-07 15:11:36'),
(33, 24, 32, 4, '2023-01-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-07 15:37:29', '2024-02-07 15:37:29'),
(34, 24, 33, 4, '2023-01-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 11:13:17', '2024-02-08 11:13:17'),
(35, 24, 34, 4, '2023-01-30', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 11:24:04', '2024-02-08 11:24:04'),
(36, 24, 35, 4, '2023-02-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 13:21:15', '2024-02-08 13:21:15'),
(37, 24, 36, 4, '2023-02-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 13:28:59', '2024-02-08 13:28:59'),
(38, 24, 37, 4, '2023-02-17', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 13:38:55', '2024-02-08 13:38:55'),
(39, 24, 38, 4, '2023-02-20', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 13:45:12', '2024-02-08 13:45:12'),
(40, 24, 39, 4, '2023-02-21', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 13:53:21', '2024-02-08 13:53:21'),
(41, 24, 40, 4, '2023-02-28', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 14:02:08', '2024-02-08 14:02:08'),
(42, 24, 41, 4, '2023-03-25', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 14:47:16', '2024-02-08 14:47:16'),
(43, 24, 42, 4, '2023-05-04', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 15:07:22', '2024-02-08 15:07:22'),
(44, 24, 43, 4, '2023-05-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 15:32:58', '2024-02-08 15:32:58'),
(45, 24, 44, 4, '2023-05-29', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 15:48:58', '2024-02-08 15:48:58'),
(46, 24, 45, 4, '2023-06-01', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-08 15:57:38', '2024-02-08 15:57:38'),
(47, 24, 46, 4, '2023-06-14', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 10:47:17', '2024-02-09 10:47:17'),
(48, 24, 47, 4, '2023-06-14', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 11:01:20', '2024-02-09 11:01:20'),
(49, 24, 48, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 12:01:54', '2024-02-09 12:01:54'),
(50, 24, 49, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 12:11:05', '2024-02-09 12:11:05'),
(51, 24, 50, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 12:15:44', '2024-02-09 12:15:44'),
(52, 24, 51, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 12:20:18', '2024-02-09 12:20:18'),
(53, 24, 52, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 12:24:08', '2024-02-09 12:24:08'),
(54, 24, 53, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 12:28:08', '2024-02-09 12:28:08'),
(55, 24, 54, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 14:20:47', '2024-02-09 14:20:47'),
(56, 24, 55, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 15:26:28', '2024-02-09 15:26:28'),
(57, 24, 56, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 16:21:52', '2024-02-09 16:21:52'),
(58, 24, 57, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 16:27:58', '2024-02-09 16:27:58'),
(59, 24, 58, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 16:34:28', '2024-02-09 16:34:28'),
(60, 24, 59, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 16:44:01', '2024-02-09 16:44:01'),
(61, 24, 60, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 16:52:19', '2024-02-09 16:52:19'),
(62, 24, 61, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-09 23:15:57', '2024-02-09 23:15:57'),
(63, 24, 62, 4, '2023-06-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 15:31:55', '2024-02-10 15:31:55'),
(64, 24, 63, 4, '2023-07-03', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 15:39:05', '2024-02-10 15:39:05'),
(65, 24, 64, 4, '2023-07-03', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 15:43:44', '2024-02-10 15:43:44'),
(66, 24, 65, 4, '2023-07-03', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 15:56:16', '2024-02-10 15:56:16'),
(67, 24, 66, 4, '2023-07-03', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:03:25', '2024-02-10 16:03:25'),
(68, 24, 67, 4, '2023-07-03', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:10:56', '2024-02-10 16:10:56'),
(69, 24, 68, 4, '2023-07-04', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:15:57', '2024-02-10 16:15:57'),
(70, 24, 69, 4, '2023-07-04', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:31:05', '2024-02-10 16:31:05'),
(71, 24, 70, 4, '2023-07-04', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:37:08', '2024-02-10 16:37:08'),
(72, 24, 71, 4, '2023-07-06', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:42:47', '2024-02-10 16:42:47'),
(73, 24, 72, 4, '2023-07-07', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:48:37', '2024-02-10 16:48:37'),
(74, 24, 73, 4, '2023-07-06', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 16:57:24', '2024-02-10 16:57:24'),
(75, 24, 74, 4, '2023-07-07', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 17:18:07', '2024-02-10 17:18:07'),
(76, 24, 75, 4, '2023-07-07', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 17:26:50', '2024-02-10 17:26:50'),
(77, 24, 76, 4, '2023-07-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 17:32:20', '2024-02-10 17:32:20'),
(78, 24, 77, 4, '2023-07-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-10 17:39:51', '2024-02-10 17:39:51'),
(79, 24, 78, 4, '2023-07-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 09:33:58', '2024-02-12 09:33:58'),
(80, 24, 79, 4, '2023-07-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 09:42:17', '2024-02-12 09:42:17'),
(81, 24, 80, 4, '2023-07-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 10:11:29', '2024-02-12 10:11:29'),
(82, 24, 81, 4, '2023-07-10', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 10:26:53', '2024-02-12 10:26:53'),
(83, 24, 82, 4, '2023-07-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 10:48:28', '2024-02-12 10:48:28'),
(84, 24, 83, 4, '2023-07-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 11:01:50', '2024-02-12 11:01:50'),
(85, 24, 84, 4, '2023-07-12', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 11:10:41', '2024-02-12 11:10:41'),
(86, 24, 85, 4, '2023-07-12', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 11:21:19', '2024-02-12 11:21:19'),
(87, 24, 86, 4, '2023-07-13', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 11:45:01', '2024-02-12 11:45:01'),
(88, 24, 87, 4, '2023-07-13', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 11:56:40', '2024-02-12 11:56:40'),
(89, 24, 88, 4, '2023-07-14', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 12:04:56', '2024-02-12 12:04:56'),
(90, 24, 89, 4, '2023-07-18', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 12:15:59', '2024-02-12 12:15:59'),
(91, 24, 90, 4, '2023-07-18', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 12:46:02', '2024-02-12 12:46:02'),
(92, 24, 91, 4, '2023-07-18', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 12:52:53', '2024-02-12 12:52:53'),
(93, 24, 92, 4, '2023-07-18', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:00:34', '2024-02-12 13:00:34'),
(94, 24, 93, 4, '2023-07-19', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:08:28', '2024-02-12 13:08:28'),
(95, 24, 94, 4, '2023-07-19', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:15:02', '2024-02-12 13:15:02'),
(96, 24, 95, 4, '2023-07-20', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:21:22', '2024-02-12 13:21:22'),
(97, 24, 96, 4, '2023-07-20', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:26:04', '2024-02-12 13:26:04'),
(98, 24, 97, 4, '2023-07-21', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:36:32', '2024-02-12 13:36:32'),
(99, 24, 98, 4, '2023-07-21', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 13:47:18', '2024-02-12 13:47:18'),
(100, 24, 99, 4, '2023-07-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 14:17:48', '2024-02-12 14:17:48'),
(101, 24, 100, 4, '2023-07-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 14:23:08', '2024-02-12 14:23:08'),
(102, 24, 101, 4, '2023-07-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 14:29:37', '2024-02-12 14:29:37'),
(103, 24, 102, 4, '2023-07-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 14:33:58', '2024-02-12 14:33:58'),
(104, 24, 103, 4, '2023-07-24', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 14:48:23', '2024-02-12 14:48:23'),
(105, 24, 104, 4, '2023-07-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 14:59:57', '2024-02-12 14:59:57'),
(106, 24, 105, 4, '2023-07-27', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-12 15:11:06', '2024-02-12 15:11:06'),
(107, 24, 106, 4, '2023-07-27', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 13:27:23', '2024-02-13 13:27:23'),
(108, 24, 107, 4, '2023-08-01', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 13:39:26', '2024-02-13 13:39:26'),
(109, 24, 108, 4, '2023-08-01', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 13:45:58', '2024-02-13 13:45:58'),
(110, 24, 109, 4, '2023-08-01', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 13:59:22', '2024-02-13 13:59:22'),
(111, 24, 110, 4, '2023-08-01', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 14:21:04', '2024-02-13 14:21:04'),
(112, 24, 111, 4, '2023-08-04', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 15:07:00', '2024-02-13 15:07:00'),
(113, 24, 112, 4, '2023-08-04', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 15:16:13', '2024-02-13 15:16:13'),
(114, 24, 113, 4, '2023-08-07', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 15:23:40', '2024-02-13 15:23:40'),
(115, 24, 114, 4, '2023-08-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 17:25:57', '2024-02-13 17:25:57'),
(116, 24, 115, 4, '2023-08-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 17:37:34', '2024-02-13 17:37:34'),
(117, 24, 116, 4, '2023-08-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 17:45:48', '2024-02-13 17:45:48'),
(118, 24, 117, 4, '2023-08-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-13 18:01:15', '2024-02-13 18:01:15'),
(119, 24, 118, 4, '2023-08-09', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-15 10:22:14', '2024-02-15 10:22:14'),
(120, 24, 119, 4, '2024-02-09', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-15 16:47:50', '2024-02-15 16:47:50'),
(121, 24, 120, 4, '2024-02-09', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-15 16:55:06', '2024-02-15 16:55:06'),
(122, 24, 121, 4, '2024-02-15', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-16 11:24:19', '2024-02-16 11:24:19'),
(123, 24, 122, 4, '2023-08-09', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-19 13:16:55', '2024-02-19 13:16:55'),
(124, 24, 123, 4, '2023-08-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-19 13:26:59', '2024-02-19 13:26:59'),
(125, 24, 124, 4, '2023-08-11', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-19 13:35:57', '2024-02-19 13:35:57'),
(126, 24, 125, 4, '2023-08-15', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-19 13:46:02', '2024-02-19 13:46:02'),
(127, 24, 126, 4, '2023-08-16', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-19 13:55:07', '2024-02-19 13:55:07'),
(128, 24, 127, 4, '2023-08-22', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-21 11:20:50', '2024-02-21 11:20:50'),
(129, 24, 128, 4, '2023-08-22', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-21 11:29:24', '2024-02-21 11:29:24'),
(130, 24, 129, 4, '2023-08-25', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-21 11:38:25', '2024-02-21 11:38:25'),
(131, 24, 130, 4, '2023-09-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-21 11:51:37', '2024-02-21 11:51:37'),
(132, 24, 131, 4, '2023-09-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-23 15:06:18', '2024-02-23 15:06:18'),
(134, 24, 139, 4, '2024-02-23', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-26 12:42:34', '2024-02-26 12:42:34'),
(135, 24, 140, 4, '2024-02-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-27 17:08:09', '2024-02-27 17:08:09'),
(136, 24, 141, 4, '2024-02-26', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-28 16:23:24', '2024-02-28 16:23:24'),
(137, 24, 1, 4, '2024-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-29 10:07:07', '2024-02-29 10:07:07'),
(138, 24, 2, 4, '2024-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-29 10:14:11', '2024-02-29 10:14:11'),
(139, 24, 4, 4, '2024-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-29 10:19:23', '2024-02-29 10:19:23'),
(140, 24, 5, 4, '2024-01-05', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-29 10:25:43', '2024-02-29 10:25:43'),
(141, 24, 6, 4, '2024-01-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-29 10:30:30', '2024-02-29 10:30:30'),
(142, 24, 7, 4, '2024-01-08', 1, NULL, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari, ', 25, 0, '2024-02-29 10:34:46', '2024-02-29 10:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `decision_makers`
--

CREATE TABLE `decision_makers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `decision_makers`
--

INSERT INTO `decision_makers` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pulatov Z.', 1, '2024-01-30 13:19:46', '2024-01-30 13:19:46'),
(2, 'Aparnikova T.', 1, '2024-02-07 11:31:36', '2024-02-07 11:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_results`
--

CREATE TABLE `final_results` (
  `id` int(11) NOT NULL,
  `test_program_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `folder_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maker` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `final_results`
--

INSERT INTO `final_results` (`id`, `test_program_id`, `type`, `folder_number`, `comment`, `maker`, `created_at`, `updated_at`) VALUES
(7, 8, 2, NULL, NULL, 1, '2024-01-30 17:59:44', '2024-01-30 17:59:44'),
(8, 9, 2, NULL, NULL, 1, '2024-01-30 18:08:30', '2024-01-30 18:08:30'),
(9, 10, 2, NULL, NULL, 1, '2024-01-31 09:59:52', '2024-01-31 09:59:52'),
(10, 11, 2, NULL, NULL, 1, '2024-01-31 10:27:21', '2024-01-31 10:27:21'),
(11, 12, 2, NULL, NULL, 1, '2024-01-31 10:52:48', '2024-01-31 10:52:48'),
(12, 13, 2, NULL, NULL, 1, '2024-01-31 11:10:47', '2024-01-31 11:10:47'),
(13, 14, 2, NULL, NULL, 1, '2024-01-31 11:40:48', '2024-01-31 11:40:48'),
(14, 15, 2, NULL, NULL, 1, '2024-01-31 12:00:36', '2024-01-31 12:00:36'),
(15, 16, 2, NULL, NULL, 2, '2024-02-07 11:34:54', '2024-02-07 11:34:54'),
(16, 17, 2, NULL, NULL, 2, '2024-02-07 11:45:29', '2024-02-07 11:45:29'),
(17, 18, 2, NULL, NULL, 2, '2024-02-07 11:53:16', '2024-02-07 11:53:16'),
(18, 19, 2, NULL, NULL, 2, '2024-02-07 12:11:04', '2024-02-07 12:11:04'),
(19, 20, 2, NULL, NULL, 2, '2024-02-07 12:21:08', '2024-02-07 12:21:08'),
(20, 21, 2, NULL, NULL, 2, '2024-02-07 12:26:26', '2024-02-07 12:26:26'),
(21, 22, 2, NULL, NULL, 2, '2024-02-07 12:31:41', '2024-02-07 12:31:41'),
(22, 23, 2, NULL, NULL, 2, '2024-02-07 13:03:48', '2024-02-07 13:03:48'),
(23, 24, 2, NULL, NULL, 2, '2024-02-07 13:57:09', '2024-02-07 13:57:09'),
(24, 25, 2, NULL, NULL, 2, '2024-02-07 14:08:39', '2024-02-07 14:08:39'),
(25, 26, 2, NULL, NULL, 2, '2024-02-07 14:15:50', '2024-02-07 14:15:50'),
(26, 27, 2, NULL, NULL, 2, '2024-02-07 14:43:20', '2024-02-07 14:43:20'),
(27, 28, 2, NULL, NULL, 2, '2024-02-07 14:50:09', '2024-02-07 14:50:09'),
(28, 29, 2, NULL, NULL, 2, '2024-02-07 14:59:33', '2024-02-07 14:59:33'),
(29, 30, 2, NULL, NULL, 2, '2024-02-07 15:08:44', '2024-02-07 15:08:44'),
(30, 31, 2, NULL, NULL, 2, '2024-02-07 15:15:56', '2024-02-07 15:15:56'),
(31, 32, 2, NULL, NULL, 2, '2024-02-07 15:42:32', '2024-02-07 15:42:32'),
(32, 33, 2, NULL, NULL, 2, '2024-02-08 11:18:46', '2024-02-08 11:18:46'),
(33, 34, 2, NULL, NULL, 2, '2024-02-08 11:30:44', '2024-02-08 11:30:44'),
(34, 35, 2, NULL, NULL, 2, '2024-02-08 13:26:31', '2024-02-08 13:26:31'),
(35, 36, 2, NULL, NULL, 2, '2024-02-08 13:34:16', '2024-02-08 13:34:16'),
(36, 37, 2, NULL, NULL, 2, '2024-02-08 13:43:24', '2024-02-08 13:43:24'),
(37, 38, 2, NULL, NULL, 2, '2024-02-08 13:48:41', '2024-02-08 13:48:41'),
(38, 39, 2, NULL, NULL, 2, '2024-02-08 13:57:54', '2024-02-08 13:57:54'),
(39, 40, 2, NULL, NULL, 2, '2024-02-08 14:06:04', '2024-02-08 14:06:04'),
(40, 41, 2, NULL, NULL, 2, '2024-02-08 14:52:41', '2024-02-08 14:52:41'),
(41, 42, 2, NULL, NULL, 2, '2024-02-08 15:11:28', '2024-02-08 15:11:28'),
(42, 43, 2, NULL, NULL, 2, '2024-02-08 15:37:34', '2024-02-08 15:37:34'),
(43, 44, 2, NULL, NULL, 2, '2024-02-08 15:52:36', '2024-02-08 15:52:36'),
(44, 45, 2, NULL, NULL, 2, '2024-02-08 16:01:12', '2024-02-08 16:01:12'),
(45, 46, 2, NULL, NULL, 2, '2024-02-09 10:52:07', '2024-02-09 10:52:07'),
(46, 47, 2, NULL, NULL, 2, '2024-02-09 11:05:47', '2024-02-09 11:05:47'),
(47, 48, 2, NULL, NULL, 2, '2024-02-09 12:06:03', '2024-02-09 12:06:03'),
(48, 49, 2, NULL, NULL, 2, '2024-02-09 12:13:59', '2024-02-09 12:13:59'),
(49, 50, 2, NULL, NULL, 2, '2024-02-09 12:19:07', '2024-02-09 12:19:07'),
(50, 51, 2, NULL, NULL, 2, '2024-02-09 12:22:52', '2024-02-09 12:22:52'),
(51, 52, 2, NULL, NULL, 2, '2024-02-09 12:26:48', '2024-02-09 12:26:48'),
(52, 53, 2, NULL, NULL, 2, '2024-02-09 12:30:18', '2024-02-09 12:30:18'),
(53, 54, 2, NULL, NULL, 2, '2024-02-09 15:25:01', '2024-02-09 15:25:01'),
(54, 55, 2, NULL, NULL, 2, '2024-02-09 15:29:01', '2024-02-09 15:29:01'),
(55, 56, 2, NULL, NULL, 2, '2024-02-09 16:24:59', '2024-02-09 16:24:59'),
(56, 57, 2, NULL, NULL, 2, '2024-02-09 16:31:54', '2024-02-09 16:31:54'),
(57, 58, 2, NULL, NULL, 2, '2024-02-09 16:37:41', '2024-02-09 16:37:41'),
(58, 59, 2, NULL, NULL, 2, '2024-02-09 16:47:20', '2024-02-09 16:47:20'),
(59, 60, 2, NULL, NULL, 2, '2024-02-09 17:01:54', '2024-02-09 17:01:54'),
(60, 61, 2, NULL, NULL, 2, '2024-02-10 15:24:15', '2024-02-10 15:24:15'),
(61, 61, 2, NULL, NULL, 2, '2024-02-10 15:24:57', '2024-02-10 15:24:57'),
(62, 61, 2, NULL, NULL, 2, '2024-02-10 15:26:03', '2024-02-10 15:26:03'),
(63, 62, 2, NULL, NULL, 2, '2024-02-10 15:34:33', '2024-02-10 15:34:33'),
(64, 63, 2, NULL, NULL, 2, '2024-02-10 15:41:33', '2024-02-10 15:41:33'),
(65, 64, 2, NULL, NULL, 2, '2024-02-10 15:52:08', '2024-02-10 15:52:08'),
(66, 64, 2, NULL, NULL, 2, '2024-02-10 15:52:40', '2024-02-10 15:52:40'),
(67, 65, 2, NULL, NULL, 2, '2024-02-10 15:59:10', '2024-02-10 15:59:10'),
(68, 66, 2, NULL, NULL, 2, '2024-02-10 16:06:37', '2024-02-10 16:06:37'),
(69, 67, 2, NULL, NULL, 2, '2024-02-10 16:13:21', '2024-02-10 16:13:21'),
(70, 68, 2, NULL, NULL, 2, '2024-02-10 16:20:15', '2024-02-10 16:20:15'),
(71, 69, 2, NULL, NULL, 2, '2024-02-10 16:34:06', '2024-02-10 16:34:06'),
(72, 70, 2, NULL, NULL, 2, '2024-02-10 16:39:15', '2024-02-10 16:39:15'),
(73, 71, 2, NULL, NULL, 2, '2024-02-10 16:45:20', '2024-02-10 16:45:20'),
(74, 72, 2, NULL, NULL, 2, '2024-02-10 16:51:33', '2024-02-10 16:51:33'),
(75, 73, 2, NULL, NULL, 2, '2024-02-10 17:00:45', '2024-02-10 17:00:45'),
(76, 74, 2, NULL, NULL, 2, '2024-02-10 17:20:35', '2024-02-10 17:20:35'),
(77, 75, 2, NULL, NULL, 2, '2024-02-10 17:29:31', '2024-02-10 17:29:31'),
(78, 76, 2, NULL, NULL, 2, '2024-02-10 17:36:31', '2024-02-10 17:36:31'),
(79, 77, 2, NULL, NULL, 2, '2024-02-10 17:42:47', '2024-02-10 17:42:47'),
(80, 78, 2, NULL, NULL, 2, '2024-02-12 09:37:24', '2024-02-12 09:37:24'),
(81, 79, 2, NULL, NULL, 2, '2024-02-12 09:46:02', '2024-02-12 09:46:02'),
(82, 80, 2, NULL, NULL, 2, '2024-02-12 10:20:58', '2024-02-12 10:20:58'),
(83, 81, 2, NULL, NULL, 2, '2024-02-12 10:32:34', '2024-02-12 10:32:34'),
(84, 82, 2, NULL, NULL, 2, '2024-02-12 10:51:37', '2024-02-12 10:51:37'),
(85, 83, 2, NULL, NULL, 2, '2024-02-12 11:04:59', '2024-02-12 11:04:59'),
(86, 84, 2, NULL, NULL, 2, '2024-02-12 11:15:19', '2024-02-12 11:15:19'),
(87, 85, 2, NULL, NULL, 2, '2024-02-12 11:25:51', '2024-02-12 11:25:51'),
(88, 86, 2, NULL, NULL, 2, '2024-02-12 11:47:50', '2024-02-12 11:47:50'),
(89, 87, 2, NULL, NULL, 2, '2024-02-12 12:00:14', '2024-02-12 12:00:14'),
(90, 88, 2, NULL, NULL, 2, '2024-02-12 12:07:39', '2024-02-12 12:07:39'),
(91, 89, 2, NULL, NULL, 2, '2024-02-12 12:21:10', '2024-02-12 12:21:10'),
(92, 90, 2, NULL, NULL, 2, '2024-02-12 12:49:43', '2024-02-12 12:49:43'),
(93, 91, 2, NULL, NULL, 1, '2024-02-12 12:57:01', '2024-02-12 12:57:01'),
(94, 92, 2, NULL, NULL, 2, '2024-02-12 13:03:13', '2024-02-12 13:03:13'),
(95, 93, 2, NULL, NULL, 2, '2024-02-12 13:11:07', '2024-02-12 13:11:07'),
(96, 94, 2, NULL, NULL, 2, '2024-02-12 13:17:18', '2024-02-12 13:17:18'),
(97, 95, 2, NULL, NULL, 2, '2024-02-12 13:23:34', '2024-02-12 13:23:34'),
(98, 96, 2, NULL, NULL, 2, '2024-02-12 13:28:44', '2024-02-12 13:28:44'),
(99, 97, 2, NULL, NULL, 2, '2024-02-12 13:39:16', '2024-02-12 13:39:16'),
(100, 98, 2, NULL, NULL, 2, '2024-02-12 13:50:02', '2024-02-12 13:50:02'),
(101, 99, 2, NULL, NULL, 2, '2024-02-12 14:21:48', '2024-02-12 14:21:48'),
(102, 100, 2, NULL, NULL, 2, '2024-02-12 14:25:34', '2024-02-12 14:25:34'),
(103, 101, 2, NULL, NULL, 2, '2024-02-12 14:32:43', '2024-02-12 14:32:43'),
(104, 102, 2, NULL, NULL, 2, '2024-02-12 14:36:54', '2024-02-12 14:36:54'),
(105, 103, 2, NULL, NULL, 2, '2024-02-12 14:58:14', '2024-02-12 14:58:14'),
(106, 104, 2, NULL, NULL, 2, '2024-02-12 15:02:20', '2024-02-12 15:02:20'),
(107, 105, 2, NULL, NULL, 2, '2024-02-12 15:13:45', '2024-02-12 15:13:45'),
(108, 106, 2, NULL, NULL, 1, '2024-02-13 13:32:25', '2024-02-13 13:32:25'),
(109, 107, 2, NULL, NULL, 1, '2024-02-13 13:42:21', '2024-02-13 13:42:21'),
(110, 108, 2, NULL, NULL, 1, '2024-02-13 13:48:52', '2024-02-13 13:48:52'),
(111, 109, 2, NULL, NULL, 1, '2024-02-13 14:03:03', '2024-02-13 14:03:03'),
(112, 110, 2, NULL, NULL, 1, '2024-02-13 14:24:47', '2024-02-13 14:24:47'),
(113, 111, 2, NULL, NULL, 1, '2024-02-13 15:10:47', '2024-02-13 15:10:47'),
(114, 112, 2, NULL, NULL, 1, '2024-02-13 15:19:32', '2024-02-13 15:19:32'),
(115, 113, 2, NULL, NULL, 1, '2024-02-13 15:28:02', '2024-02-13 15:28:02'),
(116, 114, 2, NULL, NULL, 1, '2024-02-13 17:28:11', '2024-02-13 17:28:11'),
(117, 115, 2, NULL, NULL, 1, '2024-02-13 17:41:32', '2024-02-13 17:41:32'),
(118, 116, 2, NULL, NULL, 1, '2024-02-13 17:50:52', '2024-02-13 17:50:52'),
(119, 117, 2, NULL, NULL, 1, '2024-02-13 18:06:13', '2024-02-13 18:06:13'),
(120, 118, 2, NULL, NULL, 1, '2024-02-15 14:08:21', '2024-02-15 14:08:21'),
(121, 119, 2, NULL, NULL, 1, '2024-02-15 16:51:56', '2024-02-15 16:51:56'),
(122, 120, 2, NULL, NULL, 1, '2024-02-15 16:58:19', '2024-02-15 16:58:19'),
(123, 121, 2, NULL, NULL, 1, '2024-02-16 11:26:53', '2024-02-16 11:26:53'),
(124, 122, 2, NULL, NULL, 1, '2024-02-19 13:21:30', '2024-02-19 13:21:30'),
(125, 123, 2, NULL, NULL, 1, '2024-02-19 13:31:05', '2024-02-19 13:31:05'),
(126, 124, 2, NULL, NULL, 1, '2024-02-19 13:40:00', '2024-02-19 13:40:00'),
(127, 125, 2, NULL, NULL, 1, '2024-02-19 13:50:14', '2024-02-19 13:50:14'),
(128, 126, 2, NULL, NULL, 1, '2024-02-19 13:58:39', '2024-02-19 13:58:39'),
(129, 127, 2, NULL, NULL, 1, '2024-02-21 11:26:56', '2024-02-21 11:26:56'),
(130, 128, 2, NULL, NULL, 1, '2024-02-21 11:31:55', '2024-02-21 11:31:55'),
(131, 129, 2, NULL, NULL, 1, '2024-02-21 11:44:15', '2024-02-21 11:44:15'),
(132, 130, 2, NULL, NULL, 1, '2024-02-21 11:55:41', '2024-02-21 11:55:41'),
(133, 131, 2, NULL, NULL, 1, '2024-02-23 15:11:03', '2024-02-23 15:11:03'),
(134, 133, 2, NULL, NULL, 1, '2024-02-26 12:45:56', '2024-02-26 12:45:56'),
(135, 134, 2, NULL, NULL, 1, '2024-02-27 17:12:59', '2024-02-27 17:12:59'),
(136, 135, 2, NULL, NULL, 1, '2024-02-28 16:30:45', '2024-02-28 16:30:45'),
(137, 136, 2, NULL, NULL, 1, '2024-02-29 10:12:28', '2024-02-29 10:12:28'),
(138, 137, 2, NULL, NULL, 1, '2024-02-29 10:17:43', '2024-02-29 10:17:43'),
(139, 138, 2, NULL, NULL, 1, '2024-02-29 10:24:52', '2024-02-29 10:24:52'),
(140, 139, 2, NULL, NULL, 1, '2024-02-29 10:29:07', '2024-02-29 10:29:07'),
(141, 140, 2, NULL, NULL, 1, '2024-02-29 10:32:54', '2024-02-29 10:32:54'),
(142, 141, 2, NULL, NULL, 1, '2024-02-29 10:42:30', '2024-02-29 10:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `laboratories`
--

CREATE TABLE `laboratories` (
  `id` int(11) NOT NULL,
  `name` varchar(511) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratories`
--

INSERT INTO `laboratories` (`id`, `name`, `certificate`, `address`, `created_at`, `updated_at`) VALUES
(4, 'DON VA DON MAHSULOTLARINING SIFATINI TEKSHIRISH SINOV LABORATORIYASI', 'O‘ZAK.SL.0168', 'Toshkent viloyati, Qibray tumani. Bobur ko‘chasi, 1-uy.', '2024-01-30 12:41:31', '2024-01-30 12:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_numbers`
--

CREATE TABLE `laboratory_numbers` (
  `id` int(11) NOT NULL,
  `test_program_id` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `laboratory_category_type` int(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `laboratory_final_results`
--

CREATE TABLE `laboratory_final_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `test_program_id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `namlik` int(11) DEFAULT NULL,
  `harorat` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `laboratory_indicators`
--

CREATE TABLE `laboratory_indicators` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `indicator_id` int(11) NOT NULL,
  `type` int(2) NOT NULL DEFAULT 0,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `laboratory_result_users`
--

CREATE TABLE `laboratory_result_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `results_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `laboratory_results`
--

CREATE TABLE `laboratory_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `value` float DEFAULT NULL,
  `laboratory_indicator_id` int(11) NOT NULL,
  `number_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lab_bayonnoma`
--

CREATE TABLE `lab_bayonnoma` (
  `id` int(11) NOT NULL,
  `lab_start_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_employee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akt_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_bayonnoma`
--

INSERT INTO `lab_bayonnoma` (`id`, `lab_start_date`, `date`, `number`, `test_result`, `test_employee`, `akt_id`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2024-01-05', '2024-01-06', '166-177', 'Muvofiq', 'Jomurodov S.', 1, '', 25, '2024-01-30 13:18:11', '2024-01-30 13:18:11'),
(2, '2024-01-05', '2024-01-06', '3', 'Muvofiq', 'Yerxodjaeva M.', 2, '', 25, '2024-01-30 15:59:26', '2024-01-30 15:59:26'),
(3, '2024-01-05', '2024-01-08', '2784-2797', 'Muvofiq', 'Yerxodjaeva M.', 3, '', 1, '2024-01-30 16:48:01', '2024-01-30 16:48:01'),
(4, '2024-01-05', '2024-01-06', '1-43', 'Muvofiq', 'Xidirova N.', 4, '', 1, '2024-01-30 17:03:57', '2024-01-30 17:03:57'),
(5, '2024-01-08', '2024-01-09', '44-87', 'Muvofiq', 'Xidirova N.', 5, '', 25, '2024-01-30 17:22:31', '2024-01-30 17:22:31'),
(6, '2024-01-08', '2024-01-09', '88-147', 'Muvofiq', 'Xidirova N.', 6, '', 25, '2024-01-30 17:30:40', '2024-01-30 17:30:40'),
(7, '2024-01-09', '2024-01-09', '4', 'Muvofiq', 'Ishanova Sh.', 7, '', 25, '2024-01-30 17:57:16', '2024-01-30 17:57:16'),
(8, '2024-01-11', '2024-01-11', '5', 'Muvofiq', 'Yerxodjaeva M.', 8, '', 25, '2024-01-30 18:07:37', '2024-01-30 18:07:37'),
(9, '2024-01-11', '2024-01-12', '148-164', 'Muvofiq', 'Xaitova M.', 9, '', 25, '2024-01-31 09:59:00', '2024-01-31 09:59:00'),
(10, '2024-01-11', '2024-01-12', '165-180', 'Muvofiq', 'Xaitova M.', 10, '', 25, '2024-01-31 10:26:38', '2024-01-31 10:26:38'),
(11, '2024-01-11', '2024-01-15', '181-228', 'Muvofiq', 'Xaitova M.', 11, '', 25, '2024-01-31 10:51:53', '2024-01-31 10:51:53'),
(12, '2024-01-11', '2024-01-15', '229-235', 'Muvofiq', 'Xaitova M.', 12, '', 25, '2024-01-31 11:09:58', '2024-01-31 11:09:58'),
(13, '2024-01-22', '2024-01-23', '1-91', 'Muvofiq', 'Zaripova D.', 13, '', 25, '2024-01-31 11:21:17', '2024-01-31 11:21:17'),
(14, '2024-01-24', '2024-01-25', '11', 'Muvofiq', 'Yerxodjaeva M.', 14, '', 25, '2024-01-31 11:57:21', '2024-01-31 11:57:21'),
(15, '2023-01-05', '2023-01-09', '1', 'Muvofiq', 'Ishanova Sh.', 15, '', 25, '2024-02-07 11:29:20', '2024-02-07 11:29:20'),
(16, '2023-01-05', '2023-01-09', '2', 'Muvofiq', 'Ishanova Sh.', 16, '', 25, '2024-02-07 11:43:19', '2024-02-07 11:43:19'),
(17, '2023-01-05', '2023-01-09', '3', 'Muvofiq', 'Ishanova Sh.', 17, '', 25, '2024-02-07 11:51:21', '2024-02-07 11:51:21'),
(18, '2023-01-09', '2023-01-10', '4-6', 'Muvofiq', 'Yerxodjaeva M.', 18, '', 25, '2024-02-07 12:10:09', '2024-02-07 12:10:09'),
(19, '2023-01-10', '2023-01-11', '7', 'Muvofiq', 'Yerxodjaeva M.', 19, '', 25, '2024-02-07 12:20:01', '2024-02-07 12:20:01'),
(20, '2023-01-11', '2023-01-13', '8', 'Muvofiq', 'Yerxodjaeva M.', 20, '', 25, '2024-02-07 12:25:20', '2024-02-07 12:25:20'),
(21, '2023-01-11', '2023-01-13', '9', 'Muvofiq', 'YERXODJAEVA M.', 21, '', 25, '2024-02-07 12:30:58', '2024-02-07 12:30:58'),
(22, '2023-01-17', '2023-01-20', '25-41', 'Muvofiq', 'Ishanova Sh.', 22, '', 25, '2024-02-07 13:03:08', '2024-02-07 13:03:08'),
(23, '2023-01-17', '2023-01-20', '42-119', 'Muvofiq', 'Ishanova Sh.', 23, '', 25, '2024-02-07 13:55:37', '2024-02-07 13:55:37'),
(24, '2023-01-17', '2023-01-20', '120-147', 'Muvofiq', 'Yerxodjaeva M.', 24, '', 25, '2024-02-07 14:08:06', '2024-02-07 14:08:06'),
(25, '2023-01-17', '2023-01-19', '148', 'Muvofiq', 'IshanovaSh.', 25, '', 25, '2024-02-07 14:15:09', '2024-02-07 14:15:09'),
(26, '2023-01-20', '2023-01-23', '149 - 162', 'Muvofiq', 'Yerxodjaeva M.', 26, '', 25, '2024-02-07 14:42:54', '2024-02-07 14:42:54'),
(27, '2023-01-20', '2023-01-23', '163', 'Muvofiq', 'Yerxodjaeva M.', 27, '', 25, '2024-02-07 14:49:34', '2024-02-07 14:49:34'),
(28, '2023-01-23', '2023-01-24', '164-184', 'Muvofiq', 'Ishanova Sh.', 28, '', 25, '2024-02-07 14:58:40', '2024-02-07 14:58:40'),
(29, '2023-01-24', '2023-01-26', '185-217', 'Muvofiq', 'Yerxodjaeva M.', 29, '', 25, '2024-02-07 15:08:13', '2024-02-07 15:08:13'),
(30, '2023-01-24', '2023-01-26', '218-231', 'Muvofiq', 'Ishanova Sh.', 30, '', 25, '2024-02-07 15:15:29', '2024-02-07 15:15:29'),
(31, '2023-01-25', '2023-01-26', '238', 'Muvofiq', 'Yerxodjaeva M.', 31, '', 25, '2024-02-07 15:41:52', '2024-02-07 15:41:52'),
(32, '2023-01-25', '2023-01-26', '244', 'Muvofiq', 'Yerxodjaeva M.', 32, '', 25, '2024-02-08 11:17:51', '2024-02-08 11:17:51'),
(33, '2023-01-30', '2023-01-31', '245-264', 'Muvofiq', 'Yerxodjaeva M.', 33, '', 25, '2024-02-08 11:29:26', '2024-02-08 11:29:26'),
(34, '2023-02-08', '2023-02-13', '270', 'Muvofiq', 'Yerxodjaeva M.', 34, '', 25, '2024-02-08 13:25:54', '2024-02-08 13:25:54'),
(35, '2023-02-10', '2023-02-13', '274-297', 'Muvofiq', 'Yerxodjaeva M.', 35, '', 25, '2024-02-08 13:33:30', '2024-02-08 13:33:30'),
(36, '2023-02-17', '2023-02-22', '303', 'Muvofiq', 'Yerxodjaeva M.', 36, '', 25, '2024-02-08 13:42:52', '2024-02-08 13:42:52'),
(37, '2023-02-21', '2023-02-22', '313', 'Muvofiq', 'Yerxodjaeva M.', 37, '', 25, '2024-02-08 13:48:14', '2024-02-08 13:48:14'),
(38, '2023-02-22', '2023-02-23', '322', 'Muvofiq', 'Yerxodjaeva M.', 38, '', 25, '2024-02-08 13:57:11', '2024-02-08 13:57:11'),
(39, '2023-02-28', '2023-03-01', '326-371', 'Muvofiq', 'Ishanova Sh.', 39, '', 25, '2024-02-08 14:05:23', '2024-02-08 14:05:23'),
(40, '2023-03-27', '2023-03-30', '3', 'Muvofiq', 'Yerxodjaeva M.', 40, '', 25, '2024-02-08 14:52:07', '2024-02-08 14:52:07'),
(41, '2023-05-04', '2023-05-08', '6', 'Muvofiq', 'Yerxodjaeva M.', 41, '', 25, '2024-02-08 15:10:52', '2024-02-08 15:10:52'),
(42, '2023-05-26', '2023-05-29', '1', 'Muvofiq', 'Ishanova Sh.', 42, '', 25, '2024-02-08 15:36:43', '2024-02-08 15:36:43'),
(43, '2023-05-29', '2023-05-30', '2', 'Muvofiq', 'Ishanova Sh.', 43, '', 25, '2024-02-08 15:51:46', '2024-02-08 15:51:46'),
(44, '2023-06-01', '2023-06-02', '1-10', 'Muvofiq', 'Ishanova Sh.', 44, '', 25, '2024-02-08 16:00:16', '2024-02-08 16:00:16'),
(45, '2023-06-14', '2023-06-15', '3', 'Muvofiq', 'Ishanova Sh.', 45, '', 25, '2024-02-09 10:51:24', '2024-02-09 10:51:24'),
(46, '2023-06-14', '2023-06-15', '11-34', 'Muvofiq', 'Ishanova Sh.', 46, '', 25, '2024-02-09 11:04:10', '2024-02-09 11:04:10'),
(47, '2023-06-26', '2023-06-27', '112-114', 'Muvofiq', 'Xidirova N.', 47, '', 25, '2024-02-09 12:04:43', '2024-02-09 12:04:43'),
(48, '2023-06-26', '2023-06-27', '142-160', 'Muvofiq', 'Xidirova N.', 48, '', 25, '2024-02-09 12:13:20', '2024-02-09 12:13:20'),
(49, '2023-06-26', '2023-06-27', '115-125', 'Muvofiq', 'Xidirova N.', 49, '', 25, '2024-02-09 12:18:34', '2024-02-09 12:18:34'),
(50, '2023-06-26', '2023-06-27', '161-184', 'Muvofiq', 'Xidirova N.', 50, '', 25, '2024-02-09 12:22:18', '2024-02-09 12:22:18'),
(51, '2023-06-26', '2023-06-27', '126-141', 'Muvofiq', 'Xidirova N.', 51, '', 25, '2024-02-09 12:26:18', '2024-02-09 12:26:18'),
(52, '2023-06-26', '2023-06-27', '185-204', 'Muvofiq', 'Xidirova N', 52, '', 25, '2024-02-09 12:29:45', '2024-02-09 12:29:45'),
(53, '2023-06-26', '2023-06-27', '258-267', 'Muvofiq', 'Xaitova M', 53, '', 25, '2024-02-09 15:24:30', '2024-02-09 15:24:30'),
(54, '2023-06-26', '2023-06-27', '268-298', 'Muvofiq', 'Xaitova M', 54, '', 25, '2024-02-09 15:28:25', '2024-02-09 15:28:25'),
(55, '2023-06-26', '2023-06-27', '299-313', 'Muvofiq', 'Xaitova M.', 55, '', 25, '2024-02-09 16:24:23', '2024-02-09 16:24:23'),
(56, '2023-06-26', '2023-06-27', '319-331', 'Muvofiq', 'Xaitova M.', 56, '', 25, '2024-02-09 16:31:05', '2024-02-09 16:31:05'),
(57, '2023-06-26', '2023-06-27', '332-339', 'Muvofiq', 'Xaitova M.', 57, '', 25, '2024-02-09 16:37:03', '2024-02-09 16:37:03'),
(58, '2023-06-26', '2023-06-27', '314-318', 'Muvofiq', 'Xaitova M.', 58, '', 25, '2024-02-09 16:46:47', '2024-02-09 16:46:47'),
(59, '2023-06-26', '2023-06-27', '205-247', 'Muvofiq', 'Xaitova M.', 59, '', 25, '2024-02-09 16:56:12', '2024-02-09 16:56:12'),
(60, '2023-06-26', '2023-06-27', '81-91,12-27,38-47,48-58,59,65,102-111', 'Muvofiq', 'Xaitova M.', 60, '', 25, '2024-02-09 23:34:34', '2024-02-10 15:18:50'),
(61, '2023-06-26', '2023-06-27', '35-114', 'Muvofiq', 'ISHANOVA SH.', 61, '', 25, '2024-02-10 15:33:55', '2024-02-10 15:33:55'),
(62, '2023-07-03', '2023-07-04', '115', 'Muvofiq', 'Yerxodjaeva M.', 62, '', 25, '2024-02-10 15:41:02', '2024-02-10 15:41:02'),
(63, '2023-07-03', '2023-07-04', '410-448', 'Muvofiq', 'Xaitova M.', 63, '', 25, '2024-02-10 15:47:21', '2024-02-10 15:47:21'),
(64, '2023-07-03', '2023-07-04', '449-483', 'Muvofiq', 'Xaitova M.', 64, '', 25, '2024-02-10 15:58:29', '2024-02-10 15:58:29'),
(65, '2023-07-03', '2023-07-04', '340-409', 'Muvofiq', 'Xaitova M.', 65, '', 25, '2024-02-10 16:06:00', '2024-02-10 16:06:00'),
(66, '2023-07-03', '2023-07-04', '494-515', 'Muvofiq', 'Xidirova N.', 66, '', 25, '2024-02-10 16:12:47', '2024-02-10 16:12:47'),
(67, '2023-07-04', '2023-07-04', '484-493', 'Muvofiq', 'Xaitova M.', 67, '', 25, '2024-02-10 16:19:34', '2024-02-10 16:19:34'),
(68, '2023-07-04', '2023-07-05', '116-333', 'Muvofiq', 'Yerxodjaeva M.', 68, '', 25, '2024-02-10 16:33:36', '2024-02-10 16:33:36'),
(69, '2023-07-04', '2023-07-05', '516', 'Muvofiq', 'Xidirova N.', 69, '', 25, '2024-02-10 16:38:45', '2024-02-10 16:38:45'),
(70, '2023-07-06', '2023-07-07', '388-444', 'Muvofiq', 'Ishanova Sh.', 70, '', 25, '2024-02-10 16:44:49', '2024-02-10 16:44:49'),
(71, '2023-07-06', '2023-07-07', '445-448', 'Muvofiq', 'Ishanova Sh.', 71, '', 25, '2024-02-10 16:50:54', '2024-02-10 16:50:54'),
(72, '2023-07-06', '2023-07-07', '334-387', 'Muvofiq', 'Ishanova Sh', 72, '', 25, '2024-02-10 17:00:11', '2024-02-10 17:00:11'),
(73, '2023-07-07', '2023-07-10', '544-571', 'Muvofiq', 'Ishanova Sh.', 73, '', 25, '2024-02-10 17:20:05', '2024-02-10 17:20:05'),
(74, '2023-07-07', '2023-07-10', '449-543', 'Muvofiq', 'Yerxodjaeva M.', 74, '', 25, '2024-02-10 17:28:48', '2024-02-10 17:28:48'),
(75, '2023-07-10', '2023-07-11', '6', 'Muvofiq', 'Yerxodjaeva M.', 75, '', 25, '2024-02-10 17:36:01', '2024-02-10 17:36:01'),
(76, '2023-07-10', '2023-07-11', '572-586', 'Muvofiq', 'Yerxodjaeva M.', 76, '', 25, '2024-02-10 17:41:55', '2024-02-10 17:41:55'),
(77, '2023-07-10', '2023-07-11', '587-674', 'Muvofiq', 'Ishanova Sh.', 77, '', 25, '2024-02-12 09:36:18', '2024-02-12 09:36:18'),
(78, '2023-07-10', '2023-07-11', '517-545', 'Muvofiq', 'Xaitova M', 78, '', 25, '2024-02-12 09:45:02', '2024-02-12 09:45:02'),
(79, '2023-07-10', '2023-07-11', '675-701. 717-749', 'Muvofiq', 'Ishanova Sh.', 79, '', 25, '2024-02-12 10:31:07', '2024-02-12 10:31:07'),
(80, '2023-07-10', '2023-07-11', '702-716.750-761', 'Muvofiq', 'Ishanova Sh.', 80, '', 25, '2024-02-12 10:31:59', '2024-02-12 10:31:59'),
(81, '2023-07-11', '2023-07-12', '812-849', 'Muvofiq', 'Nazirov S.', 81, '', 25, '2024-02-12 10:51:00', '2024-02-12 10:51:00'),
(82, '2023-07-11', '2023-07-15', '762-811,850-878,902-1019,1027-1071', 'Muvofiq', 'Nazirov S.', 82, '', 25, '2024-02-12 11:04:31', '2024-02-12 11:04:31'),
(83, '2023-07-12', '2023-07-13', '879-886', 'Muvofiq', 'Yerxodjaeva M', 83, '', 25, '2024-02-12 11:12:42', '2024-02-12 11:12:42'),
(84, '2023-07-12', '2023-07-13', '887-901', 'Muvofiq', 'Yerxodjaeva M.', 84, '', 25, '2024-02-12 11:25:17', '2024-02-12 11:25:17'),
(85, '2023-07-13', '2023-07-14', '1-31', 'Muvofiq', 'Zaripova D.', 85, '', 25, '2024-02-12 11:47:06', '2024-02-12 11:47:06'),
(86, '2023-07-13', '2023-07-18', '1020-1026,1145-1165,1072-1082,1091-1144', 'Muvofiq', 'Nazirov S.', 86, '', 25, '2024-02-12 11:59:37', '2024-02-12 11:59:37'),
(87, '2023-07-14', '2023-07-17', '1083-1090', 'Muvofiq', 'Yerxodjaeva M.', 87, '', 25, '2024-02-12 12:07:08', '2024-02-12 12:07:08'),
(88, '2023-07-18', '2023-07-19', '34-66', 'Muvofiq', 'Zaripova D.', 88, '', 25, '2024-02-12 12:20:05', '2024-02-12 12:20:05'),
(89, '2023-07-18', '2023-07-19', '67-107', 'Muvofiq', 'Zaripova D.', 89, '', 25, '2024-02-12 12:47:56', '2024-02-12 12:47:56'),
(90, '2023-07-18', '2023-07-19', '32-33', 'Muvofiq', 'Zaripova D.', 90, '', 25, '2024-02-12 12:56:02', '2024-02-12 12:56:02'),
(91, '2023-07-18', '2023-07-19', '1166', 'Nomuvofiq', 'Nazirov S.', 91, '', 25, '2024-02-12 13:02:33', '2024-02-12 13:02:33'),
(92, '2023-07-19', '2023-07-20', '1174-1219', 'Muvofiq', 'Ishanova SH.', 92, '', 25, '2024-02-12 13:10:39', '2024-02-12 13:10:39'),
(93, '2023-07-19', '2023-07-20', '1167-1173', 'Muvofiq', 'Yerxodjaeva M.', 93, '', 25, '2024-02-12 13:16:49', '2024-02-12 13:16:49'),
(94, '2023-07-20', '2023-07-21', '108-124', 'Muvofiq', 'Zaripova D.', 94, '', 25, '2024-02-12 13:23:02', '2024-02-12 13:23:02'),
(95, '2023-07-20', '2023-07-21', '1220-1221', 'Muvofiq', 'Yerxodjaeva M.', 95, '', 25, '2024-02-12 13:27:56', '2024-02-12 13:27:56'),
(96, '2023-07-21', '2023-07-26', '1321-1329,1396-1420,1353-1375,1298-1312,1249-1277', 'Muvofiq', 'Yerxodjaeva M.', 96, '', 25, '2024-02-12 13:38:40', '2024-02-12 13:38:40'),
(97, '2023-07-21', '2023-07-26', '1313-1320,1376-1395,1330-1352,1278-1297,1222-1248', 'Muvofiq', 'Ishanova Sh.', 97, '', 25, '2024-02-12 13:49:32', '2024-02-12 13:49:32'),
(98, '2023-07-24', '2023-07-29', '1512-1575', 'Muvofiq', 'Nazirov S.', 98, '', 25, '2024-02-12 14:21:17', '2024-02-12 14:21:17'),
(99, '2023-07-24', '2023-07-29', '1462', 'Muvofiq', 'Yerxodjaeva M.', 99, '', 25, '2024-02-12 14:25:01', '2024-02-12 14:25:01'),
(100, '2023-07-24', '2023-07-28', '1463-1511', 'Muvofiq', 'Ishanova Sh.', 100, '', 25, '2024-02-12 14:32:01', '2024-02-12 14:32:01'),
(101, '2023-07-24', '2023-07-28', '1461', 'Muvofiq', 'Ishanova Sh.', 101, '', 25, '2024-02-12 14:36:20', '2024-02-12 14:36:20'),
(102, '2023-07-24', '2023-07-27', '1421-1460', 'Muvofiq', 'Yerxodjaeva M', 102, '', 25, '2024-02-12 14:57:41', '2024-02-12 14:57:41'),
(103, '2023-07-26', '2023-07-31', '299-336', 'Muvofiq', 'Zaripova D.', 103, '', 25, '2024-02-12 15:01:50', '2024-02-12 15:01:50'),
(104, '2023-07-27', '2023-08-03', '1576-1742', 'Muvofiq', 'Yerxodjaeva M.', 104, '', 25, '2024-02-12 15:13:11', '2024-02-12 15:13:11'),
(105, '2023-07-27', '2023-07-28', '190-298', 'Muvofiq', 'Zaripova D.', 105, '', 25, '2024-02-13 13:30:35', '2024-02-13 13:30:35'),
(106, '2023-08-01', '2023-08-04', '1753-1772, 1773-1790', 'Muvofiq', 'Yerxodjaeva M.', 106, '', 25, '2024-02-13 13:41:39', '2024-02-13 13:41:39'),
(107, '2023-08-01', '2023-08-03', '1743-1752', 'Muvofiq', 'Ishanova Sh.', 107, '', 25, '2024-02-13 13:48:13', '2024-02-13 13:48:13'),
(108, '2023-08-01', '2023-08-02', '337-404', 'Muvofiq', 'Zaripova D', 108, '', 25, '2024-02-13 14:02:00', '2024-02-13 14:02:00'),
(109, '2023-08-01', '2023-08-05', '1791-1851', 'Muvofiq', 'Nazirov S.', 109, '', 25, '2024-02-13 14:24:11', '2024-02-13 14:24:11'),
(110, '2023-08-04', '2023-08-07', '1852-1891', 'Muvofiq', 'Yerxodjaeva M.', 110, '', 25, '2024-02-13 15:10:14', '2024-02-13 15:10:14'),
(111, '2023-08-04', '2023-08-08', '1892-1939', 'Muvofiq', 'Yerxodjaeva M.', 111, '', 25, '2024-02-13 15:19:02', '2024-02-13 15:19:02'),
(112, '2023-08-07', '2023-08-11', '1940-2012, 2018-2099', 'Muvofiq', 'Ishanova Sh.', 112, '', 25, '2024-02-13 15:26:57', '2024-02-13 15:26:57'),
(113, '2023-08-08', '2023-08-09', '2015-2017', 'Muvofiq', 'Nazirov S.', 113, '', 25, '2024-02-13 17:27:35', '2024-02-13 17:27:35'),
(114, '2023-08-08', '2023-08-09', '405-408', 'Muvofiq', 'Zaripova D.', 114, '', 25, '2024-02-13 17:40:25', '2024-02-13 17:40:25'),
(115, '2023-08-08', '2023-08-09', '2013', 'Muvofiq', 'Ishanova Sh.', 115, '', 25, '2024-02-13 17:48:38', '2024-02-13 17:48:38'),
(116, '2023-08-08', '2023-08-09', '2014', 'Muvofiq', 'Ishanova Sh.', 116, '', 25, '2024-02-13 18:04:33', '2024-02-13 18:04:33'),
(117, '2023-08-09', '2023-08-10', '546-556', 'Muvofiq', 'Xidirova N', 117, '', 25, '2024-02-15 13:54:20', '2024-02-15 13:54:20'),
(118, '2024-02-09', '2024-02-09', '19', 'Muvofiq', 'Yerxodjaeva M.', 118, '', 25, '2024-02-15 16:50:39', '2024-02-15 16:50:39'),
(119, '2024-02-09', '2024-02-09', '20', 'Muvofiq', 'Yerxodjaeva M.', 119, '', 25, '2024-02-15 16:57:17', '2024-02-15 16:57:17'),
(120, '2024-02-15', '2024-02-15', '21', 'Muvofiq', 'Ishanova Sh.', 120, '', 25, '2024-02-16 11:26:21', '2024-02-16 11:26:21'),
(121, '2023-08-09', '2023-08-12', '2100-2205', 'Muvofiq', 'Ishanova Sh.', 121, '', 25, '2024-02-19 13:20:41', '2024-02-19 13:20:41'),
(122, '2023-08-11', '2023-08-14', '2206-2215', 'Muvofiq', 'Yerxodjaeva M.', 122, '', 25, '2024-02-19 13:30:36', '2024-02-19 13:30:36'),
(123, '2023-08-11', '2023-08-16', '9', 'Muvofiq', 'Yerxodjaeva M.', 123, '', 25, '2024-02-19 13:39:28', '2024-02-19 13:39:28'),
(124, '2023-08-15', '2023-08-18', '2216-2344', 'Muvofiq', 'Nazirov S.', 124, '', 25, '2024-02-19 13:49:31', '2024-02-19 13:49:31'),
(125, '2023-08-16', '2023-08-18', '2345-2354', 'Muvofiq', 'Yerxodjaeva M.', 125, '', 25, '2024-02-19 13:57:57', '2024-02-19 13:57:57'),
(126, '2023-08-22', '2023-08-23', '1062-1087', 'Muvofiq', 'Bekbauliev Ch.', 126, '', 25, '2024-02-21 11:26:22', '2024-02-21 11:26:22'),
(127, '2023-08-22', '2023-08-23', '1033-1061', 'Muvofiq', 'Bekbauliev Ch.', 127, '', 25, '2024-02-21 11:31:28', '2024-02-21 11:31:28'),
(128, '2023-08-25', '2023-08-28', '10', 'Muvofiq', 'Ishanova Sh.', 128, '', 25, '2024-02-21 11:42:18', '2024-02-21 11:42:18'),
(129, '2023-09-05', '2023-09-06', '1088-1129', 'Muvofiq', 'Bekbauliev Ch.', 129, '', 25, '2024-02-21 11:55:09', '2024-02-21 11:55:09'),
(130, '2023-09-08', '2023-09-11', '13', 'Muvofiq', 'Yerxodjaeva M.', 130, '', 25, '2024-02-23 15:09:46', '2024-02-23 15:09:46'),
(131, '2024-02-23', '2024-02-23', '22', 'Muvofiq', 'Ishanova Sh.', 132, '', 25, '2024-02-26 12:45:23', '2024-02-26 12:45:23'),
(132, '2024-02-26', '2024-02-26', '23-24', 'Muvofiq', 'Yerxodjaeva M.', 133, '', 25, '2024-02-27 17:12:17', '2024-02-27 17:12:17'),
(133, '2024-02-26', '2024-02-28', '27', 'Muvofiq', 'Yerxodjaeva M.', 134, '', 25, '2024-02-28 16:29:33', '2024-02-28 16:29:33'),
(134, '2024-01-05', '2024-01-06', '166-177', 'Muvofiq', 'Jomurodov S.', 135, '', 25, '2024-02-29 10:10:29', '2024-02-29 10:10:29'),
(135, '2024-01-05', '2024-01-06', '3', 'Muvofiq', 'Yerxodjaeva M.', 136, '', 25, '2024-02-29 10:17:06', '2024-02-29 10:17:06'),
(136, '2024-01-05', '2024-01-08', '2784-2797', 'Muvofiq', 'Yerxodjaeva M.', 137, '', 25, '2024-02-29 10:23:35', '2024-02-29 10:23:35'),
(137, '2024-01-05', '2024-01-06', '1-43', 'Muvofiq', 'Xaitova M.', 138, '', 25, '2024-02-29 10:27:28', '2024-02-29 10:27:28'),
(138, '2024-01-08', '2024-01-09', '44-87', 'Muvofiq', 'Xidirova N.', 139, '', 25, '2024-02-29 10:32:16', '2024-02-29 10:32:16'),
(139, '2024-01-08', '2024-01-09', '88-147', 'Muvofiq', 'Xaitova M.', 140, '', 25, '2024-02-29 10:36:47', '2024-02-29 10:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `type_id` int(11) NOT NULL,
  `id` bigint(20) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT 1,
  `version` int(11) DEFAULT 1,
  `name1` varchar(255) DEFAULT NULL COMMENT 'uz',
  `name2` varchar(255) DEFAULT NULL COMMENT 'ru',
  `name3` varchar(255) DEFAULT NULL COMMENT 'en',
  `name4` varchar(255) DEFAULT NULL COMMENT 'la',
  `val01` varchar(255) DEFAULT NULL,
  `val02` varchar(255) DEFAULT NULL,
  `val03` varchar(255) DEFAULT NULL,
  `val04` varchar(255) DEFAULT NULL,
  `val05` varchar(255) DEFAULT NULL,
  `val06` varchar(255) DEFAULT NULL,
  `val07` varchar(255) DEFAULT NULL,
  `val08` varchar(255) DEFAULT NULL,
  `val09` varchar(255) DEFAULT NULL,
  `val10` varchar(255) DEFAULT NULL,
  `int01` int(11) DEFAULT NULL,
  `int02` int(11) DEFAULT NULL,
  `int03` int(11) DEFAULT NULL,
  `int04` int(11) DEFAULT NULL,
  `int05` int(11) DEFAULT NULL,
  `int06` int(11) DEFAULT NULL,
  `int07` int(11) DEFAULT NULL,
  `int08` int(11) DEFAULT NULL,
  `int09` int(11) DEFAULT NULL,
  `int10` int(11) DEFAULT NULL,
  `num01` double DEFAULT NULL,
  `num02` double DEFAULT NULL,
  `num03` double DEFAULT NULL,
  `num04` double DEFAULT NULL,
  `num05` double DEFAULT NULL,
  `num06` double DEFAULT NULL,
  `num07` double DEFAULT NULL,
  `num08` double DEFAULT NULL,
  `num09` double DEFAULT NULL,
  `num10` double DEFAULT NULL,
  `date01` datetime DEFAULT NULL,
  `date02` datetime DEFAULT NULL,
  `date03` datetime DEFAULT NULL,
  `date04` datetime DEFAULT NULL,
  `date05` datetime DEFAULT NULL,
  `long01` varchar(2000) DEFAULT NULL,
  `long02` varchar(2000) DEFAULT NULL,
  `long03` varchar(2000) DEFAULT NULL,
  `key1` varchar(255) DEFAULT NULL,
  `key2` varchar(255) DEFAULT NULL,
  `key3` varchar(255) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `created_at` timestamp(3) NULL DEFAULT current_timestamp(3),
  `updated_at` timestamp(3) NULL DEFAULT current_timestamp(3)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--


-- --------------------------------------------------------

--
-- Table structure for table `nds`
--

CREATE TABLE `nds` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(511) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crop_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nds`
--

INSERT INTO `nds` (`id`, `type_id`, `number`, `name`, `crop_id`, `created_at`, `updated_at`) VALUES
(17, 3, '99-007:2016', '\"Don xavfsizligi to\'g\'risida\"umumiy texnik reglament.', 25, '2024-01-30 12:05:58', '2024-01-30 12:05:58'),
(18, 1, '1104:2021', 'Vitamin - mineral aralashma bilan boyitilgan oliy va birinchi navli novvoylik bug\'doy uni.', 26, '2024-01-30 14:32:14', '2024-01-30 14:32:14'),
(20, 4, '007-2021', 'Donni qayta ishlash mahsulotlarining xavfsizligi to\'g\'risidagi MAXSUS TEXNIK REGLAMENT', 26, '2024-02-02 11:55:43', '2024-02-02 11:55:43'),
(21, 3, '99-007:2016', '\"Don xavfsizligi to\'g\'risida\"umumiy texnik reglament.', 28, '2024-02-07 12:47:51', '2024-02-07 12:47:51'),
(22, 4, 'MTR.007-2021', 'Donni qayta ishlash mahsulotlarining xavfsizligi to\'g\'risidagi MAXSUS TEXNIK REGLAMENT', 29, '2024-02-07 14:38:57', '2024-02-07 14:38:57'),
(23, 4, '007-2021', 'Donni qayta ishlash mahsulotlarining xavfsizligi to\'g\'risidagi MAXSUS TEXNIK REGLAMENT', 30, '2024-02-08 15:31:07', '2024-02-08 15:31:07'),
(24, 4, '007-2021', 'Donni qayta ishlash mahsulotlarining xavfsizligi to\'g\'risidagi MAXSUS TEXNIK REGLAMENT', 31, '2024-02-08 15:48:25', '2024-02-08 15:48:25'),
(26, 3, '99-007:2016', '\"Don xavfsizligi to\'g\'risida\"umumiy texnik reglament.', 32, '2024-02-12 10:26:21', '2024-02-12 10:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('2c3e7d0d7594c96f32b9923dc228d7365a7bfe4931af919817d8a93384e828dd0bb59bb3d85abc18', 1, 1, 'authToken', '[]', 0, '2024-02-28 16:48:37', '2024-02-28 16:48:37', '2025-02-28 16:48:37'),
('a1eddd256c6d41aead29d6961b53dab702290f8b035a6e8738094d00079babd4686a984bf9a770a4', 1, 1, 'authToken', '[]', 0, '2024-02-28 16:47:41', '2024-02-28 16:47:41', '2025-02-28 16:47:41'),
('a7c5fdb1c8a6f27a26da370f3c52af387b0a644bd6d9840ee25260209907e4c3c2caf54acd243f7a', 1, 1, 'authToken', '[]', 0, '2024-02-28 16:50:02', '2024-02-28 16:50:02', '2025-02-28 16:50:02'),
('b50143a5d7d02a52ea1d6a16e380022159be40cc6e6a25761eecfcb5a343f6b98ffa0dad1bf5c85c', 1, 1, 'authToken', '[]', 0, '2024-02-28 16:48:47', '2024-02-28 16:48:47', '2025-02-28 16:48:47'),
('bad1524f5362fcddc42bbd3339820ef34b530ad0d08872d3861a5cd4a6e4e29871512c6519fe427b', 1, 1, 'authToken', '[]', 0, '2024-02-28 16:49:09', '2024-02-28 16:49:09', '2025-02-28 16:49:09'),
('f66948f348f20d4e32dd5220b534e113cecb8913a19264ecdfc6e932d7beec3bb7a98bb0fd1b81b8', 1, 1, 'authToken', '[]', 0, '2024-02-28 16:13:56', '2024-02-28 16:13:56', '2025-02-28 16:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`

--
-- Table structure for table `oauth_clients`
--

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'jmJLJ7N4Chp33aFsvd25avSyKFmKl8o62EPCD8fm', NULL, 'http://localhost', 1, 0, 0, '2024-02-28 16:12:51', '2024-02-28 16:12:51'),
(2, NULL, 'Laravel Password Grant Client', 'MTAcV7JShMb9ePdazXlnzjHbf2NxGQq3C8vEuhhJ', 'users', 'http://localhost', 0, 1, 0, '2024-02-28 16:12:51', '2024-02-28 16:12:51');

-- --------------------------------------------------------

-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-02-28 16:12:51', '2024-02-28 16:12:51');

-- ------------------------------------------------------------------------------

--
-- Table structure for table `organization_companies`
--

CREATE TABLE `organization_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inn` int(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_companies`
--

INSERT INTO `organization_companies` (`id`, `name`, `city_id`, `address`, `owner_name`, `phone_number`, `inn`, `created_at`, `updated_at`) VALUES
(1, 'A.J. \"JUMA ELEVATORI\"', 48350, 'Juma shahri, Fitrat ko\'chasi, 2-uy.', 'Пулатов Ш.', '+998 (94) 280-00-67', 304006794, '2024-01-30 12:14:53', '2024-01-30 12:14:53'),
(2, 'A.J. «OQTOSH DON»', 47198, 'Samarqand viloyati, Narpay tumani, J. Mirzayev ko\'chasi, uy. 2.', 'Xudoyberdiev T.', '+998 (94) 280-00-67', 200718868, '2024-01-30 14:23:11', '2024-01-30 14:23:11'),
(3, 'OOO \"NT IBRAT TEXTILE\"', 47184, 'Namangan viloyati, To\'raqo\'rg\'on tumani, A. Navoiy ko\'chasi.', 'Mamadaliev A.', '+998 (93) 498-69-95', 308096674, '2024-01-30 16:13:15', '2024-01-30 16:13:15'),
(4, 'A.J. «DON – XALQ RIZQI»', 47147, 'Qashqadaryo viloyati, Shahrisabz shahri, Beruniy ko\'chasi, 111a uy.', 'Xudoyberdiev A.', '+998 (97) 291-29-57', 200672805, '2024-01-30 16:53:09', '2024-01-30 16:53:09'),
(5, 'A.J \"DUNYO M\"', 48366, 'Qashqadaryo viloyati, Qarshi shahri, Oltinboshoq ko\'chasi, 1-uy.', 'Akbarov K.', '+998 (97) 291-29-57', 201007054, '2024-01-30 17:13:55', '2024-01-30 17:13:55'),
(6, 'ООО \"AGRO SAVDO XOLDING\"', 48319, 'Nurafshon shahri, Chig\'iriq MFY, xaqiqat ko\'chasi.', 'NIYOZOV SAYDALI', '+998 (97) 743-45-68', 304018344, '2024-01-30 17:49:51', '2024-01-30 17:49:51'),
(7, 'A.J. «QASHQADARYODONMAHSULOTLARI»', 48366, 'Qashqadaryo viloyati, Qarshi shahri, I. Mo\'minov ko\'chasi, 68-uy.', 'Karimov X.', '+998 (97) 291-29-57', 200670475, '2024-01-31 09:52:15', '2024-01-31 09:52:15'),
(8, 'M.CH.J. «QAMASHI DON QABUL QILISH»', 47150, 'Qashqadaryo viloyati, Yakkabog\' tumani, temir yo\'l shox bekati, 1-uy.', 'Ergashev E.', '+998 (97) 291-29-57', 200680448, '2024-01-31 10:21:00', '2024-01-31 10:21:00'),
(9, 'M.CH.J. «KOSON DMQQ»', 47130, 'Qashqadaryo viloyati, Koson tumani temiryo\'l shoxbekati ko\'chasi, 1-uy.', 'Ravshanov U.', '+998 (97) 291-29-57', 201614527, '2024-01-31 10:32:36', '2024-01-31 10:32:36'),
(10, 'A.J. «SAMARQANDDONMAHSULOTLARI»', 48350, 'Samarqand viloyati, Samarqand shahri, Ziyokorlar ko\'chasi, uy. 4.', 'Ruziboyev U.', '+998 (94) 280-00-67', 201328304, '2024-01-31 11:13:14', '2024-01-31 11:13:14'),
(11, 'ИП OOO \"MILL EXPO\"', 48375, 'Toshkent viloyati, Angren shahri, Do\'stlik MFY, Do\'stlik ko\'chasi, 253-uy.', 'Ruziev N.', '+998 (90) 353-20-21', 308552240, '2024-01-31 11:45:49', '2024-01-31 11:45:49'),
(12, 'АО ИИ «BEKTEMIR SPIRT EKSPERIMENTAL ZAVODI»', 47233, 'Toshkent shahri, Bektemir tumani, X. Baykaro ko\'chasi, 91.', 'Muminov Sh.', '+998 (97) 711-13-74', 206922060, '2024-02-07 12:03:47', '2024-02-07 12:03:47'),
(13, 'OOO \"TO\'RTKO\'L DON MAHSULOTI\"', 47165, 'Qoraqalpog \'iston Respublikasi, to\' rtko\'l tumani, GULLANBAG QFY.', 'Ruzmetov A.', '+998 (90) 591-62-67', 200392379, '2024-02-07 12:33:23', '2024-02-07 12:33:23'),
(14, 'А.J. «TAXIATOSH DON MAHSULOTLARI»', 47162, 'Taxiatash shahri, Amudaryo tumani, 5-uy.', 'Praliev K.', '+998 (90) 591-62-67', 200366496, '2024-02-07 13:27:13', '2024-02-07 13:27:13'),
(15, 'ООО «CHIMBOY DON»', 47154, 'Res. Qoraqalpog\'iston, Chimboy tumani, K. Avezov ko\'chasi 2.', 'Kadirov K.', '+998 (91) 372-72-08', 200931996, '2024-02-07 14:00:26', '2024-02-07 14:00:26'),
(16, 'А.J. «QO’NG’IROT UN ZAVODI»', 47161, 'Qo\'ng\'irot tumani, sanoat zonasi.', 'Esemuratov B.', '+998 (91) 387-24-13', 200383721, '2024-02-07 14:52:33', '2024-02-07 14:52:33'),
(17, 'АО «QORAQALPOQ DON MAHSULOTLARI»', 47164, 'Qoraqalpog \' iston Respublikasi, Nukus shahri, Qizilketken posyolkasi, sanoat zonasi.', 'Yuldashev R.', '+998 (91) 387-24-13', 201036454, '2024-02-07 15:02:53', '2024-02-07 15:02:53'),
(18, 'A.J \"ANDIJONDONMAHSULOTLARI\"', 48352, 'Andijon shahri, Chinobod ko\'chasi, 21-uy', 'Axmedov B.', '+998 (91) 161-06-03', 200230731, '2024-02-07 15:35:39', '2024-02-07 15:35:39'),
(19, 'F.X \"XUMO AGRO PLATINUM\"', 47198, 'Samarqand viloyati, Narpay tumani.', 'Hasanov X.', '+998 (94) 280-00-67', 308062843, '2024-02-08 11:10:06', '2024-02-08 11:10:06'),
(20, 'OOO \"XONQA TABIIY MAXSULOT\"', 47123, 'Xorazm viloyati, Xonqa tumani, To\'maris ko\'chasi, 1 a uy.', 'Sapaev S.', '+998 (97) 451-98-87', 308508404, '2024-02-08 11:21:15', '2024-02-08 11:21:15'),
(21, 'A.J. «JOMBOYDONMAHSULOTLARI»', 47196, 'Samarqand viloyati, Jomboy shahri, Jomboy tumani, Buyuk Ipak yo\'li ko\'chasi, 1 uy.', 'Shomurodov Q.', '+998 (94) 280-00-67', 201736447, '2024-02-08 13:18:43', '2024-02-08 13:18:43'),
(22, 'ИП ООО «OLTIN TEGIRMON»', 48337, 'Toshkent shahri, Yashnaobod tumani., Jarqo\'rg\'on ko\'chasi, 43.', 'Yuldashev M.', '+998 (90) 353-20-21', 300396701, '2024-02-08 13:36:55', '2024-02-08 13:36:55'),
(23, 'OOO «JASURBEK ZUXRIDDIN»', 47202, 'Samarqand viloyati, Kattaqo\'rg\'on shahri, Xosildor ko\'chasi, 16-uy.', 'Murodullaev F.', '+998 (94) 280-00-67', 301665113, '2024-02-08 13:51:54', '2024-02-08 13:51:54'),
(24, 'A.J \"FARGONADONMAHSULOTLARI\"', 47108, 'Farg\'ona shahri, al – Farg\'ona ko\'chasi, 93-uy', 'Ruzmatov A.', '+998 (90) 205-37-25', 200153366, '2024-02-08 14:00:00', '2024-02-08 14:00:00'),
(25, 'OOO \"ISKANDAR DON 2020\"', 47102, 'Paxtakor tumani, Samarqand MFY.', 'Mamayusupov M.', '+998 (90) 180-69-88', 307132470, '2024-02-08 14:39:06', '2024-02-08 14:39:06'),
(26, 'OOO \"XONQA DIYOR \"', 47123, 'Xorazm viloyati, Xonqa tumani, M. Xaitov ko\'chasi, 1 a uy.', 'Sapaev M.', '+998 (97) 451-98-87', 303046612, '2024-02-08 15:05:12', '2024-02-08 15:05:12'),
(27, 'OOO \"OSIYO - DON - GROUP\"', 48342, 'Toshkent shahri, Olmazor tumani, Qizgaldok ko\'chasi 41.', 'Narimonov N.', '+998 (98) 128-95-15', 307795288, '2024-02-08 15:13:57', '2024-02-08 15:27:14'),
(28, 'ООО «SHDM DON KLASTER»', 47227, 'Surxondaryo viloyati, Sho\' rchi tumani, \"Oltinboshoq\" massivi , 1-uy.', 'Turdialiev A.', '+998 (91) 972-28-24', 307749264, '2024-02-08 15:55:09', '2024-02-08 15:55:09'),
(29, 'OOO «TERMEZ JAYXUN CLUSTER»', 47218, 'Surxondaryo viloyati, Jarqo\'rg\'on tumani, Nurli Diyor MFY, N. Boymurodov 1.', 'Xusanov A.', '+998 (94) 023-00-59', 306086807, '2024-02-09 10:59:03', '2024-02-09 10:59:03'),
(30, 'ООО \"SANGZOR-BIZNES-PARRANDA\"', 48324, 'Джизакская область, Мирзачульский район, г.Гагарин, ул. Пахтакор.', 'Мухамадов Ж.', '+998 (90) 180-69-88', 304746112, '2024-02-10 15:29:22', '2024-02-10 15:29:22'),
(31, '\"TOSHBULOQ TEKS AGRO\" UK.', 48362, 'Наманганская область, Наманганский район, Катта-Ташбулок дом 7.', 'Иброхимов И.', '+998 (93) 258-21-11', 308063819, '2024-02-10 15:37:13', '2024-02-10 15:37:13'),
(32, 'OOO «YAKKABOG BOSHOQLARI AGROCLASTER»', 47150, 'Кашкадарьинский область, Яккабагский район, Темир йул шохбекати дом 1.', 'Жавлиев У.', '+998 (97) 291-29-57', 308207770, '2024-02-10 15:54:09', '2024-02-10 15:54:09'),
(33, 'ООО \"AGRODON AAA\"', 47129, 'Кашкадарьинская область, Каршинский район', 'Эргашев А.', '+998 (97) 291-29-57', 308865714, '2024-02-10 16:08:02', '2024-02-10 16:08:02'),
(34, 'A.J \"QO\'QONDONMAHSULOTLARI\"', 47108, 'Ферганская обл. г.Фергана, ул.Кудуклик № 27.', 'Усмонов А.', '+998 (91) 205-37-25', 200918322, '2024-02-10 16:29:32', '2024-02-10 16:29:32'),
(35, 'ООО \"BESHKENT-AGRO KLASTER\"', 47129, 'Кашкадарьинская область, Каршинский район, Улица Хамза.', 'Абдуллаев М.', '+998 (97) 291-29-57', 308238550, '2024-02-10 16:35:22', '2024-02-10 16:35:22'),
(36, 'ООО \"BEK CLUSTER\"', 47217, 'Сырдарьинская область, Мирзабадский район.', 'Ештаев Т.', '+998 (91) 620-17-01', 304937855, '2024-02-10 16:46:29', '2024-02-10 16:46:29'),
(37, 'A.J. «BOGDODDONMAHSULOTLARI»', 47106, 'г.Фергана, Багдадский район, кишлак Отхана.', 'Ходжаев А.', '+998 (91) 205-37-25', 200158304, '2024-02-10 16:55:09', '2024-02-10 16:55:09'),
(38, 'OOO \"BANDIXON SHDM DON CLASTER\"', 48376, 'Сурхандарьинская область, Бандиханский район, махалля Бандихан.', 'Турдалиев А.', '+998 (91) 972-28-24', 305000030, '2024-02-10 17:16:28', '2024-02-10 17:16:28'),
(39, 'A.J. «SHO\'RCHIDONMAHSULOTLARI»', 47227, 'Сурхандарьинская область, Шурчинский р-н, пос. \"Олтин бошок\" дом 1.', 'Астанакулов С.', '+998 (91) 972-28-24', 200501368, '2024-02-10 17:25:15', '2024-02-10 17:25:15'),
(40, 'ООО \"XXI BREAD FACTORY\"', 47197, 'Самаркандская область, Акдарьинский район, махалля Тараккиёт.', 'Олимов Д.', '+998 (94) 280-00-67', 307359378, '2024-02-10 17:30:42', '2024-02-10 17:30:42'),
(41, 'OOO «WHITE - GOLD - KLASTER»', 47215, 'Сирдарьинская область, Сирдарьинский район.', 'Хайдаров Н.', '+998 (91) 620-17-01', 308252456, '2024-02-10 17:37:53', '2024-02-10 17:37:53'),
(42, 'AO \"GALLA - ALTEG\"', 48337, 'г.Ташкент, ул., Элбек 37.', 'Кодиров А.', '+998 (99) 911-88-11', 200547594, '2024-02-12 09:31:59', '2024-02-12 09:31:59'),
(43, 'OOO «INDORAMA AGRO»', 47148, 'Кашкадарьинская область, Нишанский район.', 'Рейна Д.', '+998 (97) 291-29-57', 305862324, '2024-02-12 09:39:43', '2024-02-12 09:39:43'),
(44, 'A.J \"TOSHKENTDONMAHSULOTLARI\"', 48337, 'г.Ташкент, Яшнабадский район, ул, М.Ашрафий, 106', 'Косимов Б.', '+998 (99) 892-28-76', 200547706, '2024-02-12 10:57:23', '2024-02-12 10:57:23'),
(45, 'ООО \"POLY TEX SIRDARYO\"', 48333, 'Сырдарьинская область, Сайхунабадский район.', 'Абдурахмонов Д.', '+998 (91) 620-17-01', 301880543, '2024-02-12 11:08:53', '2024-02-12 11:08:53'),
(46, 'ООО \"SARA DON - 2022\"', 47190, 'Навоийская область, Кармана район, М.Бахром МФЙ.', 'Рашидов А.', '+998 (90) 501-82-20', 310101160, '2024-02-12 11:17:33', '2024-02-12 11:17:33'),
(47, 'F/X \"MIRZAEV SHUXRAT KENJAEVICH\"', 47200, 'Самаркандская область, Пахтачинский район, махалля Бустон.', 'Мирзаев Ш.', '+998 (94) 280-00-67', 302520704, '2024-02-12 11:43:22', '2024-02-12 11:43:22'),
(48, 'A.J \"SURXONDARYODONMAHSULOTLARI\"', 48363, 'Сурхандарьинская область, Термизский район, ул. Зерновая, дом 1.', 'Ходжаев Э.', '+998 (91) 972-28-24', 200471786, '2024-02-12 11:54:26', '2024-02-12 11:54:26'),
(49, 'ООО \"BOBUR QISHLOQ XO\'JALIGI\"', 48334, 'Сырдарьинская область, Сардобинский район.', 'Эшонхонов К.', '+998 (91) 620-17-01', 307290964, '2024-02-12 12:02:00', '2024-02-12 12:02:00'),
(50, 'ООО \"KATTAKURGAN G\'ALLA CLUSTER\"', 47202, 'Самаркандский область, Каттакурганский район, махалля Палвонтепа.', 'Раззаков Х.', '+998 (94) 280-00-67', 308965011, '2024-02-12 12:40:52', '2024-02-12 12:40:52'),
(51, 'A.J. «SHOVOTDONMAHSULOTLARI»', 47126, 'Хорезмский область, Шавот район, ул.Маданият, 3 дом', 'Давлетов Д.', '+998 (97) 451-98-87', 201157842, '2024-02-12 13:04:44', '2024-02-12 13:04:44'),
(52, 'ООО \"ZAMON TEKS\"', 47214, 'Сырдарьинская область, Хавасинский район, Бунёдкор МФЙ.', 'Юсупов М.', '+998 (91) 620-17-01', 304596893, '2024-02-12 13:12:22', '2024-02-12 13:12:22'),
(53, 'ООО \"SARDOBA UNIVERSAL CLUSTER\"', 48334, 'Сырдарьинская область, Сардобинский район.', 'Эргашев К.', '+998 (91) 620-17-01', 307925583, '2024-02-12 13:24:50', '2024-02-12 13:24:50'),
(54, 'A.J. «OHANGARON DON»', 47243, 'Ташкентская область, Охангаранский р-н., Саноат зона, дом 1.', 'Касимов Б.', '+998 (90) 372-02-03', 200463369, '2024-02-12 13:35:09', '2024-02-12 13:35:09'),
(55, 'OOO «ZARBDOR - ZOMIN G\'ALLA KLASTER»', 47101, 'Джизакская обл, Зарбдорский район, ул.Галлакор, дом 1.', 'Солиев Ш.', '+998 (90) 180-69-88', 307723614, '2024-02-12 14:14:13', '2024-02-12 14:14:13'),
(56, 'OOO «DAFNA IFORI»', 48354, 'Джизакская область, Ш.Рашидовский район, ул.Пахтакор, дом 33.', 'Мирзаев С.', '+998 (90) 180-69-88', 305182736, '2024-02-12 14:26:59', '2024-02-12 14:26:59'),
(57, 'A.J. «BOG’OT DON»', 47119, 'Хорезмский область, Богот район, ул.Кулонкорабог кишлоги', 'Гаффаров Х.', '+998 (97) 451-98-87', 200426279, '2024-02-12 14:45:22', '2024-02-12 14:45:22'),
(58, 'A.J \"OQOLTINDONMAHSULOTLARI\"', 48333, 'Сырдаринская область, Сайхунабадский район.', 'Султонов Ф.', '+998 (91) 620-17-01', 200309810, '2024-02-12 15:08:24', '2024-02-12 15:08:24'),
(59, 'ООО \"AGRODON QIZILTEPA KLASTERI\"', 47191, 'Навоийская область, Кизилтепинский район,Гойибон МФЙ.', 'Хужаев И.К.', '+998 (90) 501-82-20', 309785726, '2024-02-13 13:33:57', '2024-02-13 13:33:57'),
(60, 'X/K \"SHERBEK KELAJAGI\"', 47191, 'Навоийская область, Кизилтепинский район, махалля Бустон Гумбаз - 1.', 'Хужаев И.К.', '+998 (90) 501-82-20', 302854368, '2024-02-13 13:44:11', '2024-02-13 13:44:11'),
(61, 'A.J. «XOVOSDONMAHSULOTLARI»', 47214, 'Сырдарьинский обл, Хаваст ш, ул. Табассум -1.', 'Кодиров Ж.', '+998 (91) 620-17-01', 304973356, '2024-02-13 14:16:51', '2024-02-13 14:16:51'),
(62, 'A.J \"XONQADONMAHSULOTLARI\"', 47123, 'Хорезмская обл., Ханкинский р-н., ул., Мулла -Ёп, 64.', 'Абдуллаев Р.', '+998 (97) 451-98-87', 200429242, '2024-02-13 14:26:48', '2024-02-13 14:26:48'),
(63, 'OOO «GULISTON SAYQAL TEXTIL»', 48357, 'Сирдарьинская область, Гулитанский район.', 'Бойкузиев Д.', '+998 (91) 620-17-01', 305950129, '2024-02-13 17:23:45', '2024-02-13 17:23:45'),
(64, 'F/X \"D\" OMONBOY FARMONOV', 47201, 'Самаркандская область, Иштиханский район.', 'Урокова М.', '+998 (94) 280-00-67', 206195659, '2024-02-13 17:29:19', '2024-02-13 17:29:19'),
(65, 'УзР ИИБ хузуридаги ЖИЭД 4 - минтакавий худуд 41 - сонли манзил калоннияси', 47226, 'Шерабадский район, махалля Мехробод.', 'Турахонов Ж.', '+998 (88) 550-16-16', 205801236, '2024-02-13 17:43:50', '2024-02-13 17:43:50'),
(66, 'A.J. «QO’RGONTEPADONMAHSULOTLARI»', 47077, 'Андижанский обл., г.Кургантепа, улица Бобурийлар дом №100.', 'Мамажалилов Ш.', '+998 (91) 161-06-03', 200279414, '2024-02-19 13:11:12', '2024-02-19 13:11:12'),
(67, 'OOO \"BOYAVUT DON KLASTER\"', 47216, 'Сирдарьинская область, Баявутский район.', 'Комилов Ш.', '+998 (91) 620-17-01', 307601250, '2024-02-19 13:23:13', '2024-02-19 13:23:13'),
(68, 'OOO «BCT CLUSTER AGROKOMPLEKS»', 47094, 'Бухарская область, г.Ромитан, ул. А.Темура, дом 4.', 'Одилов О.И.', '+998 (91) 310-30-12', 304964016, '2024-02-19 13:51:40', '2024-02-19 13:51:40'),
(69, 'ООО \"INTERGRAIN\"', 47215, 'Сырдарьинская область, город Янгиер, ул. А.Жомий.', 'ХАДЖИ ХАЙРУДДИН БАШИР АХМАД АХМАДИ', '+998 (97) 743-45-68', 305055157, '2024-02-21 11:34:49', '2024-02-21 11:34:49'),
(70, 'A.J \"QIZIL TEPA UN ZAVODI\"', 47191, 'г.Кизилтепа, ул., Ёшлик дом 2.', 'Гадоев Ж.', '+998 (97) 322-93-33', 201577264, '2024-02-23 15:02:47', '2024-02-23 15:04:50'),
(71, '\"Uchkurgan tektli\" MChJ', 47187, 'Xojiobod MFY bog\' ko\'chasi 1-uy', 'Sh.S.Mirzakbarov', '+998 (69) 462-00-03', 207191251, '2024-02-29 10:11:42', '2024-02-29 10:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `prepared_companies`
--

CREATE TABLE `prepared_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prepared_companies`
--

INSERT INTO `prepared_companies` (`id`, `name`, `country_id`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'A.J. \"JUMA ELEVATORI\"', 234, 4009, '2024-01-30 12:15:38', '2024-01-30 12:15:38'),
(2, 'A.J. «OQTOSH DON»', 234, 4009, '2024-01-30 14:24:02', '2024-01-30 14:24:02'),
(3, 'OOO \"NT IBRAT TEXTILE\"', 234, 4007, '2024-01-30 16:14:56', '2024-01-30 16:15:33'),
(4, 'A.J. «DON – XALQ RIZQI».', 234, 4005, '2024-01-30 16:54:06', '2024-01-30 16:54:06'),
(5, 'A.J \"DUNYO M\", Elevator.', 234, 4005, '2024-01-30 17:14:33', '2024-01-30 17:14:33'),
(6, 'TOO \"AK BIDAY\"', 112, NULL, '2024-01-30 17:50:48', '2024-01-30 17:50:48'),
(7, 'A.J. «QASHQADARYODONMAHSULOTLARI»', 234, 4005, '2024-01-31 09:52:55', '2024-01-31 09:52:55'),
(8, 'M.CH.J. «QAMASHI DON QABUL QILISH»', 234, 4005, '2024-01-31 10:21:53', '2024-01-31 10:21:53'),
(9, 'M.CH.J. «KOSON DMQQ»', 234, 4005, '2024-01-31 10:33:13', '2024-01-31 10:33:13'),
(10, 'A.J. «SAMARQANDDONMAHSULOTLARI»', 234, 4009, '2024-01-31 11:14:58', '2024-01-31 11:14:58'),
(11, 'ИП OOO \"MILL EXPO\"', 234, 4012, '2024-01-31 11:46:30', '2024-01-31 11:46:30'),
(12, 'TOO \"XPP LANA\"', 112, NULL, '2024-02-07 11:11:12', '2024-02-07 11:11:12'),
(13, 'TOO OYL GROUPP', 112, NULL, '2024-02-07 11:36:55', '2024-02-07 11:36:55'),
(14, 'TOO AGRO DAMU', 112, NULL, '2024-02-07 11:46:37', '2024-02-07 11:46:37'),
(15, 'TOO FIRMA ARGO', 112, NULL, '2024-02-07 12:04:33', '2024-02-07 12:04:33'),
(16, 'TOO ALTYN QOIMA SK', 112, NULL, '2024-02-07 12:22:11', '2024-02-07 12:22:11'),
(17, 'TOO NAN ABRAYI', 112, NULL, '2024-02-07 12:27:14', '2024-02-07 12:27:14'),
(18, 'OOO \"TO\'RTKO\'L DON MAHSULOTI\"', 234, 4006, '2024-02-07 12:34:05', '2024-02-07 12:34:05'),
(19, 'А.J. «TAXIATOSH DON MAHSULOTLARI»', 234, 4006, '2024-02-07 13:27:47', '2024-02-07 13:27:47'),
(20, 'ООО «CHIMBOY DON»', 234, 4006, '2024-02-07 14:01:10', '2024-02-07 14:01:10'),
(21, 'А.J. «QO’NG’IROT UN ZAVODI»', 234, 4006, '2024-02-07 14:54:07', '2024-02-07 14:54:07'),
(22, 'АО «QORAQALPOQ DON MAHSULOTLARI»', 234, 4006, '2024-02-07 15:03:20', '2024-02-07 15:03:20'),
(23, 'A.J \"ANDIJONDONMAHSULOTLARI\"', 234, 3999, '2024-02-07 15:36:01', '2024-02-07 15:36:01'),
(24, 'F.X \"XUMO AGRO PLATINUM\"', 234, 4009, '2024-02-08 11:10:39', '2024-02-08 11:10:39'),
(25, 'OOO \"XONQA TABIIY MAXSULOT\"', 234, 4004, '2024-02-08 11:21:44', '2024-02-08 11:21:44'),
(26, 'A.J. «JOMBOYDONMAHSULOTLARI»', 234, 4009, '2024-02-08 13:19:14', '2024-02-08 13:19:14'),
(27, 'ИП ООО «OLTIN TEGIRMON»', 234, 4121, '2024-02-08 13:37:27', '2024-02-08 13:37:27'),
(28, 'OOO «JASURBEK ZUXRIDDIN»', 234, 4009, '2024-02-08 13:52:17', '2024-02-08 13:52:17'),
(29, 'A.J \"FARGONADONMAHSULOTLARI\"', 234, 4003, '2024-02-08 14:00:45', '2024-02-08 14:00:45'),
(30, 'OOO \"ISKANDAR DON 2020\"', 234, 4002, '2024-02-08 14:39:31', '2024-02-08 14:39:31'),
(31, 'OOO \"XONQA DIYOR \"', 234, 4004, '2024-02-08 15:05:52', '2024-02-08 15:05:52'),
(32, 'OOO \"АЛТАЙАГРОСОЮЗ\"', 181, NULL, '2024-02-08 15:15:38', '2024-02-08 15:15:38'),
(33, 'TOO KAZ EXPORT 2020', 112, NULL, '2024-02-08 15:46:38', '2024-02-08 15:46:38'),
(34, 'ООО «SHDM DON KLASTER»', 234, 4011, '2024-02-08 15:55:42', '2024-02-08 15:55:42'),
(35, 'ТОО \"ДОСТЫКСКИЙ ЭЛЕВАТОР\"', 112, NULL, '2024-02-09 10:45:25', '2024-02-09 10:45:25'),
(36, 'OOO «TERMEZ JAYXUN CLUSTER»', 234, 4011, '2024-02-09 10:59:35', '2024-02-09 10:59:35'),
(37, 'Pulati DQQSH', 234, 4005, '2024-02-09 12:06:52', '2024-02-09 12:06:52'),
(38, 'Gulbog\' DQQSH', 234, 4005, '2024-02-09 12:07:23', '2024-02-09 12:07:23'),
(39, 'Muborak don filial', 234, 4005, '2024-02-09 12:07:52', '2024-02-09 12:07:52'),
(40, 'Surxon DQQSH', 234, 4005, '2024-02-09 12:08:18', '2024-02-09 12:08:18'),
(41, 'G\'uzor un filiali', 234, 4005, '2024-02-09 12:08:47', '2024-02-09 12:08:47'),
(42, 'Qamashi DQQSH', 234, 4005, '2024-02-09 14:07:13', '2024-02-09 14:07:13'),
(43, 'Yakkabog\' don', 234, 4005, '2024-02-09 14:09:28', '2024-02-09 14:09:28'),
(44, 'Paxtakor DQQSH', 234, 4005, '2024-02-09 15:51:17', '2024-02-09 15:51:17'),
(45, 'Yettitom DQQSH', 234, 4005, '2024-02-09 15:51:45', '2024-02-09 16:33:21'),
(46, 'Kitob don filial', 234, 4005, '2024-02-09 15:52:21', '2024-02-09 15:52:21'),
(47, 'OOO \"AGRO AAA\" Batosh DQQSH', 234, 4005, '2024-02-09 16:50:16', '2024-02-09 16:50:34'),
(48, 'Do\'stlik DQQSH', 234, 4002, '2024-02-10 15:30:13', '2024-02-10 15:30:13'),
(49, '\"Намангандон\" АЖ', 234, 4007, '2024-02-10 15:37:43', '2024-02-10 15:37:43'),
(50, 'OOO «YAKKABOG BOSHOQLARI AGROCLASTER»', 234, 4005, '2024-02-10 15:54:56', '2024-02-10 15:54:56'),
(51, 'Батош ДККШ и Кашкадарёдонмахсулотлари АЖ', 234, 4005, '2024-02-10 16:09:53', '2024-02-10 16:09:53'),
(52, 'A.J \"QO\'QONDONMAHSULOTLARI\"', 234, 4003, '2024-02-10 16:29:52', '2024-02-10 16:29:52'),
(53, '\"Ок олтин дон махсулотлари\" АЖ.', 234, 4010, '2024-02-10 16:47:11', '2024-02-10 16:47:11'),
(54, 'A.J. «BOGDODDONMAHSULOTLARI»', 234, 4003, '2024-02-10 16:55:49', '2024-02-10 16:55:49'),
(55, 'OOO \"BANDIXON SHDM DON CLASTER\"', 234, 4011, '2024-02-10 17:17:08', '2024-02-10 17:17:08'),
(56, 'A.J. «SHO\'RCHIDONMAHSULOTLARI»', 234, 4011, '2024-02-10 17:25:36', '2024-02-10 17:25:36'),
(57, 'ООО \"XXI BREAD FACTORY\"', 234, 4009, '2024-02-10 17:31:04', '2024-02-10 17:31:04'),
(58, 'OOO «WHITE - GOLD - KLASTER»', 234, 4010, '2024-02-10 17:38:19', '2024-02-10 17:38:19'),
(59, 'AO \"GALLA - ALTEG\"', 234, 4121, '2024-02-12 09:32:19', '2024-02-12 09:32:19'),
(60, 'Nuriston DQQSH', 234, 4005, '2024-02-12 09:40:31', '2024-02-12 09:40:31'),
(61, 'OOO «INDORAMA AGRO»', 234, 4010, '2024-02-12 09:52:28', '2024-02-12 09:52:28'),
(62, 'Mirzacho\'l DQQSH', 234, 4002, '2024-02-12 10:47:28', '2024-02-12 10:47:28'),
(63, 'A.J \"TOSHKENTDONMAHSULOTLARI\"', 234, 4121, '2024-02-12 10:57:48', '2024-02-12 10:57:48'),
(64, 'ООО \"POLY TEX SIRDARYO\"', 234, 4010, '2024-02-12 11:09:20', '2024-02-12 11:09:20'),
(65, 'АО \"Навоийдонмахсулотлари\"', 234, 4008, '2024-02-12 11:19:21', '2024-02-12 11:19:21'),
(66, 'F/X \"MIRZAEV SHUXRAT KENJAEVICH\"', 234, 4009, '2024-02-12 11:43:54', '2024-02-12 11:43:54'),
(67, 'A.J \"SURXONDARYODONMAHSULOTLARI\"', 234, 4011, '2024-02-12 11:54:49', '2024-02-12 11:54:49'),
(68, 'Бобур ДККШ, \"Ок олтин дон махсулотлари\" АЖ.', 234, 4010, '2024-02-12 12:02:45', '2024-02-12 12:02:45'),
(69, 'ООО \"KATTAKURGAN G\'ALLA CLUSTER\"', 234, 4009, '2024-02-12 12:41:46', '2024-02-12 12:41:46'),
(70, 'A.J. «SHOVOTDONMAHSULOTLARI»', 234, 4004, '2024-02-12 13:05:21', '2024-02-12 13:05:21'),
(71, '\"Ховосдонмахсулотлари\" АЖ.', 234, 4010, '2024-02-12 13:13:34', '2024-02-12 13:13:34'),
(72, 'ООО \"SARDOBA UNIVERSAL CLUSTER\"', 234, 4010, '2024-02-12 13:25:10', '2024-02-12 13:25:10'),
(73, 'A.J. «OHANGARON DON»', 234, 4012, '2024-02-12 13:35:34', '2024-02-12 13:35:34'),
(74, '\"Зарбдор элеватор\" АЖ.', 234, 4002, '2024-02-12 14:15:43', '2024-02-12 14:15:43'),
(75, 'OOO «DAFNA IFORI»', 234, 4002, '2024-02-12 14:28:16', '2024-02-12 14:28:16'),
(76, 'A.J. «BOG’OT DON»', 234, 4004, '2024-02-12 14:46:29', '2024-02-12 14:46:29'),
(77, 'A.J \"OQOLTINDONMAHSULOTLARI\"', 234, 4010, '2024-02-12 15:08:44', '2024-02-12 15:08:44'),
(78, 'A.J. «Qiziltepaunzavodi»', 234, 4008, '2024-02-13 13:35:17', '2024-02-13 13:35:17'),
(79, 'A.J. «XOVOSDONMAHSULOTLARI»', 234, 4010, '2024-02-13 14:19:18', '2024-02-13 14:19:18'),
(80, 'A.J \"XONQADONMAHSULOTLARI\"', 234, 4004, '2024-02-13 14:27:54', '2024-02-13 14:27:54'),
(81, '\"Гулистон\" ДККШ.', 234, 4010, '2024-02-13 17:24:13', '2024-02-13 17:24:13'),
(82, '\"Иштихон\" ДККШ.', 234, 4009, '2024-02-13 17:31:04', '2024-02-13 17:31:04'),
(83, 'УзР ИИБ хузуридаги ЖИЭД 4 - минтакавий худуд 41 - сонли манзил калоннияси', 234, 4011, '2024-02-13 17:44:35', '2024-02-13 17:44:35'),
(84, 'TOO \"AGRIMER\"', 112, NULL, '2024-02-15 16:52:52', '2024-02-15 16:52:52'),
(86, 'ТОО \"АGRIMER ZHANYSPAY\"', 112, NULL, '2024-02-16 11:21:33', '2024-02-16 11:21:33'),
(87, 'A.J. «QO’RGONTEPADONMAHSULOTLARI»', 234, 3999, '2024-02-19 13:11:41', '2024-02-19 13:11:41'),
(88, '\"Галлакор\" ДККШ.', 234, 4010, '2024-02-19 13:24:07', '2024-02-19 13:24:07'),
(89, 'OOO «BCT CLUSTER AGROKOMPLEKS»', 234, 4000, '2024-02-19 13:53:20', '2024-02-19 13:53:20'),
(90, 'ТОО \"МАМЛЮТСКИЙ МУКАМОЛЬНЫЙ КОМБИНАТ\"', 112, NULL, '2024-02-21 11:35:33', '2024-02-21 11:35:33'),
(91, 'A.J \"QIZIL TEPA UN ZAVODI\"', 234, 4008, '2024-02-23 15:03:13', '2024-02-23 15:03:13'),
(92, 'ТОО \"ЖАНЫСБАЙ XXI\"', 234, NULL, '2024-02-26 12:25:25', '2024-02-27 17:02:11'),
(93, 'ТОО 1. \"АGRIMER ZHANYSPAY\", TOO 2. \"КОЙБАГОРСКИЙ ЭЛЕВАТОР\"', 112, NULL, '2024-02-27 16:59:51', '2024-02-27 17:02:54'),
(94, 'test', 234, 4003, '2024-02-29 11:09:36', '2024-02-29 11:09:36'),
(95, 'test', 234, 4000, '2024-02-29 15:11:14', '2024-02-29 15:11:14'),
(96, 'Azimebk', 234, 3999, '2024-02-29 16:44:04', '2024-02-29 16:44:04'),
(97, 'test', 234, 3999, '2024-03-01 18:06:24', '2024-03-01 18:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `quality_indacators`
--

CREATE TABLE `quality_indacators` (
  `id` int(11) NOT NULL,
  `name` varchar(511) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nds_id` int(11) NULL,
  `parent_id` int(11) DEFAULT NULL,
  `pre_name` int(2) NOT NULL DEFAULT 1,
  `nd_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quality_indacators`
--

INSERT INTO `quality_indacators` (`id`, `name`, `nds_id`, `parent_id`, `pre_name`, `nd_name`, `created_at`, `updated_at`) VALUES
(108, 'Зараженность вредителями', 25, NULL, 1, 'ГОСТ 13586.4-83', '2024-01-30 12:07:32', '2024-01-30 12:07:32'),
(109, 'Загрязненность мертвыми насекомыми-вредителями', 25, NULL, 1, 'ГОСТ 34165-2017', '2024-01-30 12:09:19', '2024-01-30 12:09:19'),
(110, 'Спорынья и головня (по совокупности)', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:09:46', '2024-01-30 12:09:46'),
(111, 'Спорынья', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:10:08', '2024-01-30 12:10:08'),
(112, 'Горчак ползучий, софора лисохвостная, термопсис ланцетный (по совокупности)', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:10:46', '2024-01-30 12:10:46'),
(113, 'Вязель разноцветный', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:11:10', '2024-01-30 12:11:10'),
(114, 'Гелиотроп\r\nопушенноплодный', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:11:31', '2024-01-30 12:11:31'),
(115, 'Триходесма седая', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:11:59', '2024-01-30 12:11:59'),
(116, 'Головневые (мараные, синегузочные) зерна', 25, NULL, 1, 'ГОСТ 30483-97', '2024-01-30 12:12:26', '2024-01-30 12:12:26'),
(117, 'Фузариозные зерна', 25, NULL, 1, 'Oۥz DSt 1217:2014', '2024-01-30 12:12:47', '2024-01-30 09:53:11'),
(118, 'Цвет', 26, NULL, 1, 'ГОСТ 27558', '2024-01-30 14:39:15', '2024-01-30 15:27:58'),
(119, 'Запах', 26, NULL, 1, 'ГОСТ 27558', '2024-01-30 14:41:48', '2024-01-30 15:29:55'),
(120, 'Вкус', 26, NULL, 1, 'ГОСТ 27558', '2024-01-30 14:42:31', '2024-01-30 15:35:19'),
(121, 'Белизна', 26, NULL, 1, 'ГОСТ 26361', '2024-01-30 14:43:13', '2024-01-30 15:35:52'),
(122, 'Крупность помола', 26, NULL, 1, 'ГОСТ 27560', '2024-01-30 14:43:48', '2024-01-30 15:36:26'),
(123, 'Массовая доля сырой клейковины', 26, NULL, 1, 'ГОСТ 27839', '2024-01-30 15:37:05', '2024-01-30 15:37:05'),
(124, 'Качество сырой клейковины', 26, NULL, 1, 'ГОСТ 27839', '2024-01-30 15:37:33', '2024-01-30 15:37:33'),
(125, 'Зараженность вредителями', 28, NULL, 1, 'ГОСТ 30483-97; 13586.4-83', '2024-02-07 12:38:53', '2024-02-07 12:38:53'),
(126, 'Загрязненность мертвыми насекомыми-вредителями', 28, NULL, 1, 'ГОСТ 34165-2017', '2024-02-07 12:39:59', '2024-02-07 12:39:59'),
(127, 'Испорченные зерна', 28, NULL, 1, 'ГОСТ 30483-97', '2024-02-07 12:40:44', '2024-02-07 12:40:44'),
(128, 'Пожелтевшие зерна', 28, NULL, 1, 'ГОСТ 30483-97', '2024-02-07 12:41:47', '2024-02-07 12:41:47'),
(129, 'Зараженность вредителями', 29, NULL, 1, 'ГОСТ 26312.3-84', '2024-02-07 14:19:54', '2024-02-07 14:19:54'),
(130, 'Загрязненность вредителями', 29, NULL, 1, 'ГОСТ 34165-2017', '2024-02-07 14:20:30', '2024-02-07 14:20:30'),
(131, 'Металломагнитная примесь, мг в 1 кг продукта, не более размером отдельнқх частиц в наибольшем линейном измерении не более 0.3 мм и   (или) массой не более 0.4 мг', 29, NULL, 1, 'ГОСТ 20239', '2024-02-07 14:23:02', '2024-02-07 14:23:02'),
(132, 'Содержание минеральной примеси', 29, NULL, 1, 'ГОСТ 26312.4-84', '2024-02-07 14:23:55', '2024-02-07 14:23:55'),
(133, 'Зараженность вредителями', 30, NULL, 1, 'ГОСТ 26312.3-84', '2024-02-08 15:22:15', '2024-02-08 15:22:15'),
(134, 'Загрязненность вредителями', 30, NULL, 1, 'ГОСТ 34165-2017', '2024-02-08 15:22:56', '2024-02-08 15:22:56'),
(135, 'Влажность', 30, NULL, 1, 'ГОСТ 26312.7', '2024-02-08 15:23:52', '2024-02-08 15:23:52'),
(136, 'Металломагнитная примесь, мг в 1 кг продукта, не более размером отдельных частиц в наибольшем линейном измерении не более 0.3 мм и (или) массой не более 0.4 мг', 30, NULL, 1, 'ГОСТ 20239', '2024-02-08 15:25:19', '2024-02-08 15:25:19'),
(137, 'Содержание минеральной примесь', 30, NULL, 1, 'ГОСТ 26312.4', '2024-02-08 15:26:02', '2024-02-08 15:26:02'),
(138, 'Влажность', 31, NULL, 1, 'ГОСТ 26312.7', '2024-02-08 15:40:57', '2024-02-08 15:40:57'),
(139, 'Зараженность вредителями', 31, NULL, 1, 'ГОСТ 26312.3-84', '2024-02-08 15:42:12', '2024-02-08 15:42:12'),
(140, 'Загрязненность вредителями', 31, NULL, 1, 'ГОСТ 34165-2017', '2024-02-08 15:42:43', '2024-02-08 15:42:43'),
(141, 'Металломагнитная примесь, мг в 1 кг продукта, не более размером отдельных частиц в наибольшем линейном измерении не более 0.3 мм и (или) массой не более 0.4 мг', 31, NULL, 1, 'ГОСТ 20239', '2024-02-08 15:43:29', '2024-02-08 15:43:29'),
(142, 'Содержание минеральной примеси', 31, NULL, 1, 'ГОСТ 26312.4', '2024-02-08 15:43:54', '2024-02-08 15:43:54'),
(143, 'Зараженность вредителями', 32, NULL, 1, 'ГОСТ 13586,4-83', '2024-02-12 09:56:50', '2024-02-12 09:56:50'),
(144, 'Загрязненность мертвыми насекомыми-вредителями', 32, NULL, 1, 'ГОСТ 34165-2017', '2024-02-12 09:58:02', '2024-02-12 09:58:02'),
(145, 'Спорынья и головня', 32, NULL, 1, 'ГОСТ 30483-97', '2024-02-12 09:58:37', '2024-02-12 09:58:37'),
(146, 'Горчяк ползучий, софора лисохвостная, термопсис ланцетный, плевел опьяняющий, вязель разноцветный (по совокупности)', 32, NULL, 1, 'ГОСТ 30483-97', '2024-02-12 10:01:01', '2024-02-12 10:01:01'),
(147, 'Гелиотроп опушенноплодный и триходесма седая', 32, NULL, 1, 'ГОСТ 30483-97', '2024-02-12 10:01:52', '2024-02-12 10:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `required_amount`
--

CREATE TABLE `required_amount` (
  `id` int(11) NOT NULL,
  `required_amount` float DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sanitariya-epidemiologik osoyishtalik va jamoat salomatligi qo\'mita xulosasi va bayonnomalari', '2024-01-30 07:17:49', '2024-01-30 07:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sertificates`
--

CREATE TABLE `sertificates` (
  `id` int(11) NOT NULL,
  `final_result_id` int(11) NOT NULL,
  `given_date` date DEFAULT NULL,
  `reestr_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sertificates`
--

INSERT INTO `sertificates` (`id`, `final_result_id`, `given_date`, `reestr_number`, `created_at`, `updated_at`) VALUES
(7, 7, '2024-01-10', 106233455, '2024-01-30 17:59:45', '2024-01-30 17:59:45'),
(8, 8, '2024-01-12', 106375663, '2024-01-30 18:08:31', '2024-01-30 18:08:31'),
(9, 9, '2024-01-12', 106378555, '2024-01-31 09:59:53', '2024-01-31 09:59:53'),
(10, 10, '2024-01-12', 106381066, '2024-01-31 10:27:21', '2024-01-31 10:27:21'),
(11, 11, '2024-01-15', 106450666, '2024-01-31 10:52:49', '2024-01-31 10:52:49'),
(12, 12, '2024-01-15', 106452655, '2024-01-31 11:10:48', '2024-01-31 11:10:48'),
(13, 13, '2024-01-23', 106858479, '2024-01-31 11:40:49', '2024-01-31 11:40:49'),
(14, 14, '2024-01-25', 106987888, '2024-01-31 12:00:36', '2024-01-31 12:00:36'),
(15, 15, '2023-01-11', 86761497, '2024-02-07 11:34:54', '2024-02-07 11:34:54'),
(16, 16, '2023-01-11', 86762564, '2024-02-07 11:45:29', '2024-02-07 11:45:29'),
(17, 17, '2023-01-11', 86763559, '2024-02-07 11:53:17', '2024-02-07 11:53:17'),
(18, 18, '2023-01-11', 86765080, '2024-02-07 12:11:04', '2024-02-07 12:11:04'),
(19, 19, '2023-01-11', 86766397, '2024-02-07 12:21:08', '2024-02-07 12:21:08'),
(20, 20, '2023-01-17', 86932680, '2024-02-07 12:26:27', '2024-02-07 12:26:27'),
(21, 21, '2023-01-17', 86934260, '2024-02-07 12:31:42', '2024-02-07 12:31:42'),
(22, 22, '2023-01-20', 87084988, '2024-02-07 13:03:48', '2024-02-07 13:03:48'),
(23, 23, '2023-01-20', 87090682, '2024-02-07 13:57:09', '2024-02-07 13:57:09'),
(24, 24, '2023-01-20', 87088263, '2024-02-07 14:08:40', '2024-02-07 14:08:40'),
(25, 25, '2023-01-19', 87051485, '2024-02-07 14:15:51', '2024-02-07 14:15:51'),
(26, 26, '2023-01-23', 87141899, '2024-02-07 14:43:20', '2024-02-07 14:43:20'),
(27, 27, '2023-01-23', 87142494, '2024-02-07 14:50:10', '2024-02-07 14:50:10'),
(28, 28, '2023-01-24', 87206280, '2024-02-07 14:59:34', '2024-02-07 14:59:34'),
(29, 29, '2023-01-26', 87275199, '2024-02-07 15:08:45', '2024-02-07 15:08:45'),
(30, 30, '2023-01-26', 87276075, '2024-02-07 15:15:56', '2024-02-07 15:15:56'),
(31, 31, '2023-01-26', 87279082, '2024-02-07 15:42:32', '2024-02-07 15:42:32'),
(32, 32, '2023-01-26', 87281399, '2024-02-08 11:18:47', '2024-02-08 11:18:47'),
(33, 33, '2023-01-31', 87454877, '2024-02-08 11:30:45', '2024-02-08 11:30:45'),
(34, 34, '2023-02-13', 87989682, '2024-02-08 13:26:32', '2024-02-08 13:26:32'),
(35, 35, '2023-02-13', 87996660, '2024-02-08 13:34:17', '2024-02-08 13:34:17'),
(36, 36, '2023-03-06', 88898299, '2024-02-08 13:43:24', '2024-02-08 13:43:24'),
(37, 37, '2023-02-22', 88420795, '2024-02-08 13:48:42', '2024-02-08 13:48:42'),
(38, 38, '2023-02-23', 88428590, '2024-02-08 13:57:54', '2024-02-08 13:57:54'),
(39, 39, '2023-03-01', 88727263, '2024-02-08 14:06:05', '2024-02-08 14:06:05'),
(40, 40, '2023-04-03', 90236075, '2024-02-08 14:52:41', '2024-02-08 14:52:41'),
(41, 41, '2023-05-10', 92133491, '2024-02-08 15:11:28', '2024-02-08 15:11:28'),
(42, 42, '2023-05-29', 93097675, '2024-02-08 15:37:34', '2024-02-08 15:37:34'),
(43, 43, '2023-05-30', 93155362, '2024-02-08 15:52:37', '2024-02-08 15:52:37'),
(44, 44, '2023-06-02', 93382661, '2024-02-08 16:01:12', '2024-02-08 16:01:12'),
(45, 45, '2023-06-15', 94105181, '2024-02-09 10:52:08', '2024-02-09 10:52:08'),
(46, 46, '2023-06-15', 94124660, '2024-02-09 11:05:47', '2024-02-09 11:05:47'),
(47, 47, '2023-06-27', 94794498, '2024-02-09 12:06:03', '2024-02-09 12:06:03'),
(48, 48, '2023-06-27', 94794593, '2024-02-09 12:13:59', '2024-02-09 12:13:59'),
(49, 49, '2023-06-27', 94794681, '2024-02-09 12:19:07', '2024-02-09 12:19:07'),
(50, 50, '2023-06-27', 94794782, '2024-02-09 12:22:52', '2024-02-09 12:22:52'),
(51, 51, '2023-06-27', 94794867, '2024-02-09 12:26:48', '2024-02-09 12:26:48'),
(52, 52, '2023-06-27', 94794955, '2024-02-09 12:30:18', '2024-02-09 12:30:18'),
(53, 53, '2023-06-27', 94807985, '2024-02-09 15:25:02', '2024-02-09 15:25:02'),
(54, 54, '2023-06-27', 94808077, '2024-02-09 15:29:02', '2024-02-09 15:29:02'),
(55, 55, '2023-06-27', 94816385, '2024-02-09 16:25:00', '2024-02-09 16:25:00'),
(56, 56, '2023-06-27', 94816487, '2024-02-09 16:31:55', '2024-02-09 16:31:55'),
(57, 57, '2023-06-27', 94816598, '2024-02-09 16:37:41', '2024-02-09 16:37:41'),
(58, 58, '2023-06-27', 94816679, '2024-02-09 16:47:21', '2024-02-09 16:47:21'),
(59, 59, '2023-06-27', 94819997, '2024-02-09 17:01:55', '2024-02-09 17:01:55'),
(60, 62, '2023-06-27', 94828294, '2024-02-10 15:26:04', '2024-02-10 15:26:04'),
(61, 63, '2023-06-27', 94835481, '2024-02-10 15:34:33', '2024-02-10 15:34:33'),
(62, 64, '2023-07-04', 94923362, '2024-02-10 15:41:33', '2024-02-10 15:41:33'),
(63, 66, '2023-07-04', 94925785, '2024-02-10 15:52:40', '2024-02-10 15:52:40'),
(64, 67, '2023-07-04', 94920461, '2024-02-10 15:59:10', '2024-02-10 15:59:10'),
(65, 68, '2023-07-04', 94929381, '2024-02-10 16:06:37', '2024-02-10 16:06:37'),
(66, 69, '2023-07-04', 94920181, '2024-02-10 16:13:21', '2024-02-10 16:13:21'),
(67, 70, '2023-07-04', 94932960, '2024-02-10 16:20:15', '2024-02-10 16:20:15'),
(68, 71, '2023-07-05', 94996859, '2024-02-10 16:34:07', '2024-02-10 16:34:07'),
(69, 72, '2023-07-05', 95010688, '2024-02-10 16:39:15', '2024-02-10 16:39:15'),
(70, 73, '2023-07-07', 95142586, '2024-02-10 16:45:20', '2024-02-10 16:45:20'),
(71, 74, '2023-07-07', 95169759, '2024-02-10 16:51:33', '2024-02-10 16:51:33'),
(72, 75, '2023-07-07', 95148186, '2024-02-10 17:00:45', '2024-02-10 17:00:45'),
(73, 76, '2023-07-12', 95411467, '2024-02-10 17:20:35', '2024-02-10 17:20:35'),
(74, 77, '2023-07-10', 95249597, '2024-02-10 17:29:32', '2024-02-10 17:29:32'),
(75, 78, '2023-07-11', 95364088, '2024-02-10 17:36:31', '2024-02-10 17:36:31'),
(76, 79, '2023-07-11', 95301275, '2024-02-10 17:42:48', '2024-02-10 17:42:48'),
(77, 80, '2023-07-11', 95323163, '2024-02-12 09:37:24', '2024-02-12 09:37:24'),
(78, 81, '2023-07-11', 95300665, '2024-02-12 09:46:02', '2024-02-12 09:46:02'),
(79, 82, '2023-07-11', 95359682, '2024-02-12 10:20:59', '2024-02-12 10:20:59'),
(80, 83, '2023-07-11', 95359793, '2024-02-12 10:32:34', '2024-02-12 10:32:34'),
(81, 84, '2023-07-12', 95466262, '2024-02-12 10:51:38', '2024-02-12 10:51:38'),
(82, 85, '2023-07-17', 95672578, '2024-02-12 11:05:00', '2024-02-12 11:05:00'),
(83, 86, '2023-07-13', 95507486, '2024-02-12 11:15:20', '2024-02-12 11:15:20'),
(84, 87, '2023-07-13', 95509796, '2024-02-12 11:25:51', '2024-02-12 11:25:51'),
(85, 88, '2023-07-14', 95587278, '2024-02-12 11:47:51', '2024-02-12 11:47:51'),
(86, 89, '2023-07-18', 95754984, '2024-02-12 12:00:14', '2024-02-12 12:00:14'),
(87, 90, '2023-07-17', 95690766, '2024-02-12 12:07:39', '2024-02-12 12:07:39'),
(88, 91, '2023-07-19', 95833780, '2024-02-12 12:21:11', '2024-02-12 12:21:11'),
(89, 92, '2023-07-19', 95825578, '2024-02-12 12:49:43', '2024-02-12 12:49:43'),
(90, 93, '2023-07-19', 95824788, '2024-02-12 12:57:01', '2024-02-12 12:57:01'),
(91, 94, '2023-07-19', 95824358, '2024-02-12 13:03:14', '2024-02-12 13:03:14'),
(92, 95, '2023-07-20', 95907595, '2024-02-12 13:11:07', '2024-02-12 13:11:07'),
(93, 96, '2023-07-20', 95904888, '2024-02-12 13:17:19', '2024-02-12 13:17:19'),
(94, 97, '2023-07-21', 95966265, '2024-02-12 13:23:35', '2024-02-12 13:23:35'),
(95, 98, '2023-07-21', 95957598, '2024-02-12 13:28:44', '2024-02-12 13:28:44'),
(96, 99, '2023-07-26', 96212091, '2024-02-12 13:39:16', '2024-02-12 13:39:16'),
(97, 100, '2023-07-26', 96239077, '2024-02-12 13:50:02', '2024-02-12 13:50:02'),
(98, 101, '2023-07-29', 96390982, '2024-02-12 14:21:49', '2024-02-12 14:21:49'),
(99, 102, '2023-07-29', 96391064, '2024-02-12 14:25:34', '2024-02-12 14:25:34'),
(100, 103, '2023-07-28', 96318095, '2024-02-12 14:32:44', '2024-02-12 14:32:44'),
(101, 104, '2023-07-28', 96318183, '2024-02-12 14:36:54', '2024-02-12 14:36:54'),
(102, 105, '2023-07-27', 96257555, '2024-02-12 14:58:14', '2024-02-12 14:58:14'),
(103, 106, '2023-08-02', 96579085, '2024-02-12 15:02:21', '2024-02-12 15:02:21'),
(104, 107, '2023-08-03', 96641955, '2024-02-12 15:13:46', '2024-02-12 15:13:46'),
(105, 108, '2023-07-28', 96334563, '2024-02-13 13:32:25', '2024-02-13 13:32:25'),
(106, 109, '2023-08-04', 96743164, '2024-02-13 13:42:22', '2024-02-13 13:42:22'),
(107, 110, '2023-08-03', 96639961, '2024-02-13 13:48:53', '2024-02-13 13:48:53'),
(108, 111, '2023-08-02', 96574967, '2024-02-13 14:03:04', '2024-02-13 14:03:04'),
(109, 112, '2023-08-05', 96793893, '2024-02-13 14:24:48', '2024-02-13 14:24:48'),
(110, 113, '2023-08-07', 96831299, '2024-02-13 15:10:48', '2024-02-13 15:10:48'),
(111, 114, '2023-08-08', 96895575, '2024-02-13 15:19:33', '2024-02-13 15:19:33'),
(112, 115, '2023-08-11', 97135166, '2024-02-13 15:28:02', '2024-02-13 15:28:02'),
(113, 116, '2023-08-09', 96955395, '2024-02-13 17:28:11', '2024-02-13 17:28:11'),
(114, 117, '2023-08-09', 96957697, '2024-02-13 17:41:33', '2024-02-13 17:41:33'),
(115, 118, '2023-08-09', 96960891, '2024-02-13 17:50:53', '2024-02-13 17:50:53'),
(116, 119, '2023-08-09', 96961786, '2024-02-13 18:06:14', '2024-02-13 18:06:14'),
(117, 120, '2023-08-10', 97053088, '2024-02-15 14:08:22', '2024-02-15 14:08:22'),
(118, 121, '2024-02-12', 107835080, '2024-02-15 16:51:57', '2024-02-15 16:51:57'),
(119, 122, '2024-02-12', 107835191, '2024-02-15 16:58:19', '2024-02-15 16:58:19'),
(120, 123, '2024-02-16', 108078866, '2024-02-16 11:26:53', '2024-02-16 11:26:53'),
(121, 124, '2023-08-14', 97234355, '2024-02-19 13:21:30', '2024-02-19 13:21:30'),
(122, 125, '2023-08-14', 97204676, '2024-02-19 13:31:05', '2024-02-19 13:31:05'),
(123, 126, '2023-08-16', 97350493, '2024-02-19 13:40:01', '2024-02-19 13:40:01'),
(124, 127, '2023-08-18', 97502796, '2024-02-19 13:50:14', '2024-02-19 13:50:14'),
(125, 128, '2023-08-18', 97506983, '2024-02-19 13:58:39', '2024-02-19 13:58:39'),
(126, 129, '2023-08-24', 97821660, '2024-02-21 11:26:57', '2024-02-21 11:26:57'),
(127, 130, '2023-08-23', 97752179, '2024-02-21 11:31:55', '2024-02-21 11:31:55'),
(128, 131, '2023-08-28', 97990259, '2024-02-21 11:44:15', '2024-02-21 11:44:15'),
(129, 132, '2023-09-06', 98527479, '2024-02-21 11:55:41', '2024-02-21 11:55:41'),
(130, 133, '2023-09-11', 98764496, '2024-02-23 15:11:04', '2024-02-23 15:11:04'),
(131, 134, '2024-02-26', 108472164, '2024-02-26 12:45:56', '2024-02-26 12:45:56'),
(132, 135, '2024-02-27', 108523780, '2024-02-27 17:12:59', '2024-02-27 17:12:59'),
(133, 136, '2024-02-28', 108621796, '2024-02-28 16:30:45', '2024-02-28 16:30:45'),
(134, 137, '2024-01-06', 106015163, '2024-02-29 10:12:28', '2024-02-29 10:12:28'),
(135, 138, '2024-01-06', 106033561, '2024-02-29 10:17:43', '2024-02-29 10:17:43'),
(136, 139, '2024-01-08', 106124362, '2024-02-29 10:24:52', '2024-02-29 10:24:52'),
(137, 140, '2024-01-06', 106013259, '2024-02-29 10:29:08', '2024-02-29 10:29:08'),
(138, 141, '2024-01-09', 106186283, '2024-02-29 10:32:54', '2024-02-29 10:32:54'),
(139, 142, '2024-01-09', 106187186, '2024-02-29 10:42:30', '2024-02-29 10:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accessrights`
--

CREATE TABLE `tbl_accessrights` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `position` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_accessrights`
--

INSERT INTO `tbl_accessrights` (`id`, `name`, `status`, `position`, `created_at`, `updated_at`) VALUES
(54, 'Sertifikatlashtirish bo\'limi xodimi', 'active', 'country', '2019-09-23 01:50:14', '2019-09-27 08:08:44'),
(55, 'Sertifikatlashtirish bo\'limi boshlig\'i', 'active', 'country', '2019-09-24 05:27:09', '2019-09-27 08:08:38'),
(56, 'Nazoratchi', 'active', 'country', '2019-09-24 05:28:00', '2019-09-27 08:08:31'),
(60, 'Inspeksiya', 'active', 'country', '2022-11-29 12:55:53', '2022-11-29 12:55:53'),
(90, 'Laboratoriya boshlig\'i', 'active', 'country', '2022-12-27 06:59:00', '2022-12-27 06:59:00'),
(91, 'Laboratoriya muxanndisi', 'active', 'country', '2023-01-07 16:34:43', '2023-01-07 16:34:43'),
(166, 'Lavozim nomini kiriting', 'inactive', NULL, '2023-02-03 04:51:44', '2023-02-03 04:51:44'),
(167, 'Lavozim nomini kiriting', 'inactive', NULL, '2023-07-05 02:06:49', '2023-07-05 02:06:49'),
(168, 'Lavozim nomini kiriting', 'inactive', NULL, '2023-07-05 02:07:16', '2023-07-05 02:07:16'),
(169, 'Lavozim nomini kiriting', 'inactive', NULL, '2023-07-05 02:07:17', '2023-07-05 02:07:17'),
(170, 'Lavozim nomini kiriting', 'inactive', NULL, '2023-07-05 02:37:31', '2023-07-05 02:37:31'),
(171, 'Tadbirkor', 'inactive', 'country', '2023-07-05 02:38:02', '2023-07-05 02:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activities`
--

CREATE TABLE `tbl_activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_id` int(22) DEFAULT NULL,
  `city_id` int(22) DEFAULT NULL,
  `action_type` varchar(55) DEFAULT NULL,
  `ip_adress` varchar(25) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_activities`
--

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `soato` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `name`, `state_id`, `created_at`, `updated_at`, `list_id`, `soato`) VALUES
(47069, 'Andijon tumani', 3999, NULL, '2020-03-16 11:04:26', 307, 1703203),
(47071, 'Bo`ston', 3999, NULL, '2020-03-19 09:46:38', 309, 1703209),
(47073, 'Xo\'jaobod', 3999, NULL, '2022-09-06 04:01:13', 319, 1703236),
(47074, 'Baliqchi', 3999, NULL, '2019-08-03 06:00:51', 308, 1703206),
(47077, 'Qo\'rg\'ontepa', 3999, NULL, '2022-01-28 12:13:04', 314, 1703220),
(47078, 'Marhamat', 3999, NULL, '2019-08-03 05:58:57', 316, 1703227),
(47079, 'Paxtaobod', 3999, NULL, '2019-08-03 06:01:29', 318, 1703232),
(47080, 'Izbosgan', 3999, NULL, '2020-03-19 10:29:18', 312, 1703214),
(47081, 'Shahrixon', 3999, NULL, '2019-08-03 06:00:21', 317, 1703230),
(47082, 'Buxoro sh.', 4000, NULL, '2020-03-18 10:10:28', 601, 1706401),
(47083, 'Jondor', 4000, NULL, '2019-08-05 02:20:16', 608, 1706246),
(47086, 'G\'ijduvon', 4000, NULL, '2021-02-04 06:31:46', 607, 1706215),
(47088, 'Kogon', 4000, NULL, NULL, 609, 1706219),
(47089, 'Qorako`l', 4000, NULL, '2019-08-05 02:27:58', 610, 1706230),
(47090, 'Qorovulbozor', 4000, NULL, '2019-08-05 02:26:11', 614, 1706232),
(47094, 'Romitan', 4000, NULL, NULL, 612, 1706242),
(47095, 'Shofirkon', 4000, NULL, '2019-08-05 02:25:42', 613, 1706258),
(47096, 'Vobkent', 4000, NULL, NULL, 606, 1706212),
(47097, 'Jizzax sh.', 4002, NULL, '2020-03-18 10:08:46', 812, 1708401),
(47098, 'Do\'stlik', 4002, NULL, '2020-02-26 09:54:50', 805, 1708215),
(47099, 'Baxmal', 4002, NULL, '2019-08-05 02:39:24', 802, 1708204),
(47100, 'G\'allaorol', 4002, NULL, NULL, 803, 1708209),
(47101, 'Zarbdor', 4002, NULL, '2020-02-26 09:15:27', 806, 1708220),
(47102, 'Paxtakor', 4002, NULL, '2020-02-26 09:15:21', 810, 1708228),
(47103, 'Zafarobod', 4002, NULL, '2019-08-05 02:34:16', 808, 1708225),
(47104, 'Zomin', 4002, NULL, NULL, 807, 1708218),
(47105, 'Oltiariq', 4003, NULL, '2019-08-05 03:14:21', 3012, 1730203),
(47106, 'Bag\'dod', 4003, NULL, '2019-08-05 03:16:06', 308, 1703206),
(47107, 'Beshariq', 4003, NULL, '2019-08-05 03:14:42', 2611, 1730215),
(47108, 'Farg\'ona sh.', 4003, NULL, '2020-03-18 09:58:58', 3005, 1730401),
(47109, 'Buvayda', 4003, NULL, '2019-08-05 03:16:37', 3008, 1730212),
(47110, 'Dang\'ara', 4003, NULL, '2019-08-05 03:16:51', 3009, 1730236),
(47111, 'Qo\'qon shahar', 4003, NULL, '2020-07-09 09:24:19', 3003, 1730405),
(47112, 'Quva', 4003, NULL, '2019-08-05 03:17:50', 3011, 1730218),
(47113, 'Furqat', 4003, NULL, '2020-02-26 09:22:28', 3020, 1730238),
(47114, 'Qo\'shtepa', 4003, NULL, '2020-02-26 09:15:51', 3013, 1730206),
(47115, 'So\'x', 4003, NULL, '2021-02-08 05:01:25', 3015, 1730226),
(47116, 'Rishton', 4003, NULL, '2019-08-05 03:20:19', 3014, 1730224),
(47117, 'Toshloq', 4003, NULL, '2019-08-05 03:22:38', 3016, 1730227),
(47119, 'Bog\'ot', 4004, NULL, '2019-08-05 02:15:09', 3006, 1730215),
(47120, 'Gurlan', 4004, NULL, NULL, 3307, 1733208),
(47121, 'Xazorasp', 4004, NULL, '2022-01-27 06:37:06', 3306, 1733220),
(47122, 'Xiva', 4004, NULL, '2019-08-05 02:08:30', 3305, 1733226),
(47123, 'Xonqa', 4004, NULL, '2019-08-05 02:08:57', 3312, 1733223),
(47124, 'Qo\'shko\'pir', 4004, NULL, '2022-05-19 04:47:30', 3310, 1733212),
(47125, 'Yangibozor', 4004, NULL, '2019-08-05 02:15:56', 3313, 1733236),
(47126, 'Shovot', 4004, NULL, '2019-08-05 02:12:54', 3308, 1733230),
(47127, 'Yangiariq', 4004, NULL, '2019-08-05 02:14:36', 3309, 1733233),
(47128, 'Urganch sh.', 4004, NULL, '2020-03-18 09:56:54', 3301, 1733401),
(47129, 'Qarshi tuman', 4005, '2020-03-29 06:04:57', '2020-03-29 06:04:57', 1007, 1710224),
(47130, 'Koson', 4005, NULL, '2019-08-05 03:40:38', 1008, 1710229),
(47131, 'Chiroqchi', 4005, NULL, '2019-08-05 03:35:59', 1014, 1710242),
(47132, 'Dehqonobod', 4005, NULL, '2019-08-05 03:36:13', 1005, 1710212),
(47133, 'Kasbi', 4005, NULL, '2019-08-05 03:54:31', 1012, 1710237),
(47134, 'G`uzor', 4005, NULL, '2019-08-05 03:37:29', 1004, 1710207),
(47135, 'Kitob', 4005, NULL, '2019-08-05 03:54:58', 1009, 1710232),
(47136, 'Qamashi', 4005, NULL, '2019-08-05 03:39:25', 1006, 1710220),
(47145, 'Muborak', 4005, NULL, NULL, 1010, 1710234),
(47146, 'Mirishkor', 4005, NULL, '2019-08-05 04:05:43', 1017, 1710233),
(47147, 'Shahrisabz', 4005, NULL, '2019-08-05 04:06:12', 1018, 1710245),
(47148, 'Nishon', 4005, NULL, '2020-02-26 09:58:17', 1011, 1710235),
(47150, 'Yakkabog\'', 4005, NULL, '2019-08-05 04:07:00', 1016, 1710250),
(47152, 'Beruniy', 4006, NULL, '2019-08-05 04:12:24', 2701, 1735207),
(47153, 'Ellikqal\'a', 4006, NULL, '2021-02-10 12:49:16', 3521, 1735250),
(47154, 'Chimboy', 4006, NULL, '2019-08-05 04:12:48', 3519, 1735240),
(47156, 'Xo\'jayli', 4006, NULL, '2022-02-01 06:39:57', 3518, 1735236),
(47157, 'Qorao\'zak', 4006, NULL, '2019-08-05 04:17:21', 3522, 1735211),
(47158, 'Kegeyli', 4006, NULL, '2019-08-05 04:14:08', 3511, 1735211),
(47159, 'Qanliko\'l', 4006, NULL, '2019-08-05 04:18:25', 3513, 1735218),
(47160, 'Shumanay', 4006, NULL, '2019-08-05 04:17:46', 3520, 1735243),
(47161, 'Qo\'ng\'irot', 4006, NULL, '2019-08-05 04:17:01', 3512, 1735215),
(47162, 'Amudaryo', 4006, NULL, '2020-02-26 09:56:55', 3508, 1735204),
(47163, 'Mo\'ynoq', 4006, NULL, '2022-01-31 10:44:19', 3514, 1735222),
(47164, 'Nukus', 4006, NULL, NULL, 3515, 1735225),
(47165, 'To\'rtko\'l', 4006, NULL, '2020-07-08 05:34:36', 3517, 1735233),
(47166, 'Taxtako\'pir', 4006, NULL, '2019-08-05 04:15:58', 3516, 1735230),
(47175, 'Chortoq', 4007, NULL, '2019-08-05 04:29:54', 1415, 1714236),
(47176, 'Chust', 4007, NULL, '2019-08-05 04:43:06', 1416, 1714237),
(47178, 'Mingbuloq', 4007, NULL, '2019-08-05 04:22:48', 1407, 1714204),
(47179, 'Namangan sh.', 4007, NULL, '2020-03-18 09:58:28', 1401, 1714402),
(47180, 'Norin', 4007, NULL, '2020-02-26 09:17:50', 1410, 1714216),
(47181, 'Pop', 4007, NULL, NULL, 1411, 1714219),
(47184, 'To\'raqo\'rg\'on', 4007, NULL, '2019-08-05 04:25:07', 1412, 1714224),
(47185, 'Uchqo\'rg\'on', 4007, NULL, '2020-02-26 09:18:16', 1414, 1714234),
(47186, 'Kosonsoy', 4007, NULL, '2020-02-26 09:18:58', 1408, 1714207),
(47187, 'Uychi', 4007, NULL, '2019-08-05 04:23:45', 1413, 1714229),
(47188, 'Yangiqo\'rg\'on', 4007, NULL, '2019-08-05 04:26:57', 1417, 1714242),
(47190, 'Karmana', 4008, NULL, NULL, 1211, 1712234),
(47191, 'Qiziltepa', 4008, NULL, '2019-08-05 04:45:55', 1205, 1712216),
(47192, 'Xatirchi', 4008, NULL, '2019-08-05 04:47:37', 1209, 1712251),
(47193, 'Uchquduq', 4008, NULL, '2019-08-05 04:46:22', 1203, 1712248),
(47194, 'Konimex', 4008, NULL, '2019-08-05 04:46:42', 1204, 1712211),
(47195, 'Bulung\'ur', 4009, NULL, '2019-08-05 04:56:38', 2703, 1718206),
(47196, 'Jomboy', 4009, NULL, '2019-08-05 04:57:18', 1811, 1718209),
(47197, 'Oqdaryo', 4009, NULL, '2020-02-26 09:57:50', 1808, 1718203),
(47198, 'Narpay', 4009, NULL, '2020-02-26 09:57:56', 1815, 1718218),
(47199, 'Pastdarg\'om', 4009, NULL, '2020-02-26 09:57:26', 1818, 1718227),
(47200, 'Paxtachi', 4009, NULL, '2020-02-26 09:57:22', 1819, 1718230),
(47201, 'Ishtixon', 4009, NULL, '2019-08-05 04:56:56', 1812, 1718212),
(47202, 'Kattaqo\'rg\'on', 4009, NULL, '2019-08-05 04:57:42', 1813, 1718215),
(47203, 'Qo\'shrabot', 4009, NULL, '2022-02-24 10:57:54', 1814, 1718216),
(47204, 'Nurobod', 4009, NULL, NULL, 1821, 1718235),
(47205, 'Payariq', 4009, NULL, '2019-08-05 05:03:40', 1817, 1718224),
(47207, 'Samarqand', 4009, NULL, '2019-08-05 05:03:54', 1820, 1718233),
(47208, 'Toyloq', 4009, NULL, '2020-02-26 09:58:37', 1804, 1718238),
(47209, 'Urgut', 4009, NULL, NULL, 1822, 1718236),
(47212, 'Oqoltin', 4010, NULL, '2020-02-26 09:59:10', 2401, 1724206),
(47213, 'Guliston sh.', 4010, NULL, '2020-03-18 10:08:56', 2410, 1724401),
(47214, 'Xovos', 4010, NULL, '2019-08-05 05:08:28', 2408, 1724235),
(47215, 'Sirdaryo', 4010, NULL, '2020-02-26 09:59:24', 2407, 1724231),
(47216, 'Boyovut', 4010, NULL, '2020-02-26 09:59:29', 2402, 1724212),
(47217, 'Mirzaobod', 4010, NULL, '2020-02-26 09:59:41', 2405, 1724228),
(47218, 'Jarqo\'rg\'on', 4011, NULL, '2020-02-26 09:59:46', 2208, 1722212),
(47219, 'Boysun', 4011, NULL, NULL, 2205, 1722204),
(47220, 'Qiziriq', 4011, NULL, '2020-02-26 09:59:59', 2210, 1722215),
(47221, 'Denov', 4011, NULL, '2019-08-05 05:16:15', 2207, 1722210),
(47222, 'Qumqo\'rg\'on', 4011, NULL, '2019-08-05 05:17:42', 2209, 1722214),
(47223, 'Muzrabot', 4011, NULL, '2020-02-26 10:00:11', 2206, 1722207),
(47224, 'Oltinsoy', 4011, NULL, '2020-02-26 10:00:16', 2204, 1722201),
(47225, 'Sariosiyo', 4011, NULL, '2020-02-26 10:00:32', 2211, 1722217),
(47226, 'Sherobod', 4011, NULL, '2020-02-26 10:00:37', 2213, 1722223),
(47227, 'Sho\'rchi', 4011, NULL, '2020-02-26 10:00:43', 2214, 1722226),
(47228, 'Termiz sh.', 4011, NULL, '2020-03-18 10:09:28', 2201, 1722401),
(47229, 'Uzun', 4011, NULL, '2020-02-26 10:00:54', 2215, 1722221),
(47230, 'Bekobod', 4012, NULL, '2020-02-26 09:23:17', 2701, 1727220),
(47231, 'Bo\'stonliq', 4012, NULL, '2020-02-26 09:23:33', 2703, 1727224),
(47232, 'Chinoz', 4012, NULL, '2020-02-26 09:28:50', 2713, 1727256),
(47233, 'Bektemir', 4121, NULL, '2020-02-26 09:24:30', 2611, 1726264),
(47234, 'Bo\'ka', 4012, NULL, '2022-01-27 12:07:33', 2702, 1727228),
(47235, 'Qibray', 4012, NULL, '2020-02-26 09:28:54', 2706, 1727248),
(47239, 'Zangiota', 4012, NULL, '2019-08-05 05:35:24', 2704, 1727237),
(47243, 'Ohangaron', 4012, NULL, NULL, 2708, 1727212),
(47245, 'Parkent', 4012, NULL, NULL, 2709, 1727249),
(47246, 'Piskent', 4012, NULL, '2019-08-05 05:38:23', 2710, 1727250),
(47251, 'O\'rtachirchiq', 4012, NULL, '2022-01-26 09:03:16', 2712, 1727253),
(47252, 'Oqqo\'rg\'on', 4012, NULL, '2020-02-26 09:54:28', 2707, 1727206),
(47253, 'Quyichirchiq', 4012, NULL, '2020-02-26 09:54:35', 2714, 1727233),
(47254, 'Yangiyo\'l', 4012, NULL, '2020-02-26 09:29:43', 2715, 1727259),
(48319, 'Yuqorichirchiq', 4012, '2019-08-05 00:55:42', '2022-01-27 07:05:40', 2705, 1727239),
(48320, 'Ulug\'nor', 3999, '2019-08-05 02:04:53', '2020-03-22 08:14:44', 313, 1703217),
(48321, 'Oltinko\'l', 3999, '2019-08-05 02:05:22', '2019-08-05 02:05:22', 306, 1703202),
(48322, 'Buloqboshi', 3999, '2019-08-05 02:16:33', '2019-08-05 02:16:33', 310, 1703210),
(48323, 'Peshku', 4000, '2019-08-05 02:31:48', '2019-08-05 02:31:48', 611, 1706240),
(48324, 'Mirzacho\'l', 4002, '2019-08-05 02:40:13', '2019-08-05 02:40:13', 809, 1708223),
(48325, 'Yangiobod', 4002, '2019-08-05 02:40:32', '2019-08-05 02:40:32', 813, 1708237),
(48326, 'Forish', 4002, '2019-08-05 02:40:50', '2020-02-26 10:01:47', 811, 1708235),
(48327, 'Arnasoy', 4002, '2019-08-05 02:41:08', '2019-08-05 02:41:08', 801, 1708201),
(48328, 'Uchko\'prik', 4003, '2019-08-05 03:23:22', '2019-08-05 03:23:22', 3018, 1730221),
(48329, 'Yozyovon', 4003, '2019-08-05 03:23:36', '2019-08-05 03:23:36', 3010, 1730242),
(48330, 'Navbahor', 4008, '2019-08-05 04:48:31', '2019-08-05 04:50:29', 1208, 1712230),
(48331, 'Nurota', 4008, '2019-08-05 04:48:52', '2019-08-05 04:50:05', 1210, 1712238),
(48332, 'Tomdi', 4008, '2019-08-05 04:51:46', '2020-02-26 10:01:42', 1207, 1712244),
(48333, 'Sayxunobod', 4010, '2019-08-05 05:10:34', '2020-02-26 10:02:02', 2406, 1724216),
(48334, 'Sardoba', 4010, '2019-08-05 05:10:50', '2020-02-26 10:02:08', 2409, 1724226),
(48335, 'Angor', 4011, '2019-08-05 05:22:25', '2020-02-26 10:02:17', 2203, 1722202),
(48336, 'Mirzo Ulug\'bek', 4121, '2019-08-13 02:44:27', '2020-02-26 09:30:47', 2602, 1726269),
(48337, 'Yashnobod', 4121, '2019-08-14 07:47:44', '2020-02-26 09:30:50', 2608, 1726290),
(48338, 'Yunusobod', 4121, '2019-08-14 07:47:55', '2020-02-26 09:31:04', 2603, 1726266),
(48339, 'Mirobod', 4121, '2019-08-14 07:48:05', '2020-02-26 09:31:08', 2601, 1726273),
(48340, 'Sergeli', 4121, '2019-08-14 07:48:36', '2020-02-26 09:33:59', 2607, 1726283),
(48341, 'Chilonzor', 4121, '2019-08-14 07:48:48', '2020-02-26 09:34:04', 2606, 1726294),
(48342, 'Olmazor', 4121, '2019-08-14 07:48:57', '2020-02-26 09:34:16', 2609, 1726280),
(48343, 'Shayxontohur', 4121, '2019-08-14 07:49:17', '2020-02-26 09:34:20', 2605, 1726277),
(48344, 'Yakkasaroy', 4121, '2019-08-14 08:56:27', '2020-02-26 09:34:29', 2604, 1726287),
(48345, 'Uchtepa', 4121, '2019-08-14 09:00:22', '2020-02-26 09:34:33', 2610, 1726262),
(48346, 'Asaka', 3999, '2019-11-05 06:44:13', '2019-11-05 06:44:13', 315, 1703224),
(48347, 'Nukus sh.', 4006, '2019-12-11 11:42:05', '2020-03-18 10:09:37', 3501, 1735401),
(48348, 'Olot', 4000, '2019-12-11 11:44:14', '2019-12-11 11:44:14', 604, 1706204),
(48349, 'Urganch', 4004, '2019-12-11 12:32:15', '2020-02-26 10:02:27', 3304, 1733217),
(48350, 'Samarqand sh.', 4009, '2020-03-13 14:02:48', '2020-03-13 14:02:48', 1801, 1718401),
(48351, 'Navoiy shahri', 4008, '2020-03-16 10:08:17', '2020-03-16 10:08:17', 1201, 1712401),
(48352, 'Andijon shahar', 3999, '2020-03-16 11:04:58', '2021-04-13 09:26:16', 301, 1703401),
(48353, 'XAMZA', 4121, '2020-03-18 05:51:56', '2020-03-18 05:51:56', 0, 0),
(48354, 'SHarof Rashidov', 4002, '2020-03-18 12:40:15', '2020-03-18 12:40:15', 804, 1708212),
(48355, 'Jalaquduq', 3999, '2020-03-19 09:52:34', '2020-03-19 09:52:34', 311, 1703211),
(48356, 'Buxoro tumani', 4000, '2020-03-19 13:25:17', '2020-03-19 13:25:17', 605, 1706207),
(48357, 'Guliston tumani', 4010, '2020-03-20 07:06:09', '2020-03-20 07:06:09', 2403, 1724220),
(48358, 'Toshkent tumani', 4012, '2020-03-20 10:03:42', '2020-03-20 10:03:42', 2722, 1727265),
(48359, 'O\'zbekiston tumani', 4003, '2020-03-20 12:19:35', '2020-03-20 12:19:35', 3017, 1730230),
(48360, 'Farg\'ona tumani', 4003, '2020-03-20 12:26:11', '2020-03-20 12:26:11', 3019, 1730233),
(48361, 'Taxiatosh', 4006, '2020-03-20 12:55:23', '2020-03-20 12:55:23', 3504, 1735228),
(48362, 'Namangan tumani', 4007, '2020-03-22 06:24:34', '2020-03-22 06:24:34', 1409, 1714212),
(48363, 'Termiz tumani', 4011, '2020-03-23 07:13:38', '2020-03-23 07:13:38', 2212, 1722220),
(48364, 'Quvasoy shaxri', 4003, '2020-03-23 11:36:33', '2020-03-23 11:36:55', 3001, 1730408),
(48365, 'Jizzax tumani', 4002, '2020-03-27 10:17:23', '2020-03-27 10:17:23', 0, 0),
(48366, 'Qarshi shahri', 4005, '2020-04-08 19:00:56', '2020-04-08 19:00:56', 1001, 1710401),
(48367, 'Bo\'stonliq', 4012, '2020-03-29 12:13:08', '2020-03-29 12:13:33', 3509, 1735207),
(48368, 'Chirchiq shaxar', 4012, '2020-04-05 14:29:25', '2020-04-05 14:29:25', 2720, 1727419),
(48369, 'Qo\'ng\'irot', 4006, '2020-04-08 08:54:56', '2020-04-08 08:54:56', 3512, 1735215),
(48370, 'To\'raqo\'rg\'on', 4007, '2020-04-08 18:41:23', '2020-04-09 05:10:07', 1412, 1714224),
(48372, 'Zarafshon shahri', 4008, '2020-04-25 11:28:00', '2020-04-25 11:28:00', 1202, 1712408),
(48374, 'Tuproqqal\'a', 4004, '2020-08-18 06:10:49', '2020-08-18 06:10:49', 3314, 1733221),
(48375, 'Angren shahri', 4012, '2021-01-14 11:07:00', '2021-01-14 11:07:00', 2716, 1727407),
(48376, 'Bandixon', 4011, '2021-01-15 12:55:19', '2021-01-15 12:55:19', 2216, 1722203),
(48378, 'Marg\'ilon shahri', 4003, '2021-04-13 08:33:27', '2021-04-13 08:33:27', 3004, 1730412),
(48379, 'Yangihayot', 4121, '2021-05-05 12:34:19', '2021-05-05 12:34:19', 2612, 1726292),
(48380, 'Xonobod shahri', 3999, '2021-07-23 07:06:07', '2021-07-23 07:06:07', 303, 1703408),
(48381, 'Ko\'kdala', 4005, '2022-06-15 13:22:48', '2022-06-15 13:22:48', 1019, 1710240),
(48382, 'Yangi Nishon shaharchasi', 4005, '2022-06-29 21:07:43', '2022-06-29 21:07:43', 0, 1710235),
(48384, 'Bo\'zatov', 4006, '2023-01-23 11:11:48', '2023-01-23 11:11:48', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `sortname`, `name`, `phonecode`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 93, NULL, NULL),
(2, 'AL', 'Albania', 355, NULL, NULL),
(3, 'DZ', 'Algeria', 213, NULL, NULL),
(4, 'AS', 'American Samoa', 1684, NULL, NULL),
(5, 'AD', 'Andorra', 376, NULL, NULL),
(6, 'AO', 'Angola', 244, NULL, NULL),
(7, 'AI', 'Anguilla', 1264, NULL, NULL),
(8, 'AQ', 'Antarctica', 0, NULL, NULL),
(9, 'AG', 'Antigua And Barbuda', 1268, NULL, NULL),
(10, 'AR', 'Argentina', 54, NULL, NULL),
(11, 'AM', 'Armenia', 374, NULL, NULL),
(12, 'AW', 'Aruba', 297, NULL, NULL),
(13, 'AU', 'Australia', 61, NULL, NULL),
(14, 'AT', 'Austria', 43, NULL, NULL),
(15, 'AZ', 'Azerbaijan', 994, NULL, NULL),
(16, 'BS', 'Bahamas The', 1242, NULL, NULL),
(17, 'BH', 'Bahrain', 973, NULL, NULL),
(18, 'BD', 'Bangladesh', 880, NULL, NULL),
(19, 'BB', 'Barbados', 1246, NULL, NULL),
(20, 'BY', 'Belarus', 375, NULL, NULL),
(21, 'BE', 'Belgium', 32, NULL, NULL),
(22, 'BZ', 'Belize', 501, NULL, NULL),
(23, 'BJ', 'Benin', 229, NULL, NULL),
(24, 'BM', 'Bermuda', 1441, NULL, NULL),
(25, 'BT', 'Bhutan', 975, NULL, NULL),
(26, 'BO', 'Bolivia', 591, NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', 387, NULL, NULL),
(28, 'BW', 'Botswana', 267, NULL, NULL),
(29, 'BV', 'Bouvet Island', 0, NULL, NULL),
(30, 'BR', 'Brazil', 55, NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', 246, NULL, NULL),
(32, 'BN', 'Brunei', 673, NULL, NULL),
(33, 'BG', 'Bulgaria', 359, NULL, NULL),
(34, 'BF', 'Burkina Faso', 226, NULL, NULL),
(35, 'BI', 'Burundi', 257, NULL, NULL),
(36, 'KH', 'Cambodia', 855, NULL, NULL),
(37, 'CM', 'Cameroon', 237, NULL, NULL),
(38, 'CA', 'Canada', 1, NULL, NULL),
(39, 'CV', 'Cape Verde', 238, NULL, NULL),
(40, 'KY', 'Cayman Islands', 1345, NULL, NULL),
(41, 'CF', 'Central African Republic', 236, NULL, NULL),
(42, 'TD', 'Chad', 235, NULL, NULL),
(43, 'CL', 'Chile', 56, NULL, NULL),
(44, 'CN', 'China', 86, NULL, NULL),
(45, 'CX', 'Christmas Island', 61, NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', 672, NULL, NULL),
(47, 'CO', 'Colombia', 57, NULL, NULL),
(48, 'KM', 'Comoros', 269, NULL, NULL),
(49, 'CG', 'Congo', 242, NULL, NULL),
(50, 'CD', 'Congo The Democratic Republic Of The', 242, NULL, NULL),
(51, 'CK', 'Cook Islands', 682, NULL, NULL),
(52, 'CR', 'Costa Rica', 506, NULL, NULL),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225, NULL, NULL),
(54, 'HR', 'Croatia (Hrvatska)', 385, NULL, NULL),
(55, 'CU', 'Cuba', 53, NULL, NULL),
(56, 'CY', 'Cyprus', 357, NULL, NULL),
(57, 'CZ', 'Czech Republic', 420, NULL, NULL),
(58, 'DK', 'Denmark', 45, NULL, NULL),
(59, 'DJ', 'Djibouti', 253, NULL, NULL),
(60, 'DM', 'Dominica', 1767, NULL, NULL),
(61, 'DO', 'Dominican Republic', 1809, NULL, NULL),
(62, 'TP', 'East Timor', 670, NULL, NULL),
(63, 'EC', 'Ecuador', 593, NULL, NULL),
(64, 'EG', 'Egypt', 20, NULL, NULL),
(65, 'SV', 'El Salvador', 503, NULL, NULL),
(66, 'GQ', 'Equatorial Guinea', 240, NULL, NULL),
(67, 'ER', 'Eritrea', 291, NULL, NULL),
(68, 'EE', 'Estonia', 372, NULL, NULL),
(69, 'ET', 'Ethiopia', 251, NULL, NULL),
(70, 'XA', 'External Territories of Australia', 61, NULL, NULL),
(71, 'FK', 'Falkland Islands', 500, NULL, NULL),
(72, 'FO', 'Faroe Islands', 298, NULL, NULL),
(73, 'FJ', 'Fiji Islands', 679, NULL, NULL),
(74, 'FI', 'Finland', 358, NULL, NULL),
(75, 'FR', 'France', 33, NULL, NULL),
(76, 'GF', 'French Guiana', 594, NULL, NULL),
(77, 'PF', 'French Polynesia', 689, NULL, NULL),
(78, 'TF', 'French Southern Territories', 0, NULL, NULL),
(79, 'GA', 'Gabon', 241, NULL, NULL),
(80, 'GM', 'Gambia The', 220, NULL, NULL),
(81, 'GE', 'Georgia', 995, NULL, NULL),
(82, 'DE', 'Germany', 49, NULL, NULL),
(83, 'GH', 'Ghana', 233, NULL, NULL),
(84, 'GI', 'Gibraltar', 350, NULL, NULL),
(85, 'GR', 'Greece', 30, NULL, NULL),
(86, 'GL', 'Greenland', 299, NULL, NULL),
(87, 'GD', 'Grenada', 1473, NULL, NULL),
(88, 'GP', 'Guadeloupe', 590, NULL, NULL),
(89, 'GU', 'Guam', 1671, NULL, NULL),
(90, 'GT', 'Guatemala', 502, NULL, NULL),
(91, 'XU', 'Guernsey and Alderney', 44, NULL, NULL),
(92, 'GN', 'Guinea', 224, NULL, NULL),
(93, 'GW', 'Guinea-Bissau', 245, NULL, NULL),
(94, 'GY', 'Guyana', 592, NULL, NULL),
(95, 'HT', 'Haiti', 509, NULL, NULL),
(96, 'HM', 'Heard and McDonald Islands', 0, NULL, NULL),
(97, 'HN', 'Honduras', 504, NULL, NULL),
(98, 'HK', 'Hong Kong S.A.R.', 852, NULL, NULL),
(99, 'HU', 'Hungary', 36, NULL, NULL),
(100, 'IS', 'Iceland', 354, NULL, NULL),
(101, 'IN', 'India', 91, NULL, NULL),
(102, 'ID', 'Indonesia', 62, NULL, NULL),
(103, 'IR', 'Iran', 98, NULL, NULL),
(104, 'IQ', 'Iraq', 964, NULL, NULL),
(105, 'IE', 'Ireland', 353, NULL, NULL),
(106, 'IL', 'Israel', 972, NULL, NULL),
(107, 'IT', 'Italy', 39, NULL, NULL),
(108, 'JM', 'Jamaica', 1876, NULL, NULL),
(109, 'JP', 'Japan', 81, NULL, NULL),
(110, 'XJ', 'Jersey', 44, NULL, NULL),
(111, 'JO', 'Jordan', 962, NULL, NULL),
(112, 'KZ', 'Kazakhstan', 7, NULL, NULL),
(113, 'KE', 'Kenya', 254, NULL, NULL),
(114, 'KI', 'Kiribati', 686, NULL, NULL),
(115, 'KP', 'Korea North', 850, NULL, NULL),
(116, 'KR', 'Korea South', 82, NULL, NULL),
(117, 'KW', 'Kuwait', 965, NULL, NULL),
(118, 'KG', 'Kyrgyzstan', 996, NULL, NULL),
(119, 'LA', 'Laos', 856, NULL, NULL),
(120, 'LV', 'Latvia', 371, NULL, NULL),
(121, 'LB', 'Lebanon', 961, NULL, NULL),
(122, 'LS', 'Lesotho', 266, NULL, NULL),
(123, 'LR', 'Liberia', 231, NULL, NULL),
(124, 'LY', 'Libya', 218, NULL, NULL),
(125, 'LI', 'Liechtenstein', 423, NULL, NULL),
(126, 'LT', 'Lithuania', 370, NULL, NULL),
(127, 'LU', 'Luxembourg', 352, NULL, NULL),
(128, 'MO', 'Macau S.A.R.', 853, NULL, NULL),
(129, 'MK', 'Macedonia', 389, NULL, NULL),
(130, 'MG', 'Madagascar', 261, NULL, NULL),
(131, 'MW', 'Malawi', 265, NULL, NULL),
(132, 'MY', 'Malaysia', 60, NULL, NULL),
(133, 'MV', 'Maldives', 960, NULL, NULL),
(134, 'ML', 'Mali', 223, NULL, NULL),
(135, 'MT', 'Malta', 356, NULL, NULL),
(136, 'XM', 'Man (Isle of)', 44, NULL, NULL),
(137, 'MH', 'Marshall Islands', 692, NULL, NULL),
(138, 'MQ', 'Martinique', 596, NULL, NULL),
(139, 'MR', 'Mauritania', 222, NULL, NULL),
(140, 'MU', 'Mauritius', 230, NULL, NULL),
(141, 'YT', 'Mayotte', 269, NULL, NULL),
(142, 'MX', 'Mexico', 52, NULL, NULL),
(143, 'FM', 'Micronesia', 691, NULL, NULL),
(144, 'MD', 'Moldova', 373, NULL, NULL),
(145, 'MC', 'Monaco', 377, NULL, NULL),
(146, 'MN', 'Mongolia', 976, NULL, NULL),
(147, 'MS', 'Montserrat', 1664, NULL, NULL),
(148, 'MA', 'Morocco', 212, NULL, NULL),
(149, 'MZ', 'Mozambique', 258, NULL, NULL),
(150, 'MM', 'Myanmar', 95, NULL, NULL),
(151, 'NA', 'Namibia', 264, NULL, NULL),
(152, 'NR', 'Nauru', 674, NULL, NULL),
(153, 'NP', 'Nepal', 977, NULL, NULL),
(154, 'AN', 'Netherlands Antilles', 599, NULL, NULL),
(155, 'NL', 'Netherlands The', 31, NULL, NULL),
(156, 'NC', 'New Caledonia', 687, NULL, NULL),
(157, 'NZ', 'New Zealand', 64, NULL, NULL),
(158, 'NI', 'Nicaragua', 505, NULL, NULL),
(159, 'NE', 'Niger', 227, NULL, NULL),
(160, 'NG', 'Nigeria', 234, NULL, NULL),
(161, 'NU', 'Niue', 683, NULL, NULL),
(162, 'NF', 'Norfolk Island', 672, NULL, NULL),
(163, 'MP', 'Northern Mariana Islands', 1670, NULL, NULL),
(164, 'NO', 'Norway', 47, NULL, NULL),
(165, 'OM', 'Oman', 968, NULL, NULL),
(166, 'PK', 'Pakistan', 92, NULL, NULL),
(167, 'PW', 'Palau', 680, NULL, NULL),
(168, 'PS', 'Palestinian Territory Occupied', 970, NULL, NULL),
(169, 'PA', 'Panama', 507, NULL, NULL),
(170, 'PG', 'Papua new Guinea', 675, NULL, NULL),
(171, 'PY', 'Paraguay', 595, NULL, NULL),
(172, 'PE', 'Peru', 51, NULL, NULL),
(173, 'PH', 'Philippines', 63, NULL, NULL),
(174, 'PN', 'Pitcairn Island', 0, NULL, NULL),
(175, 'PL', 'Poland', 48, NULL, NULL),
(176, 'PT', 'Portugal', 351, NULL, NULL),
(177, 'PR', 'Puerto Rico', 1787, NULL, NULL),
(178, 'QA', 'Qatar', 974, NULL, NULL),
(179, 'RE', 'Reunion', 262, NULL, NULL),
(180, 'RO', 'Romania', 40, NULL, NULL),
(181, 'RU', 'Russia', 70, NULL, NULL),
(182, 'RW', 'Rwanda', 250, NULL, NULL),
(183, 'SH', 'Saint Helena', 290, NULL, NULL),
(184, 'KN', 'Saint Kitts And Nevis', 1869, NULL, NULL),
(185, 'LC', 'Saint Lucia', 1758, NULL, NULL),
(186, 'PM', 'Saint Pierre and Miquelon', 508, NULL, NULL),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, NULL, NULL),
(188, 'WS', 'Samoa', 684, NULL, NULL),
(189, 'SM', 'San Marino', 378, NULL, NULL),
(190, 'ST', 'Sao Tome and Principe', 239, NULL, NULL),
(191, 'SA', 'Saudi Arabia', 966, NULL, NULL),
(192, 'SN', 'Senegal', 221, NULL, NULL),
(193, 'RS', 'Serbia', 381, NULL, NULL),
(194, 'SC', 'Seychelles', 248, NULL, NULL),
(195, 'SL', 'Sierra Leone', 232, NULL, NULL),
(196, 'SG', 'Singapore', 65, NULL, NULL),
(197, 'SK', 'Slovakia', 421, NULL, NULL),
(198, 'SI', 'Slovenia', 386, NULL, NULL),
(199, 'XG', 'Smaller Territories of the UK', 44, NULL, NULL),
(200, 'SB', 'Solomon Islands', 677, NULL, NULL),
(201, 'SO', 'Somalia', 252, NULL, NULL),
(202, 'ZA', 'South Africa', 27, NULL, NULL),
(203, 'GS', 'South Georgia', 0, NULL, NULL),
(204, 'SS', 'South Sudan', 211, NULL, NULL),
(205, 'ES', 'Spain', 34, NULL, NULL),
(206, 'LK', 'Sri Lanka', 94, NULL, NULL),
(207, 'SD', 'Sudan', 249, NULL, NULL),
(208, 'SR', 'Suriname', 597, NULL, NULL),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, NULL, NULL),
(210, 'SZ', 'Swaziland', 268, NULL, NULL),
(211, 'SE', 'Sweden', 46, NULL, NULL),
(212, 'CH', 'Switzerland', 41, NULL, NULL),
(213, 'SY', 'Syria', 963, NULL, NULL),
(214, 'TW', 'Taiwan', 886, NULL, NULL),
(215, 'TJ', 'Tajikistan', 992, NULL, NULL),
(216, 'TZ', 'Tanzania', 255, NULL, NULL),
(217, 'TH', 'Thailand', 66, NULL, NULL),
(218, 'TG', 'Togo', 228, NULL, NULL),
(219, 'TK', 'Tokelau', 690, NULL, NULL),
(220, 'TO', 'Tonga', 676, NULL, NULL),
(221, 'TT', 'Trinidad And Tobago', 1868, NULL, NULL),
(222, 'TN', 'Tunisia', 216, NULL, NULL),
(223, 'TR', 'Turkey', 90, NULL, NULL),
(224, 'TM', 'Turkmenistan', 7370, NULL, NULL),
(225, 'TC', 'Turks And Caicos Islands', 1649, NULL, NULL),
(226, 'TV', 'Tuvalu', 688, NULL, NULL),
(227, 'UG', 'Uganda', 256, NULL, NULL),
(228, 'UA', 'Ukraine', 380, NULL, NULL),
(229, 'AE', 'United Arab Emirates', 971, NULL, NULL),
(230, 'GB', 'United Kingdom', 44, NULL, NULL),
(231, 'US', 'United States', 1, NULL, NULL),
(232, 'UM', 'United States Minor Outlying Islands', 1, NULL, NULL),
(233, 'UY', 'Uruguay', 598, NULL, NULL),
(234, 'UZ', 'Uzbekistan', 998, NULL, NULL),
(235, 'VU', 'Vanuatu', 678, NULL, NULL),
(236, 'VA', 'Vatican City State (Holy See)', 39, NULL, NULL),
(237, 'VE', 'Venezuela', 58, NULL, NULL),
(238, 'VN', 'Vietnam', 84, NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', 1284, NULL, NULL),
(240, 'VI', 'Virgin Islands (US)', 1340, NULL, NULL),
(241, 'WF', 'Wallis And Futuna Islands', 681, NULL, NULL),
(242, 'EH', 'Western Sahara', 212, NULL, NULL),
(243, 'YE', 'Yemen', 967, NULL, NULL),
(244, 'YU', 'Yugoslavia', 38, NULL, NULL),
(245, 'ZM', 'Zambia', 260, NULL, NULL),
(246, 'ZW', 'Zimbabwe', 263, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `address` mediumtext NOT NULL,
  `system_name` varchar(50) NOT NULL,
  `starting_year` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `logo_image` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `paypal_id` varchar(50) NOT NULL,
  `date_format` varchar(255) NOT NULL,
  `currancy` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `driver_licenses_enabled` tinyint(1) DEFAULT NULL,
  `tm_key` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `address`, `system_name`, `starting_year`, `phone_number`, `email`, `city_id`, `state_id`, `country_id`, `logo_image`, `cover_image`, `paypal_id`, `date_format`, `currancy`, `created_at`, `updated_at`, `driver_licenses_enabled`, `tm_key`) VALUES
(1, 'info@light.uz', 'AgroTech', '2019', '1234567890', 'info@light.uz', NULL, 12, 101, 'B1FVpqmsLYzBL2Y.png', 'KDXGWCsmP5FCwiG.png', 'info@light.uz', 'd-m-Y', '126', '2019-07-17 03:14:38', '2023-02-19 12:53:13', 0, 'eyJ4NXQiOiJNell4TW1Ga09HWXdNV0kwWldObU5EY3hOR1l3WW1NNFpUQTNNV0kyTkRBelpHUXpOR00wWkdSbE5qSmtPREZrWkRSaU9URmtNV0ZoTXpVMlpHVmxOZyIsImtpZCI6Ik16WXhNbUZrT0dZd01XSTBaV05tTkRjeE5HWXdZbU00WlRBM01XSTJOREF6WkdRek5HTTBaR1JsTmpKa09ERmtaRFJpT1RGa01XRmhNelUyWkdWbE5nX1JTMjU2IiwiYWxnIjoiUlMyNTYifQ.eyJzdWIiOiJhZ3JvaW5zcC11c2VyIiwiYXV0IjoiQVBQTElDQVRJT05fVVNFUiIsImF1ZCI6IkwweXJVN1VfOWZwb1E4V3dSZHg3Y09ZSFdmc2EiLCJuYmYiOjE2NzY4MTEyMjYsImF6cCI6IkwweXJVN1VfOWZwb1E4V3dSZHg3Y09ZSFdmc2EiLCJzY29wZSI6ImRlZmF1bHQiLCJpc3MiOiJodHRwczpcL1wvZGUuZWdvdi51ejo5NDQzXC9vYXV0aDJcL3Rva2VuIiwiZXhwIjoxNjc2ODE0ODI2LCJpYXQiOjE2NzY4MTEyMjYsImp0aSI6ImUwNzJhODIwLTIxODEtNDI3Zi1iYjMyLTE2YzM5MmUwYTJmZCJ9.kI-G5KCeyRQK3x2_wqr-dZ1R1y-TMcPu_3oJ8Haylv7pfNZUcM1owjK5aUueC1ChsRhD-mOKPm538mNoczTyWebKejfWxk1FYdaCcifX3zONp7IViKXZgV5AAJDyTJPEh3nqxWD0lyt-DYJu8wa3ysG2KZJjcKUbDe8Y3s5H8t5qxk_1QRn8OVI9m73xeUsR8iyOFsKWtFMNSyPuSnXpotDHB1yToAmwyGSnONvbRtYRqcaYRxm_NwC1g-sBAUulJzl2ofZWRvX1barnnu2GnxyBjsDyLPNfbHuTu_kroa-_o0lfhGjvYQHc4HdLC3x0ozyjpPi9IhxWbGhrWnbSjA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

CREATE TABLE `tbl_states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(11) NOT NULL,
  `series` varchar(12) DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `soato` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`id`, `name`, `code`, `series`, `country_id`, `created_at`, `updated_at`, `list_id`, `soato`) VALUES
(3999, 'Andijon viloyati', '60', 'UZ-AN', 234, NULL, '2019-10-30 10:57:22', 3, 0),
(4000, 'Buxoro viloyati', '80', 'UZ-BU', 234, NULL, '2019-10-30 10:57:34', 6, 0),
(4002, 'Jizzax viloyati', '25', 'UZ-DJ', 234, NULL, '2019-10-30 10:57:07', 8, 0),
(4003, 'Farg\'ona viloyati', '40', 'UZ-FA', 234, NULL, '2019-10-30 10:57:45', 30, 0),
(4004, 'Xorazm viloyati', '90', 'UZ-KH', 234, NULL, '2019-10-30 10:59:43', 33, 0),
(4005, 'Qashqadaryo viloyati', '70', 'UZ-QA', 234, NULL, '2019-10-30 10:58:23', 10, 0),
(4006, 'Qoraqalpog\'iston Respublikasi', '95', 'UZ-KK', 234, NULL, '2019-10-30 10:58:35', 35, 0),
(4007, 'Namangan viloyati', '50', 'UZ-NA', 234, NULL, '2019-10-30 10:57:56', 14, 0),
(4008, 'Navoiy viloyati', '85', 'UZ-NY', 234, NULL, '2019-10-30 10:58:12', 12, 0),
(4009, 'Samarqand viloyati', '30', 'UZ-SA', 234, NULL, '2019-10-30 10:58:45', 18, 0),
(4010, 'Sirdaryo viloyati', '20', 'UZ-SI', 234, NULL, '2019-10-30 10:58:55', 24, 0),
(4011, 'Surxondaryo viloyati', '75', 'UZ-SU', 234, NULL, '2019-10-30 10:59:06', 22, 0),
(4012, 'Toshkent viloyati', '10', 'UZ-TA', 234, NULL, '2019-10-30 10:59:32', 27, 0),
(4121, 'Toshkent shahri', '01', 'UZ-TC', 234, NULL, '2019-10-30 10:59:21', 26, 0);

-- --------------------------------------------------------

--
-- Table structure for table `test_programs`
--

CREATE TABLE `test_programs` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `extra_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_programs`
--

INSERT INTO `test_programs` (`id`, `app_id`, `director_id`, `extra_data`, `code`, `status`, `created_at`, `updated_at`) VALUES
(8, 8, 24, NULL, NULL, 1, '2024-01-30 17:53:15', '2024-01-30 17:53:15'),
(9, 9, 24, NULL, NULL, 1, '2024-01-30 18:05:03', '2024-01-30 18:05:03'),
(10, 10, 24, NULL, NULL, 1, '2024-01-31 09:55:05', '2024-01-31 09:55:05'),
(11, 11, 24, NULL, NULL, 1, '2024-01-31 10:24:05', '2024-01-31 10:24:05'),
(12, 12, 24, NULL, NULL, 1, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(13, 13, 24, NULL, NULL, 1, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(14, 14, 24, NULL, NULL, 1, '2024-01-31 11:17:49', '2024-01-31 11:17:49'),
(15, 15, 24, NULL, NULL, 1, '2024-01-31 11:48:34', '2024-01-31 11:48:34'),
(16, 16, 24, NULL, NULL, 1, '2024-02-07 11:19:26', '2024-02-07 11:19:26'),
(17, 17, 24, NULL, NULL, 1, '2024-02-07 11:40:39', '2024-02-07 11:40:39'),
(18, 18, 24, NULL, NULL, 1, '2024-02-07 11:48:00', '2024-02-07 11:48:00'),
(19, 19, 24, NULL, NULL, 1, '2024-02-07 12:06:11', '2024-02-07 12:06:11'),
(20, 20, 24, NULL, NULL, 1, '2024-02-07 12:13:43', '2024-02-07 12:13:43'),
(21, 21, 24, NULL, NULL, 1, '2024-02-07 12:23:42', '2024-02-07 12:23:42'),
(22, 22, 24, NULL, NULL, 1, '2024-02-07 12:28:41', '2024-02-07 12:28:41'),
(23, 23, 24, NULL, NULL, 1, '2024-02-07 12:48:34', '2024-02-07 12:48:34'),
(24, 24, 24, NULL, NULL, 1, '2024-02-07 13:51:38', '2024-02-07 13:51:38'),
(25, 25, 24, NULL, NULL, 1, '2024-02-07 14:05:04', '2024-02-07 14:05:04'),
(26, 26, 24, NULL, NULL, 1, '2024-02-07 14:12:47', '2024-02-07 14:12:47'),
(27, 27, 24, NULL, NULL, 1, '2024-02-07 14:40:30', '2024-02-07 14:40:30'),
(28, 28, 24, NULL, NULL, 1, '2024-02-07 14:47:23', '2024-02-07 14:47:23'),
(29, 29, 24, NULL, NULL, 1, '2024-02-07 14:55:57', '2024-02-07 14:55:57'),
(30, 30, 24, NULL, NULL, 1, '2024-02-07 15:04:57', '2024-02-07 15:04:57'),
(31, 31, 24, NULL, NULL, 1, '2024-02-07 15:11:53', '2024-02-07 15:11:53'),
(32, 32, 24, NULL, NULL, 1, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(33, 33, 24, NULL, NULL, 1, '2024-02-08 11:13:31', '2024-02-08 11:13:31'),
(34, 34, 24, NULL, NULL, 1, '2024-02-08 11:24:20', '2024-02-08 11:24:20'),
(35, 35, 24, NULL, NULL, 1, '2024-02-08 13:21:50', '2024-02-08 13:21:50'),
(36, 36, 24, NULL, NULL, 1, '2024-02-08 13:29:18', '2024-02-08 13:29:18'),
(37, 37, 24, NULL, NULL, 1, '2024-02-08 13:39:07', '2024-02-08 13:39:07'),
(38, 38, 24, NULL, NULL, 1, '2024-02-08 13:45:23', '2024-02-08 13:45:23'),
(39, 39, 24, NULL, NULL, 1, '2024-02-08 13:53:32', '2024-02-08 13:53:32'),
(40, 40, 24, NULL, NULL, 1, '2024-02-08 14:02:24', '2024-02-08 14:02:24'),
(41, 41, 24, NULL, NULL, 1, '2024-02-08 14:47:27', '2024-02-08 14:47:27'),
(42, 42, 24, NULL, NULL, 1, '2024-02-08 15:07:39', '2024-02-08 15:07:39'),
(43, 43, 24, NULL, NULL, 1, '2024-02-08 15:33:39', '2024-02-08 15:33:39'),
(44, 44, 24, NULL, NULL, 1, '2024-02-08 15:49:12', '2024-02-08 15:49:12'),
(45, 45, 24, NULL, NULL, 1, '2024-02-08 15:57:53', '2024-02-08 15:57:53'),
(46, 46, 24, NULL, NULL, 1, '2024-02-09 10:47:30', '2024-02-09 10:47:30'),
(47, 47, 24, NULL, NULL, 1, '2024-02-09 11:01:41', '2024-02-09 11:01:41'),
(48, 48, 24, NULL, NULL, 1, '2024-02-09 12:02:16', '2024-02-09 12:02:16'),
(49, 49, 24, NULL, NULL, 1, '2024-02-09 12:11:15', '2024-02-09 12:11:15'),
(50, 50, 24, NULL, NULL, 1, '2024-02-09 12:15:56', '2024-02-09 12:15:56'),
(51, 51, 24, NULL, NULL, 1, '2024-02-09 12:20:42', '2024-02-09 12:20:42'),
(52, 52, 24, NULL, NULL, 1, '2024-02-09 12:24:19', '2024-02-09 12:24:19'),
(53, 53, 24, NULL, NULL, 1, '2024-02-09 12:28:18', '2024-02-09 12:28:18'),
(54, 54, 24, NULL, NULL, 1, '2024-02-09 14:21:00', '2024-02-09 14:21:00'),
(55, 55, 24, NULL, NULL, 1, '2024-02-09 15:26:37', '2024-02-09 15:26:37'),
(56, 56, 24, NULL, NULL, 1, '2024-02-09 16:22:07', '2024-02-09 16:22:07'),
(57, 57, 24, NULL, NULL, 1, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(58, 58, 24, NULL, NULL, 1, '2024-02-09 16:35:02', '2024-02-09 16:35:02'),
(59, 59, 24, NULL, NULL, 1, '2024-02-09 16:44:11', '2024-02-09 16:44:11'),
(60, 60, 24, NULL, NULL, 1, '2024-02-09 16:52:33', '2024-02-09 16:52:33'),
(61, 61, 24, NULL, NULL, 1, '2024-02-09 23:30:53', '2024-02-09 23:30:53'),
(62, 62, 24, NULL, NULL, 1, '2024-02-10 15:32:07', '2024-02-10 15:32:07'),
(63, 63, 24, NULL, NULL, 1, '2024-02-10 15:39:16', '2024-02-10 15:39:16'),
(64, 64, 24, NULL, NULL, 1, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(65, 65, 24, NULL, NULL, 1, '2024-02-10 15:56:28', '2024-02-10 15:56:28'),
(66, 66, 24, NULL, NULL, 1, '2024-02-10 16:03:39', '2024-02-10 16:03:39'),
(67, 67, 24, NULL, NULL, 1, '2024-02-10 16:11:06', '2024-02-10 16:11:06'),
(68, 68, 24, NULL, NULL, 1, '2024-02-10 16:16:14', '2024-02-10 16:16:14'),
(69, 69, 24, NULL, NULL, 1, '2024-02-10 16:31:13', '2024-02-10 16:31:13'),
(70, 70, 24, NULL, NULL, 1, '2024-02-10 16:37:17', '2024-02-10 16:37:17'),
(71, 71, 24, NULL, NULL, 1, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(72, 72, 24, NULL, NULL, 1, '2024-02-10 16:48:49', '2024-02-10 16:48:49'),
(73, 73, 24, NULL, NULL, 1, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(74, 74, 24, NULL, NULL, 1, '2024-02-10 17:18:26', '2024-02-10 17:18:26'),
(75, 75, 24, NULL, NULL, 1, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(76, 76, 24, NULL, NULL, 1, '2024-02-10 17:32:40', '2024-02-10 17:32:40'),
(77, 77, 24, NULL, NULL, 1, '2024-02-10 17:39:59', '2024-02-10 17:39:59'),
(78, 78, 24, NULL, NULL, 1, '2024-02-12 09:34:07', '2024-02-12 09:34:07'),
(79, 79, 24, NULL, NULL, 1, '2024-02-12 09:42:36', '2024-02-12 09:42:36'),
(80, 80, 24, NULL, NULL, 1, '2024-02-12 10:11:45', '2024-02-12 10:11:45'),
(81, 81, 24, NULL, NULL, 1, '2024-02-12 10:27:08', '2024-02-12 10:27:08'),
(82, 82, 24, NULL, NULL, 1, '2024-02-12 10:48:38', '2024-02-12 10:48:38'),
(83, 83, 24, NULL, NULL, 1, '2024-02-12 11:02:01', '2024-02-12 11:02:01'),
(84, 84, 24, NULL, NULL, 1, '2024-02-12 11:10:51', '2024-02-12 11:10:51'),
(85, 85, 24, NULL, NULL, 1, '2024-02-12 11:23:15', '2024-02-12 11:23:15'),
(86, 86, 24, NULL, NULL, 1, '2024-02-12 11:45:13', '2024-02-12 11:45:13'),
(87, 87, 24, NULL, NULL, 1, '2024-02-12 11:56:55', '2024-02-12 11:56:55'),
(88, 88, 24, NULL, NULL, 1, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(89, 89, 24, NULL, NULL, 1, '2024-02-12 12:17:11', '2024-02-12 12:17:11'),
(90, 90, 24, NULL, NULL, 1, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(91, 91, 24, NULL, NULL, 1, '2024-02-12 12:53:38', '2024-02-12 12:53:38'),
(92, 92, 24, NULL, NULL, 1, '2024-02-12 13:00:43', '2024-02-12 13:00:43'),
(93, 93, 24, NULL, NULL, 1, '2024-02-12 13:08:39', '2024-02-12 13:08:39'),
(94, 94, 24, NULL, NULL, 1, '2024-02-12 13:15:12', '2024-02-12 13:15:12'),
(95, 95, 24, NULL, NULL, 1, '2024-02-12 13:21:31', '2024-02-12 13:21:31'),
(96, 96, 24, NULL, NULL, 1, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(97, 97, 24, NULL, NULL, 1, '2024-02-12 13:36:42', '2024-02-12 13:36:42'),
(98, 98, 24, NULL, NULL, 1, '2024-02-12 13:47:27', '2024-02-12 13:47:27'),
(99, 99, 24, NULL, NULL, 1, '2024-02-12 14:17:56', '2024-02-12 14:17:56'),
(100, 100, 24, NULL, NULL, 1, '2024-02-12 14:23:17', '2024-02-12 14:23:17'),
(101, 101, 24, NULL, NULL, 1, '2024-02-12 14:29:45', '2024-02-12 14:29:45'),
(102, 102, 24, NULL, NULL, 1, '2024-02-12 14:34:17', '2024-02-12 14:34:17'),
(103, 103, 24, NULL, NULL, 1, '2024-02-12 14:48:35', '2024-02-12 14:48:35'),
(104, 104, 24, NULL, NULL, 1, '2024-02-12 15:00:07', '2024-02-12 15:00:07'),
(105, 105, 24, NULL, NULL, 1, '2024-02-12 15:11:14', '2024-02-12 15:11:14'),
(106, 106, 24, NULL, NULL, 1, '2024-02-13 13:27:34', '2024-02-13 13:27:34'),
(107, 107, 24, NULL, NULL, 1, '2024-02-13 13:39:36', '2024-02-13 13:39:36'),
(108, 108, 24, NULL, NULL, 1, '2024-02-13 13:46:08', '2024-02-13 13:46:08'),
(109, 109, 24, NULL, NULL, 1, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(110, 110, 24, NULL, NULL, 1, '2024-02-13 14:21:15', '2024-02-13 14:21:15'),
(111, 111, 24, NULL, NULL, 1, '2024-02-13 15:07:11', '2024-02-13 15:07:11'),
(112, 112, 24, NULL, NULL, 1, '2024-02-13 15:16:23', '2024-02-13 15:16:23'),
(113, 113, 24, NULL, NULL, 1, '2024-02-13 15:23:50', '2024-02-13 15:23:50'),
(114, 114, 24, NULL, NULL, 1, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(115, 115, 24, NULL, NULL, 1, '2024-02-13 17:37:44', '2024-02-13 17:37:44'),
(116, 116, 24, NULL, NULL, 1, '2024-02-13 17:46:10', '2024-02-13 17:46:10'),
(117, 117, 24, NULL, NULL, 1, '2024-02-13 18:01:26', '2024-02-13 18:01:26'),
(118, 118, 24, NULL, NULL, 1, '2024-02-15 13:15:14', '2024-02-15 13:15:14'),
(119, 119, 24, NULL, NULL, 1, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(120, 120, 24, NULL, NULL, 1, '2024-02-15 16:55:17', '2024-02-15 16:55:17'),
(121, 121, 24, NULL, NULL, 1, '2024-02-16 11:24:30', '2024-02-16 11:24:30'),
(122, 122, 24, NULL, NULL, 1, '2024-02-19 13:17:08', '2024-02-19 13:17:08'),
(123, 123, 24, NULL, NULL, 1, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(124, 124, 24, NULL, NULL, 1, '2024-02-19 13:36:12', '2024-02-19 13:36:12'),
(125, 125, 24, NULL, NULL, 1, '2024-02-19 13:46:50', '2024-02-19 13:46:50'),
(126, 126, 24, NULL, NULL, 1, '2024-02-19 13:55:25', '2024-02-19 13:55:25'),
(127, 127, 24, NULL, NULL, 1, '2024-02-21 11:21:05', '2024-02-21 11:21:05'),
(128, 128, 24, NULL, NULL, 1, '2024-02-21 11:29:34', '2024-02-21 11:29:34'),
(129, 129, 24, NULL, NULL, 1, '2024-02-21 11:38:36', '2024-02-21 11:38:36'),
(130, 130, 24, NULL, NULL, 1, '2024-02-21 11:52:50', '2024-02-21 11:52:50'),
(131, 131, 24, NULL, NULL, 1, '2024-02-23 15:06:28', '2024-02-23 15:06:28'),
(133, 139, 24, NULL, NULL, 1, '2024-02-26 12:43:16', '2024-02-26 12:43:16'),
(134, 140, 24, NULL, NULL, 1, '2024-02-27 17:08:19', '2024-02-27 17:08:19'),
(135, 141, 24, NULL, NULL, 1, '2024-02-28 16:23:36', '2024-02-28 16:23:36'),
(136, 1, 24, NULL, NULL, 1, '2024-02-29 10:07:36', '2024-02-29 10:07:36'),
(137, 2, 24, NULL, NULL, 1, '2024-02-29 10:14:27', '2024-02-29 10:14:27'),
(138, 4, 24, NULL, NULL, 1, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(139, 5, 24, NULL, NULL, 1, '2024-02-29 10:25:55', '2024-02-29 10:25:55'),
(140, 6, 24, NULL, NULL, 1, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(141, 7, 24, NULL, NULL, 1, '2024-02-29 10:35:02', '2024-02-29 10:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `test_programs_status_changes`
--

CREATE TABLE `test_programs_status_changes` (
  `id` int(11) NOT NULL,
  `test_program_id` int(11) NOT NULL,
  `status_type` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_program_indicators`
--

CREATE TABLE `test_program_indicators` (
  `id` int(11) NOT NULL,
  `test_program_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `result` float DEFAULT NULL,
  `type` int(2) NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_program_indicators`
--

INSERT INTO `test_program_indicators` (`id`, `test_program_id`, `indicator_id`, `created_at`, `updated_at`) VALUES
(58, 8, 108, '2024-01-30 17:53:15', '2024-01-30 17:53:15'),
(59, 8, 109, '2024-01-30 17:53:15', '2024-01-30 17:53:15'),
(60, 8, 110, '2024-01-30 17:53:15', '2024-01-30 17:53:15'),
(61, 8, 111, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(62, 8, 112, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(63, 8, 113, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(64, 8, 114, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(65, 8, 115, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(66, 8, 116, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(67, 8, 117, '2024-01-30 17:53:16', '2024-01-30 17:53:16'),
(68, 9, 108, '2024-01-30 18:05:03', '2024-01-30 18:05:03'),
(69, 9, 109, '2024-01-30 18:05:03', '2024-01-30 18:05:03'),
(70, 9, 110, '2024-01-30 18:05:03', '2024-01-30 18:05:03'),
(71, 9, 111, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(72, 9, 112, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(73, 9, 113, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(74, 9, 114, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(75, 9, 115, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(76, 9, 116, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(77, 9, 117, '2024-01-30 18:05:04', '2024-01-30 18:05:04'),
(78, 10, 108, '2024-01-31 09:55:05', '2024-01-31 09:55:05'),
(79, 10, 109, '2024-01-31 09:55:05', '2024-01-31 09:55:05'),
(80, 10, 110, '2024-01-31 09:55:05', '2024-01-31 09:55:05'),
(81, 10, 111, '2024-01-31 09:55:05', '2024-01-31 09:55:05'),
(82, 10, 112, '2024-01-31 09:55:06', '2024-01-31 09:55:06'),
(83, 10, 113, '2024-01-31 09:55:06', '2024-01-31 09:55:06'),
(84, 10, 114, '2024-01-31 09:55:06', '2024-01-31 09:55:06'),
(85, 10, 115, '2024-01-31 09:55:06', '2024-01-31 09:55:06'),
(86, 10, 116, '2024-01-31 09:55:06', '2024-01-31 09:55:06'),
(87, 10, 117, '2024-01-31 09:55:06', '2024-01-31 09:55:06'),
(88, 11, 108, '2024-01-31 10:24:05', '2024-01-31 10:24:05'),
(89, 11, 109, '2024-01-31 10:24:05', '2024-01-31 10:24:05'),
(90, 11, 110, '2024-01-31 10:24:05', '2024-01-31 10:24:05'),
(91, 11, 111, '2024-01-31 10:24:05', '2024-01-31 10:24:05'),
(92, 11, 112, '2024-01-31 10:24:05', '2024-01-31 10:24:05'),
(93, 11, 113, '2024-01-31 10:24:06', '2024-01-31 10:24:06'),
(94, 11, 114, '2024-01-31 10:24:06', '2024-01-31 10:24:06'),
(95, 11, 115, '2024-01-31 10:24:06', '2024-01-31 10:24:06'),
(96, 11, 116, '2024-01-31 10:24:06', '2024-01-31 10:24:06'),
(97, 11, 117, '2024-01-31 10:24:06', '2024-01-31 10:24:06'),
(98, 12, 108, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(99, 12, 109, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(100, 12, 110, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(101, 12, 111, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(102, 12, 112, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(103, 12, 113, '2024-01-31 10:43:50', '2024-01-31 10:43:50'),
(104, 12, 114, '2024-01-31 10:43:51', '2024-01-31 10:43:51'),
(105, 12, 115, '2024-01-31 10:43:51', '2024-01-31 10:43:51'),
(106, 12, 116, '2024-01-31 10:43:51', '2024-01-31 10:43:51'),
(107, 12, 117, '2024-01-31 10:43:51', '2024-01-31 10:43:51'),
(108, 13, 108, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(109, 13, 109, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(110, 13, 110, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(111, 13, 111, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(112, 13, 112, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(113, 13, 113, '2024-01-31 11:04:08', '2024-01-31 11:04:08'),
(114, 13, 114, '2024-01-31 11:04:09', '2024-01-31 11:04:09'),
(115, 13, 115, '2024-01-31 11:04:09', '2024-01-31 11:04:09'),
(116, 13, 116, '2024-01-31 11:04:09', '2024-01-31 11:04:09'),
(117, 13, 117, '2024-01-31 11:04:09', '2024-01-31 11:04:09'),
(118, 14, 108, '2024-01-31 11:17:50', '2024-01-31 11:17:50'),
(119, 14, 109, '2024-01-31 11:17:50', '2024-01-31 11:17:50'),
(120, 14, 110, '2024-01-31 11:17:50', '2024-01-31 11:17:50'),
(121, 14, 111, '2024-01-31 11:17:50', '2024-01-31 11:17:50'),
(122, 14, 112, '2024-01-31 11:17:50', '2024-01-31 11:17:50'),
(123, 14, 113, '2024-01-31 11:17:51', '2024-01-31 11:17:51'),
(124, 14, 114, '2024-01-31 11:17:51', '2024-01-31 11:17:51'),
(125, 14, 115, '2024-01-31 11:17:51', '2024-01-31 11:17:51'),
(126, 14, 116, '2024-01-31 11:17:51', '2024-01-31 11:17:51'),
(127, 14, 117, '2024-01-31 11:17:51', '2024-01-31 11:17:51'),
(128, 15, 118, '2024-01-31 11:48:34', '2024-01-31 11:48:34'),
(129, 15, 119, '2024-01-31 11:48:34', '2024-01-31 11:48:34'),
(130, 15, 120, '2024-01-31 11:48:34', '2024-01-31 11:48:34'),
(131, 15, 121, '2024-01-31 11:48:34', '2024-01-31 11:48:34'),
(132, 15, 122, '2024-01-31 11:48:35', '2024-01-31 11:48:35'),
(133, 15, 123, '2024-01-31 11:48:35', '2024-01-31 11:48:35'),
(134, 15, 124, '2024-01-31 11:48:35', '2024-01-31 11:48:35'),
(135, 16, 108, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(136, 16, 109, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(137, 16, 110, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(138, 16, 111, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(139, 16, 112, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(140, 16, 113, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(141, 16, 114, '2024-02-07 11:19:27', '2024-02-07 11:19:27'),
(142, 16, 115, '2024-02-07 11:19:28', '2024-02-07 11:19:28'),
(143, 16, 116, '2024-02-07 11:19:28', '2024-02-07 11:19:28'),
(144, 16, 117, '2024-02-07 11:19:28', '2024-02-07 11:19:28'),
(145, 17, 108, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(146, 17, 109, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(147, 17, 110, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(148, 17, 111, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(149, 17, 112, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(150, 17, 113, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(151, 17, 114, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(152, 17, 115, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(153, 17, 116, '2024-02-07 11:40:40', '2024-02-07 11:40:40'),
(154, 17, 117, '2024-02-07 11:40:41', '2024-02-07 11:40:41'),
(155, 18, 108, '2024-02-07 11:48:00', '2024-02-07 11:48:00'),
(156, 18, 109, '2024-02-07 11:48:00', '2024-02-07 11:48:00'),
(157, 18, 110, '2024-02-07 11:48:00', '2024-02-07 11:48:00'),
(158, 18, 111, '2024-02-07 11:48:00', '2024-02-07 11:48:00'),
(159, 18, 112, '2024-02-07 11:48:01', '2024-02-07 11:48:01'),
(160, 18, 113, '2024-02-07 11:48:01', '2024-02-07 11:48:01'),
(161, 18, 114, '2024-02-07 11:48:01', '2024-02-07 11:48:01'),
(162, 18, 115, '2024-02-07 11:48:01', '2024-02-07 11:48:01'),
(163, 18, 116, '2024-02-07 11:48:01', '2024-02-07 11:48:01'),
(164, 18, 117, '2024-02-07 11:48:02', '2024-02-07 11:48:02'),
(165, 19, 108, '2024-02-07 12:06:11', '2024-02-07 12:06:11'),
(166, 19, 109, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(167, 19, 110, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(168, 19, 111, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(169, 19, 112, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(170, 19, 113, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(171, 19, 114, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(172, 19, 115, '2024-02-07 12:06:12', '2024-02-07 12:06:12'),
(173, 19, 116, '2024-02-07 12:06:13', '2024-02-07 12:06:13'),
(174, 19, 117, '2024-02-07 12:06:13', '2024-02-07 12:06:13'),
(175, 20, 108, '2024-02-07 12:13:44', '2024-02-07 12:13:44'),
(176, 20, 109, '2024-02-07 12:13:44', '2024-02-07 12:13:44'),
(177, 20, 110, '2024-02-07 12:13:44', '2024-02-07 12:13:44'),
(178, 20, 111, '2024-02-07 12:13:44', '2024-02-07 12:13:44'),
(179, 20, 112, '2024-02-07 12:13:44', '2024-02-07 12:13:44'),
(180, 20, 113, '2024-02-07 12:13:45', '2024-02-07 12:13:45'),
(181, 20, 114, '2024-02-07 12:13:45', '2024-02-07 12:13:45'),
(182, 20, 115, '2024-02-07 12:13:45', '2024-02-07 12:13:45'),
(183, 20, 116, '2024-02-07 12:13:45', '2024-02-07 12:13:45'),
(184, 20, 117, '2024-02-07 12:13:45', '2024-02-07 12:13:45'),
(185, 21, 108, '2024-02-07 12:23:42', '2024-02-07 12:23:42'),
(186, 21, 109, '2024-02-07 12:23:42', '2024-02-07 12:23:42'),
(187, 21, 110, '2024-02-07 12:23:42', '2024-02-07 12:23:42'),
(188, 21, 111, '2024-02-07 12:23:42', '2024-02-07 12:23:42'),
(189, 21, 112, '2024-02-07 12:23:42', '2024-02-07 12:23:42'),
(190, 21, 113, '2024-02-07 12:23:43', '2024-02-07 12:23:43'),
(191, 21, 114, '2024-02-07 12:23:43', '2024-02-07 12:23:43'),
(192, 21, 115, '2024-02-07 12:23:43', '2024-02-07 12:23:43'),
(193, 21, 116, '2024-02-07 12:23:43', '2024-02-07 12:23:43'),
(194, 21, 117, '2024-02-07 12:23:43', '2024-02-07 12:23:43'),
(195, 22, 108, '2024-02-07 12:28:42', '2024-02-07 12:28:42'),
(196, 22, 109, '2024-02-07 12:28:42', '2024-02-07 12:28:42'),
(197, 22, 110, '2024-02-07 12:28:42', '2024-02-07 12:28:42'),
(198, 22, 111, '2024-02-07 12:28:42', '2024-02-07 12:28:42'),
(199, 22, 112, '2024-02-07 12:28:42', '2024-02-07 12:28:42'),
(200, 22, 113, '2024-02-07 12:28:42', '2024-02-07 12:28:42'),
(201, 22, 114, '2024-02-07 12:28:43', '2024-02-07 12:28:43'),
(202, 22, 115, '2024-02-07 12:28:43', '2024-02-07 12:28:43'),
(203, 22, 116, '2024-02-07 12:28:43', '2024-02-07 12:28:43'),
(204, 22, 117, '2024-02-07 12:28:43', '2024-02-07 12:28:43'),
(205, 23, 125, '2024-02-07 12:48:34', '2024-02-07 12:48:34'),
(206, 23, 126, '2024-02-07 12:48:34', '2024-02-07 12:48:34'),
(207, 23, 127, '2024-02-07 12:48:34', '2024-02-07 12:48:34'),
(208, 23, 128, '2024-02-07 12:48:34', '2024-02-07 12:48:34'),
(209, 24, 125, '2024-02-07 13:51:38', '2024-02-07 13:51:38'),
(210, 24, 126, '2024-02-07 13:51:38', '2024-02-07 13:51:38'),
(211, 24, 127, '2024-02-07 13:51:38', '2024-02-07 13:51:38'),
(212, 24, 128, '2024-02-07 13:51:39', '2024-02-07 13:51:39'),
(213, 25, 125, '2024-02-07 14:05:04', '2024-02-07 14:05:04'),
(214, 25, 126, '2024-02-07 14:05:04', '2024-02-07 14:05:04'),
(215, 25, 127, '2024-02-07 14:05:04', '2024-02-07 14:05:04'),
(216, 25, 128, '2024-02-07 14:05:04', '2024-02-07 14:05:04'),
(217, 26, 108, '2024-02-07 14:12:47', '2024-02-07 14:12:47'),
(218, 26, 109, '2024-02-07 14:12:47', '2024-02-07 14:12:47'),
(219, 26, 110, '2024-02-07 14:12:47', '2024-02-07 14:12:47'),
(220, 26, 111, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(221, 26, 112, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(222, 26, 113, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(223, 26, 114, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(224, 26, 115, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(225, 26, 116, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(226, 26, 117, '2024-02-07 14:12:48', '2024-02-07 14:12:48'),
(227, 27, 129, '2024-02-07 14:40:31', '2024-02-07 14:40:31'),
(228, 27, 130, '2024-02-07 14:40:31', '2024-02-07 14:40:31'),
(229, 27, 131, '2024-02-07 14:40:31', '2024-02-07 14:40:31'),
(230, 27, 132, '2024-02-07 14:40:31', '2024-02-07 14:40:31'),
(231, 28, 108, '2024-02-07 14:47:23', '2024-02-07 14:47:23'),
(232, 28, 109, '2024-02-07 14:47:23', '2024-02-07 14:47:23'),
(233, 28, 110, '2024-02-07 14:47:23', '2024-02-07 14:47:23'),
(234, 28, 111, '2024-02-07 14:47:23', '2024-02-07 14:47:23'),
(235, 28, 112, '2024-02-07 14:47:24', '2024-02-07 14:47:24'),
(236, 28, 113, '2024-02-07 14:47:24', '2024-02-07 14:47:24'),
(237, 28, 114, '2024-02-07 14:47:24', '2024-02-07 14:47:24'),
(238, 28, 115, '2024-02-07 14:47:24', '2024-02-07 14:47:24'),
(239, 28, 116, '2024-02-07 14:47:24', '2024-02-07 14:47:24'),
(240, 28, 117, '2024-02-07 14:47:24', '2024-02-07 14:47:24'),
(241, 29, 125, '2024-02-07 14:55:57', '2024-02-07 14:55:57'),
(242, 29, 126, '2024-02-07 14:55:57', '2024-02-07 14:55:57'),
(243, 29, 127, '2024-02-07 14:55:58', '2024-02-07 14:55:58'),
(244, 29, 128, '2024-02-07 14:55:58', '2024-02-07 14:55:58'),
(245, 30, 125, '2024-02-07 15:04:58', '2024-02-07 15:04:58'),
(246, 30, 126, '2024-02-07 15:04:58', '2024-02-07 15:04:58'),
(247, 30, 127, '2024-02-07 15:04:58', '2024-02-07 15:04:58'),
(248, 30, 128, '2024-02-07 15:04:58', '2024-02-07 15:04:58'),
(249, 31, 129, '2024-02-07 15:11:54', '2024-02-07 15:11:54'),
(250, 31, 130, '2024-02-07 15:11:54', '2024-02-07 15:11:54'),
(251, 31, 131, '2024-02-07 15:11:54', '2024-02-07 15:11:54'),
(252, 31, 132, '2024-02-07 15:11:54', '2024-02-07 15:11:54'),
(253, 32, 118, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(254, 32, 119, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(255, 32, 120, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(256, 32, 121, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(257, 32, 122, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(258, 32, 123, '2024-02-07 15:37:43', '2024-02-07 15:37:43'),
(259, 32, 124, '2024-02-07 15:37:44', '2024-02-07 15:37:44'),
(260, 33, 118, '2024-02-08 11:13:31', '2024-02-08 11:13:31'),
(261, 33, 119, '2024-02-08 11:13:31', '2024-02-08 11:13:31'),
(262, 33, 120, '2024-02-08 11:13:31', '2024-02-08 11:13:31'),
(263, 33, 121, '2024-02-08 11:13:31', '2024-02-08 11:13:31'),
(264, 33, 122, '2024-02-08 11:13:32', '2024-02-08 11:13:32'),
(265, 33, 123, '2024-02-08 11:13:32', '2024-02-08 11:13:32'),
(266, 33, 124, '2024-02-08 11:13:32', '2024-02-08 11:13:32'),
(267, 34, 125, '2024-02-08 11:24:20', '2024-02-08 11:24:20'),
(268, 34, 126, '2024-02-08 11:24:21', '2024-02-08 11:24:21'),
(269, 34, 127, '2024-02-08 11:24:21', '2024-02-08 11:24:21'),
(270, 34, 128, '2024-02-08 11:24:21', '2024-02-08 11:24:21'),
(271, 35, 118, '2024-02-08 13:21:51', '2024-02-08 13:21:51'),
(272, 35, 119, '2024-02-08 13:21:51', '2024-02-08 13:21:51'),
(273, 35, 120, '2024-02-08 13:21:51', '2024-02-08 13:21:51'),
(274, 35, 121, '2024-02-08 13:21:51', '2024-02-08 13:21:51'),
(275, 35, 122, '2024-02-08 13:21:51', '2024-02-08 13:21:51'),
(276, 35, 123, '2024-02-08 13:21:52', '2024-02-08 13:21:52'),
(277, 35, 124, '2024-02-08 13:21:52', '2024-02-08 13:21:52'),
(278, 36, 129, '2024-02-08 13:29:18', '2024-02-08 13:29:18'),
(279, 36, 130, '2024-02-08 13:29:18', '2024-02-08 13:29:18'),
(280, 36, 131, '2024-02-08 13:29:18', '2024-02-08 13:29:18'),
(281, 36, 132, '2024-02-08 13:29:18', '2024-02-08 13:29:18'),
(282, 37, 118, '2024-02-08 13:39:08', '2024-02-08 13:39:08'),
(283, 37, 119, '2024-02-08 13:39:08', '2024-02-08 13:39:08'),
(284, 37, 120, '2024-02-08 13:39:08', '2024-02-08 13:39:08'),
(285, 37, 121, '2024-02-08 13:39:08', '2024-02-08 13:39:08'),
(286, 37, 122, '2024-02-08 13:39:08', '2024-02-08 13:39:08'),
(287, 37, 123, '2024-02-08 13:39:08', '2024-02-08 13:39:08'),
(288, 37, 124, '2024-02-08 13:39:09', '2024-02-08 13:39:09'),
(289, 38, 118, '2024-02-08 13:45:23', '2024-02-08 13:45:23'),
(290, 38, 119, '2024-02-08 13:45:23', '2024-02-08 13:45:23'),
(291, 38, 120, '2024-02-08 13:45:23', '2024-02-08 13:45:23'),
(292, 38, 121, '2024-02-08 13:45:23', '2024-02-08 13:45:23'),
(293, 38, 122, '2024-02-08 13:45:23', '2024-02-08 13:45:23'),
(294, 38, 123, '2024-02-08 13:45:24', '2024-02-08 13:45:24'),
(295, 38, 124, '2024-02-08 13:45:24', '2024-02-08 13:45:24'),
(296, 39, 118, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(297, 39, 119, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(298, 39, 120, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(299, 39, 121, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(300, 39, 122, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(301, 39, 123, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(302, 39, 124, '2024-02-08 13:53:33', '2024-02-08 13:53:33'),
(303, 40, 108, '2024-02-08 14:02:25', '2024-02-08 14:02:25'),
(304, 40, 109, '2024-02-08 14:02:25', '2024-02-08 14:02:25'),
(305, 40, 110, '2024-02-08 14:02:25', '2024-02-08 14:02:25'),
(306, 40, 111, '2024-02-08 14:02:25', '2024-02-08 14:02:25'),
(307, 40, 112, '2024-02-08 14:02:25', '2024-02-08 14:02:25'),
(308, 40, 113, '2024-02-08 14:02:26', '2024-02-08 14:02:26'),
(309, 40, 114, '2024-02-08 14:02:26', '2024-02-08 14:02:26'),
(310, 40, 115, '2024-02-08 14:02:26', '2024-02-08 14:02:26'),
(311, 40, 116, '2024-02-08 14:02:26', '2024-02-08 14:02:26'),
(312, 40, 117, '2024-02-08 14:02:26', '2024-02-08 14:02:26'),
(313, 41, 118, '2024-02-08 14:47:27', '2024-02-08 14:47:27'),
(314, 41, 119, '2024-02-08 14:47:27', '2024-02-08 14:47:27'),
(315, 41, 120, '2024-02-08 14:47:28', '2024-02-08 14:47:28'),
(316, 41, 121, '2024-02-08 14:47:28', '2024-02-08 14:47:28'),
(317, 41, 122, '2024-02-08 14:47:28', '2024-02-08 14:47:28'),
(318, 41, 123, '2024-02-08 14:47:28', '2024-02-08 14:47:28'),
(319, 41, 124, '2024-02-08 14:47:28', '2024-02-08 14:47:28'),
(320, 42, 118, '2024-02-08 15:07:39', '2024-02-08 15:07:39'),
(321, 42, 119, '2024-02-08 15:07:39', '2024-02-08 15:07:39'),
(322, 42, 120, '2024-02-08 15:07:40', '2024-02-08 15:07:40'),
(323, 42, 121, '2024-02-08 15:07:40', '2024-02-08 15:07:40'),
(324, 42, 122, '2024-02-08 15:07:40', '2024-02-08 15:07:40'),
(325, 42, 123, '2024-02-08 15:07:40', '2024-02-08 15:07:40'),
(326, 42, 124, '2024-02-08 15:07:40', '2024-02-08 15:07:40'),
(327, 43, 133, '2024-02-08 15:33:40', '2024-02-08 15:33:40'),
(328, 43, 134, '2024-02-08 15:33:40', '2024-02-08 15:33:40'),
(329, 43, 135, '2024-02-08 15:33:40', '2024-02-08 15:33:40'),
(330, 43, 136, '2024-02-08 15:33:40', '2024-02-08 15:33:40'),
(331, 43, 137, '2024-02-08 15:33:40', '2024-02-08 15:33:40'),
(337, 44, 138, '2024-02-08 15:49:35', '2024-02-08 15:49:35'),
(338, 44, 139, '2024-02-08 15:49:35', '2024-02-08 15:49:35'),
(339, 44, 140, '2024-02-08 15:49:35', '2024-02-08 15:49:35'),
(340, 44, 141, '2024-02-08 15:49:35', '2024-02-08 15:49:35'),
(341, 44, 142, '2024-02-08 15:49:35', '2024-02-08 15:49:35'),
(342, 45, 108, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(343, 45, 109, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(344, 45, 110, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(345, 45, 111, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(346, 45, 112, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(347, 45, 113, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(348, 45, 114, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(349, 45, 115, '2024-02-08 15:57:54', '2024-02-08 15:57:54'),
(350, 45, 116, '2024-02-08 15:57:55', '2024-02-08 15:57:55'),
(351, 45, 117, '2024-02-08 15:57:55', '2024-02-08 15:57:55'),
(352, 46, 108, '2024-02-09 10:47:31', '2024-02-09 10:47:31'),
(353, 46, 109, '2024-02-09 10:47:31', '2024-02-09 10:47:31'),
(354, 46, 110, '2024-02-09 10:47:31', '2024-02-09 10:47:31'),
(355, 46, 111, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(356, 46, 112, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(357, 46, 113, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(358, 46, 114, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(359, 46, 115, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(360, 46, 116, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(361, 46, 117, '2024-02-09 10:47:32', '2024-02-09 10:47:32'),
(362, 47, 108, '2024-02-09 11:01:42', '2024-02-09 11:01:42'),
(363, 47, 109, '2024-02-09 11:01:42', '2024-02-09 11:01:42'),
(364, 47, 110, '2024-02-09 11:01:42', '2024-02-09 11:01:42'),
(365, 47, 111, '2024-02-09 11:01:42', '2024-02-09 11:01:42'),
(366, 47, 112, '2024-02-09 11:01:42', '2024-02-09 11:01:42'),
(367, 47, 113, '2024-02-09 11:01:42', '2024-02-09 11:01:42'),
(368, 47, 114, '2024-02-09 11:01:43', '2024-02-09 11:01:43'),
(369, 47, 115, '2024-02-09 11:01:43', '2024-02-09 11:01:43'),
(370, 47, 116, '2024-02-09 11:01:43', '2024-02-09 11:01:43'),
(371, 47, 117, '2024-02-09 11:01:43', '2024-02-09 11:01:43'),
(372, 48, 108, '2024-02-09 12:02:16', '2024-02-09 12:02:16'),
(373, 48, 109, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(374, 48, 110, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(375, 48, 111, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(376, 48, 112, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(377, 48, 113, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(378, 48, 114, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(379, 48, 115, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(380, 48, 116, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(381, 48, 117, '2024-02-09 12:02:17', '2024-02-09 12:02:17'),
(382, 49, 108, '2024-02-09 12:11:15', '2024-02-09 12:11:15'),
(383, 49, 109, '2024-02-09 12:11:15', '2024-02-09 12:11:15'),
(384, 49, 110, '2024-02-09 12:11:15', '2024-02-09 12:11:15'),
(385, 49, 111, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(386, 49, 112, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(387, 49, 113, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(388, 49, 114, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(389, 49, 115, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(390, 49, 116, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(391, 49, 117, '2024-02-09 12:11:16', '2024-02-09 12:11:16'),
(392, 50, 108, '2024-02-09 12:15:56', '2024-02-09 12:15:56'),
(393, 50, 109, '2024-02-09 12:15:56', '2024-02-09 12:15:56'),
(394, 50, 110, '2024-02-09 12:15:56', '2024-02-09 12:15:56'),
(395, 50, 111, '2024-02-09 12:15:56', '2024-02-09 12:15:56'),
(396, 50, 112, '2024-02-09 12:15:56', '2024-02-09 12:15:56'),
(397, 50, 113, '2024-02-09 12:15:57', '2024-02-09 12:15:57'),
(398, 50, 114, '2024-02-09 12:15:57', '2024-02-09 12:15:57'),
(399, 50, 115, '2024-02-09 12:15:57', '2024-02-09 12:15:57'),
(400, 50, 116, '2024-02-09 12:15:57', '2024-02-09 12:15:57'),
(401, 50, 117, '2024-02-09 12:15:57', '2024-02-09 12:15:57'),
(402, 51, 108, '2024-02-09 12:20:42', '2024-02-09 12:20:42'),
(403, 51, 109, '2024-02-09 12:20:42', '2024-02-09 12:20:42'),
(404, 51, 110, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(405, 51, 111, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(406, 51, 112, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(407, 51, 113, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(408, 51, 114, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(409, 51, 115, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(410, 51, 116, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(411, 51, 117, '2024-02-09 12:20:43', '2024-02-09 12:20:43'),
(412, 52, 108, '2024-02-09 12:24:19', '2024-02-09 12:24:19'),
(413, 52, 109, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(414, 52, 110, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(415, 52, 111, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(416, 52, 112, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(417, 52, 113, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(418, 52, 114, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(419, 52, 115, '2024-02-09 12:24:20', '2024-02-09 12:24:20'),
(420, 52, 116, '2024-02-09 12:24:21', '2024-02-09 12:24:21'),
(421, 52, 117, '2024-02-09 12:24:21', '2024-02-09 12:24:21'),
(422, 53, 108, '2024-02-09 12:28:18', '2024-02-09 12:28:18'),
(423, 53, 109, '2024-02-09 12:28:18', '2024-02-09 12:28:18'),
(424, 53, 110, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(425, 53, 111, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(426, 53, 112, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(427, 53, 113, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(428, 53, 114, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(429, 53, 115, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(430, 53, 116, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(431, 53, 117, '2024-02-09 12:28:19', '2024-02-09 12:28:19'),
(432, 54, 108, '2024-02-09 14:21:00', '2024-02-09 14:21:00'),
(433, 54, 109, '2024-02-09 14:21:00', '2024-02-09 14:21:00'),
(434, 54, 110, '2024-02-09 14:21:00', '2024-02-09 14:21:00'),
(435, 54, 111, '2024-02-09 14:21:00', '2024-02-09 14:21:00'),
(436, 54, 112, '2024-02-09 14:21:01', '2024-02-09 14:21:01'),
(437, 54, 113, '2024-02-09 14:21:01', '2024-02-09 14:21:01'),
(438, 54, 114, '2024-02-09 14:21:01', '2024-02-09 14:21:01'),
(439, 54, 115, '2024-02-09 14:21:01', '2024-02-09 14:21:01'),
(440, 54, 116, '2024-02-09 14:21:01', '2024-02-09 14:21:01'),
(441, 54, 117, '2024-02-09 14:21:01', '2024-02-09 14:21:01'),
(442, 55, 108, '2024-02-09 15:26:37', '2024-02-09 15:26:37'),
(443, 55, 109, '2024-02-09 15:26:37', '2024-02-09 15:26:37'),
(444, 55, 110, '2024-02-09 15:26:37', '2024-02-09 15:26:37'),
(445, 55, 111, '2024-02-09 15:26:37', '2024-02-09 15:26:37'),
(446, 55, 112, '2024-02-09 15:26:38', '2024-02-09 15:26:38'),
(447, 55, 113, '2024-02-09 15:26:38', '2024-02-09 15:26:38'),
(448, 55, 114, '2024-02-09 15:26:38', '2024-02-09 15:26:38'),
(449, 55, 115, '2024-02-09 15:26:38', '2024-02-09 15:26:38'),
(450, 55, 116, '2024-02-09 15:26:38', '2024-02-09 15:26:38'),
(451, 55, 117, '2024-02-09 15:26:38', '2024-02-09 15:26:38'),
(452, 56, 108, '2024-02-09 16:22:07', '2024-02-09 16:22:07'),
(453, 56, 109, '2024-02-09 16:22:07', '2024-02-09 16:22:07'),
(454, 56, 110, '2024-02-09 16:22:07', '2024-02-09 16:22:07'),
(455, 56, 111, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(456, 56, 112, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(457, 56, 113, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(458, 56, 114, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(459, 56, 115, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(460, 56, 116, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(461, 56, 117, '2024-02-09 16:22:08', '2024-02-09 16:22:08'),
(462, 57, 108, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(463, 57, 109, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(464, 57, 110, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(465, 57, 111, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(466, 57, 112, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(467, 57, 113, '2024-02-09 16:28:08', '2024-02-09 16:28:08'),
(468, 57, 114, '2024-02-09 16:28:09', '2024-02-09 16:28:09'),
(469, 57, 115, '2024-02-09 16:28:09', '2024-02-09 16:28:09'),
(470, 57, 116, '2024-02-09 16:28:09', '2024-02-09 16:28:09'),
(471, 57, 117, '2024-02-09 16:28:09', '2024-02-09 16:28:09'),
(472, 58, 108, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(473, 58, 109, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(474, 58, 110, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(475, 58, 111, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(476, 58, 112, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(477, 58, 113, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(478, 58, 114, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(479, 58, 115, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(480, 58, 116, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(481, 58, 117, '2024-02-09 16:35:03', '2024-02-09 16:35:03'),
(482, 59, 108, '2024-02-09 16:44:11', '2024-02-09 16:44:11'),
(483, 59, 109, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(484, 59, 110, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(485, 59, 111, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(486, 59, 112, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(487, 59, 113, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(488, 59, 114, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(489, 59, 115, '2024-02-09 16:44:12', '2024-02-09 16:44:12'),
(490, 59, 116, '2024-02-09 16:44:13', '2024-02-09 16:44:13'),
(491, 59, 117, '2024-02-09 16:44:13', '2024-02-09 16:44:13'),
(492, 60, 108, '2024-02-09 16:52:33', '2024-02-09 16:52:33'),
(493, 60, 109, '2024-02-09 16:52:33', '2024-02-09 16:52:33'),
(494, 60, 110, '2024-02-09 16:52:33', '2024-02-09 16:52:33'),
(495, 60, 111, '2024-02-09 16:52:33', '2024-02-09 16:52:33'),
(496, 60, 112, '2024-02-09 16:52:34', '2024-02-09 16:52:34'),
(497, 60, 113, '2024-02-09 16:52:34', '2024-02-09 16:52:34'),
(498, 60, 114, '2024-02-09 16:52:34', '2024-02-09 16:52:34'),
(499, 60, 115, '2024-02-09 16:52:34', '2024-02-09 16:52:34'),
(500, 60, 116, '2024-02-09 16:52:34', '2024-02-09 16:52:34'),
(501, 60, 117, '2024-02-09 16:52:34', '2024-02-09 16:52:34'),
(502, 61, 108, '2024-02-09 23:30:53', '2024-02-09 23:30:53'),
(503, 61, 109, '2024-02-09 23:30:53', '2024-02-09 23:30:53'),
(504, 61, 110, '2024-02-09 23:30:53', '2024-02-09 23:30:53'),
(505, 61, 111, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(506, 61, 112, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(507, 61, 113, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(508, 61, 114, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(509, 61, 115, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(510, 61, 116, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(511, 61, 117, '2024-02-09 23:30:54', '2024-02-09 23:30:54'),
(512, 62, 108, '2024-02-10 15:32:07', '2024-02-10 15:32:07'),
(513, 62, 109, '2024-02-10 15:32:07', '2024-02-10 15:32:07'),
(514, 62, 110, '2024-02-10 15:32:07', '2024-02-10 15:32:07'),
(515, 62, 111, '2024-02-10 15:32:08', '2024-02-10 15:32:08'),
(516, 62, 112, '2024-02-10 15:32:08', '2024-02-10 15:32:08'),
(517, 62, 113, '2024-02-10 15:32:08', '2024-02-10 15:32:08'),
(518, 62, 114, '2024-02-10 15:32:08', '2024-02-10 15:32:08'),
(519, 62, 115, '2024-02-10 15:32:08', '2024-02-10 15:32:08'),
(520, 62, 116, '2024-02-10 15:32:09', '2024-02-10 15:32:09'),
(521, 62, 117, '2024-02-10 15:32:09', '2024-02-10 15:32:09'),
(522, 63, 108, '2024-02-10 15:39:16', '2024-02-10 15:39:16'),
(523, 63, 109, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(524, 63, 110, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(525, 63, 111, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(526, 63, 112, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(527, 63, 113, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(528, 63, 114, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(529, 63, 115, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(530, 63, 116, '2024-02-10 15:39:17', '2024-02-10 15:39:17'),
(531, 63, 117, '2024-02-10 15:39:18', '2024-02-10 15:39:18'),
(532, 64, 108, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(533, 64, 109, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(534, 64, 110, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(535, 64, 111, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(536, 64, 112, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(537, 64, 113, '2024-02-10 15:43:58', '2024-02-10 15:43:58'),
(538, 64, 114, '2024-02-10 15:43:59', '2024-02-10 15:43:59'),
(539, 64, 115, '2024-02-10 15:43:59', '2024-02-10 15:43:59'),
(540, 64, 116, '2024-02-10 15:43:59', '2024-02-10 15:43:59'),
(541, 64, 117, '2024-02-10 15:43:59', '2024-02-10 15:43:59'),
(542, 65, 108, '2024-02-10 15:56:28', '2024-02-10 15:56:28'),
(543, 65, 109, '2024-02-10 15:56:28', '2024-02-10 15:56:28'),
(544, 65, 110, '2024-02-10 15:56:28', '2024-02-10 15:56:28'),
(545, 65, 111, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(546, 65, 112, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(547, 65, 113, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(548, 65, 114, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(549, 65, 115, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(550, 65, 116, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(551, 65, 117, '2024-02-10 15:56:29', '2024-02-10 15:56:29'),
(552, 66, 108, '2024-02-10 16:03:39', '2024-02-10 16:03:39'),
(553, 66, 109, '2024-02-10 16:03:39', '2024-02-10 16:03:39'),
(554, 66, 110, '2024-02-10 16:03:39', '2024-02-10 16:03:39'),
(555, 66, 111, '2024-02-10 16:03:39', '2024-02-10 16:03:39'),
(556, 66, 112, '2024-02-10 16:03:40', '2024-02-10 16:03:40'),
(557, 66, 113, '2024-02-10 16:03:40', '2024-02-10 16:03:40'),
(558, 66, 114, '2024-02-10 16:03:40', '2024-02-10 16:03:40'),
(559, 66, 115, '2024-02-10 16:03:40', '2024-02-10 16:03:40'),
(560, 66, 116, '2024-02-10 16:03:40', '2024-02-10 16:03:40'),
(561, 66, 117, '2024-02-10 16:03:40', '2024-02-10 16:03:40'),
(562, 67, 108, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(563, 67, 109, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(564, 67, 110, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(565, 67, 111, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(566, 67, 112, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(567, 67, 113, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(568, 67, 114, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(569, 67, 115, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(570, 67, 116, '2024-02-10 16:11:07', '2024-02-10 16:11:07'),
(571, 67, 117, '2024-02-10 16:11:08', '2024-02-10 16:11:08'),
(572, 68, 108, '2024-02-10 16:16:14', '2024-02-10 16:16:14'),
(573, 68, 109, '2024-02-10 16:16:14', '2024-02-10 16:16:14'),
(574, 68, 110, '2024-02-10 16:16:14', '2024-02-10 16:16:14'),
(575, 68, 111, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(576, 68, 112, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(577, 68, 113, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(578, 68, 114, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(579, 68, 115, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(580, 68, 116, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(581, 68, 117, '2024-02-10 16:16:15', '2024-02-10 16:16:15'),
(582, 69, 108, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(583, 69, 109, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(584, 69, 110, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(585, 69, 111, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(586, 69, 112, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(587, 69, 113, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(588, 69, 114, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(589, 69, 115, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(590, 69, 116, '2024-02-10 16:31:14', '2024-02-10 16:31:14'),
(591, 69, 117, '2024-02-10 16:31:15', '2024-02-10 16:31:15'),
(592, 70, 108, '2024-02-10 16:37:17', '2024-02-10 16:37:17'),
(593, 70, 109, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(594, 70, 110, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(595, 70, 111, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(596, 70, 112, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(597, 70, 113, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(598, 70, 114, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(599, 70, 115, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(600, 70, 116, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(601, 70, 117, '2024-02-10 16:37:18', '2024-02-10 16:37:18'),
(602, 71, 108, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(603, 71, 109, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(604, 71, 110, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(605, 71, 111, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(606, 71, 112, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(607, 71, 113, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(608, 71, 114, '2024-02-10 16:42:56', '2024-02-10 16:42:56'),
(609, 71, 115, '2024-02-10 16:42:57', '2024-02-10 16:42:57'),
(610, 71, 116, '2024-02-10 16:42:57', '2024-02-10 16:42:57'),
(611, 71, 117, '2024-02-10 16:42:57', '2024-02-10 16:42:57'),
(612, 72, 108, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(613, 72, 109, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(614, 72, 110, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(615, 72, 111, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(616, 72, 112, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(617, 72, 113, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(618, 72, 114, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(619, 72, 115, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(620, 72, 116, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(621, 72, 117, '2024-02-10 16:48:50', '2024-02-10 16:48:50'),
(622, 73, 108, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(623, 73, 109, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(624, 73, 110, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(625, 73, 111, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(626, 73, 112, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(627, 73, 113, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(628, 73, 114, '2024-02-10 16:57:34', '2024-02-10 16:57:34'),
(629, 73, 115, '2024-02-10 16:57:35', '2024-02-10 16:57:35'),
(630, 73, 116, '2024-02-10 16:57:35', '2024-02-10 16:57:35'),
(631, 73, 117, '2024-02-10 16:57:35', '2024-02-10 16:57:35'),
(632, 74, 108, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(633, 74, 109, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(634, 74, 110, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(635, 74, 111, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(636, 74, 112, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(637, 74, 113, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(638, 74, 114, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(639, 74, 115, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(640, 74, 116, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(641, 74, 117, '2024-02-10 17:18:27', '2024-02-10 17:18:27'),
(642, 75, 108, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(643, 75, 109, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(644, 75, 110, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(645, 75, 111, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(646, 75, 112, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(647, 75, 113, '2024-02-10 17:27:00', '2024-02-10 17:27:00'),
(648, 75, 114, '2024-02-10 17:27:01', '2024-02-10 17:27:01'),
(649, 75, 115, '2024-02-10 17:27:01', '2024-02-10 17:27:01'),
(650, 75, 116, '2024-02-10 17:27:01', '2024-02-10 17:27:01'),
(651, 75, 117, '2024-02-10 17:27:01', '2024-02-10 17:27:01'),
(652, 76, 118, '2024-02-10 17:32:40', '2024-02-10 17:32:40'),
(653, 76, 119, '2024-02-10 17:32:40', '2024-02-10 17:32:40'),
(654, 76, 120, '2024-02-10 17:32:40', '2024-02-10 17:32:40'),
(655, 76, 121, '2024-02-10 17:32:40', '2024-02-10 17:32:40'),
(656, 76, 122, '2024-02-10 17:32:40', '2024-02-10 17:32:40'),
(657, 76, 123, '2024-02-10 17:32:41', '2024-02-10 17:32:41'),
(658, 76, 124, '2024-02-10 17:32:41', '2024-02-10 17:32:41'),
(659, 77, 108, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(660, 77, 109, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(661, 77, 110, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(662, 77, 111, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(663, 77, 112, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(664, 77, 113, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(665, 77, 114, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(666, 77, 115, '2024-02-10 17:40:00', '2024-02-10 17:40:00'),
(667, 77, 116, '2024-02-10 17:40:01', '2024-02-10 17:40:01'),
(668, 77, 117, '2024-02-10 17:40:01', '2024-02-10 17:40:01'),
(669, 78, 108, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(670, 78, 109, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(671, 78, 110, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(672, 78, 111, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(673, 78, 112, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(674, 78, 113, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(675, 78, 114, '2024-02-12 09:34:08', '2024-02-12 09:34:08'),
(676, 78, 115, '2024-02-12 09:34:09', '2024-02-12 09:34:09'),
(677, 78, 116, '2024-02-12 09:34:09', '2024-02-12 09:34:09'),
(678, 78, 117, '2024-02-12 09:34:09', '2024-02-12 09:34:09'),
(679, 79, 108, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(680, 79, 109, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(681, 79, 110, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(682, 79, 111, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(683, 79, 112, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(684, 79, 113, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(685, 79, 114, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(686, 79, 115, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(687, 79, 116, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(688, 79, 117, '2024-02-12 09:42:37', '2024-02-12 09:42:37'),
(689, 80, 108, '2024-02-12 10:11:45', '2024-02-12 10:11:45'),
(690, 80, 109, '2024-02-12 10:11:45', '2024-02-12 10:11:45'),
(691, 80, 110, '2024-02-12 10:11:45', '2024-02-12 10:11:45'),
(692, 80, 111, '2024-02-12 10:11:45', '2024-02-12 10:11:45'),
(693, 80, 112, '2024-02-12 10:11:46', '2024-02-12 10:11:46'),
(694, 80, 113, '2024-02-12 10:11:46', '2024-02-12 10:11:46'),
(695, 80, 114, '2024-02-12 10:11:46', '2024-02-12 10:11:46'),
(696, 80, 115, '2024-02-12 10:11:46', '2024-02-12 10:11:46'),
(697, 80, 116, '2024-02-12 10:11:46', '2024-02-12 10:11:46'),
(698, 80, 117, '2024-02-12 10:11:46', '2024-02-12 10:11:46'),
(699, 81, 143, '2024-02-12 10:27:08', '2024-02-12 10:27:08'),
(700, 81, 144, '2024-02-12 10:27:08', '2024-02-12 10:27:08'),
(701, 81, 145, '2024-02-12 10:27:08', '2024-02-12 10:27:08'),
(702, 81, 146, '2024-02-12 10:27:09', '2024-02-12 10:27:09'),
(703, 81, 147, '2024-02-12 10:27:09', '2024-02-12 10:27:09'),
(704, 82, 108, '2024-02-12 10:48:38', '2024-02-12 10:48:38'),
(705, 82, 109, '2024-02-12 10:48:38', '2024-02-12 10:48:38'),
(706, 82, 110, '2024-02-12 10:48:38', '2024-02-12 10:48:38'),
(707, 82, 111, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(708, 82, 112, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(709, 82, 113, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(710, 82, 114, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(711, 82, 115, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(712, 82, 116, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(713, 82, 117, '2024-02-12 10:48:39', '2024-02-12 10:48:39'),
(714, 83, 108, '2024-02-12 11:02:01', '2024-02-12 11:02:01'),
(715, 83, 109, '2024-02-12 11:02:01', '2024-02-12 11:02:01'),
(716, 83, 110, '2024-02-12 11:02:01', '2024-02-12 11:02:01'),
(717, 83, 111, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(718, 83, 112, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(719, 83, 113, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(720, 83, 114, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(721, 83, 115, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(722, 83, 116, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(723, 83, 117, '2024-02-12 11:02:02', '2024-02-12 11:02:02'),
(724, 84, 108, '2024-02-12 11:10:51', '2024-02-12 11:10:51'),
(725, 84, 109, '2024-02-12 11:10:51', '2024-02-12 11:10:51'),
(726, 84, 110, '2024-02-12 11:10:51', '2024-02-12 11:10:51'),
(727, 84, 111, '2024-02-12 11:10:51', '2024-02-12 11:10:51'),
(728, 84, 112, '2024-02-12 11:10:51', '2024-02-12 11:10:51'),
(729, 84, 113, '2024-02-12 11:10:52', '2024-02-12 11:10:52'),
(730, 84, 114, '2024-02-12 11:10:52', '2024-02-12 11:10:52'),
(731, 84, 115, '2024-02-12 11:10:52', '2024-02-12 11:10:52'),
(732, 84, 116, '2024-02-12 11:10:52', '2024-02-12 11:10:52'),
(733, 84, 117, '2024-02-12 11:10:52', '2024-02-12 11:10:52'),
(734, 85, 108, '2024-02-12 11:23:15', '2024-02-12 11:23:15'),
(735, 85, 109, '2024-02-12 11:23:15', '2024-02-12 11:23:15'),
(736, 85, 110, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(737, 85, 111, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(738, 85, 112, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(739, 85, 113, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(740, 85, 114, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(741, 85, 115, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(742, 85, 116, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(743, 85, 117, '2024-02-12 11:23:16', '2024-02-12 11:23:16'),
(744, 86, 108, '2024-02-12 11:45:13', '2024-02-12 11:45:13'),
(745, 86, 109, '2024-02-12 11:45:13', '2024-02-12 11:45:13'),
(746, 86, 110, '2024-02-12 11:45:13', '2024-02-12 11:45:13'),
(747, 86, 111, '2024-02-12 11:45:13', '2024-02-12 11:45:13'),
(748, 86, 112, '2024-02-12 11:45:14', '2024-02-12 11:45:14'),
(749, 86, 113, '2024-02-12 11:45:14', '2024-02-12 11:45:14'),
(750, 86, 114, '2024-02-12 11:45:14', '2024-02-12 11:45:14'),
(751, 86, 115, '2024-02-12 11:45:14', '2024-02-12 11:45:14'),
(752, 86, 116, '2024-02-12 11:45:14', '2024-02-12 11:45:14'),
(753, 86, 117, '2024-02-12 11:45:14', '2024-02-12 11:45:14'),
(754, 87, 108, '2024-02-12 11:56:55', '2024-02-12 11:56:55'),
(755, 87, 109, '2024-02-12 11:56:55', '2024-02-12 11:56:55'),
(756, 87, 110, '2024-02-12 11:56:55', '2024-02-12 11:56:55'),
(757, 87, 111, '2024-02-12 11:56:55', '2024-02-12 11:56:55'),
(758, 87, 112, '2024-02-12 11:56:55', '2024-02-12 11:56:55'),
(759, 87, 113, '2024-02-12 11:56:56', '2024-02-12 11:56:56'),
(760, 87, 114, '2024-02-12 11:56:56', '2024-02-12 11:56:56'),
(761, 87, 115, '2024-02-12 11:56:56', '2024-02-12 11:56:56'),
(762, 87, 116, '2024-02-12 11:56:56', '2024-02-12 11:56:56'),
(763, 87, 117, '2024-02-12 11:56:56', '2024-02-12 11:56:56'),
(764, 88, 108, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(765, 88, 109, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(766, 88, 110, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(767, 88, 111, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(768, 88, 112, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(769, 88, 113, '2024-02-12 12:05:06', '2024-02-12 12:05:06'),
(770, 88, 114, '2024-02-12 12:05:07', '2024-02-12 12:05:07'),
(771, 88, 115, '2024-02-12 12:05:07', '2024-02-12 12:05:07'),
(772, 88, 116, '2024-02-12 12:05:07', '2024-02-12 12:05:07'),
(773, 88, 117, '2024-02-12 12:05:07', '2024-02-12 12:05:07'),
(774, 89, 108, '2024-02-12 12:17:11', '2024-02-12 12:17:11'),
(775, 89, 109, '2024-02-12 12:17:11', '2024-02-12 12:17:11'),
(776, 89, 110, '2024-02-12 12:17:11', '2024-02-12 12:17:11'),
(777, 89, 111, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(778, 89, 112, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(779, 89, 113, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(780, 89, 114, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(781, 89, 115, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(782, 89, 116, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(783, 89, 117, '2024-02-12 12:17:12', '2024-02-12 12:17:12'),
(784, 90, 108, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(785, 90, 109, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(786, 90, 110, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(787, 90, 111, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(788, 90, 112, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(789, 90, 113, '2024-02-12 12:46:12', '2024-02-12 12:46:12'),
(790, 90, 114, '2024-02-12 12:46:13', '2024-02-12 12:46:13'),
(791, 90, 115, '2024-02-12 12:46:13', '2024-02-12 12:46:13'),
(792, 90, 116, '2024-02-12 12:46:13', '2024-02-12 12:46:13'),
(793, 90, 117, '2024-02-12 12:46:13', '2024-02-12 12:46:13'),
(794, 91, 108, '2024-02-12 12:53:38', '2024-02-12 12:53:38'),
(795, 91, 109, '2024-02-12 12:53:38', '2024-02-12 12:53:38'),
(796, 91, 110, '2024-02-12 12:53:38', '2024-02-12 12:53:38'),
(797, 91, 111, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(798, 91, 112, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(799, 91, 113, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(800, 91, 114, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(801, 91, 115, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(802, 91, 116, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(803, 91, 117, '2024-02-12 12:53:39', '2024-02-12 12:53:39'),
(804, 92, 108, '2024-02-12 13:00:43', '2024-02-12 13:00:43'),
(805, 92, 109, '2024-02-12 13:00:43', '2024-02-12 13:00:43'),
(806, 92, 110, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(807, 92, 111, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(808, 92, 112, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(809, 92, 113, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(810, 92, 114, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(811, 92, 115, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(812, 92, 116, '2024-02-12 13:00:44', '2024-02-12 13:00:44'),
(813, 92, 117, '2024-02-12 13:00:45', '2024-02-12 13:00:45'),
(814, 93, 108, '2024-02-12 13:08:39', '2024-02-12 13:08:39'),
(815, 93, 109, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(816, 93, 110, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(817, 93, 111, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(818, 93, 112, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(819, 93, 113, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(820, 93, 114, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(821, 93, 115, '2024-02-12 13:08:40', '2024-02-12 13:08:40'),
(822, 93, 116, '2024-02-12 13:08:41', '2024-02-12 13:08:41'),
(823, 93, 117, '2024-02-12 13:08:41', '2024-02-12 13:08:41'),
(824, 94, 108, '2024-02-12 13:15:13', '2024-02-12 13:15:13'),
(825, 94, 109, '2024-02-12 13:15:13', '2024-02-12 13:15:13'),
(826, 94, 110, '2024-02-12 13:15:13', '2024-02-12 13:15:13'),
(827, 94, 111, '2024-02-12 13:15:13', '2024-02-12 13:15:13'),
(828, 94, 112, '2024-02-12 13:15:13', '2024-02-12 13:15:13'),
(829, 94, 113, '2024-02-12 13:15:13', '2024-02-12 13:15:13'),
(830, 94, 114, '2024-02-12 13:15:14', '2024-02-12 13:15:14'),
(831, 94, 115, '2024-02-12 13:15:14', '2024-02-12 13:15:14'),
(832, 94, 116, '2024-02-12 13:15:14', '2024-02-12 13:15:14'),
(833, 94, 117, '2024-02-12 13:15:14', '2024-02-12 13:15:14'),
(834, 95, 108, '2024-02-12 13:21:31', '2024-02-12 13:21:31'),
(835, 95, 109, '2024-02-12 13:21:31', '2024-02-12 13:21:31'),
(836, 95, 110, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(837, 95, 111, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(838, 95, 112, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(839, 95, 113, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(840, 95, 114, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(841, 95, 115, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(842, 95, 116, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(843, 95, 117, '2024-02-12 13:21:32', '2024-02-12 13:21:32'),
(844, 96, 108, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(845, 96, 109, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(846, 96, 110, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(847, 96, 111, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(848, 96, 112, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(849, 96, 113, '2024-02-12 13:26:14', '2024-02-12 13:26:14'),
(850, 96, 114, '2024-02-12 13:26:15', '2024-02-12 13:26:15'),
(851, 96, 115, '2024-02-12 13:26:15', '2024-02-12 13:26:15'),
(852, 96, 116, '2024-02-12 13:26:15', '2024-02-12 13:26:15'),
(853, 96, 117, '2024-02-12 13:26:15', '2024-02-12 13:26:15'),
(854, 97, 108, '2024-02-12 13:36:42', '2024-02-12 13:36:42'),
(855, 97, 109, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(856, 97, 110, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(857, 97, 111, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(858, 97, 112, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(859, 97, 113, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(860, 97, 114, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(861, 97, 115, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(862, 97, 116, '2024-02-12 13:36:43', '2024-02-12 13:36:43'),
(863, 97, 117, '2024-02-12 13:36:44', '2024-02-12 13:36:44'),
(864, 98, 108, '2024-02-12 13:47:27', '2024-02-12 13:47:27'),
(865, 98, 109, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(866, 98, 110, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(867, 98, 111, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(868, 98, 112, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(869, 98, 113, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(870, 98, 114, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(871, 98, 115, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(872, 98, 116, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(873, 98, 117, '2024-02-12 13:47:28', '2024-02-12 13:47:28'),
(874, 99, 108, '2024-02-12 14:17:56', '2024-02-12 14:17:56'),
(875, 99, 109, '2024-02-12 14:17:56', '2024-02-12 14:17:56'),
(876, 99, 110, '2024-02-12 14:17:56', '2024-02-12 14:17:56'),
(877, 99, 111, '2024-02-12 14:17:56', '2024-02-12 14:17:56'),
(878, 99, 112, '2024-02-12 14:17:56', '2024-02-12 14:17:56'),
(879, 99, 113, '2024-02-12 14:17:57', '2024-02-12 14:17:57'),
(880, 99, 114, '2024-02-12 14:17:57', '2024-02-12 14:17:57'),
(881, 99, 115, '2024-02-12 14:17:57', '2024-02-12 14:17:57'),
(882, 99, 116, '2024-02-12 14:17:57', '2024-02-12 14:17:57'),
(883, 99, 117, '2024-02-12 14:17:57', '2024-02-12 14:17:57'),
(884, 100, 143, '2024-02-12 14:23:17', '2024-02-12 14:23:17'),
(885, 100, 144, '2024-02-12 14:23:17', '2024-02-12 14:23:17'),
(886, 100, 145, '2024-02-12 14:23:17', '2024-02-12 14:23:17'),
(887, 100, 146, '2024-02-12 14:23:17', '2024-02-12 14:23:17'),
(888, 100, 147, '2024-02-12 14:23:18', '2024-02-12 14:23:18'),
(889, 101, 108, '2024-02-12 14:29:45', '2024-02-12 14:29:45'),
(890, 101, 109, '2024-02-12 14:29:45', '2024-02-12 14:29:45'),
(891, 101, 110, '2024-02-12 14:29:45', '2024-02-12 14:29:45'),
(892, 101, 111, '2024-02-12 14:29:46', '2024-02-12 14:29:46'),
(893, 101, 112, '2024-02-12 14:29:46', '2024-02-12 14:29:46'),
(894, 101, 113, '2024-02-12 14:29:46', '2024-02-12 14:29:46');
INSERT INTO `test_program_indicators` (`id`, `test_program_id`, `indicator_id`, `created_at`, `updated_at`) VALUES
(895, 101, 114, '2024-02-12 14:29:46', '2024-02-12 14:29:46'),
(896, 101, 115, '2024-02-12 14:29:46', '2024-02-12 14:29:46'),
(897, 101, 116, '2024-02-12 14:29:46', '2024-02-12 14:29:46'),
(898, 101, 117, '2024-02-12 14:29:46', '2024-02-12 14:29:46'),
(899, 102, 143, '2024-02-12 14:34:18', '2024-02-12 14:34:18'),
(900, 102, 144, '2024-02-12 14:34:18', '2024-02-12 14:34:18'),
(901, 102, 145, '2024-02-12 14:34:18', '2024-02-12 14:34:18'),
(902, 102, 146, '2024-02-12 14:34:18', '2024-02-12 14:34:18'),
(903, 102, 147, '2024-02-12 14:34:18', '2024-02-12 14:34:18'),
(904, 103, 108, '2024-02-12 14:48:35', '2024-02-12 14:48:35'),
(905, 103, 109, '2024-02-12 14:48:35', '2024-02-12 14:48:35'),
(906, 103, 110, '2024-02-12 14:48:35', '2024-02-12 14:48:35'),
(907, 103, 111, '2024-02-12 14:48:35', '2024-02-12 14:48:35'),
(908, 103, 112, '2024-02-12 14:48:35', '2024-02-12 14:48:35'),
(909, 103, 113, '2024-02-12 14:48:36', '2024-02-12 14:48:36'),
(910, 103, 114, '2024-02-12 14:48:36', '2024-02-12 14:48:36'),
(911, 103, 115, '2024-02-12 14:48:36', '2024-02-12 14:48:36'),
(912, 103, 116, '2024-02-12 14:48:36', '2024-02-12 14:48:36'),
(913, 103, 117, '2024-02-12 14:48:36', '2024-02-12 14:48:36'),
(914, 104, 108, '2024-02-12 15:00:07', '2024-02-12 15:00:07'),
(915, 104, 109, '2024-02-12 15:00:07', '2024-02-12 15:00:07'),
(916, 104, 110, '2024-02-12 15:00:07', '2024-02-12 15:00:07'),
(917, 104, 111, '2024-02-12 15:00:07', '2024-02-12 15:00:07'),
(918, 104, 112, '2024-02-12 15:00:08', '2024-02-12 15:00:08'),
(919, 104, 113, '2024-02-12 15:00:08', '2024-02-12 15:00:08'),
(920, 104, 114, '2024-02-12 15:00:08', '2024-02-12 15:00:08'),
(921, 104, 115, '2024-02-12 15:00:08', '2024-02-12 15:00:08'),
(922, 104, 116, '2024-02-12 15:00:08', '2024-02-12 15:00:08'),
(923, 104, 117, '2024-02-12 15:00:08', '2024-02-12 15:00:08'),
(924, 105, 108, '2024-02-12 15:11:14', '2024-02-12 15:11:14'),
(925, 105, 109, '2024-02-12 15:11:14', '2024-02-12 15:11:14'),
(926, 105, 110, '2024-02-12 15:11:14', '2024-02-12 15:11:14'),
(927, 105, 111, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(928, 105, 112, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(929, 105, 113, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(930, 105, 114, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(931, 105, 115, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(932, 105, 116, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(933, 105, 117, '2024-02-12 15:11:15', '2024-02-12 15:11:15'),
(934, 106, 108, '2024-02-13 13:27:34', '2024-02-13 13:27:34'),
(935, 106, 109, '2024-02-13 13:27:34', '2024-02-13 13:27:34'),
(936, 106, 110, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(937, 106, 111, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(938, 106, 112, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(939, 106, 113, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(940, 106, 114, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(941, 106, 115, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(942, 106, 116, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(943, 106, 117, '2024-02-13 13:27:35', '2024-02-13 13:27:35'),
(944, 107, 108, '2024-02-13 13:39:36', '2024-02-13 13:39:36'),
(945, 107, 109, '2024-02-13 13:39:36', '2024-02-13 13:39:36'),
(946, 107, 110, '2024-02-13 13:39:37', '2024-02-13 13:39:37'),
(947, 107, 111, '2024-02-13 13:39:37', '2024-02-13 13:39:37'),
(948, 107, 112, '2024-02-13 13:39:37', '2024-02-13 13:39:37'),
(949, 107, 113, '2024-02-13 13:39:37', '2024-02-13 13:39:37'),
(950, 107, 114, '2024-02-13 13:39:37', '2024-02-13 13:39:37'),
(951, 107, 115, '2024-02-13 13:39:37', '2024-02-13 13:39:37'),
(952, 107, 116, '2024-02-13 13:39:38', '2024-02-13 13:39:38'),
(953, 107, 117, '2024-02-13 13:39:38', '2024-02-13 13:39:38'),
(954, 108, 108, '2024-02-13 13:46:08', '2024-02-13 13:46:08'),
(955, 108, 109, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(956, 108, 110, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(957, 108, 111, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(958, 108, 112, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(959, 108, 113, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(960, 108, 114, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(961, 108, 115, '2024-02-13 13:46:09', '2024-02-13 13:46:09'),
(962, 108, 116, '2024-02-13 13:46:10', '2024-02-13 13:46:10'),
(963, 108, 117, '2024-02-13 13:46:10', '2024-02-13 13:46:10'),
(964, 109, 108, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(965, 109, 109, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(966, 109, 110, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(967, 109, 111, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(968, 109, 112, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(969, 109, 113, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(970, 109, 114, '2024-02-13 13:59:32', '2024-02-13 13:59:32'),
(971, 109, 115, '2024-02-13 13:59:33', '2024-02-13 13:59:33'),
(972, 109, 116, '2024-02-13 13:59:33', '2024-02-13 13:59:33'),
(973, 109, 117, '2024-02-13 13:59:33', '2024-02-13 13:59:33'),
(974, 110, 108, '2024-02-13 14:21:15', '2024-02-13 14:21:15'),
(975, 110, 109, '2024-02-13 14:21:15', '2024-02-13 14:21:15'),
(976, 110, 110, '2024-02-13 14:21:15', '2024-02-13 14:21:15'),
(977, 110, 111, '2024-02-13 14:21:15', '2024-02-13 14:21:15'),
(978, 110, 112, '2024-02-13 14:21:16', '2024-02-13 14:21:16'),
(979, 110, 113, '2024-02-13 14:21:16', '2024-02-13 14:21:16'),
(980, 110, 114, '2024-02-13 14:21:16', '2024-02-13 14:21:16'),
(981, 110, 115, '2024-02-13 14:21:16', '2024-02-13 14:21:16'),
(982, 110, 116, '2024-02-13 14:21:16', '2024-02-13 14:21:16'),
(983, 110, 117, '2024-02-13 14:21:16', '2024-02-13 14:21:16'),
(984, 111, 108, '2024-02-13 15:07:11', '2024-02-13 15:07:11'),
(985, 111, 109, '2024-02-13 15:07:11', '2024-02-13 15:07:11'),
(986, 111, 110, '2024-02-13 15:07:11', '2024-02-13 15:07:11'),
(987, 111, 111, '2024-02-13 15:07:11', '2024-02-13 15:07:11'),
(988, 111, 112, '2024-02-13 15:07:11', '2024-02-13 15:07:11'),
(989, 111, 113, '2024-02-13 15:07:12', '2024-02-13 15:07:12'),
(990, 111, 114, '2024-02-13 15:07:12', '2024-02-13 15:07:12'),
(991, 111, 115, '2024-02-13 15:07:12', '2024-02-13 15:07:12'),
(992, 111, 116, '2024-02-13 15:07:12', '2024-02-13 15:07:12'),
(993, 111, 117, '2024-02-13 15:07:12', '2024-02-13 15:07:12'),
(994, 112, 108, '2024-02-13 15:16:23', '2024-02-13 15:16:23'),
(995, 112, 109, '2024-02-13 15:16:23', '2024-02-13 15:16:23'),
(996, 112, 110, '2024-02-13 15:16:23', '2024-02-13 15:16:23'),
(997, 112, 111, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(998, 112, 112, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(999, 112, 113, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(1000, 112, 114, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(1001, 112, 115, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(1002, 112, 116, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(1003, 112, 117, '2024-02-13 15:16:24', '2024-02-13 15:16:24'),
(1004, 113, 108, '2024-02-13 15:23:50', '2024-02-13 15:23:50'),
(1005, 113, 109, '2024-02-13 15:23:50', '2024-02-13 15:23:50'),
(1006, 113, 110, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1007, 113, 111, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1008, 113, 112, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1009, 113, 113, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1010, 113, 114, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1011, 113, 115, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1012, 113, 116, '2024-02-13 15:23:51', '2024-02-13 15:23:51'),
(1013, 113, 117, '2024-02-13 15:23:52', '2024-02-13 15:23:52'),
(1014, 114, 108, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(1015, 114, 109, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(1016, 114, 110, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(1017, 114, 111, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(1018, 114, 112, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(1019, 114, 113, '2024-02-13 17:26:07', '2024-02-13 17:26:07'),
(1020, 114, 114, '2024-02-13 17:26:08', '2024-02-13 17:26:08'),
(1021, 114, 115, '2024-02-13 17:26:08', '2024-02-13 17:26:08'),
(1022, 114, 116, '2024-02-13 17:26:08', '2024-02-13 17:26:08'),
(1023, 114, 117, '2024-02-13 17:26:08', '2024-02-13 17:26:08'),
(1024, 115, 108, '2024-02-13 17:37:44', '2024-02-13 17:37:44'),
(1025, 115, 109, '2024-02-13 17:37:44', '2024-02-13 17:37:44'),
(1026, 115, 110, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1027, 115, 111, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1028, 115, 112, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1029, 115, 113, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1030, 115, 114, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1031, 115, 115, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1032, 115, 116, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1033, 115, 117, '2024-02-13 17:37:45', '2024-02-13 17:37:45'),
(1034, 116, 108, '2024-02-13 17:46:11', '2024-02-13 17:46:11'),
(1035, 116, 109, '2024-02-13 17:46:11', '2024-02-13 17:46:11'),
(1036, 116, 110, '2024-02-13 17:46:11', '2024-02-13 17:46:11'),
(1037, 116, 111, '2024-02-13 17:46:11', '2024-02-13 17:46:11'),
(1038, 116, 112, '2024-02-13 17:46:11', '2024-02-13 17:46:11'),
(1039, 116, 113, '2024-02-13 17:46:11', '2024-02-13 17:46:11'),
(1040, 116, 114, '2024-02-13 17:46:12', '2024-02-13 17:46:12'),
(1041, 116, 115, '2024-02-13 17:46:12', '2024-02-13 17:46:12'),
(1042, 116, 116, '2024-02-13 17:46:12', '2024-02-13 17:46:12'),
(1043, 116, 117, '2024-02-13 17:46:12', '2024-02-13 17:46:12'),
(1044, 117, 143, '2024-02-13 18:01:26', '2024-02-13 18:01:26'),
(1045, 117, 144, '2024-02-13 18:01:26', '2024-02-13 18:01:26'),
(1046, 117, 145, '2024-02-13 18:01:27', '2024-02-13 18:01:27'),
(1047, 117, 146, '2024-02-13 18:01:27', '2024-02-13 18:01:27'),
(1048, 117, 147, '2024-02-13 18:01:27', '2024-02-13 18:01:27'),
(1049, 118, 108, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1050, 118, 109, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1051, 118, 110, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1052, 118, 111, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1053, 118, 112, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1054, 118, 113, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1055, 118, 114, '2024-02-15 13:15:15', '2024-02-15 13:15:15'),
(1056, 118, 115, '2024-02-15 13:15:16', '2024-02-15 13:15:16'),
(1057, 118, 116, '2024-02-15 13:15:16', '2024-02-15 13:15:16'),
(1058, 118, 117, '2024-02-15 13:15:16', '2024-02-15 13:15:16'),
(1059, 119, 108, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1060, 119, 109, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1061, 119, 110, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1062, 119, 111, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1063, 119, 112, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1064, 119, 113, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1065, 119, 114, '2024-02-15 16:48:00', '2024-02-15 16:48:00'),
(1066, 119, 115, '2024-02-15 16:48:01', '2024-02-15 16:48:01'),
(1067, 119, 116, '2024-02-15 16:48:01', '2024-02-15 16:48:01'),
(1068, 119, 117, '2024-02-15 16:48:01', '2024-02-15 16:48:01'),
(1069, 120, 108, '2024-02-15 16:55:18', '2024-02-15 16:55:18'),
(1070, 120, 109, '2024-02-15 16:55:18', '2024-02-15 16:55:18'),
(1071, 120, 110, '2024-02-15 16:55:18', '2024-02-15 16:55:18'),
(1072, 120, 111, '2024-02-15 16:55:18', '2024-02-15 16:55:18'),
(1073, 120, 112, '2024-02-15 16:55:18', '2024-02-15 16:55:18'),
(1074, 120, 113, '2024-02-15 16:55:19', '2024-02-15 16:55:19'),
(1075, 120, 114, '2024-02-15 16:55:19', '2024-02-15 16:55:19'),
(1076, 120, 115, '2024-02-15 16:55:19', '2024-02-15 16:55:19'),
(1077, 120, 116, '2024-02-15 16:55:19', '2024-02-15 16:55:19'),
(1078, 120, 117, '2024-02-15 16:55:19', '2024-02-15 16:55:19'),
(1079, 121, 108, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1080, 121, 109, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1081, 121, 110, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1082, 121, 111, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1083, 121, 112, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1084, 121, 113, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1085, 121, 114, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1086, 121, 115, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1087, 121, 116, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1088, 121, 117, '2024-02-16 11:24:31', '2024-02-16 11:24:31'),
(1089, 122, 108, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1090, 122, 109, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1091, 122, 110, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1092, 122, 111, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1093, 122, 112, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1094, 122, 113, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1095, 122, 114, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1096, 122, 115, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1097, 122, 116, '2024-02-19 13:17:09', '2024-02-19 13:17:09'),
(1098, 122, 117, '2024-02-19 13:17:10', '2024-02-19 13:17:10'),
(1099, 123, 108, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1100, 123, 109, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1101, 123, 110, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1102, 123, 111, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1103, 123, 112, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1104, 123, 113, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1105, 123, 114, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1106, 123, 115, '2024-02-19 13:27:35', '2024-02-19 13:27:35'),
(1107, 123, 116, '2024-02-19 13:27:36', '2024-02-19 13:27:36'),
(1108, 123, 117, '2024-02-19 13:27:36', '2024-02-19 13:27:36'),
(1109, 124, 118, '2024-02-19 13:36:12', '2024-02-19 13:36:12'),
(1110, 124, 119, '2024-02-19 13:36:12', '2024-02-19 13:36:12'),
(1111, 124, 120, '2024-02-19 13:36:12', '2024-02-19 13:36:12'),
(1112, 124, 121, '2024-02-19 13:36:13', '2024-02-19 13:36:13'),
(1113, 124, 122, '2024-02-19 13:36:13', '2024-02-19 13:36:13'),
(1114, 124, 123, '2024-02-19 13:36:13', '2024-02-19 13:36:13'),
(1115, 124, 124, '2024-02-19 13:36:13', '2024-02-19 13:36:13'),
(1116, 125, 108, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1117, 125, 109, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1118, 125, 110, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1119, 125, 111, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1120, 125, 112, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1121, 125, 113, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1122, 125, 114, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1123, 125, 115, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1124, 125, 116, '2024-02-19 13:46:51', '2024-02-19 13:46:51'),
(1125, 125, 117, '2024-02-19 13:46:52', '2024-02-19 13:46:52'),
(1126, 126, 108, '2024-02-19 13:55:25', '2024-02-19 13:55:25'),
(1127, 126, 109, '2024-02-19 13:55:25', '2024-02-19 13:55:25'),
(1128, 126, 110, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1129, 126, 111, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1130, 126, 112, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1131, 126, 113, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1132, 126, 114, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1133, 126, 115, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1134, 126, 116, '2024-02-19 13:55:26', '2024-02-19 13:55:26'),
(1135, 126, 117, '2024-02-19 13:55:27', '2024-02-19 13:55:27'),
(1136, 127, 108, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1137, 127, 109, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1138, 127, 110, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1139, 127, 111, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1140, 127, 112, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1141, 127, 113, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1142, 127, 114, '2024-02-21 11:21:06', '2024-02-21 11:21:06'),
(1143, 127, 115, '2024-02-21 11:21:07', '2024-02-21 11:21:07'),
(1144, 127, 116, '2024-02-21 11:21:08', '2024-02-21 11:21:08'),
(1145, 127, 117, '2024-02-21 11:21:08', '2024-02-21 11:21:08'),
(1146, 128, 108, '2024-02-21 11:29:34', '2024-02-21 11:29:34'),
(1147, 128, 109, '2024-02-21 11:29:34', '2024-02-21 11:29:34'),
(1148, 128, 110, '2024-02-21 11:29:34', '2024-02-21 11:29:34'),
(1149, 128, 111, '2024-02-21 11:29:34', '2024-02-21 11:29:34'),
(1150, 128, 112, '2024-02-21 11:29:35', '2024-02-21 11:29:35'),
(1151, 128, 113, '2024-02-21 11:29:35', '2024-02-21 11:29:35'),
(1152, 128, 114, '2024-02-21 11:29:35', '2024-02-21 11:29:35'),
(1153, 128, 115, '2024-02-21 11:29:35', '2024-02-21 11:29:35'),
(1154, 128, 116, '2024-02-21 11:29:35', '2024-02-21 11:29:35'),
(1155, 128, 117, '2024-02-21 11:29:35', '2024-02-21 11:29:35'),
(1156, 129, 108, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1157, 129, 109, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1158, 129, 110, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1159, 129, 111, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1160, 129, 112, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1161, 129, 113, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1162, 129, 114, '2024-02-21 11:38:37', '2024-02-21 11:38:37'),
(1163, 129, 115, '2024-02-21 11:38:38', '2024-02-21 11:38:38'),
(1164, 129, 116, '2024-02-21 11:38:38', '2024-02-21 11:38:38'),
(1165, 129, 117, '2024-02-21 11:38:38', '2024-02-21 11:38:38'),
(1166, 130, 108, '2024-02-21 11:52:50', '2024-02-21 11:52:50'),
(1167, 130, 109, '2024-02-21 11:52:50', '2024-02-21 11:52:50'),
(1168, 130, 110, '2024-02-21 11:52:50', '2024-02-21 11:52:50'),
(1169, 130, 111, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1170, 130, 112, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1171, 130, 113, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1172, 130, 114, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1173, 130, 115, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1174, 130, 116, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1175, 130, 117, '2024-02-21 11:52:51', '2024-02-21 11:52:51'),
(1176, 131, 118, '2024-02-23 15:06:29', '2024-02-23 15:06:29'),
(1177, 131, 119, '2024-02-23 15:06:29', '2024-02-23 15:06:29'),
(1178, 131, 120, '2024-02-23 15:06:29', '2024-02-23 15:06:29'),
(1179, 131, 121, '2024-02-23 15:06:29', '2024-02-23 15:06:29'),
(1180, 131, 122, '2024-02-23 15:06:29', '2024-02-23 15:06:29'),
(1181, 131, 123, '2024-02-23 15:06:29', '2024-02-23 15:06:29'),
(1182, 131, 124, '2024-02-23 15:06:30', '2024-02-23 15:06:30'),
(1203, 133, 108, '2024-02-26 12:43:16', '2024-02-26 12:43:16'),
(1204, 133, 109, '2024-02-26 12:43:16', '2024-02-26 12:43:16'),
(1205, 133, 110, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1206, 133, 111, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1207, 133, 112, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1208, 133, 113, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1209, 133, 114, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1210, 133, 115, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1211, 133, 116, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1212, 133, 117, '2024-02-26 12:43:17', '2024-02-26 12:43:17'),
(1213, 134, 108, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1214, 134, 109, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1215, 134, 110, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1216, 134, 111, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1217, 134, 112, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1218, 134, 113, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1219, 134, 114, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1220, 134, 115, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1221, 134, 116, '2024-02-27 17:08:20', '2024-02-27 17:08:20'),
(1222, 134, 117, '2024-02-27 17:08:21', '2024-02-27 17:08:21'),
(1223, 135, 118, '2024-02-28 16:23:36', '2024-02-28 16:23:36'),
(1224, 135, 119, '2024-02-28 16:23:36', '2024-02-28 16:23:36'),
(1225, 135, 120, '2024-02-28 16:23:36', '2024-02-28 16:23:36'),
(1226, 135, 121, '2024-02-28 16:23:37', '2024-02-28 16:23:37'),
(1227, 135, 122, '2024-02-28 16:23:37', '2024-02-28 16:23:37'),
(1228, 135, 123, '2024-02-28 16:23:37', '2024-02-28 16:23:37'),
(1229, 135, 124, '2024-02-28 16:23:37', '2024-02-28 16:23:37'),
(1230, 136, 108, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1231, 136, 109, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1232, 136, 110, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1233, 136, 111, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1234, 136, 112, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1235, 136, 113, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1236, 136, 114, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1237, 136, 115, '2024-02-29 10:07:37', '2024-02-29 10:07:37'),
(1238, 136, 116, '2024-02-29 10:07:38', '2024-02-29 10:07:38'),
(1239, 136, 117, '2024-02-29 10:07:38', '2024-02-29 10:07:38'),
(1240, 137, 118, '2024-02-29 10:14:27', '2024-02-29 10:14:27'),
(1241, 137, 119, '2024-02-29 10:14:28', '2024-02-29 10:14:28'),
(1242, 137, 120, '2024-02-29 10:14:28', '2024-02-29 10:14:28'),
(1243, 137, 121, '2024-02-29 10:14:28', '2024-02-29 10:14:28'),
(1244, 137, 122, '2024-02-29 10:14:28', '2024-02-29 10:14:28'),
(1245, 137, 123, '2024-02-29 10:14:28', '2024-02-29 10:14:28'),
(1246, 137, 124, '2024-02-29 10:14:28', '2024-02-29 10:14:28'),
(1247, 138, 108, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1248, 138, 109, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1249, 138, 110, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1250, 138, 111, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1251, 138, 112, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1252, 138, 113, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1253, 138, 114, '2024-02-29 10:19:34', '2024-02-29 10:19:34'),
(1254, 138, 115, '2024-02-29 10:19:35', '2024-02-29 10:19:35'),
(1255, 138, 116, '2024-02-29 10:19:35', '2024-02-29 10:19:35'),
(1256, 138, 117, '2024-02-29 10:19:35', '2024-02-29 10:19:35'),
(1257, 139, 108, '2024-02-29 10:25:55', '2024-02-29 10:25:55'),
(1258, 139, 109, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1259, 139, 110, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1260, 139, 111, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1261, 139, 112, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1262, 139, 113, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1263, 139, 114, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1264, 139, 115, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1265, 139, 116, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1266, 139, 117, '2024-02-29 10:25:56', '2024-02-29 10:25:56'),
(1267, 140, 108, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1268, 140, 109, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1269, 140, 110, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1270, 140, 111, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1271, 140, 112, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1272, 140, 113, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1273, 140, 114, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1274, 140, 115, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1275, 140, 116, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1276, 140, 117, '2024-02-29 10:30:41', '2024-02-29 10:30:41'),
(1277, 141, 108, '2024-02-29 10:35:02', '2024-02-29 10:35:02'),
(1278, 141, 109, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1279, 141, 110, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1280, 141, 111, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1281, 141, 112, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1282, 141, 113, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1283, 141, 114, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1284, 141, 115, '2024-02-29 10:35:03', '2024-02-29 10:35:03'),
(1285, 141, 116, '2024-02-29 10:35:04', '2024-02-29 10:35:04'),
(1286, 141, 117, '2024-02-29 10:35:04', '2024-02-29 10:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT 4121,
  `branch_id` int(11) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(2) DEFAULT 1,
  `api_token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `display_name`, `role`, `state_id`, `branch_id`, `gender`, `birth_date`, `email`, `mobile_no`, `password`, `address`, `image`, `created_at`, `updated_at`, `status`, `api_token`) VALUES
(1, 'Doston', 'Olimov', NULL, 'admin', 4121, 1, 6, NULL, 'admin@uzteh', NULL, '$2y$10$.ZL3nQqdjq92wQcuy9wuqOvXBFWBbnA0sQAGOgAeTzS2mAQmk20h.', NULL, 'avtar.png', '2023-07-12 05:44:12', '2024-01-11 13:15:59', 1, NULL),
(2, 'Абдурашид', 'Туляганов', NULL, '54', 4121, NULL, 6, '1975-01-01', 'ict@agroxizmat.uz', '+998 94 671 33', '$2y$10$Z8zg.QcVMAD.RBDguWsUT.sht4RKx/z8HpJEQ.5O2ALQVfKA3c6Z6', '.', 'avtar.png', '2023-08-16 07:27:54', '2024-01-11 09:57:22', 1, NULL),
(3, 'Jahongir', 'Karimov', 'Djumabayevich', '54', 4121, NULL, 1, '1975-01-01', 'Karimov@teh.uz', '+998955555555', '$2y$10$7GLoeXDxO0O2wiGkXF43P.LbzDt8qLgsY4z16HGlWtgBpYJrMIy5i', '.', 'avtar.png', '2023-08-21 07:31:52', '2023-08-21 07:36:56', 1, NULL),
(4, 'Muzaffar', 'Rasulov', 'Rahimdjanovich', '54', 4121, NULL, 1, '1975-01-01', 'Rasulov@teh.uz', '+998991234567', '$2y$10$fwQ8OjS4xztcGfqyv1KWdukZ90rZV7SIkzObmJzBqNPDZey5TBJ2q', '.', 'avtar.png', '2023-08-21 07:35:53', '2023-08-21 07:36:25', 1, NULL),
(24, 'Alisher', 'Alimov', 'Abdullaevich', '55', 4121, NULL, 6, '1985-08-15', 'donsert@agroxizmat.uz', '+998935061950', '$2y$10$Hf18O8W352W8XoaKO0E4aeyp.M3vz5ThBNRqcgTqkbRUaBWZLhOG2', NULL, 'avtar.png', '2024-01-30 11:52:47', '2024-01-30 07:32:54', 1, NULL),
(25, 'Tatyana', 'Aparnikova', 'Vladimirovna', '50', 4121, NULL, 8, '1972-06-24', '112272@mail.ru', '+9989034880301', '$2y$10$RGMHteH5YhGeD5xtH6q3QOmbMbTP73USWvLBWzD0OFuh1xGxCOkue', NULL, 'avtar.png', '2024-01-30 11:57:47', '2024-01-30 06:59:52', 1, NULL),
(26, 'IKROM', 'PIRNAZAROV', 'YOQUBOVICH', '54', 4121, NULL, 1, '1975-01-01', 'ikromyakubovich@mail.ru', '+998946791579', '$2y$10$guLT2p/7ZgJw209uypBvgeoZlCWl8bjgXSTdrSnvwCWvqMOydQr2m', 'Tashkent', 'avtar.png', '2024-02-08 17:12:23', '2024-02-08 17:13:58', 1, NULL),
(27, 'Dostonbek', 'Dostonbek', 'Dostonbek', '55', 4121, NULL, 6, '2001-01-01', 'Dostonbek@gmail.com', '+998881161900', '$2y$10$Xlexh.Tpw5agSew79YlDcOIKl6Y3PCAr.m4h/Vtz.8JEBrDA5t7ri', NULL, 'avtar.png', '2024-02-28 16:50:02', '2024-02-28 16:50:02', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTdjNWZkYjFjOGE2ZjI3YTI2ZGEzNzBmM2M1MmFmMzg3YjBhNjQ0YmQ2ZDk4NDBlZTI1MjYwMjA5OTA3ZTRjM2MyY2FmNTRhY2QyNDNmN2EiLCJpYXQiOjE3MDkxMjEwMDIuMzA0NzE1LCJuYmYiOjE3MDkxMjEwMDIuMzA0NzMxLCJleHAiOjE3NDA3NDM0MDIuMTE0NDgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.carpiowmYqbE_pS--lV2HYP8GIpp9ZynMumqHGqWvyktu_BMGcnJlwtnyGXLdLjBteKDzi5IvFRuAxi2SsLkGG3ls89082-tWyIqq9n7NIaP6oX_XPcOY14aT5HQMPCKJTs5nqzRFfDFVT4chtUX4foONBxMrX2UWl1BX_NRQq_xWW6599p6A_m8MsEp-9zvsgvOsLI-1AZ_7Y8NOKzBOKvXjmIGvPhVdYl2jsUVHg1cigS-eLHW3x28CpeiVlUIYFc5dxt9TDfGFFRS9n4aeGxmNYTkg9vQ3JYdNYKSwifs0n68EvLYQDqBUwXNOVC0MKwbZqSdXgFYlMnfoEGGMjdi4S0L9hfB73BR-HmAi5WIcYYNtRpJorFLQlUQCy12Qvb3jyQf5NLq3-L9tcpL8V3Wa7hgxeQ5GzLiQXpXgmA1qx-bQn8x_KuyZgVoigSOdXlBa7XgaNZNnHBaegirjS2DHgXKBdT5Q13bSjf_Pt-3Ae2TXOKlqoC49TmCe4yMDd-JAWYZIqSbvI2sgjuU2mH7C73YVpe50GpgGxf9Fc3y9wk4i64eSJzScEou8FnM9uauuUPzGcLNuMzbV2xaEAO_5kvQbv6wgYwpeo3IgtbZnA8BwBqcRmqT91UEKGcWLexPbd5QrsqAlziqlRJgku0CXzdJITwyaiZekCIfxME');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `AKT`
--
ALTER TABLE `AKT`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `prepared_id` (`prepared_id`),
  ADD KEY `application_number_index` (`app_number`),
  ADD KEY `crop_data_id` (`crop_data_id`);

--
-- Indexes for table `app_file_foreign`
--
ALTER TABLE `app_file_foreign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_file_local`
--
ALTER TABLE `app_file_local`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_requirements`
--
ALTER TABLE `app_requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_status_changes`
--
ALTER TABLE `app_status_changes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_attachable_id_attachable_type_index` (`attachable_id`,`attachable_type`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_dev`
--
ALTER TABLE `certificate_dev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops_name`
--
ALTER TABLE `crops_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops_type`
--
ALTER TABLE `crops_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `crop_data`
--
ALTER TABLE `crop_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_production`
--
ALTER TABLE `crop_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decisions`
--
ALTER TABLE `decisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_id` (`app_id`);

--
-- Indexes for table `decision_makers`
--
ALTER TABLE `decision_makers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_results`
--
ALTER TABLE `final_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_program_id` (`test_program_id`);

--
-- Indexes for table `laboratories`
--
ALTER TABLE `laboratories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratory_numbers`
--
ALTER TABLE `laboratory_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_bayonnoma`
--
ALTER TABLE `lab_bayonnoma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`type_id`,`id`);


--
-- Indexes for table `nds`
--
ALTER TABLE `nds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_companies`
--
ALTER TABLE `organization_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prepared_companies`
--
ALTER TABLE `prepared_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `quality_indacators`
--
ALTER TABLE `quality_indacators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `required_amount`
--
ALTER TABLE `required_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertificates`
--
ALTER TABLE `sertificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_result_id` (`final_result_id`);

--
-- Indexes for table `tbl_accessrights`
--
ALTER TABLE `tbl_accessrights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_activities_created_at_action_type_action_index` (`created_at`,`action_type`,`action`),
  ADD KEY `vehicle_history_idx` (`action_type`);

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cities_state_id_index` (`state_id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_states_country_id_index` (`country_id`);

--
-- Indexes for table `test_programs`
--
ALTER TABLE `test_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_id` (`app_id`);

--
-- Indexes for table `test_programs_status_changes`
--
ALTER TABLE `test_programs_status_changes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_program_indicators`
--
ALTER TABLE `test_program_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_program_id` (`test_program_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=567;

--
-- AUTO_INCREMENT for table `AKT`
--
ALTER TABLE `AKT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `app_file_foreign`
--
ALTER TABLE `app_file_foreign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_file_local`
--
ALTER TABLE `app_file_local`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_requirements`
--
ALTER TABLE `app_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `app_status_changes`
--
ALTER TABLE `app_status_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_dev`
--
ALTER TABLE `certificate_dev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crops_name`
--
ALTER TABLE `crops_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `crops_type`
--
ALTER TABLE `crops_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `crop_data`
--
ALTER TABLE `crop_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `crop_production`
--
ALTER TABLE `crop_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1393;

--
-- AUTO_INCREMENT for table `decisions`
--
ALTER TABLE `decisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `decision_makers`
--
ALTER TABLE `decision_makers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_results`
--
ALTER TABLE `final_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `laboratories`
--
ALTER TABLE `laboratories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laboratory_numbers`
--
ALTER TABLE `laboratory_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_bayonnoma`
--
ALTER TABLE `lab_bayonnoma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `nds`
--
ALTER TABLE `nds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `organization_companies`
--
ALTER TABLE `organization_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `prepared_companies`
--
ALTER TABLE `prepared_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `quality_indacators`
--
ALTER TABLE `quality_indacators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `required_amount`
--
ALTER TABLE `required_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sertificates`
--
ALTER TABLE `sertificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `tbl_accessrights`
--
ALTER TABLE `tbl_accessrights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `tbl_activities`
--
ALTER TABLE `tbl_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48385;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_states`
--
ALTER TABLE `tbl_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4122;

--
-- AUTO_INCREMENT for table `test_programs`
--
ALTER TABLE `test_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `test_programs_status_changes`
--
ALTER TABLE `test_programs_status_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_program_indicators`
--
ALTER TABLE `test_program_indicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1287;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization_companies` (`id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`crop_data_id`) REFERENCES `crop_data` (`id`),
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`prepared_id`) REFERENCES `prepared_companies` (`id`),
  ADD CONSTRAINT `applications_ibfk_4` FOREIGN KEY (`crop_data_id`) REFERENCES `crop_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crops_type`
--
ALTER TABLE `crops_type`
  ADD CONSTRAINT `crops_type_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crops_name` (`id`);

--
-- Constraints for table `decisions`
--
ALTER TABLE `decisions`
  ADD CONSTRAINT `decisions_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `final_results`
--
ALTER TABLE `final_results`
  ADD CONSTRAINT `final_results_ibfk_1` FOREIGN KEY (`test_program_id`) REFERENCES `test_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prepared_companies`
--
ALTER TABLE `prepared_companies`
  ADD CONSTRAINT `prepared_companies_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `tbl_states` (`id`),
  ADD CONSTRAINT `prepared_companies_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `tbl_countries` (`id`);

--
-- Constraints for table `sertificates`
--
ALTER TABLE `sertificates`
  ADD CONSTRAINT `sertificates_ibfk_1` FOREIGN KEY (`final_result_id`) REFERENCES `final_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD CONSTRAINT `tbl_states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `tbl_countries` (`id`);

--
-- Constraints for table `test_programs`
--
ALTER TABLE `test_programs`
  ADD CONSTRAINT `test_programs_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_program_indicators`
--
ALTER TABLE `test_program_indicators`
  ADD CONSTRAINT `test_program_indicators_ibfk_1` FOREIGN KEY (`test_program_id`) REFERENCES `test_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
