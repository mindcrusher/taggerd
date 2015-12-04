<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.10.2015
 * Time: 20:17
 */

namespace app\components;
use app\models\RedirectRules;
use Yii;


class PreRequest
{
    public static function control()
    {
        $status_code = 301;

        $app = Yii::$app;
        $pathInfo = $app->request->pathInfo;
        $suffix = $app->urlManager->suffix;
        $allowRedirect = false;
        $destination = $pathInfo;

        $rule = RedirectRules::getSource($pathInfo);
        if($rule) {
            $allowRedirect = true;
            $destination = $rule->getDestination();
            $status_code = $rule->status_code;
            var_dump($rule);
        }

        if(!empty($destination) && substr($destination, -1) !== $suffix) {
            $allowRedirect = true;
            $destination = $pathInfo . $suffix;
        }

        if ($allowRedirect) {
            $destination = '/' . $destination;
            $app->response->redirect($destination, 301, false);
            $app->end();
        }
    }
} 
