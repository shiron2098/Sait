<?php

use yii\db\Migration;

/**
 * Class m190106_023710_task_accestoken
 */
class m190106_023710_task_accestoken extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'users',
            'acess_token',
            $this->string(255)
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
           $this->dropColumn(
               'users',
               'acess_token',
               $this->string(255)
           );

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_023710_task_accestoken cannot be reverted.\n";

        return false;
    }
    */
}
