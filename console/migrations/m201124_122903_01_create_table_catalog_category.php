<?php

use yii\db\Migration;

class m201124_122903_01_create_table_catalog_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%catalog_category}}',
            [
                'id' => $this->primaryKey(),
                'root' => $this->integer(),
                'lft' => $this->integer()->notNull(),
                'rgt' => $this->integer()->notNull(),
                'lvl' => $this->smallInteger(5)->notNull(),
                'name' => $this->string(60)->notNull(),
                'description' => $this->text()->notNull(),
                'slug' => $this->string()->notNull(),
                'image' => $this->text()->notNull(),
                'include_in_menu' => $this->tinyInteger(4)->defaultValue('0'),
                'icon' => $this->string(),
                'icon_type' => $this->boolean()->notNull()->defaultValue('1'),
                'active' => $this->boolean()->notNull()->defaultValue('1'),
                'selected' => $this->boolean()->notNull()->defaultValue('0'),
                'disabled' => $this->boolean()->notNull()->defaultValue('0'),
                'readonly' => $this->boolean()->notNull()->defaultValue('0'),
                'visible' => $this->boolean()->notNull()->defaultValue('1'),
                'collapsed' => $this->boolean()->notNull()->defaultValue('0'),
                'movable_u' => $this->boolean()->notNull()->defaultValue('1'),
                'movable_d' => $this->boolean()->notNull()->defaultValue('1'),
                'movable_l' => $this->boolean()->notNull()->defaultValue('1'),
                'movable_r' => $this->boolean()->notNull()->defaultValue('1'),
                'removable' => $this->boolean()->notNull()->defaultValue('1'),
                'removable_all' => $this->boolean()->notNull()->defaultValue('0'),
                'child_allowed' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('root', '{{%catalog_category}}', ['root']);
        $this->createIndex('active', '{{%catalog_category}}', ['active']);
        $this->createIndex('lft', '{{%catalog_category}}', ['lft']);
        $this->createIndex('slug', '{{%catalog_category}}', ['slug'], true);
        $this->createIndex('lvl', '{{%catalog_category}}', ['lvl']);
        
        $this->batchInsert('{{%catalog_category}}', ['id', 'root', 'lft', 'rgt', 'lvl', 'name', 'description', 'slug', 'image', 'include_in_menu', 'icon', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all', 'child_allowed'],
         [
            [1, 1, 1, 2, 0, 'All Categories', 'All Categories', 'all-categories', '', 1, '', 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1]
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%catalog_category}}');
    }
}
