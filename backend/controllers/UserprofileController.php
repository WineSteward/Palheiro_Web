<?php

namespace backend\controllers;

use backend\models\UserSearch;
use common\models\Carrinho;
use common\models\SignupFormUser;
use common\models\SignupFormUserProfile;
use common\models\User;
use common\models\Userprofile;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserprofileController implements the CRUD actions for Userprofile model.
 */
class UserprofileController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all Userprofile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
                ->with('userprofile')
                ->join('INNER JOIN', 'auth_assignment', 'auth_assignment.user_id = user.id') // join RBAC table
                ->andWhere(['auth_assignment.item_name' => 'client']) // filter for "client" role
        ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Userprofile model.
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
     * Creates a new Userprofile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        $userForm = new SignupFormUser();
        $userprofile = new SignupFormUserProfile();

        //TRANSACTIONS!!!!!!!!!!!!!!!!!!!!!!!!!

        if ($this->request->isPost) 
        {
            if($userForm->load($this->request->post()) && $userprofile->load($this->request->post()) && $userprofile->validate() && $userForm->signup())
            {
                $carrinho = Carrinho::defaultCarrinho();

                if ($userprofile->signup($userForm->id, $carrinho))
                {
                    return $this->redirect(['index']);
                }
            }
        }
        else
        {
            //$userprofile->loadDefaultValues();
        }

        return $this->render('create', [
            'userprofile' => $userprofile,
            'user' => $userForm
        ]);
    }

    /**
     * Updates an existing Userprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //TRANSACTIONS!!!!!!!!!!!!!!!!!!!!!!!!!

        $userprofile = $this->findModel($id);

        if ($this->request->isPost && $userprofile->user->load($this->request->post()) && $userprofile->user->save()) {
            if ($userprofile->load($this->request->post()) && $userprofile->save())
            {
                return $this->redirect(['view', 'id' => $userprofile->id]);
            }
        }

        return $this->render('update', [
            'user' => $userprofile->user,
            'userprofile' => $userprofile
        ]);
    }

    /**
     * Deletes an existing Userprofile model.
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
     * Finds the Userprofile model (with user) based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Userprofile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (
            ($model = Userprofile::find()
            ->where(['id' => $id])
            ->with(['user'])
            ->one()) !== null)
            {
                return $model;
            }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
