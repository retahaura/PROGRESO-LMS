-- PROGRESO LMS - Database contoh yang sudah dibersihkan
-- Berisi struktur tabel dan data konten pembelajaran.
-- Data akun, identitas siswa, jawaban, nilai, progres, dan riwayat aktivitas TIDAK disertakan.
-- File ini disiapkan untuk dokumentasi/referensi GitHub, bukan pengganti backup database asli.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;


-- STRUKTUR TABEL

CREATE TABLE `analisis` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `drag_drop` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hasil_tes` (
  `id_hasil` int(10) NOT NULL,
  `id_siswa` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `skor` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hasil_tes_detail` (
  `id_detail` int(10) NOT NULL,
  `id_hasil` int(10) NOT NULL,
  `id_tes` int(10) NOT NULL,
  `jawaban_siswa` varchar(255) NOT NULL,
  `jawaban_benar` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_data` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `id_soal` int(10) NOT NULL,
  `jawaban` text NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_dragdrop` (
  `id` int(10) NOT NULL,
  `id_siswa` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `id_gambar` int(10) NOT NULL,
  `pilih_label` varchar(255) NOT NULL,
  `benar` tinyint(10) NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_generalization` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_lkpd` (
  `id` int(10) NOT NULL,
  `id_lkpd` int(10) NOT NULL,
  `id_users` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_pg` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban_siswa` varchar(5) NOT NULL,
  `benar` tinyint(1) NOT NULL DEFAULT 0,
  `skor` decimal(5,2) DEFAULT 0.00,
  `waktu_submit` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_problem` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `id_soal` int(10) NOT NULL,
  `jawaban` text NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_stimulan` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `id_soal` int(10) NOT NULL,
  `jawaban` text NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jawaban_verification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kategori_tes` (
  `id` int(10) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `lkpd` (
  `id` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `materi` (
  `id_materi` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `cover_materi` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `materi_tambahan` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `nilai_akhir` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `tahap1` float DEFAULT NULL,
  `tahap2` float DEFAULT NULL,
  `tahap3` float DEFAULT NULL,
  `tahap4` float DEFAULT NULL,
  `tahap5` float DEFAULT NULL,
  `tahap6` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `rata_rata` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `observasi` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pemicu_visual` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `esai` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pg_materi` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar_pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban_a` text NOT NULL,
  `gambar_a` varchar(255) DEFAULT NULL,
  `jawaban_b` text NOT NULL,
  `gambar_b` varchar(255) DEFAULT NULL,
  `jawaban_c` text NOT NULL,
  `gambar_c` varchar(255) DEFAULT NULL,
  `jawaban_d` text NOT NULL,
  `gambar_d` varchar(255) DEFAULT NULL,
  `jawaban_e` text NOT NULL,
  `gambar_e` varchar(255) DEFAULT NULL,
  `jawaban_benar` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `progress_pertemuan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=locked, 1=open, 2=completed',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `refleksi` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `skor_dragdrop` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `total_soal` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `skor` decimal(5,2) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `studi_kasus` (
  `id` int(10) NOT NULL,
  `id_materi` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tes` (
  `id_tes` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar_pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban_a` text NOT NULL,
  `gambar_a` varchar(255) DEFAULT NULL,
  `jawaban_b` text NOT NULL,
  `gambar_b` varchar(255) DEFAULT NULL,
  `jawaban_c` text NOT NULL,
  `gambar_c` varchar(255) DEFAULT NULL,
  `jawaban_d` text NOT NULL,
  `gambar_d` varchar(255) DEFAULT NULL,
  `jawaban_e` text NOT NULL,
  `gambar_e` varchar(255) DEFAULT NULL,
  `jawaban_benar` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INDEKS DAN AUTO_INCREMENT

ALTER TABLE `analisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `drag_drop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `hasil_tes`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_kategori` (`id_kategori`);

ALTER TABLE `hasil_tes_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_hasil` (`id_hasil`,`id_tes`),
  ADD KEY `id_tes` (`id_tes`);

ALTER TABLE `jawaban_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `jawaban_dragdrop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_siswa`,`id_materi`,`id_gambar`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_soal` (`id_gambar`);

ALTER TABLE `jawaban_generalization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_materi`,`id_soal`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_soal` (`id_soal`);

ALTER TABLE `jawaban_lkpd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lkpd` (`id_lkpd`),
  ADD KEY `id_users` (`id_users`);

ALTER TABLE `jawaban_pg`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD UNIQUE KEY `uniq` (`id_siswa`,`id_materi`,`id_soal`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_soal` (`id_soal`);

ALTER TABLE `jawaban_problem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_materi`,`id_soal`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_soal` (`id_soal`);

ALTER TABLE `jawaban_stimulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_materi`,`id_soal`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_soal` (`id_soal`);

ALTER TABLE `jawaban_verification`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kategori_tes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lkpd`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

ALTER TABLE `materi_tambahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_materi`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `observasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `pemicu_visual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `pg_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `progress_pertemuan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_materi` (`id_user`,`id_materi`);

ALTER TABLE `refleksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `skor_dragdrop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_skor` (`id_siswa`,`id_materi`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `studi_kasus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materi` (`id_materi`);

ALTER TABLE `tes`
  ADD PRIMARY KEY (`id_tes`),
  ADD KEY `id_kategori` (`id_kategori`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

ALTER TABLE `analisis`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `drag_drop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

ALTER TABLE `kategori_tes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `lkpd`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `materi`
  MODIFY `id_materi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `materi_tambahan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `observasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `pemicu_visual`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

ALTER TABLE `pg_materi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

ALTER TABLE `refleksi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `studi_kasus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `tes`
  MODIFY `id_tes` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

-- DATA KONTEN PEMBELAJARAN (AMAN)

INSERT INTO `analisis` (`id`, `id_materi`, `pertanyaan`, `gambar`) VALUES
(8, 11, 'Berdasarkan data dan hasil pemprosesan jaringan sebelumnya, dugaan manakah yang paling sesuai dengan kondisi nyata? Jelaskan alasan.', NULL),
(9, 11, 'Jika ada dugaan yang kurang tepat, perbaiki dugaan tersebut menggunakan bukti/data dari tahap sebelumnya.', NULL),
(17, 14, 'Mana yang lebih aman untuk melakukan transaksi online: WiFi publik atau 4G? Jelaskan alasanmu.', NULL),
(18, 14, 'Jika kamu mengunduh file besar di beberapa lokasi (rumah, sekolah, cafe), kapan lebih tepat menggunakan WiFi dan kapan menggunakan 4G? Jelaskan alasanmu berdasarkan keamanan dan efisiensi.', NULL),
(19, 15, 'Berdasarkan kasus Ani, apakah proses login dan transaksinya sudah aman? Jelaskan alasan logismu dengan merujuk pada ciri keamanan dan fungsi SSL/HTTPS yang sudah kamu pelajari.', NULL),
(20, 15, 'Bandingkan dengan kasus Rafi pada Tahap 2. Apa perbedaan utama dari sisi keamanan data?', NULL);

INSERT INTO `drag_drop` (`id`, `id_materi`, `gambar`, `label`) VALUES
(13, 11, 'uploads/68e4ded03661b_Group 9.png', '1'),
(14, 11, 'uploads/68e4ded037504_Group 12.png', '2'),
(15, 11, 'uploads/68e4ded037c0f_Group 10.png', '3'),
(16, 11, 'uploads/68e4ded03872a_Group 11.png', '4'),
(28, 14, 'uploads/69308ae7e83f8_tahap 3, 4 HSPA.png', ''),
(29, 14, 'uploads/69308ae7e9087_tahap 3, 4 3G.png', ''),
(30, 14, 'uploads/69308ae7e9852_tahap 3, 4 EDGE.png', ''),
(31, 14, 'uploads/69308ae7ea1cc_tahap 3, 4 4GLTE.png', ''),
(32, 14, 'uploads/69308ae7ea80a_tahap 3 HSDPA 1.png', ''),
(33, 14, 'uploads/69308ae7eadf6_tahap 3, 4 GPRS.png', ''),
(34, 15, 'uploads/693098963939f_Group 1.png', ''),
(35, 15, 'uploads/693098963a08d_Group 4.png', ''),
(36, 15, 'uploads/693098963a6ff_Group 5.png', ''),
(37, 15, 'uploads/693098963adde_Group 3.png', ''),
(38, 15, 'uploads/693098963b9c9_Group 2.png', '');

INSERT INTO `kategori_tes` (`id`, `kategori`, `keterangan`) VALUES
(3, 'Pre Test', 'Pre Test adalah Kegiatan untuk mengetahui kemampuan awal Peserta Didik'),
(4, 'Post Test', 'Post Test adalah Kegiatan untuk mengetahui perkembangan kemampuan Peserta Didik');

INSERT INTO `lkpd` (`id`, `judul`, `file`, `upload_time`) VALUES
(8, 'Konsep Dan Klasifikasi jaringan Lokal dan Internet', 'uploads/lkpd/68e4e53a1d6b0_LKPD pertemuan 1.pdf', '2025-10-07 10:02:34'),
(9, 'Jenis dan Karakteristik Komunikasi Data pada Perangkat Bergerak ', 'uploads/lkpd/68e4f086c55b7_LKPD Pertemuan 2.pdf', '2025-10-07 10:50:46'),
(10, 'Keamanan Informasi dan Proteksi Data dalam Aktivitas Daring', 'uploads/lkpd/68e4f9bf64582_LKPD pertemuan 3.pdf', '2025-10-07 11:30:07');

INSERT INTO `materi` (`id_materi`, `judul`, `cover_materi`, `deskripsi`) VALUES
(11, 'Konsep Dan Klasifikasi jaringan Lokal dan Internet', '1.png', 'Perbarui Materi'),
(14, 'Jenis dan Karakteristik Komunikasi Data pada Perangkat Bergerak ', '2.png', 'Perbarui Materi'),
(15, 'Keamanan Informasi dan Proteksi Data dalam Aktivitas Daring', '3.png', 'Perbarui Materi');

INSERT INTO `materi_tambahan` (`id`, `id_materi`, `judul`, `file`) VALUES
(5, 11, 'Konsep Dan Klasifikasi jaringan Lokal dan Internet', 'uploads/pdf_68e4e4ee24e03_Materi_Pertemuan_1.pdf'),
(9, 14, 'Jenis dan Karakteristik Komunikasi Data pada Perangkat Bergerak', 'uploads/pdf_69308e4eb8d5e_Materi_pertemuan_2.pdf'),
(10, 15, 'Keamanan Informasi dan Proteksi Data dalam Aktivitas Daring', 'uploads/pdf_69309b736352b_Materi_Pertemuan_3.pdf');

INSERT INTO `observasi` (`id`, `id_materi`, `pertanyaan`, `gambar`) VALUES
(9, 11, 'Tuliskan tiga perangkat jaringan dari model 3D dan jelaskan fungsi masing-masing ', NULL),
(10, 11, 'Kelompokkan perangkat mana yang termasuk komponen LAN dan mana yang mendukung koneksi ke Internet. Jelaskan alasan pengelompokanmu.', NULL),
(15, 14, 'Setelah menonton video, sebutkan minimal 3 informasi tentang perkembangan jaringan seluler.', NULL),
(16, 14, 'Kelompokkan jaringan berikut berdasarkan urutan kecepatannya dan jelaskan dasar pengelompokkanmu berdasarkan video tersebut.', NULL),
(17, 15, 'Sebutkan minimal tiga ciri situs aman dan tiga ciri situs tidak aman berdasarkan hasil observasi ikon keamanan dan pencarian informasi tambahan.', NULL),
(18, 15, 'Jelaskan dengan bahasamu sendiri bagaimana SSL/TLS melindungi data saat login berdasarkan informasi yang kamu temukan.', NULL);

INSERT INTO `pemicu_visual` (`id`, `id_materi`, `esai`, `gambar`) VALUES
(23, 11, 'Berdasarkan gambar (perhatikan materi singkat bagian perbedaan LAN dan Internet), sebutkan tiga perangkat yang terhubung dalam jaringan Sekolah (LAN) dan jelaskan fungsi singkat tiap perangkat.', NULL),
(30, 11, 'Sebutkan tiga perbedaan utama antara jaringan Sekolah (LAN) dan Internet dari gambar tersebut.', NULL),
(31, 14, 'setelah kamu membaca materi singkat diatas, menurutmu apa perbedaan fungsi antara Bluetooth, WiFi, dan Data Seluler?', NULL),
(32, 14, 'Jika kamu harus mengirim file ke teman, jenis komunikasi data mana yang paling cocok? Mengapa?', NULL),
(33, 15, 'Apa informasi keamanan yang dapat kamu temukan dari perbandingan situs HTTP dan HTTPS?', 'uploads/693091a304cab_1.png'),
(34, 15, 'Menurutmu, informasi keamanan apa yang diterapkan situs HTTPS sehingga lebih aman saat login dibandingkan HTTP?', NULL);

INSERT INTO `pg_materi` (`id`, `id_materi`, `pertanyaan`, `gambar_pertanyaan`, `jawaban_a`, `gambar_a`, `jawaban_b`, `gambar_b`, `jawaban_c`, `gambar_c`, `jawaban_d`, `gambar_d`, `jawaban_e`, `gambar_e`, `jawaban_benar`) VALUES
(21, 11, 'Sebuah sekolah memasang jaringan sederhana menggunakan modem dan switch saja, tanpa router. Setelah pemasangan, seluruh komputer dapat langsung terhubung ke internet, tetapi beberapa perangkat sering mengalami konflik alamat IP. Dari kasus tersebut, kondisi paling mungkin yang terjadi adalah', '', 'Internet menjadi sangat aman', '', 'Semua perangkat langsung terhubung ke internet tanpa pengaturan alamat', '', 'Tidak diperlukan pembagian bandwidth', '', 'WiFi otomatis tersedia', '', 'Switch dapat membagi alamat IP ke semua perangkat', '', 'B'),
(22, 11, 'Andi baru memasang internet di rumah. Karena kurang paham, ia menyambungkan modem langsung ke laptop, tanpa router. Setelah itu, laptopnya tidak bisa mendapatkan koneksi stabil dan tidak muncul alamat IP otomatis. Dampak paling tepat dari alur pemasangan tersebut adalah', '', 'Laptop tetap bisa membagikan internet ke perangkat lain', '', 'Laptop tidak dapat menerima alamat IP otomatis', '', 'Router menjadi lebih cepat', '', 'Akses internet menjadi lebih aman', '', 'Kecepatan internet menjadi lebih tinggi', '', 'B'),
(23, 11, 'Di laboratorium sekolah, teknisi menempatkan router sebelum switch dalam alur jaringan. Akibatnya, hanya beberapa perangkat yang berhasil mendapatkan Internet, sementara sisanya gagal terhubung. Dampak yang paling mungkin terjadi adalah', '', 'Semua perangkat mendapat Internet, tetapi tidak bisa berbagi data lokal', '', 'Router menjadi lebih cepat karena hanya satu perangkat', '', 'Switch tidak lagi dibutuhkan', '', 'Hanya perangkat yang terhubung langsung ke router yang memperoleh alamat IP', '', 'WiFi tidak memerlukan password', '', 'D'),
(24, 11, 'Pada sebuah jaringan, router tidak mengaktifkan fitur DHCP sehingga tidak ada perangkat yang menerima IP address otomatis. Dampak yang paling mungkin terjadi adalah', '', 'Semua perangkat tetap bisa mengakses Internet dengan cepat', '', 'Perangkat tidak dapat terhubung ke jaringan atau Internet', '', 'Switch otomatis memberikan alamat IP cadangan', '', 'ISP akan mengirimkan IP address langsung ke setiap klien', '', 'Kecepatan jaringan meningkat karena beban router berkurang', '', 'B'),
(25, 11, 'Pada sebuah skenario, perangkat pengguna terhubung ke switch dengan benar, namun router tidak tersambung ke ISP. Akibat paling mungkin adalah', '', 'Pengguna hanya bisa mengakses Internet tetapi tidak bisa berbagi data lokal', '', 'Pengguna dapat berbagi data lokal tetapi tidak dapat mengakses Internet', '', ' Pengguna tetap bisa online karena switch menggantikan fungsi router', '', 'Router otomatis membuat koneksi Internet baru tanpa ISP', '', 'Semua perangkat menjadi lebih aman karena tidak terhubung Internet', '', 'B'),
(26, 12, 'Seorang siswa menggunakan jaringan EDGE untuk mengakses video pembelajaran. Namun, videonya sering buffering. Komponen apa yang paling logis dianalisis penyebab buffering tersebut?', '', 'EDGE memiliki kecepatan data yang rendah dibanding generasi setelahnya', '', 'EDGE membutuhkan kabel tambahan agar stabil', '', 'EDGE lebih cepat dari 4G sehingga tidak ada masalah', '', 'EDGE tidak mendukung akses internet pada ponsel', '', 'EDGE hanya digunakan untuk komunikasi suara', '', 'A'),
(27, 12, 'Seorang siswa ingin melakukan video conference dengan kualitas tinggi. Dari pilihan generasi jaringan seluler berikut: GPRS, EDGE, 3G, HSPA, dan 4G/LTE, manakah yang paling sesuai untuk kebutuhan tersebut?', '', 'GPRS', '', 'EDGE', '', ' 3G', '', 'HSPA', '', '4G/LTE', '', 'E'),
(28, 12, 'Di rumah, seorang siswa mengirim file melalui Bluetooth, tetapi membutuhkan waktu lama dibanding menggunakan Wi-Fi. Analisis paling tepat yang menjelaskan hal ini adalah...', '', 'Bluetooth lebih cepat daripada Wi-Fi untuk semua jenis file', '', 'Wi-Fi memiliki bandwidth lebih besar dibanding Bluetooth', '', 'Bluetooth hanya bisa digunakan jika ada internet', '', 'Wi-Fi hanya digunakan untuk akses internet, bukan transfer file', '', 'Bluetooth tidak dapat digunakan untuk komunikasi data', '', 'B'),
(29, 12, 'Seorang teknisi diminta memilih metode koneksi data antara laptop dan ponsel untuk transfer file besar. Pilihan manakah yang paling efisien?', '', 'Bluetooth karena tidak memerlukan kabel', '', 'Kabel data karena transfer lebih cepat dan stabil', '', 'Wi-Fi karena lebih lambat dibanding Bluetooth', '', 'Bluetooth karena mendukung semua jenis file dengan kecepatan tinggi', '', 'Kabel data karena hanya bisa digunakan untuk mengisi daya', '', 'B'),
(30, 12, 'Seorang siswa ingin bermain game online dengan ponselnya. Ia bisa memilih jaringan 3G atau 4G/LTE. Analisis manakah yang paling tepat?', '', '3G lebih stabil dan cepat dibanding 4G/LTE', '', '4G/LTE memiliki kecepatan lebih tinggi dan lebih cocok untuk game online', '', '3G digunakan khusus untuk video streaming', '', '4G/LTE tidak bisa digunakan untuk bermain game online', '', '3G dan 4G/LTE tidak memiliki perbedaan kecepatan yang signifikan', '', 'B'),
(31, 13, 'Seorang guru mengunggah nilai siswa ke server sekolah melalui website dengan protokol HTTP. Beberapa hari kemudian, data tersebut bocor dan diakses pihak tidak bertanggung jawab. Analisis paling logis penyebab kebocoran adalahâ€¦', '', 'HTTP tidak menyediakan enkripsi sehingga data mudah disadap', '', 'Server sekolah terlalu sibuk sehingga data terbuka', '', 'Browser otomatis menyimpan data di cache', '', 'Jaringan sekolah terlalu lambat sehingga data rusak', '', 'HTTPS hanya digunakan untuk situs media sosial, bukan server sekolah', '', 'A'),
(32, 13, 'Seorang siswa membuka situs belanja online. Browser menampilkan URL https:// dengan ikon gembok hijau. Analisis paling tepat adalahâ€¦', '', 'Situs tidak aman karena masih bisa diakses publik', '', 'Situs menggunakan SSL/TLS sehingga lebih aman', '', 'Situs hanya bisa diakses melalui jaringan lokal', '', 'Situs membutuhkan VPN untuk bisa terenkripsi', '', 'Situs otomatis menghapus semua data pengguna', '', 'B'),
(33, 13, 'Rani ingin masuk ke akun email sekolah. Ia melihat alamat situs hanya http:// tanpa ikon gembok. Analisis paling logis yang seharusnya dilakukan Rani adalahâ€¦', '', 'Tetap login karena jaringan sekolah dianggap aman', '', 'Mengabaikan peringatan browser', '', 'Membatalkan login karena data bisa disadap pihak ketiga', '', 'Menggunakan browser lain agar berubah otomatis jadi HTTPS', '', 'Menyimpan password di catatan ponsel untuk berjaga-jaga', '', 'C'),
(34, 13, 'Bandingkan dua kondisi berikut, login ke akun media sosial dengan HTTP atau login ke akun media sosial dengan HTTPS. Manakah analisis yang paling tepat?', '', 'Keduanya sama-sama aman karena hanya browser yang berbeda', '', 'HTTP lebih cepat karena tanpa enkripsi, tapi rawan disadap', '', 'HTTPS lebih lambat dan tidak cocok untuk login', '', 'HTTP dan HTTPS sama saja, hanya beda tampilan', '', 'HTTPS hanya bisa digunakan pada server lokal', '', 'B'),
(35, 13, 'Seorang siswa ingin melindungi data pribadinya. Ia sudah membuat kata sandi yang kuat, namun jarang menggantinya. Analisis yang paling logis untuk melengkapi perlindungan data adalahâ€¦', '', 'Menggunakan HTTP agar lebih cepat', '', 'Membagikan password kepada teman terdekat', '', 'Mengaktifkan autentikasi dua faktor (OTP)', '', 'Menyimpan password di catatan ponsel', '', 'Tidak perlu enkripsi file penting', '', 'C'),
(36, 14, 'Situasi: kamu berada di tempat dengan sinyal seluler penuh tetapi WiFi rumah sedang padat pengguna. Jaringan mana yang paling stabil untuk melakukan Zoom meeting?', '', 'Wifi', '', '3G', '', '4G', '', 'EDGE', '', 'Bluetooth', '', 'C'),
(37, 14, 'Ketika berada di area publik yang hanya menyediakan WiFi terbuka (tanpa password), tindakan paling tepat untuk mengunggah video Instagram adalah', '', 'Menggunakan WiFi terbuka', '', 'Beralih ke 4G', '', 'Tetap menggunakan WiFi karena gratis', '', 'Mengaktifkan Bluetooth', '', 'Menggunakan mode pesawat', '', 'B'),
(38, 14, 'Perhatikan kondisi berikut (1) Kuota 4G kamu hampir habis, (2) WiFi lambat karena banyak pengguna, (3) Kamu harus mengirim file penting sebelum jam 6. \r\nPilihan paling masuk akal adalah\r\n', '', 'Tetap WiFi karena hemat kuota', '', 'Gunakan Bluetooth', '', 'Gunakan hotspot teman', '', 'Matikan jaringan', '', 'Gunakan 4G sementara', '', 'E'),
(39, 15, 'Kamu sedang login ke e-learning sekolah menggunakan Wi-Fi kampus. Browser menampilkan ikon gembok, tetapi muncul peringatan bahwa sertifikat SSL sudah kedaluwarsa. Tindakan paling tepat adalah ', '', 'Tetap login karena koneksi kampus pasti aman', '', 'Menonaktifkan SSL agar koneksi lebih cepat', '', 'Menggunakan data seluler sementara', '', 'Melanjutkan login dan mengganti password setelahnya', '', 'Login hanya untuk membuka file tidak penting', '', 'C'),
(40, 15, 'Seseorang sering menggunakan Wi-Fi publik untuk belanja online. Upaya yang paling efektif untuk melindungi data transaksinya adalah', '', 'Menghapus riwayat browser', '', 'Mengaktifkan mode incognito', '', 'Mematikan JavaScript', '', 'Menggunakan VPN + HTTPS', '', 'Menggunakan HP orang lain', '', 'D'),
(41, 15, 'Perhatikan daftar tindakan berikut:\r\n(1) Menggunakan OTP, (2) Mengganti password rutin, (3) Menyimpan password di catatan HP, (4) Selalu login di HTTP, (5) Menggunakan 2FA.\r\nTindakan proteksi data yang paling tepat diprioritaskan lebih dulu adalah \r\n', '', '(2), (3), (5)', '', '(3), (4), (5)', '', '(1), (4), (5)', '', '(1), (2), (4)', '', '(1), (5), (2)', '', 'E');

INSERT INTO `refleksi` (`id`, `id_materi`, `pertanyaan`, `gambar`) VALUES
(3, 11, 'Jelaskan hubungan antara LAN dan Internet dengan bahasamu sendiri, lalu berikan dua contoh penerapan nyata di sekolah.', NULL),
(4, 11, 'Apa hal paling menarik yang kamu pelajari hari ini, dan mengapa menurutmu itu penting?\r\n', NULL),
(8, 14, 'Buat kesimpulan singkat tentang kapan sebaiknya menggunakan Bluetooth, WiFi, dan 4G. serta buatlah rekomendasi koneksi yang paling cocok untuk 3 aktivitas. Aktivitas berikut diantaranya seperti Kirim file, Streaming film dan Video call.', NULL),
(9, 15, 'Berdasarkan materi yang telah kamu pelajari tentang proteksi data daring (HTTPS, SSL/TLS, Wi-Fi publik, dan tindakan preventif), tuliskan kesimpulan akhir tentang bagaimana cara menjaga keamanan data saat login dan transaksi online.', NULL);

INSERT INTO `studi_kasus` (`id`, `id_materi`, `pertanyaan`, `gambar`) VALUES
(13, 11, 'Apa masalah utama yang terjadi pada jaringan sekolah jika internet sering lambat saat jam pelajaran? Rumuskan dua dugaan penyebabnya dan jelaskan alasan logis tiap dugaan.', NULL),
(14, 11, 'Identifikasi dua faktor yang mungkin menyebabkan penurunan performa jaringan di lab komputer dan berikan alasan.', NULL),
(24, 14, 'Menurut dugaanmu, mengapa koneksi Rara menjadi tidak stabil?', NULL),
(25, 14, 'Ketika kamu menjadi Rara, solusi apa yang paling logis untuk meningkatkan kecepatan jaringan berdasarkan kondisi di atas? Jelaskan alasan dugaanmu.', NULL),
(26, 15, 'Berdasarkan kasus tersebut, apa dugaanmu mengenai penyebab utama kebocoran data login Rafi?', NULL),
(27, 15, 'Jelaskan dugaan awal bagaimana kondisi Wi-Fi publik dan situs HTTP dapat meningkatkan risiko pencurian data tersebut.', NULL);

INSERT INTO `tes` (`id_tes`, `id_kategori`, `pertanyaan`, `gambar_pertanyaan`, `jawaban_a`, `gambar_a`, `jawaban_b`, `gambar_b`, `jawaban_c`, `gambar_c`, `jawaban_d`, `gambar_d`, `jawaban_e`, `gambar_e`, `jawaban_benar`) VALUES
(32, 3, 'Kevin sedang berada di rumah. Ia mencetak dokumen dari laptop ke printer yang terhubung melalui Wi-Fi rumah. Setelah itu, Kevin mengunggSah tugasnya ke Google Drive. Berdasarkan kegiatan tersebut, jenis jaringan apa yang digunakan Kevin pada masing-masing aktivitas?', NULL, 'Mencetak menggunakan jaringan lokal, mengunggah menggunakan jaringan internet ', NULL, 'Mencetak menggunakan jaringan internet, mengunggah menggunakan jaringan lokal ', NULL, 'Kedua aktivitas menggunakan jaringan lokal ', NULL, 'Kedua aktivitas menggunakan jaringan internet', NULL, 'Semua aktivitas menggunakan Bluetooth', NULL, 'A'),
(33, 3, 'Sebuah sekolah memiliki dua jenis jaringan.  Jaringan pertama digunakan untuk mengakses server lokal yang berisi modul  pelajaran, sedangkan jaringan kedua digunakan untuk mengakses internet saat  pembelajaran daring.  Berdasarkan perbedaan fungsi tersebut, bagaimana cara paling tepat  membedakan kedua jenis jaringan itu? ', NULL, ' Jaringan lokal lebih lambat daripada jaringan internet.', NULL, 'Jaringan internet hanya digunakan untuk akses file dalam satu ruangan', NULL, ' Jaringan lokal tidak membutuhkan koneksi ISP, sementara internet  memerlukannya', NULL, 'Keduanya tidak dapat digunakan secara bersamaan.', NULL, 'Jaringan lokal membutuhkan browser, sedangkan internet tidak.', NULL, 'C'),
(34, 3, 'Pada gambar terlihat perangkat A yang terhubung ke beberapa komputer dalam  jaringan lokal. Diketahui bahwa perangkat A berfungsi mengatur lalu lintas  data pada jaringan lokal dan juga memiliki banyak port untuk menghubungkan  beberapa perangkat secara bersamaan. Berdasarkan kedua informasi tersebut,  perangkat A kemungkinan besar adalahâ€¦.  ', 'uploads/698196a840a5c_3.png', 'Modem ', NULL, 'Router ', NULL, 'Repeater ', NULL, 'Switch ', NULL, 'Access Point ', NULL, 'D'),
(35, 3, 'Doni sedang melakukan observasi terhadap sebuah jaringan di laboratorium. Ia  menemukan sebuah perangkat yang menerima sinyal dari modem, kemudian  mendistribusikannya ke beberapa komputer melalui kabel LAN. Dari hasil  pengamatannya, Doni memahami bahwa perangkat tersebut berfungsi  menghubungkan jaringan lokal dengan internet.  Berdasarkan urutan informasi tersebut, perangkat yang dimaksud Doni  adalahâ€¦ ', NULL, ' Switch ', NULL, 'Access Point', NULL, 'Hub', NULL, 'Router ', NULL, 'Repeater ', NULL, 'D'),
(36, 3, 'Bela sedang mengamati penggunaan jaringan di rumahnya. Pertama, ia  menemukan bahwa dua komputer di rumahnya terhubung melalui router WiFi,  sehingga keduanya dapat berbagi printer dan folder. Setelah itu, saat membuka  YouTube, ia memperhatikan bahwa perangkatnya mengakses layanan dari  internet. Dari rangkaian aktivitas tersebut, Bela ingin memahami jenis jaringan  yang digunakan pada tiap situasi.  Berdasarkan urutan informasi tersebut, pernyataan yang paling tepat adalah â€¦', NULL, 'Komputer yang dihubungkan router disebut jaringan internet,  sedangkan akses YouTube menggunakan jaringan lokal ', NULL, 'Semua kegiatan Bela termasuk dalam jaringan internet ', NULL, 'Berbagi printer melalui router merupakan contoh jaringan lokal,  sedangkan akses YouTube menggunakan jaringan internet ', NULL, 'Keduanya merupakan jaringan lokal karena masih dalam satu rumah ', NULL, 'Koneksi YouTube dan printer sama-sama disebut jaringan LAN ', NULL, 'C'),
(37, 3, 'Di laboratorium komputer sekolah, beberapa siswa mengalami masalah tidak  bisa membuka situs web tertentu, sementara siswa lain dapat mengakses  internet dengan normal. Semua komputer sudah terhubung ke jaringan yang  sama. Jika Anda diminta menganalisis masalah tersebut, dugaan awal manakah  yang paling logis? ', NULL, 'Server internet sekolah sedang mengalami gangguan jaringan total', NULL, 'Beberapa komputer memiliki pengaturan DNS atau proxy yang tidak  tepat ', NULL, 'Siswa yang tidak bisa akses internet tidak memiliki akun Google ', NULL, 'Router utama terlalu jauh dari ruang laboratorium ', NULL, 'Situs web yang dimaksud tidak tersedia di Indonesia ', NULL, 'B'),
(38, 3, 'Perhatikan gambar berikut. Jika Printer sering tidak terdeteksi oleh Komputer 1, namun Komputer 2 tetap  bisa mencetak, permasalahan paling mungkin terdapat pada bagianâ€¦ ', 'uploads/698196a84235e_7.png', 'Modem ', NULL, 'Kabel antara Switch dan Komputer 1 ', NULL, 'Router ', NULL, 'Printer ', NULL, 'Kabel antara Router dan Switch', NULL, 'B'),
(39, 3, 'Sebuah sekolah berencana menghubungkan ruang guru, perpustakaan, dan  laboratorium komputer ke jaringan internet. Ruang guru dan perpustakaan  berada dalam satu gedung dan berjarak dekat, sementara laboratorium terletak  di gedung terpisah yang dipisahkan oleh area taman.  Berdasarkan kondisi tersebut, pilihan jenis koneksi jaringan manakah yang  paling tepat dan logis untuk diterapkan? ', NULL, ' Menggunakan Wi-Fi untuk semua ruangan karena lebih praktis ', NULL, 'Menggunakan kabel LAN untuk seluruh ruangan karena memiliki  kecepatan tinggi', NULL, 'Menggunakan koneksi Bluetooth antar ruangan karena bebas kabel ', NULL, 'Menggunakan modem USB pada setiap komputer agar lebih mandiri', NULL, 'Menggunakan kabel LAN untuk ruangan dalam gedung utama dan Wi Fi untuk laboratorium ', NULL, 'E'),
(40, 3, 'Perhatikan ilustrasi berikut. Jika hanya laptop D dan E mengalami lag saat video call, sementara A, B, dan  C lancar, kesimpulan paling logis dari kondisi ini adalahâ€¦ ', 'uploads/698196a842f82_9.png', ' Wi-Fi tidak kompatibel dengan laptop D dan E ', NULL, 'Sinyal Wi-Fi lemah dibanding koneksi kabel', NULL, 'Router hanya mendukung 3 koneksi perangkat ', NULL, ' Laptop D dan E mengalami gangguan software ', NULL, 'Komputer A, B, dan C memakai bandwidth lebih banyak ', NULL, 'B'),
(41, 3, 'Nina ingin memindahkan foto-foto dari ponselnya ke laptop tanpa  menggunakan kabel. Ketika mencoba menggunakan Bluetooth, proses transfer  berjalan sangat lambat dan semakin terganggu saat ia bergerak menjauh dari  laptop. Untuk mengatasi hal tersebut, ia kemudian beralih menggunakan  jaringan WiFi melalui aplikasi berbasis cloud.  Berdasarkan kasus tersebut, manakah alasan paling tepat dan beralasan yang  menjelaskan keputusan Nina beralih ke WiFi? ', NULL, ' Bluetooth tidak dapat digunakan untuk memindahkan file berukuran  besar sehingga Nina perlu mencari metode lain ', NULL, 'WiFi menawarkan jangkauan yang lebih luas dan kecepatan transfer  data yang lebih tinggi dibanding Bluetooth sehingga lebih efektif untuk  memindahkan banyak file ', NULL, 'Kabel data lebih praktis dibanding jaringan nirkabel sehingga  seharusnya digunakan sejak awal ', NULL, 'Bluetooth hanya cocok digunakan pada perangkat dengan sistem  operasi yang sama sehingga Nina mengalami masalah kompatibilitas ', NULL, 'Jaringan WiFi dapat berfungsi tanpa koneksi internet sehingga lebih  fleksibel digunakan ', NULL, 'B'),
(42, 3, 'Sebuah sekolah sedang menguji coba sistem absensi otomatis berbasis ponsel.  Proses absensi berlangsung melalui beberapa tahap: siswa mendekatkan ponsel  mereka ke perangkat pemindai, data identitas terbaca otomatis dalam hitungan  detik, dan kehadiran langsung tercatat tanpa memerlukan koneksi internet.   Untuk memastikan proses tersebut berjalan cepat, stabil, dan hanya aktif ketika  perangkat berada dalam jarak yang sangat dekat, jenis komunikasi data  manakah yang paling sesuai digunakan dalam sistem absensi tersebut? ', NULL, 'Kabel data ', NULL, 'Jaringan WiFi', NULL, 'Bluetooth ', NULL, 'NFC ', NULL, 'Modem USB ', NULL, 'C'),
(43, 3, 'Dika menggunakan kabel data untuk menyalin file video dari laptop ke ponsel,  dan proses berlangsung sangat cepat. Ketika mencoba metode yang sama  menggunakan Bluetooth, proses memakan waktu lebih lama.  Berdasarkan cerita diatas bagaimana kesimpulan yang bisa diambil dari  perbandingan tersebut? ', NULL, 'Bluetooth cocok digunakan untuk transfer file dalam jumlah besar. ', NULL, 'Kecepatan transfer data kabel dan Bluetooth tidak jauh berbeda', NULL, 'Kabel data memberikan efisiensi lebih tinggi dibanding Bluetooth  dalam transfer file besar', NULL, 'Kabel data memerlukan koneksi internet agar proses transfer berhasil. ', NULL, 'Bluetooth lebih aman daripada kabel data. ', NULL, 'C'),
(44, 3, 'Alya berlibur ke daerah pegunungan dan mendapati bahwa ponselnya hanya  menampilkan koneksi â€œEâ€, sehingga proses membuka media sosial sangat  lambat. Ketika kembali ke kota, koneksi ponselnya berubah menjadi â€œ4Gâ€ dan  aplikasi dapat berjalan dengan lancar. Setelah mencari informasi, Alya  mengetahui bahwa â€œEâ€ adalah jaringan EDGE dan â€œ4Gâ€ merupakan bagian  dari jaringan LTE modern.  Berdasarkan informasi tersebut, bagaimana cara Alya mengklasifikasikan  kedua jenis jaringan yang ia alami? ', NULL, 'EDGE menggunakan media transmisi nirkabel yang lebih kuat  dibanding 4G ', NULL, '4G memiliki kecepatan lebih lambat dibanding EDGE sehingga lebih  boros daya ', NULL, 'EDGE dan 4G termasuk jaringan berbasis kabel dengan perbedaan  kecepatan ', NULL, 'EDGE merupakan jaringan berkecepatan rendah, sedangkan 4G adalah  jaringan berkecepatan tinggi ', NULL, '4G dan EDGE memiliki kecepatan setara tetapi menggunakan media  transmisi berbeda ', NULL, 'D'),
(45, 3, 'Empat siswa melakukan video call dari lokasi yang berbeda untuk  membandingkan kualitas jaringan ponsel yang mereka gunakan. Rafi berada di  pedesaan dan tersambung ke jaringan GPRS; panggilan yang ia lakukan  berjalan patah-patah dan sering terputus. Dina yang berada di wilayah  perkotaan menggunakan jaringan 3G, dan panggilannya cukup lancar  meskipun gambar tampak sedikit buram. Rina yang berada di kota besar  tersambung ke jaringan 4G dan memperoleh hasil video call yang sangat lancar  serta tajam. Sementara itu, Budi yang berada di daerah dekat pegunungan  menggunakan jaringan EDGE dan mengalami panggilan yang sering terputus  serta gagal tersambung.   Berdasarkan rangkaian aktivitas dan hasil video call tersebut, bagaimana cara  paling tepat untuk mengklasifikasikan jenis jaringan komunikasi yang  digunakan para siswa? ', NULL, ' Semua jaringan di atas menggunakan kabel data sehingga kualitasnya  bergantung pada panjang kabel ', NULL, '4G dan 3G memiliki kecepatan dan kestabilan lebih baik karena  menggunakan media transmisi gelombang radio yang lebih kuat. ', NULL, 'EDGE dan GPRS termasuk koneksi cepat karena tetap muncul di  daerah terpencil ', NULL, 'GPRS dan EDGE adalah jaringan generasi awal dengan kecepatan  rendah, sedangkan 3G dan 4G merupakan jaringan generasi lebih baru  dengan kecepatan lebih tinggi ', NULL, 'Semua jaringan memiliki media transmisi dan kecepatan yang sama  karena sama-sama menggunakan sinyal ponsel ', NULL, 'D'),
(46, 3, 'Seorang pengguna ingin menghubungkan ponselnya dengan perangkat audio  mobil secara nirkabel, sambil tetap menerima pesan internet dari media sosial.  Ia juga ingin melakukan transfer file cepat ke laptop. Berdasarkan kebutuhan  tersebut, urutan pilihan koneksi yang paling tepat dan logis adalahâ€¦ ', NULL, 'Wifi untuk semua kebutuhan', NULL, 'Bluetooth untuk internet, Wifi untuk audio ', NULL, 'Kabel data untuk audio, Bluetooth untuk media sosial ', NULL, ' Bluetooth untuk audio, Wifi untuk media sosial, Kabel data untuk file ', NULL, 'GPRS untuk semuanya ', NULL, 'D'),
(47, 3, 'Perhatikan gambar berikut yang menunjukkan struktur konektivitas jaringan tersebut. Berdasarkan gambar tersebut, simpulan apakah yang paling tepat mengenai  struktur konektivitas yang digunakan dan apa keuntungannya? ', NULL, 'Semua berbasis nirkabel, sehingga menghemat daya  ', NULL, 'Kombinasi kabel dan nirkabel untuk efisiensi penggunaan ', NULL, 'Tidak efisien karena banyak koneksi bersamaan ', NULL, 'Hanya satu koneksi aktif yang optimal ', NULL, 'Semua koneksi menggunakan media transmisi satelit ', NULL, 'B'),
(48, 3, 'Siti tinggal di daerah pinggiran kota yang sinyal internetnya tidak stabil. Ia  membutuhkan koneksi jaringan untuk belajar daring dan sesekali bermain gim  online. Di rumah, tersedia jaringan WiFi dengan kecepatan sedang namun  sering mengalami gangguan saat cuaca buruk. Ia juga memiliki kuota data dari  operator seluler yang mendukung jaringan 4G LTE dengan kecepatan tinggi,  tetapi kuotanya terbatas.  Jika Anda berada dalam posisi Siti, simpulkan jenis koneksi jaringan yang  paling efektif untuk digunakan sehari-hari dan buatlah rekomendasi alternatif  agar aktivitas digitalnya tetap berjalan optimal dalam kondisi tersebut.  Berdasarkan studi kasus tesebut, bagaimana kesimpulan dan rekomendasi  terbaik berdasarkan kebutuhan dan kondisi Siti?', NULL, ' Tetap gunakan jaringan WiFi, karena lebih murah dan tidak terbatas,  meskipun sering gangguan saat cuaca buruk', NULL, 'Gunakan kuota 4G LTE sepenuhnya karena kecepatannya tinggi, tanpa  mempertimbangkan keterbatasan kuota. ', NULL, 'Gunakan WiFi sebagai koneksi utama untuk belajar, dan simpan kuota  4G LTE untuk kebutuhan penting seperti gim online saat WiFi tidak  stabil. ', NULL, 'Hentikan penggunaan WiFi dan gunakan koneksi kabel LAN agar lebih  stabil di rumah. ', NULL, 'Gunakan WiFi dan kuota secara bersamaan untuk meningkatkan  kecepatan internet. ', NULL, 'C'),
(49, 3, 'Salsa sedang mengakses Wi-Fi publik di sebuah kedai kopi. Ia membuka  aplikasi perbankan dan melakukan transaksi tanpa memastikan apakah jaringan  tersebut menggunakan enkripsi. Temannya, Dita, mengingatkannya bahwa  banyak Wi-Fi publik tidak dilengkapi sistem enkripsi sehingga data yang  dikirim dapat dengan mudah disadap oleh pihak lain.  Berdasarkan kasus tersebut, berikan argumen Anda mengenai siapa yang  berada pada risiko terbesar dan aktivitas apa yang seharusnya tidak dilakukan  ketika menggunakan jaringan publik tanpa enkripsi. ', NULL, 'Salsa, karena aktivitas finansial seperti perbankan sangat sensitif dan  berisiko tinggi bila dilakukan tanpa enkripsi ', NULL, 'Dita, karena menggunakan aplikasi chatting lebih rawan daripada  transaksi perbankan ', NULL, 'Dita, karena tidak memahami bahwa semua Wi-Fi publik aman untuk  aktivitas apapun ', NULL, ' Salsa, karena tidak menggunakan perangkat yang mendukung 4G', NULL, 'Tidak ada yang salah karena seluruh Wi-Fi saat ini sudah otomatis  terenkripsi ', NULL, 'A'),
(50, 3, 'Sebuah laporan keamanan siber menunjukkan bahwa serangan man-in-the middle meningkat pesat pada jaringan tanpa enkripsi. Dalam praktiknya,  banyak pengguna tidak sadar bahwa mengakses media sosial di jaringan tanpa  proteksi dapat membocorkan informasi login mereka.  Berdasarkan pernyataan tersebut, apa konsekuensi nyata dari komunikasi data  tanpa enkripsi dan contoh aktivitas online yang sebaiknya dihindari dalam  kondisi tersebut? ', NULL, 'Informasi pribadi bisa dicegat; hindari login ke akun penting seperti  email dan sosial media', NULL, 'Jaringan melambat; sebaiknya tidak menonton video ', NULL, 'Ponsel tidak akan bisa terkoneksi; hindari browsing ', NULL, 'Hanya berpengaruh pada aplikasi chatting; sebaiknya gunakan SMS ', NULL, 'Tidak ada konsekuensi serius; aktivitas apapun tetap aman ', NULL, 'A'),
(51, 3, 'Dari informasi gambar berikut, situs mana yang aman untuk login dan  mengapa? ', 'uploads/698196a84665a_20.jpeg', ' Situs A dan C, karena keduanya memakai HTTPS dan memiliki SSL ', NULL, 'Hanya situs A, karena berada di urutan pertama ', NULL, 'Situs B, karena tidak menggunakan enkripsi ', NULL, 'Situs B dan C, karena ikonnya berbeda ', NULL, 'Semua situs sama, karena akses tetap bisa dilakukan ', NULL, 'A'),
(52, 3, 'Dalam praktik pengumpulan data, guru meminta siswa memeriksa keamanan  beberapa situs. Salah satu siswa menemukan bahwa beberapa situs memiliki  SSL aktif namun tidak menampilkan ikon gembok pada browser tertentu.  Berdasarkan pernyataan tersebut, kesimpulan mana yang paling tepat? ', NULL, 'Tidak semua situs dengan SSL selalu menampilkan ikon gembok,  namun koneksi tetap terenkripsi ', NULL, 'Semua situs yang tidak menampilkan ikon gembok pasti tidak aman', NULL, 'Ikon gembok hanya untuk situs jual beli ', NULL, 'SSL tidak penting dalam pengamanan data pengguna ', NULL, 'Situs tanpa ikon gembok selalu lebih cepat ', NULL, 'A'),
(53, 3, 'Sebuah situs donasi online menampilkan ikon gembok pada bilah alamat  browser. Dito mengatakan bahwa ikon tersebut menunjukkan situs aman  karena SSL aktif.  Berdasarkan pernyataan Dito, jelaskan mengapa SSL penting untuk keamanan  transaksi online dan aktivitas apa yang sebaiknya dihindari ketika  menggunakan situs tanpa SSL? ', NULL, 'SSL mengenkripsi data seperti nomor kartu sehingga tidak bisa diakses  pihak ketiga', NULL, 'SSL mempercepat koneksi internet ke server', NULL, 'SSL membuat tampilan situs menjadi lebih menarikSSL hanya bekerja  saat sinyal Wi-Fi kuat ', NULL, 'SSL digunakan hanya untuk login akun sosial media ', NULL, 'Situs tanpa SSL rentan terhadap pencurian data sehingga tidak aman  digunakan untuk transaksi atau memasukkan informasi sensitif ', NULL, 'A'),
(54, 3, 'Sebuah toko online memutuskan untuk tidak memperbarui sertifikat SSL  situsnya. Pelanggan mulai merasa ragu saat ingin memasukkan informasi kartu  kredit mereka.  Berdasarkan studi kasus tersebut, kesimpulan yang paling tepat dari situasi ini  adalahâ€¦ ', NULL, 'Pelanggan terlalu waspada dalam bertransaksi digital ', NULL, 'Sertifikat SSL tidak terlalu berpengaruh terhadap perilaku pengguna ', NULL, 'Pengabaian terhadap SSL dapat menurunkan kepercayaan pengguna  karena risiko keamanan meningkat ', NULL, 'Informasi kartu kredit tetap aman selama server aktif ', NULL, 'Masalah ini hanya berdampak bagi pengguna baru ', NULL, 'C'),
(55, 3, 'Perhatikan skema berikut ini (bayangkan sebuah form login untuk aplikasi  online, di mana pengguna memasukkan username dan password, tetapi  komunikasi data belum dienkripsi dan tidak ada autentikasi tambahan). Dari skema tersebut, metode keamanan apa yang paling tepat untuk  memperbaiki komunikasi data dan melindungi informasi pribadi pengguna? ', 'uploads/698196a848a2a_24.png', ' Menggunakan metode POST untuk input data ', NULL, 'Menambahkan autentikasi dua factor ', NULL, 'Mengaktifkan SSL untuk enkripsi komunikasi data ', NULL, 'Mengganti server dengan spesifikasi tinggi', NULL, 'Menghapus fitur login pada form', NULL, 'C'),
(56, 3, 'Siti sedang ingin membeli produk dari sebuah toko online yang ia temukan  lewat media sosial. Saat membuka situs tersebut, ia melihat bahwa alamat  URL-nya dimulai dengan http:// dan tidak terdapat ikon gembok pada kolom  alamat browser. Namun, tampilan toko terlihat profesional dan harga produk  cukup menarik. Ia ragu untuk melanjutkan transaksi.  Berdasarkan kasus tersebut, manakah penilaian yang paling tepat terhadap  kondisi keamanan situs dan alasan logisnya? ', NULL, ' Siti dapat melanjutkan transaksi karena tampilan situs menarik, dan  HTTP sudah cukup untuk belanja online', NULL, 'Situs tanpa HTTPS tetap aman jika menggunakan metode pembayaran  tunai saat barang datang. ', NULL, 'Tidak masalah menggunakan HTTP jika hanya melihat-lihat produk  tanpa memasukkan informasi pribadi. ', NULL, 'itus tersebut tidak menjamin keamanan data karena tidak memiliki  enkripsi, sehingga transaksi berisiko tinggi. ', NULL, 'Selama situs tidak meminta informasi login, SSL tidak diperlukan  dalam transaksi. ', NULL, 'D'),
(57, 4, 'Di sebuah sekolah, semua komputer laboratorium dihubungkan ke satu switch  agar dapat berbagi data secara lokal. Setelah itu, ketika siswa mengakses situs  pembelajaran daring, komputer menggunakan koneksi dari penyedia layanan  internet. Dari rangkaian aktivitas tersebut, siswa diminta mengklasifikasikan  jenis koneksi yang digunakan.  Berdasarkan kasus tersebut, bagaimana seharusnya siswa mengklasifikasikan  dua jenis koneksi tersebut? ', NULL, 'Semua termasuk jaringan lokal karena masih di lingkungan sekolah ', NULL, ' Koneksi ke switch merupakan jaringan lokal, sedangkan koneksi  internet berasal dari jaringan global', NULL, 'Koneksi ke situs pembelajaran adalah bagian dari jaringan lokal ', NULL, 'Switch dan koneksi internet tidak bisa digunakan bersamaan ', NULL, ' Koneksi ke situs daring merupakan jaringan lokal karena digunakan di  sekolah ', NULL, 'B'),
(58, 4, 'Setiap malam sekitar pukul 20.00â€“22.00, koneksi internet di rumah Sinta  menjadi sangat lambat. Namun di luar jam tersebut, koneksi berjalan normal.  Sinta sudah mencoba merestart router dan mengganti password Wi-Fi, tetapi  masalah tetap terjadi.   Berdasarkan gejala tersebut, kesimpulan paling logis mengenai penyebab  utama gangguan jaringan adalahâ€¦ ', NULL, 'Router mengalami kerusakan hardware ringan ', NULL, 'Gangguan dari alat elektronik di rumah seperti TV dan AC ', NULL, 'Pemakaian bandwidth tinggi secara bersamaan oleh pengguna lain di  jaringan ', NULL, 'Perangkat Sinta mengalami virus yang menguras data ', NULL, 'Sinta lupa membayar tagihan internet bulanan ', NULL, 'C'),
(59, 4, 'berdasarkan gambar birikut ini, bagaimana urutan koneksi yang paling tepat dan efisien untuk menyusun  jaringan tersebut?', 'uploads/6981ca8a0b226_3.jpeg', 'Modem â†’ Switch â†’ Router â†’ Komputer & Printer ', NULL, 'Router â†’ Modem â†’ Komputer â†’ Printer ', NULL, 'Modem â†’ Router â†’ Switch â†’ Komputer â†’ Printer (wireless) ', NULL, 'Printer â†’ Switch â†’ Router â†’ Modem â†’ Komputer', NULL, 'Switch â†’ Router â†’ Komputer & Printer â†’ Modem ', NULL, 'C'),
(60, 4, 'Dalam simulasi LMS, Anda diminta menyusun struktur jaringan untuk sebuah  warnet kecil. Langkah awal yang Anda lakukan adalah menghubungkan  modem ke router, kemudian router ke switch. Setelah itu, Anda perlu  menentukan jenis koneksi untuk 8 komputer dan 1 printer Wi-Fi agar jaringan  bekerja stabil dan efisien.   Berdasarkan tahapan tersebut, konfigurasi koneksi yang paling tepat adalahâ€¦', NULL, 'Menghubungkan semua komputer dengan kabel LAN, sementara  printer tetap memakai Wi-Fi ', NULL, 'Menghubungkan semua komputer menggunakan Wi-Fi agar lebih  fleksibel ', NULL, 'Printer dan komputer disambungkan ke router secara wireless', NULL, 'Menghubungkan seluruh perangkat langsung ke switch tanpa router ', NULL, 'Menghubungkan modem langsung ke switch lalu mendistribusikan ke  komputer ', NULL, 'A'),
(61, 4, 'Di sebuah sekolah menengah, terjadi keluhan dari guru dan siswa mengenai  lambatnya koneksi saat mengakses platform pembelajaran daring. Tim IT  sekolah kemudian diminta melakukan evaluasi jaringan. Dari hasil  pengecekan, diketahui bahwa jaringan yang digunakan sepenuhnya  menggunakan koneksi nirkabel (WiFi), dan sebagian perangkat berada jauh  dari router utama. berdasarkan studi berikut,  opsi manakah yang paling tepat untuk  meningkatkan efisiensi dan keamanan jaringan sekolah? ', 'uploads/6981ca8a0c433_5.jpeg', 'Opsi 1, karena WiFi lebih fleksibel dan dapat menjangkau banyak  perangkat tanpa biaya tambahan. ', NULL, 'Opsi 1, karena memperkuat sinyal akan mempercepat koneksi tanpa  harus menambah kabel.', NULL, 'Opsi 2, karena koneksi kabel memiliki kecepatan dan keamanan lebih  stabil untuk perangkat tetap.', NULL, 'Opsi 2, karena koneksi kabel lebih murah dan tidak memerlukan  perangkat tambahan seperti repeater. ', NULL, 'Kedua opsi sama-sama efektif, tergantung pada jumlah pengguna di  sekolah. ', NULL, 'C'),
(62, 4, 'Fifi dan Jisoo sedang merancang jaringan komputer di rumah kontrakan  mereka yang dipakai tempat belajar online bersama. Fifi ingin menggunakan  koneksi kabel LAN untuk komputer dan printer, sedangkan Jisoo lebih  memilih koneksi WiFi agar lebih praktis untuk menghubungkan banyak  perangkat sekaligus.  Namun setelah mencoba, mereka menemukan bahwa printer sering bermasalah  saat menggunakan WiFi: sinyal tidak stabil, dan jarak antar ruangan terlalu  jauh. Mereka pun harus memutuskan jenis koneksi utama yang akan  digunakan, dengan mempertimbangkan efisiensi dan keamanan jaringan.  Jika Anda diminta memberikan rekomendasi dengan alasan yang paling kuat,  manakah pilihan berikut yang paling tepat? ', NULL, 'Gunakan kabel LAN seluruhnya agar tidak perlu menarik kabel dan  tetap fleksibel ', NULL, 'Gunakan kabel LAN seluruhnya karena lebih cepat, meskipun tidak  menjangkau seluruh ruangan. ', NULL, 'Gunakan kombinasi: kabel LAN untuk perangkat tetap dan WiFi untuk  perangkat bergerak.', NULL, 'Gunakan WiFi dengan tambahan router agar koneksi menjangkau  seluruh ruangan, tanpa kabel. ', NULL, 'Gunakan printer dengan sambungan Bluetooth untuk menghindari  masalah koneksi sama sekali. ', NULL, 'C'),
(63, 4, 'Pak Nanang adalah seorang guru di sekolah pedesaan yang ingin menerapkan  sistem pembelajaran digital. Namun kondisi geografis menyebabkan akses  internet sering lambat dan tidak stabil. Di sekolah tersedia beberapa komputer  yang dapat digunakan secara lokal, sementara Pak Nanang juga ingin siswa  tetap dapat mengakses materi dari rumah.  Berdasarkan analisis kebutuhan di sekolah dan keterbatasan akses internet  tersebut, manakah solusi jaringan yang paling tepat untuk mendukung  pembelajaran di sekolah dan di rumah? ', NULL, 'Menghubungkan seluruh komputer ke jaringan lokal berbasis kabel LAN  dan tidak mengandalkan internet sama sekali ', NULL, 'Menggunakan hotspot ponsel siswa sebagai jaringan utama untuk  berbagi materi ', NULL, 'Membeli server cloud pribadi dan menyediakan jaringan nirkabel kuat  untuk seluruh desa', NULL, 'Menggabungkan jaringan lokal untuk penggunaan di sekolah dengan  penyimpanan cloud ringan untuk akses materi dari rumah ketika internet  memungkinkan', NULL, 'Menyuruh siswa membawa flashdisk agar dapat membaca materi tanpa  internet ', NULL, 'D'),
(64, 4, 'Pada sebuah sekolah, terdapat dua kondisi jaringan yang digunakan dalam  kegiatan sehari-hari. Di laboratorium komputer, seluruh perangkat terhubung  menggunakan kabel LAN dan hanya dapat mengakses file serta aplikasi yang  tersimpan pada server lokal sekolah. Sementara itu, di ruang guru, komputer komputer terhubung melalui jaringan Wi-Fi dan dapat mengakses berbagai  layanan berbasis internet seperti email, platform e-learning, dan penyimpanan  cloud.  Berdasarkan informasi tersebut, pernyataan manakah yang paling tepat untuk  membedakan karakteristik jaringan di kedua ruangan tersebut? ', NULL, 'Jaringan di laboratorium merupakan jaringan internet karena  menggunakan kabel dan server lokal sebagai pusat data ', NULL, ' Jaringan di ruang guru tergolong jaringan lokal karena menggunakan  koneksi nirkabel yang cepat. ', NULL, ' Jaringan di laboratorium termasuk jaringan lokal karena terbatas hanya  dalam satu lokasi dan tidak terhubung ke internet, sedangkan di ruang  guru termasuk jaringan internet karena terhubung ke sumber daya  global. ', NULL, 'Keduanya termasuk jaringan lokal karena berada dalam satu institusi  sekolah.', NULL, 'Jaringan di ruang guru tidak termasuk jaringan karena menggunakan  wifi yang tidak terlihat secara fisik. ', NULL, 'C'),
(65, 4, 'Di rumah Andi tersedia dua jenis koneksi internet: koneksi kabel LAN dan  koneksi nirkabel Wi-Fi. Kedua jenis koneksi ini digunakan untuk kegiatan  sekolah daring, streaming, dan berbagi file. Namun, belakangan Andi sering  mengalami gangguan jaringan.  Sebagai siswa informatika, Andi diminta mengevaluasi kedua jenis koneksi  tersebut dan menentukan jenis koneksi yang paling layak diprioritaskan untuk  aktivitas belajar, dengan mempertimbangkan efisiensi transfer data, stabilitas,  dan keamanan jaringan.  Pernyataan berikut manakah yang merupakan argumen paling kuat dalam  mengevaluasi pilihan koneksi tersebut?', NULL, 'Koneksi Wi-Fi lebih mudah diakses dari mana saja di rumah, sehingga  lebih fleksibel digunakan ', NULL, 'Koneksi kabel LAN stabil tetapi pemasangannya membutuhkan  perangkat tambahan dan kurang praktis ', NULL, 'Koneksi kabel LAN menyediakan kecepatan dan keamanan yang lebih  konsisten, sehingga lebih dapat diandalkan untuk aktivitas yang  membutuhkan kestabilan tinggi ', NULL, 'Koneksi Wi-Fi tidak memerlukan pemasangan fisik sehingga lebih  hemat waktu ', NULL, 'Koneksi kabel LAN kurang cocok digunakan di ruangan yang jauh dari  router ', NULL, 'C'),
(66, 4, 'Seorang pengguna ingin berbagi file video berukuran besar di dalam  rumahnya. Ia mencoba beberapa langkah berikut: pertama, ia memastikan  perangkat dapat terhubung tanpa kabel agar lebih fleksibel; kedua, ia  membutuhkan kecepatan transfer yang cukup tinggi agar proses pemindahan  tidak memakan waktu lama; dan ketiga, ia membutuhkan jangkauan koneksi  yang stabil ketika berpindah dari ruang tamu ke kamar.  Berdasarkan informasi pada tabel mengenai karakteristik kabel data, Bluetooth,  dan WiFi, jenis komunikasi data manakah yang paling sesuai dengan  kebutuhan pengguna tersebut? ', 'uploads/6981ca8a0ef0d_10.jpeg', 'Kabel Data ', NULL, 'WiFi ', NULL, 'Bluetooth ', NULL, 'NFC', NULL, 'Infrared ', NULL, 'B'),
(67, 4, 'Nina sedang menonton video YouTube saat bepergian dengan kereta api. Di  sepanjang perjalanan, koneksi internetnya mengalami fluktuasi. Di daerah  perkotaan, videonya berjalan lancar dengan resolusi tinggi, tetapi ketika  memasuki daerah pedesaan, kualitas videonya menurun dan sering buffering.   Berdasarkan ilustrasi tersebut, jenis jaringan komunikasi ponsel yang  kemungkinan digunakan Nina saat mengalami resolusi tinggi dan saat buffering  berturut-turut adalahâ€¦ ', NULL, 'HSPA dan EDGE', NULL, '4G/LTE dan GPRS ', NULL, 'EDGE dan 3G', NULL, 'GPRS dan HSPA', NULL, '3G dan 2G ', NULL, 'B'),
(68, 4, 'Sebuah perusahaan startup yang bergerak di bidang layanan pengiriman  berbasis aplikasi berencana memperluas operasinya ke wilayah pelosok. Tim  IT perlu memilih jenis koneksi ponsel yang paling memungkinkan aplikasi  tetap berjalan meskipun berada di area dengan sinyal sangat lemah. Mereka  menargetkan koneksi yang cenderung lambat namun tetap stabil, serta masih  mampu mengirimkan data sederhana seperti teks lokasi atau status pengiriman.   Berdasarkan karakteristik tersebut, jenis jaringan mana yang paling tepat  dipilih, dan apa alasan paling logis yang mendukung pilihan tersebut?', NULL, ' 4G/LTE', NULL, 'EDGE ', NULL, '3G ', NULL, 'HSDPA', NULL, 'GPRS ', NULL, 'E'),
(69, 4, 'Belly sedang melakukan wawancara online melalui aplikasi video conference.  Ketika menggunakan koneksi GPRS, kualitas video sering terputus dan suara  menjadi tidak sinkron. Setelah mengganti ke koneksi 4G, masalah tersebut  berkurang drastis.  Berdasarkan studi kasus tersebut, Apa penyebab utama masalah yang dialami  Belly saat menggunakan GPRS untuk video conference?', NULL, 'GPRS menggunakan media transmisi kabel yang lambat', NULL, 'GPRS hanya mendukung komunikasi suara, bukan data ', NULL, '4G memiliki keterbatasan untuk jaringan lokal saja', NULL, 'Perangkat Ani tidak mendukung fitur jaringan seluler ', NULL, 'GPRS memiliki latensi dan bandwidth yang sangat rendah ', NULL, 'E'),
(70, 4, 'Dalam sebuah sesi pembelajaran di LMS, siswa diminta mengikuti beberapa  aktivitas menggunakan ponsel. Pertama, mereka harus mengunggah tugas ke  LMS yang membutuhkan koneksi internet yang stabil dan cepat. Setelah itu,  siswa diminta mengirim file secara langsung kepada teman di dekatnya  sehingga memerlukan koneksi jarak dekat tanpa kabel. Pada tahap terakhir,  siswa harus memutar audio melalui speaker nirkabel untuk kebutuhan  demonstrasi dalam kelas.  Berdasarkan ketiga aktivitas tersebut, urutan struktur konektivitas ponsel yang  paling tepat dan logis sesuai kebutuhan adalahâ€¦ ', NULL, 'Bluetooth â€“ Wifi â€“ Bluetooth ', NULL, 'Wifi â€“ Bluetooth â€“ Kabel data', NULL, 'Wifi â€“ Bluetooth â€“ Bluetooth', NULL, 'Wifi â€“ Kabel data â€“ Bluetooth ', NULL, 'Bluetooth â€“ Kabel data â€“ Wifi ', NULL, 'C'),
(71, 4, 'Riko sedang bepergian ke daerah pedesaan yang hanya memiliki sinyal  jaringan GPRS. Ketika mencoba mengakses aplikasi peta online dan membuka  beberapa foto yang dikirim melalui pesan, aplikasi memuat dengan sangat  lambat bahkan sering gagal. Saat ia kembali ke kota dan berpindah ke jaringan  4G, semua data dapat diakses dengan cepat dan lancar.  Berdasarkan kasus tersebut, berikan argumen Anda mengenai jaringan  komunikasi data mana yang paling sesuai untuk kebutuhan akses cepat  terhadap data multimedia seperti peta digital dan gambar, serta jelaskan  karakteristik yang mendukung alasan tersebut. ', NULL, 'GPRS â€“ Berbasis paket data kecil, cocok untuk komunikasi teks. ', NULL, 'EDGE â€“ Lebih cepat dari GPRS, namun masih lambat untuk  multimedia.', NULL, '3G â€“ Stabil untuk suara dan teks, tapi lambat untuk data besar. ', NULL, 'HSPA â€“ Lebih cepat dari 3G, mendukung video call tapi belum optimal  untuk streaming HD. ', NULL, '4G/LTE â€“ Kecepatan tinggi, cocok untuk streaming, akses multimedia,  dan low-latency', NULL, 'E'),
(72, 4, 'Di sekolahnya, Andi sedang melakukan riset kecil tentang efektivitas jaringan  ponsel. Ia mengamati bahwa ketika teman-temannya berada di dalam gedung  sekolah, sinyal EDGE lebih mudah diterima dibandingkan sinyal HSPA.  Namun, ketika di luar ruangan, HSPA memberikan koneksi internet yang lebih  cepat. Ia ingin menggunakan jaringan paling efektif untuk mengakses LMS  saat ujian online berlangsung di kelas.  Dari data pengamatan Andi, metode analisis apa yang paling tepat digunakan  untuk menentukan jaringan terbaik, dan keputusan jaringan manakah yang  paling logis diambil Andi saat ujian berlangsung di dalam kelas? ', NULL, 'EDGE karena dapat masuk ke dalam gedung, meskipun lambat, yang  penting sinyal stabil. ', NULL, 'HSPA karena lebih cepat di luar, jadi akan lebih baik secara umum. ', NULL, ' EDGE karena keterbatasan sinyal HSPA di dalam ruangan, walau  kecepatan EDGE terbatas.', NULL, 'Tidak ada jaringan yang efektif karena gedung sekolah menghambat  semua jenis sinyal. ', NULL, 'Menggabungkan dua jenis jaringan agar keduanya aktif saat digunakan  di dalam kelas. ', NULL, 'C'),
(73, 4, 'Dua siswa, Andi dan Rina, diminta untuk mengunggah tugas video berukuran  besar dari rumah masing-masing. Andi menggunakan koneksi 4G/LTE dari  smartphone miliknya, sedangkan Rina menggunakan Bluetooth tethering dari  ponsel ke laptop. Setelah proses unggah selesai, Andi dapat menyelesaikan  tugas hanya dalam waktu 10 menit, sementara Rina membutuhkan lebih dari  40 menit dan beberapa kali mengalami koneksi terputus.  Berdasarkan situasi tersebut, berikan argumen Anda mengenai evaluasi  efisiensi dan keamanan dari kedua koneksi data tersebut. Manakah pernyataan  yang paling tepat?', NULL, 'Koneksi Bluetooth lebih unggul dalam kecepatan dan keamanan karena  lebih hemat energi.', NULL, '4G/LTE memiliki kecepatan tinggi namun rentan terhadap serangan,  sehingga kurang layak digunakan untuk unggahan data besar. ', NULL, 'Bluetooth tethering sangat lambat dan tidak efisien untuk unggahan file  besar, serta tidak dirancang untuk kebutuhan data intensif. ', NULL, 'Rina sebaiknya tetap menggunakan Bluetooth karena lebih aman dan  stabil dibanding jaringan seluler. ', NULL, 'Andi lebih baik menggunakan Bluetooth juga agar hemat kuota dan  lebih aman. ', NULL, 'C'),
(74, 4, 'Saat melakukan pencarian lowongan kerja, Lani membuka dua situs berbeda.  Situs pertama menampilkan ikon gembok dan alamat dimulai dengan \"https\",  sementara situs kedua tidak menunjukkan ikon apapun dan menggunakan  \"http\".  bedasarkan pernyataan berikut, apa keputusan yang tepat jika Lani ingin  memasukkan data pribadinya dengan aman? ', NULL, ' Memilih situs dengan HTTPS karena data akan dienkripsi melalui SSL ', NULL, 'Mengisi data di situs HTTP karena tampilannya lebih menarik', NULL, 'Kedua situs sama aman selama tidak ada virus ', NULL, 'Tidak penting memperhatikan protokol karena menggunakan laptop  pribadi ', NULL, 'Situs HTTP lebih stabil untuk form online', NULL, 'A'),
(75, 4, 'Sebuah sekolah mengembangkan sistem presensi online bagi siswa  menggunakan jaringan publik tanpa sistem enkripsi. Dalam dua minggu,  beberapa siswa melaporkan adanya perubahan data kehadiran mereka tanpa  persetujuan.  Berdasarkan pernyataan tersebut, dugaan paling logis yang dapat diajukan dari  kasus ini adalahâ€¦ ', NULL, 'Sistem presensi mengalami kesalahan teknis karena bandwidth rendah', NULL, 'Penggunaan jaringan tanpa enkripsi membuka celah manipulasi data  oleh pihak tertentu ', NULL, 'Siswa lupa mengisi presensi secara mandiri setiap hari ', NULL, 'Server sekolah membutuhkan pembaruan perangkat lunak rutin ', NULL, 'Prosedur validasi siswa terlalu rumit untuk digunakan setiap hari ', NULL, 'B'),
(76, 4, 'Dina menggunakan aplikasi perbankan yang tidak menampilkan ikon gembok  atau sertifikat keamanan. Setelah beberapa minggu, ia menemukan transaksi  tidak sah di rekeningnya.  Berdasarkan cerita di atas, apa yang paling mungkin menjadi penyebab  masalah ini?', NULL, 'Dina tidak mengatur PIN ganda di aplikasinya ', NULL, 'Koneksi yang digunakan tidak memverifikasi integritas data ', NULL, 'Penggunaan aplikasi resmi selalu menjamin keamanan data ', NULL, 'Adanya bug dari sistem operasi ponsel yang digunakan ', NULL, 'Dina lupa logout setelah selesai bertransaksi', NULL, 'B'),
(77, 4, 'Berdasarkan analisis gambar tersebut, argumen manakah yang paling kuat  terkait kelemahan paling kritis dari skema dbawah?', 'uploads/6981ca8a12ed8_21.png', 'Komunikasi lambat karena tidak menggunakan bandwidth tinggi ', NULL, 'Informasi pengguna rentan dicuri oleh pihak tidak sah di jalur  komunikasi ', NULL, 'Server akan menolak koneksi HTTP karena terlalu sederhana ', NULL, 'User harus menginstal aplikasi pihak ketiga ', NULL, ' Data dapat dimanipulasi selama perjalanan tanpa sepengetahuan  pengguna ', NULL, 'B'),
(78, 4, 'Arman sedang mengakses situs e-commerce untuk membeli barang elektronik.  Ia mendapati situs tersebut menggunakan protokol HTTPS dan ikon gembok di  bilah alamat.  Berdasarkan cerita tersebut, kesimpulan apa yang dapat ia ambil dari fitur  tersebut? ', NULL, 'Situs menggunakan koneksi terenkripsi yang membantu melindungi  data pribadinya ', NULL, 'Situs menyediakan informasi produk yang akurat dan detail ', NULL, 'Transaksi hanya dapat dilakukan menggunakan kartu kredit ', NULL, 'Situs sudah diverifikasi oleh otoritas pemerintah ', NULL, 'Ia tidak perlu menggunakan kata sandi yang kuat', NULL, 'A'),
(79, 4, 'Pasangan yang tepat dibawah ini adalah...', 'uploads/6981ca8a1438c_23.jpeg', ' 1-d, 2-b, 3-c, 4-a', NULL, '1-a, 2-d, 3-b, 4-c ', NULL, '1-b, 2-a, 3-d, 4-c ', NULL, '1-c, 2-b, 3-d, 4-a ', NULL, '1-a, 2-b, 3-d, 4-c ', NULL, 'B'),
(80, 4, 'Santi menerima email berisi tautan promo dari toko online favoritnya. Saat ia  mengklik tautan tersebut, ia diarahkan ke halaman login yang terlihat sangat  mirip dengan situs asli. Namun, tidak ada ikon gembok, dan alamat situs  dimulai dengan \"http\" bukan \"https\". Tanpa curiga, Santi memasukkan  username dan password.  Berdasarkan kasus tersebut, langkah tindakan yang paling tepat untuk menilai  urgensi penggunaan SSL dalam aktivitas login online adalah memilih opsi  yang menyatakan bahwa SSL membantu mengenkripsi data sehingga informasi  login tidak mudah diakses pihak lain. Selain itu, siswa diminta menuliskan satu  hingga dua kalimat argumen yang memperkuat pilihan jawaban tersebut,  misalnya bahwa tanpa SSL, username dan password sangat rentan dicuri  melalui serangan man-in-the-middle, meskipun tampilan situs terlihat asli.  Pilihan jawaban tersedia berikut ini: ', NULL, 'SSL hanya diperlukan saat transaksi, bukan saat login. ', NULL, 'Protokol HTTP cukup aman jika berasal dari situs yang dikenal.', NULL, 'SSL membantu mengenkripsi data sehingga informasi login tidak  mudah diakses pihak lain. ', NULL, 'SSL tidak penting selama pengguna tahu kepada siapa ia memberikan  informasi.', NULL, ' Website yang tampilannya sama dengan aslinya pasti aman digunakan', NULL, 'C'),
(81, 4, 'Leo berencana masuk ke akun belanjanya melalui sebuah tautan yang ia  temukan. Setelah halaman terbuka, ia menyadari dua hal penting: alamat situs  tersebut tidak menampilkan ikon gembok dan dimulai dengan http, serta  halaman itu langsung meminta ia memasukkan username dan password  sebelum bisa melihat produk apa pun. Berdasarkan kedua informasi tersebut,  tindakan apa yang seharusnya diterapkan Leo?  ', NULL, ' Tetap login karena tampilannya terlihat sama seperti situs resminya. ', NULL, 'Melanjutkan login karena ia belum melakukan transaksi pembayaran  apapun', NULL, 'Membatalkan login karena situs tanpa SSL tidak aman untuk  memasukkan data akun. ', NULL, 'Login secepat mungkin agar datanya tidak sempat dicuri  ', NULL, 'Mengabaikan ikon gembok karena yang terpenting jaringan Wi-Fi  stabil ', NULL, 'C');

COMMIT;
