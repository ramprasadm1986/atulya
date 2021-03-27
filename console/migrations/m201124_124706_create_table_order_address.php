<?php

use yii\db\Migration;

class m201124_124706_create_table_order_address extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%order_address}}',
            [
                'id' => $this->primaryKey(),
                'order_identifire' => $this->string()->notNull(),
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

        $this->createIndex('order_identifire', '{{%order_address}}', ['order_identifire']);

        $this->addForeignKey(
            'order_address_ibfk_1',
            '{{%order_address}}',
            ['order_identifire'],
            '{{%orders}}',
            ['order_identifire'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%order_address}}');
    }
}
