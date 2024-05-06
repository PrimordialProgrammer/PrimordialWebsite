
-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_date_added` datetime DEFAULT NULL,
  `user_time_added` datetime DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `user_access` varchar(25) DEFAULT NULL,
  `user_date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_lastname`, `user_firstname`, `user_email`, `user_password`, `user_date_added`, `user_time_added`, `user_status`, `user_access`, `user_date_updated`) VALUES
(21, 'Pelagio', 'Shan', 's2010759@usls.edu.ph', 'SP2010759', '2024-02-27 17:06:44', '2024-02-27 17:06:44', 1, 'Student', NULL);
