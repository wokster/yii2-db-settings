<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \backend\modules\main\models\UpdateSingleTextForm */

$this->title = $model->title;
?>
<div class="setting-view">

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['/main/default/update-single-text','title'=>'main_block_katerina_title','text'=>'main_block_katerina_text'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="container" style="background: #fff url(<?= Yii::$app->settings->get('main_block_katerina_back','image100')?>) repeat 0 0;">
        <h2><?= $model->title ?></h2>
        <?= $model->text ?>
    </div>

</div>
