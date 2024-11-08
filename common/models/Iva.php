<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ivas".
 *
 * @property int $id
 * @property int $valorPorcentagem
 * @property int $vigor
 *
 * @property Produto[] $produtos
 */
class Iva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valorPorcentagem', 'vigor'], 'required'],
            [['valorPorcentagem', 'vigor'], 'integer'],
            [['valorPorcentagem'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valorPorcentagem' => 'Valor Porcentagem',
            'vigor' => 'Vigor',
        ];
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::class, ['iva_id' => 'id']);
    }
}
