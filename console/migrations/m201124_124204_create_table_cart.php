<?php

use yii\db\Migration;

class m201124_124204_create_table_cart extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cart}}',
            [
                'id' => $this->primaryKey(),
                'cart_identifire' => $this->string()->notNull(),
                'cart_user_type' => $this->integer()->defaultValue('0')->comment('0->Guest, 1->User'),
                'user_id' => $this->integer(),
                'user_email' => $this->string(),
                'cart_subtotal_excl_tax' => $this->decimal(10, 2),
                'discount' => $this->decimal(10, 2),
                'descout_details' => $this->text(),
                'tax' => $this->decimal(10, 2),
                'tax_details' => $this->text(),
                'shipping' => $this->decimal(10, 2),
                'shipping_details' => $this->text(),
                'cart_total' => $this->decimal(10, 2),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('0')->comment('0->Still in Cart 1->ConvertedToOrder 2->Cancled'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('cart_identifire', '{{%cart}}', ['cart_identifire'], true);
    }

    public function down()
    {
        $this->dropTable('{{%cart}}');
    }
}
