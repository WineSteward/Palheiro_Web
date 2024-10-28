<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userdecontos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%userprofiles}}`
 * - `{{%descontos}}`
 */
class m241028_101002_create_userdecontos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%userdecontos}}', [
            'id' => $this->primaryKey(),
            'valido' => $this->boolean()->notNull(),
            'userprofile_id' => $this->integer()->notNull(),
            'desconto_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `userprofile_id`
        $this->createIndex(
            '{{%idx-userdecontos-userprofile_id}}',
            '{{%userdecontos}}',
            'userprofile_id'
        );

        // add foreign key for table `{{%userprofiles}}`
        $this->addForeignKey(
            '{{%fk-userdecontos-userprofile_id}}',
            '{{%userdecontos}}',
            'userprofile_id',
            '{{%userprofiles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `desconto_id`
        $this->createIndex(
            '{{%idx-userdecontos-desconto_id}}',
            '{{%userdecontos}}',
            'desconto_id'
        );

        // add foreign key for table `{{%descontos}}`
        $this->addForeignKey(
            '{{%fk-userdecontos-desconto_id}}',
            '{{%userdecontos}}',
            'desconto_id',
            '{{%descontos}}',
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
            '{{%fk-userdecontos-userprofile_id}}',
            '{{%userdecontos}}'
        );

        // drops index for column `userprofile_id`
        $this->dropIndex(
            '{{%idx-userdecontos-userprofile_id}}',
            '{{%userdecontos}}'
        );

        // drops foreign key for table `{{%descontos}}`
        $this->dropForeignKey(
            '{{%fk-userdecontos-desconto_id}}',
            '{{%userdecontos}}'
        );

        // drops index for column `desconto_id`
        $this->dropIndex(
            '{{%idx-userdecontos-desconto_id}}',
            '{{%userdecontos}}'
        );

        $this->dropTable('{{%userdecontos}}');
    }
}
