-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2018 at 12:22 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ozzfitne_oz`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership_temp`
--

CREATE TABLE `membership_temp` (
  `mt_id` int(11) NOT NULL,
  `paymenttype` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `duration` int(11) NOT NULL,
  `amountpaid` double NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `timein` time NOT NULL,
  `timeout` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `custinfo_id`, `timein`, `timeout`, `date`) VALUES
(1, 20019, '10:23:07', '00:00:00', '2017-12-02'),
(2, 20019, '22:20:08', '00:00:00', '2017-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `bank_id` int(11) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `accnum` varchar(100) NOT NULL,
  `accname` varchar(100) NOT NULL,
  `bankbalance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_id`, `bankname`, `accnum`, `accname`, `bankbalance`) VALUES
(1, 'EastWest Bank', '123456789', 'Ozz Fitness', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bmi`
--

CREATE TABLE `tbl_bmi` (
  `bmi_id` int(11) NOT NULL,
  `height` float NOT NULL,
  `weight` int(11) NOT NULL,
  `bmi` float NOT NULL,
  `goal` varchar(255) NOT NULL,
  `weeklygoal` varchar(255) NOT NULL,
  `howactiveareyou` varchar(255) NOT NULL,
  `netcalories` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bmi`
--

INSERT INTO `tbl_bmi` (`bmi_id`, `height`, `weight`, `bmi`, `goal`, `weeklygoal`, `howactiveareyou`, `netcalories`, `custinfo_id`) VALUES
(4, 160, 100, 39.0625, 'loseweight', 'lose 1 kilogram per week', 'not active', 1528, 20019),
(5, 160, 57, 22.2656, 'loseweight', 'lose 1 kilogram per week', 'lightly active', 926, 20018);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_breakfast`
--

CREATE TABLE `tbl_breakfast` (
  `breakfast_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `timeconsumed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_breakfast`
--

INSERT INTO `tbl_breakfast` (`breakfast_id`, `custinfo_id`, `food_id`, `quantity`, `timeconsumed`) VALUES
(1, 20018, 1, 1, '2017-12-01 00:00:00'),
(2, 20018, 9, 1, '2017-12-01 00:00:00'),
(3, 20019, 36, 5, '2017-12-01 00:00:00'),
(4, 20019, 33, 1, '2017-12-01 00:00:00'),
(5, 20018, 2, 1, '2017-12-19 00:00:00'),
(6, 20018, 1, 1, '2017-12-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_classes`
--

CREATE TABLE `tbl_classes` (
  `ClassID` int(11) NOT NULL,
  `ClassName` varchar(100) NOT NULL,
  `ClassImage` varchar(100) NOT NULL,
  `ClassSize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_classes`
--

INSERT INTO `tbl_classes` (`ClassID`, `ClassName`, `ClassImage`, `ClassSize`) VALUES
(1, 'Zumba', 'treadmill.png', 20),
(2, 'Yoga', 'treadmill.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_reservation`
--

CREATE TABLE `tbl_class_reservation` (
  `classreserve_id` int(11) NOT NULL,
  `programclass_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datereserved` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class_reservation`
--

INSERT INTO `tbl_class_reservation` (`classreserve_id`, `programclass_id`, `user_id`, `datereserved`) VALUES
(3, 3, 20018, '2017-12-01 21:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custinfo`
--

CREATE TABLE `tbl_custinfo` (
  `custinfo_id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `mname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `profilepic` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `nationality` varchar(200) NOT NULL,
  `dateofbirth` varchar(200) NOT NULL,
  `placeofbirth` varchar(200) NOT NULL,
  `homeaddress` varchar(200) NOT NULL,
  `businessname` varchar(200) NOT NULL,
  `businessaddress` varchar(200) NOT NULL,
  `emergencyperson` varchar(200) NOT NULL,
  `EPnumber` varchar(20) NOT NULL,
  `addressphone` varchar(200) NOT NULL,
  `HSI` varchar(200) NOT NULL,
  `clubs` varchar(200) NOT NULL,
  `howdiduknow` varchar(200) NOT NULL,
  `commentsnotes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_custinfo`
--

INSERT INTO `tbl_custinfo` (`custinfo_id`, `fname`, `mname`, `lname`, `email`, `profilepic`, `gender`, `status`, `nationality`, `dateofbirth`, `placeofbirth`, `homeaddress`, `businessname`, `businessaddress`, `emergencyperson`, `EPnumber`, `addressphone`, `HSI`, `clubs`, `howdiduknow`, `commentsnotes`) VALUES
(0, ' ', ' ', ' ', ' ', ' ', ' ', 'Married', 'Chinese', '1997-06-23', 'Makati, Phils', 'Unit 11A Vista Aldea Bldg., Mapayapa Village 1, Pasong Tamo, Qc', '', '', 'Liza Sy', '09876787654', '09154449799', 'Not sure', 'CSO, SITE, JPCS', ' ', ' '),
(20018, 'Veronica Eivee', 'Bua', 'Nitor', 'veronica@gmail.com', 'pp.jpg', 'Female', 'Single', 'Filipino', '1998-12-29', 'Pampanga', 'North Olympus Subdivision', 'Manijer Balut', 'Manijer Balut', 'Virgie Nitor', '09876787654', '0987664567', 'Not sure', 'None', 'Site', 'none'),
(20019, 'Jojit', 'A', 'Alcalde', 'Jojit@gmail.com', 'pp.jpg', 'Male', 'Single', 'Filipino', '1998-12-28', 'Manila', 'Merryhomes 2', 'none', 'none', 'Cristy Fernandez', '09876787654', '0987664567', 'Not sure', 'none', 'Site', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_days`
--

CREATE TABLE `tbl_days` (
  `day_id` int(11) NOT NULL,
  `dayname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_days`
--

INSERT INTO `tbl_days` (`day_id`, `dayname`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dinner`
--

CREATE TABLE `tbl_dinner` (
  `dinner_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `timeconsumed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dinner`
--

INSERT INTO `tbl_dinner` (`dinner_id`, `custinfo_id`, `food_id`, `quantity`, `timeconsumed`) VALUES
(1, 20019, 12, 2, '2017-12-01 00:00:00'),
(2, 20018, 4, 5, '2017-12-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrolled_class`
--

CREATE TABLE `tbl_enrolled_class` (
  `enrolledclass_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `programtotal` double NOT NULL,
  `dateofenroll` datetime NOT NULL,
  `programexpiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enrolled_class`
--

INSERT INTO `tbl_enrolled_class` (`enrolledclass_id`, `member_id`, `program_id`, `subscription_id`, `programtotal`, `dateofenroll`, `programexpiry`) VALUES
(1, 2, 1, 9, 1200, '2017-12-01 19:45:21', '2018-01-01 00:00:00'),
(2, 2, 2, 8, 1600, '2017-12-01 19:45:21', '2018-01-01 00:00:00'),
(3, 2, 3, 20, 1900, '2017-12-01 19:45:21', '2018-01-01 00:00:00'),
(4, 2, 5, 24, 1600, '2017-12-01 20:09:49', '2018-01-01 00:00:00'),
(5, 3, 9, 28, 1200, '2017-12-01 21:15:05', '2018-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exercise`
--

CREATE TABLE `tbl_exercise` (
  `exercise_id` int(11) NOT NULL,
  `exercisename` varchar(1000) NOT NULL,
  `calorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exercise`
--

INSERT INTO `tbl_exercise` (`exercise_id`, `exercisename`, `calorie`) VALUES
(1, 'Aerobics, general', 5),
(2, 'Aerobics, high impact', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility`
--

CREATE TABLE `tbl_facility` (
  `facility_id` int(11) NOT NULL,
  `facilityname` varchar(100) NOT NULL,
  `facilitydesc` varchar(100) NOT NULL,
  `facilityimage` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facility`
--

INSERT INTO `tbl_facility` (`facility_id`, `facilityname`, `facilitydesc`, `facilityimage`) VALUES
(1, 'Gym', 'Gym Area', 'Gym-Area-1.jpg'),
(2, 'Lobby', 'Lobby Area', 'c5a1739c9619c9bb3e5d3fcbe2e1e5ca0843ab46.jpg'),
(3, 'Studio', 'Wide area for zumba and yoga', 'dancestudio.jpg'),
(4, 'Sauna', 'Hot and steamy perfect for cell rejuvenation', 'sauna.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fooddiary`
--

CREATE TABLE `tbl_fooddiary` (
  `fooddiary_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `totalcal` double NOT NULL,
  `diarydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fooddiary`
--

INSERT INTO `tbl_fooddiary` (`fooddiary_id`, `custinfo_id`, `totalcal`, `diarydate`) VALUES
(1, 20018, 1728, '2017-12-01'),
(2, 20019, 1791, '2017-12-01'),
(3, 20018, 1880, '2017-12-19'),
(4, 20018, 333, '2017-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_category`
--

CREATE TABLE `tbl_food_category` (
  `food_category_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_food_category`
--

INSERT INTO `tbl_food_category` (`food_category_id`, `category`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Snack'),
(4, 'Dinner');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lunch`
--

CREATE TABLE `tbl_lunch` (
  `lunch_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `timeconsumed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lunch`
--

INSERT INTO `tbl_lunch` (`lunch_id`, `custinfo_id`, `food_id`, `quantity`, `timeconsumed`) VALUES
(1, 20018, 10, 1, '2017-12-01 00:00:00'),
(2, 20019, 8, 1, '2017-12-01 00:00:00'),
(3, 20018, 6, 1, '2017-12-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medcond`
--

CREATE TABLE `tbl_medcond` (
  `cond_id` int(11) NOT NULL,
  `conditionname` varchar(200) NOT NULL,
  `severity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_medcond`
--

INSERT INTO `tbl_medcond` (`cond_id`, `conditionname`, `severity`) VALUES
(1, 'Abnormal EKG', 0),
(2, 'Anemia', 0),
(3, 'Angina Pectoris', 0),
(4, 'Asthma', 0),
(5, 'Bone Disease', 0),
(6, 'Breast Lump', 0),
(7, 'Coronary Artery Disease', 0),
(8, 'Decreased Libido', 0),
(9, 'Depression', 0),
(10, 'Diabetes Type I', 0),
(11, 'Diabetes Type II', 0),
(12, 'Dyslipidemia (High Cholesterol)', 0),
(13, 'Emphysema', 0),
(14, 'Endocrine Disorder', 0),
(15, 'Gallbladder Disease', 0),
(16, 'Hyperthyroidism', 0),
(17, 'Hypothyroidism', 0),
(18, 'Impotenece/ED', 0),
(19, 'Infertility', 0),
(20, 'Kidney Disease', 0),
(21, 'Meningitis', 0),
(22, 'Mental Illness', 0),
(23, 'Migraines', 0),
(24, 'Nipple Discharge', 0),
(25, 'Osteoporosis', 0),
(26, 'Phlebitis', 0),
(27, 'Postmenopausal Bleeding', 0),
(28, 'Seizures', 0),
(29, 'Serious Injury', 0),
(30, 'Stomach Ulcer', 0),
(31, 'Stroke', 0),
(33, 'Tubercolosis', 0),
(34, 'Thyroid Cancer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medhistory`
--

CREATE TABLE `tbl_medhistory` (
  `medhistory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cond_id` int(11) NOT NULL,
  `accident` varchar(200) NOT NULL,
  `a_year` varchar(100) NOT NULL,
  `a_residual` varchar(200) NOT NULL,
  `hospitali` varchar(200) NOT NULL,
  `h_year` varchar(100) NOT NULL,
  `h_residual` varchar(200) NOT NULL,
  `findings` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_medhistory`
--

INSERT INTO `tbl_medhistory` (`medhistory_id`, `user_id`, `cond_id`, `accident`, `a_year`, `a_residual`, `hospitali`, `h_year`, `h_residual`, `findings`) VALUES
(1, 20018, 4, '', '', '', '', '', '', ''),
(2, 20019, 31, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `membercolor` varchar(100) NOT NULL,
  `member_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL,
  `membershipdate` datetime NOT NULL,
  `membershipexpiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`membercolor`, `member_id`, `custinfo_id`, `membership_id`, `isActive`, `membershipdate`, `membershipexpiry`) VALUES
('', 1, 0, 1, 1, '2017-12-01 00:20:00', '2017-12-23 00:00:00'),
('#0000FF', 2, 20018, 1, 1, '2017-12-01 19:39:54', '2018-12-01 00:00:00'),
('#0000FF', 3, 20019, 1, 1, '2017-12-01 21:03:57', '2018-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_membership`
--

CREATE TABLE `tbl_membership` (
  `membership_id` int(11) NOT NULL,
  `membershipname` varchar(200) NOT NULL,
  `membershipfee` double NOT NULL,
  `descr` varchar(500) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_membership`
--

INSERT INTO `tbl_membership` (`membership_id`, `membershipname`, `membershipfee`, `descr`, `duration`) VALUES
(1, 'Basic', 500, 'Allows you to enroll to our classes as well as avail walk-in classes.', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_membership_program`
--

CREATE TABLE `tbl_membership_program` (
  `memprog_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_1n1`
--

CREATE TABLE `tbl_member_1n1` (
  `Member1n1ID` int(11) NOT NULL,
  `ProgramID` int(11) NOT NULL,
  `TrainerID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Dweek` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_class`
--

CREATE TABLE `tbl_member_class` (
  `memberclass_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `programtotal` double NOT NULL,
  `dateofenlist` datetime NOT NULL,
  `isPaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member_class`
--

INSERT INTO `tbl_member_class` (`memberclass_id`, `member_id`, `program_id`, `subscription_id`, `programtotal`, `dateofenlist`, `isPaid`) VALUES
(30, 2, 1, 9, 1200, '2017-12-01 19:42:58', 1),
(31, 2, 2, 8, 1600, '2017-12-01 19:43:24', 1),
(32, 2, 3, 20, 1900, '2017-12-01 19:43:24', 1),
(34, 2, 5, 24, 1600, '2017-12-01 20:09:26', 1),
(35, 3, 9, 28, 1200, '2017-12-01 21:09:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_exercise`
--

CREATE TABLE `tbl_member_exercise` (
  `memberexercise_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `minutesperformed` int(11) NOT NULL,
  `caloriesburned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member_exercise`
--

INSERT INTO `tbl_member_exercise` (`memberexercise_id`, `custinfo_id`, `exercise_id`, `minutesperformed`, `caloriesburned`) VALUES
(1, 20018, 2, 120, 600),
(2, 20019, 2, 55, 275),
(3, 20018, 1, 150, 750);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_subscription`
--

CREATE TABLE `tbl_member_subscription` (
  `MemberSubscriptionID` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `SubscriptionID` int(11) NOT NULL,
  `ProgramTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `feedback_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `femail` varchar(100) NOT NULL,
  `fmsg` varchar(500) NOT NULL,
  `datesent` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`feedback_id`, `fname`, `femail`, `fmsg`, `datesent`) VALUES
(2, 'Carlo Villaraza', 'carlovillaraza@gmail.com', 'Clean gym, very nice people and staff.', '2017-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_misc`
--

CREATE TABLE `tbl_misc` (
  `misc_id` int(11) NOT NULL,
  `misctype` varchar(200) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_misc`
--

INSERT INTO `tbl_misc` (`misc_id`, `misctype`, `price`) VALUES
(1, 'Towel Service', 500),
(2, 'Juice of the day', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_events`
--

CREATE TABLE `tbl_news_events` (
  `newsevent_id` int(11) NOT NULL,
  `eventname` varchar(200) NOT NULL,
  `eventdate` date NOT NULL,
  `eventstart` time NOT NULL,
  `eventend` time NOT NULL,
  `eventdesc` varchar(200) NOT NULL,
  `eventvenue` varchar(200) NOT NULL,
  `eventimage` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news_events`
--

INSERT INTO `tbl_news_events` (`newsevent_id`, `eventname`, `eventdate`, `eventstart`, `eventend`, `eventdesc`, `eventvenue`, `eventimage`, `status`) VALUES
(1, 'Zumba Party', '2017-11-14', '12:00:00', '15:00:00', 'Get your groove on!', 'Ozz Dance Studio', 'zumba.jpg', 0),
(2, 'Fun Run', '2017-11-13', '08:00:00', '12:00:00', 'Lorem ipsum dolor sit amet', 'BGC Center', 'funrun.jpg', 0),
(3, 'Partyyyyyyyy', '2017-11-12', '08:00:00', '11:00:00', 'hiii', 'ozz', 'hi.jpg', 0),
(4, 'pool', '2017-11-23', '09:00:00', '10:00:00', 'jkjk', 'ozzpool', '', 0),
(5, 'Ana Party', '2017-11-19', '12:00:00', '16:00:00', 'Hahaaaa', 'Vista Aldea', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nutritionfacts`
--

CREATE TABLE `tbl_nutritionfacts` (
  `food_id` int(11) NOT NULL,
  `foodname` varchar(200) NOT NULL,
  `servingsize` varchar(200) NOT NULL,
  `calories` double NOT NULL,
  `total fat` double NOT NULL,
  `saturated` double NOT NULL,
  `polyunsaturated` double NOT NULL,
  `monounsaturated` double NOT NULL,
  `trans` double NOT NULL,
  `cholesterol` double NOT NULL,
  `sodium` double NOT NULL,
  `potassium` double NOT NULL,
  `total carbs` double NOT NULL,
  `dietaryfiber` double NOT NULL,
  `sugars` double NOT NULL,
  `protein` double NOT NULL,
  `vitaminA` double NOT NULL,
  `vitaminC` double NOT NULL,
  `calcium` double NOT NULL,
  `iron` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nutritionfacts`
--

INSERT INTO `tbl_nutritionfacts` (`food_id`, `foodname`, `servingsize`, `calories`, `total fat`, `saturated`, `polyunsaturated`, `monounsaturated`, `trans`, `cholesterol`, `sodium`, `potassium`, `total carbs`, `dietaryfiber`, `sugars`, `protein`, `vitaminA`, `vitaminC`, `calcium`, `iron`) VALUES
(1, 'Puto', '1 cake', 333, 12, 7, 0, 0, 0, 103, 312, 135, 46, 1, 23, 10, 10, 0, 26, 17),
(2, 'Ensaymada', '1 bun', 130, 1, 0, 0, 0, 0, 0, 180, 50, 28, 1, 10, 2, 15, 0, 0, 15),
(3, 'Siopao', '1 bun', 330, 10, 3, 0, 0, 0, 60, 310, 0, 26, 0, 0, 11, 0, 0, 0, 0),
(4, 'Pork Embutido', '1 serving', 350, 14, 4, 1, 5, 0, 75, 750, 0, 44, 5, 0, 15, 0, 0, 0, 0),
(5, 'Guisadong Repolyo at Beans', '1 serving', 156, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0),
(6, 'Creamy Beef Kare-Kare', '1 cup', 174, 12, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0, 10, 0, 0, 0, 0),
(7, 'Ginataang Hipon', '1 serving', 85, 5, 4, 0, 0, 0, 55, 222, 123, 4, 1, 3, 7, 0, 0, 0, 0),
(8, 'Tinolang Manok', '1 bowl', 134, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 25, 0, 0, 0, 0, 0),
(9, 'Kutsinta', '1 piece', 140, 3, 0, 1, 1, 0, 30, 800, 0, 11, 4, 6, 20, 0, 0, 0, 0),
(10, 'Pork Mechado', '1 serving', 1255, 33, 2, 0, 0, 0, 270, 4081, 2524, 117, 19, 66, 89, 52, 260, 13, 62),
(11, 'Tortang Alimasag', '1 piece', 230, 1, 0, 0, 0, 0, 4, 215, 899, 43, 10, 18, 23, 10, 0, 41, 10),
(12, 'Tapsilog', '1 meal', 348, 27, 2, 1, 10, 0, 0, 55, 535, 13, 5, 4, 8, 10, 8, 9, 18),
(13, 'Pork Nilaga', '1 cup', 25, 0, 0, 0, 0, 0, 0, 0, 0, 25, 7, 0, 0, 0, 0, 0, 0),
(14, 'Ginataang Nangka', '1 cup', 270, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 'Paksiw na Pata', '1 serving', 180, 1, 0, 0, 0, 0, 13, 280, 125, 21, 0, 12, 27, 0, 0, 0, 0),
(16, 'Paksiw na Isda', '1 ounce', 750, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'Chicken Afritada', '1 serving', 280, 8, 3, 1, 3, 0, 5, 280, 550, 43, 6, 25, 11, 35, 100, 50, 17),
(18, 'Chicken Empanada', '1 empanada', 179, 6, 2, 0, 0, 0, 212, 70, 63, 15, 3, 2, 10, 8, 0, 2, 5),
(19, 'Ginataang Pinakbet', '1 cup', 319, 23, 6, 0, 0, 0, 5, 759, 440, 38, 12, 10, 18, 171, 202, 10, 29),
(20, 'Relyenong Bangus', '1 cup', 990, 58, 24, 2, 22, 3, 281, 3308, 1309, 24, 6, 0, 94, 36, 0, 5, 53),
(21, 'Lugaw (Plain)', '1 cup', 2816, 217, 31, 25, 93, 0, 0, 405, 1858, 184, 46, 29, 73, 83, 119, 47, 127),
(22, 'Sinigang na Bangus', '1 slice', 65, 0, 0, 0, 0, 0, 0, 85, 0, 9, 0, 9, 12, 0, 0, 25, 0),
(23, 'Champorado', '1 cup', 181, 10, 1, 0, 0, 0, 0, 211, 341, 23, 3, 17, 3, 166, 31, 8, 9),
(24, 'Suman na Malagkit', '1 piece', 839, 26, 4, 3, 7, 0, 36, 4542, 2537, 83, 8, 41, 66, 713, 62, 22, 34),
(25, 'Pork Adobo', '8 oz', 342, 19, 5, 0, 0, 0, 107, 793, 0, 2, 0, 1, 39, 0, 0, 0, 0),
(26, 'Pandesal', '1 piece', 462, 11, 3, 1, 5, 0, 0, 288, 149, 53, 5, 9, 30, 26, 131, 0, 23),
(27, 'Papaitan', '100 grams', 340, 4, 0, 1, 0, 0, 0, 300, 700, 47, 6, 37, 29, 36, 60, 51, 12),
(28, 'Pork Steak', '1 serving', 250, 20, 6, 2, 8, 0, 20, 633, 15, 9, 2, 1, 12, 143, 39, 7, 6),
(29, 'Pork Sinigang', '1 cup', 90, 0, 0, 0, 0, 0, 0, 125, 0, 6, 0, 6, 12, 10, 0, 35, 0),
(30, 'Fish Sinigang', '1 serving', 618, 37, 9, 3, 20, 0, 120, 140, 1633, 24, 7, 2, 54, 11, 27, 26, 18),
(31, 'Kare Kare', '200 grams', 90, 5, 0, 0, 0, 0, 25, 125, 0, 4, 0, 0, 6, 0, 0, 25, 0),
(33, 'Rice', '1 cup', 206, 0, 0, 0, 0, 0, 0, 1, 55.3, 45, 0, 0, 5, 0, 0, 1, 1),
(34, 'Bacon', '1 slice cooked', 43, 5, 5, 0, 0, 0, 2, 5, 1, 0, 0, 0, 6, 0, 0, 0, 0),
(35, 'Tocino', '112 grams', 280, 19, 7, 0, 0, 0, 65, 720, 0, 10, 0, 1, 16, 6, 2, 2, 4),
(36, 'Hotdog', '1 serving', 151, 20, 20, 0, 0, 0, 13, 23, 2, 0, 0, 0, 10, 0, 0, 5, 3),
(37, '3 in 1 Coffee', '1 packet', 110, 1, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0),
(38, 'Orange Juice', '1 cup (248 grams)', 111, 0, 0, 0, 0, 0, 0, 0, 496, 26, 0, 21, 1, 9, 206, 2, 2),
(39, 'Mango Shake', '1 whole mango + 8 oz skim milk', 320, 3, 1, 0, 0, 0, 0, 1100, 0, 59, 0, 16, 12, 0, 0, 0, 0),
(40, 'Milk', '1 cup', 103, 2, 1, 0, 0, 0, 12, 107, 366, 12, 0, 13, 8, 2, 0, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paymenthistory`
--

CREATE TABLE `tbl_paymenthistory` (
  `history_id` int(11) NOT NULL,
  `actiontaken` varchar(100) NOT NULL,
  `paymenttype` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `amountpaidH` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `Hdatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_paymenthistory`
--

INSERT INTO `tbl_paymenthistory` (`history_id`, `actiontaken`, `paymenttype`, `amount`, `amountpaidH`, `user_id`, `Hdatetime`) VALUES
(1, 'Payment', 'Membership', 500, 500, 20018, '2017-12-01 19:39:53'),
(2, 'Balance Made', 'Zumba', 0, 0, 20018, '2017-12-01 19:40:32'),
(3, 'Balance Made', 'Yoga', 0, 0, 20018, '2017-12-01 19:42:58'),
(4, 'Balance Made', 'Zumba', 1200, 0, 20018, '2017-12-01 19:43:24'),
(5, 'Balance Made', 'Taekwondo', 1200, 0, 20018, '2017-12-01 19:43:24'),
(6, 'Payment', 'Yoga', 1200, 1200, 20018, '2017-12-01 19:45:20'),
(7, 'Payment', 'Zumba', 1600, 1600, 20018, '2017-12-01 19:45:20'),
(8, 'Payment', 'Taekwondo', 1900, 1900, 20018, '2017-12-01 19:45:20'),
(9, 'Payment', 'Yoga', 1200, 0, 20018, '2017-12-01 19:46:46'),
(10, 'Payment', 'Zumba', 1600, 0, 20018, '2017-12-01 19:46:46'),
(11, 'Payment', 'Taekwondo', 1900, 0, 20018, '2017-12-01 19:46:46'),
(12, 'Payment', '2', 200, 200, 20018, '2017-12-01 19:52:34'),
(13, 'Payment', '', 0, 0, 20018, '2017-12-01 20:06:39'),
(14, 'Payment', '', 0, 0, 20018, '2017-12-01 20:06:39'),
(15, 'Payment', '', 0, 0, 20018, '2017-12-01 20:06:39'),
(16, 'Payment', '', 0, 0, 20018, '2017-12-01 20:06:39'),
(17, 'Payment', '', 0, 0, 20018, '2017-12-01 20:06:39'),
(18, 'Balance Made', 'Power Core Yoga', 0, 0, 20018, '2017-12-01 20:09:26'),
(19, 'Payment', 'Yoga', 1200, 0, 20018, '2017-12-01 20:09:48'),
(20, 'Payment', 'Zumba', 1600, 0, 20018, '2017-12-01 20:09:48'),
(21, 'Payment', 'Taekwondo', 1900, 0, 20018, '2017-12-01 20:09:48'),
(22, 'Payment', 'Power Core Yoga', 1600, 1600, 20018, '2017-12-01 20:09:48'),
(23, 'Payment', 'Membership', 500, 500, 20019, '2017-12-01 21:03:57'),
(24, 'Balance Made', 'Muay Thai', 0, 0, 20019, '2017-12-01 21:09:20'),
(25, 'Payment', 'Muay Thai', 1200, 1200, 20019, '2017-12-01 21:15:04'),
(26, 'Payment', '2', 200, 200, 20019, '2017-12-01 21:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_enrolledclasses`
--

CREATE TABLE `tbl_payment_enrolledclasses` (
  `PEC_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `memberclass_id` int(11) NOT NULL,
  `amountpaidEC` double NOT NULL,
  `rembalanceE` double NOT NULL,
  `graceperiodE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_enrolledclasses`
--

INSERT INTO `tbl_payment_enrolledclasses` (`PEC_id`, `user_id`, `memberclass_id`, `amountpaidEC`, `rembalanceE`, `graceperiodE`) VALUES
(1, 20018, 29, 1600, 0, '2017-12-15 00:00:00'),
(2, 20018, 30, 1200, 0, '2017-12-15 00:00:00'),
(3, 20018, 31, 1600, 0, '2017-12-15 00:00:00'),
(4, 20018, 32, 1900, 0, '2017-12-15 00:00:00'),
(6, 20018, 34, 1600, 0, '2017-12-15 00:00:00'),
(7, 20019, 35, 1200, 0, '2017-12-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_membership`
--

CREATE TABLE `tbl_payment_membership` (
  `PM_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `amountpaidM` double NOT NULL,
  `rembalance` double NOT NULL,
  `graceperiodM` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_membership`
--

INSERT INTO `tbl_payment_membership` (`PM_id`, `user_id`, `membership_id`, `amountpaidM`, `rembalance`, `graceperiodM`) VALUES
(1, 20018, 1, 500, 0, '2017-12-15 00:00:00'),
(2, 20019, 1, 500, 0, '2017-12-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiling`
--

CREATE TABLE `tbl_profiling` (
  `profiling_ID` int(11) NOT NULL,
  `goal` varchar(255) NOT NULL,
  `howactiveareyou` varchar(255) NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `goalweight` float NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE `tbl_program` (
  `program_id` int(11) NOT NULL,
  `programname` mediumtext NOT NULL,
  `programdesc` varchar(20000) NOT NULL,
  `programimage` varchar(10000) NOT NULL,
  `programcolor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`program_id`, `programname`, `programdesc`, `programimage`, `programcolor`) VALUES
(1, 'Yoga', 'Designed to revitalise the body, relax the mind', 'yoga.jpg', '#008080'),
(2, 'Zumba', 'Get your groove-on with signature Latin and salsa-style music', 'zumba.jpg', '#8080c0'),
(3, 'Taekwondo', 'Taekwondo', 'taekwondo.jpg', '#7799d9'),
(4, 'Gym Workout', 'Gym Workout', 'gym.jpg', '#ff0000'),
(5, 'Power Core Yoga', 'Designed to revitalise the body, relax the mind ', 'pcore.jpg', '#ff8000'),
(7, 'Pilates', 'yayy', 'eGGA_PTm.jpg', '#000000'),
(8, 'Pyoga', 'yoga', 'image2.jpg', '#ff0080'),
(9, 'Muay Thai', 'Muay Thai', 'muaythat.jpg', '#ff8040');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program_attendance`
--

CREATE TABLE `tbl_program_attendance` (
  `progatt_id` int(11) NOT NULL,
  `programclass_id` int(11) NOT NULL,
  `custinfo_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `timein` datetime NOT NULL,
  `timeout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program_attendance`
--

INSERT INTO `tbl_program_attendance` (`progatt_id`, `programclass_id`, `custinfo_id`, `program_id`, `timein`, `timeout`) VALUES
(1, 24, 20018, 2, '2017-12-01 19:53:32', '2017-12-01 19:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program_class`
--

CREATE TABLE `tbl_program_class` (
  `programclass_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `Dweek` varchar(50) NOT NULL,
  `facility_id` int(50) NOT NULL,
  `ClassSize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program_class`
--

INSERT INTO `tbl_program_class` (`programclass_id`, `program_id`, `StartTime`, `EndTime`, `Dweek`, `facility_id`, `ClassSize`) VALUES
(1, 1, '09:30:00', '10:30:00', 'Monday', 1, 29),
(2, 1, '07:00:00', '08:00:00', 'Thursday', 3, 29),
(3, 1, '07:00:00', '09:00:00', 'Sunday', 3, 28),
(4, 4, '08:30:00', '09:30:00', 'Monday', 1, 30),
(6, 4, '08:30:00', '09:30:00', 'Wednesday', 1, 30),
(7, 2, '09:00:00', '10:00:00', 'Friday', 1, 28),
(8, 3, '09:30:00', '10:30:00', 'Saturday', 1, 29),
(9, 5, '08:30:00', '09:30:00', 'Monday', 3, 30),
(12, 1, '09:00:00', '10:30:00', 'Monday', 4, 27),
(14, 2, '08:00:00', '09:00:00', 'Tuesday', 1, 28),
(15, 1, '08:30:00', '10:30:00', 'Tuesday', 2, 29),
(16, 4, '09:30:00', '10:30:00', 'Tuesday', 4, 30),
(18, 5, '10:30:00', '11:30:00', 'Saturday', 1, 27),
(19, 4, '14:00:00', '15:00:00', 'Monday', 1, 30),
(20, 2, '07:30:00', '09:30:00', 'Wednesday', 3, 29),
(21, 3, '07:30:00', '08:30:00', 'Monday', 3, 30),
(23, 2, '17:00:00', '19:00:00', 'Monday', 3, 10),
(24, 2, '17:00:00', '19:00:00', 'Friday', 2, 10),
(25, 2, '17:00:00', '19:00:00', 'Wednesday', 3, 10),
(33, 1, '08:00:00', '09:00:00', 'Thursday', 1, 30),
(34, 9, '10:00:00', '11:00:00', 'Thursday', 2, 30),
(35, 9, '09:00:00', '11:00:00', 'Thursday', 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_progress`
--

CREATE TABLE `tbl_progress` (
  `progress_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `date` date NOT NULL,
  `custinfo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proofofpayment_enrolled`
--

CREATE TABLE `tbl_proofofpayment_enrolled` (
  `proofE_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bankrem` varchar(100) NOT NULL,
  `proofdate` datetime NOT NULL,
  `imagepath` varchar(200) NOT NULL,
  `imagename` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `adminnotes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_proofofpayment_enrolled`
--

INSERT INTO `tbl_proofofpayment_enrolled` (`proofE_id`, `user_id`, `bankrem`, `proofdate`, `imagepath`, `imagename`, `amount`, `notes`, `adminnotes`) VALUES
(1, 20018, 'BDo', '2017-12-01 20:05:54', 'images/', 'deposit2.jpg', '1600', 'wuu', 'thanks');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proofofpayment_membership`
--

CREATE TABLE `tbl_proofofpayment_membership` (
  `proof_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bankrem` varchar(200) NOT NULL,
  `proofdate` datetime NOT NULL,
  `imagepath` blob NOT NULL,
  `imagename` blob NOT NULL,
  `amount` double NOT NULL,
  `notes` varchar(200) NOT NULL,
  `adminnotes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rate_category`
--

CREATE TABLE `tbl_rate_category` (
  `rcategory_id` int(11) NOT NULL,
  `rcategoryname` varchar(1000) NOT NULL,
  `addtosubscription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rate_category`
--

INSERT INTO `tbl_rate_category` (`rcategory_id`, `rcategoryname`, `addtosubscription`) VALUES
(1, 'Super Saver', 1),
(2, 'Monthly', 1),
(3, 'Walk-in', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spectrainer`
--

CREATE TABLE `tbl_spectrainer` (
  `spectrainer_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_spectrainer`
--

INSERT INTO `tbl_spectrainer` (`spectrainer_id`, `trainer_id`, `program_id`) VALUES
(82, 30001, 2),
(83, 30001, 3),
(84, 30001, 5),
(85, 30002, 3),
(86, 30002, 4),
(87, 30003, 1),
(88, 30003, 2),
(89, 30003, 5),
(90, 30004, 3),
(91, 30004, 4),
(92, 30004, 5),
(95, 30010, 1),
(96, 30010, 7),
(97, 30011, 4),
(98, 30012, 1),
(99, 30012, 8),
(100, 30013, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `subscription_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `sessions` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(100) NOT NULL,
  `rcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`subscription_id`, `program_id`, `duration`, `sessions`, `price`, `description`, `rcategory_id`) VALUES
(1, 4, '3', 0, 1000, 'Gym Workout', 1),
(2, 4, '6', 0, 900, 'Gym Workout', 1),
(3, 4, '12', 0, 833.33, 'Gym Workout', 1),
(4, 4, '1', 0, 1200, 'Gym Workout', 2),
(5, 2, '3', 0, 1500, 'Zumba', 1),
(6, 2, '6', 0, 1350, 'Zumba', 1),
(7, 2, '12', 0, 1250, 'Zumba', 1),
(8, 2, '1', 12, 1600, 'Zumba', 2),
(9, 1, '1', 5, 1200, 'Yoga', 2),
(10, 1, '3', 0, 1000, 'Yoga', 1),
(11, 1, '6', 0, 900, 'Yoga', 1),
(12, 1, '12', 0, 850.33, 'Yoga', 1),
(17, 3, '3', 0, 1700, 'Taekwondo', 1),
(18, 3, '6', 0, 1600, 'Taekwondo', 1),
(19, 3, '12', 0, 1416.7, 'Taekwondo', 1),
(20, 3, '1', 0, 1900, 'Taekwondo', 2),
(21, 5, '3', 0, 1500, 'Power Core Yoga', 1),
(22, 5, '6', 0, 1350, 'Power Core Yoga', 1),
(23, 5, '12', 0, 1250, 'Power Core Yoga', 1),
(24, 5, '1', 12, 1600, 'Power Core Yoga', 2),
(25, 9, '3', 0, 980, 'Super Saver', 1),
(26, 9, '6', 0, 850, 'Muay Thai', 1),
(27, 9, '12', 0, 700, 'Muay Thai', 1),
(28, 9, '1', 0, 1200, 'Muay Thai', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_walkin`
--

CREATE TABLE `tbl_temp_walkin` (
  `tempwalk_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `fee` double NOT NULL,
  `temptime` datetime NOT NULL,
  `isCheckedOut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trainers`
--

CREATE TABLE `tbl_trainers` (
  `trainer_id` int(11) NOT NULL,
  `trainer_fname` varchar(100) NOT NULL,
  `trainer_lname` varchar(100) NOT NULL,
  `trainer_image` varchar(10000) NOT NULL,
  `trainer_contactnum` varchar(11) NOT NULL,
  `trainer_email` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trainers`
--

INSERT INTO `tbl_trainers` (`trainer_id`, `trainer_fname`, `trainer_lname`, `trainer_image`, `trainer_contactnum`, `trainer_email`, `isActive`) VALUES
(30001, 'Joseph Johnny', 'Norlands', '74070_original_cropped_18561.jpg', '09895949302', 'josephnorlands@yahoo.com', 1),
(30002, 'Loisa ', 'Hortaleza', 'usa-gym_d.jpg', '09859504039', 'l@yahoo.com', 1),
(30003, 'Luigi ', 'Conrad', '14c564ec89dcea66570d00b8035a2fc6--certified-personal-trainer-muscle-fitness.jpg', '09393939393', 'l@yahoo.com', 1),
(30004, 'Christopher', 'Lopez', '41ca0a378145e7458e83f76891a80aa6--certified-personal-trainer-muscle-fitness.jpg', '09878909876', 'clopez@gmail.com', 1),
(30010, 'Jojit', 'Alcalde', 'eGGA_PTm.jpg', '09876578908', 'jojit@gmail.com', 1),
(30011, 'Julie Ann', 'Loresco', '_MG_8116.JPG', '09857493020', 'jlo@gmail.com', 1),
(30012, 'manny', 'nitor', '23113618_10155722557959373_857215871_n.jpg', '09876578987', 'manny@yahoo.com', 1),
(30013, 'May', 'Garcia', 'trainer1.jpg', '09878695874', 'may@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trainer_avail`
--

CREATE TABLE `tbl_trainer_avail` (
  `avail_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trainer_avail`
--

INSERT INTO `tbl_trainer_avail` (`avail_id`, `trainer_id`, `day`, `time`) VALUES
(1, 30001, 'Monday', 'AM'),
(2, 30001, 'Wednesday', 'PM'),
(3, 30001, 'Thursday', 'AM/PM'),
(4, 30001, 'Friday', 'AM'),
(5, 30002, 'Monday', 'AM/PM'),
(6, 30002, 'Friday', 'AM'),
(7, 30002, 'Saturday', 'PM'),
(8, 30003, 'Wednesday', 'AM/PM'),
(9, 30003, 'Thursday', 'PM'),
(10, 30003, 'Friday', 'AM'),
(11, 30003, 'Saturday', 'AM'),
(12, 30004, 'Monday', 'AM'),
(13, 30004, 'Tuesday', 'AM/PM'),
(15, 30010, 'Monday', 'AM/PM'),
(16, 30010, 'Wednesday', 'AM/PM'),
(17, 30011, 'Monday', 'AM/PM'),
(18, 30011, 'Friday', 'AM/PM'),
(19, 30012, 'Monday', 'AM/PM'),
(20, 30012, 'Wednesday', 'AM/PM'),
(21, 30013, 'Monday', 'AM/PM'),
(22, 30013, 'Wednesday', 'AM/PM'),
(23, 30013, 'Thursday', 'AM/PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trainer_class`
--

CREATE TABLE `tbl_trainer_class` (
  `trainerclass_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `programclass_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trainer_class`
--

INSERT INTO `tbl_trainer_class` (`trainerclass_id`, `trainer_id`, `programclass_id`) VALUES
(4, 30001, 9),
(6, 30001, 11),
(7, 0, 22),
(8, 30013, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` int(11) NOT NULL,
  `userdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `user_type`, `userdate`) VALUES
(101, 'admin', 'admin', 0, '2017-11-23'),
(20018, 'veronicanitor', 've', 2, '2017-12-01'),
(20019, 'jojit', 'jojit', 2, '2017-12-01'),
(30001, 'jnorlands', 'l', 3, '2017-11-23'),
(30002, 'lconrad', 'l', 3, '2017-11-23'),
(30003, 'lhortaleza', 'hor', 3, '2017-11-23'),
(30004, 'dsylvia', 'd', 3, '2017-11-23'),
(30005, 'jloresco', 'jlo', 3, '2017-11-23'),
(30006, 'pk', 'pkp', 3, '2017-11-23'),
(30007, 'manny', 'm', 3, '2017-11-23'),
(30008, 'angelll', 'wer', 3, '2017-11-23'),
(30012, 'mannynitor', 'manny', 3, '2017-12-01'),
(30013, 'maygarcia', 'may', 3, '2017-12-01'),
(40000, 'Receptionist', 'rec', 1, '2017-11-01'),
(40001, 'clarcklalu', 'clarck', 1, '2017-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_food`
--

CREATE TABLE `tbl_user_food` (
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_category_id` int(11) NOT NULL,
  `mealname` varchar(100) NOT NULL,
  `servingsize` int(11) NOT NULL,
  `numberofserving` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `fat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_food`
--

INSERT INTO `tbl_user_food` (`food_id`, `user_id`, `food_category_id`, `mealname`, `servingsize`, `numberofserving`, `calories`, `fat`) VALUES
(1, 20004, 1, 'Adobo', 50, 1, 10, 15),
(2, 20004, 3, 'Pork Caldereta', 60, 2, 43, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_walkin_class`
--

CREATE TABLE `tbl_walkin_class` (
  `walkin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `walkinprog_id` int(11) NOT NULL,
  `programtotal` double NOT NULL,
  `walkindate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_walkin_class`
--

INSERT INTO `tbl_walkin_class` (`walkin_id`, `user_id`, `walkinprog_id`, `programtotal`, `walkindate`) VALUES
(1, 20054, 2, 150, '2017-11-15 12:20:03'),
(2, 20054, 3, 200, '2017-11-15 12:20:03'),
(3, 20055, 5, 150, '2017-11-15 12:28:43'),
(4, 20060, 2, 150, '2017-11-15 17:03:21'),
(5, 20060, 3, 200, '2017-11-15 17:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_walkin_history`
--

CREATE TABLE `tbl_walkin_history` (
  `walkinhistory_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `fee` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `walkindatee` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_walkin_history`
--

INSERT INTO `tbl_walkin_history` (`walkinhistory_id`, `program_id`, `fee`, `user_id`, `walkindatee`) VALUES
(1, 2, 200, 20018, '2017-12-01 19:52:15'),
(2, 2, 200, 20019, '2017-12-01 21:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_walkin_program`
--

CREATE TABLE `tbl_walkin_program` (
  `walkinprog_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `programfee` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_walkin_program`
--

INSERT INTO `tbl_walkin_program` (`walkinprog_id`, `program_id`, `programfee`) VALUES
(2, 1, 150),
(3, 2, 200),
(4, 3, 250),
(5, 4, 300),
(6, 5, 200),
(7, 6, 350);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `membership_temp`
--
ALTER TABLE `membership_temp`
  ADD PRIMARY KEY (`mt_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tbl_bmi`
--
ALTER TABLE `tbl_bmi`
  ADD PRIMARY KEY (`bmi_id`);

--
-- Indexes for table `tbl_breakfast`
--
ALTER TABLE `tbl_breakfast`
  ADD PRIMARY KEY (`breakfast_id`);

--
-- Indexes for table `tbl_classes`
--
ALTER TABLE `tbl_classes`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `tbl_class_reservation`
--
ALTER TABLE `tbl_class_reservation`
  ADD PRIMARY KEY (`classreserve_id`);

--
-- Indexes for table `tbl_custinfo`
--
ALTER TABLE `tbl_custinfo`
  ADD PRIMARY KEY (`custinfo_id`);

--
-- Indexes for table `tbl_days`
--
ALTER TABLE `tbl_days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `tbl_dinner`
--
ALTER TABLE `tbl_dinner`
  ADD PRIMARY KEY (`dinner_id`);

--
-- Indexes for table `tbl_enrolled_class`
--
ALTER TABLE `tbl_enrolled_class`
  ADD PRIMARY KEY (`enrolledclass_id`);

--
-- Indexes for table `tbl_exercise`
--
ALTER TABLE `tbl_exercise`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `tbl_fooddiary`
--
ALTER TABLE `tbl_fooddiary`
  ADD PRIMARY KEY (`fooddiary_id`);

--
-- Indexes for table `tbl_food_category`
--
ALTER TABLE `tbl_food_category`
  ADD PRIMARY KEY (`food_category_id`);

--
-- Indexes for table `tbl_lunch`
--
ALTER TABLE `tbl_lunch`
  ADD PRIMARY KEY (`lunch_id`);

--
-- Indexes for table `tbl_medcond`
--
ALTER TABLE `tbl_medcond`
  ADD PRIMARY KEY (`cond_id`);

--
-- Indexes for table `tbl_medhistory`
--
ALTER TABLE `tbl_medhistory`
  ADD PRIMARY KEY (`medhistory_id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_membership`
--
ALTER TABLE `tbl_membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `tbl_membership_program`
--
ALTER TABLE `tbl_membership_program`
  ADD PRIMARY KEY (`memprog_id`);

--
-- Indexes for table `tbl_member_1n1`
--
ALTER TABLE `tbl_member_1n1`
  ADD PRIMARY KEY (`Member1n1ID`);

--
-- Indexes for table `tbl_member_class`
--
ALTER TABLE `tbl_member_class`
  ADD PRIMARY KEY (`memberclass_id`);

--
-- Indexes for table `tbl_member_exercise`
--
ALTER TABLE `tbl_member_exercise`
  ADD PRIMARY KEY (`memberexercise_id`);

--
-- Indexes for table `tbl_member_subscription`
--
ALTER TABLE `tbl_member_subscription`
  ADD PRIMARY KEY (`MemberSubscriptionID`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_misc`
--
ALTER TABLE `tbl_misc`
  ADD PRIMARY KEY (`misc_id`);

--
-- Indexes for table `tbl_news_events`
--
ALTER TABLE `tbl_news_events`
  ADD PRIMARY KEY (`newsevent_id`);

--
-- Indexes for table `tbl_nutritionfacts`
--
ALTER TABLE `tbl_nutritionfacts`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `tbl_paymenthistory`
--
ALTER TABLE `tbl_paymenthistory`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `tbl_payment_enrolledclasses`
--
ALTER TABLE `tbl_payment_enrolledclasses`
  ADD PRIMARY KEY (`PEC_id`);

--
-- Indexes for table `tbl_payment_membership`
--
ALTER TABLE `tbl_payment_membership`
  ADD PRIMARY KEY (`PM_id`);

--
-- Indexes for table `tbl_profiling`
--
ALTER TABLE `tbl_profiling`
  ADD PRIMARY KEY (`profiling_ID`);

--
-- Indexes for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `tbl_program_attendance`
--
ALTER TABLE `tbl_program_attendance`
  ADD PRIMARY KEY (`progatt_id`);

--
-- Indexes for table `tbl_program_class`
--
ALTER TABLE `tbl_program_class`
  ADD PRIMARY KEY (`programclass_id`);

--
-- Indexes for table `tbl_progress`
--
ALTER TABLE `tbl_progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `tbl_proofofpayment_enrolled`
--
ALTER TABLE `tbl_proofofpayment_enrolled`
  ADD PRIMARY KEY (`proofE_id`);

--
-- Indexes for table `tbl_proofofpayment_membership`
--
ALTER TABLE `tbl_proofofpayment_membership`
  ADD PRIMARY KEY (`proof_id`);

--
-- Indexes for table `tbl_rate_category`
--
ALTER TABLE `tbl_rate_category`
  ADD PRIMARY KEY (`rcategory_id`);

--
-- Indexes for table `tbl_spectrainer`
--
ALTER TABLE `tbl_spectrainer`
  ADD PRIMARY KEY (`spectrainer_id`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `tbl_temp_walkin`
--
ALTER TABLE `tbl_temp_walkin`
  ADD PRIMARY KEY (`tempwalk_id`);

--
-- Indexes for table `tbl_trainers`
--
ALTER TABLE `tbl_trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `tbl_trainer_avail`
--
ALTER TABLE `tbl_trainer_avail`
  ADD PRIMARY KEY (`avail_id`);

--
-- Indexes for table `tbl_trainer_class`
--
ALTER TABLE `tbl_trainer_class`
  ADD PRIMARY KEY (`trainerclass_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_food`
--
ALTER TABLE `tbl_user_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `tbl_walkin_class`
--
ALTER TABLE `tbl_walkin_class`
  ADD PRIMARY KEY (`walkin_id`);

--
-- Indexes for table `tbl_walkin_history`
--
ALTER TABLE `tbl_walkin_history`
  ADD PRIMARY KEY (`walkinhistory_id`);

--
-- Indexes for table `tbl_walkin_program`
--
ALTER TABLE `tbl_walkin_program`
  ADD PRIMARY KEY (`walkinprog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membership_temp`
--
ALTER TABLE `membership_temp`
  MODIFY `mt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_bmi`
--
ALTER TABLE `tbl_bmi`
  MODIFY `bmi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_breakfast`
--
ALTER TABLE `tbl_breakfast`
  MODIFY `breakfast_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_classes`
--
ALTER TABLE `tbl_classes`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_class_reservation`
--
ALTER TABLE `tbl_class_reservation`
  MODIFY `classreserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_custinfo`
--
ALTER TABLE `tbl_custinfo`
  MODIFY `custinfo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20020;
--
-- AUTO_INCREMENT for table `tbl_days`
--
ALTER TABLE `tbl_days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_dinner`
--
ALTER TABLE `tbl_dinner`
  MODIFY `dinner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_enrolled_class`
--
ALTER TABLE `tbl_enrolled_class`
  MODIFY `enrolledclass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_exercise`
--
ALTER TABLE `tbl_exercise`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_fooddiary`
--
ALTER TABLE `tbl_fooddiary`
  MODIFY `fooddiary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_lunch`
--
ALTER TABLE `tbl_lunch`
  MODIFY `lunch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_medcond`
--
ALTER TABLE `tbl_medcond`
  MODIFY `cond_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tbl_medhistory`
--
ALTER TABLE `tbl_medhistory`
  MODIFY `medhistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_membership`
--
ALTER TABLE `tbl_membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_membership_program`
--
ALTER TABLE `tbl_membership_program`
  MODIFY `memprog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_member_class`
--
ALTER TABLE `tbl_member_class`
  MODIFY `memberclass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_member_exercise`
--
ALTER TABLE `tbl_member_exercise`
  MODIFY `memberexercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_news_events`
--
ALTER TABLE `tbl_news_events`
  MODIFY `newsevent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_nutritionfacts`
--
ALTER TABLE `tbl_nutritionfacts`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_paymenthistory`
--
ALTER TABLE `tbl_paymenthistory`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_payment_enrolledclasses`
--
ALTER TABLE `tbl_payment_enrolledclasses`
  MODIFY `PEC_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_payment_membership`
--
ALTER TABLE `tbl_payment_membership`
  MODIFY `PM_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_profiling`
--
ALTER TABLE `tbl_profiling`
  MODIFY `profiling_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_program`
--
ALTER TABLE `tbl_program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_program_attendance`
--
ALTER TABLE `tbl_program_attendance`
  MODIFY `progatt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_program_class`
--
ALTER TABLE `tbl_program_class`
  MODIFY `programclass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_progress`
--
ALTER TABLE `tbl_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_proofofpayment_enrolled`
--
ALTER TABLE `tbl_proofofpayment_enrolled`
  MODIFY `proofE_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_proofofpayment_membership`
--
ALTER TABLE `tbl_proofofpayment_membership`
  MODIFY `proof_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rate_category`
--
ALTER TABLE `tbl_rate_category`
  MODIFY `rcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_spectrainer`
--
ALTER TABLE `tbl_spectrainer`
  MODIFY `spectrainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_temp_walkin`
--
ALTER TABLE `tbl_temp_walkin`
  MODIFY `tempwalk_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_trainers`
--
ALTER TABLE `tbl_trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30014;
--
-- AUTO_INCREMENT for table `tbl_trainer_avail`
--
ALTER TABLE `tbl_trainer_avail`
  MODIFY `avail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_trainer_class`
--
ALTER TABLE `tbl_trainer_class`
  MODIFY `trainerclass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_user_food`
--
ALTER TABLE `tbl_user_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_walkin_class`
--
ALTER TABLE `tbl_walkin_class`
  MODIFY `walkin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_walkin_history`
--
ALTER TABLE `tbl_walkin_history`
  MODIFY `walkinhistory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_walkin_program`
--
ALTER TABLE `tbl_walkin_program`
  MODIFY `walkinprog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
