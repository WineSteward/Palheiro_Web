<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "valoresnutricionais".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Produto[] $produtos
 */
class Valornutricional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valoresnutricionais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'unique'],
            [['nome'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
        ];
    }


    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::class, ['valornutricional_id' => 'id']);
    }
}
