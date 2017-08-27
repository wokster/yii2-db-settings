<?php
/**
 * Created by internetsite.com.ua
 * User: Tymofeiev Maksym
 * Date: 12.08.2016
 * Time: 16:49
 */

namespace wokster\settings\components;


use wokster\settings\models\Setting;
use yii\base\Component;
use yii;
use yii\helpers\ArrayHelper;


class Settings extends Component
{
  /**
   * @var int
   */
  public $cache_time = 500;
  /**
   * @var
   */
  private $_data;

  /**
   *
   */
  public function init()
  {
    parent::init();
    if($this->_data === null){
      self::setData();
    }
  }

  /**
   * @param $name
   *
   * @return string
   */
  public function get($name, $params = null){
    $data = '';
    if($params != null){
      if(isset($this->_data[$name][$params]))
        $data = $this->_data[$name][$params];
    }else{
      if(isset($this->_data[$name]))
        $data = $this->_data[$name];
    }
    return $data;
  }

  /**
   * @return bool
   */
  public function clear(){
    $cache = Yii::$app->cache;
    $cache->flush();
    $this->_data = null;
    return self::setData();
  }
  public function all(){
    return $this->_data;
  }
  /**
   * @return bool
   */
  private function setData(){
    if (!$data = Yii::$app->cache->get('settings')){
      $data = ArrayHelper::map(Setting::find()->all(),'code','value');
      Yii::$app->cache->set('settings', $data);
    }
    $this->_data = $data;
    return true;
  }
}