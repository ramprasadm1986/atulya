<?php

namespace common\modules\cms\models;

use Yii;



class BlockProcessor
{
	
	
	public $blocks;
	
	public $PageContent;
	
	
	
	public function processContext($content){
		
		$this->PageContent=$content;
		
		preg_match_all("/{{(.*?)}}/", $this->PageContent, $cblocks);
		
		
		$this->blocks=$cblocks[0];
		
		foreach($cblocks[1] as $key=>$b){
			$blocks=explode(" ",trim(preg_replace('!\s+!', ' ', str_replace("cblock","",$b))," "));
			$block=array();
			foreach($blocks as $b2){
				
				$block[str_replace("'","",str_replace('"',"",trim(explode("=",$b2)[0], " ")))]=str_replace("'","",str_replace('"',"",trim(explode("=",$b2)[1], " ")));
				
			}
			$cblocks[1][$key]=$block;
		}
		
		foreach($this->blocks as $key=>$blockModule){
			$BlokInfo=array_keys($cblocks[1][$key]);
			array_shift($BlokInfo);
			$condition=array_shift($BlokInfo);
			$context_key=array_shift($BlokInfo);
			$context=$cblocks[1][$key][$context_key];
			
			$classname="\common\models\\".$cblocks[1][$key]['type'];
			$model=new $classname();
			
			
			
			if(strtolower($context_key)!="template"){
			$model=$model->find()->where([$condition=>$cblocks[1][$key][$condition]])->one();
			$Bcontent=$model->$context;
			$this->PageContent=str_replace($blockModule,$Bcontent,$this->PageContent);
			}
			else{
				$model=$model->find()->where([$condition=>$cblocks[1][$key][$condition]])->all();
				$this->PageContent=str_replace($blockModule,Yii::$app->controller->renderPartial($context,['model'=>$model]),$this->PageContent);
			}
			
		}
		
		
		
		return $this->PageContent;
	}
	
	
	
	
	
}