  -- phpMyAdmin SQL Dump
  -- version 5.2.0
  -- https://www.phpmyadmin.net/
  --
  -- Host: localhost:3306
  -- Generation Time: May 17, 2026 at 10:46 AM
  -- Server version: 8.0.43
  -- PHP Version: 8.1.10

  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
  START TRANSACTION;
  SET time_zone = "+00:00";


  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;

  --
  -- Database: `spk_prioritas_tugas`
  --

  -- --------------------------------------------------------

  --
  -- Table structure for table `tugas`
  --

  CREATE TABLE `tugas` (
    `id` int NOT NULL,
    `user_id` int NOT NULL,
    `nama_tugas` varchar(255) NOT NULL,
    `deadline` datetime NOT NULL,
    `kepentingan` int NOT NULL,
    `kesulitan` int NOT NULL,
    `estimasi` float NOT NULL,
    `progress` int NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

  --
  -- Dumping data for table `tugas`
  --

  INSERT INTO `tugas` (`id`, `user_id`, `nama_tugas`, `deadline`, `kepentingan`, `kesulitan`, `estimasi`, `progress`, `created_at`) VALUES
  (1, 1, 'Laprak KIJ', '2026-05-18 18:22:00', 4, 3, 12, 65, '2026-05-17 10:22:49'),
  (2, 1, 'Laporan PBO', '2026-05-20 17:24:00', 5, 2, 6, 60, '2026-05-17 10:25:09');

  -- --------------------------------------------------------

  --
  -- Table structure for table `users`
  --

  CREATE TABLE `users` (
    `id` int NOT NULL,
    `nama` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

  --
  -- Dumping data for table `users`
  --

  INSERT INTO `users` (`id`, `nama`, `email`, `password`, `created_at`) VALUES
  (1, 'Chantiqia', 'chantiqia.rhadempta@gmail.com', '$2y$10$1hXBVEUJExIKj/y7coz2O.zhuQKh.Nh474bPQ8WRcnuptApCadCey', '2026-05-17 10:19:35');

  --
  -- Indexes for dumped tables
  --

  --
  -- Indexes for table `tugas`
  --
  ALTER TABLE `tugas`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

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
  -- AUTO_INCREMENT for table `tugas`
  --
  ALTER TABLE `tugas`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  --
  -- AUTO_INCREMENT for table `users`
  --
  ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

  --
  -- Constraints for dumped tables
  --

  --
  -- Constraints for table `tugas`
  --
  ALTER TABLE `tugas`
    ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
  COMMIT;

  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
