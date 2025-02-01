-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 09:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libreria_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publication_year`, `publisher`, `cover_image`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'J.B. Lippincott & Co.', 'https://placehold.co/150x200'),
(2, '1984', 'George Orwell', 1949, 'Secker & Warburg', 'https://placehold.co/150x200'),
(3, 'Pride and Prejudice', 'Jane Austen', 1813, 'T. Egerton', 'https://placehold.co/150x200'),
(4, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Charles Scribner\'s Sons', 'https://placehold.co/150x200'),
(5, 'Moby-Dick', 'Herman Melville', 1851, 'Harper & Brothers', 'https://placehold.co/150x200'),
(6, 'War and Peace', 'Leo Tolstoy', 1869, 'The Russian Messenger', 'https://placehold.co/150x200'),
(7, 'The Catcher in the Rye', 'J.D. Salinger', 1951, 'Little, Brown and Company', 'https://placehold.co/150x200'),
(8, 'Brave New World', 'Aldous Huxley', 1932, 'Chatto & Windus', 'https://placehold.co/150x200'),
(9, 'The Hobbit', 'J.R.R. Tolkien', 1937, 'George Allen & Unwin', 'https://placehold.co/150x200'),
(10, 'Fahrenheit 451', 'Ray Bradbury', 1953, 'Ballantine Books', 'https://placehold.co/150x200'),
(11, 'Crime and Punishment', 'Fyodor Dostoevsky', 1866, 'The Russian Messenger', 'https://placehold.co/150x200'),
(12, 'Wuthering Heights', 'Emily Brontë', 1847, 'Thomas Cautley Newby', 'https://placehold.co/150x200'),
(13, 'Frankenstein', 'Mary Shelley', 1818, 'Lackington, Hughes, Harding, Mavor & Jones', 'https://placehold.co/150x200'),
(14, 'Jane Eyre', 'Charlotte Brontë', 1847, 'Smith, Elder & Co.', 'https://placehold.co/150x200'),
(15, 'Dracula', 'Bram Stoker', 1897, 'Archibald Constable and Company', 'https://placehold.co/150x200'),
(16, 'The Picture of Dorian Gray', 'Oscar Wilde', 1890, 'Lippincott\'s Monthly Magazine', 'https://placehold.co/150x200'),
(17, 'Don Quixote', 'Miguel de Cervantes', 1605, 'Francisco de Robles', 'https://placehold.co/150x200'),
(18, 'Les Misérables', 'Victor Hugo', 1862, 'A. Lacroix, Verboeckhoven & Cie', 'https://placehold.co/150x200'),
(19, 'Anna Karenina', 'Leo Tolstoy', 1877, 'The Russian Messenger', 'https://placehold.co/150x200'),
(20, 'The Odyssey', 'Homer', -800, 'Ancient Greece', 'https://placehold.co/150x200'),
(21, 'The Iliad', 'Homer', -750, 'Ancient Greece', 'https://placehold.co/150x200'),
(22, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 1967, 'Harper & Row', 'https://placehold.co/150x200'),
(23, 'The Divine Comedy', 'Dante Alighieri', 1320, 'Various', 'https://placehold.co/150x200'),
(24, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 1880, 'The Russian Messenger', 'https://placehold.co/150x200'),
(25, 'Madame Bovary', 'Gustave Flaubert', 1856, 'Michel Lévy Frères', 'https://placehold.co/150x200'),
(26, 'Ulysses', 'James Joyce', 1922, 'Shakespeare and Company', 'https://placehold.co/150x200'),
(27, 'The Metamorphosis', 'Franz Kafka', 1915, 'Kurt Wolff Verlag', 'https://placehold.co/150x200'),
(28, 'The Stranger', 'Albert Camus', 1942, 'Gallimard', 'https://placehold.co/150x200'),
(29, 'The Sound and the Fury', 'William Faulkner', 1929, 'Jonathan Cape and Harrison Smith', 'https://placehold.co/150x200'),
(30, 'Beloved', 'Toni Morrison', 1987, 'Alfred A. Knopf', 'https://placehold.co/150x200');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `token` char(36) DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `admin`, `token`, `confirmed`, `fullname`) VALUES
(32, 'hupuk@mailinator.com', '$2y$10$SgoXnr0F6VIW2tFC6hJeuOky6Pj/NEFgYET/1sd9YiU1CRs8Ac1xq', 0, NULL, NULL, NULL),
(33, 'tugoqud@mailinator.com', '$2y$10$TC.ur87aUPWl0VD2R/m7ju50HNjpJCWkNj0ymUmXC1vhnBaOgl8yG', 0, NULL, NULL, NULL),
(34, 'dysawuvok@mailinator.com', '$2y$10$7HJLZ4FEUb4KdNYV5UQqo.IFb7GcR4AILEBjqWWAhYkKDT8uMEM8K', 0, NULL, NULL, NULL),
(35, 'nugyji@mailinator.com', '$2y$10$Ga4tT8G7M/x9Y3gNi9t76.FH3FADCK7AgwGEqGwO9f3HygQb2U0be', 0, NULL, NULL, NULL),
(36, 'kawarevedu@mailinator.com', '$2y$10$QKAhhoEAsQObya2LlpYZeeD1CycVZ11q1MbU0P/QfswUaVTYlK87y', 0, NULL, NULL, NULL),
(37, 'duzupicahu@mailinator.com', '$2y$10$LOE52n.Ct/ZCFl6k4tvxYeVJRe2Pv6fnTHMdKOLA4Kg9EA/fXJ/tu', 0, NULL, NULL, NULL),
(38, 'mupe@mailinator.com', '$2y$10$KsoM/yhWcoBG6.DQlZRZou3a/88JTY5qfyfHnsDQ44HT6Plh2mpSW', 0, NULL, NULL, NULL),
(39, 'nidysobyg@mailinator.com', '$2y$10$Kre1f5NADR9DsH6H0hCLE.R/q7Me7pSKMUvmBH8BvPhqJqSzo9y2K', 0, NULL, NULL, NULL),
(40, 'visil@mailinator.com', '$2y$10$2dcFjtH8TXbZMBdvO5VJR.zR1pcHcoNTMT/neYplvBeZ0IBQS8czW', 0, NULL, NULL, NULL),
(41, 'befun@mailinator.com', '$2y$10$pALH/bOcTlzSBzqym8/7JeQJMnvoMUjG0/nHQPFHqdYNEXObhO5Te', 0, NULL, NULL, NULL),
(42, 'qozo@mailinator.com', '$2y$10$YaB2W91PXEA7ndt.9L6EBe6SmDjzEi0Tkbn.3LYecEozZUH75sdPa', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
