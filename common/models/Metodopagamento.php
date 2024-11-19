<?php

namespace common\models;

use frontend\models\Carrinho;

use Yii;

/**
 * This is the model class for table "metodospagamento".
 *
 * @property int $id
 * @property string $nome
 * @property int $vigor
 *
 * @property Fatura[] $faturas
 */
class Metodopagamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metodospagamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'vigor'], 'required'],
            [['vigor'], 'integer'],
            [['nome'], 'string', 'max' => 30],
            [['nome'], 'unique'],
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
            'vigor' => 'Vigor',
        ];
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['metodopagamento_id' => 'id']);
    }
}
