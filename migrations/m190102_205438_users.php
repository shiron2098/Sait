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
        $this->createTable(self::USERS_TABLE, [
            'id' => $this->primaryKey(),
            'login' => $this->string(),
            'password' => $this->string(),
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
        $this->dropTable(self::USERS_TABLE);

    }

/*    public function up()
    {
       $this->createTable(self::USERS_TABLE, [
            'id' => $this->primaryKey(),
            'login' => $this->string(255),
            'password' => $this->string(32),
        ]);
        $this->insert(self::USERS_TABLE, [
            'login' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin')
        ]);
    }

    public function down()
    {
        $this->dropTable(self::SERS_TABLE);

    }*/
}
