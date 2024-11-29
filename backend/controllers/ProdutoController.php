<?php

namespace backend\controllers;

use common\models\Produto;
use backend\models\ProdutoSearch;
use backend\models\UploadForm;
use common\models\Categoria;
use common\models\Imagem;
use common\models\Iva;
use common\models\Marca;
use common\models\Valornutricional;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['admin', 'employee'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Produto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $produto = Produto::find()
                            ->where(['id' => $id])
                            ->with(['categoria', 'iva', 'marca', 'valornutricional', 'imagens']) //Eager loading fix
                            ->one();

        return $this->render('view', [
            'model' => $produto,
        ]);
    }

    public function actionUpload(UploadForm $uploadModel, $produto_id)
    {
        
        if (Yii::$app->request->isPost) 
        {
            $uploadModel->imageFiles = UploadedFile::getInstances($uploadModel, 'imageFiles');
            if ($uploadModel->upload($produto_id)) 
            {
                // file is uploaded successfully
                return true;
            }
            return;
        }

        return false;
    }

    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Produto();
        $uploadModel = new UploadForm();

        // Fetch das categorias para o dropdown
        $categorias = Categoria::find()->select(['id', 'nome'])->orderBy('nome')->asArray()->all();
        $mappedCategorias = ArrayHelper::map($categorias, 'id', 'nome');


        // Fetch dos ivas para o dropdown
        $ivas = Iva::find()->select(['id', 'valorPorcentagem'])->orderBy('valorPorcentagem')->asArray()->all();
        $mappedIvas = ArrayHelper::map($ivas, 'id', 'valorPorcentagem');


        // Fetch dos marcas para o dropdown
        $marcas = Marca::find()->select(['id', 'nome'])->orderBy('nome')->asArray()->all();
        $mappedMarcas = ArrayHelper::map($marcas, 'id', 'nome');


        // Fetch dos valores nutricionais para o dropdown
        $valores = Valornutricional::find()->select(['id', 'nome'])->orderBy('nome')->asArray()->all();
        $mappedValores = ArrayHelper::map($valores, 'id', 'nome');


        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post()) && $model->save())
            {
                if($this->actionUpload($uploadModel, $model->id))
                    return $this->redirect(['index']);
            }
        } 
        else 
        {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'uploadModel' => $uploadModel,
            'categorias' => $mappedCategorias,
            'ivas' => $mappedIvas,
            'marcas' => $mappedMarcas,
            'valoresnutricionais' => $mappedValores,
            'imageForm' => $uploadModel
        ]);
    }

    /**
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new UploadForm();

        // Fetch das categorias para o dropdown
        $categorias = Categoria::find()->select(['id', 'nome'])->orderBy('nome')->asArray()->all();
        $mappedCategorias = ArrayHelper::map($categorias, 'id', 'nome');


        // Fetch dos ivas para o dropdown
        $ivas = Iva::find()->select(['id', 'valorPorcentagem'])->orderBy('valorPorcentagem')->asArray()->all();
        $mappedIvas = ArrayHelper::map($ivas, 'id', 'valorPorcentagem');


        // Fetch dos marcas para o dropdown
        $marcas = Marca::find()->select(['id', 'nome'])->orderBy('nome')->asArray()->all();
        $mappedMarcas = ArrayHelper::map($marcas, 'id', 'nome');


        // Fetch dos valores nutricionais para o dropdown
        $valores = Valornutricional::find()->select(['id', 'nome'])->orderBy('nome')->asArray()->all();
        $mappedValores = ArrayHelper::map($valores, 'id', 'nome');


        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post()) && $model->save())
            {
                if($this->actionUpload($uploadModel, $model->id))
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        else 
        {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'uploadModel' => $uploadModel,
            'categorias' => $mappedCategorias,
            'ivas' => $mappedIvas,
            'marcas' => $mappedMarcas,
            'valoresnutricionais' => $mappedValores
        ]);
    }

    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
