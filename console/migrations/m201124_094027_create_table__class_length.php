<?php

use yii\db\Migration;

class m201124_094027_create_table__class_length extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%_class_length}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(128)->notNull(),
                'code' => $this->string(5)->notNull(),
                'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('code', '{{%_class_length}}', ['code']);
        $this->createIndex('name', '{{%_class_length}}', ['name']);
        
        
        $this->batchInsert('{{%_class_length}}', ['name','code'],
         [
            ['Meter', 'm'],
            ['Centimeter', 'cm'],
            ['Millimeter', 'mm'],
            ['Foot', 'ft'],
            ['Inch', 'in']
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%_class_length}}');
    }
}
