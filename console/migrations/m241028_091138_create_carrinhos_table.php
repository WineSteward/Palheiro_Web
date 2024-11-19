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
            'total' => $this->float()->notNull()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carrinhos}}');
    }
}
