<?php

use yii\db\Migration;

/**
 * Class m190102_205438_users
 */
class m190102_205438_users extends Migration
{
    const USERS_TABLE = 'users';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->$this->createTable(self::USERS_TABLE, [
            'id' => $this->primaryKey(),
            'login' => $this->string(255),
            'password' => $this->string(255),
    ]);
       $this->insert(self::USERS_TABLE, [
           'login' => 'admin',
           'password' => Yii::$app->security->generatePasswordHash('admin')
       ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190102_205438_users cannot be reverted.\n";

        return false;
    }
    */
}
