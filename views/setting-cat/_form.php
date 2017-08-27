<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\main\models\SettingCat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-cat-form">

    <?php $form = ActiveForm::begin([
    ]); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">

                <div class="box-header with-border">
                    <h3 class="box-title">Заполните форму</h3>
                </div>

                <div class="box-body">

                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <?= $form->field($model, 'icon')->widget(\common\widgets\font_awesome\FontAwesomeDropDownWidget::className(),[]) ?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <?= $form->field($model, 'sort')->textInput() ?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12 col-md-12">
                      <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
  <?php ActiveForm::end(); ?>
</div>
