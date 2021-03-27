<?php

use yii\db\Migration;

class m201124_124233_create_table_cart_items extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cart_items}}',
            [
                'id' => $this->primaryKey(),
                'cart_identifire' => $this->string()->notNull(),
                'item_id' => $this->integer()->notNull(),
                'item_name' => $this->string()->notNull(),
                'variations' => $this->text(),
                'price' => $this->decimal(10, 2),
                'sell_price' => $this->decimal(10, 2),
                'qty' => $this->integer(),
                'total' => $this->decimal(10, 2),
                'tax' => $this->decimal(10, 2),
                'tax_details' => $this->decimal(10, 2),
                'shipping' => $this->decimal(10, 2),
                'row_total' => $this->decimal(10, 2),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('item_id', '{{%cart_items}}', ['item_id']);
        $this->createIndex('cart_identifire', '{{%cart_items}}', ['cart_identifire']);

        $this->addForeignKey(
            'cart_items_ibfk_1',
            '{{%cart_items}}',
            ['cart_identifire'],
            '{{%cart}}',
            ['cart_identifire'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'cart_items_ibfk_2',
            '{{%cart_items}}',
            ['item_id'],
            '{{%catalog_product}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%cart_items}}');
    }
}
