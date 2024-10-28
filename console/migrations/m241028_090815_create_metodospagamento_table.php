<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metodospagamento}}`.
 */
class m241028_090815_create_metodospagamento_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%metodospagamento}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(30)->notNull()->unique(),
            'vigor' => $this->boolean()->notNull(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metodospagamento}}');
    }
}
