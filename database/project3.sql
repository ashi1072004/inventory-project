-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 02:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adid`, `email`, `password`, `status`, `date`) VALUES
(1, 'admin@gmail.com', 'admin', '', '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(255) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `cdes` varchar(255) NOT NULL,
  `cdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `cdes`, `cdate`) VALUES
(3, 'Car', 'BMW Car, Honda City Car', '2023/06/24'),
(4, 'Bike', 'HYUNDAI bike with Auto-Pilot feature.', '2023/07/05'),
(5, 'Shoes', 'This is a shoes category description.', '2023/07/05'),
(7, 'Mobile Phones', 'Id ducimus iste des', '2023/07/11'),
(8, 'Laptops', 'Dolor quo quos quisq', '2023/07/11');

-- --------------------------------------------------------

--
-- Table structure for table `measure`
--

CREATE TABLE `measure` (
  `mid` int(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `mdes` varchar(255) DEFAULT NULL,
  `mdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measure`
--

INSERT INTO `measure` (`mid`, `mname`, `mdes`, `mdate`) VALUES
(2, 'lb', 'Asperiores fuga Sun', '2023/07/05'),
(3, 'inches', 'Perspiciatis cupida', '2023/07/05'),
(4, 'metre', 'Explicabo Animi si', '2023/07/05'),
(5, 'kg', 'Nulla quasi sed offi', '2023/07/05'),
(6, 'Single', 'only 1 piece', '2023/07/08'),
(7, 'Pair', 'Sit tenetur doloribu', '2023/07/11');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(255) NOT NULL,
  `pcat` int(255) NOT NULL,
  `psubcat` int(255) NOT NULL,
  `psup` int(255) NOT NULL,
  `pmes` int(255) NOT NULL,
  `pcode` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdes` varchar(255) NOT NULL,
  `pcost` int(255) NOT NULL,
  `psale` int(255) NOT NULL,
  `pstock` int(255) NOT NULL,
  `ppic` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pcat`, `psubcat`, `psup`, `pmes`, `pcode`, `pname`, `pdes`, `pcost`, `psale`, `pstock`, `ppic`, `status`, `pdate`) VALUES
(2, 3, 1, 2, 6, '0987654321', 'Audi Q7 2995 cc', 'The price of Audi Q7 in Pakistan ranges from PKR 47,000,000 to PKR 47,000,000 for a used Audi Q7. These prices of Audi Q7 in Pakistan vary on model year, mileage, variant and overall condition of the car.', 40000000, 47000000, 10, 'a:3:{i:0;s:9:\"70921.jpg\";i:1;s:9:\"38797.jpg\";i:2;s:9:\"68760.jpg\";}', 'offline', '2023/07/11'),
(3, 5, 5, 5, 7, '48789786', 'MEN\'S STITCHED DETAIL LOAFERS', 'The perfect shoes for running errands around town made with good quality man-made leather that ensures durability.', 1000, 2000, 44, 'a:3:{i:0;s:9:\"49905.png\";i:1;s:9:\"94212.png\";i:2;s:9:\"66746.png\";}', 'online', '2023/07/12'),
(4, 3, 1, 2, 6, '4568966', 'Audi A4 1.4 TFSI', '1395 cc, Automatic, Petrol, 6 Airbags, Sun Roof, Moon Roof, Rear AC Vents, Navigation, Climate Control, Cruise Control', 11000000, 11020000, 20, 'a:5:{i:0;s:9:\"41919.jpg\";i:1;s:9:\"40213.jpg\";i:2;s:9:\"16117.jpg\";i:3;s:9:\"70639.jpg\";i:4;s:9:\"67918.jpg\";}', 'offline', '2023/07/11'),
(5, 3, 1, 2, 6, '8643467598', 'Audi TT RS Roadster', '2480 cc, Automatic, Petrol, 6 Airbags, Rear Central Control, Heated Seats, Navigation, Climate Control, Cruise Control, Traction Control', 19000000, 19400000, 5, 'a:2:{i:0;s:9:\"93044.jpg\";i:1;s:9:\"78897.png\";}', 'offline', '2023/07/11'),
(6, 3, 7, 2, 7, '686423156', 'Honda City 1.2 LS', 'Water Cooled 4 Stroke, SOHCi-VTEC , 16 valves 4-cylinder, 5 Speed Forward & 1 Reverse, Continuously Variable Transmission (CVT) with Earth Dreams Technology', 4700000, 4799000, 10, 'a:4:{i:0;s:9:\"91415.jpg\";i:1;s:9:\"31816.jpg\";i:2;s:9:\"51719.jpg\";i:3;s:9:\"23206.jpg\";}', 'offline', '2023/07/11'),
(7, 3, 7, 2, 7, '12397589', 'Honda Accord 1.5L VTEC Turbo', '1498 cc, Automatic, Petrol, 6 Airbags, Sun Roof, Moon Roof, Rear AC Vents, Heated Seats, Navigation, Push Start', 15400000, 15499000, 10, 'a:4:{i:0;s:9:\"30474.jpg\";i:1;s:9:\"38183.jpg\";i:2;s:9:\"90082.jpg\";i:3;s:9:\"31157.jpg\";}', 'offline', '2023/07/11'),
(8, 3, 7, 2, 7, '78674124', 'Honda Civic Oriel', '1500 cc, Automatic, Petrol, 2 Airbags, Sun Roof, Rear Central Control, Rear AC Vents, Navigation, Push Start, Driving Modes', 8900000, 8949000, 20, 'a:3:{i:0;s:9:\"23192.jpg\";i:1;s:9:\"76480.jpg\";i:2;s:9:\"72493.jpg\";}', 'offline', '2023/07/11'),
(9, 3, 6, 2, 6, '008753426', 'BMW X3 Series xDrive30e', '1998 cc, Automatic, Hybrid, 9 Airbags, Cool Box, Sun Roof, Moon Roof, Rear AC Vents, Navigation, Climate Control', 40000000, 45000000, 25, 'a:2:{i:0;s:9:\"95647.jpg\";i:1;s:9:\"51378.jpg\";}', 'offline', '2023/07/11'),
(10, 3, 6, 2, 6, '97657636', 'BMW X5 Series xDrive45e', '2998 cc, Automatic, Hybrid, 11 Airbags, Sun Roof, Moon Roof, Rear AC Vents, Heated Seats, Navigation, Climate Control', 50000000, 59000000, 10, 'a:1:{i:0;s:9:\"49814.jpg\";}', 'offline', '2023/07/11'),
(11, 3, 6, 2, 7, '98685315', 'BMW X7 xDrive40i', '3000 cc, Automatic, Petrol, 8 Airbags, Power Boot, Sun Roof, Moon Roof, Rear Central Control, Rear AC Vents, Heated Seats', 70000000, 71000000, 20, 'a:1:{i:0;s:9:\"67290.jpg\";}', 'offline', '2023/07/11'),
(12, 4, 3, 3, 7, '9835810', 'Road Prince 100 Power Plus', '100 cc, 9.5 L, 4-speed transmission, Fuel Average\r\n40.0 KM/L, 9.5 HP @ 7000.0 RPM', 100000, 102500, 40, 'a:2:{i:0;s:9:\"26792.jpg\";i:1;s:9:\"82949.jpg\";}', 'offline', '2023/07/11'),
(13, 4, 3, 3, 7, '67849833', 'Road Prince Bella', 'Engine100 cc, Fuel Tank Capacity11 L, Transmission 4-speed, Fuel Average 30.0 KM/L, 7.0 HP @ 7000.0 RPM', 240000, 244500, 40, 'a:3:{i:0;s:9:\"13633.jpg\";i:1;s:9:\"80736.jpg\";i:2;s:9:\"76390.jpg\";}', 'offline', '2023/07/11'),
(14, 4, 3, 3, 6, '08382914', 'Road Prince RP 125 Euro II', 'Engine 125 cc, Fuel Tank Capacity 9.2 L, Transmission 4-speed, Fuel Average 0.0 KM/L, 11.0 HP @ 0.0 RPM', 140000, 145500, 63, 'a:2:{i:0;s:9:\"47487.jpg\";i:1;s:9:\"17129.jpg\";}', 'offline', '2023/07/11'),
(15, 4, 8, 3, 7, '675879', 'Suzuki GD 110S', 'Engine 113 cc, Fuel Tank Capacity 9 L, Transmission 4-speed, Fuel Average 45.0 KM/L, 8.0 HP @ 8500.0 RPM', 300000, 335000, 21, 'a:2:{i:0;s:9:\"15900.jpg\";i:1;s:9:\"16058.jpg\";}', 'offline', '2023/07/11'),
(16, 4, 8, 3, 7, '091289432', 'Suzuki GSX 125', 'Fuel Tank Capacity 14 L, Engine 125 cc, Transmission 5-speed, Fuel Average 40.0 KM/L, 10.0 HP @ 9000.0 RPM', 400000, 488000, 18, 'a:2:{i:0;s:9:\"98552.jpg\";i:1;s:9:\"73111.jpg\";}', 'offline', '2023/07/11'),
(17, 4, 8, 3, 7, '9301957', 'Suzuki GR 150', 'Fuel Average 45.0 KM/L, Transmission 5-speed, Fuel Tank Capacity 12.5 L, Engine 150 cc, 13.8 HP @ 8500.0 RPM', 500000, 521000, 29, 'a:2:{i:0;s:9:\"51583.jpg\";i:1;s:9:\"81479.jpg\";}', 'offline', '2023/07/11'),
(18, 4, 9, 3, 6, '0897123', 'Honda Pridor', 'Fuel Average 45.0 KM/L, Transmission 4-speed, Fuel Tank Capacity 9.7 L, Engine 97 cc, 7.5 HP @ 8500.0 RPM', 200000, 203900, 31, 'a:3:{i:0;s:9:\"75073.jpg\";i:1;s:9:\"85637.jpg\";i:2;s:9:\"27858.jpg\";}', 'offline', '2023/07/11'),
(19, 4, 9, 3, 6, '0218942', 'Honda CB 125F', 'Fuel Average 35.0 KM/L, Transmission 5-speed, Fuel Tank Capacity 12.3 L, Engine 124 cc, 10.7 HP @ 8500.0 RPM', 350000, 380900, 60, 'a:3:{i:0;s:9:\"28840.jpg\";i:1;s:9:\"68990.jpg\";i:2;s:9:\"80090.jpg\";}', 'offline', '2023/07/11'),
(20, 4, 9, 3, 6, '01329552', 'Honda CB 150F', 'Fuel Average 35.0 KM/L, Transmission 5-speed, Fuel Tank Capacity 13 L, Engine 150 cc, 17.5 HP @ 10500.0 RPM', 470000, 473900, 28, 'a:3:{i:0;s:9:\"80536.jpg\";i:1;s:9:\"81117.jpg\";i:2;s:9:\"68103.jpg\";}', 'offline', '2023/07/11'),
(21, 5, 5, 5, 6, '2389835', 'SPORTY SLIP-ONS', 'Ndure gives you the perfect partner in your fitness journey made with good quality Mesh material which ensures durability.', 1500, 2100, 29, 'a:3:{i:0;s:9:\"10488.png\";i:1;s:9:\"73293.png\";i:2;s:9:\"38141.png\";}', 'online', '2023/07/12'),
(22, 5, 5, 5, 7, '0892435', 'SMART ATHLETIC SHOES', 'Whether you\'re walking or jogging, these athletic shoes will keep your feet comfy all day.', 4000, 5000, 25, 'a:3:{i:0;s:9:\"23838.png\";i:1;s:9:\"11384.png\";i:2;s:9:\"63462.png\";}', 'online', '2023/07/12'),
(23, 5, 10, 5, 7, '0405439', '110317062X', 'SKU: 110317062X216036, Color: Tan, Size: 036 037 038 039 040 041', 4000, 4350, 20, 'a:1:{i:0;s:9:\"56316.png\";}', 'online', '2023/07/12'),
(24, 5, 10, 5, 6, '0685432434', '110540090X', 'SKU: 010300116175036, Color: Silver, Size: 36 37 38', 5000, 5690, 5, 'a:2:{i:0;s:9:\"69650.png\";i:1;s:9:\"62435.png\";}', 'online', '2023/07/12'),
(25, 5, 10, 5, 6, '0708755', '141000003X', 'SKU: 056100009153030, Color: Pink, Size: 30 31 32 33 34 35', 2000, 2050, 10, 'a:2:{i:0;s:9:\"77204.png\";i:1;s:9:\"41081.png\";}', 'online', '2023/07/12'),
(26, 5, 11, 5, 6, '01429632', 'Metro-10850185', 'COLOR: RED, MUSTARD, BLACK, SIZE: 06 07 08 09 10 11', 2000, 2079, 12, 'a:2:{i:0;s:9:\"60486.png\";i:1;s:9:\"12927.png\";}', 'online', '2023/07/12'),
(27, 5, 11, 5, 7, '098764', 'Metro-10850198', 'COLOR: MAROON, BLACK, CAREEM, SIZE: 06 07 08 09 10 11', 1500, 1899, 24, 'a:2:{i:0;s:9:\"44672.png\";i:1;s:9:\"10622.png\";}', 'online', '2023/07/12'),
(28, 5, 11, 5, 7, '082305', 'Metro-10700710', 'COLOR: CREAM, BROWN, BLACK, SIZE: 06 07 08', 1500, 1819, 12, 'a:2:{i:0;s:9:\"86677.png\";i:1;s:9:\"50128.png\";}', 'online', '2023/07/12'),
(29, 7, 12, 6, 6, '012593605', 'iPhone 14 Pro Max', 'Space Black, Silver, Gold, Deep Purple, Ceramic Shield front, Textured matte glass back and, stainless steel design', 550000, 559999, 10, 'a:5:{i:0;s:9:\"76115.jpg\";i:1;s:9:\"49484.jpg\";i:2;s:9:\"57519.jpg\";i:3;s:9:\"77501.jpg\";i:4;s:9:\"74145.jpg\";}', 'online', '2023/07/12'),
(30, 7, 12, 6, 6, '0325901431', 'iPhone 14 Plus', '6.7 inches Display, 6 GB RAM, 4323 mAh Battery, 12 MP + 12 MP Back Camera', 450000, 455999, 27, 'a:1:{i:0;s:9:\"68171.png\";}', 'online', '2023/07/12'),
(31, 7, 12, 6, 7, '7123854', 'Apple iPhone 11', '6.1 inches Display, 4 GB RAM, 3110 mAh Battery, 12 MP + 12 MP Back Camera, Colors: Green Purple Black Red Yellow White', 201000, 201999, 23, 'a:1:{i:0;s:9:\"14074.png\";}', 'online', '2023/07/12'),
(32, 7, 13, 6, 7, '02319759730', 'OPPO X2 Pro (CPH2025)', '120Hz QHD+ Ultra Vision Screen\r\nTrue Billion Colour Display, O1 Ultra Vision Engine, Ultra Vision Camera System, 65W SuperVOOC 2.0 Flash Charge, Snapdragon™ 865', 190000, 199999, 32, 'a:2:{i:0;s:9:\"79941.png\";i:1;s:9:\"83726.png\";}', 'online', '2023/07/12'),
(33, 7, 13, 6, 7, '9035654', 'OPPO A16e (CPH2421)', 'Colors Midnight Black Blue * Product pictures are for reference only. Please refer to the actual product. Size and Weight Height: about 164.0mm Width: about 75.4mm', 30000, 39999, 29, 'a:2:{i:0;s:9:\"58377.png\";i:1;s:9:\"56304.png\";}', 'online', '2023/07/12'),
(34, 7, 13, 6, 7, '953923', 'OPPO A57 (CPH2387)', 'OPPO A57 (CPH2387) Colors Glowing Black Glowing Green * Product pictures are for reference only. Please refer to the actual product.', 48000, 48299, 28, 'a:2:{i:0;s:9:\"65616.jpg\";i:1;s:9:\"43656.png\";}', 'online', '2023/07/12'),
(35, 7, 14, 6, 6, '12658534', 'Vivo Y16', 'Vivo Y16 Product Color Stellar Black Drizzling Gold Body Dimensions: 163.95×75.55×8.19mm Weight: 183g Material: Plastic Price Rs. 67,999 Basic Processor Helio P35 RAM 4GB ROM 64GB', 60000, 67999, 28, 'a:3:{i:0;s:9:\"93134.png\";i:1;s:9:\"21960.png\";i:2;s:9:\"39534.png\";}', 'online', '2023/07/12'),
(36, 7, 14, 6, 6, '9832465', 'Vivo Y22', 'Vivo Y22 Product Color Starlit Blue Metaverse Green Body Dimensions: 164.30×76.10×8.38mm Weight: 190g Material: Plastic Price Rs. 69,999 Basic Processor Helio G85 RAM 4GB ROM 64GB', 60000, 69999, 34, 'a:4:{i:0;s:9:\"31368.png\";i:1;s:9:\"33703.png\";i:2;s:9:\"50726.png\";i:3;s:9:\"69534.png\";}', 'online', '2023/07/12'),
(37, 7, 14, 6, 6, '09855335', 'Vivo V25e', 'Vivo V25e Product Color Diamond Black Sunrise Golden Body Dimensions: 159.20×74.20×7.79mm', 100000, 109999, 13, 'a:4:{i:0;s:9:\"55538.png\";i:1;s:9:\"15615.png\";i:2;s:9:\"49863.png\";i:3;s:9:\"49376.png\";}', 'online', '2023/07/12'),
(38, 8, 15, 7, 6, '019385', 'HP Elitebook 830 G5', 'Intel Core i5-8665U 8th Generation | 32GB DDR4 256GB SSD | 13.3″ FHD | Intel UHD Graphics  Dos | Silver | 7 Days Warranty Backlit KB', 70000, 78000, 18, 'a:1:{i:0;s:9:\"99705.jpg\";}', 'online', '2023/07/12'),
(39, 8, 15, 7, 7, '019583', 'HP 11 inch Tablet PC', '11-inch EyeSafe certified display 13 MP adjustable HP GlamCam webcam Kickstand supporting portrait and landscape view Intel Wi-fi 6 + Bluetooth 5', 50000, 55000, 24, 'a:4:{i:0;s:9:\"95136.jpg\";i:1;s:9:\"69258.png\";i:2;s:9:\"62215.png\";i:3;s:9:\"96059.jpg\";}', 'online', '2023/07/12'),
(40, 8, 15, 7, 6, '9053023', 'HP All-in-One 24-df0000d PC', '23.8″ diagonal, FHD (1920 x 1080), touch, IPS, three-sided micro-edge, anti-glare, 250 nits, 72% NTSC', 50000, 60000, 15, 'a:1:{i:0;s:9:\"66178.jpg\";}', 'online', '2023/07/12'),
(41, 8, 16, 7, 7, '9094543', 'Lenovo 13w Yoga (13, AMD)', 'Windows laptops that empower students Affordable and easy to use, these Windows laptops and convertibles for students', 93000, 93999, 25, 'a:2:{i:0;s:9:\"20455.png\";i:1;s:9:\"92943.png\";}', 'online', '2023/07/12'),
(42, 8, 16, 7, 7, '9856745', 'Lenovo Tab M10 Plus Gen 3', 'Binge longer. Study smarter. Portable entertainment tablet that’s great for students, too All-day performance with octa-core CPU and all-day battery life', 95000, 95999, 25, 'a:5:{i:0;s:9:\"69930.png\";i:1;s:9:\"59010.png\";i:2;s:9:\"99699.png\";i:3;s:9:\"39988.png\";i:4;s:9:\"99732.png\";}', 'online', '2023/07/12'),
(43, 8, 16, 7, 7, '9886466', 'Lenovo Yoga Tab 13', 'Ultimate at-home entertainment tablet Intensify your media experience on the Lenovo Yoga Tab 13.', 94000, 95999, 20, 'a:5:{i:0;s:9:\"40040.png\";i:1;s:9:\"91881.png\";i:2;s:9:\"79188.png\";i:3;s:9:\"50016.png\";i:4;s:9:\"81462.png\";}', 'online', '2023/07/12'),
(44, 8, 17, 7, 6, '2349976', 'Legion 7 Gen 7 (16, AMD)', 'Legion 7 Series Laptops Beneath the refined surface of each Legion 7 Series Gaming Laptop lies the processing and graphics power of a beast.', 370000, 379999, 27, 'a:1:{i:0;s:9:\"88097.png\";}', 'online', '2023/07/12'),
(45, 8, 18, 7, 6, '6958565', 'Dell Core i7', 'Dell G15 5530 Core i7 13th Generation 16GB RAM 512GB SSD 8GB RTX 4060 Windows 11\r\nhttps://www.dell.com/en-us/shop/dell-laptops/g15-gaming-laptop/spd/g-series-15-5530-laptop/useghbts5530ggjn', 500000, 509999, 11, 'a:1:{i:0;s:9:\"94887.png\";}', 'online', '2023/07/12'),
(46, 8, 18, 7, 7, '0534352', 'Dell XPS 15 9520 Core i7', 'Dell XPS 15 9520 Core i7 12th Generation 16GB RAM 1TB SSD 4GB RTX 3050Ti Windows 11', 600000, 604999, 21, 'a:1:{i:0;s:9:\"26700.png\";}', 'online', '2023/07/12');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subid` int(255) NOT NULL,
  `catid` int(255) NOT NULL,
  `subname` varchar(255) NOT NULL,
  `subdes` varchar(255) NOT NULL,
  `subdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subid`, `catid`, `subname`, `subdes`, `subdate`) VALUES
(1, 3, 'Audi', 'This is a Audi Car description', '2023/07/11'),
(3, 4, 'Road Prince', 'This is a Road Prince Bike description.', '2023/07/03'),
(5, 5, 'Ndure', 'This is a ndure shoes description.', '2023/07/11'),
(6, 3, 'BMW', 'This is a bmw car description.', '2023/07/11'),
(7, 3, 'Honda', 'This is a Honda car description.', '2023/07/11'),
(8, 4, 'Suzuki', 'This is a Suzuki bike description.', '2023/07/11'),
(9, 4, 'Honda', 'This is a Honda bike description.', '2023/07/11'),
(10, 5, 'ECS', 'This is a ecs shoes description.', '2023/07/11'),
(11, 5, 'Metro', 'This is a Metro shoe description.', '2023/07/11'),
(12, 7, 'IPhone', 'This is a IPhone mobile description.', '2023/07/11'),
(13, 7, 'OPPO', 'This is a oppo mobile description.', '2023/07/11'),
(14, 7, 'Vivo', 'This is a vivo mobile description.', '2023/07/11'),
(15, 8, 'HP', 'This is a hp laptop description.', '2023/07/11'),
(16, 8, 'Lenovo', 'This is a lenovo laptop description.', '2023/07/12'),
(17, 8, 'Legion', 'This is a Legion laptop description.', '2023/07/11'),
(18, 8, 'Dell', 'This is a dell laptop description.', '2023/07/12');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supid` int(255) NOT NULL,
  `supname` varchar(255) NOT NULL,
  `supemail` varchar(255) NOT NULL,
  `supmob` varchar(255) NOT NULL,
  `supdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supid`, `supname`, `supemail`, `supmob`, `supdate`) VALUES
(2, 'Raven Castaneda', 'ryqo@mailinator.com', '+1 (853) 556-7832', '2023/07/05'),
(3, 'Courtney Juarez', 'lydeja@mailinator.com', '+1 (489) 471-5622', '2023/07/05'),
(5, 'Robert Ben', 'jojonuga@mailinator.com', '+1 (365) 111-8445', '2023/07/05'),
(6, 'Nicholas Higgins', 'hiviwa@mailinator.com', '+1 (742) 896-3371', '2023/07/05'),
(7, 'Eugenia Foreman', 'voconytow@mailinator.com', '+1 (272) 883-8754', '2023/07/11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `measure`
--
ALTER TABLE `measure`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `measure`
--
ALTER TABLE `measure`
  MODIFY `mid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
