<?php
/**
 * Created by internetsite.com.ua
 * User: Tymofeiev Maksym
 * Date: 24.08.2016
 * Time: 15:33
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->title;
?>
<div class="article-form">

  <?php $form = ActiveForm::begin(); ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-default">

        <div class="box-header with-border">
          <h3 class="box-title">Заполните форму</h3>
        </div>

        <div class="box-body">

          <div class="row">
                <div class="col-xs-12">
                  <?= $form->field($model, 'title')->label()->textInput(['maxlength' => true]) ?>
                </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-12">
              <?=  $form->field($model, 'text')->widget(\vova07\imperavi\Widget::className(),[
                  'settings' => [
                      'lang' => 'ru',
                      'minHeight' => 200,
                      'pastePlainText' => true,
                      'imageUpload' => \yii\helpers\Url::to(['/main/image/save-redactor-img','id'=>null,'sub'=>'setting']),
                      'replaceDivs' => false,
                      'plugins' => [
                          'fontcolor',
                          'table',
                          'video',
                          'fontsize',
                          'fullscreen',
                      ]
                  ]
              ]) ?>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-12">
              <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
