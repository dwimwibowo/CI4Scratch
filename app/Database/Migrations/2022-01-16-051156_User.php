<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'       => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true,
                'null'              => false
            ],
            'first_name'    => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true
            ],
            'last_name'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true
            ],
            'email'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
                'null'              => false
            ],
            'img_ext'           => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true
            ],
            'password'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => false
            ],
            'role_id'       => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'null'              => false
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime null on update current_timestamp',
            'deleted_at datetime null'
        ]);

        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
