<?php

namespace backend\controllers;

use common\models\Fatura;
use common\models\LoginForm;
use common\models\Produto;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

use function PHPUnit\Framework\throwException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $qtddProdutos = count(Produto::find()->all());

        $qtddEncomendasPreparadas = count(Fatura::find()->where(['estadoEncomenda' => 1])->all());

        $qtddEncomendas = count(Fatura::find()->all());

        return $this->render('index',[
            'qtddProdutos' => $qtddProdutos,
            'qtddEncomendas' => $qtddEncomendas,
            'qtddEncomendasPreparadas' => $qtddEncomendasPreparadas
        ]);
    }
    
    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {

            if(Yii::$app->authManager->checkAccess(Yii::$app->user->id, "admin") || Yii::$app->authManager->checkAccess(Yii::$app->user->id, "employee"))
            {
                return $this->goBack();
            }
            else
            {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('forbidden', "Acesso Negado");
                return $this->redirect(Url::to(['site/login']));
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
