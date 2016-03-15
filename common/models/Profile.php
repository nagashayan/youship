<?php

namespace common\models;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $company_name
 * @property string $company_address
 * @property string $company_email
 * @property string $company_phone
 * @property string $contact_info
 * @property string $updated_on
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['updated_on'], 'safe'],
            [['company_name'], 'string', 'max' => 200],
            [['company_address', 'contact_info'], 'string', 'max' => 1000],
            [['company_email'], 'string', 'max' => 100],
            [['company_phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company_name' => 'Company Name',
            'company_address' => 'Company Address',
            'company_email' => 'Company Email',
            'company_phone' => 'Company Phone',
            'contact_info' => 'Contact Info',
            'updated_on' => 'Updated On',
        ];
    }
    
    
    public function behaviors(){
      return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'updated_on',
                'updatedAtAttribute' => 'updated_on',
                'value' => new Expression('NOW()'),
            ],
        ];
      }
}
