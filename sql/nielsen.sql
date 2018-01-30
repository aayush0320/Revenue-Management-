-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2017 at 01:38 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nielsen`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_master`
--

CREATE TABLE `activity_master` (
  `Id` int(10) NOT NULL,
  `Day` int(1) NOT NULL,
  `Date` varchar(10) NOT NULL,
  `Time` varchar(10) NOT NULL,
  `Employee_Id` varchar(10) NOT NULL,
  `Proposal_Id` varchar(8) NOT NULL,
  `Mode` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_master`
--

INSERT INTO `activity_master` (`Id`, `Day`, `Date`, `Time`, `Employee_Id`, `Proposal_Id`, `Mode`) VALUES
(5, 2, '16-05-2017', '02:20:42pm', 'INDVA00002', 'IND00002', 'Edit'),
(4, 2, '16-05-2017', '02:20:21pm', 'INDVA00002', 'IND00002', 'New'),
(3, 2, '16-05-2017', '02:19:08pm', 'INDVA00002', 'IND00002', 'Edit'),
(2, 2, '16-05-2017', '02:18:28pm', 'INDVA00002', 'IND00002', 'New'),
(1, 2, '16-05-2017', '02:16:22pm', 'INDVA00002', 'IND00001', 'Edit'),
(0, 2, '16-05-2017', '02:16:00pm', 'INDVA00002', 'IND00001', 'New'),
(6, 2, '16-05-2017', '03:03:54pm', 'USANE00001', 'USA00004', 'New'),
(7, 4, '16/05/2017', '03:08:08pm', 'USANE00001', 'USA00006', 'New'),
(8, 4, '16/05/2017', '05:20:46pm', 'USANE00001', 'USA00004', 'Edit'),
(9, 4, '05-16-2017', '10-50-49pm', 'USANE00001', 'USA00004', 'View'),
(10, 4, '16/05/2017', '05:25:11pm', 'USANE00001', 'USA00004', 'Edit'),
(11, 4, '05-16-2017', '10-56-04pm', 'USANE00001', 'USA00004', 'View'),
(12, 4, '16/05/2017', '05:30:30pm', 'INDVA00002', 'IND00001', 'Edit'),
(13, 4, '17/05/2017', '01:02:43am', 'INDVA00002', 'IND00001', 'Edit'),
(14, 4, '05-17-2017', '06-40-18am', 'INDVA00002', 'IND00001', 'View'),
(15, 4, '05-17-2017', '06-40-24am', 'INDVA00002', 'IND00001', 'View'),
(16, 4, '05-17-2017', '06-51-19am', 'USANE00001', 'IND00002', 'View'),
(17, 4, '17/05/2017', '01:24:27am', 'USANE00001', 'USA00006', 'New'),
(18, 4, '17/05/2017', '01:27:21am', 'INDVA00002', 'IND00007', 'New'),
(19, 4, '17/05/2017', '01:36:47am', 'USANE00001', 'USA00008', 'New'),
(20, 4, '17/05/2017', '01:37:08am', 'USANE00001', 'USA00008', 'Edit');

-- --------------------------------------------------------

--
-- Table structure for table `adhoc_subscription`
--

CREATE TABLE `adhoc_subscription` (
  `Id` varchar(7) NOT NULL,
  `Proposal_Id` varchar(8) NOT NULL,
  `Business_Id` int(3) NOT NULL,
  `Product_Id` int(3) NOT NULL,
  `Service_Id` int(3) NOT NULL,
  `Month_Of_Delivery` varchar(15) DEFAULT NULL,
  `Start_Month` varchar(15) DEFAULT NULL,
  `End_Month` varchar(15) DEFAULT NULL,
  `Frequency` varchar(15) DEFAULT NULL,
  `Revenue` varchar(15) NOT NULL,
  `IsActive` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adhoc_subscription`
--

INSERT INTO `adhoc_subscription` (`Id`, `Proposal_Id`, `Business_Id`, `Product_Id`, `Service_Id`, `Month_Of_Delivery`, `Start_Month`, `End_Month`, `Frequency`, `Revenue`, `IsActive`) VALUES
('2', 'IND00002', 1, 1, 1, 'June', NULL, NULL, NULL, '100000', 1),
('1', 'IND00001', 1, 1, 1, 'January', NULL, NULL, NULL, '100000', 1),
('3', 'USA00006', 1, 1, 1, 'September', NULL, NULL, NULL, '148000', 1),
('4', 'IND00007', 1, 1, 2, NULL, 'January', 'December', 'Quaterly', '360000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `business_master`
--

CREATE TABLE `business_master` (
  `Business_Id` int(3) NOT NULL,
  `Business_Name` varchar(30) NOT NULL,
  `IsActive` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_master`
--

INSERT INTO `business_master` (`Business_Id`, `Business_Name`, `IsActive`) VALUES
(1, 'RMS', 1),
(2, 'AAC-Mix', 1),
(3, 'AAC-Exmix', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_master`
--

CREATE TABLE `client_master` (
  `Client_Id` int(30) NOT NULL,
  `Country_Id` int(3) NOT NULL,
  `Industry_Group` varchar(50) NOT NULL,
  `Client_Name` varchar(50) NOT NULL,
  `Client_Group` varchar(50) NOT NULL,
  `Client_Address` varchar(200) NOT NULL,
  `Client_Office_No` varchar(14) NOT NULL,
  `Client_Personal_No` varchar(14) NOT NULL,
  `Client_Email` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_master`
--

INSERT INTO `client_master` (`Client_Id`, `Country_Id`, `Industry_Group`, `Client_Name`, `Client_Group`, `Client_Address`, `Client_Office_No`, `Client_Personal_No`, `Client_Email`) VALUES
(1, 1, 'Durables', 'TISCO', 'TATA', '												Jamshedpur, India.											', '+919898984466', '+919898984007', 'ratan@TISCO.in'),
(2, 1, 'Media', 'Pure It', 'Hindustan Uniliver', 'Mumbai', '+919878943355', '+919878943355', 'Anjan.sg@unilever.com'),
(3, 4, 'Finance', 'Dongxing Securities', ' China Orient Asset Management', 'Beijing, China', '+868526934411', '+868526934411', 'Ching@dxzq.net'),
(4, 3, 'Auto', 'Tesla Motors', 'Tesla, Inc.', 'Palo Alto, California, U.S.', '+17874736645', '+17874736645', 'elon.musk@tesla.com'),
(5, 7, 'Media', 'Media Prima', 'Media Prima Inc.', 'Kuala Lumpur, Malaysia', '+608547965412', '+608547965412', 'datuk@mediaprima.com'),
(6, 6, 'Durables', 'Euro Tech Holdings', 'Euro Tech Holdings', 'Hong Kong', '+8521457896324', '+8521457896324', 'jesiq@ethc.com'),
(7, 3, 'Auto', 'Lex Luthor', 'Lexcorp', 'Cell - 27, Guantanamo Bay, US', '+1002-248169', '+17418529630', 'iamLex@lexcorp.us');

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

CREATE TABLE `country_master` (
  `Country_Id` int(3) NOT NULL,
  `Region_Id` int(3) NOT NULL,
  `Country_Name` varchar(30) NOT NULL,
  `IsActive` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`Country_Id`, `Region_Id`, `Country_Name`, `IsActive`) VALUES
(4, 3, 'China', 0),
(3, 1, 'USA', 1),
(2, 2, 'Srilanka', 0),
(1, 2, 'India', 1),
(5, 2, 'Bangladesh', 0),
(6, 3, 'Hong Kong', 0),
(7, 1, 'Malaysia', 0),
(8, 2, 'Bhutan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_master`
--

CREATE TABLE `employee_master` (
  `Employee_Id` varchar(10) NOT NULL,
  `Employee_Name` varchar(50) NOT NULL,
  `Country_Id` int(3) NOT NULL,
  `Office_Id` int(3) NOT NULL,
  `Department_Id` varchar(30) NOT NULL,
  `Employee_Designation` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Employee_Dob` varchar(30) NOT NULL,
  `Employee_Contact_No` varchar(14) NOT NULL,
  `Residance_Address` varchar(50) NOT NULL,
  `Creation` varchar(30) NOT NULL,
  `Last_Modified` varchar(30) NOT NULL,
  `IsActive` int(1) NOT NULL,
  `IsMember` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_master`
--

INSERT INTO `employee_master` (`Employee_Id`, `Employee_Name`, `Country_Id`, `Office_Id`, `Department_Id`, `Employee_Designation`, `Email`, `Employee_Dob`, `Employee_Contact_No`, `Residance_Address`, `Creation`, `Last_Modified`, `IsActive`, `IsMember`) VALUES
('INDVA00001', 'Aayush Patel', 1, 1, 'IT', '0', 'aayush.bapu@nielsen.com', '05/08/2017', '+919898195823', 'Fatehgunj, Vadodara.', '07/01/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 2),
('INDVA00002', 'Vishal Chaudhary', 1, 1, 'IT', '1', 'vrcop@nielsen.com', '04/16/2017', '+919418786245', 'Warasiya, Vadodara,India.', '08/01/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 0),
('USANE00001', 'Deep Patel', 3, 5, 'Finance', '1', 'demipat90@nielsen.com', '05/14/2017', '+17874736645', 'Queens, NY.', '06/01/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 0),
('USANE00002', 'Karan Deopura', 3, 5, 'Finance', '0', 'kd1996@nielsen.com', '05/14/2017', '+19419156740', 'Brooklyn, NY', '21/01/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 2),
('ADMIN00007', 'Admin', 3, 5, 'IT', '2', 'admin@nielsen.com', '07/19/1995', '+17874736645', 'Brooklyn,NY', '06/01/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 0),
('INDVA00003', 'Hemant Chetwani', 1, 1, 'IT', '0', 'hemant@gmail.com', '04/02/2017', '+919033733280', 'Warsiya ,Vadodara', '09/01/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 2),
('USANE00003', 'Murtuza Ranapur', 3, 5, 'Finance', '0', 'mranapurwala@yahoo.in', '08/14/1995', '+19408049131', 'Manhattan, NY', '11/02/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 2),
('USANE00004', 'Keyur Rana', 3, 5, 'Finance', '0', 'kdr40196@nielsen.com', '08/23/1995', '+18780925480', 'Queens, NY', '12/02/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 1),
('INDVA00004', 'Jitendra Chaudhary', 1, 1, 'Sales', '0', 'vishal.130410107009@gmail.com', '05/14/2017', '+917473747398', 'Warasiya, Vadodara', '01/02/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 1),
('USANE00005', 'Keyur Soni', 3, 5, 'Sales', '0', 'keyursoni981@gmail.com', '09/18/1995', '+919974554258', 'Brooklyn, NY', '13/02/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 1),
('INDVA00005', 'Rishi Patel', 1, 1, 'IT', '0', 'vishalrcop@gmail.com', '05/01/1995', '+919865986523', 'Vadodara.', '05/02/2017 01:41:40 pm', '16/05/2017 01:41:40 pm', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Employee_Id` varchar(10) NOT NULL,
  `Login_Id` varchar(30) NOT NULL,
  `Password` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Employee_Id`, `Login_Id`, `Password`) VALUES
('ADMIN00007', 'ADMIN00007', 'b09c600fddc573f117449b3723f23d64'),
('INDVA00001', 'INDVA00001', 'bfa99df33b137bc8fb5f5407d7e58da8'),
('INDVA00002', 'INDVA00002', 'bfa99df33b137bc8fb5f5407d7e58da8'),
('USANE00001', 'USANE00001', 'f41b836dcac75d33985a7332de79d01f'),
('USANE00002', 'USANE00002', 'bfa99df33b137bc8fb5f5407d7e58da8'),
('INDVA00003', 'INDVA00003', 'bfa99df33b137bc8fb5f5407d7e58da8'),
('USANE00003', 'USANE00003', 'bfa99df33b137bc8fb5f5407d7e58da8'),
('USANE00004', 'USANE00004', 'bfa99df33b137bc8fb5f5407d7e58da8'),
('INDVA00004', 'INDVA00004', 'a423542e1d6c28a1f866e3ef3be62515'),
('USANE00005', 'USANE00005', '07ed044f387ed6c5a6f921cef48229f9'),
('INDVA00005', 'INDVA00005', 'ae56b1d1232a3a0fd5ae15e664d594f1');

-- --------------------------------------------------------

--
-- Table structure for table `office_master`
--

CREATE TABLE `office_master` (
  `Office_Id` int(3) NOT NULL,
  `Country_Id` int(3) NOT NULL,
  `Office_Name` varchar(50) NOT NULL,
  `Zone` varchar(5) NOT NULL,
  `Office_Address` varchar(50) NOT NULL,
  `IsActive` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office_master`
--

INSERT INTO `office_master` (`Office_Id`, `Country_Id`, `Office_Name`, `Zone`, `Office_Address`, `IsActive`) VALUES
(1, 1, 'Vadodara Quarter', 'West', 'Ellora Park, Vadodara', 1),
(2, 4, 'Beijing HQ', 'East', 'Beijing', 0),
(3, 4, 'Shanghai Quarter', 'North', 'Shanghai', 0),
(4, 1, 'Chennai HQ', 'South', 'Chennai', 1),
(5, 3, 'New York', 'East', 'Brooklyn, NY', 1),
(6, 6, 'Hong Kong HQ', 'West', 'Hong kong', 0),
(7, 7, 'Singapore HQ', 'South', 'Singapore', 0),
(8, 8, 'north bhutan ', 'North', 'bhutan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `onetime_track`
--

CREATE TABLE `onetime_track` (
  `Id` varchar(7) NOT NULL,
  `Proposal_Id` varchar(8) NOT NULL,
  `Business_Id` int(3) NOT NULL,
  `Product_Id` int(3) NOT NULL,
  `Service_Id` int(3) NOT NULL,
  `Month_Of_Delivery` varchar(15) DEFAULT NULL,
  `Start_Date` varchar(25) DEFAULT NULL,
  `End_Date` varchar(25) DEFAULT NULL,
  `Frequency` varchar(15) DEFAULT NULL,
  `Number_Of_Store` varchar(5) NOT NULL,
  `Revenue_Per_Store` varchar(10) NOT NULL,
  `Total_Revenue` varchar(10) NOT NULL,
  `IsActive` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `onetime_track`
--

INSERT INTO `onetime_track` (`Id`, `Proposal_Id`, `Business_Id`, `Product_Id`, `Service_Id`, `Month_Of_Delivery`, `Start_Date`, `End_Date`, `Frequency`, `Number_Of_Store`, `Revenue_Per_Store`, `Total_Revenue`, `IsActive`) VALUES
('2', 'IND00002', 2, 10, 19, 'June', NULL, NULL, NULL, '10', '10000', '100000', 1),
('1', 'IND00001', 2, 10, 19, 'January', NULL, NULL, NULL, '10', '120000', '1200000', 1),
('3', 'USA00003', 1, 4, 7, 'June', NULL, NULL, NULL, '146', '1200', '175200', 1),
('4', 'USA00004', 1, 4, 7, 'June', NULL, NULL, NULL, '146', '1200', '175200', 1),
('5', 'USA00005', 1, 4, 7, 'June', NULL, NULL, NULL, '146', '1200', '175200', 1),
('6', 'USA00004', 2, 10, 20, NULL, '06/01/2017', '12/31/2017', 'Monthly', '15', '1800', '27000', 1),
('7', 'IND00007', 2, 10, 19, 'September', NULL, NULL, NULL, '88', '1500', '132000', 1),
('8', 'USA00008', 2, 10, 19, 'October', NULL, NULL, NULL, '10', '1200', '12000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `Product_Id` int(3) NOT NULL,
  `Business_Id` int(3) NOT NULL,
  `Product_Name` varchar(40) NOT NULL,
  `IsActive` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`Product_Id`, `Business_Id`, `Product_Name`, `IsActive`) VALUES
(1, 1, 'Retail Index', 1),
(2, 1, 'SO/NSO', 1),
(3, 1, 'CLSP', 1),
(4, 1, 'TD', 1),
(5, 1, 'DCR', 1),
(6, 1, 'Scan Track', 1),
(7, 1, 'MT', 1),
(8, 1, 'Cash & Carry', 1),
(9, 1, 'E Comm', 1),
(10, 2, 'Custom', 1),
(11, 2, 'On Reach', 1),
(12, 3, 'Custom', 1),
(13, 3, 'On Reach', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_master`
--

CREATE TABLE `proposal_master` (
  `Proposal_Id` varchar(8) NOT NULL,
  `Project_Name` varchar(30) NOT NULL,
  `CS_Executive_Id` varchar(10) NOT NULL,
  `Team_Name` varchar(30) NOT NULL,
  `Team_Leader_Id` varchar(10) NOT NULL,
  `Zone` varchar(10) NOT NULL,
  `Client_Name` varchar(30) NOT NULL,
  `Client_Group` varchar(30) NOT NULL,
  `Industry_Group` varchar(30) NOT NULL,
  `Probability` int(3) NOT NULL,
  `Proposal_Status` varchar(30) NOT NULL,
  `EOA` varchar(50) DEFAULT NULL,
  `IsActive` int(1) NOT NULL,
  `Created` varchar(25) NOT NULL,
  `Approved` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal_master`
--

INSERT INTO `proposal_master` (`Proposal_Id`, `Project_Name`, `CS_Executive_Id`, `Team_Name`, `Team_Leader_Id`, `Zone`, `Client_Name`, `Client_Group`, `Industry_Group`, `Probability`, `Proposal_Status`, `EOA`, `IsActive`, `Created`, `Approved`) VALUES
('IND00002', 'Rovio', 'INDVA00002', 'Bourdeax', 'INDVA00001', 'West', 'Media Prima', 'Media Prima Inc.', 'Media', 30, 'In-progress', 'NULL', 1, '11/01/2017 02:20:21pm', 'NULL'),
('IND00001', 'Supercell', 'INDVA00002', 'Aspire', 'INDVA00004', 'West', 'Media Prima', 'Media Prima Inc.', 'Media', 100, 'Complete', 'IND00001.jpg', 1, '01/01/2017 02:16:00pm', '03/01/2017 01:02:43am'),
('USA00003', 'Tesla Spark', 'USANE00001', 'Davaj', 'USANE00003', 'East', 'Tesla Motors', 'Tesla, Inc.', 'Auto', 20, 'In-progress', 'NULL', 1, '16/03/2017 03:00:00 pm', 'NULL'),
('USA00004', 'Tesla Sparky', 'USANE00001', 'Defiant', 'USANE00002', 'East', 'Tesla Motors', 'Tesla, Inc.', 'Auto', 40, 'In-progress', 'NULL', 1, '16/04/2017 03:03:54pm', 'NULL'),
('USA00005', 'Tesla Nxg', 'USANE00001', 'Defiant', 'USANE00002', 'East', 'Tesla Motors', 'Tesla, Inc.', 'Auto', 10, 'In-progress', 'NULL', 1, '16/04/2017 03:06:50 pm', 'NULL'),
('USA00006', 'Digital Sales', 'USANE00001', 'Defiant', 'USANE00002', 'East', 'Euro Tech Holdings', 'Euro Tech Holdings', 'Durables', 20, 'Cancelled', 'NULL', 1, '17/05/2017 01:24:27am', 'NULL'),
('IND00007', 'Hasbro', 'INDVA00002', 'Aspire', 'INDVA00004', 'West', 'Lex Luthor', 'Lexcorp', 'Auto', 40, 'In-progress', 'NULL', 1, '17/02/2017 01:27:21am', 'NULL'),
('USA00008', 'Digital Sales Copy', 'USANE00001', 'Defiant', 'USANE00002', 'East', 'Euro Tech Holdings', 'Euro Tech Holdings', 'Durables', 30, 'In-progress', 'NULL', 1, '17/05/2017 01:36:47am', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `region_master`
--

CREATE TABLE `region_master` (
  `Region_Id` int(2) NOT NULL,
  `Region_Name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region_master`
--

INSERT INTO `region_master` (`Region_Id`, `Region_Name`) VALUES
(1, 'SEANAP'),
(2, 'Greater India'),
(3, 'Greater China');

-- --------------------------------------------------------

--
-- Table structure for table `service_master`
--

CREATE TABLE `service_master` (
  `Service_Id` int(5) NOT NULL,
  `Product_Id` int(3) NOT NULL,
  `Service_Name` varchar(30) NOT NULL,
  `IsActive` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_master`
--

INSERT INTO `service_master` (`Service_Id`, `Product_Id`, `Service_Name`, `IsActive`) VALUES
(1, 1, 'Adhoc', 1),
(2, 1, 'Subscription', 1),
(3, 2, 'OneTime', 1),
(4, 2, 'Track', 1),
(5, 3, 'OneTime', 1),
(6, 3, 'Track', 1),
(7, 4, 'OneTime', 1),
(8, 4, 'Track', 1),
(9, 5, 'Adhoc', 1),
(10, 5, 'Subscription', 1),
(11, 6, 'Adhoc', 1),
(12, 6, 'Subscription', 1),
(13, 7, 'Adhoc', 1),
(14, 7, 'Subscription', 1),
(15, 8, 'Adhoc', 1),
(16, 8, 'Subscription', 1),
(17, 9, 'Adhoc', 1),
(18, 9, 'Subscription', 1),
(19, 10, 'OneTime', 1),
(20, 10, 'Track', 1),
(21, 11, 'OneTime', 1),
(22, 11, 'Track', 1),
(23, 12, 'OneTime', 1),
(24, 12, 'Track', 1),
(25, 13, 'OneTime', 1),
(26, 13, 'Track', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_master`
--

CREATE TABLE `team_master` (
  `Team_Name` varchar(30) NOT NULL,
  `Country_Id` int(3) NOT NULL,
  `Office_Id` int(3) NOT NULL,
  `CS_Executive_Id` varchar(10) NOT NULL,
  `Team_Leader_Id` varchar(10) NOT NULL,
  `Role` int(1) NOT NULL,
  `IsActive` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_master`
--

INSERT INTO `team_master` (`Team_Name`, `Country_Id`, `Office_Id`, `CS_Executive_Id`, `Team_Leader_Id`, `Role`, `IsActive`) VALUES
('Aspire', 1, 1, 'INDVA00002', 'INDVA00004', 0, 1),
('Davaj', 3, 5, 'USANE00001', 'USANE00003', 0, 1),
('Bourdeax', 1, 1, 'INDVA00002', 'INDVA00001', 0, 1),
('Defiant', 3, 5, 'USANE00001', 'USANE00002', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_member_master`
--

CREATE TABLE `team_member_master` (
  `Id` int(7) NOT NULL,
  `Team_Name` varchar(30) NOT NULL,
  `Team_Member_Id` varchar(10) NOT NULL,
  `Role` int(1) NOT NULL,
  `IsActive` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_member_master`
--

INSERT INTO `team_member_master` (`Id`, `Team_Name`, `Team_Member_Id`, `Role`, `IsActive`) VALUES
(7, 'Aspire', 'INDVA00003', 1, 1),
(6, 'Aspire', 'INDVA00001', 1, 1),
(5, 'Davaj', 'USANE00002', 1, 1),
(4, 'Davaj', 'USANE00005', 0, 1),
(3, 'Bourdeax', 'INDVA00005', 0, 1),
(2, 'Bourdeax', 'INDVA00003', 0, 1),
(1, 'Defiant', 'USANE00004', 0, 1),
(0, 'Defiant', 'USANE00003', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_master`
--
ALTER TABLE `activity_master`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `adhoc_subscription`
--
ALTER TABLE `adhoc_subscription`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `business_master`
--
ALTER TABLE `business_master`
  ADD PRIMARY KEY (`Business_Id`);

--
-- Indexes for table `client_master`
--
ALTER TABLE `client_master`
  ADD PRIMARY KEY (`Client_Id`);

--
-- Indexes for table `country_master`
--
ALTER TABLE `country_master`
  ADD PRIMARY KEY (`Country_Id`);

--
-- Indexes for table `employee_master`
--
ALTER TABLE `employee_master`
  ADD PRIMARY KEY (`Employee_Id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Login_Id`);

--
-- Indexes for table `office_master`
--
ALTER TABLE `office_master`
  ADD PRIMARY KEY (`Office_Id`);

--
-- Indexes for table `onetime_track`
--
ALTER TABLE `onetime_track`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indexes for table `proposal_master`
--
ALTER TABLE `proposal_master`
  ADD PRIMARY KEY (`Proposal_Id`);

--
-- Indexes for table `region_master`
--
ALTER TABLE `region_master`
  ADD PRIMARY KEY (`Region_Id`);

--
-- Indexes for table `service_master`
--
ALTER TABLE `service_master`
  ADD PRIMARY KEY (`Service_Id`);

--
-- Indexes for table `team_master`
--
ALTER TABLE `team_master`
  ADD PRIMARY KEY (`Team_Name`);

--
-- Indexes for table `team_member_master`
--
ALTER TABLE `team_member_master`
  ADD PRIMARY KEY (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
