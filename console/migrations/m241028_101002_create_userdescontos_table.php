<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userdescontos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%userprofiles}}`
 * - `{{%descontos}}`
 */
class m241028_101002_create_userdescontos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%userdescontos}}', [
            'id' => $this->primaryKey(),
            'valido' => $this->boolean()->notNull(),
            'userprofile_id' => $this->integer()->notNull(),
            'desconto_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `userprofile_id`
        $this->createIndex(
            '{{%idx-userdescontos-userprofile_id}}',
            '{{%userdescontos}}',
            'userprofile_id'
        );

        // add foreign key for table `{{%userprofiles}}`
        $this->addForeignKey(
            '{{%fk-userdescontos-userprofile_id}}',
            '{{%userdescontos}}',
            'userprofile_id',
            '{{%userprofiles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `desconto_id`
        $this->createIndex(
            '{{%idx-userdescontos-desconto_id}}',
            '{{%userdescontos}}',
            'desconto_id'
        );

        // add foreign key for table `{{%descontos}}`
        $this->addForeignKey(
            '{{%fk-userdescontos-desconto_id}}',
            '{{%userdescontos}}',
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
            '{{%fk-userdescontos-userprofile_id}}',
            '{{%userdescontos}}'
        );

        // drops index for column `userprofile_id`
        $this->dropIndex(
            '{{%idx-userdescontos-userprofile_id}}',
            '{{%userdescontos}}'
        );

        // drops foreign key for table `{{%descontos}}`
        $this->dropForeignKey(
            '{{%fk-userdescontos-desconto_id}}',
            '{{%userdescontos}}'
        );

        // drops index for column `desconto_id`
        $this->dropIndex(
            '{{%idx-userdescontos-desconto_id}}',
            '{{%userdescontos}}'
        );

        $this->dropTable('{{%userdescontos}}');
    }
}
