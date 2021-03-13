-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2021 at 01:22 PM
-- Server version: 10.4.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u405794923_omgss_corephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `003_omgss_api_tokens`
--

CREATE TABLE `003_omgss_api_tokens` (
  `user_id` int(11) DEFAULT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `003_omgss_devices`
--

CREATE TABLE `003_omgss_devices` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_aboutus`
--

CREATE TABLE `005_omgss_aboutus` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `textterms` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_aboutus`
--

INSERT INTO `005_omgss_aboutus` (`id`, `image`, `textterms`) VALUES
(1, '24c9e599c4ab895bf875c55b24fd11ce.png', '<p>We provide Maintenance of Your Machines/Appliances/Equipment in your Home/Office/Industry&nbsp;on Annual Maintenance/One Time Maintenance Basis. We take pride in the following:<br />\r\nQuick Response Time - Saves you from discomfort, and saves Time</p>\r\n\r\n<ol>\r\n	<li>Reasonable Prices - Saves your Money</li>\r\n	<li>Great Service Quality - Avoids Rework and Builds Trust on the Brand</li>\r\n	<li>Feedback Mechanism - Power to the customer. We take Your opinion very seriously</li>\r\n	<li>Technology Integration - Purchase and Complain from Same Platform</li>\r\n	<li>Superior Consumer Experience - Hand holding support on every step of resolving the Problem</li>\r\n</ol>\r\n\r\n<p>Our Website and Mobile Application provides a unique experience to the customer, where they can Purchase the Packages, and make complain. We care about you and your family, that is why utmost care is taken while designing the Website/Mobile Application. The User Interface is so User - Friendly, that it can be operated by the Young Ones as well as Our Respected Elders. Our objective is to make them self dependent, with technology and give them an ability to get small problems, while the working age group can perform even better in their professional, social and personal life. Regardless of your Social or Economic Status, we stand with you, ready to serve you with best of our capabilities.All in all, OMG is a solution, designed with Great Care and Empathy for Everyone.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_admin`
--

CREATE TABLE `005_omgss_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_admin`
--

INSERT INTO `005_omgss_admin` (`id`, `username`, `password`) VALUES
(1, 'Admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_billingaddresses`
--

CREATE TABLE `005_omgss_billingaddresses` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressprofilename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_cart`
--

CREATE TABLE `005_omgss_cart` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prdid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_categories`
--

CREATE TABLE `005_omgss_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_categories`
--

INSERT INTO `005_omgss_categories` (`id`, `name`) VALUES
(1, 'Domestic Sector'),
(3, 'Commercial Sector'),
(4, 'Industrial Sector'),
(5, 'Kitchen Components');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_companydetails`
--

CREATE TABLE `005_omgss_companydetails` (
  `id` int(11) NOT NULL,
  `companyemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `005_omgss_companydetails`
--

INSERT INTO `005_omgss_companydetails` (`id`, `companyemail`) VALUES
(1, 'sust.solns@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_complaints`
--

CREATE TABLE `005_omgss_complaints` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deviceid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complaint` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Processing',
  `notify` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `countnotify` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_contactdetails`
--

CREATE TABLE `005_omgss_contactdetails` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `officetiming` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_contactdetails`
--

INSERT INTO `005_omgss_contactdetails` (`id`, `address`, `phone`, `officetiming`, `email`, `website`) VALUES
(1, '36 INC, 2nd Floor,CT Center Mall ,IGVP,Pandri,Raipur India ( 492001 )', '+91 8770772802', '10 AM TO 6 PM', 'info@omgss.in', 'omgss.in');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_coupons`
--

CREATE TABLE `005_omgss_coupons` (
  `id` int(11) NOT NULL,
  `couponname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupontype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponamount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usageperuser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_faq`
--

CREATE TABLE `005_omgss_faq` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_faqbanner`
--

CREATE TABLE `005_omgss_faqbanner` (
  `id` int(11) NOT NULL,
  `faqbanner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_faqbanner`
--

INSERT INTO `005_omgss_faqbanner` (`id`, `faqbanner`) VALUES
(1, '38622417ecff8d55d01d6918194c53ee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_homepageslider`
--

CREATE TABLE `005_omgss_homepageslider` (
  `id` int(11) NOT NULL,
  `sliderimage` varchar(255) DEFAULT NULL,
  `tagline1` varchar(255) DEFAULT NULL,
  `tagline2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_homepageslider`
--

INSERT INTO `005_omgss_homepageslider` (`id`, `sliderimage`, `tagline1`, `tagline2`) VALUES
(9, '0c30eea583c31a00382ce6abe7cf979d.jpg', 'Tension ko Boliye Bye Bye, Swasth Rahiye, Mast Rahiye', 'Baaki Sab OMG dekh lega'),
(12, '94a069d69153ea63dcb2f4753135ec55.jpg', 'Cherish your Life, Cherish your Loved Ones', 'Chhoti Moti Problems k Liye, OMG hai na!!'),
(13, 'f9fdf8f448d11423cbc1007486090d3f.jpg', 'Live your Life at the Fullest', 'For Simple Problems, OMG hai Na!!'),
(14, '021a8b1cc9e37ba921b18d4990ea6c7a.jpg', 'Aise hi Khush Rahiye. Chhote mote gharelu kaam hum pe Chhodiye', 'OMG will take care of your Maintenance Jobs');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_notifications`
--

CREATE TABLE `005_omgss_notifications` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_orders`
--

CREATE TABLE `005_omgss_orders` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderdetails` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymenttype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalordervalue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Failed',
  `orderstate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Received',
  `razorpayid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupondetails` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refundid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `datetimeind` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_privacypolicy`
--

CREATE TABLE `005_omgss_privacypolicy` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `textterms` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_privacypolicy`
--

INSERT INTO `005_omgss_privacypolicy` (`id`, `image`, `textterms`) VALUES
(1, 'c573ab27c7d521123bcb2eaada896986.jpg', '<p><strong>Privacy Policy</strong></p>\r\n\r\n<p>We insist on the highest standards for secure transactions and customer information privacy since we value the trust you place in us.</p>\r\n\r\n<ul>\r\n	<li>Our privacy policy is subject to change at any time without prior notice. To make sure you are aware of any changes, please review this policy periodically.</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>By visiting this website you agree to be bound by the terms and conditions of this Privacy Policy. If you do not agree please do not use or access our Website.</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>By mere use of the Website, you expressly consent to our use and disclosure of your personal information in accordance with this Privacy Policy. This Privacy Policy is incorporated into and subject to the Terms of Use.</li>\r\n</ul>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Collection of Information</strong></p>\r\n\r\n<p>When you use our Website, we collect and store your personal information which is provided by you from time to time. We aim to provide you a safe, efficient, smooth and customized experience. This allows us to provide services and features that most likely meet your needs, and to customize our Website to make your experience safer and easier. More importantly, while doing so we collect personal information from you that we consider necessary for achieving this purpose.</p>\r\n\r\n<p>In general, you can browse the Website without revealing your identity or any personal information about yourself. Once you give us your personal information, you are not anonymous to us. Wherever possible, we indicate which fields are optional and which are required. You always have the option to not provide information by choosing not to use a particular service or feature on the Website. We may automatically track certain information about you based upon your behaviour on our Website. We use this information to do internal research on our user&#39;s demographics, interests, and behaviour to better understand, protect and serve our users. This information is compiled and analysed on an aggregated basis. This information may include the URL that you just came from (whether this URL is on our Website or not), which URL you next go to (whether this URL is on our Website or not), your computer browser information, and your IP address.</p>\r\n\r\n<p>We use data collection devices such as &quot;cookies&quot; on certain pages of the Website to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. &quot;Cookies&quot; are small identifiers sent from a web server and stored on your computer&#39;s hard drive, that help us to recognize you if you visit our website again.</p>\r\n\r\n<p>Additionally, you may encounter &quot;cookies&quot; or other similar devices on certain pages of the Website that are placed by third parties. We do not control the use of cookies by third parties.</p>\r\n\r\n<p>We collect information about your buying behaviour if you choose to buy on the Website.</p>\r\n\r\n<p>In case you transact with us, we collect certain additional information, such as a billing address, credit / debit card number and a credit / debit card expiration date and / or other payment details and tracking information from money orders and cheques.</p>\r\n\r\n<p>In case you choose to post messages on our chat rooms, message boards or other message areas or leave feedback, we will collect that information you provide to us. We retain this information as necessary to resolve disputes, provide customer support and troubleshoot problems as permitted by law.</p>\r\n\r\n<p>In case you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Website, we may collect such information into a file specific to you.</p>\r\n\r\n<p>We collect personally identifiable information (email address, name, phone number, credit card / debit card / other payment instrument details, etc.) when you set up a free account with us.</p>\r\n\r\n<p>You can browse some sections of our Website without being a registered member, however; certain activities (such as placing an order) do require registration. We do use your contact information to send you offers based on your previous orders and your interests.</p>\r\n\r\n<p><strong>Use and Sharing of Information</strong></p>\r\n\r\n<p>At no time will we sell your personally-identifiable data without your permission unless set forth in this Privacy Policy. The information we receive about you or from you may be used by us or shared by us with our corporate affiliates, dealers, agents, vendors and other third parties to help process your request; to comply with any law, regulation, audit or court order; to help improve our website or the products or services we offer; for research; to better understand our customers&#39; needs; to develop new offerings; and to alert you to new products and services (of us or our business associates) in which you may be interested. We may also combine information you provide us with information about you that is available to us internally or from other sources in order to better serve you.</p>\r\n\r\n<p>We do not share, sell, trade or rent your personal information to third parties for unknown reasons.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>&quot;Cookies&quot; are small identifiers sent from a web server and stored on your computer&#39;s hard drive, that help us to recognize you if you visit our website again.</p>\r\n\r\n<p>From time to time, we may place &quot;cookies&quot; on your personal computer. Also, our site uses cookies to track how you found our site. To protect your privacy we do not use cookies to store or transmit any personal information about you on the Internet. You have the ability to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. If you choose to decline cookies certain features of the site may not function properly or at all as a result.</p>\r\n\r\n<p><strong>Links</strong></p>\r\n\r\n<p>Our website contains links to other sites. Such other sites may use information about your visit to this website. Our Privacy Policy does not apply to practices of such sites that we do not own or control or to people we do not employ. Therefore, we are not responsible for the privacy practices or the accuracy or the integrity of the content included on such other sites. We encourage you to read the individual privacy statements of such websites.</p>\r\n\r\n<p><strong>Security</strong></p>\r\n\r\n<p>We safeguard your privacy using known security standards and procedures and comply with applicable privacy laws. Our websites combine industry-approved physical, electronic and procedural safeguards to ensure that your information is well protected throughout it&#39;s life cycle in our infrastructure.</p>\r\n\r\n<p>Sensitive data is hashed or encrypted when it is stored in our infrastructure. Sensitive data is decrypted, processed and immediately re-encrypted or discarded when no longer necessary. We host web services in audited data centers, with restricted access to the data processing servers. Controlled access, recorded and live-monitored video feeds, 24/7 staffed security and biometrics provided in such data centers ensure that we provide secure hosting.</p>\r\n\r\n<p><strong>Opt-Out Policy</strong></p>\r\n\r\n<p>All our users have the opportunity to opt-out of receiving non-essential (promotional, marketing-related) communications.</p>\r\n\r\n<p>Please email&nbsp;<a href=\"mailto:privacy@infibeam.net\">privacy@infibeam.net</a>&nbsp;if you no longer wish to receive any information from us.</p>\r\n\r\n<p><strong>Consent</strong></p>\r\n\r\n<p>By using the Website and/or by providing your information, you consent to the collection and use of the information you disclose on the Website in accordance with this Privacy Policy, including but not limited to Your consent for sharing your information as per this privacy policy.</p>\r\n\r\n<p>If we decide to change our privacy policy, we will post those changes on this page so that you are always aware of what information we collect, how we use it, and under what circumstances we disclose it.</p>\r\n\r\n<p><strong>Changes to this Privacy Policy</strong></p>\r\n\r\n<p>Our privacy policy is subject to change at any time without notice. We may change our Privacy Policy from time to time. Please review this policy periodically to make sure you are aware of any changes.</p>\r\n\r\n<p><strong>Questions</strong></p>\r\n\r\n<p>If you have any questions about our Privacy Policy, please e-mail your questions to us at&nbsp;<a href=\"mailto:privacy@infibeam.net\">privacy@infibeam.net</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Grievance Officer: Tejal Mehta&nbsp;<a href=\"mailto:privacy@infibeam.net\">infibeam</a> (+91-79-49004831)&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_products`
--

CREATE TABLE `005_omgss_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `categoryid` varchar(255) DEFAULT NULL,
  `subcategoryid` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `units` varchar(255) DEFAULT NULL,
  `saleprice` varchar(255) DEFAULT NULL,
  `actualprice` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `maintenancetype` varchar(255) DEFAULT NULL,
  `tags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_products`
--

INSERT INTO `005_omgss_products` (`id`, `name`, `categoryid`, `subcategoryid`, `image`, `thumbnail`, `units`, `saleprice`, `actualprice`, `description`, `maintenancetype`, `tags`) VALUES
(1, 'Split AC - Annual Maintenance', '1', '2', '1bedc2e64e1acaa6df16925d074f8da1.jpg', 'thmb1bedc2e64e1acaa6df16925d074f8da1.jpg', 'Nos', '365', '500', '<p><strong>Package Details</strong><br />\r\n1. One time Servicing in maintenance period<br />\r\n2. Unlimited Troubleshooting while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'AC,Split AC,Air Conditioner'),
(2, 'Window AC - Annual Maintenance', '1', '2', '34649184e04fdedd9d74d71abda6ebe7.jpg', 'thmb34649184e04fdedd9d74d71abda6ebe7.jpg', 'Nos', '365', '500', '<p><strong>Package Details</strong><br />\r\n1. One time Servicing in maintenance period<br />\r\n2. Unlimited Troubleshooting while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(3, 'Split AC - Annual Maintenance', '3', '9', '513fc63284fddca1dc6bfd7ed0c846b5.jpg', 'thmb513fc63284fddca1dc6bfd7ed0c846b5.jpg', 'Nos', '600', '1000', '<p><strong>Package Details</strong><br />\r\n1. Two time Servicing in maintenance period<br />\r\n2. Unlimited Troubleshooting while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(4, 'Window AC - Annual Maintenance', '3', '9', '63b6241e9009e4a895fa711dedee4856.jpg', 'thmb63b6241e9009e4a895fa711dedee4856.jpg', 'Nos', '600', '1000', '<p><strong>Package Details</strong><br />\r\n1. Two time Servicing in maintenance period<br />\r\n2. Unlimited Troubleshooting while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(5, 'Ductable AC', '3', '9', '70ce102ac430b9de33274f947b26c361.jpg', 'thmb70ce102ac430b9de33274f947b26c361.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '1', 'a'),
(6, 'Ductable AC', '4', '15', '677657b0fe2492b1cebe9d7aa4875915.jpg', 'thmb677657b0fe2492b1cebe9d7aa4875915.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '1', 'a'),
(7, 'Cassette AC - Annual Maintenance', '3', '9', 'd802989781f1906676fce1fbd2f3a281.jpeg', 'thmbd802989781f1906676fce1fbd2f3a281.jpeg', 'Nos', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(8, 'Cassette AC - Annual Maintenance', '4', '15', 'cc41d7610c959e4f33ec2174e74cd951.jpeg', 'thmbcc41d7610c959e4f33ec2174e74cd951.jpeg', 'Nos', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(9, 'Chiller Plant - Annual Maintenance', '3', '9', '07a9d281fee3476c23ea85726f103a12.jpg', 'thmb07a9d281fee3476c23ea85726f103a12.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(10, 'Chiller Plant - Annual Maintenance', '4', '15', '957ca57c9c9dcf76b4fd25d7c185d10c.jpg', 'thmb957ca57c9c9dcf76b4fd25d7c185d10c.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(11, 'VRF/VRV - Annual Maintenance', '3', '9', 'bfeed4a4b55cc1870bab6855252a06c3.jpg', 'thmbbfeed4a4b55cc1870bab6855252a06c3.jpg', 'HP', '2000', '2500', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(12, 'VRF/VRV - Annual Maintenance', '4', '15', '6a882f3c4bfd380fa2970a693e3afaed.jpg', 'thmb6a882f3c4bfd380fa2970a693e3afaed.jpg', 'HP', '2000', '2500', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(13, 'Tower AC - Annual Maintenance', '3', '9', '8b57bade155923638737679916249de9.jpg', 'thmb8b57bade155923638737679916249de9.jpg', 'Nos', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(14, 'Package AC - Annual Maintenance', '3', '9', 'fe6f3e3150185c9dbef2f4caa4a1af3a.jpg', 'thmbfe6f3e3150185c9dbef2f4caa4a1af3a.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(15, 'Package AC - Annual Maintenance', '4', '15', '1365dc37d4a4773997f7cdcac9d4a88f.jpg', 'thmb1365dc37d4a4773997f7cdcac9d4a88f.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(16, 'Fan Coil Units - Annual Maintenance', '3', '9', 'bac76635ddba8cc8fe7a3428102543ef.jpg', 'thmbbac76635ddba8cc8fe7a3428102543ef.jpg', 'Cubic Feet', '15', '18', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(17, 'Fan Coil Units - Annual Maintenance', '4', '15', '9e843dbc79270f982d0a99e867473e6a.jpg', 'thmb9e843dbc79270f982d0a99e867473e6a.jpg', 'Cubic Feet', '15', '18', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(18, 'Fully Automatic Washing Machine - Annual Maintenance', '1', '1', 'a729b03a260fce142912de2b3b4baa22.jpg', 'thmba729b03a260fce142912de2b3b4baa22.jpg', 'Nos', '400', '550', '<p><strong>Package Details</strong><br />\r\n1. One times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(19, 'Semi Automatic Washing Machine - Annual Maintenance', '1', '1', 'e327bb1911127d2c7800af8c6c8e5e44.jpg', 'thmbe327bb1911127d2c7800af8c6c8e5e44.jpg', 'Nos', '365', '500', '<p><strong>Package Details</strong><br />\r\n1. One times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(20, 'Front Loader Washing Machine - Annual Maintenance', '1', '1', 'eaedab33c8d3ecd93c1f84d5229aaa2c.jpg', 'thmbeaedab33c8d3ecd93c1f84d5229aaa2c.jpg', 'Nos', '400', '550', '<p><strong>Package Details</strong><br />\r\n1. One times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(21, 'Single Door Refrigerator - Annual Maintenance', '1', '4', '9d499c0d2f561130bcbe1c68bf24d9ab.png', 'thmb9d499c0d2f561130bcbe1c68bf24d9ab.png', 'Nos', '365', '500', '<p><strong>Package Details</strong><br />\r\n1. One times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(22, 'Double Door Refrigerator - Annual Maintenance', '1', '4', '88f59c8bc54013f48565693017568b36.jpg', 'thmb88f59c8bc54013f48565693017568b36.jpg', 'Nos', '400', '550', '<p><strong>Package Details</strong><br />\r\n1. One times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(23, 'Deep Freezer', '3', '9', '008a3d01c3276c74fe613ccdbf1fa0e6.jpg', 'thmb008a3d01c3276c74fe613ccdbf1fa0e6.jpg', 'Nos', '600', '1000', '<p><strong>Package Details</strong><br />\r\n1. Two&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '1', 'a'),
(24, 'Cold Rooms - Annual Maintenance', '3', '9', '78526271fdee40bdf5decebbc253a84f.jpg', 'thmb78526271fdee40bdf5decebbc253a84f.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(25, 'Cold Storage - Annual Maintenance', '3', '9', 'ddbd0f009f66d9903512b5649ce22af1.jpg', 'thmbddbd0f009f66d9903512b5649ce22af1.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(26, 'Cold Storage - Annual Maintenance', '4', '15', '81f99841fc6ec6933c5bb94044f66beb.jpg', 'thmb81f99841fc6ec6933c5bb94044f66beb.jpg', 'Ton', '1500', '2000', '<p><strong>Package Details</strong><br />\r\n1. Three&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(27, 'Computers/Laptops - Annual Maintenance', '1', '3', '97d0b0c8006af54008b9ba8e5b13fc22.jpg', 'thmb97d0b0c8006af54008b9ba8e5b13fc22.jpg', 'Nos', '365', '500', '<p><strong>Package Details</strong><br />\r\n1. One&nbsp;time&nbsp;Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(28, 'Computers/Laptops - Annual Maintenance', '3', '12', '362d9cb9a16db74e94f70db3b21d9162.jpg', 'thmb362d9cb9a16db74e94f70db3b21d9162.jpg', 'Nos', '500', '900', '<p><strong>Package Details</strong><br />\r\n1. Two&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(29, 'Computers/Laptops - Annual Maintenance', '4', '16', '3cb4f9b54de7faa2788b6a371e4b87b1.jpg', 'thmb3cb4f9b54de7faa2788b6a371e4b87b1.jpg', 'Nos', '800', '1000', '<p><strong>Package Details</strong><br />\r\n1. Three&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(30, 'CCTV Camera - Annual Maintenance', '1', '7', 'aab654d6431b4a12d0dd304b8b009b59.png', 'thmbaab654d6431b4a12d0dd304b8b009b59.png', 'Nos', '500', '800', '<p><strong>Package Details</strong><br />\r\n1. One&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(31, 'CCTV Camera - Annual Maintenance', '3', '11', '09c5a9f4512106de946fb104e3f80b0b.png', 'thmb09c5a9f4512106de946fb104e3f80b0b.png', 'Nos', '400', '800', '<p><strong>Package Details</strong><br />\r\n1. One time&nbsp;Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(32, 'CCTV Camera - Annual Maintenance', '4', '18', '1535060d5ab93e21b86f9a47e7089f39.jpg', 'thmb1535060d5ab93e21b86f9a47e7089f39.jpg', 'Nos', '400', '600', '<p><strong>Package Details</strong><br />\r\n1. One time&nbsp;Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(33, 'RO Water Purifier', '1', '5', '4cc6f6dcf75cd8b2e9dc67d88370e6e8.jpg', 'thmb4cc6f6dcf75cd8b2e9dc67d88370e6e8.jpg', 'Nos', '600', '1000', '<p>Package Details<br />\r\n1. One time&nbsp;Servicing(Preventive Maintenance) in maintenance period - Membrane Check, Back Washing of Filters, Candle Replacement (Spare Part Cost nor Included)<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\nTerms and Conditions<br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '1', 'a'),
(34, 'Water Treatment Plant (50 to 100 lph)- Annual Maintenance', '3', '10', 'de53696c31977003b03a4fd3f508c38e.jpg', 'thmbde53696c31977003b03a4fd3f508c38e.jpg', 'Nos', '8500', '10000', '<p>Package Details<br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\nTerms and Conditions<br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(35, 'Water Treatment Plant (Above100 lph)- Annual Maintenance', '4', '19', '2e675c767551fccbc79cda4dc15dd6a3.jpg', 'thmb2e675c767551fccbc79cda4dc15dd6a3.jpg', 'Nos', '27000', '30000', '<p><strong>Package Details</strong><br />\r\n1. Four&nbsp;times Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(36, 'Diesel Generator Set (DG Set) - Annual Maintenance', '3', '14', 'd0176e23d7f72bdcae3d066b1e8d2df3.jpg', 'thmbd0176e23d7f72bdcae3d066b1e8d2df3.jpg', 'Nos', '50000', '150000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(37, 'Diesel Generator Set (DG Set) - Annual Maintenance', '4', '20', '1a45063fca9c456e890017aaa3ab376b.jpg', 'thmb1a45063fca9c456e890017aaa3ab376b.jpg', 'Nos', '50000', '150000', '<p><strong>Package Details</strong><br />\r\n1. Three times Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(38, 'Routine Electrical Maintenance', '1', '6', 'b7cfb53f2fa038497d8f3aa7d6347dfe.jpg', 'thmbb7cfb53f2fa038497d8f3aa7d6347dfe.jpg', 'Nos', '365', '500', '<p><strong>Package Details</strong><br />\r\n1. Requests will be taken 3 to 4 times per year.</p>\r\n\r\n<p>2. This package includes small and quick jobs which take less than 1 hour. Any work more than that will be chargeable<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '1', 'a'),
(39, 'Routine Electrical Maintenance - Annual', '3', '13', '9089c5b59ef3d0903fa51340fe3a877e.jpg', 'thmb9089c5b59ef3d0903fa51340fe3a877e.jpg', 'kW', '6000', '10000', '<p><strong>Package Details</strong><br />\r\n1. One&nbsp;time&nbsp;Servicing(Preventive Maintenance) in maintenance period<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\n<strong>Terms and Conditions</strong><br />\r\n1. This is a non - comprehensive package.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(40, 'Routine Electrical Maintenance - Annual', '4', '17', '7723a66a56b14c657740101f1803ff45.jpg', 'thmb7723a66a56b14c657740101f1803ff45.jpg', 'kW', '1000', '1300', '<p>Package Details<br />\r\n1. One time&nbsp;Servicing(Preventive Maintenance) in maintenance period<br />\r\n&nbsp;&nbsp; &nbsp;a. System Health Check - Pressure, Sensors etc<br />\r\n&nbsp;&nbsp; &nbsp;b. Overhauling of Parts<br />\r\n&nbsp;&nbsp; &nbsp;c. Report Generation<br />\r\n2. Unlimited Number of Shutdown Maintenance while in contract period<br />\r\nTerms and Conditions<br />\r\n1. This is a non - comprehensive package on a per kW Load Basis.Spare Parts are not included in this Package. Only service charge is covered.<br />\r\n2. Rope Belts, Ladders, Mugs, Rags, Buckets etc must be provided by the customer.<br />\r\n3. This maintenance is meant for light jobs, addressable by one technician. In case heavy work is assigned which requires more than one technician, extra cost may be charged.<br />\r\n4. Any extra work like Fabrication, Transportation etc will be in the scope of Client</p>\r\n', '2', 'a'),
(41, 'Underground House Wiring - Without Fall Ceiling', '1', '6', 'f09f3b5d4c589a8f9e0f5f37fda45441.jpg', 'thmbf09f3b5d4c589a8f9e0f5f37fda45441.jpg', 'Sq. Ft.', '14', '15', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li><strong>The above given rate is on a per square feet basis</strong></li>\r\n	<li><strong>Parts, Cables, Accessories, Consumables are not included. This charge only covers Service.</strong></li>\r\n	<li><strong>Any kind of extra work like Fabrication, Transportation etc will be charged as per actual</strong></li>\r\n</ol>\r\n', '1', 'a'),
(42, 'Underground Office Wiring - Without Fall Ceiling', '3', '13', '4f81e115e2aaa53c4bd282dd92423c9c.jpg', 'thmb4f81e115e2aaa53c4bd282dd92423c9c.jpg', 'Sq. Ft.', '14', '15', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li><strong>The above given rate is on a per square feet basis</strong></li>\r\n	<li><strong>Parts, Cables, Accessories, Consumables are not included. This charge only covers Service.</strong></li>\r\n	<li><strong>Any kind of extra work like Fabrication, Transportation etc will be charged as per actual</strong></li>\r\n</ol>\r\n', '1', 'a'),
(43, 'Underground House Wiring - With Fall Ceiling', '1', '6', 'ebbd68e8696c6e76e5ba5adaaf83e09c.jpg', 'thmbebbd68e8696c6e76e5ba5adaaf83e09c.jpg', 'Sq. Ft.', '24', '26', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>The above given rate is on a per square feet basis</li>\r\n	<li>Parts, Cables, Accessories, Consumables are not included. This charge only covers Service.</li>\r\n	<li>Any kind of extra work like Fabrication, Transportation etc will be charged as per actual</li>\r\n</ol>\r\n', '1', 'a'),
(44, 'Underground Office Wiring - With Fall Ceiling', '3', '13', '91735f7a4304e3730f32839ab5b19b17.jpg', 'thmb91735f7a4304e3730f32839ab5b19b17.jpg', 'Sq. Ft.', '24', '25', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>The above given rate is on a per square feet basis</li>\r\n	<li>Parts, Cables, Accessories, Consumables are not included. This charge only covers Service.</li>\r\n	<li>Any kind of extra work like Fabrication, Transportation etc will be charged as per actual</li>\r\n</ol>\r\n', '1', 'a'),
(45, 'Window AC - One Time Maintenance', '1', '2', 'ccbd1b6726c5105d990d455c7ab762c6.jpg', 'thmbccbd1b6726c5105d990d455c7ab762c6.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(46, 'Split AC - One Time Maintenance', '1', '2', '930390c368fa260c7963a834a54afba1.jpg', 'thmb930390c368fa260c7963a834a54afba1.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(47, 'Window AC - One Time Maintenance', '3', '9', 'ec61d01261281017cffb6c6483dbf486.jpg', 'thmbec61d01261281017cffb6c6483dbf486.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(48, 'Split AC - One Time Maintenance', '3', '9', '2b3a7f849d0552a558c6414ab5cd7b0e.jpg', 'thmb2b3a7f849d0552a558c6414ab5cd7b0e.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(49, 'Ductable AC - One Time Maintenance', '3', '9', '6f655d81e0f48d9a6ed544ac3b3e4a4b.jpg', 'thmb6f655d81e0f48d9a6ed544ac3b3e4a4b.jpg', 'Nos', '600', '800', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(50, 'Cassette AC - One Time Maintenance', '3', '9', '8b0472a2d6bc4d5df2121233ebed2fb0.jpeg', 'thmb8b0472a2d6bc4d5df2121233ebed2fb0.jpeg', 'Nos', '450', '600', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(51, 'Chiller Plant - One Time Maintenance', '3', '9', '57484d5c7c8274af37ecfbfa1a39e8fe.jpg', 'thmb57484d5c7c8274af37ecfbfa1a39e8fe.jpg', 'Nos', '1500', '2000', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(52, 'VRF/VRV - One Time Maintenance', '3', '9', 'b036105201786072f9e58237cf0cdbc2.jpg', 'thmbb036105201786072f9e58237cf0cdbc2.jpg', 'Nos', '1000', '1500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(53, 'Tower AC - One Time Maintenance', '3', '9', '35eb6401fb25190837068557ba483d0d.jpg', 'thmb35eb6401fb25190837068557ba483d0d.jpg', 'Nos', '450', '600', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(54, 'Package AC - One Time Maintenance', '3', '9', '0857b84cec8c9ef8ebad3df86b61fae3.jpg', 'thmb0857b84cec8c9ef8ebad3df86b61fae3.jpg', 'Ton', '1000', '1500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(55, 'Fan Coil Units - One Time Maintenance', '3', '9', '85f399dc7b2192e911dd650def6e1b4d.jpg', 'thmb85f399dc7b2192e911dd650def6e1b4d.jpg', 'Cubic Feet', '5', '6', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(56, 'Air Handling Unit - One Time Maintenance', '3', '9', '303b644cf594d722ae6d44b5423b89ec.jpg', 'thmb303b644cf594d722ae6d44b5423b89ec.jpg', 'Cubic Feet', '5', '1500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a');
INSERT INTO `005_omgss_products` (`id`, `name`, `categoryid`, `subcategoryid`, `image`, `thumbnail`, `units`, `saleprice`, `actualprice`, `description`, `maintenancetype`, `tags`) VALUES
(57, 'Fully Automatic Washing Machine - One Time Maintenance', '1', '1', '5cb65b09cccd008a6114b859f5c36bf6.jpg', 'thmb5cb65b09cccd008a6114b859f5c36bf6.jpg', 'Nos', '250', '400', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(58, 'Semi Automatic Washing Machine - One Time Maintenance', '1', '1', 'ed48acd6acfe8efb69631d8435df649e.jpg', 'thmbed48acd6acfe8efb69631d8435df649e.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(59, 'Front Loader Washing Machine - One Time Maintenance', '1', '1', '3fda0e131c9269700c6da40dba8f04d3.jpg', 'thmb3fda0e131c9269700c6da40dba8f04d3.jpg', 'Nos', '250', '400', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(60, 'Single Door Refrigerator - One Time Maintenance', '1', '4', '41f66b51a72821275beaaafeae10437d.png', 'thmb41f66b51a72821275beaaafeae10437d.png', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(61, 'Double Door Refrigerator - One Time Maintenance', '1', '4', 'ab038ef9380f6901b59a6611dd407728.jpg', 'thmbab038ef9380f6901b59a6611dd407728.jpg', 'Nos', '250', '400', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(62, 'Deep Freezer - One Time Maintenance', '3', '9', '3a7e9c5308c9821521c1e6723c3c3f13.jpg', 'thmb3a7e9c5308c9821521c1e6723c3c3f13.jpg', 'Nos', '400', '600', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(63, 'Cold Rooms - One Time Maintenance', '3', '9', '37829d683da2cc8734f566f4a857a403.jpg', 'thmb37829d683da2cc8734f566f4a857a403.jpg', 'Ton', '1000', '1500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(64, 'Cold Storage - One Time Maintenance', '3', '9', '8050df8fb6eacf12d4b68bb0c20508ae.jpg', 'thmb8050df8fb6eacf12d4b68bb0c20508ae.jpg', 'Ton', '1000', '1500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(65, 'Computers/Laptops - One Time Maintenance', '1', '3', 'db876f4c2dc3b1a43b5ef932d81ffd33.jpg', 'thmbdb876f4c2dc3b1a43b5ef932d81ffd33.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(66, 'Computers/Laptops - One Time Maintenance', '3', '12', '1930dbeac4f933ec21e81479bfd6cf95.jpg', 'thmb1930dbeac4f933ec21e81479bfd6cf95.jpg', 'Nos', '300', '500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(68, 'CCTV Camera - One Time Maintenance', '1', '7', '1ec13afe64eb6bf86a612455c85cd4e0.jpg', 'thmb1ec13afe64eb6bf86a612455c85cd4e0.jpg', 'Nos', '300', '500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(69, 'CCTV Camera - One Time Maintenance', '3', '11', 'ebe24aac96cfc78c166eea70d7cedf18.png', 'thmbebe24aac96cfc78c166eea70d7cedf18.png', 'Nos', '300', '500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(70, 'Computer Accessories - One Time Maintenance', '1', '3', '2982f28ba422a908f08b330602e3c9d2.jpeg', 'thmb2982f28ba422a908f08b330602e3c9d2.jpeg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(71, 'Computer Accessories - One Time Maintenance', '3', '12', 'fbbe31460bea3e03f25a359f6d9656e9.jpeg', 'thmbfbbe31460bea3e03f25a359f6d9656e9.jpeg', 'Nos', '400', '600', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(72, 'RO Water Purifier - One Time Maintenance', '1', '5', 'd635341c9f16b43ae9c5d21f21139bbe.jpg', 'thmbd635341c9f16b43ae9c5d21f21139bbe.jpg', 'Nos', '300', '500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(73, 'Water Treatment Plant (50 to 100 lph)- One Time Maintenance', '3', '10', '8dabb2b03e77f4592cd244a3e17fb04f.jpg', 'thmb8dabb2b03e77f4592cd244a3e17fb04f.jpg', 'Nos', '300', '500', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(74, 'Diesel Generator Set (DG Set) - One Time Maintenance', '3', '14', '3f4914e5dd68c0ba37b8c98dbdc2a421.jpg', 'thmb3f4914e5dd68c0ba37b8c98dbdc2a421.jpg', 'Nos', '500', '800', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(75, 'Diesel Generator Set (DG Set) - One Time Maintenance', '4', '20', '15115de5553503e79be0fbe6a17b3a35.jpg', 'thmb15115de5553503e79be0fbe6a17b3a35.jpg', 'Nos', '800', '1200', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(76, 'Electrical Maintenance - One Time Service', '1', '6', '651c92c43877f5543fc0ec01131d1655.jpg', 'thmb651c92c43877f5543fc0ec01131d1655.jpg', 'Nos', '200', '300', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(77, 'Electrical Maintenance - One Time Service', '3', '13', 'c41e7c608ec19996046308c4580a37b8.jpg', 'thmbc41e7c608ec19996046308c4580a37b8.jpg', 'Nos', '400', '600', '<p><strong>Terms and Conditions</strong>:-The above given charge is just a visiting charge which is charged for inspection. After inspection, customer will be told details of the diagnosis and the spare parts and expenses required for the job to be completed. If the customer continues the maintenance with us, visiting charge will be deducted from the final amount.</p>\r\n', '1', 'a'),
(78, 'Window Cooler Installation', '1', '6', '3d35a407c5fcf67840c3f7f4acbf31be.jpg', 'thmb3d35a407c5fcf67840c3f7f4acbf31be.jpg', 'Nos', '300', '400', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>Transportation, Loading and Unloading of the device are in the scope of Customer.</li>\r\n	<li>This charge only covers the service part. Any kind of spare parts, consumables etc will be chargeable.</li>\r\n	<li>Any kind of fabrication, transportation or extra work is outside our scope and will be taken care by the customer.</li>\r\n</ol>\r\n', '1', 'a'),
(79, 'Window AC - Installation', '1', '2', '2c2d84177a45978e2ea3eeac460987c3.jpg', 'thmb2c2d84177a45978e2ea3eeac460987c3.jpg', 'Nos', '1000', '1100', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>Transportation, Loading and Unloading of the device are in the scope of Customer.</li>\r\n	<li>This charge only covers the service part. Any kind of spare parts, consumables etc will be chargeable.</li>\r\n	<li>Any kind of fabrication, transportation or extra work is outside our scope and will be taken care by the customer.</li>\r\n</ol>\r\n', '1', 'a'),
(80, 'Split AC - Installation', '1', '2', '5680401573ca7acb5f8385d3d0b15d2a.jpg', 'thmb5680401573ca7acb5f8385d3d0b15d2a.jpg', 'Nos', '1000', '1100', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>Transportation, Loading and Unloading of the device are in the scope of Customer.</li>\r\n	<li>This charge only covers the service part. Any kind of spare parts, consumables etc will be chargeable.</li>\r\n	<li>Any kind of fabrication, transportation or extra work is outside our scope and will be taken care by the customer.</li>\r\n</ol>\r\n', '1', 'AC,Split AC,Air Conditioner'),
(92, 'Domestic Kitchen Chimney Servicing - One Time', '5', '21', '9edd21fbf038bb1ec3c20b560fd0ea0d.jpg', 'thmb9edd21fbf038bb1ec3c20b560fd0ea0d.jpg', 'Nos', '500', '800', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>Cleaning of Filters and Other Components&nbsp;is Included in this Service. This is a One Time Service</li>\r\n	<li>Any Spare Parts or Consumables are Not Included</li>\r\n	<li>Chimney should be at an accessible place.</li>\r\n	<li>Ladders and likewise items will be provided by the Customer</li>\r\n</ol>\r\n', '1', 'Domestic Sector, Chimney Cleaning, Chimney Servicing, Modular Kitchen'),
(93, 'Commercial Kitchen Chimney - One Time Service', '5', '21', '4accf0d30540c18eb244e8c207e26a86.jpeg', 'thmb4accf0d30540c18eb244e8c207e26a86.jpeg', 'Nos', '700', '1000', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<ol>\r\n	<li>The above quoted price is a Per Chamber Basis. For more number of chambers, the cost will increase accordingly.</li>\r\n	<li>Cleaning of Filters and Other Components&nbsp;is Included in this Service. This is a One Time Service</li>\r\n	<li>Any Spare Parts or Consumables are Not Included</li>\r\n	<li>Chimney should be at an accessible place.</li>\r\n	<li>Ladders and likewise items will be provided by the Customer</li>\r\n</ol>\r\n', '1', 'Commercial Kitchen, Chimney Servicing, Chimney Cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_reviews`
--

CREATE TABLE `005_omgss_reviews` (
  `id` int(11) NOT NULL,
  `productid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_subcategories`
--

CREATE TABLE `005_omgss_subcategories` (
  `id` int(11) NOT NULL,
  `subcatname` varchar(255) DEFAULT NULL,
  `subcatimage` varchar(255) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_subcategories`
--

INSERT INTO `005_omgss_subcategories` (`id`, `subcatname`, `subcatimage`, `catid`) VALUES
(1, 'Washing Machines', '52e02302fae7dd895c485830ac726080.jpg', 1),
(2, 'Air Conditioners', '581f87e61dc5e0a1afc7b8846c99b4f8.jpg', 1),
(3, 'Computers, Laptops and Accessories', '1833520b3ca7a32cf54e95dc704aacb6.jpg', 1),
(4, 'Refrigerators', '09d4cb402a3c9f8f1d8b3fe7fe45e226.jpg', 1),
(5, 'Water Purifiers', 'fa069602d1aa883ba5696af5610d6873.jpg', 1),
(6, 'Routine Electrical Maintenance', '9890a88fd537a0a22bdb305162f47ad0.jpg', 1),
(7, 'CCTV Camera', '51e5cb3af2706cfd78af405e5fc8d51b.jpeg', 1),
(8, 'Microwave', '63cfd977262c913ce2d5d4a06b637b2d.jpg', 1),
(9, 'HVAC', '5be98f551c8688ee2a366f77b7346647.webp', 3),
(10, 'Water Treatment Plant', '3db10db2506469a75c05ce733920b1d4.jpg', 3),
(11, 'CCTV Camera', '1a3a9ddf454472601efc1d6a6adca7a7.png', 3),
(12, 'Computers, Laptops and Accessories', '1d124d0ae5789437b39aa8fb17efcb04.jpg', 3),
(13, 'Electrical Jobs', '5af1a2e8147cb96eb67daf5775b0fd6b.jpg', 3),
(14, 'Diesel Generator Set (DG Set)', 'c38ad5c2de282b3d7adee5a6013835a3.jpg', 3),
(15, 'HVAC', 'a7b27be25dd0b0fd64b87b8534a4598d.webp', 4),
(16, 'Computers, Laptops and Accessories', 'ea2db037e9c44dc496b94e4f3369c90b.jpg', 4),
(17, 'Electrical Jobs', '7b8b14107abd0b5ad18238d497c5b93c.jpg', 4),
(18, 'CCTV Camera', '93c05c03e1bdea3f434442df300c2d1b.png', 4),
(19, 'Water Treatment Plant', '470c3bebaf6ea67dc8776a035e3090c7.jpg', 4),
(20, 'Diesel Generator Set (DG Set)', '993d60ba30f66cf4dcd1980de1ee6bac.jpg', 4),
(21, 'Chimney', '3d65c4a140c1610f30e752b5ace40021.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_termsandconditions`
--

CREATE TABLE `005_omgss_termsandconditions` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `textterms` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `005_omgss_termsandconditions`
--

INSERT INTO `005_omgss_termsandconditions` (`id`, `image`, `textterms`) VALUES
(1, '3af41a590fe04d3ba1579f6bf27121bd.jpg', '<h1>Terms and Conditions</h1>\r\n\r\n<h1>General Site Usage</h1>\r\n\r\n<p>Last Revised: December 16, 2013</p>\r\n\r\n<p>This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.</p>\r\n\r\n<h2>1. YOUR AGREEMENT</h2>\r\n\r\n<p>By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.</p>\r\n\r\n<blockquote>PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.</blockquote>\r\n\r\n<h2>2. PRIVACY</h2>\r\n\r\n<p>Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.</p>\r\n\r\n<h2>3. LINKED SITES</h2>\r\n\r\n<p>This Site may contain links to other independent third-party Web sites (&quot;Linked Sites&rdquo;). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.</p>\r\n\r\n<h2>4. FORWARD LOOKING STATEMENTS</h2>\r\n\r\n<p>All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.</p>\r\n\r\n<h2>5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2>\r\n\r\n<p>A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN &quot;AS IS&quot; AND &quot;AS AVAILABLE&quot; BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p>\r\n\r\n<p>B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.</p>\r\n\r\n<h2>6. EXCLUSIONS AND LIMITATIONS</h2>\r\n\r\n<p>SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p>\r\n\r\n<h2>7. OUR PROPRIETARY RIGHTS</h2>\r\n\r\n<p>This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party&#39;s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively &quot;Trademarks&quot;) or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.</p>\r\n\r\n<p>The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.</p>\r\n\r\n<h2>8. INDEMNITY</h2>\r\n\r\n<p>By using the Site web sites you agree to indemnify us and affiliated entities (collectively &quot;Indemnities&quot;) and hold them harmless from any and all claims and expenses, including (without limitation) attorney&#39;s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and/or related materials to us or from any person&#39;s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.</p>\r\n\r\n<h2>9. COPYRIGHT AND TRADEMARK NOTICE</h2>\r\n\r\n<p>Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info &copy; 2013, all rights reserved</p>\r\n\r\n<h2>10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS</h2>\r\n\r\n<p>It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (&quot;DMCA&quot;) and other applicable intellectual property laws. Notices of claimed infringement should be directed to:</p>\r\n\r\n<p>generator.lorem-ipsum.info</p>\r\n\r\n<p>126 Electricov St.</p>\r\n\r\n<p>Kiev, Kiev 04176</p>\r\n\r\n<p>Ukraine</p>\r\n\r\n<p>contact@lorem-ipsum.info</p>\r\n\r\n<h2>11. PLACE OF PERFORMANCE</h2>\r\n\r\n<p>This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.</p>\r\n\r\n<h2>12. GENERAL</h2>\r\n\r\n<p>A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer&#39;s documents or purchase orders.</p>\r\n\r\n<p>B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_usernotifications`
--

CREATE TABLE `005_omgss_usernotifications` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notificationid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'system',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `readstatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `androidnotification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_users`
--

CREATE TABLE `005_omgss_users` (
  `id` int(11) NOT NULL,
  `eMail` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `deviceid` varchar(255) DEFAULT NULL,
  `devicetoken` varchar(255) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `005_omgss_wishlist`
--

CREATE TABLE `005_omgss_wishlist` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prdid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `003_omgss_api_tokens`
--
ALTER TABLE `003_omgss_api_tokens`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `003_omgss_devices`
--
ALTER TABLE `003_omgss_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_aboutus`
--
ALTER TABLE `005_omgss_aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_admin`
--
ALTER TABLE `005_omgss_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_billingaddresses`
--
ALTER TABLE `005_omgss_billingaddresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_cart`
--
ALTER TABLE `005_omgss_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_categories`
--
ALTER TABLE `005_omgss_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_companydetails`
--
ALTER TABLE `005_omgss_companydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_complaints`
--
ALTER TABLE `005_omgss_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_contactdetails`
--
ALTER TABLE `005_omgss_contactdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_coupons`
--
ALTER TABLE `005_omgss_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_faq`
--
ALTER TABLE `005_omgss_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_faqbanner`
--
ALTER TABLE `005_omgss_faqbanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_homepageslider`
--
ALTER TABLE `005_omgss_homepageslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_notifications`
--
ALTER TABLE `005_omgss_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_orders`
--
ALTER TABLE `005_omgss_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_privacypolicy`
--
ALTER TABLE `005_omgss_privacypolicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_products`
--
ALTER TABLE `005_omgss_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_reviews`
--
ALTER TABLE `005_omgss_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_subcategories`
--
ALTER TABLE `005_omgss_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_termsandconditions`
--
ALTER TABLE `005_omgss_termsandconditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_usernotifications`
--
ALTER TABLE `005_omgss_usernotifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_users`
--
ALTER TABLE `005_omgss_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `005_omgss_wishlist`
--
ALTER TABLE `005_omgss_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `003_omgss_devices`
--
ALTER TABLE `003_omgss_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `005_omgss_aboutus`
--
ALTER TABLE `005_omgss_aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_admin`
--
ALTER TABLE `005_omgss_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_billingaddresses`
--
ALTER TABLE `005_omgss_billingaddresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `005_omgss_cart`
--
ALTER TABLE `005_omgss_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `005_omgss_categories`
--
ALTER TABLE `005_omgss_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `005_omgss_companydetails`
--
ALTER TABLE `005_omgss_companydetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_complaints`
--
ALTER TABLE `005_omgss_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `005_omgss_contactdetails`
--
ALTER TABLE `005_omgss_contactdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_coupons`
--
ALTER TABLE `005_omgss_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `005_omgss_faq`
--
ALTER TABLE `005_omgss_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `005_omgss_faqbanner`
--
ALTER TABLE `005_omgss_faqbanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_homepageslider`
--
ALTER TABLE `005_omgss_homepageslider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `005_omgss_notifications`
--
ALTER TABLE `005_omgss_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `005_omgss_orders`
--
ALTER TABLE `005_omgss_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `005_omgss_privacypolicy`
--
ALTER TABLE `005_omgss_privacypolicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_products`
--
ALTER TABLE `005_omgss_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `005_omgss_reviews`
--
ALTER TABLE `005_omgss_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `005_omgss_subcategories`
--
ALTER TABLE `005_omgss_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `005_omgss_termsandconditions`
--
ALTER TABLE `005_omgss_termsandconditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `005_omgss_usernotifications`
--
ALTER TABLE `005_omgss_usernotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `005_omgss_users`
--
ALTER TABLE `005_omgss_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `005_omgss_wishlist`
--
ALTER TABLE `005_omgss_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
