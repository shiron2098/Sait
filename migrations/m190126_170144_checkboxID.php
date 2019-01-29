<?php

use yii\db\Migration;

/**
 * Class m190126_170144_checkboxID
 */
class m190126_170144_checkboxID extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'Yifraem',
            'Checkbox',
            $this->integer(1)->notNull()

        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
          $this->dropColumn(
              'Yifraem',
              'Checkbox',
              $this->integer(1)->notNull()
          );

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190126_170144_checkboxID cannot be reverted.\n";

        return false;
    }
    */
}
