<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carrinhos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%descontos}}`
 * - `{{%metodosexpedicao}}`
 * - `{{%metodospagamento}}`
 */
class m241028_091138_create_carrinhos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%carrinhos}}', [
            'id' => $this->primaryKey(),
            'total' => $this->float()->notNull(),
            'desconto_id' => $this->integer(),
            'metodoexpedicao_id' => $this->integer()->notNull(),
            'metodopagamento_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `desconto_id`
        $this->createIndex(
            '{{%idx-carrinhos-desconto_id}}',
            '{{%carrinhos}}',
            'desconto_id'
        );

        // add foreign key for table `{{%descontos}}`
        $this->addForeignKey(
            '{{%fk-carrinhos-desconto_id}}',
            '{{%carrinhos}}',
            'desconto_id',
            '{{%descontos}}',
            'id',
            'CASCADE'
        );

        // creates index for column `metodoexpedicao_id`
        $this->createIndex(
            '{{%idx-carrinhos-metodoexpedicao_id}}',
            '{{%carrinhos}}',
            'metodoexpedicao_id'
        );

        // add foreign key for table `{{%metodosexpedicao}}`
        $this->addForeignKey(
            '{{%fk-carrinhos-metodoexpedicao_id}}',
            '{{%carrinhos}}',
            'metodoexpedicao_id',
            '{{%metodosexpedicao}}',
            'id',
            'CASCADE'
        );

        // creates index for column `metodopagamento_id`
        $this->createIndex(
            '{{%idx-carrinhos-metodopagamento_id}}',
            '{{%carrinhos}}',
            'metodopagamento_id'
        );

        // add foreign key for table `{{%metodospagamento}}`
        $this->addForeignKey(
            '{{%fk-carrinhos-metodopagamento_id}}',
            '{{%carrinhos}}',
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
        // drops foreign key for table `{{%descontos}}`
        $this->dropForeignKey(
            '{{%fk-carrinhos-desconto_id}}',
            '{{%carrinhos}}'
        );

        // drops index for column `desconto_id`
        $this->dropIndex(
            '{{%idx-carrinhos-desconto_id}}',
            '{{%carrinhos}}'
        );

        // drops foreign key for table `{{%metodosexpedicao}}`
        $this->dropForeignKey(
            '{{%fk-carrinhos-metodoexpedicao_id}}',
            '{{%carrinhos}}'
        );

        // drops index for column `metodoexpedicao_id`
        $this->dropIndex(
            '{{%idx-carrinhos-metodoexpedicao_id}}',
            '{{%carrinhos}}'
        );

        // drops foreign key for table `{{%metodospagamento}}`
        $this->dropForeignKey(
            '{{%fk-carrinhos-metodopagamento_id}}',
            '{{%carrinhos}}'
        );

        // drops index for column `metodopagamento_id`
        $this->dropIndex(
            '{{%idx-carrinhos-metodopagamento_id}}',
            '{{%carrinhos}}'
        );

        $this->dropTable('{{%carrinhos}}');
    }
}
