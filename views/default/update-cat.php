<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \backend\modules\main\models\SettingCat */

$this->title = Yii::t('app', 'Редактировать Категорию: ', [
    'modelClass' => 'Setting Cat',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="setting-cat-update">

    <?= $this->render('_form-cat', [
        'model' => $model,
    ]) ?>

</div>
