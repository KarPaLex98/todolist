<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%todo}}`.
 */
class m190505_235741_create_todo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%todo}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->bigInteger(),
            'title' => $this->string(255),
            'description' => $this->text(),
            'is_done' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%todo}}');
    }
}
