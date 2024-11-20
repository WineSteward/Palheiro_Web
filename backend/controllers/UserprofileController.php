<?php

namespace backend\controllers;

use backend\models\SignupFormUser;
use backend\models\SignupFormUserProfile;
use common\models\Userprofile;
use backend\models\UserprofileSearch;
use backend\models\UserSearch;
use common\models\User;
use frontend\models\Carrinho;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            if ($userForm->load($this->request->post()) && $userForm->signup()) 
            {
                $carrinho = Carrinho::defaultCarrinho();

                if ($userprofile->load($this->request->post()) && $userprofile->signup($userForm->id, $carrinho)) 
                {
                    return $this->redirect(['index']);
                }
            }
        } else 
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
        
        $userprofile = UserProfile::findOne($id);
        $user = User::findOne($userprofile->user_id);
        
        if ($this->request->isPost && $user->load($this->request->post()) && $user->save())
        {
            if ($userprofile->load($this->request->post()) && $userprofile->save()) 
            {
                return $this->redirect(['view', 'id' => $userprofile->id]);
            }
        }

        return $this->render('update', [
            'user' => $user,
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
     * Finds the Userprofile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Userprofile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userprofile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


        /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelUser($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
