<?php

use yii\db\Migration;

class m201124_094505_create_table__class_weight extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%_class_weight}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(128)->notNull(),
                'code' => $this->string(5)->notNull(),
                'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('code', '{{%_class_weight}}', ['code']);
        $this->createIndex('name', '{{%_class_weight}}', ['name']);
        
        $this->batchInsert('{{%_class_weight}}', ['name','code'],
         [
            ['Kilogram', 'kg'],
            ['Gram', 'gm'],
            ['Ounce', 'oz'],
            ['Pound', 'lb']
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%_class_weight}}');
    }
}
