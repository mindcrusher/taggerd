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
    public $menu;

    public function init()
    {

        if(\Yii::$app->params['isUnderConstruction']) {
            $this->layout = '/under_construction';
        }

        $groups = Menu::find()->joinWith('links')->where(['is_active' => 1])->all();

        foreach ($groups as $group) {
            $items = [];
            foreach($group->links as $item) {
                $items[] = ['label' => $item->link->name, 'url' => $item->link->getUrl()];
            }

            $this->menu[$group->id] = [
                'name' => $group->display_name ? $group->name : '',
                'links' => ['items' => $items],
            ];
        }

        if(Yii::$app->request->isAjax) {
            $this->layout = false;
        }
    }
}