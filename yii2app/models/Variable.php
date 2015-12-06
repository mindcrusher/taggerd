<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $type
 * @property string $value
 * @property integer $sort
 * @property integer $is_active
 * @property string $created_time
 */
class Variable extends \yii\db\ActiveRecord
{
    const TYPE_PHONE = 'phone';
    const TYPE_MOBILE = 'mobile';
    const TYPE_FAX = 'fax';
    const TYPE_EMAIL = 'mail';
    const TYPE_SKYPE = 'skype';

    const IS_ACTIVE = 1;

    
    public $iconMap = [
        'phone' => 'icon icon-phone',
        'mobile' => 'icon icon-mobile',
        'fax' => 'icon icon-fax',
        'mail' => 'icon icon-mail',
        'address' => 'icon icon-address',
    ];
    
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infoblocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','icon'], 'string'],
            [['placeholder'], 'unique'],
            [['sort', 'is_active'], 'integer'],
            [['sort', 'is_active'], 'integer'],
            [['created_time'], 'safe'],
            [['value','description'], 'string', 'max' => 63],
            [['value', 'type', 'icon'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'value' => 'Значение',
            'description' => 'Описание',
            'sort' => 'Порядок сортировки',
            'is_active' => 'Активность',
            'created_time' => 'Created Time',
        ];
    }
    
    public static function findActive($type = null)
    {
        $find = self::find()
            ->where(['is_active' => self::IS_ACTIVE])
            ->orderBy(['type' => 'asc']);

        if($type) {
            $find->andWhere(['type' => $type]);
        }

        return $find->all();
    }

    public static function findByPlaceHolder( $placeholder )
    {
        if(empty(Yii::$app->controller->infoblocks)) {
            Yii::$app->controller->infoblocks = self::preload();
        }
        return Yii::$app->controller->infoblocks[$placeholder];
    }
    
    public function formatted()
    {
        if(in_array($this->icon, [ self::TYPE_PHONE, self::TYPE_MOBILE, self::TYPE_FAX])) {
            $string = \app\components\Helper::formatPhone( $this->value);
        } else {
            $string = $this->value;
        }
        
        return $string;
    }
    
    public function icon()
    {
        if(!empty($this->icon)) {
            return $this->iconMap[$this->icon];
        }
    }

    public static function preload()
    {
        $_infoblocks = [];
        if(empty(Yii::$app->controller->infoblocks)) {
            $infoblocks = Variable::find()->where('placeholder is not null')->all();
            foreach($infoblocks as $block) {
                $_infoblocks[$block->placeholder] = $block;
            }
            return $_infoblocks;
        } else {
            return Yii::$app->controller->infoblocks;
        }
    }

    public static function renderPlaceHolders( $text )
    {
        foreach (self::preload() as $block) {
            $text = str_replace('${'.$block->placeholder.'}', $block->value, $text);
        }
        return $text;
    }

    public function __toString()
    {
        return $this->value;
    }
}
