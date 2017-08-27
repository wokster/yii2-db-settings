<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \wokster\settings\models\SettingCat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-cat-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12 col-sm-8">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Название категории настроек') ?>
    </div>

    <div class="col-xs-12 col-sm-2">
        <?= $form->field($model, 'icon')->widget(\wokster\fontawesomedropdown\FontAwesomeDropDownWidget::className(),[]) ?>
    </div>

    <div class="col-xs-12 col-sm-2">
        <?= $form->field($model, 'sort')->textInput(['maxlength' => true])->hint('порядок сортировки от 1 до 99') ?>
    </div>

    <div class="col-xs-12">
        <?= $form->field($model, 'info')->textarea(['row' => 5])->hint('(не обязательно) описание категории настроек)') ?>
    </div>

    <div class="form-group col-xs-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
