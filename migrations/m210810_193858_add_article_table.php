<?php

use yii\db\Migration;

/**
 * Class m210810_193858_add_article_table
 */
class m210810_193858_add_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'title' => $this->string('70')->notNull(),
            'body' => $this->text()->notNull(),
            'status' => $this->boolean()->defaultValue(1),
            'created_at' => $this->dateTime(),
        ]);

        // creates index for column 'author_id'
        $this->createIndex(
            'idx-article-author_id',
            'article',
            'author_id'
        );

        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-article-author_id',
            'article',
            'author_id',
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
            'fk-article-author_id',
            'article'
        );

        $this->dropIndex(
            'idx-article-author_id',
            'article',
        );

        $this->dropTable('article');
    }
}
