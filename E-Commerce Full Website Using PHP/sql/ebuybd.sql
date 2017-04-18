-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 06:48 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ebuybd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmCode` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `type`, `confirmCode`) VALUES
(3, 'Borsha', 'Tasnim', 'borsha@gmail.com', '01678293748', 'Dhaka, Bangladesh', 'aa030295ae26e8acbd3d1c9415a60f12', 'manager', '117631');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dstatus` varchar(10) NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `dstatus`, `odate`, `ddate`) VALUES
(1, 7, 28, 0, 'Manikganj Sadar', '01677531881', 'no', '2017-04-07', '0000-00-00'),
(2, 7, 31, 0, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'yes', '2017-04-07', '0000-00-00'),
(4, 7, 26, 0, 'South Seota, Manikganj Sadar', '01677531881', 'no', '2017-04-07', '0000-00-00'),
(9, 7, 44, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-08', '0000-00-00'),
(10, 7, 44, 3, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Yes', '2017-04-08', '0000-00-00'),
(13, 7, 11, 2, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'Cancel', '2017-04-08', '0000-00-00'),
(14, 7, 40, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-08', '0000-00-00'),
(15, 7, 43, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-08', '0000-00-00'),
(16, 7, 29, 3, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-09', '0000-00-00'),
(17, 11, 35, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-09', '0000-00-00'),
(18, 7, 31, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-09', '0000-00-00'),
(19, 13, 43, 3, 'asdfas', '789', 'Yes', '2017-04-09', '0000-00-00'),
(20, 13, 29, 1, 'asdfas', '789', 'Yes', '2017-04-09', '2017-04-14'),
(21, 7, 43, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-09', '0000-00-00'),
(22, 11, 45, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-09', '0000-00-00'),
(23, 11, 32, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '0000-00-00'),
(24, 11, 32, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '0000-00-00'),
(25, 11, 51, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '0000-00-00'),
(26, 11, 29, 2, 'Saver, Dhaka', '01678293748', 'Cancel', '2017-04-10', '0000-00-00'),
(27, 7, 43, 1, 'Nikunja 2, Khilkhet, Dhaka', '01677531881', 'no', '2017-04-10', '0000-00-00'),
(28, 11, 29, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '2017-04-11'),
(29, 11, 43, 1, 'Saver, Dhaka', '01678293748', 'no', '2017-04-10', '2017-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pName`, `price`, `description`, `available`, `category`, `type`, `item`, `pCode`, `picture`) VALUES
(3, 'Metal-Collar-Bone-Chain-Set', 1200, 'Dekhte khub e sundor', 2, 'women', 'Chain Set', 'ornament', 'SR002', 'Women-Neck-Jewelry-Exaggerated-Metal-Collar-Bone-Chain-Set.jpg'),
(4, 'Colors-Women-Embellished-Saree', 1200, 'kichu koilam na', 2, 'women', 'cloathing', 'saree', 'SR002', 'Colors-Women-Embellished-Saree_2.jpg'),
(5, 'Colors-Women-Embellished-Sarees', 1200, 'kichu koilam na', 2, 'women', 'cloathing', 'saree', 'SR002', 'Colors-Women-Embellished-Saree_3.jpg'),
(6, 'Jewelry-Color-diamond-Love-font', 2000, 'Dekhte khub e sundor', 2, 'women', 'Chain Set', 'ornament', 'SR002', 'Jewelry-Color-created-created-diamond-Love-font-b.jpg'),
(7, 'Jewelry-full metal earring', 2000, 'Dekhte khub e sundor', 2, 'women', 'earring', 'ornament', 'SR002', 'earrings-online-for-women-4.jpg'),
(10, 'Boutique Saree 1', 1300, 'Osthir mama!', 4, 'women', 'cloathing', 'saree', 'SR001', 'Saree Red Color 1.jpg'),
(11, 'fancy-look-attractive-saree-2-original', 1200, 'kichu koilam na', 2, 'women', 'cloathing', 'saree', 'SR002', 'new-designer-fancy-look-attractive-saree-2-original.jpg'),
(26, 'Watches-for-women-5', 700, 'à¦¸à§à¦¨à§à¦¦à¦°, à¦†à¦•à¦°à§à¦·à¦£à§€à§Ÿ', 2, 'women', 'No', 'watch', 'W234', '1491496755.jpg'),
(27, 'Diamond-Setting-Watch-3', 700, '2016-New-Electronic-Style-Women-Dress-New-Fashion-Watches-Imitation-Diamond-Setting-Watch-Casual-Wrist-Watch-3', 3, 'women', 'yes', 'watch', 'W234', '1491496880.jpg'),
(28, 'Steel-Bracelet 2', 399, 'Steel-Bracelet-Women-Watches-Designs', 2, 'women', 'no', 'watch', 'W345', '1491496956.jpg'),
(29, 'Steel-Bracelet-Women-3', 1000, 'Steel-Bracelet-Women-Watches', 3, 'women', 'yes', 'watch', 'W345', '1491497102.jpg'),
(30, 'Right-hand-rings 2', 200, 'Right-hand-rings-collection-ornament-champagne-diamond-ring-for-women_mainro', 3, 'women', 'ok', 'ornament', 'O234', '1491497201.jpg'),
(31, 'floral-ornament-ring-3d', 1200, 'floral-ornament-ring-3d-model-stl-3dm', 3, 'women', 'ok', 'ornament', 'O254', '1491497263.jpg'),
(32, 'Nekles set', 799, 'Good, Awesome', 2, 'women', 'no', 'ornament', 'O2352', '1491497316.jpg'),
(33, 'T Shirt 1', 250, 'Nice', 10, 'women', 'no', 'tshirt', 'TS252', '1491497478.jpg'),
(34, 'T Shirt 2', 400, 'Nice Looking', 12, 'women', 'no', 'tshirt', 'TS3463', '1491497528.jpg'),
(35, 'T Shirt 3', 299, 'Nice', 27, 'women', 'no', 'tshirt', 'TS345', '1491497588.jpg'),
(36, 'T Shirt 4', 890, 'Nice, good', 30, 'women', 'no', 'tshirt', 'TS2354', '1491497644.jpg'),
(37, 'CHARCOAL_SOFT_G_HIJAB', 700, 'CHARCOAL_SOFT_G_HIJAB', 3, 'women', 'no', 'hijab', 'H98', '1491498074.jpg'),
(38, 'HijabScarf (20)', 400, 'HijabScarf ', 23, 'women', 'no', 'hijab', 'H3254', '1491498134.JPG'),
(39, 'Hijab 3', 600, 'hijab-2013', 20, 'women', 'no', 'hijab', 'H2354', '1491498202.jpg'),
(40, 'Hijab 4', 800, 'nice and cool', 23, 'women', 'no', 'hijab', 'H233', '1491498250.jpg'),
(41, 'vera_wang_princess', 2000, 'vera_wang_princess_perfume_for_women', 10, 'women', 'no', 'perfume', 'P2354', '1491498354.jpg'),
(42, 'Perfume 1', 150, 'top-perfumes-for-women', 2, 'women', 'no', 'perfume', 'P345', '1491498398.jpg'),
(43, 'Perfume 2', 3000, 'Awesome smell', 6, 'women', 'no', 'perfume', 'P252', '1491649246.jpg'),
(44, 'Perfume 3', 5000, 'Nice', 3, 'women', 'no', 'perfume', 'P254', '1491498508.jpg'),
(45, 'Latest-Fancy 2', 5000, 'Latest-Fancy-Ladiess-Shoes-Designs-2014', 300, 'kidsmom', 'clothing', 'footwear', 'S32543', '1491498848.jpg'),
(49, 'Soap 1', 80, 'Nice', 20, 'women', 'no', 'toiletry', 'SP234', '1491499503.jpg'),
(51, 'New Perfume 4', 4453, 'asdfa', 34, 'women', 'clothing', 'watch', 'asdf78', '1491707164.jpg'),
(52, 'Sareesf', 453354, 'asdfa', 342, 'women', 'clothing', 'perfume', 'S56', '1491850298.jpg'),
(53, 'Soap 3', 345, 'Cool', 30, 'women', 'clothing', 'toiletry', 'S789', '1491850339.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  `activation` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `confirmCode`, `activation`) VALUES
(9, 'Borsha', 'Tanjina', 'Tanjina@gmail.com', '01578399283', 'Dhaka, Bangladesh', 'aa030295ae26e8acbd3d1c9415a60f12', '217576', 'yes'),
(10, 'Trisha', 'Rehman', 'trisha@gmail.com', '01923457834', 'Mirpur 2, Dhaka', '5af7a513a7c48f6cc97253254b29509b', '0', 'yes'),
(11, 'Akhi', 'Alam', 'akhi@gmail.com', '01678293748', 'Saver, Dhaka', 'ca52febd8be7c4480ae90cdae8438a03', '0', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
