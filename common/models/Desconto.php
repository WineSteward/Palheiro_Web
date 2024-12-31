<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "descontos".
 *
 * @property int $id
 * @property string $nome
 * @property float $valor
 *
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
            [['valor'], 'number', 'min' => 0, 'max' => 100],
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

    public static function validateCupao($descontoNome, $id)
    {
        $descontos = Userdesconto::find()
            ->where(['userprofile_id' => $id])
            ->andWhere(['valido' => 1])
            ->all();

        foreach ($descontos as $desconto) 
        {
            $descontoAtual = Desconto::findOne($desconto->desconto_id);

            if ($descontoAtual->nome == $descontoNome) {

                return true;
            }
        }
        return false;
    }
}
