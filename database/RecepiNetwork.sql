-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 03:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `recipe_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faqcategories`
--

CREATE TABLE `faqcategories` (
  `FaqCatID` int(255) UNSIGNED NOT NULL,
  `FaqCatName` varchar(255) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `faqcategories`
--

INSERT INTO `faqcategories` (`FaqCatID`, `FaqCatName`) VALUES
(1, 'General'),
(2, 'About posting a recipe'),
(3, 'xyz'),
(4, 'test cat'),
(5, 'test cat2'),
(6, 'test cat3'),
(7, 'test cat4'),
(8, 'test cat 5'),
(9, 'test cat 6'),
(10, 'test cat 7'),
(11, 'test cat  8'),
(12, 'test cat 9'),
(13, 'test cat 9'),
(14, 'test cat 10'),
(15, 'final test'),
(16, 'final final test ');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `FaqID` int(255) UNSIGNED NOT NULL,
  `FaqQtn` varchar(255) COLLATE latin1_bin NOT NULL,
  `FaqAns` mediumtext COLLATE latin1_bin NOT NULL,
  `FaqCatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`FaqID`, `FaqQtn`, `FaqAns`, `FaqCatID`) VALUES
(1, 'What are the benefits of Solodev CMS?', 'Light speed deployment on the most secure and stable cloud infrastructure available on the market', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_menu_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `description`, `parent_menu_id`) VALUES
(1, 'Home', 'index.php', 'All the posts', 0),
(2, 'Dinner', 'Category/dinner.php', 'has different types of categories of recipes.', 0),
(3, 'Soups', 'category/dinner/soups.php', 'all posted the recipes of soups.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) NOT NULL,
  `subject` tinytext NOT NULL,
  `body` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `subject`, `body`) VALUES
(1, 'This weeks Popular Recipes.', '1) Mango Desert\r\n2) Chicken Soup\r\n3) Indian Burrito'),
(2, 'Weekly tips for your niche', 'allergy friendly recipes or Vancouver\'s restaurants, include a weekly tip or two like how to make allergy friendly granola bars or the opening of a new Vancouver restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `recipe_id` int(10) NOT NULL,
  `sender_user_id` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `comment_desc` text DEFAULT NULL,
  `notification_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `status`, `recipe_id`, `sender_user_id`, `type`, `comment_desc`, `notification_date`) VALUES
(1, 'unread', 1, 2, 0, 'very tasty!!', '2020-02-18 00:00:00'),
(3, 'new', 4, 3, 1, NULL, '2020-04-12 20:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` mediumtext NOT NULL,
  `preparation` mediumtext NOT NULL,
  `category` varchar(255) NOT NULL,
  `recipe_img` varchar(255) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `posted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `ingredients`, `preparation`, `category`, `recipe_img`, `user_id`, `posted_date`) VALUES
(4, 'test title updated', 'a,b,c updated', 'xyz updated', 'appetizers', 'r4.JPG', 1, '2020-04-12 00:00:00'),
(5, 'Chicken, Asparagus, and Mushroom Skillet', '3 tablespoons butter,2 tablespoons olive oil,½ teaspoon dried parsley,½ teaspoon dried basil', 'Melt the butter with the olive oil in a skillet over medium-high; stir the parsley, basil, oregano, garlic, salt, lemon juice, and wine into the butter mixture. Add the chicken; cook and stir until the chicken is browned, about 3 minutes. Reduce heat to medium; cook, stirring occasionally, until the chicken is no longer pink inside, about 10 more minutes.', 'main', 'r5.JPG', 1, '2020-04-12 22:54:11'),
(6, 'Mushrooms with a Soy Sauce Glaze', '2 tablespoons butter1 (8 ounce) package sliced white mushrooms2 cloves garlic, minced2 teaspoons soy sauceground black pepper to taste', 'Melt the butter in skillet over medium heat; add the mushrooms; cook and stir until the mushrooms have softened and released their liquid, about 5 minutes. Stir in the garlic; continue to cook and stir for 1 minute. Pour in the soy sauce; cook the mushrooms in the soy sauce until the liquid has evaporated, about 4 minutes.', 'beverages', 'r6.JPG', 1, '2020-04-12 23:01:02'),
(7, 'Sauteed Mushrooms', '1/2 cup butter1 ,pound sliced mushrooms1 (1 ounce) ,package dry ranch salad dressing mix', 'Melt the butter over low heat. Mix in dry ranch salad dressing mix. Add mushrooms, and stir to coat. Cook, stirring frequently, until the mushrooms are very tender, at least 30 minutes.', 'beverages', 'r7.JPG', 1, '2020-04-12 23:04:45'),
(8, 'Best Steak Marinade in Existence', '1/3 cup soy sauce1/2 cup olive oil1/3 cup fresh lemon juice1/4 cup Worcestershire sauce1 1/2 tablespoons garlic powder3 tablespoons dried basil1 1/2 tablespoons dried parsley flakes1 teaspoon ground white pepper1/4 teaspoon hot pepper sauce (optional)', 'Place the soy sauce, olive oil, lemon juice, Worcestershire sauce, garlic powder, basil, parsley, and pepper in a blender. Add hot pepper sauce and garlic, if desired. Blend on high speed for 30 seconds until thoroughly mixed.', 'deserts', 'r8.JPG', 1, '2020-04-12 23:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `user_role` tinyint(1) NOT NULL,
  `is_subscribed` tinyint(1) NOT NULL,
  `mute_notification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `user_role`, `is_subscribed`, `mute_notification`) VALUES
(1, 'Chris', 'Jonas', 'chris@foodie.ca', 'foodLover', 1, 0, 1),
(2, 'Gery', 'Columbus', 'colmbus@gmail.com', 'addictFood', 0, 1, 1),
(3, 'Amit', 'Deka', 'adamitdeka@gmail.com', 'humber123', 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqcategories`
--
ALTER TABLE `faqcategories`
  ADD PRIMARY KEY (`FaqCatID`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`FaqID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqcategories`
--
ALTER TABLE `faqcategories`
  MODIFY `FaqCatID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `FaqID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
