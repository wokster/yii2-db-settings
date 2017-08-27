<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_102906_setting extends Migration
{
    public function up()
    {
        $this->createTable('setting',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string(50)->notNull()->unique(),
                'name' => $this->string(50)->notNull(),
                'info' => $this->string(255),
                'type' => $this->integer(1)->notNull(),
                'category_id' => $this->integer(3)->notNull(),
                'sort' => $this->smallInteger(3),
            ]
            );
    }

    public function down()
    {
        echo "m160112_102906_setting cannot be reverted.\n";

        return false;
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
