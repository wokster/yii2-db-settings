<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \wokster\settings\models\Setting */

$this->title = Yii::t('app', 'Создать Настройку');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Настройки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
