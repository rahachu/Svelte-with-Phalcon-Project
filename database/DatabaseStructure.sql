-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2020 at 07:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pateron`
--

-- --------------------------------------------------------

--
-- Table structure for table `buktipembayaran`
--

CREATE TABLE `buktipembayaran` (
  `idsiswa_buy_product` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `productname` varchar(45) DEFAULT NULL,
  `buy_time` datetime DEFAULT NULL,
  `validation` tinyint(4) DEFAULT NULL,
  `admin` varchar(45) DEFAULT NULL,
  `payment_method` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imagedata`
--

CREATE TABLE `imagedata` (
  `idimage` int(11) NOT NULL,
  `data` mediumtext DEFAULT NULL,
  `buktipembayaran_idsiswa_buy_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `iduser` int(11) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `institution` varchar(45) DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `photo` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `type_payment_method` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `iduser` int(11) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `school` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_has_soal`
--

CREATE TABLE `siswa_has_soal` (
  `siswa_iduser` int(11) NOT NULL,
  `soal_no` int(11) NOT NULL,
  `answer` enum('A','B','C','D','E') DEFAULT NULL,
  `soal_subtest_idsubtest` int(11) NOT NULL,
  `soal_subtest_tryout_idtryout` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_has_tryout`
--

CREATE TABLE `siswa_has_tryout` (
  `siswa_iduser` int(11) NOT NULL,
  `tryout_idtryout` int(11) NOT NULL,
  `confirm_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `no` int(11) NOT NULL,
  `subtest_idsubtest` int(11) NOT NULL,
  `subtest_tryout_idtryout` int(11) NOT NULL,
  `question` longtext DEFAULT NULL,
  `option_a` mediumtext DEFAULT NULL,
  `option_b` mediumtext DEFAULT NULL,
  `option_c` mediumtext DEFAULT NULL,
  `option_d` mediumtext DEFAULT NULL,
  `option_e` mediumtext DEFAULT NULL,
  `key` enum('A','B','C','D','E') DEFAULT NULL,
  `solution` longtext DEFAULT NULL,
  `response_value` INT(45) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subtest`
--

CREATE TABLE `subtest` (
  `idsubtest` int(11) NOT NULL,
  `tryout_idtryout` int(11) NOT NULL,
  `judul` varchar(45) DEFAULT NULL,
  `time_in_minute` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `create_time` timestamp NULL DEFAULT current_timestamp(),
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tryout`
--

CREATE TABLE `tryout` (
  `idtryout` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `tryout_price` int(11) DEFAULT NULL,
  `publish_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(60) DEFAULT NULL,
  `token` char(32) DEFAULT NULL,
  `email_verified_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buktipembayaran`
--
ALTER TABLE `buktipembayaran`
  ADD PRIMARY KEY (`idsiswa_buy_product`),
  ADD KEY `iduser_idx` (`iduser`),
  ADD KEY `fk_buktipembayaran_payment_method1_idx` (`payment_method`);

--
-- Indexes for table `imagedata`
--
ALTER TABLE `imagedata`
  ADD PRIMARY KEY (`idimage`),
  ADD KEY `fk_imagedata_buktipembayaran1_idx` (`buktipembayaran_idsiswa_buy_product`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`type_payment_method`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `siswa_has_soal`
--
ALTER TABLE `siswa_has_soal`
  ADD PRIMARY KEY (`siswa_iduser`,`soal_no`,`soal_subtest_idsubtest`,`soal_subtest_tryout_idtryout`),
  ADD KEY `fk_siswa_has_soal_soal1_idx` (`soal_no`,`soal_subtest_idsubtest`,`soal_subtest_tryout_idtryout`),
  ADD KEY `fk_siswa_has_soal_siswa1_idx` (`siswa_iduser`);

--
-- Indexes for table `siswa_has_tryout`
--
ALTER TABLE `siswa_has_tryout`
  ADD PRIMARY KEY (`siswa_iduser`,`tryout_idtryout`),
  ADD KEY `fk_siswa_has_tryout_tryout1_idx` (`tryout_idtryout`),
  ADD KEY `fk_siswa_has_tryout_siswa1_idx` (`siswa_iduser`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`no`,`subtest_idsubtest`,`subtest_tryout_idtryout`),
  ADD KEY `fk_soal_subtest1_idx` (`subtest_idsubtest`,`subtest_tryout_idtryout`);

--
-- Indexes for table `subtest`
--
ALTER TABLE `subtest`
  ADD PRIMARY KEY (`idsubtest`,`tryout_idtryout`),
  ADD KEY `fk_subtest_tryout1_idx` (`tryout_idtryout`);

--
-- Indexes for table `tryout`
--
ALTER TABLE `tryout`
  ADD PRIMARY KEY (`idtryout`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buktipembayaran`
--
ALTER TABLE `buktipembayaran`
  MODIFY `idsiswa_buy_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagedata`
--
ALTER TABLE `imagedata`
  MODIFY `idimage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tryout`
--
ALTER TABLE `tryout`
  MODIFY `idtryout` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buktipembayaran`
--
ALTER TABLE `buktipembayaran`
  ADD CONSTRAINT `fk_buktipembayaran_payment_method1` FOREIGN KEY (`payment_method`) REFERENCES `payment_method` (`type_payment_method`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `siswa` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `imagedata`
--
ALTER TABLE `imagedata`
  ADD CONSTRAINT `fk_imagedata_buktipembayaran1` FOREIGN KEY (`buktipembayaran_idsiswa_buy_product`) REFERENCES `buktipembayaran` (`idsiswa_buy_product`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mentor`
--
ALTER TABLE `mentor`
  ADD CONSTRAINT `fk_mentor_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa_has_soal`
--
ALTER TABLE `siswa_has_soal`
  ADD CONSTRAINT `fk_siswa_has_soal_siswa1` FOREIGN KEY (`siswa_iduser`) REFERENCES `siswa` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_siswa_has_soal_soal1` FOREIGN KEY (`soal_no`,`soal_subtest_idsubtest`,`soal_subtest_tryout_idtryout`) REFERENCES `soal` (`no`, `subtest_idsubtest`, `subtest_tryout_idtryout`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa_has_tryout`
--
ALTER TABLE `siswa_has_tryout`
  ADD CONSTRAINT `fk_siswa_has_tryout_siswa1` FOREIGN KEY (`siswa_iduser`) REFERENCES `siswa` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_siswa_has_tryout_tryout1` FOREIGN KEY (`tryout_idtryout`) REFERENCES `tryout` (`idtryout`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `fk_soal_subtest1` FOREIGN KEY (`subtest_idsubtest`,`subtest_tryout_idtryout`) REFERENCES `subtest` (`idsubtest`, `tryout_idtryout`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subtest`
--
ALTER TABLE `subtest`
  ADD CONSTRAINT `fk_subtest_tryout1` FOREIGN KEY (`tryout_idtryout`) REFERENCES `tryout` (`idtryout`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

CREATE TABLE IF NOT EXISTS `pateron`.`siswa_has_subtest` (
  `idsiswa_has_tryout` INT(45) NOT NULL,
  `idsubtest` INT(45) NOT NULL,
  `idsiswa` INT(45) NULL,
  `result` JSON NULL,
  INDEX `idsiswa_has_tryout_idx` (`idsiswa_has_tryout` ASC),
  PRIMARY KEY (`idsiswa_has_tryout`, `idsubtest`),
  CONSTRAINT `idsiswa_has_tryout`
    FOREIGN KEY (`idsiswa_has_tryout`)
    REFERENCES `pateron`.`siswa_has_tryout` (`tryout_idtryout`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
