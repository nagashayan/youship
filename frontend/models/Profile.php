<?php

namespace frontend\models;
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
class Profile extends \common\models\Profile
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company_name' => ' Name',
            'company_address' => ' Address',
            'company_email' => ' Email',
            'company_phone' => ' Phone',
            'contact_info' => 'Contact Info',
            'updated_on' => 'Updated On',
        ];
    }
    
    
}
