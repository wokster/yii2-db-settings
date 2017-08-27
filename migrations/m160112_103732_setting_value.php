<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_103732_setting_value extends Migration
{
    public function up()
    {
        $this->createTable('setting_value',
            [
                'id' => $this->primaryKey(),
                'setting_id' => $this->integer()->notNull(),
                'setting_value' => $this->string(255)->notNull(),
            ]
        );
    }

    public function down()
    {
        echo "m160112_103732_setting_value cannot be reverted.\n";

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
