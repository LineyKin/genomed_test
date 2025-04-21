<?php

namespace app\controllers;

use app\helpers\DebugHelper;
use app\models\Redirect;
use app\models\ShortLink;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RedirectController extends Controller
{

    public function actionIndex(string $shortCode)
    {
        $shortLink = ShortLink::findOne(['short_code' => $shortCode]);
        if (!$shortLink) {
            throw new NotFoundHttpException("такой сокращённой ссылки не существует");
        }

        $model = new Redirect();
        $model->ip = Yii::$app->request->getUserIP();
        $model->short_link_id = $shortLink->id;
        $model->save();

        $this->redirect($shortLink->original_url);
    }

}