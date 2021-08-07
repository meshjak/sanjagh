<?php

use yii\db\Migration;

/**
 * Class m210807_072434_add_user_table
 */
class m210807_072434_add_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string(50)->notNull(),
            'username' => $this->string(50)->unique()->notNull(),
            'email' => $this->string(100)->notNull(),
            'isAdmin' => $this->boolean()->defaultValue(0)->notNull(), // 0 admin - 1 user
            'status' => $this->boolean()->defaultValue(1)->notNull(), // 0 inactive - 1 active
            'password' => $this->string(100)->notNull(),
            'authKey' => $this->string(255)->notNull(),
            'accessToken' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime() // user creation time
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
