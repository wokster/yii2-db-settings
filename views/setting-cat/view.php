<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\main\models\SettingCat */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-cat-view">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                        'confirm' => 'Вы уверены, что хотите безвозвратно удалить категорию?',
                        'method' => 'post',
                        ],
                        ]) ?>
                    </div>
                </div>
                <div class="box-body">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    
																		'id',
                                    'name',
                                    'info',
                                    'icon:raw',
                                    'sort',
                                                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
