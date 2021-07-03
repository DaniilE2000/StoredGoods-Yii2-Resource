<?php

namespace app\controllers;
use Yii;
use app\models\goods;
use app\models\users;


class GoodsController extends AppController {

    public function actionIndex() {
        $this->render('index');
    }
}

?>