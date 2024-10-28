<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%imagens}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%produtos}}`
 */
class m241028_091718_create_imagens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%imagens}}', [
            'id' => $this->primaryKey(),
            'ficheiro' => $this->string(255)->notNull(),
            'produto_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `produto_id`
        $this->createIndex(
            '{{%idx-imagens-produto_id}}',
            '{{%imagens}}',
            'produto_id'
        );

        // add foreign key for table `{{%produtos}}`
        $this->addForeignKey(
            '{{%fk-imagens-produto_id}}',
            '{{%imagens}}',
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
        // drops foreign key for table `{{%produtos}}`
        $this->dropForeignKey(
            '{{%fk-imagens-produto_id}}',
            '{{%imagens}}'
        );

        // drops index for column `produto_id`
        $this->dropIndex(
            '{{%idx-imagens-produto_id}}',
            '{{%imagens}}'
        );

        $this->dropTable('{{%imagens}}');
    }
}
