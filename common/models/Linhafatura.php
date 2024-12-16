<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linhasfaturas".
 *
 * @property int $id
 * @property float $valorUnitario
 * @property int $quantidade
 * @property float $total
 * @property int $porcentagemIva
 * @property float $valorIva
 * @property float $subtotal
 * @property int $fatura_id
 * @property int $produto_id
 *
 * @property Fatura $fatura
 * @property Produto $produto
 */
class Linhafatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhasfaturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valorUnitario', 'quantidade', 'total', 'porcentagemIva', 'valorIva', 'subtotal', 'fatura_id', 'produto_id'], 'required'],
            [['valorUnitario', 'total', 'valorIva', 'subtotal'], 'number'],
            [['quantidade', 'porcentagemIva', 'fatura_id', 'produto_id'], 'integer'],
            [['fatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fatura::class, 'targetAttribute' => ['fatura_id' => 'id']],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::class, 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valorUnitario' => 'Valor Unitario',
            'quantidade' => 'Quantidade',
            'total' => 'Total',
            'porcentagemIva' => 'Porcentagem Iva',
            'valorIva' => 'Valor Iva',
            'subtotal' => 'Subtotal',
            'fatura_id' => 'Fatura ID',
            'produto_id' => 'Produto ID',
        ];
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Fatura::class, ['id' => 'fatura_id']);
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::class, ['id' => 'produto_id']);
    }

}
