<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\main\models\SettingCat */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-cat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
