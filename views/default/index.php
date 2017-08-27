<?php

/* @var $this \yii\web\View  */
/* @var $model \wokster\settings\models\SettingCat */
$this->registerAssetBundle('rmrevin\yii\fontawesome\AssetBundle');
$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12" style="padding-bottom: 20px;">
        <div class="btn-group">
            <a href="<?=\yii\helpers\Url::toRoute(['/settings/default/create'])?>" class="btn btn-primary" title="добавить настройку в эту категирию"><i class="fa fa-plus"></i> Добавить настройку
            </a>
            <a href="<?=\yii\helpers\Url::toRoute(['/settings/default/create-cat'])?>" class="btn btn-primary" title="добавить настройку в эту категирию"><i class="fa fa-plus"></i> Добавить категорию настроек
            </a>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($model as $cat):
        /* @var $cat \wokster\settings\models\SettingCat */
    ?>
    <div class="col-xs-12 col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $cat->htmlIcon.' '.$cat->name?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?= $this->render('_cat_view',['model'=>$cat])?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <?php endforeach;?>
</div>
