<?php

namespace frontend\controllers;

use common\models\Userdesconto;
use common\models\Fatura;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ProfileController extends \yii\web\Controller
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
                        'actions' => ['index', 'edit', 'update'],
                        'allow' => true,
                        'roles' => ['client'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'update' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $userProfile = $user->userprofile;

        if (!$userProfile) {
            Yii::$app->session->setFlash('error', 'Perfil não encontrado.');
            return $this->redirect(['/site/index']);
        }

        $userDescontos = Userdesconto::find()
            ->where(['userprofile_id' => $userProfile->id])
            ->andWhere(['valido' => 1])
            ->with('desconto')
            ->all();

        $encomendas = Fatura::find()
            ->where(['userprofile_id' => $userProfile->id, 'valida' => 1])
            ->orderBy(['id' => SORT_DESC]) //newest encomendas appear first
            ->all();
        

        return $this->render('index', [
            'user'=>$user,
            'userProfile' => $userProfile,
            'userDescontos' => $userDescontos,
            'encomendas' => $encomendas,
        ]);
    }

    public function actionEdit()
    {
        $user = Yii::$app->user->identity;
        $userProfile = $user->userprofile;

        return $this->render('edit', [
            'user'=>$user,
            'userProfile' => $userProfile,
        ]);
    }

    /**
     * Updates an existing Userprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {

        $user = Yii::$app->user->identity;
        $userprofile = $user->userprofile;

        if ($this->request->isPost && $userprofile->load($this->request->post()) && $userprofile->save())
        {
            Yii::$app->session->setFlash('success', 'Perfil editado com sucesso.');
            return $this->redirect(['index']);
        }
    }

}
