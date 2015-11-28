<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="header-bg header-block">
    <div class="container">
        <a href="/" class="header-logo"></a>
        <div class="row">
            <div class="col-md-2 hidden-sm"></div>
            <div class="row col-md-4 col-sm-12 text-white">
                <div class="header-contact-block ">
                    <div class="header-contact-block__phone">
                        <span class="icon icon-phone-large"></span>
                        +7 (495) 78-262-87
                        <div class="header-contact-block__phone-text">
                            Ежедневно с 9:00 до 22:00<br/>
                            без выходных и праздников
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-md-6 hidden-sm">

                    <?php
                    echo Nav::widget([
                        'items' => [
                            ['label' => '<span class="header-block__icon header-block__feedback-icon"></span>Обратная связь',
                                'url' => ['/site/contact'],
                                'encode' => false,
                                'linkOptions' => [
                                    'class' =>  'showModalButton',
                                    'data-target' => '#pending-form',
                                    'data-toggle' => 'modal',
                                    'title' => 'Обратная связь',
                                ]],
                            ['label' => '<span class="header-block__icon header-block__pending-icon"></span>Онлайн заявка',
                                'encode' => false,
                                'url' => ['/site/pending'], 'linkOptions' => [
                                'class' =>  'showModalButton',
                                'data-target' => '#pending-form',
                                'data-toggle' => 'modal',
                                'title' => 'Заявка онлайн',
                            ]],
                            ['label' => '<span class="header-block__icon header-block__calculator-icon"></span>Калькулятор',
                                'encode' => false,
                                'url' => ['/calc/default/index']],
                        ],
                        'options' => [
                            'class' => 'navbar-nav navbar-right navbar-short-menu hidden-xs text-yellow '
                        ],
                    ]);
                    ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
                // $hasMenu = !empty(Yii::$app->controller->menu[4]);
                // if($hasMenu) {
                ?>
                <?php
                $menu = Yii::$app->controller->menu[2];
                $menu['options'] = [
                    'class' => 'navbar-nav navbar-right navbar-horizontal-menu hidden-xs text-white'
                ];
                echo Nav::widget([
                    'items' => [
                        ['label' => 'О компании', 'url' => ['/site/contact']],
                        ['label' => 'Услуги', 'url' => ['/site/contact']],
                        ['label' => 'Цены', 'url' => ['/site/contact']],
                        ['label' => 'Новости и статьи', 'url' => ['/site/contact']],
                        ['label' => 'Партнерам', 'url' => ['/site/contact']],
                        ['label' => 'Контакты', 'url' => ['/site/contact']],
                    ],
                    'options' => [
                        'class' => 'navbar-nav navbar-right navbar-horizontal-menu hidden-xs text-white'
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<?=$content?>
<div class="container">
    <div class="row footer">
        <div class="col-sm-4">
            <?php foreach(app\models\Contacts::findAllActive() as $contact) { ?>
                <div><span class="<?=$contact->icon()?>" aria-hidden="true"></span> &nbsp;<?=$contact->formatted();?></div>
            <? } ?>
        </div>
        <div class="col-sm-4 hidden-xs">
            <?php
            if(!empty(Yii::$app->controller->menu)) {
                echo Menu::widget(Yii::$app->controller->menu[5]['links']);
            }
            ?>
        </div>
        <div class="col-sm-4">somtehting else</div>
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


</body>
</html>
<?php $this->endPage() ?>
