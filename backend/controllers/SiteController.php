<?php

namespace backend\controllers;

use common\models\Fatura;
use common\models\LoginForm;
use common\models\Mensagem;
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
    $qtddMensagens = count(Mensagem::find()->all());

    // Fetch fatura by month
    $faturasByMes = (new \yii\db\Query())
        ->select(['MONTH(dataVenda) as month', 'COUNT(*) as count'])
        ->from(Fatura::tableName())
        ->groupBy(['MONTH(dataVenda)'])
        ->orderBy(['MONTH(dataVenda)' => SORT_ASC])
        ->all();

    $chartData = [
        'labels' => [],
        'data' => []
    ];

    foreach ($faturasByMes as $entry) {
        $chartData['labels'][] = \DateTime::createFromFormat('!m', $entry['month'])->format('F');
        $chartData['data'][] = $entry['count'];
    }

    // Pie Chart Data for Categoria Distribution as Percentages
    $categoriaData = (new \yii\db\Query())
        ->select(['categorias.nome as categoria', 'SUM(linhasfaturas.quantidade) as total'])
        ->from('linhasfaturas')
        ->innerJoin('produtos', 'linhasfaturas.produto_id = produtos.id')
        ->innerJoin('categorias', 'produtos.categoria_id = categorias.id')
        ->groupBy('categorias.nome')
        ->all();

    $totalQuantidade = array_sum(array_column($categoriaData, 'total'));

    $pieChartData = [
        'labels' => array_column($categoriaData, 'categoria'),
        'data' => array_map(function ($entry) use ($totalQuantidade) {
            return round(($entry['total'] / $totalQuantidade) * 100, 2);
        }, $categoriaData)
    ];

        // Fetch fatura total by month
        $faturasTotalByMes = (new \yii\db\Query())
            ->select(['MONTH(dataVenda) as month', 'SUM(total) as total'])
            ->from(Fatura::tableName())
            ->groupBy(['MONTH(dataVenda)'])
            ->orderBy(['MONTH(dataVenda)' => SORT_ASC])
            ->all();

        $totalFaturasChartData = [
            'labels' => [],
            'data' => []
        ];
    
        foreach ($faturasTotalByMes as $entry) {
            $totalFaturasChartData['labels'][] = \DateTime::createFromFormat('!m', $entry['month'])->format('F');
            $totalFaturasChartData['data'][] = $entry['total'];
        }

    return $this->render('index', [
        'qtddProdutos' => $qtddProdutos,
        'qtddEncomendas' => $qtddEncomendas,
        'qtddEncomendasPreparadas' => $qtddEncomendasPreparadas,
        'qtddMensagens' => $qtddMensagens,
        'chartData' => $chartData,
        'pieChartData' => $pieChartData,
        'totalFaturasChartData' => $totalFaturasChartData,
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
