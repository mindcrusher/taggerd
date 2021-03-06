<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.10.2015
 * Time: 22:13
 */

namespace app\components;

use app\models\Variable;
use Yii;

trait Bootstrap
{
    public $menu;
    public $infoblocks;

    final function initDependants()
    {
        $groups = \app\models\Menu::find()->joinWith('links')->where(['is_active' => 1])->all();

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

        $this->infoblocks = Variable::preload();
    }
}