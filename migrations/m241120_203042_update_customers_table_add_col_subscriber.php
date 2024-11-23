<?php

use yii\db\Migration;

/**
 * Class m241120_203042_update_customers_table_add_col_subscriber
 */
class m241120_203042_update_customers_table_add_col_subscriber extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customers', 'subscriber', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customers', 'subscriber');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241120_203042_update_customers_table_add_col_subscriber cannot be reverted.\n";

        return false;
    }
    */
}
