<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ivas}}`.
 */
class m241028_085529_create_ivas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%ivas}}', [
            'id' => $this->primaryKey(),
            'valorPorcentagem' => $this->integer()->notNull()->unique(),
            'vigor' => $this->boolean()->notNull(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ivas}}');
    }
}
