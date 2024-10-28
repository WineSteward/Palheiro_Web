<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%descontos}}`.
 */
class m241028_090853_create_descontos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%descontos}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(30)->notNull()->unique(),
            'valor' => $this->float()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%descontos}}');
    }
}
