<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%valoresnutricionais}}`.
 */
class m241028_155307_create_valoresnutricionais_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%valoresnutricionais}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(1)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%valoresnutricionais}}');
    }
}
