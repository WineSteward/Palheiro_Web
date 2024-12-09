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
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%produtos}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(30)->notNull(),
            'preco' => $this->float()->notNull(),
            'descricao' => $this->string(255)->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'categoria_id' => $this->integer()->notNull(),
            'iva_id' => $this->integer()->notNull(),
            'marca_id' => $this->integer()->notNull(),
            'valornutricional_id' => $this->integer()->notNull(),
        ], $tableOptions);

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

        // creates index for column `iva_id`
        $this->createIndex(
            '{{%idx-produtos-iva_id}}',
            '{{%produtos}}',
            'iva_id'
        );

        // add foreign key for table `{{%ivas}}`
        $this->addForeignKey(
            '{{%fk-produtos-iva_id}}',
            '{{%produtos}}',
            'iva_id',
            '{{%ivas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `marca_id`
        $this->createIndex(
            '{{%idx-produtos-marca_id}}',
            '{{%produtos}}',
            'marca_id'
        );

        // add foreign key for table `{{%marcas}}`
        $this->addForeignKey(
            '{{%fk-produtos-marcas_id}}',
            '{{%produtos}}',
            'marca_id',
            '{{%marcas}}',
            'id',
            'CASCADE'
        );

        // creates index for column `valornutricional_id`
        $this->createIndex(
            '{{%idx-produtos-valornutricional_id}}',
            '{{%produtos}}',
            'valornutricional_id'
        );

        // add foreign key for table `{{%valoresnutricionais}}`
        $this->addForeignKey(
            '{{%fk-produtos-valornutricional_id}}',
            '{{%produtos}}',
            'valornutricional_id',
            '{{%valoresnutricionais}}',
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
            '{{%fk-produtos-iva_id}}',
            '{{%produtos}}'
        );

        // drops index for column `iva_id`
        $this->dropIndex(
            '{{%idx-produtos-iva_id}}',
            '{{%produtos}}'
        );

        // drops foreign key for table `{{%marcas}}`
        $this->dropForeignKey(
            '{{%fk-produtos-marca_id}}',
            '{{%produtos}}'
        );

        // drops index for column `marcas_id`
        $this->dropIndex(
            '{{%idx-produtos-marca_id}}',
            '{{%produtos}}'
        );

        // drops foreign key for table `{{%valoresnutricionais}}`
        $this->dropForeignKey(
            '{{%fk-produtos-valornutricional_id}}',
            '{{%produtos}}'
        );

        // drops index for column `valornutricional_id`
        $this->dropIndex(
            '{{%idx-produtos-valornutricional_id}}',
            '{{%produtos}}'
        );

        $this->dropTable('{{%produtos}}');
    }
}
