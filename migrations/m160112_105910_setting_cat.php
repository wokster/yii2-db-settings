<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_105910_setting_cat extends Migration
{
    public function up()
    {
        $this->createTable('setting_cat',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(50)->notNull()->unique(),
                'info' => $this->string(255),
                'icon' => $this->string(255),
                'sort' => $this->smallInteger(3),
            ]
        );
    }

    public function down()
    {
        echo "m160112_105910_setting_cat cannot be reverted.\n";

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
