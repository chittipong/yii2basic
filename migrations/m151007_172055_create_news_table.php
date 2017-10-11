<?php

use yii\db\Schema;
use yii\db\Migration;

class m151007_172055_create_news_table extends Migration
{
    public function up()
    {
        $this->createTable('news',[
            'id'=>Schema::TYPE_PK,
            'title'=>Schema::TYPE_STRING.' NOT NULL',
            'content'=>Schema::TYPE_TEXT
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
