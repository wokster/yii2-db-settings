<?php

namespace wokster\settings\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "setting_cat".
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property string $icon
 * @property string $sort
 */
class SettingCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['sort'], 'integer', 'min' => 1, 'max' => 99],
            ['sort', 'default', 'value' => 70],
            [['info', 'icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'info' => 'Описание',
            'icon' => 'Иконка',
            'sort' => 'Сортировка',
        ];
    }
    public function getSettings()
    {
        return $this->hasMany(Setting::className(),['category_id'=>'id']);
    }
    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(),'id','name');
    }
    public function getHtmlIcon()
    {
        return '<i class="fa fa-'.$this->icon.'"></i>';
    }
}
