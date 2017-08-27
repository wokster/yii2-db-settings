<?php

namespace wokster\settings\models;

use Yii;
use yii\base\Model;


class UpdateSingleTextForm extends Model
{

    public $title;
    public $text;

    private $_title_id;
    private $_text_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            ['title', 'string', 'max' => 50],
            ['text', 'string', 'max' => 4000000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заглавие',
            'text' => 'Контент',
        ];
    }
    public function fill($id_title,$id_text)
    {
        if(($model = Setting::find()->where(['code'=>$id_title])->one()) and ($model_text = Setting::find()->where(['code'=>$id_text])->one())){
            $this->title = $model->getValue();
            $this->_title_id = $model->id;
            $this->text = $model_text->getValue();
            $this->_text_id = $model_text->id;
            return true;
        }
        return false;
    }
    public function save()
    {
        $val_title = SettingValue::find()->where(['setting_id'=>$this->_title_id])->one();
        $val_title->setting_value = $this->title;
        $val_text = SettingValueText::find()->where(['setting_id'=>$this->_text_id])->one();
        $val_text->setting_value = $this->text;
        if ($val_title->save() && $val_text->save()) {
            return true;
        } else {
            return false;
        }
    }
}
