<?php

use yii\db\Migration;

class m201124_115352_01_create_table_cms_block extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
           $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_block}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'identifier' => $this->string()->notNull(),
                'is_system' => $this->tinyInteger(4)->notNull()->defaultValue('0'),
                'content' => $this->text(),
                'status' => $this->tinyInteger(4)->notNull()->defaultValue('0'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('Identifier', '{{%cms_block}}', ['identifier'], true);
        
        $this->batchInsert('{{%cms_block}}', ['id', 'title', 'identifier', 'is_system', 'content', 'status', 'created_at', 'updated_at'],
        [
            [1, 'Block Footer Copyright', 'block-footer-copyright', 1, '', 1, '2020-10-18 02:40:44', '2020-11-24 13:14:06'],
            [2, 'Block Footer One', 'block-footer-one', 1, '', 1, '2020-10-18 02:07:49', '2020-11-24 13:14:06'],
            [3, 'Block Footer Two', 'block-footer-two', 1, '', 1, '2020-10-18 03:05:27', '2020-11-24 13:14:06'],
            [4, 'Block Footer Three', 'block-footer-three', 1, '', 1, '2020-10-18 03:06:09', '2020-11-24 13:14:06'],
            [5, 'Block Footer Four', 'block-footer-four', 1, '', 1, '2020-10-18 03:06:37', '2020-11-24 13:14:06']
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%cms_block}}');
    }
}
