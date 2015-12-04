<?php
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
<div class="<?=Yii::$app->request->isAjax ? '' : 'container'?>">
    <h1><?=$page->title?></h1>
    <?php if(!empty($page->description)) {?>
        <blockquote><?=$page->description?></blockquote>
    <?php } ?>
    <?=$page->getText()?>
</div>
