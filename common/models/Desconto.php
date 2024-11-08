<?php

namespace common\models;

use Yii;
use frontend\models\Carrinho;

/**
 * This is the model class for table "descontos".
 *
 * @property int $id
 * @property string $nome
 * @property float $valor
 *
 * @property Carrinho[] $carrinhos
 * @property Fatura[] $faturas
 * @property Userdesconto[] $userdescontos
 */
class Desconto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'descontos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'valor'], 'required'],
            [['valor'], 'number'],
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
            'valor' => 'Valor',
        ];
    }

    /**
     * Gets query for [[Carrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhos()
    {
        return $this->hasMany(Carrinho::class, ['desconto_id' => 'id']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['desconto_id' => 'id']);
    }

    /**
     * Gets query for [[Userdescontos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserdescontos()
    {
        return $this->hasMany(Userdesconto::class, ['desconto_id' => 'id']);
    }
}
