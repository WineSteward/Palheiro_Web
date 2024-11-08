<?php

namespace common\models;

use frontend\models\Carrinho;

use Yii;

/**
 * This is the model class for table "metodosexpedicao".
 *
 * @property int $id
 * @property string $nome
 * @property int $vigor
 *
 * @property Carrinho[] $carrinhos
 * @property Fatura[] $faturas
 */
class Metodoexpedicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metodosexpedicao';
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
     * Gets query for [[Carrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhos()
    {
        return $this->hasMany(Carrinho::class, ['metodoexpedicao_id' => 'id']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['metodoexpedicao_id' => 'id']);
    }
}
