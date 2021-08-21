<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag}}`.
 */
class m210820_204356_create_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(40),
            'created_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-tag-user_id',
            'tag',
            'user_id'
        );

        $this->addForeignKey(
            'fk-tag-user_id',
            'tag',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-tag-user_id',
            'tag'
        );

        $this->dropIndex(
            'idx-tag-user_id',
            'tag',
        );

        $this->dropTable('{{%tag}}');
    }
}
