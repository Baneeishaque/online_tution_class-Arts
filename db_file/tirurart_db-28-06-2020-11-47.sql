-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2020 at 08:17 AM
-- Server version: 5.6.47
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tirurart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin`
(
    `admin_id` int(11) UNSIGNED NOT NULL,
    `username` varchar(50)      NOT NULL,
    `passowrd` varchar(50)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `passowrd`)
VALUES (1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `assigns`
--

CREATE TABLE `assigns`
(
    `assign_id`  int(11) UNSIGNED NOT NULL,
    `teacher_id` int(11) UNSIGNED NOT NULL,
    `subject_id` int(11) UNSIGNED NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `assigns`
--

INSERT INTO `assigns` (`assign_id`, `teacher_id`, `subject_id`)
VALUES (1, 3, 4),
       (2, 2, 4),
       (3, 7, 4),
       (4, 2, 5),
       (5, 18, 4),
       (6, 3, 10),
       (7, 25, 5),
       (8, 25, 4),
       (9, 25, 57),
       (10, 25, 60),
       (11, 25, 61),
       (12, 18, 17),
       (13, 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `batchs`
--

CREATE TABLE `batchs`
(
    `batch_id`   int(11) UNSIGNED NOT NULL,
    `batch_name` varchar(5)       NOT NULL,
    `stream_id`  int(11) UNSIGNED NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `batchs`
--

INSERT INTO `batchs` (`batch_id`, `batch_name`, `stream_id`)
VALUES (1, 'C1', 2),
       (2, 'C2', 2),
       (3, 'C3', 2),
       (4, 'S1', 4),
       (5, 'S2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses`
