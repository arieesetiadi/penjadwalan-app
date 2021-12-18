<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instansi = [
            ["Seluruh Perangkat Daerah", "Seluruh PD"],
            ["Walikota", ""],
            ["Wakil Walikota", ""],
            ["Sekretaris Daerah", "SEKDA"],
            ["Bagian Administrasi Pemerintahan (Asisten I)", ""],
            ["Bagian Pemerintahan ", "Bag. Pem."],
            ["Bagian Hukum Setda Kota Denpasar", "Bag. Hukum"],
            ["Bagian Organisasi", "Bag. Organisasi"],
            ["Bagian Hubungan Masyarakat dan Protokol", ""],
            ["Bagian Administrasi Pembangunan (Asisten II)", ""],
            ["Bagian Perekonomian", ""],
            ["Bagian Program Pembangunan", ""],
            ["Bagian Kesejahteraan Rakyat", "Bag. Kesra"],
            ["Bagian Administrasi Umum (Asisten III)", ""],
            ["Bagian Keuangan", ""],
            ["Bagian Umum", ""],
            ["Bagian Pengadaan Barang dan Jasa", "Bag. Pengadaan Barang dan Jasa"],
            ["Bagian Kerjasama Setda Kota Denpasar", ""],
            ["Staf Ahli ", ""],
            ["Dinas Pendidikan, Pemuda dan Olahraga", ""],
            ["Dinas Kesehatan ", ""],
            ["Dinas Pekerjaan Umum dan Penataan Ruang", ""],
            ["Dinas Perumahan, Kawasan Permukiman Dan Pertanahan", ""],
            ["Dinas Lingkungan Hidup dan Kebersihan", "DLHK"],
            ["Dinas Kependudukan dan Pencatatan Sipil ", "Dinas Dukcapil"],
            ["Dinas Perhubungan", "dishub"],
            ["UPT. Transportasi Darat", ""],
            ["Dinas Komunikasi, Informatika dan Statistik", "DKIS"],
            ["Sekretariat Dinas Komunikasi dan Informatika ", ""],
            ["Sub Bagian Umum", ""],
            ["Sub Bagian Kepegawaian", ""],
            ["Sub Bagian Keuangan", ""],
            ["Bidang Statistik dan Persandian", ""],
            ["Seksi Analisa Data Statistik", ""],
            ["Seksi Pengelolaan Statistik Sektoral", ""],
            ["Seksi Keamanan Informasi dan Persediaan", ""],
            ["Bidang Pengelolaan Smart City", ""],
            ["Seksi Pengelolaan Ekosistem Smart City", ""],
            ["Seksi Pengembangan dan Aplikasi", ""],
            ["Seksi Pengelolaan Data dan Introperabilitas", ""],
            ["Bidang E-government", ""],
            ["Seksi tata Kelola E-Goverment", ""],
            ["Seksi Penyebaran Sistem Komunikasi", ""],
            ["Seksi Layanan Infrastruktur dan Teknologi", ""],
            ["Bidang Komunikasi dan Informasi Publik", ""],
            ["Seksi Kemitraan dan Komunikasi Informasi Publik", ""],
            ["Seksi Layanan Komunikasi Informasi Publik", ""],
            ["Seksi Pengelolaan Komunikasi Informasi Publik", ""],
            ["UPT. Pelayanan Teknis Penyiaran Publik Lokal", ""],
            ["Subag Umum UPT. Pelayanan Teknis Penyiaran Publik Lokal", ""],
            ["UPT. Pelayanan Informasi Publik dan PPID", ""],
            ["Subag Umum UPT. Pelayanan Informasi Publik dan PPID", ""],
            ["Operator UPT. Pelayanan Informasi Publik dan PPID", ""],
            ["Dinas Tenaga Kerja dan Sertifikasi Kompetensi", "Dinas Tenaga Kerja"],
            ["Dinas Pertanian", ""],
            ["Dinas Perikanan dan Ketahanan Pangan", ""],
            ["Dinas Kebudayaan ", "Disbud"],
            ["Dinas Pariwisata", ""],
            ["Dinas Perindustrian dan Perdagangan ", ""],
            ["Dinas Koperasi, Usaha Kecil dan Menengah ", ""],
            ["Badan Pendapatan Daerah", ""],
            ["Dinas Ketentraman Ketertiban dan Satuan Polisi Pamong Praja ", ""],
            ["Inspektorat", ""],
            ["Badan Perencanaan Pembangunan Daerah", "Bappeda"],
            ["Badan Kepegawaian dan Pengembangan Sumber Daya Manusia", "BKPSDM"],
            ["Dinas Pemberdayaan Masyarakat dan Desa Kota", ""],
            ["Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat", ""],
            ["Dinas Perpustakaan dan Kearsipan", ""],
            ["Badan Penanggulangan Bencana Daerah (BPBD)", "BPBD"],
            ["Dinas Pemberdayaan Perempuan dan Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana", ""],
            ["Rumah Sakit Umum Daerah Wangaya", "RSUD Wangaya"],
            ["Badan Penelitian Dan Pengembangan", ""],
            ["Seluruh Desa/Kelurahan", ""],
            ["Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu", "Dinas PMPTSP"],
            ["Sekretariat Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu", ""],
            ["Sub Bagian Umum", ""],
            ["Kecamatan Denpasar Timur", ""],
            ["Kecamatan Denpasar Barat", ""],
            ["Kecamatan Denpasar Selatan", ""],
            ["Kecamatan Denpasar Utara", ""],
            ["Kelurahan Dangin Puri", ""],
            ["Kelurahan Kesiman", ""],
            ["Kelurahan Penatih", ""],
            ["Kelurahan Sumerta", ""],
            ["Kelurahan Tonja", "Kel. Tonja"],
            ["Kelurahan Dauh Puri", ""],
            ["Kelurahan Padangsambian", ""],
            ["Kelurahan Peguyangan", ""],
            ["Kelurahan Pemecutan", ""],
            ["Sekretariat DPRD", ""],
            ["Kelurahan Ubung", "Kel. Ubung"],
            ["Kelurahan Panjer", ""],
            ["Kelurahan Pedungan", ""],
            ["Kelurahan Renon", ""],
            ["Kelurahan Sanur", ""],
            ["Kelurahan Serangan", ""],
            ["Kelurahan Sesetan", ""],
            ["PDAM Kota Denpasar", "PDAM"],
            ["PD Parkir Kota Denpasar", "PD Parkir"],
            ["PD Pasar Kota Denpasar", "PD Pasar"],
            ["Dinas Sosial", ""],
            ["Badan Pengelola Keuangan dan Aset Daerah", "BPKAD"]
        ];

        foreach ($instansi as $ins) {
            Instansi::create([
                'name' => $ins[0],
                'short_name' => $ins[1]
            ]);
        }
    }
}
