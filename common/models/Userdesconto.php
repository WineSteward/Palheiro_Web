<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userdescontos".
 *
 * @property int $id
 * @property int $valido
 * @property int $userprofile_id
 * @property int $desconto_id
 *
 * @property Desconto $desconto
 * @property Userprofile $userprofile
 */
class Userdesconto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userdescontos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valido', 'userprofile_id', 'desconto_id'], 'required'],
            [['valido', 'userprofile_id', 'desconto_id'], 'integer'],
            [['desconto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desconto::class, 'targetAttribute' => ['desconto_id' => 'id']],
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
            'valido' => 'Valido',
            'userprofile_id' => 'Userprofile ID',
            'desconto_id' => 'Desconto ID',
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
     * Gets query for [[Userprofile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserprofile()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'userprofile_id']);
    }
}
