<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m240413_003855_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'extra_cost' => $this->decimal(12, 4),
            'selling_price' => $this->decimal(12, 2),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%services}}');
    }
}
