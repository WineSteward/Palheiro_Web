<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mensagens".
 *
 * @property int $id
 * @property string $titulo
 * @property string $corpo
 * @property string $email
 * @property string $nome
 */
class Mensagem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensagens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'corpo', 'email', 'nome'], 'required'],
            [['corpo'], 'string'],
            [['titulo', 'email', 'nome'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'corpo' => 'Corpo',
            'email' => 'Email',
            'nome' => 'Nome',
        ];
    }
}
