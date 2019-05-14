<?php

use yii\db\Migration;

/**
 * Class m190422_195351_NameAndContactSettings
 */
class m190422_195351_NameAndContactSettings extends Migration
{

    const USERS_TABLE = 'NameAndContactSettings';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::USERS_TABLE,[
            'Id' => $this->primaryKey(),
            'Name' => $this->string(30),
            'Famiglia' => $this->string(30),
            'Nickname' => $this->string(30),
            'DateBrithday' => $this->string(30),
            'Floor' => $this->string(10),
            'City' => $this->string(50),
            'CityTime' => $this->string(30),
            'CityCheckboxAutoTimeZone' => $this->boolean(),
            'Telephone' => $this->string(20),
            'ImagePath' => $this->string(100),
            'ImageName' => $this->string(100),
            'Userid' => $this->integer(),
        ],'ENGINE InnoDB');
        $this->addForeignKey(
            'NamesAndContact_users_fk',
            'NameAndContactSettings',
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
        {
            $this->dropForeignKey(
                'NamesAndContact_users_fk',
                'NameAndContactSettings'
            );

            $this->dropTable(self::USERS_TABLE);

        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190422_195351_NameAndContactSettings cannot be reverted.\n";

        return false;
    }
    */
}
