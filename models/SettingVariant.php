<?php

namespace wokster\settings\models;

use Yii;

/**
 * This is the model class for table "setting_variant".
 *
 * @property integer $id
 * @property integer $setting_id
 * @property string $variant
 */
class SettingVariant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_variant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_id'], 'required'],
            [['variant'], 'string', 'max' => 50],
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
            'variant' => 'variant',
        ];
    }
}
