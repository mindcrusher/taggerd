<?php
use app\models\Pending;
use yii\bootstrap\Nav;

$this->title = !empty($page->seo_title) ? $page->seo_title : $page->title;
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $page->seo_keywords
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $page->seo_description
]);
?>
<div>
    <div class="<?=Yii::$app->request->isAjax ? '' : 'container' ?> content-text">
        <?php
        switch($page->id) {
            case 3:
                $key = 7;
                break;
            case 28:
                $key = 8;
                break;
            default:
                $key = 0;
        }

        $menu = @Yii::$app->controller->menu[$key];
        if($menu && !Yii::$app->request->isAjax) {
            ?>
            <div class="col-sm-2">
                <?php
                echo Nav::widget([
                    'items' => $menu['links']['items'],
                ]);
                ?>
            </div>
        <?php
        }
        ?>
        <div class="col-sm-" . <?=(isset($menu) ? 10 : 12)?>>
            <h1><?=$page->title?></h1>
            <?php if(!empty($page->description)) {?>
                <blockquote><?=$page->description?></blockquote>
            <?php } ?>
            <?=$page->getText()?>
        </div>
    </div>
<?php
if($page->id == 19) {
    echo $this->render('pending', ['model' => new Pending(), 'showHeader' => false]);
}
?>
</div>

