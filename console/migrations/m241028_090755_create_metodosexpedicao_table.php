<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metodosexpedicao}}`.
 */
class m241028_090755_create_metodosexpedicao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metodosexpedicao}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(30)->notNull()->unique(),
            'vigor' => $this->boolean()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metodosexpedicao}}');
    }
}
