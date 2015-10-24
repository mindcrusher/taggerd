<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'photo_id',
                'value' => function( $model ) {
                    if($model->file) {
                        return Html::img($model->file->src, ['width' => '250']);
                    }
                },
                'format' => 'raw'
            ],
            'begin_time',
            'end_time',
            [
                'attribute' => 'is_active',
                'value' => function($model) {
                    return \app\components\Helper::boolLabel($model);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
