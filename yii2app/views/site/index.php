<?php
use app\widgets\Carousel;
use \yii\helpers\Html;
use \yii\helpers\Url;

$page = \app\models\Pages::findOne(1);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $page->seo_keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $page->seo_description
]);
$this->title = $page->seo_title;

$route = 'site/info';

$this->registerCssFile("/css/main-page.css", [
    'depends' => [\app\assets\AppAsset::className()],
], 'main-page-css');
$this->registerJSFile("/js/main-page.js", [
    'depends' => [\app\assets\AppAsset::className()],
], 'main-page-js');
$beginYear = 1993;
$banners = \app\models\Banners::findActive();
$items = [];
$indicators = [];
foreach( $banners as &$banner) {
    $items[] = $banner->getContent();
}

$reviewsData = \app\models\Reviews::find()->all();
$reviews = [];
foreach ($reviewsData as $review) {
    $html = Html::beginTag('div', ['class' => 'col-sm-12']);

    $html.= Html::beginTag('div', ['class' => 'col-sm-12 text-left quote']);
    $html .= strip_tags($review->text, '<img>');
    $html.= Html::beginTag('div', ['class' => 'text-right text-blue subquote']);
    $html.= $review->name . ', компания &laquo;'.$review->company.'&raquo;';
    $html.= Html::endTag('div');
    $html.= Html::endTag('div');
    $html.= Html::endTag('div');

    $reviews[] = $html;
}

?>
<div class="main-page__carousel hidden-xs hidden-xs">
    <?php
    echo Carousel::widget([
        'items' => $items,
        'id' => 'main-page__carousel',
        'options' => [
            'class' => 'slide'
        ]
    ]);
    ?>
</div>
<div class="container main-page__container">
    <div class="row">
        <div class="col-xs-12">
            ${MAIN_PAGE_TEXT}
            <a id="collapse-control" class="collapse-control" data-toggle="collapse" data-target="#collapse"
               aria-expanded="false"
               aria-controls="collapse"><b>Подробнее</b></a>
            <p>&nbsp;</p>
            <div id="collapse" aria-expanded="false" class="collapse">
                <?= $page->getText() ?>
            </div>
        </div>

    </div>
</div>
<div class="main-page__principles-block">
    <div class="container">
        <div class="main-page__block text-center">
            <?php
            $principles = \app\models\Principles::find()->all();
            ?>
            <span class="h3 text-red">Наши принципы</span>
            <div class="row">
                <?php foreach($principles as $principe) {?>
                <div class="col-md-4 col-sm-6 col-xs-12 teaser">
                    <div class="teaser-image teaser-image-<?=$principe->key?>"></div>
                    <div class="teaser-title"><?=$principe->title?></div>
                    <div class="teaser-caption"><?= $principe->text ?></div>
                </div>
                <?php } ?>
            </div>
            <a class="main-page__button" href="<?=Url::to([$route, 'alias' => 'ceny' ])?>">Посмотреть прайс</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="main-page__block text-center">
        <span class="h3 text-blue">Для наших клиентов</span>
        <div class="row principles">
            <div class="col-md-6 text-left">
                <ul>
                    <li>Охраны любой сложности</li>
                    <li>Пост охраны - в день обращения</li>
                    <li>Весь спектр охранных услуг</li>
                    <li>Связи и коммуникации</li>
                    <li>Служба оперативного реагирования</li>
                    <li>100% квалифицированный персонал</li>
                </ul>
            </div>
            <div class="col-md-6 text-left">
                <ul>
                    <li>Подбор кадров - под Заказчика</li>
                    <li>Различные варианты экипировки</li>
                    <li>Вооружения, спецсредства, связь</li>
                    <li>Техничка и оборудования</li>
                    <li>Сторожевые собаки</li>
                    <li>Лучшее соотношение &laquo;цена - качество&raquo;</li>
                </ul>
            </div>
        </div>
        <a class="main-page__button" href="<?=Url::to(['site/pending'])?>">Заказать консультацию</a>
    </div>
</div>
<div class="main-page__digits">
    <div class="container">
        <div class="main-page__block">
            <div class="row">
                <div class="col-xs-12 col-sm-4 text-center">
                    <span class="h1 text-blue"><?=$beginYear?></span>
                    <p>
                        <?=(date('Y') - $beginYear)?> года на страже Вашей безопасности
                    </p>
                </div>
                <div class="col-xs-12 col-sm-4 text-center">
                    <span class="h1 text-blue">385</span>
                    <p>385 защищённых объектов</p>
                </div>
                <div class="col-xs-12 col-sm-4 text-center">
                    <span class="h1 text-blue">250</span>
                    <p>250 квалифицированных специалистов</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="main-page__block main-page__block-safety text-center">
        <span class="h3">Под нашей надежной защитой</span>
        <?= $this->render('under_cover', ['route' => $route]); ?>
    </div>
</div>

<div class="main-page__reviews hidden-xs">
    <div class="container">
        <div class="main-page__block text-center">
            <span class="h3 text-red ">Отзывы наших клиентов</span>
            <?php
            echo Carousel::widget([
                'items' => $reviews,
                'id' => 'main-page__carousel-reviews',
                'options' => [
                    'class' => 'slide'
                ]
            ]);
            ?>
        </div>
    </div>
</div>
