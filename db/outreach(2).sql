-- phpMyAdmin SQL Dump
-- version 4.0.10.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2015 at 08:59 AM
-- Server version: 5.5.46
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `outreach`
--

-- --------------------------------------------------------

--
-- Table structure for table `fld_media`
--

CREATE TABLE IF NOT EXISTS `fld_media` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(150) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fld_media`
--

INSERT INTO `fld_media` (`tbl_id`, `fld_name`, `fld_remark`, `fld_form_id`) VALUES
(1, 'sssssss', 'dddddddddd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attempt_center`
--

CREATE TABLE IF NOT EXISTS `tbl_attempt_center` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_attempt_center` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_attempt_center`
--

INSERT INTO `tbl_attempt_center` (`id`, `fld_attempt_center`) VALUES
(1, 'Galle'),
(2, 'Colombo'),
(3, 'Kandy'),
(4, 'Gampaha'),
(5, 'Prison-Pallekale'),
(6, 'Prison-Pallansena'),
(7, 'Prison-Weerawila'),
(8, 'Prison-Anuradhapura'),
(9, 'Prison-Thaldena'),
(10, 'Kandakadu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_log`
--

CREATE TABLE IF NOT EXISTS `tbl_data_log` (
  `id_log` int(11) NOT NULL,
  `fld_comment` varchar(45) DEFAULT NULL,
  `fld_ip` varchar(45) DEFAULT NULL,
  `fld_user_id` int(11) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  `fld_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE IF NOT EXISTS `tbl_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_district_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`id`, `fld_district_name`) VALUES
(1, 'Ampara'),
(2, 'Anuradhapura'),
(3, 'Colombo'),
(4, 'Galle'),
(5, 'Hambanthota'),
(6, 'Jaffna'),
(7, 'Kandy'),
(8, 'Kegalle'),
(9, 'Kilinochchi'),
(10, 'Kurunegala'),
(11, 'Mannar'),
(12, 'Matale'),
(13, 'Matara'),
(14, 'Monaragala'),
(15, 'Mullativu'),
(16, 'Nuwara Eliya'),
(17, 'Polonnaruwa'),
(18, 'Puttalam'),
(19, 'Rathnapura'),
(20, 'Trincomalee'),
(21, 'Vavuniya'),
(22, 'Gampaha');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_free_user`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_free_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_form_id` int(11) NOT NULL,
  `fld_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fld_officer` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_drug_free_user`
--

INSERT INTO `tbl_drug_free_user` (`id`, `fld_form_id`, `fld_date`, `fld_officer`) VALUES
(2, 56, '2015-10-25 23:18:39', 'center'),
(3, 57, '2015-10-28 00:33:22', 'test'),
(4, 60, '2015-10-28 06:11:03', 'out3'),
(5, 55, '2015-11-18 03:01:09', 'test'),
(6, 54, '2015-11-18 03:03:30', 'center3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_name`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_name` (
  `drug_id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`drug_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_drug_name`
--

INSERT INTO `tbl_drug_name` (`drug_id`, `drug_name`) VALUES
(1, 'Heroin'),
(2, 'Cannabis'),
(3, 'Alcohol'),
(4, 'Illicit'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_users`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_users` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_drug_id` int(11) DEFAULT NULL,
  `fld_new_identity` int(11) DEFAULT NULL,
  `fld_identity_total` int(11) DEFAULT NULL,
  `fld_new_registered` int(11) DEFAULT NULL,
  `fld_registered_total` int(11) DEFAULT NULL,
  `fld_services_provided` int(11) DEFAULT NULL,
  `fld_services_total` int(11) DEFAULT NULL,
  `fld_ref` int(11) DEFAULT NULL,
  `fld_free_from_drug` int(11) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_drug_users`
--

INSERT INTO `tbl_drug_users` (`tbl_id`, `fld_drug_id`, `fld_new_identity`, `fld_identity_total`, `fld_new_registered`, `fld_registered_total`, `fld_services_provided`, `fld_services_total`, `fld_ref`, `fld_free_from_drug`, `fld_form_id`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employment`
--

CREATE TABLE IF NOT EXISTS `tbl_employment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_employment` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_employment`
--

INSERT INTO `tbl_employment` (`id`, `fld_employment`) VALUES
(1, 'Full-time (More 40 Hours)'),
(2, 'Part-time (Regular Hours)'),
(3, 'Part-time(Irregular Hours)'),
(4, 'Student'),
(5, 'Military'),
(6, 'Retired/Disablility'),
(7, 'Self employment'),
(8, 'Unemployed'),
(9, 'In controlled environment'),
(10, 'Homemaker'),
(11, 'Begging');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_accepted_user`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_accepted_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_form_id` int(11) NOT NULL,
  `fld_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fld_officer` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_follow_up_accepted_user`
--

INSERT INTO `tbl_follow_up_accepted_user` (`id`, `fld_form_id`, `fld_date`, `fld_officer`) VALUES
(23, 54, '2015-10-23 06:30:49', 'test'),
(24, 55, '2015-10-23 06:48:14', 'test'),
(25, 56, '2015-10-23 07:28:31', 'center'),
(26, 57, '2015-10-25 22:23:03', 'admin'),
(27, 58, '2015-10-26 01:30:44', 'admin'),
(28, 59, '2015-10-26 02:12:03', 'admin'),
(29, 60, '2015-10-26 03:49:12', 'admin'),
(30, 62, '2015-11-02 02:27:23', 'out3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_activities_list`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_activities_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_activities` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_follow_up_activities_list`
--

INSERT INTO `tbl_follow_up_activities_list` (`id`, `fld_activities`) VALUES
(1, 'Economic buildup activities'),
(2, 'Helthly activities'),
(3, 'Social Recognized buildup activities');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_centers`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_center_name` varchar(50) NOT NULL,
  `fld_short_name` char(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_follow_up_centers`
--

INSERT INTO `tbl_follow_up_centers` (`id`, `fld_center_name`, `fld_short_name`) VALUES
(1, 'not assign', 'CT0'),
(2, 'center one', 'CT1'),
(3, 'center two', 'CT2'),
(4, 'center three', 'CT3'),
(5, 'center four', 'CT4'),
(6, 'center five', 'CT5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_community`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_community` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_client_name` varchar(150) DEFAULT NULL,
  `fld_location` varchar(100) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_time_period` varchar(45) DEFAULT NULL,
  `fld_relapse_or_not` varchar(45) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_follow_up_community`
--

INSERT INTO `tbl_follow_up_community` (`tbl_id`, `fld_client_name`, `fld_location`, `fld_date`, `fld_time_period`, `fld_relapse_or_not`, `fld_form_id`) VALUES
(1, 'janu', 'dffs', '2015-09-02', '2014-08-03 to 2015-09-19', 'not', NULL),
(2, 'fhgdhd', 'ddddddddddddd', '2015-09-01', '2015-09-09 to 2015-09-30', 'Relapse', NULL),
(3, 'vidda', 'dsfsf', '2015-09-01', '2015-09-01 to 2015-09-25', 'not', NULL),
(18, 'sassa', 'sds', '2015-08-02', '2014-04-01 to 2015-08-05', 'not', NULL),
(19, 'as', '', '0000-00-00', ' to ', '', NULL),
(20, 'sdf', 'sdf', '2015-09-10', '2015-10-12 to 2015-10-21', 'not', NULL),
(21, 'vidu', 'colombo', '2015-10-07', '2015-10-04 to 2015-10-26', 'not', 1),
(22, 'aaaaaaaaa', '', '0000-00-00', ' to ', '', 2),
(23, 'aaaaa', 'dfdfdf', '2015-10-14', '2015-10-06 to 2015-10-21', 'not', 1),
(24, 'bbbbb', 'galle', '2015-10-01', '2015-10-01 to 2015-10-23', 'Relapse', 1),
(25, 'Nalee', 'Galle', '2015-10-07', '2015-10-01 to 2015-10-27', '', 1),
(26, 'af', '', '0000-00-00', ' to ', '', 3),
(27, 'Methshan', 'colombo', '2015-10-07', '2015-10-01 to 2015-10-17', '1', 1),
(28, 'chathushka', 'panadura', '2015-10-06', '2015-10-20 to ', '', 1),
(29, '', '', '0000-00-00', ' to ', '', 2),
(30, 'vidda', 'colombo', '2015-11-01', '2015-11-01 to 2015-11-30', '0', 10),
(31, 'vidda', 'colombo', '2015-11-09', '2015-11-09 to 2015-11-27', '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_custodian_relationship`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_custodian_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_relationship` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_follow_up_custodian_relationship`
--

INSERT INTO `tbl_follow_up_custodian_relationship` (`id`, `fld_relationship`) VALUES
(1, 'Mother'),
(2, 'Father'),
(3, 'Brother'),
(4, 'Sister'),
(5, 'Partner'),
(6, 'Spouse'),
(7, 'Children'),
(8, 'Mother in Law'),
(9, 'Father in Law'),
(10, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_custodion_details`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_custodion_details` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(60) DEFAULT NULL,
  `fld_address` varchar(60) DEFAULT NULL,
  `fld_contact_mobile` char(10) DEFAULT NULL,
  `fld_contact_fixed` char(10) DEFAULT NULL,
  `fld_relationship` varchar(25) DEFAULT NULL,
  `fld_relationship_other` varchar(20) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tbl_follow_up_custodion_details`
--

INSERT INTO `tbl_follow_up_custodion_details` (`form_id`, `fld_name`, `fld_address`, `fld_contact_mobile`, `fld_contact_fixed`, `fld_relationship`, `fld_relationship_other`) VALUES
(53, 'Ashan Rupasinghe', '205, Temple Road, Wegowwa.', '0711846060', '0113078678', 'Other', 'cursing Brother'),
(54, 'Lakmini Kalugampitiya', '20, Main Road, Ampara', '0780012346', '', 'Other', 'Wife'),
(55, 'Gayan Sanjiwa', '20, Negombo Road, Batapotha, Udugampola', '0700111121', '0320012345', 'Father', '-'),
(56, 'Menka Rajapakse', '20, Wakshall Street Colombo 02', '0700111121', '0112200344', 'Brother', '-'),
(57, 'Kamal Thenwara', '230, Nawala', '0778030123', '', 'Father', '-'),
(58, 'Saduni Gamage', '20, Madelgamuwa, Gampaha.', '0772075150', '0331212121', 'Other', 'Teacher'),
(59, 'Gayan Sanjiwa', '2,Batapotha, hambanthota.', '0778030123', '0112200344', 'Brother', '-'),
(60, 'Visal Madusanka', '30, Ambalangoda', '0711111112', '0112222222', 'Other', 'Friend'),
(62, 'Ashan Rupasinghe', '2,Batapotha, madelgamuwa.X', '0711111112', '0112200344', 'Other', 'Friend');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_dis_prison`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_dis_prison` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_client_name` varchar(150) DEFAULT NULL,
  `fld_prison_name` varchar(50) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_location` varchar(100) DEFAULT NULL,
  `fld_time_period` varchar(45) DEFAULT NULL,
  `fld_relapse_or_not` int(11) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_follow_up_dis_prison`
--

INSERT INTO `tbl_follow_up_dis_prison` (`tbl_id`, `fld_client_name`, `fld_prison_name`, `fld_date`, `fld_location`, `fld_time_period`, `fld_relapse_or_not`, `fld_form_id`) VALUES
(1, 'dheha', 'sd', '2015-09-01', 'sdasd', '2015-02-02 to 2015-09-19', 0, NULL),
(2, 'gggggg', 'ddd', '2015-09-01', 'sdf', '2015-09-02 to 2015-09-24', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_dis_treatment`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_dis_treatment` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_client_name` varchar(150) DEFAULT NULL,
  `fld_center_name` varchar(50) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_location` varchar(100) DEFAULT NULL,
  `fld_time_period` varchar(45) DEFAULT NULL,
  `fld_relapse_or_not` int(11) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_follow_up_dis_treatment`
--

INSERT INTO `tbl_follow_up_dis_treatment` (`tbl_id`, `fld_client_name`, `fld_center_name`, `fld_date`, `fld_location`, `fld_time_period`, `fld_relapse_or_not`, `fld_form_id`) VALUES
(2, 'asdfadfaaaaaaaaa', 'asd', '2015-09-06', 'sdg', '2015-09-01 to 2015-09-30', 1, NULL),
(3, 'fddgdgdg', 'ydtdy', '2015-10-07', 'shgs', '2015-10-20 to 2015-10-30', 0, 1),
(4, 'gjkgjh', 'ghadfh', '2015-10-06', 'jfkkkkkkk', '2015-10-07 to 2015-10-22', 0, 1),
(5, 'dfa', 'af', '2015-10-01', 'asf', '2015-10-14 to 2015-10-29', 0, 1),
(6, 'vidda', 'colombo', '2015-11-02', 'nawala', '2015-11-01 to 2015-11-30', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_family`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_family` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_client_name` varchar(150) DEFAULT NULL,
  `fld_relationship` varchar(50) DEFAULT NULL,
  `fld_location` varchar(100) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_follow_up_family`
--

INSERT INTO `tbl_follow_up_family` (`tbl_id`, `fld_client_name`, `fld_relationship`, `fld_location`, `fld_date`, `fld_form_id`) VALUES
(1, 'zxc', 'xc', 'zxc', '2015-09-10', NULL),
(2, 'jjjjjjjjjjjjjjj', 'jjjjjjjjjjjjjjj', 'jjjjjj', '2015-09-09', NULL),
(3, '123', '', '', '0000-00-00', 2),
(4, 'Nalee', 'mother', 'Galle', '0000-00-00', 1),
(5, 'Methshan', 'father', 'thimbirigasyaya', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_follow_up_no` int(2) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_place` varchar(45) DEFAULT NULL,
  `fld_officer_name` varchar(60) DEFAULT NULL,
  `fld_activities` varchar(40) DEFAULT NULL,
  `fld_client_status` varchar(9) DEFAULT NULL,
  `fld_if_abstinent` varchar(9) DEFAULT NULL,
  `fld_respect_and_honour_from_family` varchar(3) DEFAULT NULL,
  `fld_respect_and_honour_from_relation` varchar(3) DEFAULT NULL,
  `fld_respect_and_honour_from_neighbour` varchar(3) DEFAULT NULL,
  `fld_respect_and_honour_to_family` varchar(3) DEFAULT NULL,
  `fld_respect_and_honour_to_relation` varchar(3) DEFAULT NULL,
  `fld_respect_and_honour_to_neighbour` varchar(3) DEFAULT NULL,
  `fld_employment` varchar(25) DEFAULT NULL,
  `fld_Income` varchar(11) DEFAULT NULL,
  `fld_clientsfeedback` longtext,
  `fld_officer_bservation` longtext,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `tbl_follow_up_feedback`
--

INSERT INTO `tbl_follow_up_feedback` (`id`, `fld_follow_up_no`, `fld_date`, `fld_place`, `fld_officer_name`, `fld_activities`, `fld_client_status`, `fld_if_abstinent`, `fld_respect_and_honour_from_family`, `fld_respect_and_honour_from_relation`, `fld_respect_and_honour_from_neighbour`, `fld_respect_and_honour_to_family`, `fld_respect_and_honour_to_relation`, `fld_respect_and_honour_to_neighbour`, `fld_employment`, `fld_Income`, `fld_clientsfeedback`, `fld_officer_bservation`, `form_id`) VALUES
(19, 1, '2015-10-20', 'Miuwangoda', 'Test', 'Helthly activities', 'Abstinent', 'Permanent', 'No', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Full-time (More 40 Hours)', 'Below 5000', 'Good', 'Not Bad', 54),
(84, 1, '2015-09-01', 'Minuwangoda', 'Ashan', 'Economic buildup activities', 'Relabse', '-', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Full-time (More 40 Hours)', 'Below 5000', 'test', 'test', 55),
(85, 2, '2015-10-01', 'Minuwangoda', 'Neranja', 'Economic buildup activities', 'Relabse', '-', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Full-time (More 40 Hours)', 'Below 5000', 'test 2', 'test 2', 55),
(86, 3, '2015-09-29', 'Kamaragoda', 'Ashani', 'Economic buildup activities', 'Relabse', '-', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Full-time (More 40 Hours)', 'Below 5000', 'test Ashan', 'test Ashan', 55),
(87, 4, '2015-10-26', 'Ucsc', 'Ashan', 'Economic buildup activities', 'Relabse', '-', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Full-time (More 40 Hours)', 'Below 5000', 'test Ashanx', 'test Ashanx', 55),
(88, 5, '2015-10-26', 'Gampaha', 'Kasun Sampath', 'Economic buildup activities', 'Relabse', '-', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Part-time (Regular Hours)', 'Below 5000', 'sasa', 'ass', 55);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_income`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_income` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_follow_up_income`
--

INSERT INTO `tbl_follow_up_income` (`id`, `fld_income`) VALUES
(1, 'Below 5000'),
(2, '5001-10000'),
(3, '10001-15000'),
(4, '15001-20000'),
(5, '20001-25000'),
(6, 'More 25001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_nature_of_asset`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_nature_of_asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_nature` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_follow_up_nature_of_asset`
--

INSERT INTO `tbl_follow_up_nature_of_asset` (`id`, `fld_nature`) VALUES
(1, 'Own Property'),
(2, 'Parents Property'),
(3, 'Spouse''s Property'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_personal_details`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_personal_details` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(45) DEFAULT NULL,
  `fld_client_id` char(11) DEFAULT NULL,
  `fld_gender` varchar(6) DEFAULT NULL,
  `fld_race` varchar(16) DEFAULT NULL,
  `fld_religion` varchar(12) DEFAULT NULL,
  `fld_id` char(10) DEFAULT NULL,
  `fld_address` varchar(70) DEFAULT NULL,
  `fld_road_map` varchar(300) DEFAULT NULL,
  `fld_if_available_link` varchar(300) DEFAULT NULL,
  `fld_district` varchar(15) DEFAULT NULL,
  `fld_divisional_secretariats` varchar(45) DEFAULT NULL,
  `fld_birthday` date DEFAULT NULL,
  `fld_age` int(3) DEFAULT NULL,
  `fld_edu_school_attempted` varchar(3) DEFAULT NULL,
  `fld_edu_level` varchar(10) DEFAULT NULL,
  `fld_edu_level_other` varchar(30) NOT NULL,
  `fld_contact_mobile` char(10) DEFAULT NULL,
  `fld_contact_fixed` char(10) DEFAULT NULL,
  `fld_status` varchar(9) DEFAULT NULL,
  `fld_no_of_children` int(2) DEFAULT NULL,
  `fld_children_under_18` int(2) DEFAULT NULL,
  `fld_medi_hospitalized_time` int(3) DEFAULT NULL,
  `fld_medi_chronic_medical` varchar(3) DEFAULT NULL,
  `fld_medi_chronic_medical_descript` varchar(80) DEFAULT NULL,
  `fld_medi_pregnancy` varchar(3) DEFAULT NULL,
  `fld_medi_pregnancy_meet_doctor` varchar(3) DEFAULT NULL,
  `fld_employment` varchar(30) DEFAULT NULL,
  `fld_emp_income` varchar(21) DEFAULT NULL,
  `fld_emp_capital_for_recovery` varchar(13) DEFAULT NULL,
  `fld_emp_people_depend_on` int(2) DEFAULT NULL,
  `fld_emp_nature_of_asset` varchar(17) DEFAULT NULL,
  `fld_legal_status_admission_by_cjs` varchar(3) DEFAULT NULL,
  `fld_alcohol_drug_nature_of_depend` varchar(20) DEFAULT NULL,
  `fld_alcohol_drug_rout_of_adminstration` varchar(16) DEFAULT NULL,
  `fld_alcohol_drug_first_use_age` int(2) NOT NULL,
  `fld_alcohol_drug_use_per_day` int(2) DEFAULT NULL,
  PRIMARY KEY (`form_id`),
  UNIQUE KEY `fld_client_id_UNIQUE` (`fld_client_id`),
  UNIQUE KEY `fld_id_UNIQUE` (`fld_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tbl_follow_up_personal_details`
--

INSERT INTO `tbl_follow_up_personal_details` (`form_id`, `fld_name`, `fld_client_id`, `fld_gender`, `fld_race`, `fld_religion`, `fld_id`, `fld_address`, `fld_road_map`, `fld_if_available_link`, `fld_district`, `fld_divisional_secretariats`, `fld_birthday`, `fld_age`, `fld_edu_school_attempted`, `fld_edu_level`, `fld_edu_level_other`, `fld_contact_mobile`, `fld_contact_fixed`, `fld_status`, `fld_no_of_children`, `fld_children_under_18`, `fld_medi_hospitalized_time`, `fld_medi_chronic_medical`, `fld_medi_chronic_medical_descript`, `fld_medi_pregnancy`, `fld_medi_pregnancy_meet_doctor`, `fld_employment`, `fld_emp_income`, `fld_emp_capital_for_recovery`, `fld_emp_people_depend_on`, `fld_emp_nature_of_asset`, `fld_legal_status_admission_by_cjs`, `fld_alcohol_drug_nature_of_depend`, `fld_alcohol_drug_rout_of_adminstration`, `fld_alcohol_drug_first_use_age`, `fld_alcohol_drug_use_per_day`) VALUES
(53, 'assasaassas asas', 'MIN-M-00001', 'Male', 'Sinhalese', 'Buddhism', '872143955V', '230/C, Near The Court, Minuwangoda', 'Go Alon the Road on Veyangoda Road from Minuwangoda,\r\nTurn Left at Court', 'No', 'Gampaha', 'Minuwangoda', '1987-07-16', 27, 'Yes', 'O/L', '-', '0774724272', '', 'Single', 0, 0, 1, 'No', '-', 'No', '-', 'Full-time (More 40 Hours)', 'Below 5000', 'Available', 5, 'Parents Property', 'Yes', 'Heroin', 'Oral', 12, 2),
(54, 'Sinhala Pedige Prasna madusanka Rupasinghe', 'MIN-M-0002', 'Male', 'Sinhalese', 'Buddhism', '872233955V', '205, Temple Road, Wegowwa', 'Go along Wegowwa Cross Road, Turn right at Temple Road', 'No', 'Gampaha', 'Minuwangoda', '1987-10-10', 27, 'Yes', 'A/L', '-', '0781846060', '0113078123', 'Single', 0, 0, 5, 'Yes', 'test ', 'No', '-', 'Unemployed', 'Below 5000', 'Available', 6, 'Parents Property', 'Yes', 'Alcohol', 'Oral', 20, 1),
(55, 'Lakshman Smarasekara edited', 'GAM-M-00001', 'Male', 'Sinhalese', 'Cristianity', '910253852V', '23, Pahalagama, Gampaha', 'near the Temple', 'NO', 'Gampaha', 'Gampaha', '1991-01-25', 24, 'Yes', 'Other', 'AC- NVQ level 3', '0781846060', '0113078123', 'Married', 1, 0, 1, 'No', '-', 'No', '-', 'Part-time (Regular Hours)', 'Below 5000', 'Available', 6, 'Parents Property', 'Yes', 'Alcohol', 'Oral', 12, 2),
(56, 'Kasun Gamlath', 'KUR-M-00001', 'Male', 'Sri Lankan Tamil', 'Hinduism', '890233955V', '20, Kelin Vidiya, Kurunegala', 'Near Kurunegala Hospital', 'No', 'Kurunegala', 'Kurunegala', '1989-01-23', 25, 'No', 'Grade 5', '-', '0715833917', '0113078123', 'Married', 4, 0, 1, 'Yes', 'test', 'No', '-', 'Student', 'Below 5000', 'Available', 6, 'Own Property', 'Yes', 'Babul', 'Oral', 12, 2),
(57, 'Vidushani Tenuwara', 'COL-F-00001', 'Female', 'Sinhalese', 'Buddhism', '915233955V', '230, Nawala', 'bla bla bla', 'No', 'Colombo', 'Nawala', '1991-01-23', 24, 'Yes', 'Degree', '-', '0715833917', '0113078123', 'Single', 0, 0, 1, 'No', '-', 'No', '-', 'Full-time (More 40 Hours)', 'Below 5000', 'Available', 0, 'Parents Property', 'Yes', 'Alcohol', 'Smoking', 20, 3),
(58, 'Harsha Kodikara', 'GM-M-00001', 'Male', 'Sinhalese', 'Buddhism', '880533955V', '10, Pahalagama, Gampaha', 'bla bla', 'NO', 'Gampaha', 'Gampaha', '1988-02-22', 26, 'Yes', 'Grade 5', '-', '0751846060', '0332078678', 'Married', 1, 0, 1, 'No', '-', 'No', '-', 'Full-time (More 40 Hours)', 'Below 5000', 'Available', 3, 'Own Property', 'Yes', 'Babul', 'Under tongue', 18, 1),
(59, 'Naresh Raju', 'HAM-M-00001', 'Male', 'Indian Tamil', 'Hinduism', '902221212V', '20, Veravila, Hambanthota.', 'jas', 'jas', 'Hambanthota', 'Veravila', '1990-06-12', 25, 'Yes', 'Grade 5', '-', '0715833917', '0113978678', 'Single', 0, 0, 0, 'No', '-', 'No', '-', 'Full-time (More 40 Hours)', 'Below 5000', 'Available', 6, 'Own Property', 'Yes', 'More than one source', 'Oral', 12, 0),
(60, 'Nisal Upendra', 'GAL-M-00001', 'Male', 'Sinhalese', 'Buddhism', '780233955V', '205, Ambalangoda', 'bla bla', 'No', 'Galle', 'Ambalangoda', '1978-01-23', 39, 'Yes', 'Grade 7', '-', '0715833917', '0113078123', 'Married', 3, 2, 1, 'No', '-', 'No', '-', 'Full-time (More 40 Hours)', 'Below 5000', 'Available', 6, 'Own Property', 'Yes', 'Cocain', 'Nasal', 20, 2),
(62, 'Kumara Sangakkara', 'CT1-M-00001', 'Male', 'Sinhalese', 'Buddhism', '871133955V', '120, temole road, Wegowwa', 'fddffd', 'No Link', 'Gampaha', 'Minuwangoda', '1987-04-08', 0, 'Yes', 'Grade 5', '-', '0715833917', '0385833917', 'Married', 1, 0, 5, 'No', '-', 'No', '-', 'Full-time (More 40 Hours)', 'Below 5000', 'Available', 6, 'Own Property', 'Yes', 'Heroin', 'Oral', 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_status`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_status` (
  `fld_form_id` int(11) NOT NULL,
  `fld_client_accept_reject_followup` int(1) NOT NULL,
  `fld_client_insert_officer` varchar(30) NOT NULL,
  `fld_client_insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fld_assigned_cente` varchar(40) NOT NULL,
  `fld_client_update_officer` varchar(30) DEFAULT NULL,
  `fld_client_update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fld_assigned_by` varchar(40) DEFAULT NULL,
  `fld_free_drug` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fld_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_follow_up_status`
--

INSERT INTO `tbl_follow_up_status` (`fld_form_id`, `fld_client_accept_reject_followup`, `fld_client_insert_officer`, `fld_client_insert_date`, `fld_assigned_cente`, `fld_client_update_officer`, `fld_client_update_date`, `fld_assigned_by`, `fld_free_drug`) VALUES
(53, 0, 'test', '2015-10-23 05:47:59', '1', 'admin', '2015-11-18 06:30:28', NULL, 0),
(54, 1, 'test', '2015-10-23 06:30:49', '4', 'admin', '2015-11-18 06:28:34', NULL, 1),
(55, 1, 'test', '2015-10-23 06:48:14', '4', 'test', '2015-11-18 03:01:09', NULL, 1),
(56, 1, 'center', '2015-10-23 07:28:31', '3', 'center', '2015-11-19 01:05:02', 'out3', 1),
(57, 1, 'admin', '2015-10-25 22:23:03', '1', 'admin', '2015-11-18 02:13:33', 'test', 1),
(58, 1, 'admin', '2015-10-26 01:30:44', '1', 'admin', '2015-11-18 02:13:37', 'out2', 0),
(59, 1, 'admin', '2015-10-26 02:12:03', '1', 'admin', '2015-10-26 02:12:03', 'test', 0),
(60, 1, 'admin', '2015-10-26 03:49:12', '1', 'out3', '2015-10-28 06:11:03', 'out3', 1),
(62, 1, 'out3', '2015-11-02 02:27:23', '2', 'admin', '2015-11-18 06:28:03', NULL, 0),
(63, 0, 'test', '2015-11-09 04:42:51', '', 'test', '2015-11-16 01:06:07', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_follow_up_treatment_progress`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_up_treatment_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_attempt` int(2) DEFAULT NULL,
  `fld_attempt_centet` varchar(20) DEFAULT NULL,
  `fld_enter_date` date DEFAULT NULL,
  `fld_discharge_date` date DEFAULT NULL,
  `fld_counsellor_name` varchar(60) DEFAULT NULL,
  `fld_counsellor_observation` longtext,
  `fld_counsellor_summary` varchar(200) DEFAULT NULL,
  `fld_duration_y` int(2) DEFAULT NULL,
  `fld_duration_m` int(2) DEFAULT NULL,
  `fld_duration_d` int(2) DEFAULT NULL,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_follow_up_treatment_progress`
--

INSERT INTO `tbl_follow_up_treatment_progress` (`id`, `fld_attempt`, `fld_attempt_centet`, `fld_enter_date`, `fld_discharge_date`, `fld_counsellor_name`, `fld_counsellor_observation`, `fld_counsellor_summary`, `fld_duration_y`, `fld_duration_m`, `fld_duration_d`, `form_id`) VALUES
(18, 1, 'center one', '2015-05-01', '2015-05-31', 'Rangika', 'Test edit add2', 'Test edit add2', 0, 1, 0, 55),
(19, 2, 'center one', '2015-06-01', '2015-06-30', 'Wickramasinghe', 'Test edit add 3', 'Test edit Add3', 0, 0, 29, 55),
(20, 3, 'center one', '2015-10-01', '2015-10-26', 'Kalpa Chaturanga', 'skla4', 'lksalksa4', 0, 0, 25, 55),
(21, 1, 'center three', '2015-10-20', '2015-10-27', 'asas', 'asas', 'saas', 0, 0, 7, 54),
(22, 2, 'center one', '2015-10-01', '2015-09-29', 'xxxxx', 'asasasas', 'assasass', 0, 0, 2, 54);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monthly_plan_form`
--

CREATE TABLE IF NOT EXISTS `tbl_monthly_plan_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_month` varchar(45) CHARACTER SET utf8 NOT NULL,
  `fld_district` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_username` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_monthly_plan_form`
--

INSERT INTO `tbl_monthly_plan_form` (`form_id`, `fld_month`, `fld_district`, `fld_username`) VALUES
(1, 'January 2015', NULL, 'test'),
(2, 'February 2015', NULL, 'test'),
(3, 'September 2015', NULL, 'test'),
(4, 'October 2015', 'Southern', 'test'),
(5, 'December 2015', 'Ampara', 'test'),
(6, 'October 2015', 'Ampara', 'admin'),
(7, 'November 2015', 'Puttalam', 'admin'),
(8, 'November 2015', 'Colombo', '926520085v');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monthly_summary_form`
--

CREATE TABLE IF NOT EXISTS `tbl_monthly_summary_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_month` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_district` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_username` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_monthly_summary_form`
--

INSERT INTO `tbl_monthly_summary_form` (`form_id`, `fld_month`, `fld_district`, `fld_username`) VALUES
(1, 'August 2015', 'Central', 'test'),
(2, 'September 2015', 'Sabaragamuwa', 'test'),
(3, 'October 2015', 'Eastern', 'test'),
(4, 'July 2015', 'Northern', 'test'),
(7, 'October 2015', 'Anuradhapura', 'test'),
(8, 'November 2015', 'Hambanthota', 'test'),
(9, 'December 2015', 'Ampara', 'test'),
(10, 'October 2015', 'Colombo', '926520085v');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_monthly_work_plan`
--

CREATE TABLE IF NOT EXISTS `tbl_monthly_work_plan` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_date` date DEFAULT NULL,
  `fld_target_group` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_location` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_program` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_start_time` varchar(20) DEFAULT NULL,
  `fld_end_time` varchar(20) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_monthly_work_plan`
--

INSERT INTO `tbl_monthly_work_plan` (`tbl_id`, `fld_date`, `fld_target_group`, `fld_location`, `fld_program`, `fld_start_time`, `fld_end_time`, `fld_form_id`) VALUES
(14, '2015-11-04', 'school', 'panadura', '', '8:30 AM', '5:30 PM', 8),
(15, '2015-11-04', 'women', 'kohuwala', '', '10:00 AM', '2:30 PM', 8),
(16, '0000-00-00', '', '', '', '', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nature_of_depend`
--

CREATE TABLE IF NOT EXISTS `tbl_nature_of_depend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_depend_nature` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_nature_of_depend`
--

INSERT INTO `tbl_nature_of_depend` (`id`, `fld_depend_nature`) VALUES
(1, 'Heroin'),
(2, 'Cannabis'),
(3, 'Alcohol'),
(4, 'Opium'),
(5, 'Cocain'),
(6, 'Tablet'),
(7, 'Babul'),
(8, 'More than one source'),
(9, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_cgm`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_cgm` (
  `tbl_id` int(11) NOT NULL,
  `fld_type` varchar(45) DEFAULT NULL,
  `fld_name` varchar(150) DEFAULT NULL,
  `fld_date` varchar(45) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_expenditure` varchar(45) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_community`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_community` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_programme` varchar(100) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_expenditure` varchar(45) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_prg_community`
--

INSERT INTO `tbl_prg_community` (`tbl_id`, `fld_programme`, `fld_participant_no`, `fld_remark`, `fld_expenditure`, `fld_date`, `fld_form_id`) VALUES
(1, 'hgfhfhf', 40, 'fgs', '4500', '2015-09-01', NULL),
(2, 'fgd', 45, 'ghfgf', 'fghfh', '2015-09-09', NULL),
(3, 'nghh', 40, 'oooh noooooooo!', '12000', '2015-10-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_community_society`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_community_society` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_society_name` varchar(150) DEFAULT NULL,
  `fld_date` varchar(45) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_expenditure` varchar(45) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_prg_community_society`
--

INSERT INTO `tbl_prg_community_society` (`tbl_id`, `fld_society_name`, `fld_date`, `fld_participant_no`, `fld_remark`, `fld_expenditure`, `fld_form_id`) VALUES
(1, 'Children', '2015-09-08', 45, 'ghdhdghdf', '12000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_daham_scl`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_daham_scl` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name_location` varchar(150) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_prg_daham_scl`
--

INSERT INTO `tbl_prg_daham_scl` (`tbl_id`, `fld_name_location`, `fld_date`, `fld_participant_no`, `fld_remark`, `fld_form_id`) VALUES
(1, 'dafafaf', '2015-08-04', 150, 'jfgh', NULL),
(2, 'avaaa', '0000-00-00', 0, '', NULL),
(3, 'vajirarama, bambalapitiya', '0000-00-00', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_for_drivers`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_for_drivers` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_type` varchar(45) DEFAULT NULL,
  `fld_location` varchar(150) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_prg_for_drivers`
--

INSERT INTO `tbl_prg_for_drivers` (`tbl_id`, `fld_type`, `fld_location`, `fld_participant_no`, `fld_date`, `fld_form_id`) VALUES
(1, 'three_wheel', 'dffssssssssssssss', 10, NULL, NULL),
(2, 'van', 'xgf', 0, NULL, NULL),
(3, 'three_wheel', 'dfg', 0, NULL, NULL),
(4, 'bus', 'zxcb', 20, NULL, NULL),
(5, 'van', 'dsgfdg', 25, NULL, NULL),
(6, '0', 'nugegoda', 50, NULL, NULL),
(7, 'bus', 'kottawa', 25, NULL, NULL),
(8, 'van', 'nugegoda', 24, NULL, NULL),
(9, 'van', 'kottawa', 40, '2015-10-26', 1),
(10, 'three_wheel', 'nawala', 15, '2015-10-03', 1),
(11, 'van', '', 0, '2015-10-06', 1),
(12, 'van', '', 0, '2015-10-04', 1),
(13, 'bus', 'gfh', 40, '0000-00-00', 1),
(14, 'bus', 'location2', 10, '2015-10-04', 1),
(15, 'three_wheel', 'location1', 18, '2015-10-05', 1),
(16, 'van', 'hlhl', 0, '2015-10-05', 1),
(17, 'van', 'gfgs', 45, '2015-10-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_gov_non_institute`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_gov_non_institute` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_institute_name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_date` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_expenditure` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_prg_gov_non_institute`
--

INSERT INTO `tbl_prg_gov_non_institute` (`tbl_id`, `fld_institute_name`, `fld_date`, `fld_participant_no`, `fld_remark`, `fld_expenditure`, `fld_form_id`) VALUES
(1, 'institute', '2015-08-04', 200, 'fgdg', '10000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_mobile`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_mobile` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_location` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_date` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fld_expenditure` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_prg_mobile`
--

INSERT INTO `tbl_prg_mobile` (`tbl_id`, `fld_location`, `fld_date`, `fld_participant_no`, `fld_remark`, `fld_expenditure`, `fld_form_id`) VALUES
(1, 'colombo', '2015-08-04', 50, 'xfgdg', '5000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_pharmacy`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_pharmacy` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_name` varchar(100) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_paricipant_no` int(11) DEFAULT NULL,
  `fld_date` varchar(45) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_prg_pharmacy`
--

INSERT INTO `tbl_prg_pharmacy` (`tbl_id`, `fld_name`, `fld_remark`, `fld_paricipant_no`, `fld_date`, `fld_form_id`) VALUES
(1, 'vgd', 'dfg', 0, '2015-08-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_school`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_school` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_school` varchar(100) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_type` varchar(100) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_prg_school`
--

INSERT INTO `tbl_prg_school` (`tbl_id`, `fld_school`, `fld_date`, `fld_type`, `fld_participant_no`, `fld_remark`, `fld_form_id`) VALUES
(1, 'gbdg', '2015-09-01', 'fgdfg', 45, 'fgdgd', NULL),
(2, 'fgdgd', '2015-09-02', 'fgdg', 55, 'fghf', NULL),
(3, '0', '0000-00-00', 'bus', 25, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_sqs`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_sqs` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_school` varchar(100) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_status` varchar(45) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_remark` varchar(150) DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_prg_sqs`
--

INSERT INTO `tbl_prg_sqs` (`tbl_id`, `fld_school`, `fld_date`, `fld_status`, `fld_participant_no`, `fld_remark`, `fld_form_id`) VALUES
(1, '', '0000-00-00', '', 0, '', NULL),
(2, 'sbv', '2015-10-07', 'active', 40, 'good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prg_tuition`
--

CREATE TABLE IF NOT EXISTS `tbl_prg_tuition` (
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_institute` varchar(150) DEFAULT NULL,
  `fld_remarks` varchar(150) DEFAULT NULL,
  `fld_participant_no` int(11) DEFAULT NULL,
  `fld_expenditure` varchar(45) DEFAULT NULL,
  `fld_date` date DEFAULT NULL,
  `fld_form_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_prg_tuition`
--

INSERT INTO `tbl_prg_tuition` (`tbl_id`, `fld_institute`, `fld_remarks`, `fld_participant_no`, `fld_expenditure`, `fld_date`, `fld_form_id`) VALUES
(1, 'sdfl', 'gggg', 200, '15000', '2015-09-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_race`
--

CREATE TABLE IF NOT EXISTS `tbl_race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_race_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_race`
--

INSERT INTO `tbl_race` (`id`, `fld_race_name`) VALUES
(1, 'Sinhalese'),
(2, 'Sri Lankan Tamil'),
(3, 'Indian Tamil'),
(4, 'Moor'),
(5, 'Burgher'),
(6, 'Malay'),
(7, 'Kaffir'),
(8, 'Vedda');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_religion`
--

CREATE TABLE IF NOT EXISTS `tbl_religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_religion_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_religion`
--

INSERT INTO `tbl_religion` (`id`, `fld_religion_name`) VALUES
(1, 'Buddhism'),
(2, 'Hinduism'),
(3, 'Islam'),
(4, 'Cristianity');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route_of_administration`
--

CREATE TABLE IF NOT EXISTS `tbl_route_of_administration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_administration_route` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_route_of_administration`
--

INSERT INTO `tbl_route_of_administration` (`id`, `fld_administration_route`) VALUES
(1, 'Oral'),
(2, 'Nasal'),
(3, 'Smoking'),
(4, 'Non-IV Injection'),
(5, 'IV Injection'),
(6, 'Under tongue');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_level`
--

CREATE TABLE IF NOT EXISTS `tbl_school_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_level` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_school_level`
--

INSERT INTO `tbl_school_level` (`id`, `fld_level`) VALUES
(1, 'Grade 5'),
(2, 'Grade 6'),
(3, 'Grade 7'),
(4, 'Grade 8'),
(5, 'Grade 9'),
(6, 'Grade 10'),
(7, 'O/L'),
(8, 'A/L'),
(9, 'Diploma'),
(10, 'Degree'),
(11, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `fld_status`) VALUES
(3, 'Married'),
(4, 'Single'),
(5, 'Widowed'),
(7, 'Divorced'),
(8, 'Remarried'),
(9, 'Separated');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_table_header`
--

CREATE TABLE IF NOT EXISTS `tbl_table_header` (
  `tbl_header_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_table_no` int(11) DEFAULT NULL,
  `fld_heading_name` varchar(100) DEFAULT NULL,
  `fld_save_table` varchar(45) DEFAULT NULL,
  `fld_save_column` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tbl_header_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `tbl_table_header`
--

INSERT INTO `tbl_table_header` (`tbl_header_id`, `fld_table_no`, `fld_heading_name`, `fld_save_table`, `fld_save_column`) VALUES
(1, 1, 'Drug', 'tbl_drug_users', 'fld_drug_id'),
(2, 1, 'New Identity', 'tbl_drug_users', 'fld_new_identity'),
(3, 1, 'Cum. Total', 'tbl_drug_users', 'fld_identity_total'),
(4, 1, 'New Regis', 'tbl_drug_users', 'fld_new_registered'),
(5, 1, 'Cum. Regis', 'tbl_drug_users', 'fld_registered_total'),
(6, 1, 'Services Provided', 'tbl_drug_users', 'fld_services_provided'),
(7, 1, 'Ref.', 'tbl_drug_users', 'fld_ref'),
(8, 1, 'Free From Drug', 'tbl_drug_users', 'fld_free_from_drug'),
(9, 1, 'Cum. Total', 'tbl_drug_users', 'fld_free_from_drug_total'),
(10, 2, 'Name of the Client', 'tbl_follow_up_community', 'fld_client_name'),
(11, 2, 'Location', 'tbl_follow_up_community', 'fld_location'),
(12, 2, 'Date', 'tbl_follow_up_community', 'fld_date'),
(13, 2, 'Time Period', 'tbl_follow_up_community', 'fld_time_period'),
(14, 2, 'Relapse/ Not Relapse', 'tbl_follow_up_community', 'fld_relapse_or_not'),
(15, 3, 'Name of the Client', 'tbl_follow_up_family', 'fld_client_name'),
(16, 3, 'Relationship with Client', 'tbl_follow_up_family', 'fld_relationship'),
(17, 3, 'Location', 'tbl_follow_up_family', 'fld_location'),
(18, 3, 'Date', 'tbl_follow_up_family', 'fld_date'),
(19, 4, 'Name of the Client', 'tbl_follow_up_dis_treatment', 'fld_client_name'),
(20, 4, 'Center Name', 'tbl_follow_up_dis_treatment', 'fld_center_name'),
(21, 4, 'Date', 'tbl_follow_up_dis_treatment', 'fld_date'),
(22, 4, 'Location', 'tbl_follow_up_dis_treatment', 'fld_location'),
(23, 4, 'Time Period', 'tbl_follow_up_dis_treatment', 'fld_time_period'),
(24, 4, 'Relapse/ Not Relapse', 'tbl_follow_up_dis_treatment', 'fld_relapse_or_not'),
(25, 5, 'Name of the Client', 'tbl_follow_up_dis_prison', 'fld_client_name'),
(26, 5, 'Prison Name', 'tbl_follow_up_dis_prison', 'fld_prison_name'),
(27, 5, 'Date', 'tbl_follow_up_dis_prison', 'fld_date'),
(28, 5, 'Location', 'tbl_follow_up_dis_prison', 'fld_location'),
(29, 5, 'Time Period', 'tbl_follow_up_dis_prison', 'fld_time_period'),
(30, 5, 'Relapse/ Not Relapse', 'tbl_follow_up_dis_prison', 'fld_relapse_or_not'),
(31, 6, 'Type', 'tbl_prg_for_drivers', 'fld_type'),
(32, 6, 'Location', 'tbl_prg_for_drivers', 'fld_location'),
(33, 6, 'No of  Participants', 'tbl_prg_for_drivers', 'fld_participant_no'),
(34, 7, 'Programme', 'tbl_prg_community', 'fld_programme'),
(35, 7, 'No of participants', 'tbl_prg_community', 'fld_participant_no'),
(36, 7, 'Remark', 'tbl_prg_community', 'fld_remark'),
(37, 7, 'Expenditure', 'tbl_prg_community', 'fld_expenditure'),
(38, 7, 'Date', 'tbl_prg_community', 'fld_date'),
(39, 8, 'School', 'tbl_prg_school', 'fld_school'),
(40, 8, 'Date', 'tbl_prg_school', 'fld_date'),
(41, 8, 'Type of Programme', 'tbl_prg_school', 'fld_type'),
(42, 8, 'No of participants', 'tbl_prg_school', 'fld_participant_no'),
(43, 8, 'Remark', 'tbl_prg_school', 'fld_remark'),
(44, 9, 'School', 'tbl_prg_sqs', 'fld_school'),
(45, 9, 'Date', 'tbl_prg_sqs', 'fld_date'),
(46, 9, 'Status', 'tbl_prg_sqs', 'fld_status'),
(47, 9, 'No of Participants', 'tbl_prg_sqs', 'fld_participant_no'),
(48, 9, 'Remark', 'tbl_prg_sqs', 'fld_remark'),
(49, 10, 'Daham School Name and Location', 'tbl_prg_daham_scl', 'fld_name_location'),
(50, 10, 'Date', 'tbl_prg_daham_scl', 'fld_date'),
(51, 10, 'No of  Participants', 'tbl_prg_daham_scl', 'fld_participant_no'),
(52, 10, 'Remark', 'tbl_prg_daham_scl', 'fld_remark'),
(53, 11, 'Institute Name', 'tbl_prg_tuition', 'fld_institute'),
(54, 11, 'Remarks', 'tbl_prg_tuition', 'fld_remarks'),
(55, 11, 'No of  Participants', 'tbl_prg_tuition', 'fld_participant_no'),
(56, 11, 'Expenditure', 'tbl_prg_tuition', 'fld_expenditure'),
(57, 11, 'Date', 'tbl_prg_tuition', 'fld_date'),
(58, 12, 'Society Name', 'tbl_prg_community_society', 'fld_society_name'),
(59, 12, 'Date', 'tbl_prg_community_society', 'fld_date'),
(60, 12, 'No of  Participants', 'tbl_prg_community_society', 'fld_participant_no'),
(61, 12, 'Remarks', 'tbl_prg_community_society', 'fld_remark'),
(62, 12, 'Expenditure', 'tbl_prg_community_society', 'fld_expenditure'),
(63, 13, 'Institute Name', 'tbl_prg_gov_non_institute', 'fld_institute_name'),
(64, 13, 'Date', 'tbl_prg_gov_non_institute', 'fld_date'),
(65, 13, 'No of Participants', 'tbl_prg_gov_non_institute', 'fld_participant_no'),
(66, 13, 'Remarks', 'tbl_prg_gov_non_institute', 'fld_remark'),
(67, 13, 'Expenditure', 'tbl_prg_gov_non_institute', 'fld_expenditure'),
(68, 14, 'Location', 'tbl_prg_mobile', 'fld_location'),
(69, 14, 'Date', 'tbl_prg_mobile', 'fld_date'),
(70, 14, 'No of Participants', 'tbl_prg_mobile', 'fld_participant_no'),
(71, 14, 'Remarks', 'tbl_prg_mobile', 'fld_remark'),
(72, 14, 'Expenditure', 'tbl_prg_mobile', 'fld_expenditure'),
(73, 15, 'Name', 'tbl_prg_pharmacy', 'fld_name'),
(74, 15, 'Remarks', 'tbl_prg_pharmacy', 'fld_remark'),
(75, 15, 'No of  Participants', 'tbl_prg_pharmacy', 'fld_paricipant_no'),
(76, 15, 'Date', 'tbl_prg_pharmacy', 'fld_date'),
(77, 16, 'Name of the Media Institute and Officer', 'fld_media', 'fld_name'),
(78, 16, 'Remarks', 'fld_media', 'fld_remark'),
(79, 6, 'Date', 'tbl_prg_for_drivers', 'fld_date');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_username` varchar(45) DEFAULT NULL,
  `fld_userpassword` varchar(100) DEFAULT NULL,
  `fld_email` varchar(150) NOT NULL,
  `fld_firstname` varchar(45) DEFAULT NULL,
  `fld_lastname` varchar(45) DEFAULT NULL,
  `fld_location` varchar(45) DEFAULT NULL,
  `fld_contactno` varchar(45) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `fld_assigned_to` varchar(45) DEFAULT NULL,
  `fld_user_center` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `fld_username`, `fld_userpassword`, `fld_email`, `fld_firstname`, `fld_lastname`, `fld_location`, `fld_contactno`, `is_active`, `role_id`, `fld_assigned_to`, `fld_user_center`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@gmail.com', 'Test', 'test', 'Colombo', '0778989855', 1, 2, 'out3', 1),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ashanrupasinghe11@gmail.com', 'Admin', 'admin', 'Colombo', '0725598892', 1, 1, NULL, 1),
(3, 'center', '305047e96ec089021660ee5965f893ac80268731', 'center@yahoo.com', 'Center', 'center', 'Gampaha', '0711846060', 1, 3, NULL, 3),
(4, 'out1', '8e74abe161aa121fb8a511947221b729ec4c3b17', 'out1@gmail.com', 'out1', 'out1', 'Minuwangoda', '0711846060', 1, 2, NULL, 1),
(5, 'out2', 'f728af935029305839e001d4936ca88635b9e480', 'out2@gmail.com', 'out2', 'out2', 'Gampaha', '0711846161', 1, 2, NULL, 1),
(6, 'out3', 'b0adcfd60df2aa9c07064136c0cb942f013326fa', 'out3@gmail.com', 'out3', 'out3', 'Kaluthara', '0711846262', 1, 2, NULL, 1),
(7, 'center1', '2297f49336abbc98680b03117d7e31d2b7a3a63b', 'center1@gmail.com', 'center1', '`center1', 'Kaluthara', '0711846363', 1, 3, NULL, 2),
(8, 'center2', 'f7a257e97c16077f6508bdbbf482cea6646df5f2', 'center2@gmail.com', 'center2', 'center2', 'Monaragala', '0711846464', 1, 3, NULL, 3),
(9, 'center3', 'bf9b25abab39fefaa1853e435e0b7725f8e55d64', 'center3@gmail.com', 'center3', 'center3', 'Galle', '0711846565', 1, 3, NULL, 4),
(10, 'center4', '4e372b2f0d9874b09c9eb87ae351dba0936e8736', 'center4@gmail.com', 'center4', 'center4', 'Mathara', '0711846666', 1, 3, NULL, 5),
(11, 'center5', '9843b2000d2c1b6ce462789803297d4ae211c472', 'center5@gmail.com', 'center5', 'center5', 'Hambanthota', '0711846767', 1, 3, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `fld_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_role` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`fld_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`fld_role_id`, `fld_role`) VALUES
(1, 'Administrator'),
(2, 'OutreachOfficer'),
(3, 'Center');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
