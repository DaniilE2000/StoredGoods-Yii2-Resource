<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;


class AppAdminController extends Controller
{

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        //'actions' => ['login', 'signup'],
                        'roles' => ['@'],
                    ],
                    /*[
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],*/
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('/admin/goods');
        //return $this->render('index');
    }
}
