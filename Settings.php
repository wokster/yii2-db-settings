<?php

namespace wokster\settings;

use yii\helpers\Url;

class Settings extends \yii\base\Module
{
    public $controllerNamespace = 'wokster\settings\controllers';
    public $upload_folder_name = 'setting';
    public $upload_path_alias = '@upload';
    public $redactor_upload_path_alias = '@upload/redactor';
    public $image_url;
    public $redactor_image_url;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function getImagePath(){
        return \Yii::getAlias($this->upload_path_alias).'/'.$this->upload_folder_name;
    }

    /*
     * @return string
     */
    public function getRedactorPath(){
        return \Yii::getAlias($this->redactor_upload_path_alias).'/'.$this->upload_folder_name;
    }

    /**
     * @return string
     */
    public function getImageUrl(){
        return (empty($this->img_url))?str_replace('admin.','',Url::home(true)).'upload/'.$this->upload_folder_name:$this->img_url;
    }

    /**
     * @return string
     */
    public function getRedactorImageUrl(){
        return (empty($this->redactor_img_url))?str_replace('admin.','',Url::home(true)).'upload/redactor/'.$this->upload_folder_name.'/':$this->redactor_img_url;
    }

    /**
     * @return string
     */
    public function getAllRedactorImageUrl(){
        return (empty($this->redactor_img_url))?str_replace('admin.','',Url::home(true)).'upload/redactor/':$this->redactor_img_url;
    }
}
