<?php

namespace app\controllers;

use app\models\Links;
use app\components\Controller;
use app\models\Pages;
use app\models\Pending;
use Yii;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Menu;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => Pages::findOne(1)
        ]);
    }

    public function actionInfo($alias)
    {
        $link = Links::findOne(['alias' => $alias]);
        return $this->render('info',[
            'page' => $link->page,
        ]);
    }
    
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/cms/']);
        } else {
            //throw new HttpException(403);

            return $this->render('login', [
                'model' => $model,
            ]);

        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionPending()
    {
        $model = new Pending();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('pendingFormSubmitted', true);

            return $this->refresh();
        } else {
            return $this->render('pending', [
                'model' => $model,
            ]);
        }
    }
}
