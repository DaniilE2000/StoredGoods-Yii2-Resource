<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index common-box">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'image',
            'sku',
            'title',
            'amount',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]);
     ?>

<input type="button" class="btn btn-info" value="Удалить выбранные" id="MyButton" >

<?php 

$url = yii\helpers\Url::to(['eradicate']);

$this->registerJs(' 

$(document).ready(function(){
$(\'#MyButton\').click(function(){
    var grid = $(this).data(\'grid\');
    var Ids = $(\'#w0\').yiiGridView(\'getSelectedRows\');
    var status = $(this).data(\'status\');
    if (Ids.length > 0) {
        if (confirm("Вы действительно хотите удалить эти товары?")) {
            $.ajax({
                type: \'POST\',
                url : \''. $url . '\',
                data : {row_id: Ids},
                dataType : \'JSON\',
                success : function($resp) {
                    if ($resp.success) {
                        alert(resp.msg);
                    }
                }
            });
        }
    } else {
        alert("Пожалуйста, выберите нужные товары.");
    }
});
});', \yii\web\View::POS_READY);

?>

</div>
