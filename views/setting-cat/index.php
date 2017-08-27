<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\main\models\SettingCatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-cat-index row">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <span class="label label-default">записей <?= $dataProvider->getCount()?> из <?= $dataProvider->getTotalCount()?></span>
            </div>
            <div class="box-body">
                        <?= GridView::widget([
            'summary' => '',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'info',
            ['attribute'=>'icon',
            'format'=>'raw',
            'value'=>'htmlIcon',
            ],
            'sort',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
                        </div>
        </div>
    </div>
</div>
