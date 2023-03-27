<?php

namespace App\Models;

use CodeIgniter\Model;

class M_FormInput extends Model
{
    protected $table         = 'form_input';
    protected $allowedFields = [
        'nama',
        'deskripsi',
        'konten',
        'img',
        'select',
        'select_search',
        'select_multiple',
        'checkbox',
        'radio',
    ];
    protected $useTimestamps = true;
}
