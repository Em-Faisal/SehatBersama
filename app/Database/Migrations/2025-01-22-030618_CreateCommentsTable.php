<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'article_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'comment' => [
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
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'profiles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
