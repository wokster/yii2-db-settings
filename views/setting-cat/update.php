<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\main\models\SettingCat */

$this->title = 'Редактировать категорию: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="setting-cat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
