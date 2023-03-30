<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Screening extends Model
{
    protected $table         = 'screening';
    protected $allowedFields = [
        'id_user',
        'jenis_kelamin',
        'skor_jenis_kelamin',
        'usia',
        'skor_usia',
        'tinggi_badan',
        'berat_badan',
        'bmi',
        'skor_bmi',
        'tekanan_darah',
        'skor_tekanan_darah',
        'denyut_jantung',
        'riwayat_merokok',
        'riwayat_merokok',
        'skor_riwayat_merokok',
        'riwayat_alkohol',
        'riwayat_diabetes',
        'skor_riwayat_diabetes',
        'aktivitas_fisik',
        'skor_aktivitas_fisik',
        'total_skor',
        'risiko',
        'deskripsi',
    ];
    protected $useTimestamps = true;
}
