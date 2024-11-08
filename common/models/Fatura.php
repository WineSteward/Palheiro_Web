<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property float $total
 * @property string $dataVenda
 * @property int $valida
 * @property int $estadoEncomenda
 * @property int|null $desconto_id
 * @property int $userprofile_id
 * @property int $metodoexpedicao_id
 * @property int $metodopagamento_id
 *
 * @property Desconto $desconto
 * @property Linhafatura[] $linhasfaturas
 * @property Metodoexpedicao $metodoexpedicao
 * @property Metodopagamento $metodopagamento
 * @property Userprofile $userprofile
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total', 'dataVenda', 'valida', 'estadoEncomenda', 'userprofile_id', 'metodoexpedicao_id', 'metodopagamento_id'], 'required'],
            [['total'], 'number'],
            [['dataVenda'], 'safe'],
            [['valida', 'estadoEncomenda', 'desconto_id', 'userprofile_id', 'metodoexpedicao_id', 'metodopagamento_id'], 'integer'],
            [['desconto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desconto::class, 'targetAttribute' => ['desconto_id' => 'id']],
            [['metodoexpedicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodoexpedicao::class, 'targetAttribute' => ['metodoexpedicao_id' => 'id']],
            [['metodopagamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metodopagamento::class, 'targetAttribute' => ['metodopagamento_id' => 'id']],
            [['userprofile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['userprofile_id' => 'id']],
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
            'dataVenda' => 'Data Venda',
            'valida' => 'Valida',
            'estadoEncomenda' => 'Estado Encomenda',
            'desconto_id' => 'Desconto ID',
            'userprofile_id' => 'Userprofile ID',
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
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfatura()
    {
        return $this->hasMany(Linhafatura::class, ['fatura_id' => 'id']);
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
        return $this->hasOne(Userprofile::class, ['id' => 'userprofile_id']);
    }
}
