<?php

use yii\db\Migration;

/**
 * Class m190105_225444_task
 */
class m190105_225444_task extends Migration
{
    const USERS_TABLE = 'Yifraem';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::USERS_TABLE, [
            'id' => $this->primaryKey(),
            'time' => $this->time(),
            'date' => $this->string(32),
            'name' => $this->string(60),
            'email' => $this->string(32),
            'password' => $this->string(60),
            'userid' => $this->integer(),
        ]);
        $this->addForeignKey(
            'Yifraem_users_fk',
            'Yifraem',
            'userid',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'Yifraem_users_fk',
            'Yifraem'
        );

        $this->dropTable(self::USERS_TABLE);

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190105_225444_task cannot be reverted.\n";

        return false;
    }
    */
}
