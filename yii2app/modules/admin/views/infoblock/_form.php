<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([ 'contact' => 'Контактные данные', 'other'=> 'Другое' ], ['prompt' => 'Выберите']) ?>
    <?= $form->field($model, 'icon')->dropDownList([ 'phone' => 'Телефон', 'mobile' => 'Мобильный телефон', 'fax' => 'Факс', 'mail' => 'Эл. почта', 'skype' => 'Skype','address'=> 'Адрес' ], ['prompt' => 'Выберите']) ?>
    <?= $form->field($model, 'placeholder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
