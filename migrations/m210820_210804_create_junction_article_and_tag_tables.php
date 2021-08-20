<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tag}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%article}}`
 * - `{{%tag}}`
 */
class m210820_210804_create_junction_article_and_tag_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tag}}', [
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'PRIMARY KEY(article_id, tag_id)',
        ]);

        // creates index for column `article_id`
        $this->createIndex(
            '{{%idx-article_tag-article_id}}',
            '{{%article_tag}}',
            'article_id'
        );

        // add foreign key for table `{{%article}}`
        $this->addForeignKey(
            '{{%fk-article_tag-article_id}}',
            '{{%article_tag}}',
            'article_id',
            '{{%article}}',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            '{{%idx-article_tag-tag_id}}',
            '{{%article_tag}}',
            'tag_id'
        );

        // add foreign key for table `{{%tag}}`
        $this->addForeignKey(
            '{{%fk-article_tag-tag_id}}',
            '{{%article_tag}}',
            'tag_id',
            '{{%tag}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%article}}`
        $this->dropForeignKey(
            '{{%fk-article_tag-article_id}}',
            '{{%article_tag}}'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            '{{%idx-article_tag-article_id}}',
            '{{%article_tag}}'
        );

        // drops foreign key for table `{{%tag}}`
        $this->dropForeignKey(
            '{{%fk-article_tag-tag_id}}',
            '{{%article_tag}}'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            '{{%idx-article_tag-tag_id}}',
            '{{%article_tag}}'
        );

        $this->dropTable('{{%article_tag}}');
    }
}
