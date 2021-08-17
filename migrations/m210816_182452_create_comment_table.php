<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210816_182452_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),
            'body' => $this->string(255),
            'status' => $this->boolean()->defaultValue(0),
            'created_at' => $this->dateTime(),
        ]);

        // creates index for column 'user_id'
        $this->createIndex(
            'idx-comment-user_id',
            'comment',
            'user_id'
        );

        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-comment-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column 'article_id'
        $this->createIndex(
            'idx-comment-article_id',
            'comment',
            'article_id'
        );

        // add foreign key for table 'article'
        $this->addForeignKey(
            'fk-comment-article_id',
            'comment',
            'article_id',
            'article',
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
            'fk-comment-article_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-article_id',
            'comment'
        );

        $this->dropForeignKey(
            'fk-comment-user_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-user_id',
            'comment'
        );



        $this->dropTable('{{%comment}}');
    }
}
