<?php

use yii\db\Migration;

class m201124_115009_02_create_table_tax_rule extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tax_rule}}',
            [
                'id' => $this->primaryKey(),
                'tax_class_name' => $this->string()->notNull(),
                'tax_rate_ids' => $this->text()->notNull(),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('tax_class_name', '{{%tax_rule}}', ['tax_class_name'], true);
    }

    public function down()
    {
        $this->dropTable('{{%tax_rule}}');
    }
}
