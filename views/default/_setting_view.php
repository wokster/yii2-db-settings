<?php
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;
/**
 * Created by internetsite.com.ua
 * User: Tymofeiev Maksym
 * Date: 05.05.2017
 * Time: 17:34
 */
/* @var $model \wokster\settings\models\Setting*/
?>
<div class="pull-right">
<span class="label label-primary"><?=$model->name?></span>
<span class="label label-primary"><?=$model->code?></span>
<span class="label label-primary"><?=$model->typeName?></span>
</div>
<div class="">
<?php switch ($model->type){
  case 0:
  case 2:
  case 9:
    echo $model->value;
    break;
  case 3:
    echo \yii\helpers\StringHelper::truncateWords(strip_tags($model->value),10);
    break;
  case 5:
    echo implode(',',$model->value);
    break;
  case 7:
    echo Html::img($model->value['50x50']);
    break;
  default:
    echo '';
}
?>
</div>
