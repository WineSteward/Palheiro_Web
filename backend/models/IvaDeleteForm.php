<?php

namespace backend\models;

use common\models\Iva;
use common\models\Produto;
use yii\base\Model;

class IvaDeleteForm extends Model
{

    public $iva_id;

    public function rules()
    {
        return [
            ['iva_id', 'required'],
            ['iva_id', 'integer'],
        ];
    }


    public function updateIva(Iva $oldIva)
    {   

        //iva deixa de estar em vigor e é substituido por outro
        $oldIva->replaceIva($this->iva_id);

        //fetch de todos os produtos que tenham o iva antigo
        $produtos = Produto::findByIvaID($oldIva->id);

        //alteracao de todos os produtos para o novo iva e save para DB
        foreach($produtos as $produto)
        {
            $produto->iva_id = $this->iva_id;
            $produto->save();
        }        

    }



}