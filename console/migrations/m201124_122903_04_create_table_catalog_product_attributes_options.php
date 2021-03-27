<?php

use yii\db\Migration;

class m201124_122903_04_create_table_catalog_product_attributes_options extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%catalog_product_attributes_options}}',
            [
                'id' => $this->primaryKey(),
                'attribute_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('attribute_id', '{{%catalog_product_attributes_options}}', ['attribute_id']);

        $this->addForeignKey(
            'catalog_product_attributes_options_ibfk_1',
            '{{%catalog_product_attributes_options}}',
            ['attribute_id'],
            '{{%catalog_product_attributes}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%catalog_product_attributes_options}}');
    }
}
