<?php

use yii\db\Migration;

class m201124_084730_create_table_shipping_methods extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%shipping_methods}}',
            [
                'id' => $this->primaryKey(),
                'method' => $this->string()->notNull(),
                'name' => $this->string()->notNull(),
                'price' => $this->decimal(10, 2)->notNull(),
                'snd_price' => $this->decimal(10, 2)->notNull(),
                'freeship_threshold' => $this->decimal(10, 2)->notNull(),
                'is_system' => $this->tinyInteger(4)->notNull()->defaultValue('0'),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('1'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('metdhod', '{{%shipping_methods}}', 'method', true);
        
        $this->insert('{{%shipping_methods}}', [
            'method' => 'standard',
            'name' => 'Standard Delivery',
            'price' => 0,
            'snd_price' => 0,
            'freeship_threshold' => 0,
            'is_system' => 1,
            'status' => 1,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%shipping_methods}}');
    }
}
