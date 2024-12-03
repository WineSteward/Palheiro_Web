<?php

namespace backend\controllers;

use common\models\Userdesconto;
use app\models\Userdescontosearch;
use common\models\Desconto;
use common\models\Userprofile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UserdescontoController implements the CRUD actions for Userdesconto model.
 */
class UserdescontoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists the records of the client.
     * @param int $id ID
     *
     * @return string
     */
    public function actionIndex($id)
    {


        $searchModel = new Userdescontosearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Userdesconto::find()
                ->with('userprofile', 'desconto')
        ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Userdesconto model.
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
     * Creates a new Userdesconto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id Userprofile ID
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Userdesconto();

        // Fetch dos descontos para o dropdown
        $descontos = Desconto::find()->select(['id', 'valor'])->orderBy('id')->asArray()->all();
        $mappedDescontos = ArrayHelper::map($descontos, 'id', 'valor');
        

        if ($this->request->isPost)
        {

            $user = Userprofile::find()->where(['user_id' => $id])->one();
            $model->associateID($user->id);

            if ($model->load($this->request->post()) && $model->save()) 
            {
                return $this->redirect(['index', 'id' => $model->userprofile_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'descontos' => $mappedDescontos,
            'id' => $id
        ]);
    }

    /**
     * Updates an existing Userdesconto model.
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
     * Deletes an existing Userdesconto model.
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
     * Finds the Userdesconto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Userdesconto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userdesconto::find()->with(['userprofile', 'desconto'])->where(['id' => $id]))->one() !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
