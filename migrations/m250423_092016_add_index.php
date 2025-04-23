<?php

use yii\db\Migration;

class m250423_092016_add_index extends Migration
{
    const TABLE_NAME = 'short_link';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx_original_url', self::TABLE_NAME, 'original_url');
        $this->createIndex('idx_short_code', self::TABLE_NAME, 'short_code');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_original_url', self::TABLE_NAME);
        $this->dropIndex('idx_short_code', self::TABLE_NAME);
    }
}
