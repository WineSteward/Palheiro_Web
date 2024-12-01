<?php

namespace backend\controllers;

use backend\models\IvaSearch;
use common\models\Iva;
use backend\models\IvaDeleteForm;
use common\models\Produto;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * IvaController implements the CRUD actions for Iva model.
 */
class IvaController extends Controller
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
     * Lists all Iva models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IvaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Iva model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Iva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Iva();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save())
            {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Iva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Get action - renders a view for the user to chose what IVA they want to replace the current IVA with.
     * 
     * Post action - Puts the choosen IVA model as "not valid".

     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $oldIva = $this->findModel($id);

        //Form para controlar a alteracao de um iva para outro
        $model = new IvaDeleteForm();

        if($this->request->isPost && $model->load($this->request->post()) && $model->validate())
        {            
            //updates the iva of all products that had it
            $model->updateIva($oldIva);

            //redirect para o index dos IVAs
            return $this->redirect(['index']);
        }
        else
        {    
            // Fetch dos ivas para o dropdown
            $ivas = Iva::find()->select(['id', 'valorPorcentagem'])
                                ->where(['!=', 'id', $id])
                                ->orderBy('valorPorcentagem')
                                ->asArray()->all();
                                
            $mappedIvas = ArrayHelper::map($ivas, 'id', 'valorPorcentagem');
    
            return $this->render('delete', [
                'iva' => $oldIva,
                'model' => $model,
                'ivas' => $mappedIvas,
    
            ]);
        }
        
    }

    /**
     * Finds the Iva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Iva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Iva::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
