<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%linhasfaturas}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%faturas}}`
 */
class m241028_103431_create_linhasfaturas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%linhasfaturas}}', [
            'id' => $this->primaryKey(),
            'total' => $this->float()->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'porcentagemIva' => $this->integer()->notNull(),
            'valorIva' => $this->float()->notNull(),
            'subtotal' => $this->float()->notNull(),
            'fatura_id' => $this->integer()->notNull(),
        ]);

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

        $this->dropTable('{{%linhasfaturas}}');
    }
}
