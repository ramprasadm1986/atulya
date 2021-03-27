<?php

use yii\db\Migration;

class m201124_115352_02_create_table_cms_page extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_page}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'slug' => $this->string()->notNull(),
                'meta_title' => $this->string(),
                'meta_keywords' => $this->string(),
                'meta_description' => $this->text(),
                'content' => $this->text()->notNull(),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('0'),
                'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('slug', '{{%cms_page}}', ['slug'], true);
    }

    public function down()
    {
        $this->dropTable('{{%cms_page}}');
    }
}
