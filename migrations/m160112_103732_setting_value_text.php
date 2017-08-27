<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_103732_setting_value_text extends Migration
{
    public function up()
    {
        $this->createTable('setting_value_text',
            [
                'id' => $this->primaryKey(),
                'setting_id' => $this->integer()->notNull(),
                'setting_value' => $this->text()->notNull(),
            ]
        );
    }

    public function down()
    {
        echo "m160112_103732_setting_value_text cannot be reverted.\n";

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
