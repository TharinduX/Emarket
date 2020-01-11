-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2019 at 09:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emarketlk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_uname` varchar(50) NOT NULL,
  `admin_pw` varchar(20) NOT NULL,
  `admin_type` varchar(50) NOT NULL,
  `admin_nic` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_uname`, `admin_pw`, `admin_type`, `admin_nic`) VALUES
(1, 'tharindu', '123456', 'manager', '098214v'),
(2, 'jayasanka', '123456', 'admin', '9732423425v'),
(3, 'john97', '123456', 'admin', '123256778v');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(20) NOT NULL,
  `ip_add` varchar(225) CHARACTER SET latin1 NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(9, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `cu_name` varchar(100) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_pw` varchar(70) NOT NULL,
  `c_repw` varchar(70) NOT NULL,
  `c_tp` int(20) NOT NULL,
  `c_nic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `cu_name`, `c_email`, `c_pw`, `c_repw`, `c_tp`, `c_nic`) VALUES
(10022, 'waduge', 'achiniudari94@gmail.com', '123456', '123456', 2134155, '1254123515'),
(10024, 'tharindu97', 'jayasankaut@gmail.com', '123456', '123456', 124156677, '143256677'),
(10025, 'chathunie', 'nawanjanarathnayake@gmail.com', '123456', '123456', 765304204, '535353425v');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `c_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `mobile` int(11) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`c_id`, `name`, `address`, `mobile`, `city`) VALUES
(10022, 'waduge ', '"Jayahansi", Maliyadda,', 714515265, 'Matara');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `p_id` int(20) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`p_id`, `file_name`, `uploaded_on`) VALUES
(1, 'uploads/product1.jpg', '2019-03-12 18:25:23'),
(2, 'uploads/product2.jpg', '2019-03-12 18:29:15'),
(3, 'uploads/kottumeehot_spicycupnoodles.jpg', '2019-03-12 18:40:17'),
(4, 'uploads/mdpineapplejam.jpg', '2019-03-12 18:41:22'),
(5, 'uploads/pediapro1-2400g.jpg', '2019-03-12 18:43:30'),
(6, 'uploads/chickenwings.jpg', '2019-03-12 18:45:11'),
(7, 'uploads/elephant-house--fit-o-mango-200ml.jpg', '2019-03-12 18:49:00'),
(8, 'uploads/snakwood.jpg', '2019-03-12 18:49:35'),
(9, 'uploads/wildelephantenergydrink.jpg', '2019-03-12 18:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `ordered_items` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(20) NOT NULL,
  `amount` float NOT NULL,
  `item` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `amount`, `item`, `description`, `price`) VALUES
(1, 50, 'ANCHOR Milk Powder 400g', 'this is some text1', 345),
(2, 50, 'SUNLIGHT Lemon & Rose Soap 120g', 'this is some text2', 50),
(3, 20, 'PRIMA Kottumee Hot &Spicy Cup Noodle 75g', 'this is some text3', 100),
(4, 20, 'MD PINEAPPLE JAM 300g', 'this is some text4', 250),
(5, 12, 'ANCHOR Pedia Pro 2-5 400g', 'this is some text5', 695),
(6, 20, 'CIC Chicken Wings (CHP-280)', 'this is some text6', 470),
(7, 20, 'Elephant House FIT O Mango 200ml', 'this is some text7', 60),
(8, 20, 'SMAK Woodapple Drink 200ml', 'this is some text8', 60),
(9, 20, 'WILD ELEPHANT Energy Drink 250ml', 'this is some text9', 200);

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `nic` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`nic`, `name`, `address`, `city`) VALUES
('124125415', 'shashika', 'Jayahansi Maliyadda', 'matara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_name` (`admin_uname`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `cu_name` (`cu_name`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`nic`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10026;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
