<?php

namespace common\components;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\db\Exception;


use common\models\ClassModules;

class ModuleConfigs implements BootstrapInterface
{

    
    const CACHE_ID = 'modules_status'; 
    
    private static $modules;
    
    public function bootstrap($app)
    {
        $this->getModulesConfig();
    }
    
    private function getModulesConfig() {
        
      
        
        $modules = Yii::$app->cache->get(self::CACHE_ID);
        
        if ($modules === false) {

            $modules = [];
            try{
                $module_Data=ClassModules::find()->all();
                
                foreach($module_Data as $module){
                    $data=[];
                    
                    $data['name']=$module->name;
                    $data['is_system']=$module->is_system;
                    $data['is_active']=$module->is_active;
                    
                    $modules[$module->code]= $data;
                }
            }
            catch(Exception $e){
               $modules = []; 
            }
          if (!YII_DEBUG) {
                Yii::$app->cache->set(self::CACHE_ID, $modules);
            }
        }
        
        self::$modules=$modules;
        
    }
    
    public function getModuleStatus($Module_Name){

        
        if(isset(self::$modules[$Module_Name])){
            
           return (self::$modules[$Module_Name]['is_system'])? true: ( self::$modules[$Module_Name]['is_active']?true:false);
            
        }
        return false;       
        
    }
    public function isSystemModule($Module_Name){

        
        if(isset(self::$modules[$Module_Name])){
            
           return (self::$modules[$Module_Name]['is_system'])? true: false;
            
        }
        return false;       
        
    }
}