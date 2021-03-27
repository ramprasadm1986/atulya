<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%admin}}`.
 */
class m200910_122617_add_verification_token_column_to_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('{{%admin}}', 'verification_token', $this->string()->defaultValue(null));
        
        
        
         $this->batchInsert('{{%admin}}', ['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'status', 'created_at', 'updated_at', 'verification_token'],
         [
            ['admin', Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash("qwert123y"), NULL, 'admin@mailinator.com', 1, 1600678029, 1600678029,  Yii::$app->security->generateRandomString() . '_' . time()]
            
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
         $this->dropColumn('{{%admin}}', 'verification_token');
    }
}
