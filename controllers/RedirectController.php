<?php

namespace app\controllers;

use app\helpers\DebugHelper;
use app\models\ShortLink;
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

        $this->redirect($shortLink->original_url);
    }

}