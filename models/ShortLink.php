<?php declare(strict_types=1);

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class ShortLink extends ActiveRecord
{

    const CHARACTERS = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const SHORT_CODE_LENGTH = 6;

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

    /**
     * генерирует код сокращённой ссылки
     * @return string
     */
    public static function generateShortCode(): string
    {
        $code = '';

        for ($i = 0; $i < self::SHORT_CODE_LENGTH; $i++) {
            $code .= self::CHARACTERS[rand(0, strlen(self::CHARACTERS) - 1)];
        }

        return $code;
    }

    /**
     * Проверяет есть ли в базе оригинальная ссылка.
     * Если есть - берёт код сокращённой ссылки оттуда
     *
     * @return bool
     */
    public function checkOriginalUrl(): bool
    {
        $data = self::find()->where(['original_url' => $this->original_url])->one();
        if(is_null($data)) {
            return false;
        }

        $this->short_code = $data->short_code;
        return true;
    }

    /**
     * Проверяет доступность ссылки
     *
     * @return bool
     */
    public function checkUrlAvailability(): bool
    {
        $ch = curl_init($this->original_url);

        curl_setopt_array($ch, [
            CURLOPT_NOBODY => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0'
        ]);

        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 400;
    }

    /**
     * создаёт сокращённую ссылку
     *
     * @return string
     */
    public function create(): string
    {
        return Yii::$app->urlManager->createAbsoluteUrl(['go/' . $this->short_code]);
    }

    /**
     * проверяет short_code на уникальность
     *
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                do {
                    $this->short_code = self::generateShortCode();
                }
                while (self::find()->where(['short_code' => $this->short_code])->exists());
            }

            return true;
        }

        return false;
    }
}