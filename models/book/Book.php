<?php

namespace app\models\book;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property string $name
 * @property string $price
 * @property string $main_image
 * @property string $summary
 * @property integer $unit
 * @property string $tags
 * @property integer $status
 * @property string $updated_time
 * @property string $created_time
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'unit', 'status'], 'integer'],
            [['price'], 'number'],
            [['updated_time', 'created_time'], 'safe'],
            [['name', 'main_image'], 'string', 'max' => 100],
            [['summary'], 'string', 'max' => 2000],
            [['tags'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'name' => 'Name',
            'price' => 'Price',
            'main_image' => 'Main Image',
            'summary' => 'Summary',
            'unit' => 'Unit',
            'tags' => 'Tags',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
