<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m240412_215256_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'cost' => $this->decimal(12, 4),
            'packaging_cost' => $this->decimal(12, 4),
            'marketing_cost' => $this->decimal(12, 4),
            'selling_price' => $this->decimal(12, 2),
            'unit' => $this->char(2),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
