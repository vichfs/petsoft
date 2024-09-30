<?php

use yii\db\Migration;

/**
 * Class m240930_123928_update_services_table
 */
class m240930_123928_update_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('services', 'id_erp', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('services', 'id_erp');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240930_123928_update_services_table cannot be reverted.\n";

        return false;
    }
    */
}
