<?php

namespace app\models\member;

use Yii;

/**
 * This is the model class for table "member_address".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $address
 * @property integer $is_default
 * @property integer $status
 * @property string $updated_time
 * @property string $created_time
 */
class MemberAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'province_id', 'city_id', 'area_id', 'is_default', 'status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['address'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'area_id' => 'Area ID',
            'address' => 'Address',
            'is_default' => 'Is Default',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
