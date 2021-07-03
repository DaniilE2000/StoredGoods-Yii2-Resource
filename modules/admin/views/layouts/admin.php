<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<?php 
/*
    $goods = new Goods();
    $goods->id = 2;
    $goods->image = 'image.png';
    $goods->sku = 312312;
    $goods->title = 'Товар';
    $goods->amount = 324;
    $goods->type = 'Общего потребления';
    $goods->save();
*/
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Админ-панель | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
    <header>
        <nav>
            <?php if (!Yii::$app->user->isGuest): ?>
            <div class="nav-admin">
                <a href="<?= \yii\helpers\Url::to(['/']); ?>">Главная</a>
                <a href="<?= \yii\helpers\Url::to(['/admin']); ?>">Админ-панель ●</a>
            </div>
            <?php endif; ?>
            <div class="nav-misc">
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/signup']); ?>">Регистрация</a>
                    <a href="<?= \yii\helpers\Url::to(['/site/login']); ?>">Вход</a>
                <?php else: ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/logout']); ?>"> <?= Yii::$app->user->identity['login']; ?> (Выход)</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
        
    <?= $content; ?>

    </div>

    <footer>
        Copyright Daniil Yegorov
    </footer>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>