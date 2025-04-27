-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 11:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `likes`, `created_at`) VALUES
(2, 2, 'خدا کنه دلار نره بالا', 10, '2025-04-03 12:01:40'),
(3, 2, 'ای روزگار', 5, '2025-04-03 12:08:51'),
(4, 7, 'تورم به شدت بالاست امید است مسئولین کاری کنند', 3, '2025-04-04 04:52:30'),
(7, 8, 'با تعرفه های اخیر دیگه نمیشه درست زندگی کرد', 8, '2025-04-05 19:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `agency` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `source`, `agency`, `title`, `content`, `image_url`) VALUES
(2, 'یوآف گالانت', 'صدای آمریکا ', 'بر سر 4 مسأله با نتاتیاهو اختلاف داشتم', 'گالانت در بیانیه‌ای که بامداد چهارشنبه قرائت کرد، گفت نتانیاهو به دلایل مخالفت او با قانونی که حریدی‌ها را به سربازی فرامی‌خواند، حمایت از آتش‌بس و تبادل اسرا با حماس و همچنین درخوسات برگزاری کمیته تحقیق درباره شکست در عملیات طوفان‌الاقصی برکنار کرده است.\r\n\r\nوزیر جنگ برکنار شده رژیم صهیونیستی گفت: من برای نتانیاهو روشن کردم که تمام زندگی من به امنیت اسرائیل اختصاص داشت. برکناری من به دلیل درخواست من برای فراخوانی تمام شهروندان برای سربازی بوده است. خدمت اجباری برای آینده ما ضروری است و ما نباید اجازه دهیم که قوانین تبعیض‌آمیز در کنست تصویب شوند.', 'uploads/1995635_149-1-470.jpg'),
(4, 'سردار حاجی زاده', 'ایسنا', 'کسی که در اتاق شیشه ای می نشیند سمت کسی سنگ پرانی نمی کند', 'ردار امیرعلی حاجی زاده در حاشیه مراسم نماز عید فطر اظهار کرد:\r\n آمریکایی‌ها در منطقه حداقل در اطراف ایران ۱۰ پایگاه دارند که بالغ بر ۵۰ هزار نفر نیرو دارد. این به معنای نشستن آنها در اتاق شیشه ای است. وی خاطرنشان کرد: کسی که در اتاق شیشه ای می نشیند سمت کسی سنگ پرانی نمی کند.', 'uploads/2123435_527.jpg'),
(6, 'حضرت آیت الله خامنه ای', 'صدای آمریکا ', 'مخالفت رهبر انقلاب با مذاکره ایران و آمریکا', 'علی واعظ، مدیر پروژه ایران در گروه بین‌المللی بحران، در شبکه‌های اجتماعی گفت که این اظهارات آیت الله خامنه‌ای ممکن است صرفاً در راستای مواضع عمومی پیشین ایشان باشد. به گفته واعظ، در سال ۲۰۱۱ نیز آیت الله خامنه‌ای به‌طور علنی با مذاکره با دولت اوباما مخالفت کرد، اما در عین حال به مذاکره‌کنندگان ایرانی اجازه داد تا به‌صورت محرمانه با مقامات آمریکایی در عمان دیدار کنند.\r\n\r\nدو نشریه معتبر نیویورک تایمز و تایم گزارش مفصلی درباره سخنان روز جمعه رهبر معظم انقلاب نوشته و به تحلیل این سخنان و تاثیر آن بر آینده روابط میان ایران و غرب پرداختند.\r\nاین سه مقام ایرانی که دو نفر از آن‌ها عضو سپاه پاسداران هستند، گفتند که آقای خامنه‌ای این دستور را در جلسه اضطراری شورای عالی امنیت ملی ایران در صبح روز چهارشنبه، ۱۰ مرداد، اندکی پس از اعلام ایران مبنی بر کشته شدن آقای هنیه صادر کرده است.\r\n\r\nایران و حماس، اسرائیل را به این ترور متهم کرده‌اند. اما اسرائیل که در نوار غزه با حماس در حال جنگ است، کشته شدن آقای هنیه را که برای مراسم تحلیف رئیس‌جمهور جدید ایران در تهران حضور داشت، نه تأیید و نه رد کرده است.\r\n\r\nبر اساس گزارش نیویورک تایمز، اسرائیل سابقه طولانی در کشتن افراد در خارج از کشور از جمله دانشمندان هسته‌ای و فرماندهان نظامی ایران دارد.', 'uploads/licensed-image.jpg'),
(7, 'حضرت آیت الله خامنه ای', 'نیویورک تایمز', 'علی خامنه‌ای دستور حمله به اسرائیل را صادر کرد', 'ه گفته سه مقام ایرانی که در جریان این دستور قرار گرفته‌اند، آیت‌الله علی خامنه‌ای به تلافی قتل اسماعیل هنیه، رهبر حماس در تهران، دستور حمله مستقیم به اسرائیل را صادر کرده است.\r\n\r\nاین سه مقام ایرانی که دو نفر از آن‌ها عضو سپاه پاسداران هستند، گفتند که آقای خامنه‌ای این دستور را در جلسه اضطراری شورای عالی امنیت ملی ایران در صبح روز چهارشنبه، ۱۰ مرداد، اندکی پس از اعلام ایران مبنی بر کشته شدن آقای هنیه صادر کرده است.\r\n\r\nایران و حماس، اسرائیل را به این ترور متهم کرده‌اند. اما اسرائیل که در نوار غزه با حماس در حال جنگ است، کشته شدن آقای هنیه را که برای مراسم تحلیف رئیس‌جمهور جدید ایران در تهران حضور داشت، نه تأیید و نه رد کرده است.\r\n\r\nبر اساس گزارش نیویورک تایمز، اسرائیل سابقه طولانی در کشتن افراد در خارج از کشور از جمله دانشمندان هسته‌ای و فرماندهان نظامی ایران دارد.', 'uploads/1814303_424.jpg'),
(8, 'ایتامار بن گوریر', 'ایسنا', 'یورش مجدد وزیر امنیت داخلی و شهرک‌نشینان صهیونیست به مسجدالاقصی', 'وزیر امنیت داخلی رژیم صهیونیستی صبح امروز چهارشنبه بار دیگر تحت محافظت شدید پلیس صهیونیستی به همراه تعدادی از شهرک‌نشینان به مسجدالأقصی یورش بردند.\r\n\r\nبه گزارش ایسنا، منابع به الجزیره اعلام کردند همزمان با یورش «ایتامار بن گویر» وزیر امنیت داخلی رژیم صهیونیستی به مسجد، نیروهای اشغالگر، نمازگزاران را از مسجدالأقصی بیرون کرده و نگهبانان مسجد را از محوطه‌های آن دور کردند.\r\n\r\nاین اقدام چند روز قبل از عید یهودی «فصح» اتفاق می‌افتد که از ۱۲ آوریل آغاز شده و به مدت ۱۰ روز ادامه خواهد داشت و این زمان به شهرک‌نشینان اجازه می‌دهد که با تعداد بیشتری به مسجدالاقصی یورش ببرند.\r\n\r\nاین پنجمین بار است که بن گویر از آغاز جنگ نسل‌کشی رژیم صهیونیستی علیه مردم غزه، به مسجد الاقصی می‌رود. همچنین این اقدام هشتمین بار از زمان تصدی سمت وزیری وی در پایان سال ۲۰۲۲ است.', 'uploads/63411887.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(2, 'mahan', 'mmm@gmail.com', '$2y$10$16rePCFBzmEdoknhyd685OWNKBauCee3chuhRpKDNHdzjzGTKzVLu'),
(3, 'mehrad', 'orooj.034@famail', '$2y$10$L0eMA8T7ndka/PrB7JCJbeWbhKNDmYT36tgWYPKsHPlhYOq592UQe'),
(5, '3f', 'erbeb@fegb', '$2y$10$ZUQmxYW1DwAvDcyy9Ln98ui3dX9L7Q20j9zgrCpNhnPgpkad9FYFe'),
(6, 'اهاا', 'mmm@gmail.com34', '$2y$10$2sj8HXZmn2qz775Al.v3guBhSGWigqPmq8gdlyfvFDJ0we5nxfDFq'),
(7, 'omid', 'omid@email', '$2y$10$4jG/.BfsNy4Egz1kRYxTpO2N2wwitfw3cVROv3qAzcoCvXHd0Jzc6'),
(8, 'mehran', 'mmm.mehran.86@gmail.com', '$2y$10$UZns.FSU/vnHOrNvfvnC9ewH6DA/CDZ6rgeZMkRJE5A0HG7MLLSbG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
