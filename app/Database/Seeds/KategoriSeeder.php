<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Penyakit', 'slug' => 'penyakit'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['name' => 'Nutrisi', 'slug' => 'nutrisi'],
            ['name' => 'Kebugaran', 'slug' => 'kebugaran'],
            ['name' => 'Parenting', 'slug' => 'parenting'],
            ['name' => 'Obat Herbal dan Alternatif', 'slug' => 'obat-herbal-alternatif'],
        ];
        $this->db->table('categories')->insertBatch($data);
    }
}
