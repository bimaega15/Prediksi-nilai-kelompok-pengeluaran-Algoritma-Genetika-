-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2022 pada 08.34
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_genetika`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(150) NOT NULL,
  `username_admin` varchar(150) NOT NULL,
  `password_admin` varchar(200) NOT NULL,
  `gambar_admin` varchar(200) DEFAULT NULL,
  `telepon_admin` varchar(25) NOT NULL,
  `alamat_admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`, `gambar_admin`, `telepon_admin`, `alamat_admin`) VALUES
(1, 'Admin Algoritma Genetika', 'admin123', '0192023a7bbd73250516f069df18b500', 'default.png', '094759058734', 'my alamat gue'),
(4, 'username_admin123', 'username_admin', 'f0ece58fe92afe63d0b5ce3a2d646408', '490701652362265PemindahBukuan.png', '092387493827', 'my username_admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `databykategori`
--

CREATE TABLE `databykategori` (
  `id_databykategori` int(11) NOT NULL,
  `januari` double DEFAULT NULL,
  `februari` double DEFAULT NULL,
  `maret` double DEFAULT NULL,
  `april` double DEFAULT NULL,
  `mei` double DEFAULT NULL,
  `juni` double DEFAULT NULL,
  `juli` double DEFAULT NULL,
  `agustus` double DEFAULT NULL,
  `september` double DEFAULT NULL,
  `oktober` double DEFAULT NULL,
  `november` double DEFAULT NULL,
  `desember` double DEFAULT NULL,
  `tahun` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `databykategori`
--

INSERT INTO `databykategori` (`id_databykategori`, `januari`, `februari`, `maret`, `april`, `mei`, `juni`, `juli`, `agustus`, `september`, `oktober`, `november`, `desember`, `tahun`, `kategori_id`) VALUES
(24, 215.2, 218.01, 218.01, 220.61, 222.37, 223.76, 228.16, 233.87, 234.82, 235.3, 242.03, 242.43, 2000, 8),
(25, 245.33, 246.96, 249.49, 254.25, 256.22, 258.9, 266.11, 265.74, 267.36, 270.86, 272.73, 279.98, 2001, 8),
(26, 284.6, 291.79, 293.68, 293.86, 293.39, 292.53, 293.21, 300.44, 301.22, 305.81, 309.03, 317.28, 2002, 8),
(27, 329.58, 331.63, 330.65, 330.12, 330.06, 330.3, 328.3, 329.12, 336.1, 333.97, 333.2, 332.49, 2003, 8),
(28, 113.33, 113.45, 113.57, 114.45, 114.55, 114.73, 115.4, 116.03, 116.01, 116.79, 117.05, 117.83, 2004, 8),
(29, 119.5, 119.21, 119.74, 119.43, 118.82, 121.85, 121.81, 123.72, 124.35, 127.14, 130.85, 131.01, 2005, 8),
(30, 131.76, 133.25, 133.62, 133.94, 133.97, 134.1, 134.13, 135.1, 135.12, 134.89, 135.81, 137.4, 2006, 8),
(31, 140.34, 145.88, 146.1, 146.19, 146.15, 146.42, 147.95, 148.75, 148.84, 149.04, 152.22, 153.82, 2007, 8),
(32, 155.7, 163.42, 164.27, 165.04, 165.06, 111.82, 113.71, 114.54, 115.1, 117.22, 117.31, 117.86, 2008, 8),
(33, 120.1, 120.47, 120.61, 121.08, 121.12, 121.44, 121.62, 122.37, 122.95, 123.01, 123.97, 124.38, 2009, 8),
(34, 126.35, 126.6, 126.56, 126.72, 126.93, 126.89, 127.8, 127.83, 127.91, 128.38, 130.05, 130.95, 2010, 8),
(35, 132, 132.41, 132.82, 132.68, 133.61, 134.48, 135.9, 136.01, 136.23, 136.95, 138.2, 138.65, 2011, 8),
(36, 139.08, 141.29, 142.27, 142.77, 143.11, 143.9, 144.45, 145.81, 145.87, 147.51, 147.6, 147.59, 2012, 8),
(37, 150.28, 151.12, 151.22, 152.15, 152.75, 152.85, 152.95, 153.33, 157.23, 159.28, 159.54, 160.61, 2013, 8),
(38, 112.32, 113.57, 114.46, 114.69, 115.59, 115.83, 115.89, 117.93, 118.81, 119.32, 121.64, 123.09, 2014, 8),
(39, 123.33, 124.19, 124.35, 125.52, 125.84, 126.98, 126.97, 127.44, 128.13, 128.33, 128.61, 129.2, 2015, 8),
(40, 129.37, 129.81, 129.85, 130.61, 131.34, 131.77, 134.3, 134.21, 134.54, 134.97, 137.4, 137.67, 2016, 8),
(41, 139.26, 139.5, 139.81, 139.69, 139.61, 139.7, 141.02, 141.42, 142.49, 142.8, 143.24, 143.79, 2017, 8),
(42, 144.15, 144.59, 145.23, 145.51, 134.58, 147.15, 147.8, 148.38, 148.49, 149.05, 149.16, 149.2, 2018, 8),
(43, 149.48, 149.54, 150.13, 150.22, 150.38, 150.42, 150.43, 150.47, 150.52, 150.57, 150.66, 150.75, 2019, 8),
(44, 103.23, 104.71, 103.9, 102.65, 103.49, 103.13, 102.5, 102.15, 102.17, 102.44, 105.56, 107.35, 2020, 8),
(45, 107.99, 106.86, 107.14, 107.3, 106.89, 106.33, 106.98, 106.83, 106.93, NULL, NULL, NULL, 2021, 8),
(46, 163.25, 165.09, 168.71, 170.9, 173.76, 175.03, 176.54, 178.13, 179.64, 183.41, 184.66, 184.34, 2000, 7),
(47, 186.19, 191.29, 193.39, 194.33, 197.51, 200.91, 211.3, 213.31, 218.25, 219.99, 221.12, 226.8, 2001, 7),
(48, 235.26, 238.55, 240.82, 244.11, 246.51, 248.18, 255.03, 256.83, 263.79, 268.51, 269.81, 274.3, 2002, 7),
(49, 285.64, 290.89, 294.7, 297.34, 300.35, 308.71, 310.68, 317.92, 320.5, 300, 321.09, 324.26, 2003, 7),
(50, 131.88, 133.48, 133.53, 135.27, 137.14, 139.5, 142.05, 144.58, 145.1, 145.87, 145.91, 146.9, 2004, 7),
(51, 148.35, 148.39, 148.51, 148.86, 149.32, 149.44, 149.52, 149.83, 149.94, 155.83, 157.03, 158.04, 2005, 7),
(52, 160.24, 160.31, 160.66, 160.63, 160.66, 161.79, 162.02, 162.86, 163.05, 163.09, 165.24, 165.6, 2006, 7),
(53, 174.95, 174.21, 173.69, 173.83, 174.02, 172.46, 170.72, 170.43, 172.98, 172.95, 173.29, 174.6, 2007, 7),
(54, 175.2, 175.78, 176.22, 176.52, 178.14, 106.96, 107.47, 107.84, 108.14, 108.79, 109.17, 108.55, 2008, 7),
(55, 108.9, 108.73, 108.56, 108.21, 109.41, 109.42, 109.4, 109.8, 109.97, 110.28, 110.1, 110.47, 2009, 7),
(56, 110.44, 111.61, 112.15, 112.69, 112.45, 114.01, 114.17, 116.21, 116.54, 116.5, 116.85, 117.11, 2010, 7),
(57, 117.35, 118.02, 118.5, 118.24, 118.54, 118.85, 118.99, 119.61, 120.02, 120.18, 120.86, 121.19, 2011, 7),
(58, 121.51, 121.45, 122.32, 122.7, 123.03, 123.11, 122.93, 124.98, 125.13, 125.28, 126.96, 127.1, 2012, 7),
(59, 130.43, 130.81, 131.12, 131.73, 132.35, 132.49, 132.95, 133.65, 134.3, 134.77, 135.46, 135.7, 2013, 7),
(60, 109.64, 109.47, 109.56, 109.64, 109.72, 110, 110.44, 111.29, 111.9, 113.35, 114.02, 115.61, 2014, 7),
(61, 116.58, 116.47, 116.53, 117.71, 118.19, 118.14, 118.26, 118.33, 118.56, 119.21, 119.29, 119.44, 2015, 7),
(62, 120.11, 119.47, 119.29, 118.96, 118.79, 118.83, 118.88, 119.32, 119.33, 119.73, 120.65, 120.71, 2016, 7),
(63, 123.01, 124.03, 124.72, 128.03, 128.87, 130.53, 130.47, 130.57, 130.85, 130.9, 131.36, 131.37, 2017, 7),
(64, 132.23, 132.37, 132.44, 132.54, 134.58, 132.76, 132.84, 133.05, 133.75, 133.96, 134.08, 134.2, 2018, 7),
(65, 134.51, 134.61, 134.54, 134.25, 134.26, 134.25, 134.28, 134.48, 134.46, 134.47, 134.4, 134.4, 2019, 7),
(66, 100.26, 100.37, 100.37, 100.45, 100.45, 100.42, 100.41, 100.42, 100.44, 100.27, 100.17, 100.18, 2020, 7),
(67, 100.3, 100.39, 100.44, 100.44, 100.39, 100.72, 101.28, 101.36, 101.7, NULL, NULL, NULL, 2021, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inisialisasi`
--

