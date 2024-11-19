<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userprofiles}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%carrinhos}}`
 */
class m241028_100226_create_userprofiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%userprofiles}}', [
            'id' => $this->primaryKey(),
            'nif' => $this->string(9)->notNull()->unique(),
            'morada' => $this->string(30)->notNull(),
            'morada2' => $this->string(30),
            'codigoPostal' => $this->string(30)->notNull(),
            'user_id' => $this->integer()->notNull()->unique(),
            'carrinho_id' => $this->integer()->notNull()->unique(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-userprofiles-user_id}}',
            '{{%userprofiles}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-userprofiles-user_id}}',
            '{{%userprofiles}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `carrinho_id`
        $this->createIndex(
            '{{%idx-userprofiles-carrinho_id}}',
            '{{%userprofiles}}',
            'carrinho_id'
        );

        // add foreign key for table `{{%carrinhos}}`
        $this->addForeignKey(
            '{{%fk-userprofiles-carrinho_id}}',
            '{{%userprofiles}}',
            'carrinho_id',
            '{{%carrinhos}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-userprofiles-user_id}}',
            '{{%userprofiles}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-userprofiles-user_id}}',
            '{{%userprofiles}}'
        );

        // drops foreign key for table `{{%carrinhos}}`
        $this->dropForeignKey(
            '{{%fk-userprofiles-carrinho_id}}',
            '{{%userprofiles}}'
        );

        // drops index for column `carrinho_id`
        $this->dropIndex(
            '{{%idx-userprofiles-carrinho_id}}',
            '{{%userprofiles}}'
        );

        $this->dropTable('{{%userprofiles}}');
    }
}
