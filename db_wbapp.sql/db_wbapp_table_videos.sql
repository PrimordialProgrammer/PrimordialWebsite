
-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `url`, `description`, `created_at`) VALUES
(7, 'ODETARI - HYPNOTIC DATA (Super Slowed Down)', 'https://www.youtube.com/embed/6_xAESpq29g?si=A0JcwL0gUA7wIueh', 'ODETARI - HYPNOTIC DATA (Super Slowed Down)', '2024-03-05 14:50:21');