CREATE TABLE `inisialisasi` (
  `id_inisialisasi` int(11) NOT NULL,
  `latih_inisialisasi` int(11) NOT NULL,
  `uji_inisialisasi` int(11) NOT NULL,
  `spread_inisialisasi_latih` int(11) NOT NULL,
  `spread_inisialisasi_uji` int(11) NOT NULL,
  `crossover_inisialisasi` double NOT NULL,
  `mutasi_inisialisasi` double NOT NULL,
  `populasi_inisialisasi` int(11) NOT NULL,
  `generasi_inisialisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inisialisasi`
--

INSERT INTO `inisialisasi` (`id_inisialisasi`, `latih_inisialisasi`, `uji_inisialisasi`, `spread_inisialisasi_latih`, `spread_inisialisasi_uji`, `crossover_inisialisasi`, `mutasi_inisialisasi`, `populasi_inisialisasi`, `generasi_inisialisasi`) VALUES
(2, 70, 30, 10, 10, 0.8, 0.7, 3, 100),
(3, 60, 40, 10, 10, 0.7, 0.8, 3, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(7, 'Data IHK Kelompok pengeluaran Perumahan, Air, Listrik dan Bahan Bakar Rumah Tangga'),
(8, 'Data IHK Kelompok pengeluaran Makanan, Minuman dan Tembakau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `instansi_konfigurasi` varchar(200) NOT NULL,
  `nama_konfigurasi` varchar(200) NOT NULL,
  `nohp_konfigurasi` varchar(25) NOT NULL,
  `alamat_konfigurasi` text NOT NULL,
  `email_konfigurasi` varchar(100) NOT NULL,
  `gambar_konfigurasi` varchar(300) NOT NULL,
  `copyright_konfigurasi` varchar(200) NOT NULL,
  `tentang_konfigurasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `instansi_konfigurasi`, `nama_konfigurasi`, `nohp_konfigurasi`, `alamat_konfigurasi`, `email_konfigurasi`, `gambar_konfigurasi`, `copyright_konfigurasi`, `tentang_konfigurasi`) VALUES
(1, 'Kantor Wilayah Programmer', 'Klarifikasi Surat Metode Naive Bayes', '082277506232', 'Alamat instansi gue bro', 'bimaega15@gmail.com', '450561652872174calories.png', 'Bima Ega Fullstack Developer', '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed asperiores hic amet maxime reiciendis vero optio eos praesentium voluptatibus. Quos facilis nam est consectetur repellat tenetur necessitatibus vitae rem! Alias sint ipsum quae cupiditate corrupti iste ut eveniet culpa deserunt magni unde commodi, labore recusandae quidem. Quidem, animi tempora vero enim asperiores ab recusandae libero eligendi rem aliquam tenetur maiores aut reprehenderit voluptatum aspernatur in molestiae officiis ipsum! Nisi quia nulla ullam ducimus ab culpa. Quisquam similique accusantium sapiente sunt voluptas aliquid? Beatae provident amet illo quibusdam obcaecati non? Nam voluptate recusandae eos ipsum, voluptatem, sequi incidunt eaque dicta totam cupiditate adipisci eius tempora dolor ratione aliquid, deleniti voluptatum illo! Pariatur, quidem illo at praesentium harum expedita molestias ullam, fugiat quisquam molestiae rem nam voluptas voluptatum voluptate laudantium totam ipsam nobis consectetur error temporibus a? Asperiores, velit neque. Aperiam, deserunt esse repellendus aliquam odit minus corrupti. Obcaecati nobis a corporis beatae. Esse fugiat consequuntur quos aliquid laudantium repudiandae nulla suscipit ipsam asperiores ducimus eligendi dolores, soluta vero eius quidem. Sint expedita laborum amet aut dolore et, harum doloribus eligendi, maiores nobis dolorum architecto nihil minus iusto iste quia tenetur ad at! Alias dolores exercitationem modi vero laborum laudantium, eius eos laboriosam ipsam nisi nulla voluptatibus ipsum consectetur culpa minima hic iure harum voluptatem possimus consequuntur mollitia ratione velit? Sequi ullam earum nobis quisquam, vitae esse perspiciatis. Ratione ipsa aliquid nobis sed. Officiis nobis repellendus, veritatis doloribus distinctio expedita ipsum quidem deserunt accusamus, laboriosam eaque nostrum ipsa odit dolorem alias. Quod culpa ea soluta, aspernatur suscipit placeat nisi dolorem non minus impedit in accusamus quis fugit, deleniti nulla deserunt consequatur explicabo, perspiciatis quae harum omnis sunt eaque ullam. Quos, culpa in ratione, autem facere enim eos nisi reprehenderit quisquam obcaecati eveniet sunt alias maiores molestias maxime. Minus at suscipit vero nobis.</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengujian`
--

CREATE TABLE `pengujian` (
  `id_pengujian` int(11) NOT NULL,
  `inisialisasi_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `bulan_prediksi_pengujian` int(11) NOT NULL,
  `tahun_prediksi_pengujian` int(11) NOT NULL,
  `keterangan_prediksi_pengujian` text NOT NULL,
  `mape_prediksi_pengujian` double NOT NULL,
  `data_prediksi_pengujian` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengujian`
--

INSERT INTO `pengujian` (`id_pengujian`, `inisialisasi_id`, `kategori_id`, `bulan_prediksi_pengujian`, `tahun_prediksi_pengujian`, `keterangan_prediksi_pengujian`, `mape_prediksi_pengujian`, `data_prediksi_pengujian`) VALUES
(3, 3, 7, 9, 2021, 'Bulan Oktober Tahun 2021', 0.43198540613556, 134.98058838585),
(4, 3, 8, 9, 2021, 'Bulan Oktober Tahun 2021', 2.539953520249, 154.57897993178),
(5, 3, 7, 9, 2021, 'Bulan Oktober Tahun 2021', 0.32696080441648, 100.76839943196),
(6, 3, 8, 9, 2021, 'Bulan Oktober Tahun 2021', 1.4829051398803, 102.35926155966),
(7, 3, 7, 9, 2021, 'Bulan Oktober Tahun 2021', 0.080751560951388, 100.25088883861),
(8, 3, 8, 9, 2021, 'Bulan Oktober Tahun 2021', 0.60901892045052, 101.81612101789);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `databykategori`
--
ALTER TABLE `databykategori`
  ADD PRIMARY KEY (`id_databykategori`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `inisialisasi`
--
ALTER TABLE `inisialisasi`
  ADD PRIMARY KEY (`id_inisialisasi`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `pengujian`
--
ALTER TABLE `pengujian`
  ADD PRIMARY KEY (`id_pengujian`),
  ADD KEY `inisialisasi_id` (`inisialisasi_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `databykategori`
--
ALTER TABLE `databykategori`
  MODIFY `id_databykategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `inisialisasi`
--
ALTER TABLE `inisialisasi`
  MODIFY `id_inisialisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengujian`
--
ALTER TABLE `pengujian`
  MODIFY `id_pengujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `databykategori`
--
ALTER TABLE `databykategori`
  ADD CONSTRAINT `databykategori_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengujian`
--
ALTER TABLE `pengujian`
  ADD CONSTRAINT `pengujian_ibfk_1` FOREIGN KEY (`inisialisasi_id`) REFERENCES `inisialisasi` (`id_inisialisasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengujian_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
