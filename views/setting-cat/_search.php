<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\main\models\SettingCatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-cat-search row">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<div class="col-xs-3">    <?= $form->field($model, 'id') ?>

</div><div class="col-xs-3">    <?= $form->field($model, 'name') ?>

</div><div class="col-xs-3">    <?= $form->field($model, 'info') ?>

</div><div class="col-xs-3">    <?= $form->field($model, 'icon') ?>

</div><div class="col-xs-3">    <?= $form->field($model, 'sort') ?>

</div>    <div class="form-group col-xs-12">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
