<?php

namespace wokster\settings\models;

use wokster\behaviors\ImageUploadBehavior;
use yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $info
 * @property integer $type
 * @property integer $category_id
 */
class Setting extends \yii\db\ActiveRecord
{
    public $val_1;
    public $val_2;
    public $val_3;
    public $val_4;
    public $val_5;
    public $val_6;
    public $val_7;
    public $val_8;
    public $val_9;
    public $file;
    public $image_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => ImageUploadBehavior::className(),
                'dir_name' => 'setting',
                'attribute' => 'image_name',
                'random_name' => true,
                'image_path' => Yii::$app->modules['settings']->imagePath,
                'image_url' => Yii::$app->modules['settings']->imageUrl,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'type', 'category_id'], 'required'],
            [['type', 'category_id'], 'integer'],
            [['info'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['code'], 'unique'],
            [['code'], 'match', 'pattern' =>  '/^[a-zA-Z0-9-_]+$/', 'message'=>'допускаются только маленькие и большие латинские буквы, цифры, знак подчеркивания и тире, от 3 до 50 символов'],
            [['sort'], 'integer', 'min' => 1, 'max' => 99],
            ['sort', 'default', 'value' => 70],
            [['val_1'], 'integer'],
            [['val_2','val_9','image_name'], 'string', 'max' => 500],
            [['val_7'], 'string', 'max' => 255],
            [['val_8'], 'string', 'max' => 4000000],
            [['val_3'], 'string', 'max' => 4000000],
            [['val_5'], 'safe'],
            [['val_4'], 'boolean'],
            [['val_6'], 'integer'],
            [['file'], 'file', 'maxSize' => 2097152],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'name' => 'Название',
            'info' => 'Описание',
            'type' => 'Тип',
            'category_id' => 'Категория',
            'file' => 'Картинка',
            'image_name' => 'Имя файла',
        ];
    }
    public static function getTypeList()
    {
        return [
            '1' => 'Число',
            '2' => 'Строка',
            '3' => 'Текст',
            '4' => 'ДА/НЕТ',
            '5' => 'Ряд данных',
            //'6' => 'Выбор из вариантов',
            '7' => 'Картинка',
            '8' => 'Html код',
            '9' => 'Координаты',
        ];
    }
    public function getTypeName()
    {
        $list = self::getTypeList();
        return $list[$this->type];
    }
    public function getCat()
    {
        return $this->hasOne(SettingCat::className(),['id'=>'category_id']);
    }
    public function getSettingValue()
    {
        return $this->hasOne(SettingValue::className(),['setting_id'=>'id']);
    }
    public function getSettingValues()
    {
        return $this->hasMany(SettingValue::className(),['setting_id'=>'id']);
    }
    public function getSettingValueText()
    {
        return $this->hasOne(SettingValueText::className(),['setting_id'=>'id']);
    }

    public function afterFind()
    {
        $this->image_name = (($this->type == 7) and $this->settingValue)?$this->settingValue->setting_value:null;
    }

    public function getValue()
    {
        switch($this->type){
            case 1:
                $data = ($this->settingValue)?$this->settingValue->setting_value:0;
                break;
            case 2:
            case 9:
                $data = ($this->settingValue)?$this->settingValue->setting_value:'';
                break;
            case 8:
            case 3:
                $data = ($this->settingValueText)?$this->settingValueText->setting_value:'';
                break;
            case 4:
                $data = ($this->settingValue)?(bool)$this->settingValue->setting_value:false;
                break;
            case 5:
                $data = ArrayHelper::map($this->getSettingValues()->asArray()->all(),'setting_value','setting_value');
                break;
            case 6:
                $data = ($this->settingValue)?$this->settingValue->setting_value:null;
                break;
            case 7:
                $imagename = ($this->settingValue)?$this->settingValue->setting_value:false;
                $path = \Yii::$app->getModule('settings')->imageUrl;
                $data = [
                    'title'=> $this->name,
                    'image_name'=>$imagename,
                    ];
                foreach ($this->getSizesForResize() as $size){
                    $dir = $size[0].'x';
                    if($size[2])
                        $dir .= $size[1];
                    $data[$dir] = $path.'/'.$dir.'/'.$imagename;
                }
                $data['original'] = $path.'/'.$imagename;
                break;
            default:
                $data = null;
        }
        return $data;
    }
    public function getSizesForResize()
    {
        return [
            [1000, null, false],
            [300, null, false],
            [400, 400, true],
            [100, null, false],
            [50, 50, true]
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {
        if(!empty($this->id)){
            $flag = false;
            switch($this->type)
            {
                case 3:
                case 8:
                    if(!$val = $this->settingValueText){
                     $val = new SettingValueText();
                    }
                    $val->setting_id = $this->id;
                    $num = 'val_'.$this->type;
                    $val->setting_value = $this->$num;
                    if($val->save())
                        $flag = true;
                    break;
                case 4:
                    if(!$val = $this->settingValue){
                        $val = new SettingValue();
                    }
                    $val->setting_id = $this->id;
                    if(isset($_POST['Setting']['val_4']))
                    {
                        $val->setting_value = '1';
                    }else{
                        $val->setting_value = '0';
                    }
                    if($val->save())
                        $flag = true;
                    break;
                case 5:
                    $old = $this->settingValues;
                    foreach($old as $old_one){
                        $old_one->delete();
                    }
                    foreach($this->val_5 as $one){
                        $val = new SettingValue();
                        $val->setting_id = $this->id;
                        $val->setting_value = $one;
                        if($val->save()){
                            $flag = true;
                        }else{
                            break;
                        }
                    }
                    break;
                case 7:
                    $flag = false;
                    if(!empty($this->image_name)) {
                        if (!$setting_value = $this->settingValue) {
                            $setting_value = new SettingValue();
                            $setting_value->setting_id = $this->id;
                        }
                        $setting_value->setting_value = $this->image_name;
                        if($setting_value->save()){
                            $flag = true;
                        }
                    }
                    break;
                default:
                    if(!$val = $this->settingValue){
                        $val = new SettingValue();
                        $val->setting_id = $this->id;
                    }
                    $num = 'val_'.$this->type;
                    $val->setting_value = $this->$num;
                    if($val->save())
                        $flag = true;
            }
            if ($flag) {
                \Yii::$app->session->addFlash('success', 'Настройка успешно сохранена');
            } else {
                \Yii::$app->session->addFlash('error', 'Произошла ошибка при сохранении.');
            }
            \Yii::$app->settings->clear();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
