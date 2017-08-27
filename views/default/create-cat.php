<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \backend\modules\main\models\SettingCat */

$this->title = Yii::t('app', 'Создать Категорию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-cat-create">

    <?= $this->render('_form-cat', [
        'model' => $model,
    ]) ?>

</div>
