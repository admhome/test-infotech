<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_subscribe}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%author}}`
 */
class m240812_195741_create_author_subscribe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_subscribe}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'phone' => $this->string(12)->notNull(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-author_subscribe-author_id}}',
            '{{%author_subscribe}}',
            'author_id'
        );

        // add foreign key for table `{{%author}}`
        $this->addForeignKey(
            '{{%fk-author_subscribe-author_id}}',
            '{{%author_subscribe}}',
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
        // drops foreign key for table `{{%author}}`
        $this->dropForeignKey(
            '{{%fk-author_subscribe-author_id}}',
            '{{%author_subscribe}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-author_subscribe-author_id}}',
            '{{%author_subscribe}}'
        );

        $this->dropTable('{{%author_subscribe}}');
    }
}
