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
 * @property integer $userid
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
 *
 * @property OrderInfo[] $orderInfos
 * @property User $user
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
            [['title', 'status', 'userid', 'pickuplocation', 'pickuplocationtype', 'pickupcond', 'deliverylocation', 'deliverylocationtype', 'deliverycond'], 'required'],
            [['status', 'userid'], 'integer'],
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
            'userid' => 'Userid',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderInfos()
    {
        return $this->hasMany(OrderInfo::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
    
    public function behaviors(){
      return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdon',
                'updatedAtAttribute' => 'updatedon',
                'value' => new Expression('NOW()'),
            ],
        ];
      }
      
      /**
       * returns last quote by customer
       */
      public function getLastCustomerQuote($id){
          //get last quote for custom from quote log
          $quotelog = Quotelog::find()->where("order_id = $id and quote_from = 'customer'")->orderBy("quoted_date desc")->one();
          if(isset($quotelog->id)){
             return $quotelog->offer_price; 
          }
          else{
              //if quote log is empty
              return false;
          }
      }
      
      /**
       * returns last quote by operator
       */
      public function getLastOperatorQuote($id){
          //get last quote for custom from quote log
          $quotelog = Quotelog::find()->where("order_id = $id and quote_from = 'operator'")->orderBy("quoted_date DESC,offer_price asc")->one();
          if(isset($quotelog->id)){
             return $quotelog->offer_price; 
          }
          else{
              //if quote log is empty
              return false;
          }
      }
      
      /**
       * get customer quote status
       * return false if last quote is customer or bidding is closed
       */
      public function getCustomerQuoteStatus($order){
          $id = $order->id;
          $quote = Quotelog::find()->where("order_id = $id")->orderBy("id desc")->one();
          if(isset($quote->id)){
             // if($quote->quote_from == "operator" && Quotelog::find()->where("order_id = $id")->orderBy("id desc")->count() < 4){
              if($quote->quote_from == "operator"){
                  return true;
              }
              
          }
          
          return false;
          
          
      }
}
