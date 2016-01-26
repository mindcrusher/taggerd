<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "principles".
 *
 * @property integer $id
 * @property string $key
 * @property string $title
 * @property string $text
 */
class Principles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'principles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'title'], 'string', 'max' => 45],
            [['text'], 'string', 'max' => 155],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
        ];
    }
}
