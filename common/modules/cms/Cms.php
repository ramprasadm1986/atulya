<?php

namespace common\modules\cms;
use common\modules\cms\models\BlockProcessor;
use common\models\CmsBlock;
use common\models\CmsPage;
/**
 * cms module definition class
 */
class Cms extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\cms\controllers';
    
    
    private $blockProcessor;
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        $this->blockProcessor=new BlockProcessor();

        // custom initialization code goes here
    }
    
    
    public function getBlock($block_identifier=null){
        
        $context=null;
        $block=CmsBlock::find()->where(['identifier' => $block_identifier,'status'=>1])->one();
        if($block){        
            $context=$this->blockProcessor->processContext($block->content);
        }
        return $context;
        
    }
    
}
