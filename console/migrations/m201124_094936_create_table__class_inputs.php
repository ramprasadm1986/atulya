<?php

use yii\db\Migration;

class m201124_094936_create_table__class_inputs extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%_class_inputs}}',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string()->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('code', '{{%_class_inputs}}', ['code'], true);
        
         $this->batchInsert('{{%_class_inputs}}', ['code','name'],
         [
            ['select', 'Dropdown']
            
        ]);
        
    }

    public function down()
    {
        $this->dropTable('{{%_class_inputs}}');
    }
}
