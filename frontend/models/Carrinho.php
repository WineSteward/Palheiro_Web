<?php

namespace frontend\models;

use common\models\Userprofile;


use Yii;

/**
 * This is the model class for table "carrinhos".
 *
 * @property int $id
 * @property float $total
 *
 * @property Linhacarrinho[] $linhascarrinhos
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
            [['total'], 'required'],
            [['total'], 'number'],
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
        ];
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
     * Gets query for [[Userprofile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofile()
    {
        return $this->hasOne(Userprofile::class, ['carrinho_id' => 'id']);
    }

        /**
     * Creates carrinho for default.
     *
     * @return 
     */
    public static function defaultCarrinho()
    {
        $carrinho = new Carrinho();
        $carrinho->total = 0;

        $carrinho->save();
        
        return $carrinho;
    }
}
