-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 04:26 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `type`, `confirmCode`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '6464651', 'okay', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin', '789456'),
(2, 'Hiakosi', 'Castaneda', 'joana@gmail.com', '09368790811', 'ADDRESS 1 BLK 15 LOT 17 DRIVE ST.', '21232f297a57a5a743894a0e4a801fc3', 'staff', '131527'),
(3, 'Jhenny', 'Lee', 'lee@gmail.com', '09207601999', 'longos', '69a9dc1da83c4c3e58a5ecb7c9de78fa', 'admin', '139474');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `quantity`) VALUES
(11, 2, 12, 0),
(12, 0, 46, 0),
(15, 43, 47, 0),
(19, 42, 54, 0),
(20, 42, 53, 0),
(21, 0, 47, 0),
(22, 0, 99, 0),
(23, 46, 81, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dstatus` varchar(10) NOT NULL DEFAULT 'no',
  `odate` date NOT NULL,
  `ddate` date NOT NULL,
  `delivery` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pName`, `price`, `piece`, `description`, `available`, `category`, `type`, `item`, `pCode`, `picture`) VALUES
(77, 'Mega Sardines 155g set of 8pcs', 172, 8, 'Mega in tomato sauce w chili', 100, '', '', 'noodles', 'aa', '1539174914.png'),
(78, 'Argentina corned beef 260g set of  6pcs', 450, 6, 'Package foods from century', 100, '', '', 'noodles', 'bb', '1539176648.jpg'),
(79, 'Argentina Meatloaf 250g set of 6pcs', 350, 6, '250g set of 6', 100, '', '', 'noodles', 'cc', '1539176787.jpg'),
(80, 'Argentina Fiesta Sausage 175g 5pcs', 155, 5, '175g set of 5pcs', 100, '', '', 'noodles', 'dd', '1539176959.jpg'),
(81, 'Pork Maling luncheon 340g (2pcs)', 258, 2, '340g (2pcs)', 100, '', '', 'noodles', 'ee', '1539177153.jpg'),
(82, 'blueyellow-ligo-gata-style-sardines-155g-4pcs', 110, 4, '155g (set of 4pcs)', 100, '', '', 'noodles', 'ff', '1539177279.jpg'),
(83, 'Magic Sarap 4packs', 185, 4, '8g set of 4', 100, '', '', 'seasoning', 'qq', '1539232659.PNG'),
(84, 'Coke Mismo 300ml set of 24 pcs', 290, 24, '300 ml 24pcs', 100, '', '', 'drink', 'qwe', '1539403731.PNG'),
(85, 'Sprite Mismo 250ml 24pcs', 300, 24, '250ml 24pcs', 100, '', '', 'drink', 'qwer', '1539403840.PNG'),
(86, 'Kopiko Blanca Cream 30g set of 2', 160, 2, '30g set of 2packs', 100, '', '', 'drink', 'qwrt', '1539404335.jpg'),
(87, 'Milo 22g set of 2packs', 160, 24, '22g 2packs/24pcs', 100, '', '', 'drink', 'ryrty', '1539404929.jpg'),
(88, 'Coke 1.5L  5bottles', 290, 5, 'coke 1.5L 5B', 100, '', '', 'drink', 'mnb', '1539405194.jpg'),
(90, 'Wilkins 330ml    30bottles', 238, 30, '330ml /   30 bottles', 100, '', '', 'drink', 'ads', '1539405937.jpg'),
(91, 'Graham Crackers 200g 4set', 165, 4, '200g/4sets', 100, '', 'other', 'snack', 'asdaa', '1539447093.PNG'),
(92, 'MagicCreamsChoco 308g 5set', 320, 5, '308g/set of 5/11 packs', 100, '', 'other', 'snack', 'adf', '1539447263.PNG'),
(93, 'Nissin Butter 10gx12 3sets', 100, 3, '10g /     12packs      /3sets', 100, '', '', 'snack', 'gfhjgj', '1539447833.PNG'),
(94, 'Otap Bacolod sp 200g', 180, 1, '200g', 100, '', '', 'snack', 'lkfjd', '1539447955.PNG'),
(95, 'Presto Creams PeanutB 10packs/3sets', 190, 3, '10packs/3sets', 100, '', '', 'snack', 'lk', '1539448126.PNG'),
(96, 'gummy colas  4sets', 100, 4, 'gummy 4s', 100, '', '', 'sweet', 'po', '1539448238.PNG'),
(97, 'kitkat 4s', 110, 4, 'kitkat bars', 100, '', '', 'sweet', 'n', '1539448317.PNG'),
(98, 'Mr. mais sweet corn candy 106g 4s', 100, 4, '106g /4sets', 100, '', '', 'sweet', 'b', '1539448500.PNG'),
(99, 'Palmolive silky  12ml+conditioner 10ml/24s', 200, 24, 'shampoo12ml+conditioner10ml', 100, '', 'other', 'shampoo', 'r', '1539448680.PNG'),
(100, 'Palmolive shampoo aroma-vitality 13.5ml 48s', 270, 48, '13.5ml/48sets', 100, '', '', 'shampoo', 'v', '1539448775.PNG'),
(101, 'Palmolive shampoo antiDandruff 13.5ml 48s', 270, 100, '13.5ml/48sets', 100, '', '', 'shampoo', 'e', '1539448866.PNG'),
(102, 'joy dishwashing liquid 255ml 3sets', 400, 3, '255ml 3sets', 100, '', '', 'soap', 'a', '1539660576.PNG'),
(103, 'dove bar soap 3sets 100g', 220, 3, '3sets 100g', 100, '', '', 'soap', 'nl', '1539660980.PNG'),
(104, 'Bioderm soap 7sets 135g', 300, 7, '7sets 135g', 100, '', '', 'soap', 'ewr', '1539661097.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmCode` varchar(10) NOT NULL,
  `activation` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `confirmCode`, `activation`) VALUES
(44, 'Jo', 'Castaneda', 'joanmcastaneda@gmail.com', '09368790811', 'ADDRESS 1 BLK 15 LOT 17 DRIVE ST.', '69a9dc1da83c4c3e58a5ecb7c9de78fa', '0', 'yes'),
(45, 'KO', 'KOOOO', 'ko@w.com', '123', 'ADDRESS 1 BLK 15 LOT 17 DRIVE ST.', '25d55ad283aa400af464c76d713c07ad', '289477', 'no'),
(46, 'Czyke', 'Correa', 'czyke@yahoo.com', '09368790811', 'ADDRESS 1 BLK 15 LOT 17 DRIVE ST.', '7c09a95be9c2e9612c2bda758fc17e42', '0', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
