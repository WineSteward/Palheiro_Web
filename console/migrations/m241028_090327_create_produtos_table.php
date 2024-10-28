<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produtos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categorias}}`
 * - `{{%ivas}}`
 * - `{{%marcas}}`
 */
class m241028_090327_create_produtos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%produtos}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(30)->notNull(),
            'preco' => $this->float()->notNull(),
            'descricao' => $this->string(255)->notNull(),
            'categoria_id' => $this->integer()->notNull(),
            'ivas_id' => $this->integer()->notNull(),
            'marcas_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `categoria_id`
        $this->createIndex(
            '{{%idx-produtos-categoria_id}}',
            '{{%produtos}}',
            'categoria_id'
        );

        // add foreign key for table `{{%categorias}}`
        $this->addForeignKey(
            '{{%fk-produtos-categoria_id}}',
            '{{%produtos}}',
            'categoria_id',
            '{{%categorias}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ivas_id`
        $this->createIndex(
            '{{%idx-produtos-ivas_id}}',
            '{{%produtos}}',
            'ivas_id'
        );

        // add foreign key for table `{{%ivas}}`
        $this->addForeignKey(
            '{{%fk-produtos-ivas_id}}',
            '{{%produtos}}',
            'ivas_id',
            '{{%ivas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `marcas_id`
        $this->createIndex(
            '{{%idx-produtos-marcas_id}}',
            '{{%produtos}}',
            'marcas_id'
        );

        // add foreign key for table `{{%marcas}}`
        $this->addForeignKey(
            '{{%fk-produtos-marcas_id}}',
            '{{%produtos}}',
            'marcas_id',
            '{{%marcas}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%categorias}}`
        $this->dropForeignKey(
            '{{%fk-produtos-categoria_id}}',
            '{{%produtos}}'
        );

        // drops index for column `categoria_id`
        $this->dropIndex(
            '{{%idx-produtos-categoria_id}}',
            '{{%produtos}}'
        );

        // drops foreign key for table `{{%ivas}}`
        $this->dropForeignKey(
            '{{%fk-produtos-ivas_id}}',
            '{{%produtos}}'
        );

        // drops index for column `ivas_id`
        $this->dropIndex(
            '{{%idx-produtos-ivas_id}}',
            '{{%produtos}}'
        );

        // drops foreign key for table `{{%marcas}}`
        $this->dropForeignKey(
            '{{%fk-produtos-marcas_id}}',
            '{{%produtos}}'
        );

        // drops index for column `marcas_id`
        $this->dropIndex(
            '{{%idx-produtos-marcas_id}}',
            '{{%produtos}}'
        );

        $this->dropTable('{{%produtos}}');
    }
}
