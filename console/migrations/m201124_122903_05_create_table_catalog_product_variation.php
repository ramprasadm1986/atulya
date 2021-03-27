<?php

use yii\db\Migration;

class m201124_122903_05_create_table_catalog_product_variation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%catalog_product_variation}}',
            [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'combination' => $this->text(),
                'image' => $this->text(),
                'price' => $this->decimal(10, 2)->defaultValue('0.00'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('product_id', '{{%catalog_product_variation}}', ['product_id']);

        $this->addForeignKey(
            'catalog_product_variation_ibfk_1',
            '{{%catalog_product_variation}}',
            ['product_id'],
            '{{%catalog_product}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%catalog_product_variation}}');
    }
}
