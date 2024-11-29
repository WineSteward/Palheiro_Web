<?php

namespace common\models;

use common\models\Linhacarrinho;

use Yii;

/**
 * This is the model class for table "produtos".
 *
 * @property int $id
 * @property string $nome
 * @property float $preco
 * @property string $descricao
 * @property int $categoria_id
 * @property int $iva_id
 * @property int $marca_id
 * @property int $valornutricional_id
 *
 * @property Categoria $categoria
 * @property Imagen[] $imagens
 * @property Iva $iva
 * @property Linhacarrinho[] $linhascarrinhos
 * @property Linhafatura[] $linhasfaturas
 * @property Marca $marca
 * @property Valornutricional $valornutricional
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produtos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'preco', 'descricao', 'categoria_id', 'iva_id', 'marca_id', 'valornutricional_id'], 'required'],
            [['preco'], 'number'],
            [['categoria_id', 'iva_id', 'marca_id', 'valornutricional_id'], 'integer'],
            [['nome'], 'string', 'max' => 30],
            [['descricao'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::class, 'targetAttribute' => ['iva_id' => 'id']],
            [['marca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::class, 'targetAttribute' => ['marca_id' => 'id']],
            [['valornutricional_id'], 'exist', 'skipOnError' => true, 'targetClass' => Valornutricional::class, 'targetAttribute' => ['valornutricional_id' => 'id']],
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
            'preco' => 'Preco',
            'descricao' => 'Descricao',
            'categoria_id' => 'Categoria ID',
            'iva_id' => 'Iva ID',
            'marca_id' => 'Marca ID',
            'valornutricional_id' => 'Valornutricional ID',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Imagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[Iva]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Iva::class, ['id' => 'iva_id']);
    }

    /**
     * Gets query for [[Linhascarrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhascarrinhos()
    {
        return $this->hasMany(Linhacarrinho::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturas()
    {
        return $this->hasMany(Linhafatura::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[Marca]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marca::class, ['id' => 'marca_id']);
    }

    /**
     * Gets query for [[Valornutricional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValornutricional()
    {
        return $this->hasOne(Valornutricional::class, ['id' => 'valornutricional_id']);
    }
}
