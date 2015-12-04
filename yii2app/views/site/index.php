<?php
use yii\bootstrap\Carousel;
use \yii\helpers\Html;
use \yii\helpers\Url;

$route = 'site/info';

$this->registerCssFile("/css/main-page.css", [
    'depends' => [\app\assets\AppAsset::className()],
], 'main-page');
$beginYear = 1993;
$banners = \app\models\Banners::findActive();
$items = [];
$indicators = [];
foreach( $banners as &$banner) {
    $items[] = $banner->getContent();
    $indicators[] = $banner->title;
}

$reviewsData = [
    [
        'image' => '/img/reviews-sprite.png',
        'name' => 'Василий Пупкин',
        'company' => 'Мирамакс',
        'text' => 'Работаем с этой конторой несколько лет. Куратор нашего объекта-вменяемый руководитель. Всегда можно решить все вопросы.<br/>И по деньгам нормально . Работой их остаемся весьма и весьма довольны'
    ],
    [
        'image' => '/img/reviews-sprite.png',
        'name' => 'Негоду Лещём',
        'company' => 'Мирамакс',
        'text' => 'Работаем с этой конторой несколько лет. Куратор нашего объекта-вменяемый руководитель. Всегда можно решить все вопросы.<br/>И по деньгам нормально . Работой их остаемся весьма и весьма довольны'
    ],
];
$reviews = [];
foreach ($reviewsData as $review) {
    $html = Html::beginTag('div', ['class' => 'col-sm-3']);
    $html.= Html::img($review['image']);
    $html.= Html::endTag('div');
    $html.= Html::beginTag('div', ['class' => 'col-sm-9 text-left quote']);
    $html.= '&quot;' . $review['text'] . '&quot;';
    $html.= Html::beginTag('div', ['class' => 'text-right text-blue subquote']);
    $html.= $review['name'] . ', компания &laquo;'.$review['company'].'&raquo;';
    $html.= Html::endTag('div');
    $html.= Html::endTag('div');

    $reviews[] = $html;
}

?>
<div class="main-page__carousel hidden-xs hidden-sm">
    <?php
    echo Carousel::widget([
        'items' => $items,
        'id' => 'main-page__carousel'
    ]);
    ?>
    <ol class="carousel-indicators main-page__carousel-carousel-indicators">
        <?php
        foreach( $indicators as $i => &$indicator) {
            echo \yii\bootstrap\Html::tag(
                'li',
                $indicator,
                [
                    'class' => ($i === 0 ? "active" : ""),
                    'onclick' => "$('#main-page__carousel').carousel($i);$('ol li').removeClass('active');$(this).addClass('active');"
                ]
            );
        }
        ?>
    </ol>
</div>
<div class="container main-page__container">
    <div class="row">
        <div class="col-xs-12">
            <p>Группа компаний «ТАГГЕРД» предлагает широкий спектр охранных услуг для юридических и физических лиц в Москве и Подмосковье! Охрана ЧОП - профессионально, надежно, качественно!
            </p>
            <p>Группа компаний «ТАГГЕРД» оказывает профессональные охранные услуги с <?=$beginYear?> года, обеспечивает безопасность больших и малых объектов не только в Москве и Подмосковье, но и в разных регионах России. Многолетний опыт и профессиональный подход позволяют организовать эффективную  комплексную охрану частных лиц, обеспечить защиту предприятий и организаций любых масштабов и форм собственности, сохранность движимого / недвижимого имущества и ТМЦ, защиту информации и экономических интересов от любых противоправных посягательств.
            </p>
            <p>В нашем арсенале имеется необходимое оснащение для оказания комплекса охранных услуг: современное оборудование; средства мобильной радиосвязи; травматическое, газовое, огнестрельное оружие (пистолеты, карабины); спецсредства (наручники, резиновые дубинки, шокеры, бронежилеты и др.), служебная униформа (форменный или классический костюм); сторожевые собаки; бронированные автомобили и иной транспорт.
            </p>
            <p>Зазазать услуги  можно по телефону  +7 (495) 782-6-287 или в режиме ОН-ЛАЙН
            </p>
        </div>
    </div>
