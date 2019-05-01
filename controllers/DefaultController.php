<?php

namespace wokster\settings\controllers;

use wokster\settings\models\Setting;
use wokster\settings\models\SettingCat;
use wokster\settings\models\SettingValue;
use wokster\settings\models\SettingValueText;
use wokster\settings\models\SettingVariant;
use wokster\settings\models\UpdateSingleTextForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete-cat' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => \Yii::$app->controller->module->allRedactorImageUrl, // Directory URL address, where files are stored.
                'path' => \Yii::$app->controller->module->redactor_upload_path_alias, // Or  absolute path to directory where files are stored.
                'type' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif']],
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => \Yii::$app->controller->module->redactorImageUrl, // Directory URL address, where files are stored.
                'path' => \Yii::$app->controller->module->redactorPath, // Or absolute path to directory where files are stored.
            ],
        ];
    }
    public function actionIndex()
    {
        $model = SettingCat::find()->with('settings')->orderBy(['sort'=>SORT_ASC])->all();
        return $this->render('index',['model'=>$model]);
    }

    /**
     * Displays a single Setting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cat=null)
    {
        $model = new Setting();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            if($cat != null)
                $model->category_id = $cat;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            $name = 'val_'.$model->type;
            $model->$name = $model->value;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdateSingleText($title, $text)
    {
        $model = new UpdateSingleTextForm();
        if(!$model->fill($title, $text))
            throw new NotFoundHttpException();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->settings->clear();
            return $this->redirect(['view-single-text','title'=>$title, 'text'=>$text]);
        } else {
            return $this->render('update_single_text', [
                'model' => $model,
            ]);
        }
    }
    public function actionViewSingleText($title, $text)
    {
        $model = new UpdateSingleTextForm();

        if(!$model->fill($title, $text))
            throw new NotFoundHttpException();

        return $this->render('view_single_text',['model'=>$model]);
    }

    /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($del = SettingValue::find()->where(['setting_id'=>$id])->all())
        {
            foreach($del as $val)
            {
                $val->delete();
            }
        }
        if($del = SettingValueText::find()->where(['setting_id'=>$id])->all())
        {
            foreach($del as $val)
            {
                $val->delete();
            }
        }
        if($varia = SettingVariant::find()->where(['setting_id'=>$id])->all())
        {
            foreach($del as $val)
            {
                $val->delete();
            }
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new SettingCat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateCat()
    {
        $model = new SettingCat();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create-cat', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SettingCat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateCat($id)
    {
        $model = $this->findCatModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update-cat', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SettingCat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteCat($id)
    {
        if($model = $this->findCatModel($id))
        {
            if(!$model->getSettings()->count > 0)
            {
                $model->delete();
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SettingCat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingCat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCatModel($id)
    {
        if (($model = SettingCat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
