-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2025 at 04:55 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u431421769_monitor_hunt`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `banner_description` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `author_name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `image_path`, `heading`, `banner_description`, `category`, `short_description`, `author_name`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES
(2, 'assets/uploads/blogs/c933dd0797cb1bf1.png', 'Dubai Land Department: Shaping the Future of Property in Dubai', 'Dubai is known for ambition, luxury, and innovation and the Dubai Land Department (DLD) is proving why.', 'Real Estate', 'Dubai is known for ambition, luxury, and innovation and the Dubai Land Department (DLD) is proving why. Recently named the ‘Inspirational Brand’ at the Asia-Pacific Property Awards 2025, DLD is redefining how people buy, sell, and invest in property across the city.', 'houzzhunt', '<p>Dubai is known for ambition, luxury, and innovation and the Dubai Land Department (DLD) is proving why. Recently named the ‘Inspirational Brand’ at the Asia-Pacific Property Awards 2025, DLD is redefining how people buy, sell, and invest in property across the city.</p><h4><strong>Why It Matters for You</strong></h4><p>For anyone exploring <a href=\"https://houzzhunt.com/about\"><strong>Dubai’s real estate market</strong></a>, DLD’s recognition signals a system that works fast, clear, and reliable. This isn’t just about awards; it’s about smoother transactions, smarter tools, and a market you can trust.</p><ul><li><strong>Smart Technology:</strong> From AI-driven valuation tools to the Dubai REST app, property processes are faster, easier, and more accurate than ever.</li><li><strong>Confidence in Every Deal:</strong> Streamlined procedures and transparent regulations mean you can make decisions with certainty—whether you’re investing in commercial space or buying your first home.</li><li><strong>Sustainability at the Core:</strong> DLD isn’t just shaping the market; it’s shaping communities. Their initiatives focus on environmental responsibility and high community satisfaction, ensuring Dubai grows thoughtfully and sustainably.</li></ul><h4><strong>2025 by the Numbers</strong></h4><ul><li>1.3 million real estate procedures processed</li><li>125,000+ transactions totaling AED 431 billion</li><li>59,000 new investors fueling Dubai’s growth</li></ul><h4><strong>How HouzzHunt Helps You Navigate This Market</strong></h4><p>At <a href=\"https://houzzhunt.com/\"><strong>HouzzHunt</strong></a>, we take the complexity out of property decisions. From curated luxury homes to high-potential investment opportunities, our team ensures you make informed choices with confidence. With DLD setting the bar high, our clients benefit from a market that’s transparent, reliable, and full of opportunity.</p><p>Dubai’s property market is evolving rapidly. With the right guidance, it’s a city where smart investments and exceptional living come together and HouzzHunt is here to make sure you get both.</p>', 'houzzhunt | Dubai Land Department: Shaping the Future of Property in Dubai', 'Dubai Land Department, DLD 2025 award, Inspirational Brand Asia-Pacific Property Awards, Dubai real estate innovation, AI property valuation Dubai, Dubai REST app, transparent real estate Dubai, property investment Dubai, sustainable real estate Dubai, buy property Dubai, sell property Dubai, invest in Dubai property', 'Dubai Land Department (DLD) leads property innovation with smart tech, reliable processes, and sustainable growth, making real estate smarter in Dubai.', '2025-09-23 07:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `phone`, `country`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 'Shoaib Ahmad', 'surveyor@gmail.com', '08400438136', 'India (भारत)', '2409:40e3:183:1048:c51f:3db3:dcd9:2ca9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 08:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `page_access_logs`
--

CREATE TABLE `page_access_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `referer` text DEFAULT NULL,
  `request_uri` text DEFAULT NULL,
  `accessed_at` timestamp NULL DEFAULT current_timestamp(),
  `headers` text DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popup_form`
--

CREATE TABLE `popup_form` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popup_form`
--

INSERT INTO `popup_form` (`id`, `name`, `email`, `phone`, `country`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 'Shoaib Ahmad', 'shoaib@reliantsurveyors.com', '08400438136', 'India (भारत)', '2409:40e3:183:1048:c51f:3db3:dcd9:2ca9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 08:08:45'),
(2, 'Rahul', 'surveyor@gmail.com', '53446798', 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', '2409:40e3:183:1048:c51f:3db3:dcd9:2ca9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-23 08:46:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_access_logs`
--
ALTER TABLE `page_access_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup_form`
--
ALTER TABLE `popup_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_access_logs`
--
ALTER TABLE `page_access_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popup_form`
--
ALTER TABLE `popup_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
