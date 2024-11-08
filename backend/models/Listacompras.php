<?php

namespace backend\models;

use Yii;
use common\models\Userprofile;

/**
 * This is the model class for table "listascompras".
 *
 * @property int $id
 * @property string $titulo
 * @property string|null $descricao
 * @property int $userprofile_id
 *
 * @property Userprofile $userprofile
 */
class Listacompras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listascompras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'userprofile_id'], 'required'],
            [['userprofile_id'], 'integer'],
            [['titulo'], 'string', 'max' => 30],
            [['descricao'], 'string', 'max' => 255],
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
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
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
