<?php

use yii\db\Migration;

/**
 * Class m241227_161927_create_message_contacts
 */
class m241227_169999_create_tarefas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%tarefas}}', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string(30)->notNull(),
            'feito' => $this->boolean()->notNull(),
            'userprofile_id' => $this->integer()->notNull(),
        ], $tableOptions);

                // creates index for column `userprofile_id`
                $this->createIndex(
                    '{{%idx-tarefas-userprofile_id}}',
                    '{{%tarefas}}',
                    'userprofile_id'
                );
        
                // add foreign key for table `{{%userprofiles}}`
                $this->addForeignKey(
                    '{{%fk-tarefas-userprofile_id}}',
                    '{{%tarefas}}',
                    'userprofile_id',
                    '{{%userprofiles}}',
                    'id',
                    'CASCADE'
                );
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%userprofiles}}`
        $this->dropForeignKey(
            '{{%fk-tarefas-userprofile_id}}',
            '{{%tarefas}}'
        );

        // drops index for column `userprofile_id`
        $this->dropIndex(
            '{{%idx-tarefas-userprofile_id}}',
            '{{%tarefas}}'
        );
        
        $this->dropTable('{{%tarefas}}');
    }

}
