<?php

use yii\db\Migration;

class m201124_122903_03_create_table_catalog_product_attributes extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%catalog_product_attributes}}',
            [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'type' => $this->string()->notNull(),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('0'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'update_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('product_id', '{{%catalog_product_attributes}}', ['product_id']);

        $this->addForeignKey(
            'catalog_product_attributes_ibfk_1',
            '{{%catalog_product_attributes}}',
            ['product_id'],
            '{{%catalog_product}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%catalog_product_attributes}}');
    }
}
