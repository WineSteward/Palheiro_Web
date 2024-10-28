<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faturas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%userprofiles}}`
 */
class m241028_102548_create_faturas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%faturas}}', [
            'id' => $this->primaryKey(),
            'total' => $this->float()->notNull(),
            'dataVenda' => $this->dateTime(),
            'valida' => $this->boolean()->notNull(),
            'estadoEncomenda' => $this->boolean()->notNull(),
            'userprofile_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `userprofile_id`
        $this->createIndex(
            '{{%idx-faturas-userprofile_id}}',
            '{{%faturas}}',
            'userprofile_id'
        );

        // add foreign key for table `{{%userprofiles}}`
        $this->addForeignKey(
            '{{%fk-faturas-userprofile_id}}',
            '{{%faturas}}',
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
            '{{%fk-faturas-userprofile_id}}',
            '{{%faturas}}'
        );

        // drops index for column `userprofile_id`
        $this->dropIndex(
            '{{%idx-faturas-userprofile_id}}',
            '{{%faturas}}'
        );

        $this->dropTable('{{%faturas}}');
    }
}
