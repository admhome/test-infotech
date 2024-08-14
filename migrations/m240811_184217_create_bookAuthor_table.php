<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bookAuthor}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%book}}`
 * - `{{%author}}`
 */
class m240811_184217_create_bookAuthor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bookAuthor}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `book_id`
        $this->createIndex(
            '{{%idx-bookAuthor-book_id}}',
            '{{%bookAuthor}}',
            'book_id'
        );

        // add foreign key for table `{{%book}}`
        $this->addForeignKey(
            '{{%fk-bookAuthor-book_id}}',
            '{{%bookAuthor}}',
            'book_id',
            '{{%book}}',
            'id',
            'CASCADE'
        );

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-bookAuthor-author_id}}',
            '{{%bookAuthor}}',
            'author_id'
        );

        // add foreign key for table `{{%author}}`
        $this->addForeignKey(
            '{{%fk-bookAuthor-author_id}}',
            '{{%bookAuthor}}',
            'author_id',
            '{{%author}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%book}}`
        $this->dropForeignKey(
            '{{%fk-bookAuthor-book_id}}',
            '{{%bookAuthor}}'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            '{{%idx-bookAuthor-book_id}}',
            '{{%bookAuthor}}'
        );

        // drops foreign key for table `{{%author}}`
        $this->dropForeignKey(
            '{{%fk-bookAuthor-author_id}}',
            '{{%bookAuthor}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-bookAuthor-author_id}}',
            '{{%bookAuthor}}'
        );

        $this->dropTable('{{%bookAuthor}}');
    }
}
