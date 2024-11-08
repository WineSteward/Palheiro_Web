<?php

namespace frontend\models;

use common\models\Desconto;
use common\models\Metodoexpedicao;
use common\models\Metodopagamento;
use common\models\Userprofile;


use Yii;

/**
 * This is the model class for table "carrinhos".
 *
 * @property int $id
 * @property float $total
 * @property int|null $desconto_id
 * @property int $metodoexpedicao_id
 * @property int $metodopagamento_id
 *
 * @property Desconto $desconto
 * @property Linhacarrinho[] $linhascarrinhos
 * @property Metodoexpedicao $metodoexpedicao
 * @property Metodopagamento $metodopagamento
 * @property Userprofile $userprofile
 */
class Carrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrinhos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total', 'metodoexpedicao_id', 'metodopagamento_id'], 'required'],
            [['total'], 'number'],
            [['desconto_id', 'metodoexpedicao_id', 'metodopagamento_id'], 'integer'],
            [['desconto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desconto::class, 'targetAttribute' => ['desconto_id' => 'id']],
            [['metodoexpedicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodoexpedicao::class, 'targetAttribute' => ['metodoexpedicao_id' => 'id']],
            [['metodopagamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopagamento::class, 'targetAttribute' => ['metodopagamento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total' => 'Total',
            'desconto_id' => 'Desconto ID',
            'metodoexpedicao_id' => 'Metodoexpedicao ID',
            'metodopagamento_id' => 'Metodopagamento ID',
        ];
    }

    /**
     * Gets query for [[Desconto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDesconto()
    {
        return $this->hasOne(Desconto::class, ['id' => 'desconto_id']);
    }

    /**
     * Gets query for [[Linhascarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhascarrinhos()
    {
        return $this->hasMany(Linhacarrinho::class, ['carrinho_id' => 'id']);
    }

    /**
     * Gets query for [[Metodoexpedicao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoexpedicao()
    {
        return $this->hasOne(Metodoexpedicao::class, ['id' => 'metodoexpedicao_id']);
    }

    /**
     * Gets query for [[Metodopagamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodopagamento()
    {
        return $this->hasOne(Metodopagamento::class, ['id' => 'metodopagamento_id']);
    }

    /**
     * Gets query for [[Userprofile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofile()
    {
        return $this->hasOne(Userprofile::class, ['carrinho_id' => 'id']);
    }
}
