
-- --------------------------------------------------------

--
-- Table structure for table `donation_history`
--

CREATE TABLE `donation_history` (
  `id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `message` text DEFAULT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_history`
--

INSERT INTO `donation_history` (`id`, `donation_id`, `status`, `message`, `donation_date`) VALUES
(1, 1, 'Success', 'Thank you for your donation!', '2024-03-05 15:11:27'),
(2, 2, 'Success', 'Thank you for your donation!', '2024-03-05 15:11:38'),
(3, 3, 'Success', 'Thank you for your donation!', '2024-03-05 15:16:46');
