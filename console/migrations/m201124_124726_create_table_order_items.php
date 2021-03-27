<?php

use yii\db\Migration;

class m201124_124726_create_table_order_items extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%order_items}}',
            [
                'id' => $this->primaryKey(),
                'order_identifire' => $this->string()->notNull(),
                'item_id' => $this->integer()->notNull(),
                'item_name' => $this->string()->notNull(),
                'variations' => $this->text(),
                'price' => $this->decimal(10, 2),
                'sell_price' => $this->decimal(10, 2),
                'qty' => $this->integer(),
                'total' => $this->decimal(10, 2),
                'tax' => $this->decimal(10, 2)->defaultValue('0.00'),
                'tax_details' => $this->decimal(10, 2),
                'shipping' => $this->decimal(10, 2),
                'row_total' => $this->decimal(10, 2),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('item_id', '{{%order_items}}', ['item_id']);
        $this->createIndex('order_identifire', '{{%order_items}}', ['order_identifire']);

        $this->addForeignKey(
            'order_items_ibfk_1',
            '{{%order_items}}',
            ['order_identifire'],
            '{{%orders}}',
            ['order_identifire'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'order_items_ibfk_2',
            '{{%order_items}}',
            ['item_id'],
            '{{%catalog_product}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%order_items}}');
    }
}
