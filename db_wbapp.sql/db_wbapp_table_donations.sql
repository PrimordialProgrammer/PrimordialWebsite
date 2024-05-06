
-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `amount`, `donation_date`) VALUES
(1, 100.00, '2024-03-05 15:11:27'),
(2, 50.00, '2024-03-05 15:11:38'),
(3, 20.00, '2024-03-05 15:16:46');
