-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 05:42 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopotop`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `Delivery_ID` int(11) NOT NULL,
  `Delivery_Name` text NOT NULL,
  `Delivery_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`Delivery_ID`, `Delivery_Name`, `Delivery_Price`) VALUES
(1, 'EMS', 200),
(2, 'ธรรมดา', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordersales`
--

CREATE TABLE `ordersales` (
  `Ordersales_ID` int(11) NOT NULL,
  `Delivery_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Ordersales_address` text NOT NULL,
  `Ordersales_Totalprice` int(11) NOT NULL,
  `Ordersales_Day` date NOT NULL,
  `Ordersales_Status` text NOT NULL,
  `ordersales_Paymentstatus` text DEFAULT NULL,
  `ordersales_DayPayment` date DEFAULT NULL,
  `ordersales_ Amountmoney` int(11) DEFAULT NULL,
  `ordersales_Photopayment` text DEFAULT NULL,
  `ordersales_Packagenumber` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordersales`
--

INSERT INTO `ordersales` (`Ordersales_ID`, `Delivery_ID`, `User_ID`, `Ordersales_address`, `Ordersales_Totalprice`, `Ordersales_Day`, `Ordersales_Status`, `ordersales_Paymentstatus`, `ordersales_DayPayment`, `ordersales_ Amountmoney`, `ordersales_Photopayment`, `ordersales_Packagenumber`) VALUES
(1, 1, 10, 'dsafsadfsdaf', 1512, '2020-11-08', 'กำลังจัดส่งสินค้า', 'โอนเงิน', '2020-11-08', 1512, '9112308708727.png', '111111111111111111111'),
(4, 1, 10, 'ศุภชัย แจ้งอรุณ<br><br>เบอร์โทรติดต่อ  0970562607', 2544, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(5, 1, 10, 'ศุภชัย แจ้งอรุณ<br>  <br>เบอร์โทรติดต่อ  0970562607', 2433, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(6, 1, 10, 'ศุภชัย แจ้งอรุณ<br>  <br>เบอร์โทรติดต่อ  0970562607', 2433, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(7, 1, 10, 'ศุภชัย แจ้งอรุณ<br>  <br>เบอร์โทรติดต่อ  0970562607', 2433, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(8, 1, 10, 'ศุภชัย แจ้งอรุณ<br>  <br>เบอร์โทรติดต่อ  0970562607', 1512, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(9, 1, 10, 'ศุภชัย แจ้งอรุณ<br> ที่อยู่  ศุภชัยแจ้งอรุณ 6030202766  หอพ  ตำบล  คลองตำหรุ อำเภอ  เมืองชลบุรี\r\nจังหวัด  ชลบุรี รหัสไปรษณีย์ 20000 <br>เบอร์โทรติดต่อ  0970562607', 1512, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, 'ศุภชัย แจ้งอรุณ<br> ที่อยู่  ศุภชัยแจ้งอรุณ 6030202766  หอพ  ตำบล  คลองตำหรุ อำเภอ  เมืองชลบุรี\r\nจังหวัด  ชลบุรี รหัสไปรษณีย์ 20000 <br>เบอร์โทรติดต่อ  0970562607', 1512, '2020-11-08', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(11, 1, 10, 'ศุภชัย แจ้งอรุณ<br> ที่อยู่  ศุภชัยแจ้งอรุณ 6030202766  หอพักนิสิตชาย 1 ห้อง 1518 มหาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา 199/1 ม.6  ตำบล  วัดโสมนัส อำเภอ  ป้อมปราบศัตรูพ่าย\r\nจังหวัด  ชลบุรี รหัสไปรษณีย์ 10100 <br>เบอร์โทรติดต่อ  0970562607', 434, '2020-11-10', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(12, 1, 10, 'ศุภชัย แจ้งอรุณ<br> ที่อยู่  ศุภชัยแจ้งอรุณ 6030202766  หอพักนิสิตชาย 1 ห้อง 1518 มหาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา 199/1 ม.6  ตำบล  บึง อำเภอ  ศรีราชา\r\nจังหวัด  ชลบุรี รหัสไปรษณีย์ 20230 <br>เบอร์โทรติดต่อ  0970562607', 1512, '2020-11-17', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(13, 2, 10, 'ศุภชัย แจ้งอรุณ<br> ที่อยู่  ศุภชัยแจ้งอรุณ 6030202766  หอพักนิสิตชาย 1 ห้อง 1518 มหาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา 199/1 ม.6  ตำบล  บึง อำเภอ  ศรีราชา\r\nจังหวัด  ชลบุรี รหัสไปรษณีย์ 20230 <br>เบอร์โทรติดต่อ  0970562607', 4469, '2020-11-18', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL),
(14, 2, 10, 'ศุภชัย แจ้งอรุณ<br> ที่อยู่  ศุภชัยแจ้งอรุณ 6030202766  หอพักนิสิตชาย 1 ห้อง 1518 มหาลัยเกษตรศาสตร์ วิทยาเขตศรีราชา 199/1 ม.6  ตำบล  บึง อำเภอ  ศรีราชา\r\nจังหวัด  ชลบุรี รหัสไปรษณีย์ 20230 <br>เบอร์โทรติดต่อ  0970562607', 650, '2020-11-18', 'รอการชำระเงิน', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordersalesdetail`
--

CREATE TABLE `ordersalesdetail` (
  `ordersalesDetail_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `ordersalesDetail_unit` int(11) NOT NULL,
  `ordersalesdetailWarrantyday` int(11) DEFAULT NULL,
  `ordersalesdetail_ price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordersalesdetail`
--

INSERT INTO `ordersalesdetail` (`ordersalesDetail_ID`, `product_ID`, `ordersalesDetail_unit`, `ordersalesdetailWarrantyday`, `ordersalesdetail_ price`) VALUES
(1, 67, 1, 12, 1312),
(4, 70, 1, 12, 2344),
(5, 68, 1, 12, 2233),
(8, 67, 1, 12, 1312),
(11, 72, 1, 12, 234),
(12, 67, 1, 12, 1312),
(13, 70, 1, 12, 600),
(13, 103, 1, 12, 1200),
(13, 104, 1, 12, 650),
(13, 106, 1, 12, 359),
(13, 107, 1, 12, 180),
(13, 108, 1, 12, 180),
(13, 109, 1, 12, 150),
(13, 110, 1, 12, 150),
(14, 104, 1, 12, 650);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL,
  `Type_ID` int(11) NOT NULL,
  `Product_Name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 DEFAULT NULL,
  `Product_Details` text DEFAULT NULL,
  `Product_Price` float(11,2) DEFAULT NULL,
  `Product_Balance` int(11) DEFAULT NULL,
  `Product_Photo` text DEFAULT NULL,
  `date_save` date DEFAULT NULL,
  `Warranty_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Type_ID`, `Product_Name`, `Product_Details`, `Product_Price`, `Product_Balance`, `Product_Photo`, `date_save`, `Warranty_ID`) VALUES
(67, 68, 'เสือ พื้นเมือง ทอเครื่อง (ชาย)', 'เสื้อ พื้นเมือง (ชาย) ทอเครื่อง ด้วยกระดุมเหรียญ ทำลายด้วยเส้นดาย ที่ปักเป็นลวดลาย บนเสื้อ รับรองคุณภาพโดย ศูนย์ โอทอป เชียงใหม่\r\nจังหวัด : เชียงใหม่', 1000.00, 300, '9117245838951.jpg', '2020-11-18', 4),
(68, 68, 'เสื้อระบาย', 'เสื้อระบาย ออกแบบให้แขนเสื้อ และคอเสื้อมีระบาย ตกต่างลายผ้าเป็นลายลูกไม้ต่างๆ ทำให้สวมใส่สบาย ไม่ร้อน เหมาะกับฤดูร้อน รับรองคุณภาพโดย สินค้า โอทอป เชียงใหม่\r\nจังหวัด : เชียงใหม่', 490.00, 300, '9117245302152.jpg', '2020-11-18', 4),
(70, 68, 'เสื้อ ผ้าฝ้าย ถักทอมือ', 'เสื้อ ผ้าฝ้าย จะเป็นผ้าฝ้าย แบบถัก เพื่อให้ได้เส้นใยฝ้าย แบบหนา เหมือนเชือกเล็กๆ และนำมาทอมือ ให้เป็นผืน แล้วนำมาย้อมสี จากธรรมชาติ พร้อมยังผ่านกรรมวิธี ทำให้ผ้านิ่ม ก่อนนำมาตัดชุด และถักเป็นลวดลาย รับรองคุณภาพโดย ศูนย์ โอทอป เชียงใหม่\r\nจังหวัด : เชียงใหม่\r\n', 600.00, 299, '9117245040821.jpg', '2020-11-18', 4),
(72, 68, 'ผ้าสไบไหมแพรวา', 'ผ้าคุมไหล่สไบไหมแพรวา ภูมิปัญญาผู้ไท\r\nจังหวัด : กาฬสินธุ์', 1500.00, 15, '9117246401057.jpg', '2020-11-18', 4),
(103, 64, 'หมอนอิง -ผ้าทอไทยลื้อ', 'หมอนอิง รูปทรงทันสมัย ทำจากผ้าทอไทลื้อบ้านหาดบ้าย แต่งลายเด็กชาย หญิงและแถบผ้าทอสวยๆ ฟิกสีเรียบร้อย รับประกันสีไม่ตก ลวดลายสวยงาม ทอแน่น สีสวยเรียบร้อย เย็นสบายตา เย็บแน่นแข็งแรง มี2ขนาด', 1200.00, 29, '9117248035920.jpg', '2020-11-18', 4),
(104, 63, 'ครกหูหิ้ว', 'ครก เป็นอุปกรณ์เครื่องครัวของคนไทยตั้งแต่สมัยโบราณ อันเกิดจากภูมิปัญญาพื้นบ้าน ซึ่งจังหวัดตากมีแหล่งหินแกรนิตเนื้อแข็งคุณภาพดี นำมาแปรรูปเป็นครก จึงได้ครกคุณภาพดีแข็งแรงทนทาน มีอายุการใช้งานยาวนาน คุ้มค่าสวยงามน่าใช้ ถูกใจครัวเรือน เหมาะเป็นของขวัญในทุกเทศกาล', 650.00, 98, '9117248745677.jpg', '2020-11-18', 4),
(105, 64, 'พวงกุญแจ', 'พวงกุญแจสวยๆมาแล้วจ้าา...\r\nจังหวัด : เชียงราย', 120.00, 100, '9117250787046.jpg', '2020-11-18', 4),
(106, 64, 'ข้องมหาเสน่ห์', 'เป็นงานจักสานจากไม้ไผ่ผสมผักตบชวาตกแต่งลวดลายสวยงามทันสมัย', 359.00, 39, '9117251769402.jpg', '2020-11-18', 4),
(107, 62, 'สบู่ทำความสะอาดผิวหน้า ภูโคลน', 'สบู่ทำความสะอาดผิวหน้า ภูโคลน PHU KLON MINERAL MUD CLEANSING BAR เพื่อผิวพรรณเนียนนุ่ม สะอาดสดใส ด้วยคุณค่าแร่ธาตุหลักจากโคลนธรรมชาติ, วิตามินอี และสารสกัดจากธรรมชาติสามารถขจัดความมันส่วนเกินคราบเครื่องสำอาง สิ่งสกปรก ที่ติดตามรูขุมขน อันเป็นสาเหตุที่ทำให้เกิดสิวเสี้ยนริ้วรอยหมองคล้ำ อีกทั้งส่วนประกอบ ของแร่ธาตุที่สำคัญในโคลน ยังเป็นอาหารบำรุงเซลล์ผิว ช่วยกระตุ้นให้เซลล์ผิว ทำงาน อย่างมีประสิทธิภาพ เพิ่มความสดชื่น และผ่อนคลายด้วยกลิ่นหอม จากน้ำมันหอมระเหย ส้ม, น้ำผึ้งธรรมชาติ, ผลไม้แคนเบอรี่', 180.00, 99, '9117253795799.jpg', '2020-11-18', 4),
(108, 62, 'ครีมพอกหน้าเปลือกกล้วยไข่', 'มาร์คหน้าจากเปลือกกล้วยไข่ ผสมผสานสมุนไพรหลายชนิด ช่วยยกกระชับ ลดเลือนริ้วรอย สิวอักเสป ผิวแพ้เคมี เพียงผสมน้ำแล้วพอกหน้าเป็นประจำ', 180.00, 99, '9117254179495.jpg', '2020-11-18', 4),
(109, 62, 'บาล์มลูกหมู (ทิวาพัชร) อ.ธาตุพนม', 'บาล์มลูกหมู (ทิวาพัชร) เป็นบาล์มเอนกประสงค์ที่มีส่วนผสมของหญ้าเอ็นยืด และเสลดพังพอน บรรเทาอาการผดผื่นคันตุ่มแพ้จากพิษแมลง บำรุงผิว มีขนาด 15g', 150.00, 29, '9117254647774.jpg', '2020-11-18', 4),
(110, 62, 'สบู่รังไหมทองคำ&คอลลาเจน (บ้านสวนสมุนไพรนวลจันทร์)', 'สบู่บำรุงผิวหน้าและผิวกาย ผสานคุณค่าจากน้ำผึ้งและโปรตีนไหม ให้ผิวเนียนนุ่มประดุจแพรไหม', 150.00, 29, '9117255069163.jpg', '2020-11-18', 4);

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `Type_ID` int(11) NOT NULL,
  `Type_Name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`Type_ID`, `Type_Name`) VALUES
(62, 'สมุนไพร'),
(63, 'ของใช้'),
(64, 'ของประดิษฐ์'),
(68, 'เสื้อผ้า เครื่องแต่งกาย');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `User_Username` varchar(30) DEFAULT NULL,
  `User_Password` varchar(255) DEFAULT NULL,
  `User_Firstname` varchar(60) DEFAULT NULL,
  `User_Lastname` varchar(60) DEFAULT NULL,
  `User_Telephonenumber` varchar(20) DEFAULT NULL,
  `User_Email` varchar(100) DEFAULT NULL,
  `User_Photo` text DEFAULT 'profile.png',
  `User_Createdate` date DEFAULT NULL,
  `User_Type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Username`, `User_Password`, `User_Firstname`, `User_Lastname`, `User_Telephonenumber`, `User_Email`, `User_Photo`, `User_Createdate`, `User_Type`) VALUES
(10, 'user', '$2y$10$ek22gPqcxicPyhmoT.OKqekBPTkD7b1L8AWCqyNXqBJwhvlLqjw72', 'ศุภชัย', 'แจ้งอรุณ', '0970562607', 'agileza_555@hotmail.com', '9104339038096.png', '2020-02-23', 'admin'),
(20, 'Peawza', '$2y$10$wRFnMBVUYWDXpO39APdh9up9yWEFgMqHuGvGQ.7nn9/EI4uWKllWe', 'ศุภชัย', 'แจ้งอรุณ', '0970562607', 'agileza_555@hotmail.com', 'profile.png', '2020-04-11', 'user'),
(21, 'user2', '$2y$10$NLLc9BSIOFkHfu/Yl39V2.4sdP6acJ1T82OLP4Mb9x5z/Hki7OXtm', 'ศุภชัย', 'แจ้งอรุณ', '0970562607', 'agileza_555@hotmail.com', 'profile.png', '2020-04-11', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

CREATE TABLE `warranty` (
  `Warranty_ID` int(11) NOT NULL,
  `Warranty_Name` text NOT NULL,
  `Warranty_Day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`Warranty_ID`, `Warranty_Name`, `Warranty_Day`) VALUES
(2, 'ฟฟฟฟฟ', 7),
(4, 'aaaaaa', 12),
(5, 'aaas', 312),
(6, 'asdas', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Delivery_ID`);

--
-- Indexes for table `ordersales`
--
ALTER TABLE `ordersales`
  ADD PRIMARY KEY (`Ordersales_ID`),
  ADD KEY `Delivery_ID` (`Delivery_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `ordersalesdetail`
--
ALTER TABLE `ordersalesdetail`
  ADD PRIMARY KEY (`ordersalesDetail_ID`,`product_ID`) USING BTREE,
  ADD KEY `product_ID` (`product_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Type_ID` (`Type_ID`) USING BTREE,
  ADD KEY `Warranty_ID` (`Warranty_ID`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`Type_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`Warranty_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `Delivery_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `Type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `Warranty_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordersales`
--
ALTER TABLE `ordersales`
  ADD CONSTRAINT `ordersales_ibfk_2` FOREIGN KEY (`Delivery_ID`) REFERENCES `delivery` (`Delivery_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordersales_ibfk_3` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `ordersalesdetail`
--
ALTER TABLE `ordersalesdetail`
  ADD CONSTRAINT `ordersalesdetail` FOREIGN KEY (`ordersalesDetail_ID`) REFERENCES `ordersales` (`Ordersales_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product_ID`) REFERENCES `product` (`Product_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Warranty_ID` FOREIGN KEY (`Warranty_ID`) REFERENCES `warranty` (`Warranty_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Type_ID`) REFERENCES `producttype` (`Type_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
