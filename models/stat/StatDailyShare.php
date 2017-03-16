<?php

namespace app\models\stat;

use Yii;

/**
 * This is the model class for table "stat_daily_share".
 *
 * @property integer $id
 * @property string $date
 * @property integer $total_count
 * @property string $updated_time
 * @property string $created_time
 */
class StatDailyShare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stat_daily_share';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'total_count'], 'required'],
            [['date', 'updated_time', 'created_time'], 'safe'],
            [['total_count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'total_count' => 'Total Count',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
