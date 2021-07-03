<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<section class="common-box table-col-controls-box">
    <span class="legend-caption">Управление показом столбцов</span>
    <ul class="table-col-controls">
        <li>Изображение<input type="checkbox" id="toggler-image" checked></li>
        <li>Идент. номер<input type="checkbox" id="toggler-sku" checked></li>
        <li>Название<input type="checkbox" id="toggler-title" checked></li>
        <li>Кол-во<input type="checkbox" id="toggler-amount" checked></li>
        <li>Тип товара<input type="checkbox" id="toggler-type" checked></li>
    </ul>
</section>

<section class="common-box table-box">
    <table>
        <caption>
            Список товаров <div class="searchbox">
                <form method="get" action="<?= \yii\helpers\Url::to(['site/search']); ?>">
                    <input type="text" name="q" id="search" placeholder="SKU или Название" value="<?= $q ?>">
                    <input type="submit" value="Искать">
                </form>
            </div>
        </caption>
        <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Изображение</th>
                <th scope="col">SKU</th>
                <th scope="col">Название</th>
                <th scope="col">Кол-во на складе</th>
                <th scope="col">Тип товара</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if( !empty($goods) ):
                foreach ($goods as $singleGoods):
                    echo '<tr>';
                    foreach ($singleGoods as $key => $item):
                        echo '<td>';
                        if ($key !== 'image') 
                            echo $item;
                        else
                            echo Html::img("@web/images/{$item}", ['alt' => $item, 'onerror' => "this.onerror=null; this.src='/StoredGoods/images/sample_image.jpg'"]);
                            echo '</td>';
                    endforeach;
                    echo '</tr>';
                endforeach;
                echo '</tbody></table>';
                echo yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
            else:   
                    echo '<tr><td colspan="6">В данный момент товаров на складе нет.</td></tr></tbody></table>';
            endif;
                    
            ?>


</section>