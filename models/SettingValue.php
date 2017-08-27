<?php

namespace wokster\settings\models;

use Yii;

/**
 * This is the model class for table "setting_value".
 *
 * @property integer $id
 * @property integer $setting_id
 * @property string $setting_value
 */
class SettingValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_id'], 'required'],
            [['setting_value'], 'string', 'max' => 255],
            [['setting_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'setting_id' => 'setting_id',
            'setting_value' => 'Setting Value',
        ];
    }
}
