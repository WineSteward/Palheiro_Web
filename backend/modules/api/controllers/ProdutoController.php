<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Imagem;
use common\models\Valornutricional;
use PhpParser\Node\Expr\Cast\Object_;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class ProdutoController extends ActiveController
{
    public $modelClass = 'common\models\Produto';
    public $categoriaClass = 'common\models\Categoria';
    public $ivaClass = 'common\models\Iva';
    public $valornutricionalClass = 'common\models\Valornutricional';
    public $marcaClass = 'common\models\Marca';
    

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (Yii::$app->params['id'] == 0 )
        {
            throw new \yii\web\ForbiddenHttpException('Proibido');
        }
    }

    public function actionAll()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $produtos = $this->modelClass::find()->all();

        $produtosDetails = [];

        foreach ($produtos as $produto)
        {

            $categoria = $this->categoriaClass::findOne($produto->categoria_id);
            $iva = $this->ivaClass::findOne($produto->iva_id);
            $marca = $this->marcaClass::findOne($produto->marca_id);
            $valornutricional = $this->valornutricionalClass::findOne($produto->valornutricional_id);
            $imagens = Imagem::findAll(['produto_id' => $produto->id]);

            $produtoData = $produto->toArray();
            $produtoData['categoria'] = $categoria;
            $produtoData['iva'] = $iva;
            $produtoData['marca'] = $marca;
            $produtoData['valornutricional'] = $valornutricional;
            $produtoData['imagens'] = $imagens;

            unset($produtoData['categoria_id']);
            unset($produtoData['iva_id']);
            unset($produtoData['marca_id']);
            unset($produtoData['valornutricional_id']);

            $produtosDetails[] = $produtoData;
        }

        return $produtosDetails;

    }

    public function actionAllofcategoria($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $produtos = $this->modelClass::findAll(['categoria_id' => $id]);

        $produtosDetails = [];

        foreach ($produtos as $produto)
        {

            $categoria = $this->categoriaClass::findOne($produto->categoria_id);
            $iva = $this->ivaClass::findOne($produto->iva_id);
            $marca = $this->marcaClass::findOne($produto->marca_id);
            $valornutricional = $this->valornutricionalClass::findOne($produto->valornutricional_id);

            $produtoData = $produto->toArray();
            $produtoData['categoria'] = $categoria;
            $produtoData['iva'] = $iva;
            $produtoData['marca'] = $marca;
            $produtoData['valornutricional'] = $valornutricional;

            unset($produtoData['categoria_id']);
            unset($produtoData['iva_id']);
            unset($produtoData['marca_id']);
            unset($produtoData['valornutricional_id']);

            $produtosDetails[] = $produtoData;
        }

        return $produtosDetails;

    }

    public function actionSearchnome($nome)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $produtos = $this->modelClass::find()->where(['like', 'nome', $nome])->all();
                
        $produtosDetails = [];

        foreach ($produtos as $produto)
        {

            $categoria = $this->categoriaClass::findOne($produto->categoria_id);
            $iva = $this->ivaClass::findOne($produto->iva_id);
            $marca = $this->marcaClass::findOne($produto->marca_id);
            $valornutricional = $this->valornutricionalClass::findOne($produto->valornutricional_id);

            $produtoData = $produto->toArray();
            $produtoData['categoria'] = $categoria;
            $produtoData['iva'] = $iva;
            $produtoData['marca'] = $marca;
            $produtoData['valornutricional'] = $valornutricional;

            unset($produtoData['categoria_id']);
            unset($produtoData['iva_id']);
            unset($produtoData['marca_id']);
            unset($produtoData['valornutricional_id']);

            $produtosDetails[] = $produtoData;
        }

        return $produtosDetails;
    }

    public function actionSearchcomplete($id, $nome)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $produtos = $this->modelClass::find()
                                ->where(['categoria_id' => $id])
                                ->andWhere(['like', 'nome', $nome])
                                ->all();

        $produtosDetails = [];

        foreach ($produtos as $produto)
        {

            $categoria = $this->categoriaClass::findOne($produto->categoria_id);
            $iva = $this->ivaClass::findOne($produto->iva_id);
            $marca = $this->marcaClass::findOne($produto->marca_id);
            $valornutricional = $this->valornutricionalClass::findOne($produto->valornutricional_id);

            $produtoData = $produto->toArray();
            $produtoData['categoria'] = $categoria;
            $produtoData['iva'] = $iva;
            $produtoData['marca'] = $marca;
            $produtoData['valornutricional'] = $valornutricional;

            unset($produtoData['categoria_id']);
            unset($produtoData['iva_id']);
            unset($produtoData['marca_id']);
            unset($produtoData['valornutricional_id']);

            $produtosDetails[] = $produtoData;
        }

        return $produtosDetails;
    }
}
