<?php
use yii\helpers\Url;
?>
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
