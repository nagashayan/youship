<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "EmployeeInfo".
 *
 * @property integer $id
 * @property string $emp_name
 * @property string $details
 */
class EmployeeInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'EmployeeInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_name'], 'required'],
            [['emp_name'], 'string', 'max' => 100],
            [['details'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_name' => 'Emp Name',
            'details' => 'Details',
        ];
    }
}
