<?php

use yii\db\Migration;

class m250420_182509_create_redirects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('redirects', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(15)->notNull(),
            'short_link_id' => $this->integer(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('redirects');
    }
}
