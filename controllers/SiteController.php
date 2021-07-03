<?php

namespace app\controllers;

use Yii;
/*use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;*/
use app\models\LoginForm;
use app\models\SignupForm;
use yii\web\Controller;
use app\models\Goods;
use app\models\User;

use yii\data\Pagination;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
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
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        $query = Goods::find();
        $pages = new Pagination(['totalCount' => $query->count(), 
        'pageSize' => 3, 'defaultPageSize' => 3, 'forcePageParam' => false,
        ]);
        //$goods = Goods::find()->asArray()->all();
        $goods = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('goods', 'pages'));
    }

    public function actionSearch()
    {
        $q = Yii::$app->request->get('q');
        $query = Goods::find()->where(['like', 'sku', '%'. $q . '%', false])
        ->orWhere(['like', 'title', '%' . $q . '%', false]);

        $pages = new Pagination(['totalCount' => $query->count(), 
        'pageSize' => 3, 'defaultPageSize' => 3, 'forcePageParam' => false,
        ]);
        //$goods = Goods::find()->asArray()->all();
        $goods = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('goods', 'pages', 'q'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        //change//
        $model = new SignupForm();
        $model->password = '';

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->login = $model->login;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            if($user->save()){
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
        //change//
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
