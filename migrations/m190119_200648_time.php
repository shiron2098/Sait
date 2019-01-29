<?php

use yii\db\Migration;

/**
 * Class m190119_200648_time
 */
class m190119_200648_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'users',
            'time',
            $this->string(255)->unique()
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

       $this->dropColumn(
           'users',
           'time',
           $this->string(255)->unique()
       );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190119_200648_time cannot be reverted.\n";

        return false;
    }
    */
}
