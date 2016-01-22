<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.10.2015
 * Time: 22:13
 */

namespace app\components;

use Yii;
use app\models\Menu;

class Controller extends \yii\web\Controller
{
    use Bootstrap;

    public function init()
    {
        $this->initDependants();

        if(\Yii::$app->params['isUnderConstruction']) {
            $this->layout = '/under_construction';
        }

        if(Yii::$app->request->isAjax) {
            $this->layout = false;
        }
    }
}