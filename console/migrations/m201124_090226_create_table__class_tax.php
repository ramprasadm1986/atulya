<?php

use yii\db\Migration;

class m201124_090226_create_table__class_tax extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%_class_tax}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'code' => $this->string()->notNull(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
        
         $this->batchInsert('{{%_class_tax}}', ['name','code'],
         [
            ['Taxable','taxable'],
            ['Shipping Only','shipping'],
            ['None','none']
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%_class_tax}}');
    }
}
