<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'no_profile'=>[
                'type'=>'VARCHAR',
                'constraint'=>50,
            ],
            'nama_lengkap'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'username'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'bio'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
                ],
            'jns_kelamin'=>[
                'type'=>'ENUM',
                'constraint'=>['Laki-laki','Perempuan'],
            ],
            'kode_pos'=>[
                'type'=>'VARCHAR',
                'constraint'=>10,
            ],
            'kota'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'provinsi'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'alamat'=>[
                'type'=>'TEXT',
            ],
            'email'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'telp'=>[
                'type'=>'VARCHAR',
                'constraint'=>15,
            ],
            'tmp_lahir'=>[
                'type'=>'VARCHAR',
                'constraint'=>100,
            ],
            'tgl_lahir'=>[
                'type'=>'DATE',
            ],
            'lvl_profile'=>[
                'type'=>'ENUM',
                'constraint'=>['user','admin'],//jika user maka 'user'//
                'default'=>'user',
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'password'=>[
                'type'=>'VARCHAR',
                'constraint'=>255,
            ],
            'created_at'=>[
                'type'=>'DATETIME',
                'null'=>TRUE,
            ],
            'updated_at'=>[
                'type'=>'DATETIME',
                'null'=>TRUE,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('profiles',true);
    }

    public function down()
    {
        $this->forge->dropTable('profiles',true);
    }
}
