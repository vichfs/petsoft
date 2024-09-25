<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_products}}`.
 */
class m240413_003907_create_service_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_products}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(),
            'product_id' => $this->integer(),
            'amount_used' => $this->decimal(12, 4),
        ]);

        $this->addForeignKey(
            'FK__service_products__service_id',
            '{{%service_products}}',
            'service_id',
            '{{%services}}',
            'id'
        );

        $this->addForeignKey(
            'FK__service_products__product_id',
            '{{%service_products}}',
            'product_id',
            '{{%products}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK__service_products__service_id', '{{%service_products}}');
        $this->dropForeignKey('FK__service_products__product_id', '{{%service_products}}');
        $this->dropTable('{{%service_products}}');
    }
}
