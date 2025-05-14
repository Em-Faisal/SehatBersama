<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table            = 'profiles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'no_profile',
        'username',
        'nama_lengkap',
        'bio',
        'jns_kelamin',
        'kode_pos',
        'kota',
        'provinsi',
        'alamat',
        'tmp_lahir',
        'tgl_lahir',
        'telp',
        'lvl_profile',
        'email',
        'photo',
        'password'
    ];

}
