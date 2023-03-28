<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users extends Model
{
    protected $table         = 'users';
    protected $allowedFields = [
        'id_role',
        'nama',
        'email',
        'password',
        'img',
        'jenis_kelamin',
        'usia',
        'riwayat_diabetes',
        'riwayat_alkohol',
        'riwayat_merokok',
    ];
    protected $useTimestamps = true;

    public function password_hash($password = null)
    {
        return hash('SHA512', 'S3cuR1ty'. $password. 'Sys73m');
    }

}
