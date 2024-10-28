<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faturas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%userprofiles}}`
 * - `{{%metodosexpedicao}}`
 * - `{{%metodospagamento}}`
 */
class m241028_144754_create_faturas_table extends Migration
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
            'dataVenda' => $this->dateTime()->notNull(),
            'valida' => $this->boolean()->notNull(),
            'estadoEncomenda' => $this->boolean()->notNull(),
            'userprofile_id' => $this->integer()->notNull(),
            'metodoexpedicao_id' => $this->integer()->notNull(),
            'metodopagamento_id' => $this->integer()->notNull(),
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

        // creates index for column `metodoexpedicao_id`
        $this->createIndex(
            '{{%idx-faturas-metodoexpedicao_id}}',
            '{{%faturas}}',
            'metodoexpedicao_id'
        );

        // add foreign key for table `{{%metodosexpedicao}}`
        $this->addForeignKey(
            '{{%fk-faturas-metodoexpedicao_id}}',
            '{{%faturas}}',
            'metodoexpedicao_id',
            '{{%metodosexpedicao}}',
            'id',
            'CASCADE'
        );

        // creates index for column `metodopagamento_id`
        $this->createIndex(
            '{{%idx-faturas-metodopagamento_id}}',
            '{{%faturas}}',
            'metodopagamento_id'
        );

        // add foreign key for table `{{%metodospagamento}}`
        $this->addForeignKey(
            '{{%fk-faturas-metodopagamento_id}}',
            '{{%faturas}}',
            'metodopagamento_id',
            '{{%metodospagamento}}',
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

        // drops foreign key for table `{{%metodosexpedicao}}`
        $this->dropForeignKey(
            '{{%fk-faturas-metodoexpedicao_id}}',
            '{{%faturas}}'
        );

        // drops index for column `metodoexpedicao_id`
        $this->dropIndex(
            '{{%idx-faturas-metodoexpedicao_id}}',
            '{{%faturas}}'
        );

        // drops foreign key for table `{{%metodospagamento}}`
        $this->dropForeignKey(
            '{{%fk-faturas-metodopagamento_id}}',
            '{{%faturas}}'
        );

        // drops index for column `metodopagamento_id`
        $this->dropIndex(
            '{{%idx-faturas-metodopagamento_id}}',
            '{{%faturas}}'
        );

        $this->dropTable('{{%faturas}}');
    }
}
