<?php

use yii\db\Migration;

/**
 * Class m241227_161927_create_message_contacts
 */
class m241227_161927_create_message_contacts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%mensagens}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(30)->notNull(),
            'corpo' => $this->text(255)->notNull(),
            'email' => $this->string(30)->notNull(),
            'nome' => $this->string(30)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mensagens}}');
    }

}
