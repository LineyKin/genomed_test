<?php

namespace models;

use yii\db\ActiveRecord;

class ShortLink extends ActiveRecord
{
    public $originalUrl;

}