<?php
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
/**
 * Created by internetsite.com.ua
 * User: Tymofeiev Maksym
 * Date: 03.05.2017
 * Time: 18:54
 */
/* @var $this \yii\web\View  */
/* @var $model \wokster\settings\models\SettingCat */
$items = [];
if($model->settings):
  foreach ($model->settings as $one){
    /* @var $one \wokster\settings\models\Setting*/
    $tools = Html::tag('span',$one->code,['class'=>'label label-primary']).' '.Html::a(FA::icon('edit'), ['update', 'id' => $one->id], [
        'class' => 'btn btn-xs btn-default',
    ]).Html::a(FA::icon('remove'), ['delete', 'id' => $one->id], [
            'class' => 'btn btn-xs btn-warning',
            'data' => [
                'confirm' => 'Вы уверены, что хотите безвозвратно удалить эту настройку?',
                'method' => 'post',
            ],
        ]);
    $items[] = ['label'=>$one->name, 'tools'=>$tools,'content'=>$this->render('_setting_view',['model'=>$one])];
  }
?>
  <?=\wokster\settings\components\Collapse::widget([
    'items'=>$items,
    'encodeLabels' => false,
]);?>
<?php endif;
