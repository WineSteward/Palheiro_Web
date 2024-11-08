<?php

namespace common\models;

use frontend\models\Carrinho;
use backend\models\Listacompras;

use Yii;

/**
 * This is the model class for table "userprofiles".
 *
 * @property int $id
 * @property int $nif
 * @property string $morada
 * @property string|null $morada2
 * @property string $codigoPostal
 * @property int $user_id
 * @property int $carrinho_id
 *
 * @property Carrinho $carrinho
 * @property Fatura[] $faturas
 * @property Listacompras[] $listascompras
 * @property User $user
 * @property Userdesconto[] $userdescontos
 */
class Userprofile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nif', 'morada', 'codigoPostal', 'user_id', 'carrinho_id'], 'required'],
            [['nif', 'user_id', 'carrinho_id'], 'integer'],
            [['morada', 'morada2', 'codigoPostal'], 'string', 'max' => 30],
            [['nif'], 'unique'],
            [['user_id'], 'unique'],
            [['carrinho_id'], 'unique'],
            [['carrinho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carrinho::class, 'targetAttribute' => ['carrinho_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nif' => 'Nif',
            'morada' => 'Morada',
            'morada2' => 'Morada2',
            'codigoPostal' => 'Codigo Postal',
            'user_id' => 'User ID',
            'carrinho_id' => 'Carrinho ID',
        ];
    }

    /**
     * Gets query for [[Carrinho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinho()
    {
        return $this->hasOne(Carrinho::class, ['id' => 'carrinho_id']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['userprofile_id' => 'id']);
    }

    /**
     * Gets query for [[Listascompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListascompras()
    {
        return $this->hasMany(Listacompras::class, ['userprofile_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Userdescontos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserdescontos()
    {
        return $this->hasMany(Userdesconto::class, ['userprofile_id' => 'id']);
    }
}
