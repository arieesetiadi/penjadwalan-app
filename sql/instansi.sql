-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2021 at 09:13 AM
-- Server version: 5.7.27
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indeksdp_db_indeks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_opd`
--

CREATE TABLE `tb_opd` (
  `idopd` varchar(20) NOT NULL,
  `namaopd` varchar(100) NOT NULL,
  `nama_pendek_opd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_opd`
--

INSERT INTO `tb_opd` (`idopd`, `namaopd`, `nama_pendek_opd`) VALUES
('000000', 'Seluruh Perangkat Daerah', 'Seluruh PD'),
('000001', 'Walikota', ''),
('000002', 'Wakil Walikota', ''),
('010001', 'Sekretaris Daerah', 'SEKDA'),
('011001', 'Bagian Administrasi Pemerintahan (Asisten I)', ''),
('011101', 'Bagian Pemerintahan ', 'Bag. Pem.'),
('011201', 'Bagian Hukum Setda Kota Denpasar', 'Bag. Hukum'),
('011301', 'Bagian Organisasi', 'Bag. Organisasi'),
('011401', 'Bagian Hubungan Masyarakat dan Protokol', ''),
('012001', 'Bagian Administrasi Pembangunan (Asisten II)', ''),
('012101', 'Bagian Perekonomian', ''),
('012201', 'Bagian Program Pembangunan', ''),
('012301', 'Bagian Kesejahteraan Rakyat', 'Bag. Kesra'),
('013001', 'Bagian Administrasi Umum (Asisten III)', ''),
('013101', 'Bagian Keuangan', ''),
('013201', 'Bagian Umum', ''),
('013301', 'Bagian Pengadaan Barang dan Jasa', 'Bag. Pengadaan Barang dan Jasa'),
('013401', 'Bagian Kerjasama Setda Kota Denpasar', ''),
('014000', 'Staf Ahli ', ''),
('030101', 'Dinas Pendidikan, Pemuda dan Olahraga', ''),
('030201', 'Dinas Kesehatan ', ''),
('030301', 'Dinas Pekerjaan Umum dan Penataan Ruang', ''),
('030401', 'Dinas Perumahan, Kawasan Permukiman Dan Pertanahan', ''),
('030501', 'Dinas Lingkungan Hidup dan Kebersihan', 'DLHK'),
('030601', 'Dinas Kependudukan dan Pencatatan Sipil ', 'Dinas Dukcapil'),
('030701', 'Dinas Perhubungan', 'dishub'),
('03070101', 'UPT. Transportasi Darat', ''),
('030801', 'Dinas Komunikasi, Informatika dan Statistik', 'DKIS'),
('03080101', 'Sekretariat Dinas Komunikasi dan Informatika ', ''),
('0308010101', 'Sub Bagian Umum', ''),
('0308010102', 'Sub Bagian Kepegawaian', ''),
('0308010103', 'Sub Bagian Keuangan', ''),
('03080102', 'Bidang Statistik dan Persandian', ''),
('0308010201', 'Seksi Analisa Data Statistik', ''),
('0308010202', 'Seksi Pengelolaan Statistik Sektoral', ''),
('0308010203', 'Seksi Keamanan Informasi dan Persediaan', ''),
('03080103', 'Bidang Pengelolaan Smart City', ''),
('0308010301', 'Seksi Pengelolaan Ekosistem Smart City', ''),
('0308010302', 'Seksi Pengembangan dan Aplikasi', ''),
('0308010303', 'Seksi Pengelolaan Data dan Introperabilitas', ''),
('03080104', 'Bidang E-government', ''),
('0308010401', 'Seksi tata Kelola E-Goverment', ''),
('0308010402', 'Seksi Penyebaran Sistem Komunikasi', ''),
('0308010403', 'Seksi Layanan Infrastruktur dan Teknologi', ''),
('03080105', 'Bidang Komunikasi dan Informasi Publik', ''),
('0308010501', 'Seksi Kemitraan dan Komunikasi Informasi Publik', ''),
('0308010502', 'Seksi Layanan Komunikasi Informasi Publik', ''),
('0308010503', 'Seksi Pengelolaan Komunikasi Informasi Publik', ''),
('03080106', 'UPT. Pelayanan Teknis Penyiaran Publik Lokal', ''),
('0308010601', 'Subag Umum UPT. Pelayanan Teknis Penyiaran Publik Lokal', ''),
('03080107', 'UPT. Pelayanan Informasi Publik dan PPID', ''),
('0308010701', 'Subag Umum UPT. Pelayanan Informasi Publik dan PPID', ''),
('0308010702', 'Operator UPT. Pelayanan Informasi Publik dan PPID', ''),
('030901', 'Dinas Tenaga Kerja dan Sertifikasi Kompetensi', 'Dinas Tenaga Kerja'),
('031001', 'Dinas Pertanian', ''),
('031101', 'Dinas Perikanan dan Ketahanan Pangan', ''),
('031201', 'Dinas Kebudayaan ', 'Disbud'),
('031301', 'Dinas Pariwisata', ''),
('031401', 'Dinas Perindustrian dan Perdagangan ', ''),
('031501', 'Dinas Koperasi, Usaha Kecil dan Menengah ', ''),
('031601', 'Badan Pendapatan Daerah', ''),
('031701', 'Dinas Ketentraman Ketertiban dan Satuan Polisi Pamong Praja ', ''),
('040101', 'Inspektorat', ''),
('040201', 'Badan Perencanaan Pembangunan Daerah', 'Bappeda'),
('040301', 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'BKPSDM'),
('040501', 'Dinas Pemberdayaan Masyarakat dan Desa Kota', ''),
('040601', 'Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat', ''),
('040701', 'Dinas Perpustakaan dan Kearsipan', ''),
('040801', 'Badan Penanggulangan Bencana Daerah (BPBD)', 'BPBD'),
('040901', 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana', ''),
('041001', 'Rumah Sakit Umum Daerah Wangaya', 'RSUD Wangaya'),
('041101', 'Badan Penelitian Dan Pengembangan', ''),
('100000', 'Seluruh Desa/Kelurahan', ''),
('140018', 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'Dinas PMPTSP'),
('14001801', 'Sekretariat Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', ''),
('1400180101', 'Sub Bagian Umum', ''),
('170001', 'Kecamatan Denpasar Timur', ''),
('170002', 'Kecamatan Denpasar Barat', ''),
('170003', 'Kecamatan Denpasar Selatan', ''),
('170004', 'Kecamatan Denpasar Utara', ''),
('200001', 'Kelurahan Dangin Puri', ''),
('200002', 'Kelurahan Kesiman', ''),
('200003', 'Kelurahan Penatih', ''),
('200004', 'Kelurahan Sumerta', ''),
('200005', 'Kelurahan Tonja', 'Kel. Tonja'),
('200006', 'Kelurahan Dauh Puri', ''),
('200007', 'Kelurahan Padangsambian', ''),
('200008', 'Kelurahan Peguyangan', ''),
('200009', 'Kelurahan Pemecutan', ''),
('20001', 'Sekretariat DPRD', ''),
('200010', 'Kelurahan Ubung', 'Kel. Ubung'),
('200011', 'Kelurahan Panjer', ''),
('200012', 'Kelurahan Pedungan', ''),
('200013', 'Kelurahan Renon', ''),
('200014', 'Kelurahan Sanur', ''),
('200015', 'Kelurahan Serangan', ''),
('200016', 'Kelurahan Sesetan', ''),
('300001', 'PDAM Kota Denpasar', 'PDAM'),
('300002', 'PD Parkir Kota Denpasar', 'PD Parkir'),
('300003', 'PD Pasar Kota Denpasar', 'PD Pasar'),
('300004', 'Dinas Sosial', ''),
('300005', 'Badan Pengelola Keuangan dan Aset Daerah', 'BPKAD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_opd`
--
ALTER TABLE `tb_opd`
  ADD PRIMARY KEY (`idopd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
