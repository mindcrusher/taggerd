<?php
$this->title = !empty($page->seo_title) ? $page->seo_title : $page->title;
?>
<div class="container">
    <h1><?=$page->title?></h1>
    <?php if(!empty($page->description)) {?>
        <blockquote><?=$page->description?></blockquote>
    <?php } ?>
    <?=$page->text?>
</div>
