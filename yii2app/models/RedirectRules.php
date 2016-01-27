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
    public $destination;

    const REDIRECT_STATUS_PERMANENT = 301;

    public static $map;
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
            //[['destination', 'safe']],
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
        self::preload();
        if(array_key_exists($from, self::$map)) {
            return self::$map[$from];
        }
    }

    public function getDestination()
    {
        $to = ltrim($this->to, '/');

        return $to;
    }

    public static function preload()
    {
        $suffix = Yii::$app->urlManager->suffix;
        if(empty(self::$map)) {
            $to_list = [];
            $rules = self::find()->all();
            foreach ($rules as &$rule) {
                $from = trim($rule->from, $suffix);
                $to = trim($rule->to, $suffix);
                $to_list[$to][] = $from;
                self::$map[$from] = $rule ;
                self::$map[$from. $suffix ] = $rule ;
            }
        }
    }

    public static function normalize()
    {
        $Redundancies = self::find()
            ->select('redirect_rules.*,r2.to as destination')
            ->innerJoin(self::tableName() . ' as r2', '`redirect_rules`.`to` = `r2`.`from`')
            ->all();

        foreach ($Redundancies as $rule) {
            $rule->to = $rule->destination;
            $rule->save(false);
        }
    }

    public function afterSave()
    {
        self::normalize();
        self::deleteAll('`to` = `from`');
    }
}
