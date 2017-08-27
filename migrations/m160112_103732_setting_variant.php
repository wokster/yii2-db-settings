<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_103732_setting_variant extends Migration
{
    public function up()
    {
        $this->createTable('setting_variant',
            [
                'id' => $this->primaryKey(),
                'setting_id' => $this->integer()->notNull(),
                'variant' => $this->string(50),
            ]
        );
    }

    public function down()
    {
        echo "m160112_103732_setting_variant cannot be reverted.\n";

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
