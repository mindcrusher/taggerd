<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Principles */

$this->title = Yii::t('app', 'Create Principles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Principles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="principles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
