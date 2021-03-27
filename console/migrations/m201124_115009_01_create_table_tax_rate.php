<?php

use yii\db\Migration;

class m201124_115009_01_create_table_tax_rate extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tax_rate}}',
            [
                'id' => $this->primaryKey(),
                'tax_identifire' => $this->string()->notNull(),
                'tax_name' => $this->string()->notNull(),
                'rate' => $this->decimal(5, 2)->notNull(),
                'country' => $this->string(5)->notNull()->defaultValue('*'),
                'state' => $this->string(5)->notNull()->defaultValue('*'),
                'city' => $this->string()->notNull()->defaultValue('*'),
                'zip' => $this->string()->notNull()->defaultValue('*'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('tax_identifire', '{{%tax_rate}}', ['tax_identifire'], true);
    }

    public function down()
    {
        $this->dropTable('{{%tax_rate}}');
    }
}
