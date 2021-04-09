<?php
 
use yii\db\Migration;
 
class m200212_125648__create_user_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
 
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'email_confirm_token' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'delete_date' => $this->dateTime(),
            'delete_user' => $this->integer(),
        ], $tableOptions);

        $this->batchInsert('{{%user}}',
            [
                'username',
                'auth_key',
                'password_hash',
                'password_reset_token',
                'email',
                'email_confirm_token',
                'status',
                'created_at',
                'updated_at'
            ],
            [
                [
                    'demo',
                    '7kStDR_wIl5w1orMD-spMck_Nnoy4FzM',
                    '$2y$13$ZCM/ARDfu2Zw4ndh5MyChuUwWRQ0jyD..Z.iu3WIe1rSJqDcvoPQ6',
                    null,
                    'demo@demo.demo',
                    '',
                    1,
                    'created_at' => time(),
                    'updated_at' => time()
                ],
            ]
        );
    }
 
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
 
}