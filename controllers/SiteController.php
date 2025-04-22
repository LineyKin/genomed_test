<?php

namespace app\controllers;

use app\helpers\DebugHelper;
use app\models\ShortLink;
use Yii;
use yii\web\Controller;
use yii\web\Response;


class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLink()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new ShortLink();
        $model->original_url = Yii::$app->request->post('link');
        if(!$model->validate()) {
            Yii::$app->response->statusCode = 400;
            return Yii::$app->response->data = [
                'message' => 'Ссылка не валидна',
            ];
        }

        if (!$model->checkUrlAvailability()) {
            Yii::$app->response->statusCode = 400;
            return Yii::$app->response->data = [
                'message' => 'Данный URL не доступен',
            ];
        }

        if (!$model->checkOriginalUrl()) {
            $model->save();
        }

        return Yii::$app->response->data = [
            'original_link' => $model->original_url,
            'short_link' => $model->create()
        ];
    }
}
