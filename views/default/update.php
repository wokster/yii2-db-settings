<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model \wokster\settings\models\Setting */

$this->title = Yii::t('app', 'Редактировать Настройку: ', [
    'modelClass' => 'Setting',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Настройки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
Yii::$app->getUser()->setReturnUrl(Yii::$app->request->url);
?>
<div class="setting-update">
    <div class="setting-form">
        <?php $form = ActiveForm::begin([
            'options'=>['enctype'=>'multipart/form-data']
        ]); ?>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Произвольное название на любом языке, описывающее данную настройку.') ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true,'disabled'=>'disabled'])?>
            </div>
            <div class="col-xs-12 col-md-4">
                <?= $form->field($model, 'typeName')->textInput(['maxlength' => true,'disabled'=>'disabled']) ?>
                <?= $form->field($model, 'type')->label(false)->hiddenInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <?= $form->field($model, 'info')->textarea(['row'=>'4'])->hint('Произвольный не обязательный текст для подробного описания или нюансов. Можно использовать html теги.') ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <?= $form->field($model, 'category_id')->dropDownList(\wokster\settings\models\SettingCat::getList())->hint('Категория настройки для более удобной новигации и быстрого доступа.') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php switch($model->type){
                    case 1:
                        echo '<div id="val_1" class="colapse-val">
                    <div class="form-group field-setting-val_1 has-success">
                        <label class="control-label" for="setting-val_1">Значение</label>
                        <input type="number" id="setting-val_1" class="form-control" name="Setting[val_1]" maxlength="255" value="'.$model->val_1.'">
                        <div class="help-block"></div>
                    </div>
                </div>';
                        break;
                    case 2:
                        echo '<div id="val_2">
                    <div class="form-group field-setting-val_2 has-success">
                        <label class="control-label" for="setting-val_2">Значение</label>
                        <input type="text" id="setting-val_2" class="form-control" name="Setting[val_2]" maxlength="255" placeholder="Впишите значение" value="'.$model->val_2.'">
                        <div class="help-block"></div>
                    </div>
                </div>';
                        break;
                    case 3:
                        echo '<div id="val_3" >
                    <div class="form-group field-setting-val_3 has-success">
                        <label class="control-label" for="setting-val_3">Значение</label>
                        <div class="col-xs-12">';
                        echo $form->field($model, 'val_3',['template'=>'{input}'])->widget(Widget::className(), [
                            'settings' => [
                                'lang' => 'ru',
                                'minHeight' => 200,
                                'pastePlainText' => true,
                                'imageUpload' => \yii\helpers\Url::toRoute(['/settings/default/image-upload']),
                                'imageManagerJson' => \yii\helpers\Url::toRoute(['/settings/default/images-get']),
                                'replaceDivs' => false,
                                'formattingAdd' => [
                                    [
                                        'tag' => 'p',
                                        'title' => 'text-success',
                                        'class' => 'text-success'
                                    ],
                                    [
                                        'tag' => 'p',
                                        'title' => 'text-danger',
                                        'class' => 'text-danger'
                                    ],
                                ],
                                'plugins' => [
                                    'fullscreen',
                                    'table',
                                    'imagemanager'
                                ]
                            ]
                        ]);
                        echo '</div>
                        <div class="help-block"></div>
                    </div>
                </div>';
                        break;
                    case 4:
                        echo '<div id="val_4" >
                    <div class="form-group field-setting-val_4 has-success">
                        <label class="control-label" for="setting-val_4">Значение</label>
                        <div class="col-xs-12">';
                        echo \dosamigos\switchinput\SwitchBox::widget([
                            'name' => 'Setting[val_4]',
                            'checked' => $model->val_4,
                            'clientOptions' => [
                                'onColor' => 'success',
                                'onText' => 'да',
                                'offColor' => 'default',
                                'offText' => 'нет'
                            ]
                        ]);
                        echo '</div>
                        <div class="help-block"></div>
                    </div>
                </div>';
                        break;
                    case 5:
                        echo '<div id="val_5" >
                    <div class="form-group field-setting-val_5 has-success">
                        <label class="control-label" for="setting-val_5">Значение</label>
                        <div class="col-xs-12">';
                        echo \kartik\select2\Select2::widget([
                            'name' => 'Setting[val_5]',
                            'value' => $model->val_5,
                            'data' => $model->val_5,
                            'options' => ['placeholder' => 'Впишите через запятую', 'multiple' => true],
                            'pluginOptions' => [
                                'tags' => true,
                                'maximumInputLength' => 200,
                                'tokenSeparators' => ','
                            ],
                        ]);
                        echo '</div>
                        <div class="help-block"></div>
                    </div>
                </div>';
                        break;
                    case 7:
                        echo '<div id="val_7" >
                    <div class="form-group field-setting-val_7 has-success">
                        <label class="control-label" for="setting-val_7">Значение</label>';

                        echo '<div class="form-group field-setting-val_7 has-success">
                                <label class="control-label" for="setting-val_7">url</label>
                                <div class="help-block"></div>
                                    <input type="hidden" id="setting-val_7" class="form-control" name="Setting[val_7]" maxlength="255" value="0">';
                        echo $form->field($model, 'file', ['template'=>'{input}{error}'])->widget(FileInput::className(),[
                            'options'=>[
                                'multiple'=>false,
                                'accept' => 'image/*'
                            ],
                            'pluginOptions' => [
                                'showRemove' => false,
                                'showUpload' => false,
                                'showCaption' => false,
                                'initialPreview'=>\yii\bootstrap\Html::a(\yii\bootstrap\Html::img($model->value['300x'],['style'=>'height:auto; width:300px;']),$model->value['original'],['target'=>'_blank']),
                                'overwriteInitial'=>true,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                'browseLabel' =>  'Select Photo'
                            ]
                        ]);
                        echo '</div>';

                        echo '
                        <div class="help-block"></div>
                    </div>
                </div>';
                        break;
                    case 8:
                        echo '<div id="val_8">
                <div class="form-group field-setting-val_8 has-success">
                    <label class="control-label" for="setting-val_8">Значение</label>
                    <textarea rows="20" id="setting-val_8" class="form-control" name="Setting[val_8]" maxlength="4000000" placeholder="Вставьте код сюда">'.$model->val_8.'</textarea>
                    <div class="help-block"></div>
                </div>
            </div>';
                    break;

                    case 9:
                        echo '<div id="val_9">
                <div class="form-group field-setting-val_9 has-success">
                    <label class="control-label" for="setting-val_9">Значение</label>';
                    echo \wokster\yandexmap\YandexGetCoordsWidget::widget(['model'=>$model,'attribute'=>'val_9']);
                    echo '<div class="help-block"></div>
                </div>
            </div>';
                        break;

                }?>
            </div>
            <div class="col-xs-12 form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <?php
    if($model->type == 7)
    {
        Modal::begin([
            'id' => 'ajax-image',
            'header' => '<h4>Добавить фото</h4>',
            'size' => Modal::SIZE_LARGE,
            'toggleButton' => false,
        ]);
        echo '<div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">загружаю</span>
                            </div>
                        </div>';
        Modal::end();
    }
    ?>
    <?php $this->registerJs("
$('#setting-type').on('change',function(){
    var type = $('#setting-type option:selected').val();
    $('.colapse-val').hide();
    $('#val_' + type).show(500);
});

$('#ajax-image').on('shown.bs.modal', function () {
                var modal = $(this);
                  $.get('/main/image/ajax-create?modul_name=backend\\\\modules\\\\main\\\\models\\\\Setting&modul_item_id=".$model->id."',function(data){
                   modal.find('.modal-body').html(data);
                  });
                });
")?>

</div>
