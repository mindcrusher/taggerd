<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.11.2015
 * Time: 11:45
 */

namespace app\modules\user\controllers;


use app\components\Bootstrap;

class RecoveryController extends \dektrium\user\controllers\RecoveryController
{
    use Bootstrap;

    public function init()
    {
        $this->initDependants();
        parent::init();
    }
}