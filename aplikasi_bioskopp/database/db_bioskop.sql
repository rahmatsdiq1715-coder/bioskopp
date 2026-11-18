-- ============================================================
-- Database  : db_bioskop
-- Aplikasi  : XXI Bioskop (pemesanan tiket)
-- Cara pakai: import file ini lewat phpMyAdmin (tab Import),
--             database akan dibuat otomatis.
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `db_bioskop`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_bioskop`;

DROP TABLE IF EXISTS `tb_pemesanan`;
DROP TABLE IF EXISTS `film`;
DROP TABLE IF EXISTS `users`;

-- --------------------------------------------------------
-- Struktur tabel `users`
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id_user`    int(11)      NOT NULL AUTO_INCREMENT,
  `username`   varchar(50)  NOT NULL,
  `email`      varchar(100) NOT NULL,
  `password`   varchar(255) NOT NULL,
  `role`       enum('admin','user') NOT NULL DEFAULT 'user',
  `foto`       varchar(255) DEFAULT NULL,
  `created_at` timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- password: admin -> admin123 | eka & rahmat -> user123
INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin',  'admin@xxi.test',  '$2y$12$Pg0QC8juLGt/LSnl6YmXPuoq.Hhfv03AmACsw1jxBq6s7AgQmQAjK', 'admin'),
(2, 'eka',    'eka@xxi.test',    '$2y$12$RSF1IHLgPieCOmCHHrOBSutimKT.wnXGkHWEyRyepCC7zccHYGRum', 'user'),
(3, 'rahmat', 'rahmat@xxi.test', '$2y$12$spfiCu9r8AFFzP61RjnbF.s0KyiPJarPJx1WeTowFxqQKkHWGqF7q', 'user');

-- --------------------------------------------------------
-- Struktur tabel `film`
-- --------------------------------------------------------
CREATE TABLE `film` (
  `id_film`   int(11)      NOT NULL AUTO_INCREMENT,
  `judul`     varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `poster`    varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_film`),
  UNIQUE KEY `judul` (`judul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `film` (`id_film`, `judul`, `deskripsi`, `poster`) VALUES
(1, 'Avengers: Endgame', 'Pertempuran epik melawan Thanos untuk menyelamatkan semesta.', 'avengers.jpg'),
(2, 'Joker', 'Kisah kelam Arthur Fleck hingga menjadi Joker yang legendaris.', 'joker.jpg'),
(3, 'Interstellar', 'Misi antariksa demi menyelamatkan umat manusia dari kehancuran.', 'interstellar.jpg'),
(4, 'The Batman', 'Bruce Wayne melawan korupsi dan teror di kota Gotham.', 'batman.jpg'),
(5, 'Spider-Man: No Way Home', 'Spidey menghadapi multiverse dan musuh dari dunia lain.', 'spiderman.jpg'),
(6, 'John Wick 4', 'John kembali dengan aksi brutal melawan dunia pembunuh bayaran.', 'johnwick4.jpg'),
(7, 'Inception', 'Petualangan mimpi dalam mimpi karya Christopher Nolan.', 'inception.jpg'),
(8, 'Fast X', 'Dom Toretto menghadapi ancaman baru dalam saga Fast & Furious.', 'fastx.jpg');

-- --------------------------------------------------------
-- Struktur tabel `tb_pemesanan`
-- --------------------------------------------------------
CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(11)      NOT NULL AUTO_INCREMENT,
  `id_user`      int(11)      NOT NULL,
  `judul_film`   varchar(100) NOT NULL,
  `bioskop`      varchar(100) NOT NULL,
  `tanggal`      date         NOT NULL,
  `jam`          time         NOT NULL,
  `kursi`        varchar(100) NOT NULL,
  `jumlah`       int(11)      NOT NULL DEFAULT 1,
  `dipesan_pada` timestamp    NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pemesanan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_pemesanan_user` FOREIGN KEY (`id_user`)
    REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_pemesanan` (`id_user`, `judul_film`, `bioskop`, `tanggal`, `jam`, `kursi`, `jumlah`) VALUES
(2, 'Interstellar', 'XXI Central Mall', '2026-11-20', '19:00:00', 'C5, C6', 2),
(3, 'Joker',        'XXI City Plaza',  '2026-11-21', '16:00:00', 'D1',     1);
