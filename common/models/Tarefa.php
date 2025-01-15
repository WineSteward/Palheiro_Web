<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarefas".
 *
 * @property int $id
 * @property string $descricao
 * @property int $feito
 * @property int $userprofile_id
 *
 * @property Userprofile $userprofile
 */
class Tarefa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarefas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'feito', 'userprofile_id'], 'required'],
            [['feito', 'userprofile_id'], 'integer'],
            [['descricao'], 'string', 'max' => 30],
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
            'descricao' => 'Descricao',
            'feito' => 'Feito',
            'userprofile_id' => 'Userprofile ID',
        ];
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
