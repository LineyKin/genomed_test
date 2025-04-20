<?php declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class ShortLink extends ActiveRecord
{

    const CHARACTERS = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    public function rules(): array
    {
        return [
            [['original_url'], 'required'],
            [['original_url'], 'url'],
        ];
    }

    public static function tableName(): string {
        return 'short_link';
    }

    public static function generateShortCode($length = 6): string
    {
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= self::CHARACTERS[rand(0, strlen(self::CHARACTERS) - 1)];
        }

        return $code;
    }
}