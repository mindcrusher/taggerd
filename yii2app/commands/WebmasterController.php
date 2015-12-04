<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 06.12.2015
 * Time: 10:55
 */

namespace app\commands;

use app\models\Links;
use app\models\RedirectRules;
use yii\console\Controller;
use yii\web\Link;

class WebmasterController extends Controller
{
    const ERR_BAD_RESPONSE = 'Неверный ответ сервера';
    const ERR_TO_MANY_REDIRECTS = 'Слишком много редиректов';

    public function actionCheckSite()
    {
        $links = array_map('trim',file(\Yii::getAlias('@app') . '/../yandex-check/exists-links.txt'));

        foreach ($links as $link) {
            $check = $this->checkUrl($link);
            if( $check !== true ) {
                print_r($check);
            }
        }

    }

    public function checkUrl( $url )
    {
        $errors = [];
        //$url = str_replace('test.taggerd.su','taggerd.workspace.loc', $url);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        $response = curl_exec($ch);

        preg_match("#HTTP/\d+\.\d+ (\d{3}) #Ui", $response, $code);
        $firstHttpCode = 0;
        if(!empty($code)) {
            $firstHttpCode = $code[1];
        } else {
            var_dump($url);
            var_dump($response);
            var_dump($code);
        }

        $redirectCount = curl_getinfo($ch, CURLINFO_REDIRECT_COUNT );
        $redirectUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL  );
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE );

        echo "Request is: " . $url . '('.$firstHttpCode.')';
        if($redirectCount) {
            echo ' -> ' . $redirectUrl . '('.$httpCode.')';
        }
        if($redirectCount > 1) {
            $errors[] = self::ERR_TO_MANY_REDIRECTS. ': ' . $redirectCount;
        }
        echo PHP_EOL;
        if(!in_array($httpCode,  [200, RedirectRules::REDIRECT_STATUS_PERMANENT])) {
            $errors[] = self::ERR_BAD_RESPONSE . ': ' . $httpCode;
        }

        return empty($errors) ? true : $errors;
    }

    public function actionRefineLinks()
    {
        $links = Links::find()->all();
        foreach ($links as $link) {
            $link->save(false);
        }
    }
} 