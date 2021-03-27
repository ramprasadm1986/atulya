<?php

use yii\db\Migration;

class m201124_122903_02_create_table_catalog_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%catalog_product}}',
            [
                'id' => $this->primaryKey(),
                'type' => $this->string(10),
                'name' => $this->string()->notNull(),
                'short_description' => $this->text()->notNull(),
                'description' => $this->text()->notNull(),
                'sku' => $this->string()->notNull(),
                'slug' => $this->string()->notNull(),
                'meta_title' => $this->text(),
                'meta_keywords' => $this->text(),
                'meta_description' => $this->text(),
                'base_image' => $this->text(),
                'gallery_images' => $this->text(),
                'length' => $this->decimal(10, 3)->defaultValue('0.000'),
                'width' => $this->decimal(10, 3)->defaultValue('0.000'),
                'height' => $this->decimal(10, 3)->defaultValue('0.000'),
                'length_class' => $this->string(10),
                'weight' => $this->decimal(10, 3)->defaultValue('0.000'),
                'weight_class' => $this->string(10),
                'tax_type' => $this->string(),
                'tax_type_id' => $this->integer(),
                'tax_class' => $this->string(),
                'tax_rule_id' => $this->integer(),
                'price' => $this->decimal(10, 2)->defaultValue('0.00'),
                'is_special_price' => $this->tinyInteger(4)->defaultValue('0'),
                'special_price' => $this->decimal(10, 2)->defaultValue('0.00'),
                'special_price_from' => $this->date(),
                'special_price_to' => $this->date(),
                'categories' => $this->text(),
                'related' => $this->text(),
                'up_sell' => $this->text(),
                'cross_sell' => $this->text(),
                'is_featured' => $this->tinyInteger(4)->defaultValue('0'),
                'is_trending' => $this->tinyInteger(4)->defaultValue('0'),
                'is_bestseller' => $this->tinyInteger(4)->defaultValue('0'),
                'is_new' => $this->tinyInteger(4)->defaultValue('0'),
                'new_from' => $this->date(),
                'new_to' => $this->date(),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('1'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('tax_type_id', '{{%catalog_product}}', ['tax_type_id']);
        $this->createIndex('tax_type', '{{%catalog_product}}', ['tax_type']);
        $this->createIndex('tax_rule_id', '{{%catalog_product}}', ['tax_rule_id']);
        $this->createIndex('sku', '{{%catalog_product}}', ['sku'], true);
        $this->createIndex('tax_class', '{{%catalog_product}}', ['tax_class']);
        $this->createIndex('type', '{{%catalog_product}}', ['type']);
    }

    public function down()
    {
        $this->dropTable('{{%catalog_product}}');
    }
}
