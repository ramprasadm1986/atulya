<?php

use yii\db\Migration;

class m201124_124221_create_table_cart_address extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cart_address}}',
            [
                'id' => $this->primaryKey(),
                'cart_identifire' => $this->string()->notNull(),
                'name' => $this->string()->notNull(),
                'email' => $this->string()->notNull(),
                'country' => $this->string()->notNull(),
                'state' => $this->string()->notNull(),
                'city' => $this->string()->notNull(),
                'zip' => $this->string()->notNull(),
                'phone' => $this->string()->notNull(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('cart_identifire', '{{%cart_address}}', ['cart_identifire']);

        $this->addForeignKey(
            'cart_address_ibfk_1',
            '{{%cart_address}}',
            ['cart_identifire'],
            '{{%cart}}',
            ['cart_identifire'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%cart_address}}');
    }
}
