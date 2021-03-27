<?php
namespace common\modules\order\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use common\models\Order;


/**
 * Consignment form
 */
class Consignment extends Model
{
    public $cfile;
    private $_order;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cfile'], 'required'], 
            [['cfile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv','wrongExtension'=>'csv files only'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'cfile' => Yii::t('app', 'Trackings CSV'),
            
        ];
    }

    
}
