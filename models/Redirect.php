<?php

namespace app\models;

use yii\db\ActiveRecord;

class Redirect extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'redirects';
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $shortLink = ShortLink::findOne($this->short_link_id);
            if ($shortLink) {
                $shortLink->updateCounters(['redirects_count' => 1]);
            }
        }
    }

}