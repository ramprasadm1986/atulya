<?php

use yii\db\Migration;

class m201124_115352_03_create_table_home_banner extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%home_banner}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'image' => $this->text()->notNull(),
                'link_to' => $this->text(),
                'start_date' => $this->date(),
                'end_date' => $this->date(),
                'status' => $this->integer()->notNull()->defaultValue('1'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'update_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%home_banner}}');
    }
}
