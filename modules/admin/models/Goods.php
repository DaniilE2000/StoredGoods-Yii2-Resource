<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $image
 * @property string $sku
 * @property string $title
 * @property int $amount
 * @property string $type
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'sku', 'title', 'type'], 'required'],
            [['amount'], 'integer'],
            [['image', 'sku', 'title', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID товара',
            'image' => 'Изображение',
            'sku' => 'Код SKU',
            'title' => 'Название',
            'amount' => 'Кол-во на складе',
            'type' => 'Тип товара',
        ];
    }
}