(
    `course_id`   int(11) UNSIGNED NOT NULL,
    `course_name` varchar(50)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`)
VALUES (1, 'HSE'),
       (3, 'Degree (UG)'),
       (4, 'TTC'),
       (5, 'MBA'),
       (7, 'BBA');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes`
(
    `note_id`     int(11) UNSIGNED NOT NULL,
    `teacher_id`  int(11) UNSIGNED NOT NULL,
    `subject_id`  int(11) UNSIGNED NOT NULL,
    `title`       varchar(50)      NOT NULL,
    `description` varchar(150)     NOT NULL,
    `file`        varchar(50)      NOT NULL,
    `status`      int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `teacher_id`, `subject_id`, `title`, `description`, `file`, `status`)
VALUES (4, 2, 4, 'Test', 'Test Description', 'online class app .pdf', 1),
       (5, 2, 5, 'Test', 'Test Description', 'Banee Ishaque K - DevOps Engineer Resume.pdf', 1),
       (7, 2, 4, 'Chapter 1', 'Chapter 1 Description', 'Untitled_ Jun 13 2020 12_53 PM.mp4', 0),
       (8, 2, 4, 'Chapter 2', 'Chapter 2 Description', 'Untitled_ Jun 13 2020 12_20 PM.mp4', 0),
       (9, 2, 5, 'Chapter 1', 'Chapter 1 Description', 'Resume-1.jpg', 0),
       (10, 3, 10, 'Demo1', 'Digital Marketing', 'BDA0B68B-58D3-4B61-9E90-265CF2E0066B.MOV', 0),
       (11, 25, 5, 'Strategic Marketing', 'asdasdasdasd', 'Global Business Strategy.docx', 0),
       (12, 25, 60, 'Global Business Strategy', 'Global Business Strategy', 'Global Business Strategy.docx', 0),
       (13, 25, 61, 'Strategic Marketing', 'asdasdasdasd', 'Global Business Strategy.docx', 0),
       (14, 25, 61, 'Strategic Marketing', 'asdasdasd', 'Global Business Strategy.pdf', 0),
       (15, 25, 61, 'Strategic Marketing', 'qadads', 'Sookshichal dukhikkenda - A corona kavitha.mp4', 0),
       (16, 25, 61, 'note 1', 'notwe 2', 'Gayatri Asokan sings Pokayo.mp3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams`
(
    `stream_id`   int(11) UNSIGNED NOT NULL,
    `stream_name` varchar(50)      NOT NULL,
    `course_id`   int(11) UNSIGNED NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`stream_id`, `stream_name`, `course_id`)
VALUES (1, 'Commerce 1st Year', 1),
       (2, 'Commerce 2nd Year', 1),
       (3, 'Humanities 1st Year', 1),
       (4, 'Humanities 2nd Year', 1),
       (5, 'B Com 1st Year', 3),
       (6, 'B Com 2nd Year', 3),
       (7, 'B Com 3rd Year', 3),
       (8, 'BA English 1st Year', 3),
       (10, 'BA English 2nd Year', 3),
       (11, 'BA English 3rd Year', 3),
       (12, 'BA Economics 1st Year', 3),
       (13, 'BA Economics 2nd Year', 3),
       (14, 'BA Economics 3rd Year', 3),
       (15, 'BA History 1st Year', 3),
       (16, 'BA History 2nd Year', 3),
       (17, 'BA History 3rd Year', 3),
       (18, 'Montessori', 4),
       (19, 'PPTTC', 4),
       (20, 'Strategic Management', 5),
       (22, 'STRATEGIC MANAGEMENT - 1 YEAR', 7);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students`
(
    `student_id`        int(11) UNSIGNED NOT NULL,
    `full_name`         varchar(50)      NOT NULL,
    `mobile_number`     varchar(15)      NOT NULL,
    `email_address`     varchar(50)      NOT NULL,
    `studying_class`    int(11) UNSIGNED NOT NULL,
    `status`            int(11) UNSIGNED NOT NULL DEFAULT '0',
    `username`          varchar(50)      NOT NULL,
    `password`          varchar(50)      NOT NULL,
    `batch_number`      varchar(5)       NOT NULL DEFAULT 'NA',
    `additional_mobile` varchar(100)              DEFAULT NULL,
    `additional_email`  varchar(150)              DEFAULT NULL,
    `photo`             varchar(150)              DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `full_name`, `mobile_number`, `email_address`, `studying_class`, `status`,
                        `username`, `password`, `batch_number`, `additional_mobile`, `additional_email`, `photo`)
VALUES (20, 'Jishnu. M', '7510359610', 'jj794425@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (21, 'RIJILA. S', '7994348748', 'Rijiaamoos@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (22, 'Ameen Aslam. U', '8943434810', 'ameenaslam@gmaill.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (23, 'Sujitha.k', '9539761454', 'kurupmani2@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (24, 'Shamna nasri R ', '9961286709', 'shamnashanunasri@gmail.com', 0, 0, '', '', '', NULL, NULL, NULL),
       (26, 'Asna. A', '9048080232', 'asirahman07@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (27, 'Sneha k', '7736066458', 'snehasuresh77@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (28, 'Vismaya.T.P', '9207324597', 'vismaya1002@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (29, 'Rinshiya', '6282923120', 'rinshiyarinu@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (30, 'ANSHITHA RAFSIN.PP', '9605827874', 'hashimsamannya@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (31, 'VISMAYA K', '9544651090', 'www.vismayakurupkalarikkal7310@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (32, 'Harikrishnan.M.P', '7510774768', 'harimp6347915@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (33, 'Muhammad Rishad p', '9846930391', 'rishadmuhammedp192@email', 1, 0, '', '', '', NULL, NULL, NULL),
       (34, 'SHAHAD. PP', '9645531217', 'shahadppshahad@gmail.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (35, 'SYAMA KP', '9567143023', 'syamavhari7@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (36, 'Fabeena PP', '7902616179', 'farsanafarsu861@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (37, 'MUHAMMED FADIL K.P ', '9995913482', 'jameelappitc@gmail.com', 4, 0, '', '', '4', NULL, NULL, NULL),
       (38, 'Mohamed Ishaq.U', '8943275457', 'ishaqmohamed159@gmail.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (39, 'Rameesha. cp', '9746236759', 'rr6276860@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (40, 'MUHAMMED SHABIL.K.P', '6238876583', 'ameenkp374@gmail.com', 2, 0, '', '', '1', NULL, NULL, NULL),
       (41, 'Haris.K', '88911815140', 'hariskodaniyil@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (42, 'Shifana Shirin kp', '9539909664', 'mariyamu2020a@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (43, 'Mohamed arshad.P', '8075868008', 'www.mohamedarshad17@gmail.com', 2, 0, '', '', '1', NULL, NULL, NULL),
       (44, 'Ishaqkp', '8592984859', 'ishaqkpishaqkp18@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (45, 'Mohammed nasim kp', '9526252689', 'mohammednasim2689@gimil.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (46, 'MUSFIRA PR', '9061194831', 'Musfiramufi22@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (47, 'Abdul wahid. P. P', '8086890729', 'vahidvahi@gmail.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (48, 'AMRUTHA.T', '7592010850', 'aamrutha867@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (49, 'Jothika', '9567620554', 'mampattapradeep@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (50, 'Mohammed Muneer.Ap', '9744805206', 'muneeradimapparambil@gmail.com', 2, 0, '', '', '1', NULL, NULL, NULL),
       (51, 'Afraja Hussain m.v', '8590508930', 'jusminathasni6@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (52, 'CHITHRADAS.CK', '9745030735', 'chithradas781@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (53, 'RIYAB C ', '8137910965', 'riyabriyu@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (54, 'Ameen Aslam. U', '9747685175', 'aslamaeen126@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (55, 'Jinshad', '8606229225', 'jinujinshad9225@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (56, 'Nasira thasni.m', '7592076812', 'niyas1971@gmail.com', 2, 0, '', '', '1', NULL, NULL, NULL),
       (57, 'Mohammed mashhoor c.p', '8592906293', 'muhsinanasarcp@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (58, 'Muhammed shifan.k', '9544610309', 'nasifkm4@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (59, 'Sicru Rahman', '7994600912', 'shukururahman375@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (60, 'Ansiya', '7025604595', 'ansiansi933@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (61, 'Riswana parvin c. P', '7592086467', 'asoora555@gimail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (62, 'AKSHAY S MENON', '07994144873', 'akshaysmenon5510@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (63, 'Shamna farhana.Kp', '8129753575', 'homedesigntirur2@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (64, 'Abdu rahoof.k', '9567818226', 'abdurahoof2002@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (65, 'Sahana Sherin PP', '7558901722', 'salammks702@gmail.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (66, 'Sulfikar ali .k', '8086241224', 'sulfikarsulfikar56@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (67, 'Sahala jasmi', '9645015058', 'www.djklvsn123@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (68, 'Dilsha. Vp', '7034994937', 'www.dilu@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (69, 'Shabana k. P', '7736921065', 'ibrahimkp7779@gmail.com', 0, 0, '', '', '', NULL, NULL, NULL),
       (70, 'Archana .p', '8156983688', 'aiswaryabalakrishnanaiswaryaac@gmail.com', 2, 0, '', '', '', NULL, NULL, NULL),
       (71, 'Sreeshna. K', '9048478562', 'sreeshnasree60@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (72, 'Fidha E', '7293341425', 'ncchcjvvvmvbvk@gmail.com', 2, 0, '', '', '', NULL, NULL, NULL),
       (73, 'Mohammed Shaheem. M', '9846738874', 'mohammedshaheem12@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (74, 'Farshana v', '8086356683', 'farshanafaru671@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (75, 'Fathima Thesli c.v', '8086275216', 'thesliayyub@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (76, 'Vrinda. P', '7902615275', 'vrindajiji123@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (77, 'Sreelakshmi ', '9961090677', 'sreelakshmi0677@gmil.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (78, 'Muhammed salimcv', '9061067620', 'muhammedsalim@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (79, 'Nasiya sherin .v', '9645529527', 'nasiyaserinnasiyamol@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (80, 'Sufiyan ali moideen', '9497645611', 'sunu.alikadalayi@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (81, 'Muhammed Nishad. P', '9567153496', 'nishadnishu3496@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (82, 'Sribin. K', '9072016196', 'sribin85@gimail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (83, 'Sameena sharin', '9746336263', 'sameenasharin137@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (84, 'Fathima muhsina.k', '9061672028', 'muhsinaMuhn@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (85, 'SADIQUE V V', '7356701145', 'ssadique414@gmail.com', 0, 0, '', '', '', NULL, NULL, NULL),
       (86, 'Shaharban', '9207550800', 'sebu@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (87, 'Shamna sharin v a ', '8921873560', 'musthafafayaz@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (88, 'FayisaFarsana. V', '9656657207', 'Muhammedfahis...055@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (89, 'Ansar kv', '9895588617', 'yahukvtirur@gmail.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (90, 'Sandramol.vp', '8129718864', 'purathursatheesan@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (91, 'Jyothi lakshmi. P', '9745387716', 'Jyothilakshmikavilakkadu@gmail.com', 0, 0, '', '', '', NULL, NULL,
        NULL),
       (92, 'Akash', '9840011471', 'akashnandhu301@gmail.com', 4, 0, '', '', '5', NULL, NULL, NULL),
       (93, 'Fida Rahman .k', '8593862824', 'fid11991@gmail.com', 2, 0, '', '', '', NULL, NULL, NULL),
       (94, 'Hasna jasmin. K', '9961902494', 'hameedhameed3368@gmail.com', 4, 0, '', '', '5', NULL, NULL, NULL),
       (95, 'Muhammed javad.M', '7994367714', 'jabujava71450@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (96, 'Muhammad Saleem.T', '7356447283', 'saleemt7510@gmail.com', 4, 0, '', '', '5', NULL, NULL, NULL),
       (97, 'Radhika A', '8137916733', 'radhikamurali@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (98, 'Harshida kp', '9539247970', 'ashraf2020@gmil.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (99, 'MUBASHIRA. N', '9539958968', 'fousiyashafi@gamil.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (101, 'Vipin.k', '9048451006', 'sanalsanalsanusonu@gmail.com', 4, 0, '', '', '5', NULL, NULL, NULL),
       (102, 'SINAN. AP', '7902693730', 'muhammedsinan27383@gmail.com', 0, 0, '', '', '', NULL, NULL, NULL),
       (103, 'Vismaya thiruvangatt', '7510483277', 'vinayathiruvangatt3277@gmail.com', 16, 0, '', '', '', NULL, NULL,
        NULL),
       (104, 'FAMEENA. C', '8086905676', 'khaleelKhaleel06870@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (105, 'Shafana sheri.Ak ', '8606823507', 'www.safarashi@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (106, 'NimyaT ', '7736243719', 'gk2343880@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (107, 'Nisham TP', '9562628785', 'Nis526265@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (108, 'Muhamed faris v v', '7356899618', 'irshu9133@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (109, 'Sahina ramsi.c', '9633127070', 'hgsgsshs@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (110, 'Munas. tk', '7593016570', 'Muneessha4@gmail.com', 4, 0, '', '', '4', NULL, NULL, NULL),
       (111, 'Ayana mohan', '7510695405', 'ayanamohanmv@gmail.com', 8, 0, '', '', '', NULL, NULL, NULL),
       (112, 'Jaliba Nasrin.k', '7909223635', 'Shafidelma@gmail.com', 4, 0, '', '', '', NULL, NULL, NULL),
       (113, 'Athul. A', '9567333165', 'athulshaji923@gmail.com', 4, 0, '', '', '', NULL, NULL, NULL),
       (114, 'Nithinpandhroli', '7994312711', 'sajithakumari8606@gmail.com', 4, 0, '', '', '', NULL, NULL, NULL),
       (115, 'Fasriya mol cp', '7591975405', 'fasaludheenomn@gmail.com', 2, 0, '', '', '2', NULL, NULL, NULL),
       (116, 'Jyothi Lakshmi c', '7994605449', 'jyothilakshmi8339@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (117, 'Mohamed ashid', '7034341302', 'abdullatheefo764@gmail.com', 4, 0, '', '', '5', NULL, NULL, NULL),
       (118, 'Siyadjasir. V', '8943100210', 'ssiyad531@gmail.com', 4, 0, '', '', '5', NULL, NULL, NULL),
       (119, 'SAHULUDHEEN ', '8139897462', 'shahalushahalu0789@gmail.com', 16, 0, '', '', '', NULL, NULL, NULL),
       (120, 'Shamnas Babu. K.T', '7994960207', '7994960207shamnasbabu3443@gmail.com', 6, 0, '', '', '', NULL, NULL,
        NULL),
       (121, 'Mubashir mi', '9526385893', 'mubashirmimuthu@gmail.com', 2, 0, '', '', '', NULL, NULL, NULL),
       (122, 'Ajisha. K', '8589971850', 'sideeq306@gmail.com', 6, 0, '', '', '', NULL, NULL, NULL),
       (123, 'Mohamed ansaf.k', '9645592310', 'ansaf9645592310@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (124, 'MUHAMMED ASHRAF. C', '7560922456', 'rash91817@gmail.com', 2, 0, '', '', '', NULL, NULL, NULL),
       (125, 'Abu Arshad.N', '8086826021', 'abuarshad37510@gmail.com', 2, 0, '', '', '3', NULL, NULL, NULL),
       (126, 'Shilpa k', '8547963762', 'shilpak@gmail.com', 0, 0, '', '', '', NULL, NULL, NULL),
       (127, 'Muhammed Ashiq M', '7561839800', 'ashiqmeleth61@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL),
       (128, 'Basil.TK', '8891426816', 'basilbasi8@gmail.com', 7, 0, '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects`
(
    `subject_id`   int(11)     NOT NULL,
    `stream_id`    int(11)     NOT NULL,
    `subject_name` varchar(50) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `stream_id`, `subject_name`)
VALUES (4, 1, 'Accountancy'),
       (5, 1, 'Business Studies'),
       (6, 1, 'Economics'),
       (7, 1, 'Political Science'),
       (8, 1, 'English'),
       (9, 1, 'Malayalam'),
       (10, 3, 'History'),
       (11, 3, 'Sociology'),
       (12, 3, 'Economics'),
       (13, 3, 'Political Science'),
       (14, 3, 'English'),
       (15, 3, 'Malayalam'),
       (16, 2, 'Business Studies'),
       (17, 2, 'Accountancy'),
       (18, 2, 'Economics'),
       (19, 2, 'Political Science'),
       (20, 2, 'English'),
       (21, 2, 'Malayalam'),
       (22, 4, 'History'),
       (23, 4, 'Sociology'),
       (24, 4, 'Economics'),
       (25, 4, 'Political Science'),
       (26, 4, 'English'),
       (27, 4, 'Malayalam'),
       (28, 7, 'Accounting for Management (V Sem)'),
       (29, 7, 'Business Research Method (V Sem)'),
       (30, 7, 'Income Tax law and Accounts (V Sem)'),
       (31, 7, 'Co-Operative theory & practice (V Sem)'),
       (32, 7, 'Legal environment work for co-operatives (V Sem)'),
       (33, 7, 'Human Rights (V Sem)'),
       (34, 7, 'Income Tax & GST (VI Sem)'),
       (35, 7, 'Auditing and Corporate Governance (VI Sem)'),
       (36, 7, 'International Co-Op movement (VI Sem)'),
       (37, 7, 'Co-operative Management & Administration (VI Sem)'),
       (38, 6, 'Basic Numerical skills ( III Sem)'),
       (39, 6, 'General Informatics (III Sem)'),
       (40, 6, 'BUSINESS REGULATIONS (III Sem)'),
       (41, 6, 'Corporate Accounting (III Sem)'),
       (42, 6, 'Human Resources Management (III Sem)'),
       (43, 6, 'Banking & insurance (IV Sem)'),
       (44, 6, 'Enterpreneurship Development (IV Sem)'),
       (45, 6, 'Cost accounting (IV Sem)'),
       (46, 6, 'Quantitative Techniques for Business (IV Sem)'),
       (47, 6, 'CORPORATE REGULATIONS (IV Sem)'),
       (48, 5, 'Transactions: Essential English Language Skill (I '),
       (49, 5, 'Ways with Words (I Sem)'),
       (50, 5, ' Malayala Sahithya Padanam - 1 (I Sem)'),
       (51, 5, 'Business Management (I Sem)'),
       (52, 5, 'Managerial Economics (I Sem)'),
       (53, 5, 'Writing for Acamemic and professional success ( II'),
       (54, 5, 'Zeitgeist: Reading on contemporary culture ( II Se'),
       (55, 5, ' Malayala Sahithya Padanam - 2 (II Sem)'),
       (56, 5, 'Financial Accounting (II Sem)'),
       (57, 5, 'Marketing Management (II Sem)'),
       (58, 20, 'BUSINESS ENGLISH'),
       (59, 20, 'ECONOMICS'),
       (60, 20, 'MARKET STUDY & ANALYSIS'),
       (61, 22, 'MARKET STUDY & ANALYSIS');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers`
(
    `teacher_id`    int(11) UNSIGNED NOT NULL,
    `full_name`     varchar(50)      NOT NULL,
    `mobile_number` varchar(10)      NOT NULL,
    `email_address` varchar(25)      NOT NULL,
    `status`        int(11) UNSIGNED NOT NULL DEFAULT '0',
    `username`      varchar(50)      NOT NULL,
    `password`      varchar(50)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `full_name`, `mobile_number`, `email_address`, `status`, `username`, `password`)
VALUES (2, 'Teena Satute', '0944682721', 'baneeishaque@gmail.com', 1, 'teacher925', 'password925'),
       (3, 'anoop', '7356150056', 'anoopgj666@gmail.com', 1, 'teacher623', 'password623'),
       (6, 'Rajan Karengel', '9656030799', 'rajankarangal14@gmail.com', 1, 'teacher708', 'password708'),
       (7, 'SHILPA', '8157020446', 'Shilpapathirikkad@gmail.c', 1, 'teacher722', 'password722'),
       (8, 'SHARAFUDHEEN', '9496808310', 'sharafosho987@gmail.com', 1, 'teacher692', 'password692'),
       (12, 'SAJEEV', '9544766657', 'sajuayyan@gmail.com', 1, 'teacher273', 'password273'),
       (13, 'NABEEL', '9567040600', 'nabeelmthalakadathur@gmai', 1, 'teacher160', 'password160'),
       (14, 'JAMSHEER NP', '9746344514', 'jamsheercompanipadi@gmail', 1, 'teacher319', 'password319'),
       (15, 'REEJA. M', '8086005205', 'manjimasuresh88@gmail.com', 1, 'teacher763', 'password763'),
       (16, 'Padmakumar', '7025369038', 'manikg.gee81@gmail.com', 1, 'teacher964', 'password964'),
       (17, 'ACHUTHAN', '7558093124', 'achuthanvappala2@gmail.co', 1, 'teacher565', 'password565'),
       (18, 'TKM BASHEER', '9447126774', 'managertirurartscollege@g', 1, 'teacher453', 'password453'),
       (20, 'LIJI. KP', '9747051476', 'lijikp1476@gmail.com', 1, 'teacher43', 'password43'),
       (21, 'MINI K', '9656189520', 'minijayaprekash869@gmail.', 1, 'teacher906', 'password906'),
       (22, 'GIREESH M', '9656473662', 'ciyonkrishm@gmail.com', 1, 'teacher960', 'password960'),
       (23, 'SARITHA. KP', '7594912989', 'sarithakp22802@gmail.com', 1, 'teacher621', 'password621'),
       (24, 'SHUHAIB. YP', '9895553154', 'suhaibyp@gmail.com', 1, 'teacher624', 'password624');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`admin_id`),
    ADD UNIQUE KEY `USERNAME` (`username`),
    ADD KEY `PASSWORD` (`passowrd`);

--
-- Indexes for table `assigns`
--
ALTER TABLE `assigns`
    ADD PRIMARY KEY (`assign_id`),
    ADD KEY `TEACHER_ID` (`teacher_id`),
    ADD KEY `SUBJECT_ID` (`subject_id`);

--
-- Indexes for table `batchs`
--
ALTER TABLE `batchs`
    ADD PRIMARY KEY (`batch_id`),
    ADD KEY `STREAM_ID` (`stream_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
    ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
    ADD PRIMARY KEY (`note_id`),
    ADD KEY `TEACHER_ID` (`teacher_id`),
    ADD KEY `SUBJECT_ID` (`subject_id`),
    ADD KEY `STATUS` (`status`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
    ADD PRIMARY KEY (`stream_id`),
    ADD KEY `COURSE_ID` (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
    ADD PRIMARY KEY (`student_id`),
    ADD UNIQUE KEY `MOBILE_NUMBER` (`mobile_number`),
    ADD UNIQUE KEY `EMAIL_ADDRESS` (`email_address`),
    ADD KEY `STUDYING_CLASS` (`studying_class`),
    ADD KEY `STATUS` (`status`),
    ADD KEY `USERNAME` (`username`),
    ADD KEY `PASSWORD` (`password`),
    ADD KEY `BATCH_NUMBER` (`batch_number`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
    ADD PRIMARY KEY (`subject_id`),
    ADD KEY `STREAM_ID` (`stream_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
    ADD PRIMARY KEY (`teacher_id`),
    ADD UNIQUE KEY `MOBILE_NUMBER` (`mobile_number`),
    ADD UNIQUE KEY `EMAIL_ADDRESS` (`email_address`),
    ADD KEY `STATUS` (`status`),
    ADD KEY `USERNAME` (`username`),
    ADD KEY `PASSWORD` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
    MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `assigns`
--
ALTER TABLE `assigns`
    MODIFY `assign_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `batchs`
--
ALTER TABLE `batchs`
    MODIFY `batch_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
    MODIFY `course_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
    MODIFY `note_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
    MODIFY `stream_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 23;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
    MODIFY `student_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 129;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
    MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 62;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
    MODIFY `teacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batchs`
--
ALTER TABLE `batchs`
    ADD CONSTRAINT `STREAM_ID` FOREIGN KEY (`stream_id`) REFERENCES `streams` (`stream_id`) ON UPDATE CASCADE;

--
-- Constraints for table `streams`
--
ALTER TABLE `streams`
    ADD CONSTRAINT `COURSE_ID` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
