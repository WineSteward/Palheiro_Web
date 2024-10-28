<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listascompras}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%userprofiles}}`
 */
class m241028_100716_create_listascompras_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%listascompras}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(30)->notNull(),
            'descricao' => $this->string(255),
            'userprofile_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `userprofile_id`
        $this->createIndex(
            '{{%idx-listascompras-userprofile_id}}',
            '{{%listascompras}}',
            'userprofile_id'
        );

        // add foreign key for table `{{%userprofiles}}`
        $this->addForeignKey(
            '{{%fk-listascompras-userprofile_id}}',
            '{{%listascompras}}',
            'userprofile_id',
            '{{%userprofiles}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%userprofiles}}`
        $this->dropForeignKey(
            '{{%fk-listascompras-userprofile_id}}',
            '{{%listascompras}}'
        );

        // drops index for column `userprofile_id`
        $this->dropIndex(
            '{{%idx-listascompras-userprofile_id}}',
            '{{%listascompras}}'
        );

        $this->dropTable('{{%listascompras}}');
    }
}
