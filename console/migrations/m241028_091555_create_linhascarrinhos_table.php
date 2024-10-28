<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%linhascarrinhos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%carrinhos}}`
 * - `{{%produtos}}`
 */
class m241028_091555_create_linhascarrinhos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%linhascarrinhos}}', [
            'id' => $this->primaryKey(),
            'quantidade' => $this->integer()->notNull(),
            'precoProduto' => $this->float()->notNull(),
            'carrinho_id' => $this->integer()->notNull(),
            'produto_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `carrinho_id`
        $this->createIndex(
            '{{%idx-linhascarrinhos-carrinho_id}}',
            '{{%linhascarrinhos}}',
            'carrinho_id'
        );

        // add foreign key for table `{{%carrinhos}}`
        $this->addForeignKey(
            '{{%fk-linhascarrinhos-carrinho_id}}',
            '{{%linhascarrinhos}}',
            'carrinho_id',
            '{{%carrinhos}}',
            'id',
            'CASCADE'
        );

        // creates index for column `produto_id`
        $this->createIndex(
            '{{%idx-linhascarrinhos-produto_id}}',
            '{{%linhascarrinhos}}',
            'produto_id'
        );

        // add foreign key for table `{{%produtos}}`
        $this->addForeignKey(
            '{{%fk-linhascarrinhos-produto_id}}',
            '{{%linhascarrinhos}}',
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
        // drops foreign key for table `{{%carrinhos}}`
        $this->dropForeignKey(
            '{{%fk-linhascarrinhos-carrinho_id}}',
            '{{%linhascarrinhos}}'
        );

        // drops index for column `carrinho_id`
        $this->dropIndex(
            '{{%idx-linhascarrinhos-carrinho_id}}',
            '{{%linhascarrinhos}}'
        );

        // drops foreign key for table `{{%produtos}}`
        $this->dropForeignKey(
            '{{%fk-linhascarrinhos-produto_id}}',
            '{{%linhascarrinhos}}'
        );

        // drops index for column `produto_id`
        $this->dropIndex(
            '{{%idx-linhascarrinhos-produto_id}}',
            '{{%linhascarrinhos}}'
        );

        $this->dropTable('{{%linhascarrinhos}}');
    }
}
