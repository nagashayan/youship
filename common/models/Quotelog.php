<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotelog".
 *
 * @property integer $id
 * @property integer $order_id
 * @property double $offer_price
 * @property string $quote_from
 * @property integer $operator_id
 * @property string $quoted_date
 *
 * @property Orders $order
 */
class Quotelog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotelog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'offer_price', 'quote_from'], 'required'],
            [['order_id', 'operator_id'], 'integer'],
            [['offer_price'], 'number'],
            [['quoted_date'], 'safe'],
            [['quote_from'], 'string', 'max' => 20]
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
            'offer_price' => 'Offer Price',
            'quote_from' => 'Quote From',
            'operator_id' => 'Operator ID',
            'quoted_date' => 'Quoted Date',
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
