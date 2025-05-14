<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Articles extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true,
        ],
        
        'judul' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        
        'isi' => [
            'type' => 'TEXT',
        ],
        'categories_id' => [
            'type' => 'INT',
            'unsigned' => true,
        ],
        'slug' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        'image' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => true
        ],
        'content' => [
            'type' => 'TEXT',
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);
    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('categories_id', 'categories', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('articles',true);
    }

    public function down()
    {
        $this->forge->dropTable('articles',true);
    }
}
