<?php

use yii\db\Migration;

class m201124_110948_create_table__class_modules extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
             $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%_class_modules}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'code' => $this->string()->notNull(),
                'is_system' => $this->tinyInteger(4)->notNull()->defaultValue('0'),
                'is_active' => $this->tinyInteger(4)->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('name', '{{%_class_modules}}', ['name']);
        $this->createIndex('code', '{{%_class_modules}}', ['code'], true);
        
        $this->batchInsert('{{%_class_modules}}', ['id', 'name', 'code', 'is_system', 'is_active'],
         [
            [1, 'System', 'system', 1, 1],
            [2, 'Cms', 'cms', 1, 1],
            [3, 'Category', 'category', 1, 1],
            [4, 'Product', 'product', 1, 1],
            [5, 'Checkout', 'checkout', 1, 1],
            [6, 'Media Manager', 'filemanager', 1, 1],
            [7, 'Banner', 'banner', 0, 1],
            [8, 'Bestsellers', 'bestsellers', 0, 1],
            [9, 'Featured Products', 'featuredproducts', 0, 1],
            [10, 'Trending Products', 'trendingproducts', 0, 1],
            [11, 'Tax', 'tax', 0, 1],
            [12, 'Orders', 'order', 1, 1],
            [13, 'Shipping', 'shipping', 1, 1]
            
        ]);
        
        
    }

    public function down()
    {
        $this->dropTable('{{%_class_modules}}');
    }
}
