<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model wokster\settings\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="setting-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true])->hint('Уникальный код, который используется для получнения данных. Только английские символы, тире и знак нижнего подчеркивания.') ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Произвольное название на любом языке, описывающее данную настройку.') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'type')->dropDownList($model->getTypeList())->hint('Тип значения настройки, если не видите разницы - используйте "текст".') ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <div id="val_1" class="colapse-val">
                <div class="form-group field-setting-val_1 has-success">
                    <label class="control-label" for="setting-val_1">Значение</label>
                    <input type="number" id="setting-val_1" class="form-control" name="Setting[val_1]" maxlength="255" value="0">
                    <div class="help-block"></div>
                </div>
            </div>

            <div id="val_2" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_2 has-success">
                    <label class="control-label" for="setting-val_2">Значение</label>
                    <input type="text" id="setting-val_2" class="form-control" name="Setting[val_2]" maxlength="255" placeholder="Впишите значение">
                    <div class="help-block"></div>
                </div>
            </div>
            <div id="val_4" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_4 has-success">
                    <label class="control-label" for="setting-val_4">Значение</label>
                    <div class="col-xs-12">
                        <?= \dosamigos\switchinput\SwitchBox::widget([
                            'name' => 'Setting[val_4]',
                            'checked' => true,
                            'clientOptions' => [
                                'onColor' => 'success',
                                'onText' => 'да',
                                'offColor' => 'default',
                                'offText' => 'нет'
                            ]
                        ]);?>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
            <div id="val_5" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_5 has-success">
                    <label class="control-label" for="setting-val_5">Значение</label>
                    <div class="col-xs-12">
                        <?php
                        echo \kartik\select2\Select2::widget([
                            'name' => 'Setting[val_5]',
                            'value' => [],
                            'data' => [],
                            'options' => ['placeholder' => 'Впишите через запятую', 'multiple' => true],
                            'pluginOptions' => [
                                'tags' => true,
                                'maximumInputLength' => 200,
                                'tokenSeparators' => ','
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
            <div id="val_7" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_7 has-success">
                    <label class="control-label" for="setting-val_7">url</label>
                    <div class="help-block"></div>
                        <input type="hidden" id="setting-val_7" class="form-control" name="Setting[val_7]" maxlength="255" value="0">
                    <?= $form->field($model, 'file', ['template'=>'{input}{error}'])->widget(FileInput::className(),[
                        'options'=>[
                            'multiple'=>false,
                            'accept' => 'image/*'
                        ],
                        'pluginOptions' => [
                            'showRemove' => false,
                            'showUpload' => false,
                            'showCaption' => false,
                            'overwriteInitial'=>true,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  'Select Photo'
                        ]
                    ]);?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'category_id')->dropDownList(\wokster\settings\models\SettingCat::getList())->hint('Категория настройки для более удобной новигации и быстрого доступа.') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="val_3" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_3 has-success">
                    <label class="control-label" for="setting-val_3">Значение</label>
                    <?= $form->field($model, 'val_3',['template'=>'{input}'])->widget(Widget::className(), [
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
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div id="val_8" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_8 has-success">
                    <label class="control-label" for="setting-val_8">Значение</label>
                    <textarea rows="20" id="setting-val_8" class="form-control" name="Setting[val_8]" maxlength="4000000" placeholder="Вставьте код сюда"></textarea>
                    <div class="help-block"></div>
                </div>
            </div>
            <div id="val_9" style="display: none;" class="colapse-val">
                <div class="form-group field-setting-val_9 has-success">
                    <?=\wokster\yandexmap\YandexGetCoordsWidget::widget([
                        'model'=>$model,
                        'attribute'=>'val_9',
                        'autoinit'=>false
                    ])?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= $form->field($model, 'info')->textarea(['row'=>'4'])->hint('Произвольный не обязательный текст для подробного описания или нюансов. Можно использовать html теги.') ?>
        </div>
        <div class="col-xs-12 form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJs("
$('#setting-type').on('change',function(){
    var type = $('#setting-type option:selected').val();
    $('.colapse-val').hide();
    if(type == 9){
    $('#val_' + type).show();
    ymaps.ready(init);
    }else{
        $('#val_' + type).show(500);
    }
});

")?>
