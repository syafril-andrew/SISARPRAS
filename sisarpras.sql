-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Bulan Mei 2024 pada 17.49
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisarpras`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_tipe_barang` varchar(3) DEFAULT NULL,
  `merek_barang` varchar(50) DEFAULT NULL,
  `Spesifikasi` varchar(255) DEFAULT NULL,
  `Sumber` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `Lokasi_barang` varchar(3) DEFAULT NULL,
  `Kondisi_barang` varchar(15) DEFAULT NULL,
  `jumlah_barang` bigint(20) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_tipe_barang`, `merek_barang`, `Spesifikasi`, `Sumber`, `Photo`, `Lokasi_barang`, `Kondisi_barang`, `jumlah_barang`, `tanggal_input`) VALUES
(1, '1', 'axioo', 'intel core i9 ram 32gb', 'dana BOS', 'http://localhost/sisarpras/uploads/photos/Pho', '1', '1', 0, '2024-03-18'),
(2, '2', 'PC dekstop asus', 'AMD ryzen 7 8000 series ram 16gb', 'pribadi', 'http://localhost/sisarpras/uploads/files/dqln', '3', '1', 0, '2024-03-18'),
(3, '3', 'meja kursi napoli', 'meja kursi kayu', 'bos', 'http://localhost/sisarpras/uploads/files/jqd3', '3', '1', 0, '2024-03-18'),
(4, '4', 'honda', 'mesin rumput 4 tak', 'bos', 'http://localhost/sisarpras/uploads/files/a5y1', '3', '1', 0, '2024-03-18'),
(5, '1', 'asus', 'ryzen 5 7000 series ram 12gb', 'bos', 'uploads/files/ka59zct61sb7wvg.jpeg', '1', '1', 0, '2024-03-18'),
(6, '1', 'asus', 'intel core i9 ram 18 gb', 'bos', 'http://localhost/sisarpras/uploads/photos/Pho', '1', '1', 0, '2024-03-19'),
(7, '1', 'asus rog', 'core i9 ram 40gb', 'bosda', 'uploads/files/a30dut8mjqx5br6.png', '3', '1', 35, '2024-03-20'),
(8, '2', 'lenovo dekstop', 'ryzen 9 ram 32gb', 'boss', 'uploads/files/hnvzfw5qm8tapls.png', '3', '1', 5000, '2024-03-21'),
(9, '1', 'axio', 'ram 8gb', 'bos', 'uploads/files/w8os4hx7_aqbnlj.png', '1', '1', 3000, '2024-03-22'),
(10, '3', 'meja napoli', 'kayu kaca', 'bos', 'uploads/files/hopgbyrfwjmuq5s.png', '3', '1', 100, '2024-03-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_barang`
--

