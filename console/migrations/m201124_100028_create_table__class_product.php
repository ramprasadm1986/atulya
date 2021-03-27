<?php

use yii\db\Migration;

class m201124_100028_create_table__class_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%_class_product}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'code' => $this->string()->notNull(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
        
         $this->batchInsert('{{%_class_product}}', ['name','code'],
         [
            ['Simple', 'simple'],
            ['Variable', 'variable'],
            ['Digital', 'digital']
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%_class_product}}');
    }
}
