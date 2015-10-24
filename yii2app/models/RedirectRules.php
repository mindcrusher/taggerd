<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redirect_rules".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $status_code
 */
class RedirectRules extends \yii\db\ActiveRecord
{
    const REDIRECT_STATUS_PERMANENT = 301;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirect_rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_code'], 'integer'],
            [['from', 'to'], 'string', 'max' => 255],
            [['from'], 'unique'],
            [['from','to'], 'required'],
            ['from', 'compare','compareAttribute'=>'to','operator'=>'!='],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'Откуда',
            'to' => 'Куда',
            'status_code' => 'Код заголовка',
        ];
    }

    public static function getSource($from)
    {
        return self::findOne(['from' => '/' . $from]);
    }

    public function getDestination()
    {
        $to = ltrim($this->to, '/');

        return $to;
    }
}
