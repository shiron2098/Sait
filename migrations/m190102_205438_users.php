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
            'login' => $this->string(255),
            'password_hash' => $this->string(60),
            'auth_key' => $this->string(60),
    ]);
       $this->insert(self::USERS_TABLE, [
           'login' => 'admin',
           'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
           'auth_key' => Yii::$app->security->generateRandomString(32),
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
