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
            $this->string(255)->unique()
        );
       $this->addColumn(
            'users',
            'status',
            $this->smallInteger()->defaultValue(10)
        );
       $this->addColumn(
           'users',
           'created_at',
           $this->integer()->notNull()
       );
        $this->addColumn(
            'users',
            'updated_at',
            $this->integer()->notNull()
        );
        $this->addColumn(
            'users',
            'email',
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
               'acess_token',
               $this->string(255)->unique()
           );
        $this->dropColumn(
            'users',
            'status',
            $this->smallInteger()->defaultValue(10)
        );
        $this->dropColumn(
            'users',
            'created_at',
            $this->integer()->notNull()
        );
        $this->dropColumn(
            'users',
            'updated_at',
            $this->integer()->notNull()
        );
        $this->dropColumn(
            'users',
            'email',
            $this->string(255)->unique()->notNull()
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