</div>
<div class="main-page__principles-block">
    <div class="container">
        <div class="main-page__block text-center">
            <?php
            $principles = [
                'confident' => ['title' => 'Полная конфиденциальность'],
                'complex' => ['title' => 'Комплексная защита'],
                'license' => ['title' => 'Лицензированные охранники'],
                'individual' => ['title' => 'Индивидуальный подход<br/> к каждому объекту'],
                'legal' => ['title' => 'Работаем в соответствии<br/> с законодатльством РФ'],
                'flexible' => ['title' => 'Гибкий подход к любому бюджету'],
            ];
            ?>
            <span class="h3 text-red">Наши принципы</span>
            <div class="row">
                <?php foreach($principles as $chapter => $principe) {?>
                <div class="col-md-4 teaser">
                    <div class="teaser-image teaser-image-<?=$chapter?>"></div>
                    <div class="teaser-title"><?=$principe['title']?></div>
                    <div class="teaser-caption"><?=$principe['title']?></div>
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
                <div class="col-xs-4 text-center">
                    <span class="h1 text-blue"><?=$beginYear?></span>
                    <p>
                        <?=(date('Y') - $beginYear)?> года на страже Вашей безопасности
                    </p>
                </div>
                <div class="col-xs-4 text-center">
                    <span class="h1 text-blue">385</span>
                    <p>385 защищённых объектов</p>
                </div>
                <div class="col-xs-4 text-center">
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
        <div class="row main-page__block-safety-content">
            <?php
            $teasers = [
                ['id' => 'flexible', 'alias' => 'page_30', 'title' => 'Учебные заведения', 'description' => 'Школы, ВУЗы, детские сады'],
                ['id' => 'living', 'alias' => 'page_20', 'title' => 'Жилые помещения', 'description' => 'Парки, дома отдыха, ночные клубы'],
                ['id' => 'auto', 'alias' => 'page_151', 'title' => 'Автотранспортные предприятия', 'description' => 'Автостоянки, автосалоны, гаражи, АЗС'],
                ['id' => 'party', 'alias' => 'page_42', 'title' => 'Массовые мероприятия', 'description' => 'Концерты, свадьбы, соревнования'],
                ['id' => 'vacation', 'alias' => 'page_99', 'title' => 'Места досуга и отдыха', 'description' => 'Парки, дома отдыха, ночные клубы'],
                ['id' => 'offices', 'alias' => 'page_31', 'title' => 'Производственные<br/> предприятия и офисы', 'description' => 'Заводы, фабрики, бизнес-центры'],
                ['id' => 'store', 'alias' => 'page_32', 'title' => 'Магазины', 'description' => 'Торговые центры, супермаркеты'],
                ['id' => 'medical', 'alias' => 'page_43', 'title' => 'Медицинские учреждения', 'description' => 'Поликлиники, больницы, аптеки'],
                ['id' => 'buildings', 'alias' => 'page_34', 'title' => 'Строительные объекты', 'description' => 'Стройплощадки'],
            ];
            foreach( $teasers as $item){?>
                <a href="<?=Url::to([$route, 'alias' => $item['alias']])?>" class="col-md-4 col-sm-6 col-xs-12 teaser">
                    <div class="teaser-image-block">
                        <div class="teaser-image teaser-image-<?=$item['id']?>"></div>
                    </div>
                    <div class="teaser-caption">
                        <div class="teaser-title text-red"><?=$item['title']?></div>
                        <?=$item['description']?>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</div>
<div class="main-page__reviews">
    <div class="container">
        <div class="main-page__block text-center">
            <span class="h3 text-red ">Отзывы наших клиентов</span>
            <?php
            echo Carousel::widget([
                'items' => $reviews,
                'id' => 'main-page__carousel-reviews',
            ]);
            ?>
        </div>
    </div>
</div>
