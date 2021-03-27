<?php

use yii\db\Migration;

class m201124_124650_create_table_orders extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%orders}}',
            [
                'id' => $this->primaryKey(),
                'order_identifire' => $this->string()->notNull(),
                'order_user_type' => $this->integer()->notNull()->defaultValue('0')->comment('0->Guest, 1->User'),
                'user_id' => $this->integer(),
                'user_email' => $this->string(),
                'order_subtotal_excl_tax' => $this->decimal(10, 2),
                'discount' => $this->decimal(10, 2),
                'descout_details' => $this->text(),
                'tax' => $this->decimal(10, 2)->defaultValue('0.00'),
                'tax_details' => $this->text(),
                'shipping' => $this->decimal(10, 2),
                'shipping_details' => $this->text(),
                'order_total' => $this->decimal(10, 2),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('0')->comment('0->Still in Cart 1->ConvertedToOrder 2->Cancled'),
                'order_status' => $this->string(15)->defaultValue('placed'),
                'order_tags' => $this->text(),
                'schannel' => $this->string(),
                'tracking' => $this->string(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('order_identifire', '{{%orders}}', ['order_identifire'], true);
    }

    public function down()
    {
        $this->dropTable('{{%orders}}');
    }
}
