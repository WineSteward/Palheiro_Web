<?php

namespace frontend\controllers;

use common\models\Carrinho;
use common\models\Categoria;
use common\models\LoginForm;
use common\models\Produto;
use common\models\SignupFormUser;
use common\models\SignupFormUserProfile;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ProdutoSearch;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

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
                'only' => ['index', 'login', 'logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['client'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?','client'],
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

    public function actions()
    {
        return [
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $produtos = Produto::find()->all();
        $categorias = Categoria::find()->all();

        $produtoSearch = new ProdutoSearch();
        $dataProvider = $produtoSearch->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'produtos' => $produtos,
            'produtoSearch' => $produtoSearch,
            'dataProvider' => $dataProvider,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {

            if(Yii::$app->authManager->checkAccess(Yii::$app->user->id, "client"))
                return $this->goBack();

            Yii::$app->user->logout();
            Yii::$app->session->setFlash('forbidden', "Acesso Negado");
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

        $userForm = new SignupFormUser();
        $userprofile = new SignupFormUserProfile();

        if ($this->request->isPost) {
            if($userForm->load($this->request->post()) && $userprofile->load($this->request->post()) && $userprofile->validate()&& $userForm->signup())
            {
                $carrinho = Carrinho::defaultCarrinho();

                if ($userprofile->signup($userForm->id, $carrinho))
                {
                    Yii::$app->session->setFlash('success', "O seu registo foi concluido com sucesso!");
                    return $this->redirect(['index']);
                }
            }
            if($userForm->validate())
            return $this->render('signup', [
                'userprofile' => $userprofile,
                'user' => $userForm
            ]);
        }

        return $this->render('signup', [
            'userprofile' => $userprofile,
            'user' => $userForm
        ]);
    }

}
