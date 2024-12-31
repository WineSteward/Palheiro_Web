<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%linhasfaturas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%faturas}}`
 */
class m241028_144804_create_linhasfaturas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%linhasfaturas}}', [
            'id' => $this->primaryKey(),
            'valorUnitario' => $this->float()->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'total' => $this->float()->notNull(),
            'porcentagemIva' => $this->integer()->notNull(),
            'valorIva' => $this->float()->notNull(),
            'subtotal' => $this->float()->notNull(),
            'fatura_id' => $this->integer()->notNull(),
            'produto_id' => $this->integer(),
        ], $tableOptions);

        // creates index for column `fatura_id`
        $this->createIndex(
            '{{%idx-linhasfaturas-fatura_id}}',
            '{{%linhasfaturas}}',
            'fatura_id'
        );

        // add foreign key for table `{{%faturas}}`
        $this->addForeignKey(
            '{{%fk-linhasfaturas-fatura_id}}',
            '{{%linhasfaturas}}',
            'fatura_id',
            '{{%faturas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `produto_id`
        $this->createIndex(
            '{{%idx-linhasfaturas-produto_id}}',
            '{{%linhasfaturas}}',
            'produto_id'
        );

        // add foreign key for table `{{%produtos}}`
        $this->addForeignKey(
            '{{%fk-linhasfaturas-produto_id}}',
            '{{%linhasfaturas}}',
            'produto_id',
            '{{%produtos}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%faturas}}`
        $this->dropForeignKey(
            '{{%fk-linhasfaturas-fatura_id}}',
            '{{%linhasfaturas}}'
        );

        // drops index for column `fatura_id`
        $this->dropIndex(
            '{{%idx-linhasfaturas-fatura_id}}',
            '{{%linhasfaturas}}'
        );

        // drops foreign key for table `{{%produtos}}`
        $this->dropForeignKey(
            '{{%fk-linhasfaturas-produto_id}}',
            '{{%linhasfaturas}}'
        );

        // drops index for column `produto_id`
        $this->dropIndex(
            '{{%idx-linhasfaturas-produto_id}}',
            '{{%linhasfaturas}}'
        );

        $this->dropTable('{{%linhasfaturas}}');
    }
}
