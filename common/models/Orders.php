<?php

namespace common\models;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property double $offerprice
 * @property string $pickuplocation
 * @property string $pickuplocationtype
 * @property string $pickupdate1
 * @property string $pickupdate2
 * @property string $pickupcond
 * @property string $deliverylocation
 * @property string $deliverylocationtype
 * @property string $deliverydate1
 * @property string $deliverydate2
 * @property string $deliverycond
 * @property string $createdon
 * @property string $updatedon
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status', 'pickuplocation', 'pickuplocationtype', 'pickupcond', 'deliverylocation', 'deliverylocationtype', 'deliverycond'], 'required'],
            [['status'], 'integer'],
            [['offerprice'], 'number'],
            [['pickupdate1', 'pickupdate2', 'deliverydate1', 'deliverydate2', 'createdon', 'updatedon'], 'safe'],
            [['title'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000],
            [['pickuplocation', 'deliverylocation'], 'string', 'max' => 200],
            [['pickuplocationtype', 'pickupcond', 'deliverylocationtype', 'deliverycond'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'offerprice' => 'Offerprice',
            'pickuplocation' => 'Pickuplocation',
            'pickuplocationtype' => 'Pickuplocationtype',
            'pickupdate1' => 'Pickupdate1',
            'pickupdate2' => 'Pickupdate2',
            'pickupcond' => 'Pickupcond',
            'deliverylocation' => 'Deliverylocation',
            'deliverylocationtype' => 'Deliverylocationtype',
            'deliverydate1' => 'Deliverydate1',
            'deliverydate2' => 'Deliverydate2',
            'deliverycond' => 'Deliverycond',
            'createdon' => 'Createdon',
            'updatedon' => 'Updatedon',
        ];
    }
    
    

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdon',
                'updatedAtAttribute' => 'updatedon',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
