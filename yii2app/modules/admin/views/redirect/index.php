<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Redirect Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirect-rules-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Redirect Rules'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'from',
            'to',
            'status_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
