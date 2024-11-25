<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pets}}`.
 */
class m241123_222741_create_pets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pets}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'species' => $this->char()->check("species IN ('C', 'F')")->notNull(),
            'date_of_birth' => $this->date(),
            'sex' => $this->char(1)->check("sex IN ('F', 'M')"),
            'breed' => $this->string(255),
            'coat_color' => $this->string(255),
            'coat_type' => $this->string(255),
            'weight' => $this->decimal(5, 2),
            'comments' => $this->string(2000),
            'behavior_description' => $this->string(2000),
            'usual_objects_description' => $this->string(255),
            'customer_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'FK__pets__customer_id',
            '{{%pets}}',
            'customer_id',
            '{{%customers}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pets}}');
    }
}