CREATE TABLE `kondisi_barang` (
  `id_kondisi` int(11) NOT NULL,
  `Kondisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi_barang`
--

INSERT INTO `kondisi_barang` (`id_kondisi`, `Kondisi`) VALUES
(1, 'Baik'),
(2, 'Rusak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_barang`
--

CREATE TABLE `lokasi_barang` (
  `id_lokasi` int(11) NOT NULL,
  `Lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lokasi_barang`
--

INSERT INTO `lokasi_barang` (`id_lokasi`, `Lokasi`) VALUES
(1, 'Labkom 1'),
(2, 'Labkom 2'),
(3, 'Ruang TU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_permissions`
--

CREATE TABLE `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(125, 1, 'barang', 'list'),
(126, 1, 'barang', 'view'),
(127, 1, 'barang', 'add'),
(128, 1, 'barang', 'edit'),
(129, 1, 'barang', 'editfield'),
(130, 1, 'barang', 'delete'),
(131, 1, 'barang', 'import_data'),
(132, 1, 'kondisi_barang', 'list'),
(133, 1, 'kondisi_barang', 'view'),
(134, 1, 'kondisi_barang', 'add'),
(135, 1, 'kondisi_barang', 'edit'),
(136, 1, 'kondisi_barang', 'editfield'),
(137, 1, 'kondisi_barang', 'delete'),
(138, 1, 'kondisi_barang', 'import_data'),
(139, 1, 'lokasi_barang', 'list'),
(140, 1, 'lokasi_barang', 'view'),
(141, 1, 'lokasi_barang', 'add'),
(142, 1, 'lokasi_barang', 'edit'),
(143, 1, 'lokasi_barang', 'editfield'),
(144, 1, 'lokasi_barang', 'delete'),
(145, 1, 'lokasi_barang', 'import_data'),
(146, 1, 'tipe_barang', 'list'),
(147, 1, 'tipe_barang', 'view'),
(148, 1, 'tipe_barang', 'add'),
(149, 1, 'tipe_barang', 'edit'),
(150, 1, 'tipe_barang', 'editfield'),
(151, 1, 'tipe_barang', 'delete'),
(152, 1, 'tipe_barang', 'import_data'),
(153, 1, 'user', 'list'),
(154, 1, 'user', 'view'),
(155, 1, 'user', 'add'),
(156, 1, 'user', 'edit'),
(157, 1, 'user', 'editfield'),
(158, 1, 'user', 'delete'),
(159, 1, 'user', 'import_data'),
(160, 1, 'user', 'accountedit'),
(161, 1, 'user', 'accountview'),
(162, 1, 'role_permissions', 'list'),
(163, 1, 'role_permissions', 'view'),
(164, 1, 'role_permissions', 'add'),
(165, 1, 'role_permissions', 'edit'),
(166, 1, 'role_permissions', 'editfield'),
(167, 1, 'role_permissions', 'delete'),
(168, 1, 'roles', 'list'),
(169, 1, 'roles', 'view'),
(170, 1, 'roles', 'add'),
(171, 1, 'roles', 'edit'),
(172, 1, 'roles', 'editfield'),
(173, 1, 'roles', 'delete'),
(174, 2, 'barang', 'list'),
(175, 2, 'barang', 'view'),
(176, 2, 'barang', 'add'),
(177, 2, 'barang', 'edit'),
(178, 2, 'barang', 'editfield'),
(179, 2, 'kondisi_barang', 'view'),
(180, 2, 'lokasi_barang', 'list'),
(181, 2, 'lokasi_barang', 'view'),
(182, 2, 'tipe_barang', 'list'),
(183, 2, 'tipe_barang', 'view'),
(184, 2, 'tipe_barang', 'add'),
(185, 2, 'tipe_barang', 'edit'),
(186, 2, 'tipe_barang', 'editfield'),
(187, 2, 'user', 'accountedit'),
(188, 2, 'user', 'accountview');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_barang`
--

CREATE TABLE `tipe_barang` (
  `id_tipe_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe_barang`
--

INSERT INTO `tipe_barang` (`id_tipe_barang`, `nama_barang`) VALUES
(1, 'Laptop'),
(2, 'Dekstop'),
(3, 'Meubel'),
(4, 'Mesin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-06-18 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `photo`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `user_role_id`) VALUES
(1, 'admin', '$2y$10$9Ro3lPGXsjWoN49a8whg5OHkSuEKobmdgyLCy4MEjeqKEBx7cbmt6', 'admin', 'admin@gmail.com', 'http://localhost/sisarpras/uploads/files/rhgjuexmq2vl01_.jpeg', '46eefaa5fdb5907e757d701f67d985e6', NULL, '2024-06-18 00:00:00', NULL, 1),
(2, 'user', '$2y$10$fKAvdiEh/OSdT6UyTydmy.YqLlzD7EgdEtgFpEf3hruikEuHZOkne', 'user', 'user@gmail.com', 'http://localhost/sisarpras/uploads/files/rslo4nmd5fcg_k7.png', NULL, NULL, '2024-06-18 00:00:00', NULL, 2),
(3, 'user2', '$2y$10$e6l7ZrR3THFD0GmbClSVOOTdlYzGgjdkG/O7LnJgj9G8bclj2kh6K', 'user2', 'user2@gmail.com', 'http://localhost/sisarpras/uploads/photos/WhatsApp Image 2024-03-05 at 18.22.23.jpeg', NULL, NULL, '2024-06-18 00:00:00', NULL, 2),
(4, 'admin2', '$2y$10$avLoZC4TCiF7vyBNw.NjveasZlEccSIMUywwZPGjUjMciTWaxYq1u', 'admin2', 'admin2@gmail.com', 'http://localhost/sisarpras-project/uploads/files/8b74whq3mxn_0py.png', NULL, NULL, '2024-06-18 00:00:00', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indeks untuk tabel `lokasi_barang`
--
ALTER TABLE `lokasi_barang`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indeks untuk tabel `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indeks untuk tabel `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD PRIMARY KEY (`id_tipe_barang`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kondisi_barang`
--
ALTER TABLE `kondisi_barang`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lokasi_barang`
--
ALTER TABLE `lokasi_barang`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT untuk tabel `tipe_barang`
--
ALTER TABLE `tipe_barang`
  MODIFY `id_tipe_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
