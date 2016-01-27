<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use \app\models\Variable;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="hidden-xs sub-page-header text-center text-white">
    ${TOP_TEXT}
</div>
<div class="header-bg header-block">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-4">
                <a href="/" class="header-logo"></a>
            </div>
            <div class="row col-md-9 col-xs-8 text-white text-right">
                <div class="row">
                    <div class="col-sm-4 col-xs-12 header-contact-block ">
                        <div class="icon icon-phone"></div>
                        <div class="row">
                            <div class="phone col-xs-12">
                                ${MAIN_PHONE}
                            </div>
                            <div class="text col-xs-12">
                                ${WORK_HOURS}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                            <?php
                            echo Nav::widget([
                                'items' => [
                                    ['label' => '<span class="header-block__icon header-block__feedback-icon"></span><span class="hidden-sm hidden-xs">Обратная связь</span>',
                                        'url' => ['/site/contact'],
                                        'encode' => false,
                                        'linkOptions' => [
                                            'class' =>  'showModalButton',
                                            'data-target' => '#pending-form',
                                            'data-toggle' => 'modal',
                                            'title' => 'Обратная связь',
                                        ]],
                                    ['label' => '<span class="header-block__icon header-block__pending-icon"></span><span class="hidden-sm hidden-xs">Онлайн заявка</span>',
                                        'encode' => false,
                                        'url' => ['/site/pending'], 'linkOptions' => [
                                        'class' =>  'showModalButton',
                                        'data-target' => '#pending-form',
                                        'data-toggle' => 'modal',
                                        'title' => 'Заявка онлайн',
                                    ]],
                                    ['label' => '<span class="header-block__icon header-block__calculator-icon"></span><span class="hidden-sm hidden-xs">Калькулятор</span>',
                                        'encode' => false,
                                        'url' => ['/calc/default/index']],
                                ],
                                'options' => [
                                    'class' => 'hidden-xs navbar-nav navbar-right navbar-short-menu text-yellow '
                                ],
                            ]);
                            ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 mobile-menu hidden-md hidden-sm hidden-lg">
                <span id="show-menu" class="header-block__icon header-block__menu-icon"></span>
            </div>
            <div class="col-md-9 header-navbar-menu">
                <?php
                $menu = Yii::$app->controller->menu[2];
                $menu['options'] = [
                    'class' => 'navbar-nav navbar-right navbar-horizontal-menu text-white'
                ];
                echo Nav::widget([
                    'items' => $menu['links']['items'],
                    'options' => [
                        'class' => 'navbar-nav navbar-right navbar-horizontal-menu text-white'
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<div id="base-content" class="text-blue">
    <?=$content?>
</div>
<div class="footer">
    <div class="container">
        <div class="footer-title">Наши координаты</div>

        <div class="row">
            <div class="col-sm-4">
                <?php
                $placeholders = ['MAIN_CONTACTS','MAIN_ADDRESS','MAIN_EMAIL'];
                foreach($placeholders as $placeholder) {
                    $contact = Variable::findByPlaceHolder($placeholder);
                    if($contact) {
                ?>
                <div class="contact-row">
                    <div class="col-xs-2"><div class="footer-icon <?=$contact->icon()?>"></div></div>
                    <div class="col-xs-10">
                        <div class="row"><?=$contact->value?></div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <div class="col-sm-2 hidden-xs">
                <?php
                if(!empty(Yii::$app->controller->menu[4])) {
                    echo Menu::widget(Yii::$app->controller->menu[4]['links']);
                }
                ?>
            </div>
            <div class="col-sm-2 hidden-xs">
                <?php
                if(!empty(Yii::$app->controller->menu[5])) {
                    echo Menu::widget(Yii::$app->controller->menu[5]['links']);
                }
                ?>
            </div>
            <div class="col-sm-4 hidden-xs">
                <?php
                if(!empty(Yii::$app->controller->menu[6])) {
                    echo Menu::widget(Yii::$app->controller->menu[6]['links']);
                }
                ?>
            </div>
        </div>
    </div>
    <div class='layout-footer text-white'>
        <div class='container'>
            <div class='col-md-6'>
                <?=Yii::$app->params['copyright']?>
            </div>
            <div class='col-md-6 text-right footer-share-widget'>
                <div class="col-xs-6 text-right footer-share-widget-text">
                    Поделитесь с друзьями
                </div>
                <div class="col-xs-6">
                    <script type="text/javascript">(function() {
                            if (window.pluso)if (typeof window.pluso.start == "function") return;
                            if (window.ifpluso==undefined) { window.ifpluso = 1;
                                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                var h=d[g]('body')[0];
                                h.appendChild(s);
                            }})();</script>
                    <div class="pluso" data-background="transparent" data-options="big,round,line,horizontal,nocounter,theme=04" data-services="facebook,twitter,vkontakte,odnoklassniki,google"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'pending-form',
    //'size' => 'modal-md',
    //'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
echo "<div id='modalContent'>Подождите...</div>";
yii\bootstrap\Modal::end();
?>
<div style="display:none;">
    <!--LiveInternet counter-->
    <script type="text/javascript"><!--
        document.write("<a href='http://www.liveinternet.ru/click' " +
        "target=_blank><img src='http://counter.yadro.ru/hit?t42.6;r" +
        escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
        ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
            screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
        ";h" + escape(document.title.substring(0, 80)) + ";" + Math.random() +
        "' alt='' title='LiveInternet' " +
        "border='0' width='31' height='31'></a>")
        //--></script>
    <!--/LiveInternet-->
</div>
</body>
</html>
<?php $this->endPage(); ?>