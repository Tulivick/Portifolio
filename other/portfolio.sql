-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Set-2016 às 22:08
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Photoshop'),
(2, 'Individualidade Líquida'),
(3, 'Black Light'),
(4, 'Powder'),
(5, 'Abismoooo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeries`
--

CREATE TABLE `galeries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `image` varchar(100) COLLATE utf8_bin NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `galeries`
--

INSERT INTO `galeries` (`id`, `name`, `image`, `category_id`) VALUES
(1, 'Photoshop', 'Imagens/photoshop.jpeg', 1),
(2, 'Individualidade Líquida', 'Imagens/individualidade.jpeg', 2),
(3, 'Black Light', 'Imagens/black.jpeg', 3),
(4, 'Powder', 'Imagens/powder.jpeg', 4),
(5, 'ABISMO', 'Imagens/abismo.jpeg', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `path` varchar(100) COLLATE utf8_bin NOT NULL,
  `galery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `images`
--

INSERT INTO `images` (`id`, `path`, `galery`) VALUES
(1, 'Imagens/Photoshop/001.jpeg', 1),
(2, 'Imagens/Photoshop/002.jpeg', 1),
(3, 'Imagens/Photoshop/003.jpeg', 1),
(4, 'Imagens/Photoshop/004.jpeg', 1),
(5, 'Imagens/Photoshop/005.jpeg', 1),
(6, 'Imagens/Photoshop/006.jpeg', 1),
(7, 'Imagens/Photoshop/007.jpeg', 1),
(10, 'Imagens/Photoshop/009.jpeg', 1),
(11, 'Imagens/Photoshop/010.jpeg', 1),
(12, 'Imagens/Photoshop/011.jpeg', 1),
(13, 'Imagens/Photoshop/012.jpeg', 1),
(14, 'Imagens/Photoshop/008.jpeg', 1),
(15, 'Imagens/Photoshop/014.jpeg', 1),
(16, 'Imagens/Photoshop/015.jpeg', 1),
(17, 'Imagens/Photoshop/016.jpeg', 1),
(18, 'Imagens/Photoshop/017.jpeg', 1),
(19, 'Imagens/Photoshop/018.jpeg', 1),
(21, 'Imagens/Individualidade/001.jpeg', 2),
(22, 'Imagens/Individualidade/002.jpeg', 2),
(23, 'Imagens/Individualidade/003.jpeg', 2),
(24, 'Imagens/Black/001.jpeg', 3),
(25, 'Imagens/Black/002.jpeg', 3),
(26, 'Imagens/Powder/001.jpeg', 4),
(27, 'Imagens/Powder/002.jpeg', 4),
(28, 'Imagens/Powder/003.jpeg', 4),
(29, 'Imagens/Abismo/001.jpeg', 5),
(30, 'Imagens/Abismo/002.jpeg', 5),
(31, 'Imagens/Abismo/003.jpeg', 5),
(32, 'Imagens/Abismo/004.jpeg', 5),
(33, 'Imagens/Abismo/005.jpeg', 5),
(34, 'Imagens/Abismo/006.jpeg', 5),
(35, 'Imagens/57dc4696386bc.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesages`
--

CREATE TABLE `mesages` (
  `id` int(11) NOT NULL COMMENT 'mesage id',
  `email` varchar(60) COLLATE utf8_bin NOT NULL,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `mesage` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `active`, `password`) VALUES
(1, 'Guilherme', 'guilherme.maldonado.cruz@gmail.com', 1, '$2y$10$CBrDuGaciZhRXGDNjJV16ODYvdJDPqWZ4s7UXpRcANbDbSNEM4Of2'),
(2, 'Henrique Rozada', 'henriquerozada@hotmail.com.br', 1, '$2y$10$CBrDuGaciZhRXGDNjJV16ODYvdJDPqWZ4s7UXpRcANbDbSNEM4Of2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeries`
--
ALTER TABLE `galeries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`galery`);

--
-- Indexes for table `mesages`
--
ALTER TABLE `mesages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `galeries`
--
ALTER TABLE `galeries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `mesages`
--
ALTER TABLE `mesages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mesage id';
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `galeries`
--
ALTER TABLE `galeries`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Limitadores para a tabela `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `imgCat` FOREIGN KEY (`galery`) REFERENCES `galeries` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
