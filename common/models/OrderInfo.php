<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_info".
 *
 * @property integer $id
 * @property integer $order_id
 * @property double $width
 * @property double $height
 * @property double $length
 * @property double $weight
 * @property integer $breakable
 * @property integer $wooden
 * @property integer $packed
 * @property string $packagetype
 *
 * @property Orders $order
 */
class OrderInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'width', 'height', 'length', 'weight', 'breakable', 'wooden', 'packed', 'packagetype'], 'required'],
            [['order_id', 'breakable', 'wooden', 'packed'], 'integer'],
            [['width', 'height', 'length', 'weight'], 'number'],
            [['packagetype'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'width' => 'Width',
            'height' => 'Height',
            'length' => 'Length',
            'weight' => 'Weight',
            'breakable' => 'Breakable',
            'wooden' => 'Wooden',
            'packed' => 'Packed',
            'packagetype' => 'Packagetype',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
    
    
}
