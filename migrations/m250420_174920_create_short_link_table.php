<?php

use yii\db\Migration;

class m250420_174920_create_short_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('short_link', [
            'id' => $this->primaryKey(),
            'original_url' => $this->string(512)->notNull(),
            'short_code' => $this->string(10)->unique()->notNull(),
            'redirects_count' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('short_link');
    }
}
